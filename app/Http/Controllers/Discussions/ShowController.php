<?php

declare(strict_types=1);

namespace App\Http\Controllers\Discussions;

use App\Http\Controllers\Concerns\HasInertiaResponse;
use App\Http\Resources\Web\DiscussionResource;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Inertia\Response;

final class ShowController
{
    use HasInertiaResponse;

    public function __invoke(Request $request, string $ulid): Response
    {
        return $this->response->render(
            component: 'Discussions/Show',
            props: [
                'discussion' => new DiscussionResource(
                    resource: Discussion::query()
                        ->with(['posts.user','user','topic'])
                        ->findOrFail(
                            id: $ulid,
                        ),
                ),
            ]
        );
    }
}
