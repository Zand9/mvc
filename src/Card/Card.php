<?php

namespace App\Card;

class Card
{
    protected $value;

    public function __construct()
    {
        $this->value = 0;
    }

    public function roll(): int
    {
        $this->value = random_int(1, 52);
        return $this->value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getAsString(): string
    {
        return "[{$this->value}]";
    }
}
