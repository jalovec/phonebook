<?php

declare(strict_types=1);

namespace App\Domain\Contact\Enum;

enum PhoneNumberType: string
{
    case MOBILE = 'mobile';
    case HOME = 'home';
    case WORK = 'work';
    case OTHER = 'other';

    public function label(): string
    {
        return match ($this) {
            self::MOBILE => 'Mobil',
            self::HOME => 'Domácí',
            self::WORK => 'Pracovní',
            self::OTHER => 'Jiné',
        };
    }
}
