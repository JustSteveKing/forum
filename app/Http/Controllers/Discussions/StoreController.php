<?php

declare(strict_types=1);

namespace App\Http\Controllers\Discussions;

use App\Http\Requests\Web\Discussions\StoreRequest;
use App\Models\Discussion;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;

final class StoreController
{
    public function __construct(
        private readonly Authenticatable $auth,
    ) {}

    public function __invoke(StoreRequest $request): RedirectResponse
    {
        Discussion::query()->create([
            'title' => $request->string('title')->toString(),
            'topic_id' => $request->string('topic')->toString(),
            'user_id' => $this->auth->getAuthIdentifier(),
        ]);

        return new RedirectResponse(
            url: \action(IndexController::class),
        );
    }
}
