<?php

declare(strict_types=1);

namespace App\Enums;

enum CacheTime: int
{
    case MINUTE = 60;
    case HOUR = 3600;
    case DAY = 86400;
}
