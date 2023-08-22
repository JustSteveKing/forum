<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Discussions\ShowController;
use App\Http\Requests\Web\Posts\StoreRequest;
use App\Models\Discussion;
use App\Models\Post;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;

final readonly class StoreController
{
    public function __construct(
        private Authenticatable $auth,
    ) {}

    public function __invoke(StoreRequest $request, Discussion $discussion): RedirectResponse
    {
        Post::query()->create([
            'content' => $request->string('content')->toString(),
            'discussion_id' => $discussion->getKey(),
            'user_id' => $this->auth->getAuthIdentifier(),
        ]);

        return new RedirectResponse(
            url: \action(ShowController::class, [
                'ulid' => $discussion->id,
            ]),
        );
    }
}
