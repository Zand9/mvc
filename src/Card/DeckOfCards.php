<?php

namespace App\Card;

use App\Card\CardGraphic;

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
}
