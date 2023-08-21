<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $title
 * @property string $slug
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 */
final class Topic extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'title',
        'slug',
    ];

    public function discussions(): HasMany
    {
        return $this->hasMany(
            related: Discussion::class,
            foreignKey: 'topic_id',
        );
    }
}
