<?php

namespace App\Card;

class DeckOfCards
{
    private array $cards = [];

    public function __construct()
    {
        $this->createDeck();
    }

    private function createDeck(): void
    {
        $suits = ['♠', '♥', '♦', '♣'];
        $ranks = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];

        foreach ($suits as $suit) {
            foreach ($ranks as $rank) {
                $this->cards[] = new CardGraphic($suit, $rank);
            }
        }
    }

    public function shuffle(): void
    {
        shuffle($this->cards);
    }

    public function draw(int $count = 1): array
    {
        return array_splice($this->cards, 0, $count);
    }

    public function getCards(): array
    {
        return $this->cards;
    }

    public function count(): int
    {
        return count($this->cards);
    }

    public function sort(): void
    {
        usort($this->cards, fn($first, $second) => $first->getUnicode() <=> $second->getUnicode());
    }
}
