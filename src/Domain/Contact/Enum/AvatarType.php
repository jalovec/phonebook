<?php

declare(strict_types=1);

namespace App\Domain\Contact\Enum;

enum AvatarType: string
{
    case AVATAR_1 = 'avatar1.png';
    case AVATAR_2 = 'avatar2.png';
    case AVATAR_3 = 'avatar3.png';
    case AVATAR_4 = 'avatar4.png';
    case AVATAR_5 = 'avatar5.png';
    case AVATAR_6 = 'avatar6.png';

    public function label(): string
    {
        return 'AVATAR_IMAGES.' . $this->name . '.NAME';
    }

    public function path(): string
    {
        return 'images/avatars/' . $this->value;
    }
}
