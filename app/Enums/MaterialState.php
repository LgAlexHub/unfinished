<?php

namespace App\Enums;

enum MaterialState: string
{
    case NEW = "neuf";
    case GOOD = "bon";
    case CORRECT = "correcte";
    case USED = "usé";
    case DAMAGED = "abimé";


    public function label(): string
    {
        return match ($this) {
            self::NEW => 'Neuf',
            self::GOOD => 'Bon',
            self::CORRECT => 'Correcte',
            self::USED => 'Usé',
            self::DAMAGED => 'Abimé',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::NEW => 'sky',
            self::GOOD => 'lime',
            self::CORRECT => 'yellow',
            self::USED => 'orange',
            self::DAMAGED => 'red',
        };
    }
}
