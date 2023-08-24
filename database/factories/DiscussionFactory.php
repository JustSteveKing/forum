<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Moderation\Status;
use App\Models\Discussion;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

final class DiscussionFactory extends Factory
{
    protected $model = Discussion::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'status' => Status::PUBLISHED,
            'likes' => 0,
            'views' => 0,
            'user_id' => User::factory(),
            'topic_id' => Topic::factory(),
            'pinned_at' => null,
        ];
    }

    public function pinned(): DiscussionFactory
    {
        return $this->state(
            state: fn (array $attributes): array => [
                'pinned_at' => $this->faker->dateTime(),
            ],
        );
    }

    public function status(Status $status): DiscussionFactory
    {
        return $this->state(
            state: fn (array $attributes): array => [
                'status' => $status,
            ],
        );
    }
}
