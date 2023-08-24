<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Moderation\Status;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;

/**
 * @property string $id
 * @property string $title
 * @property Status $status
 * @property int $likes
 * @property int $views
 * @property string $user_id
 * @property string $topic_id
 * @property null|CarbonInterface $pinned_at
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 */
final class Discussion extends Model
{
    use HasFactory;
    use HasUlids;
    use Searchable;

    protected $fillable = [
        'title',
        'status',
        'likes',
        'views',
        'user_id',
        'topic_id',
        'pinned_at',
    ];

    protected $casts = [
        'pinned_at' => 'datetime',
        'status' => Status::class,
    ];

    #[SearchUsingFullText(['title'])]
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'status' => $this->status->value,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(
            related: Topic::class,
            foreignKey: 'topic_id',
        );
    }

    public function posts(): HasMany
    {
        return $this->hasMany(
            related: Post::class,
            foreignKey: 'discussion_id',
        );
    }

    public function reports(): MorphMany
    {
        return $this->morphMany(
            related: Report::class,
            name: 'reportable',
            type: 'discussion',
        );
    }
}
