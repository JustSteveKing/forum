<?php

declare(strict_types=1);

namespace App\Enums\Moderation;

enum Outcome: string
{
    case REMOVED_USER = 'removed user';
    case REMOVED_CONTENT = 'removed content';
    case INVESTIGATION = 'investigation';
    case NO_ACTION = 'no action';
}
