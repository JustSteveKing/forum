<?php

declare(strict_types=1);

namespace App\Enums\Moderation;

enum Reason: string
{
    case OTHER = 'other';
    case IDENTITY = 'identity';
    case HARASSMENT = 'harassment';
    case VIOLENCE = 'violence';
    case INAPPROPRIATE = 'inappropriate';
}
