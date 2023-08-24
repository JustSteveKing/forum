<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Moderation\Status;
use App\Models\Discussion;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

final class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'status' => Status::PUBLISHED,
            'content' => $this->faker->realText(),
            'likes' => 0,
            'user_id' => User::factory(),
            'discussion_id' => Discussion::factory(),
            'parent_id' => null,
        ];
    }

    public function status(Status $status): PostFactory
    {
        return $this->state(
            state: fn (array $attributes): array => [
                'status' => $status,
            ],
        );
    }
}
