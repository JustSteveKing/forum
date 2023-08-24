<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Moderation\Outcome;
use App\Enums\Moderation\Reason;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $id
 * @property Reason $reason
 * @property Outcome $outcome
 * @property string $content
 * @property string $reportable_id
 * @property string $reportable_type
 * @property bool $anonymous
 * @property string $user_id
 */
final class Report extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'reason',
        'outcome',
        'content',
        'reportable_id',
        'reportable_type',
        'anonymous',
        'user_id',
    ];

    protected $casts = [
        'reason' => Reason::class,
        'outcome' => Outcome::class,
        'anonymous' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    public function reportable(): MorphTo
    {
        return $this->morphTo(
            name: 'reportable',
        );
    }
}
