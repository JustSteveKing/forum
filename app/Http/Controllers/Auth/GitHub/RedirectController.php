<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth\GitHub;

use Illuminate\Http\RedirectResponse as LaravelRedirect;
use Illuminate\Http\Request;
use Laravel\Socialite\SocialiteManager;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirect;

final readonly class RedirectController
{
    public function __construct(
        private SocialiteManager $manager,
    ) {}

    public function __invoke(Request $request): SymfonyRedirect|LaravelRedirect
    {
        return $this->manager->driver('github')->redirect();
    }
}
