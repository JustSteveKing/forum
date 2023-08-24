<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Identity\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'role' => Role::USER,
            'email_verified_at' => now(),
            'password' => Hash::make(
                value: 'password',
            ),
            'remember_token' => Str::random(10),
            'avatar' => null,
        ];
    }

    public function unverified(): UserFactory
    {
        return $this->state(
            state: fn (array $attributes): array => [
                'email_verified_at' => null,
            ],
        );
    }

    public function role(Role $role): UserFactory
    {
        return $this->state(
            state: fn (array $attributes): array => [
                'role' => $role,
            ],
        );
    }
}
