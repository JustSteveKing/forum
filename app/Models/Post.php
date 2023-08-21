<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string  $id
 * @property string $content
 * @property string $user_id
 * @property string $discussion_id
 * @property null|string $parent_id
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 */
final class Post extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'content',
        'user_id',
        'discussion_id',
        'parent_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    public function discussion(): BelongsTo
    {
        return $this->belongsTo(
            related: Discussion::class,
            foreignKey: 'discussion_id',
        );
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(
            related: Post::class,
            foreignKey: 'parent_id',
        );
    }

    public function posts(): HasMany
    {
        return $this->hasMany(
            related: Post::class,
            foreignKey: 'parent_id',
        );
    }

    public function mentions(): BelongsToMany
    {
        return $this->belongsToMany(
            related: User::class,
            table: 'mentions',
            foreignPivotKey: 'post_id',
        )->withTimestamps()->using(
            class: Mention::class,
        );
    }
}
