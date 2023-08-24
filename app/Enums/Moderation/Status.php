<?php

declare(strict_types=1);

namespace App\Enums\Moderation;

enum Status: string
{
    case PUBLISHED = 'published';
    case REPORTED = 'reported';
    case REMOVED = 'removed';
}
