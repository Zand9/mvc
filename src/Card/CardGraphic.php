<?php

namespace App\Card;

class CardGraphic extends Card
{
    private static array $unicodeMap = [
        '♠' => [
            'A' => "\u{1F0A1}",
            '2' => "\u{1F0A2}",
            '3' => "\u{1F0A3}",
            '4' => "\u{1F0A4}",
            '5' => "\u{1F0A5}",
            '6' => "\u{1F0A6}",
            '7' => "\u{1F0A7}",
            '8' => "\u{1F0A8}",
            '9' => "\u{1F0A9}",
            '10' => "\u{1F0AA}",
            'J' => "\u{1F0AB}",
            'Q' => "\u{1F0AD}",
            'K' => "\u{1F0AE}",
        ],
        '♥' => [
            'A' => "\u{1F0B1}",
            '2' => "\u{1F0B2}",
            '3' => "\u{1F0B3}",
            '4' => "\u{1F0B4}",
            '5' => "\u{1F0B5}",
            '6' => "\u{1F0B6}",
            '7' => "\u{1F0B7}",
            '8' => "\u{1F0B8}",
            '9' => "\u{1F0B9}",
            '10' => "\u{1F0BA}",
            'J' => "\u{1F0BB}",
            'Q' => "\u{1F0BD}",
            'K' => "\u{1F0BE}",
        ],
        '♦' => [
            'A' => "\u{1F0C1}",
            '2' => "\u{1F0C2}",
            '3' => "\u{1F0C3}",
            '4' => "\u{1F0C4}",
            '5' => "\u{1F0C5}",
            '6' => "\u{1F0C6}",
            '7' => "\u{1F0C7}",
            '8' => "\u{1F0C8}",
            '9' => "\u{1F0C9}",
            '10' => "\u{1F0CA}",
            'J' => "\u{1F0CB}",
            'Q' => "\u{1F0CD}",
            'K' => "\u{1F0CE}",
        ],
        '♣' => [
            'A' => "\u{1F0D1}",
            '2' => "\u{1F0D2}",
            '3' => "\u{1F0D3}",
            '4' => "\u{1F0D4}",
            '5' => "\u{1F0D5}",
            '6' => "\u{1F0D6}",
            '7' => "\u{1F0D7}",
            '8' => "\u{1F0D8}",
            '9' => "\u{1F0D9}",
            '10' => "\u{1F0DA}",
            'J' => "\u{1F0DB}",
            'Q' => "\u{1F0DD}",
            'K' => "\u{1F0DE}",
        ],
    ];

    public function getUnicode(): string
    {
        return self::$unicodeMap[$this->suit][$this->rank];
    }

    public function getColor(): string
    {
        return in_array($this->suit, ['♥', '♦']) ? 'red' : 'black';
    }
}
