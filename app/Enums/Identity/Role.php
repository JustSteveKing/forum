<?php

declare(strict_types=1);

namespace App\Enums\Identity;

enum Role: string
{
    case ADMIN = 'admin';
    case MODERATOR = 'moderator';
    case USER = 'user';
}
