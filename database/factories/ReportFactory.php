<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Moderation\Outcome;
use App\Enums\Moderation\Reason;
use App\Models\Discussion;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

final class ReportFactory extends Factory
{
    protected $model = Report::class;

    public function definition(): array
    {
        return [
            'reason' => Reason::OTHER,
            'outcome' => Outcome::INVESTIGATION,
            'content' => $this->faker->realText(),
            'reportable_id' => Discussion::factory(),
            'reportable_type' => 'discussion',
            'anonymous' => $this->faker->boolean(),
            'user_id' => User::factory(),
        ];
    }

    public function reason(Reason $reason): ReportFactory
    {
        return $this->state(
            state: fn (array $attributes): array => [
                'reason' => $reason,
            ],
        );
    }
}
