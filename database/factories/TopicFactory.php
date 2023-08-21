<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

final class TopicFactory extends Factory
{
    protected $model = Topic::class;

    public function definition(): array
    {
        return [
            'title' => $title = $this->faker->words(asText: true),
            'slug' => Str::slug(
                title: $title,
            ),
        ];
    }
}
