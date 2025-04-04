<?php

namespace App\Card;

class CardGraphic extends Card
{
    private string $suit;
    private string $rank;

    private static array $suits = ['♠', '♥', '♦', '♣'];
    private static array $ranks = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];

    public function __construct(string $suit, string $rank)
    {
        $this->suit = $suit;
        $this->rank = $rank;
    }

    public function getAsString(): string
    {
        return "{$this->rank}{$this->suit}";
    }
}
