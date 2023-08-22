<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth\GitHub;

use App\Http\Controllers\Discussions\IndexController;
use App\Services\GitHubService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\SocialiteManager;

final readonly class CallbackController
{
    public function __construct(
        private SocialiteManager $manager,
        private GitHubService $service,
    ) {}

    public function __invoke(Request $request): RedirectResponse
    {
        $user = $this->service->createOrUpdate(
            user: $this->manager->driver('github')->user(),
        );

        Auth::loginUsingId(
            id: $user->getKey(),
        );

        return new RedirectResponse(
            url: action(IndexController::class),
        );
    }
}
