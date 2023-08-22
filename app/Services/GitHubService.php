<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Database\DatabaseManager;
use Laravel\Socialite\Contracts\User as UserContract;

final readonly class GitHubService
{
    public function __construct(
        private DatabaseManager $database,
    ) {}

    public function createOrUpdate(UserContract $user): User
    {
        return $this->database->transaction(
            callback: fn () => User::query()->updateOrCreate(
                attributes: [
                    'provider' => 'github',
                    'provider_id' => $user->getId(),
                ],
                values: [
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'username' => $user->getNickname(),
                    'avatar' => $user->getAvatar(),
                    'access_token' => $user->access_token ?? null,
                ]
            ),
            attempts: 2,
        );
    }

    public function repos(string $accessToken)
    {
        //
    }
}
