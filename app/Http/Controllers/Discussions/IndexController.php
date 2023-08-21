<?php

declare(strict_types=1);

namespace App\Http\Controllers\Discussions;

use App\Http\Controllers\Concerns\HasInertiaResponse;
use App\Http\Resources\Web\DiscussionResource;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Inertia\Response;

final class IndexController
{
    use HasInertiaResponse;

    public function __invoke(Request $request): Response
    {
        $discussions = Discussion::query()->with(['user','topic','posts.user'])->get();

        return $this->response->render(
            component: 'Discussions/Index',
            props: [
                'discussions' => DiscussionResource::collection(
                    resource: $discussions,
                ),
            ],
        );
    }
}
