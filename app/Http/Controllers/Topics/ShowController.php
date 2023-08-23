<?php

declare(strict_types=1);

namespace App\Http\Controllers\Topics;

use App\Http\Controllers\Concerns\HasInertiaResponse;
use App\Http\Resources\Web\TopicResource;
use App\Models\Topic;
use Illuminate\Http\Request;
use Inertia\Response;

final class ShowController
{
    use HasInertiaResponse;

    public function __invoke(Request $request, string $slug): Response
    {
        $topic = Topic::query()
            ->with(['discussions.user','discussions.posts'])
            ->where('slug', $slug)
            ->firstOrFail();

        return $this->response->render(
            component: 'Topics/Show',
            props: [
                'topic' => new TopicResource(
                    resource: $topic,
                )
            ],
        );
    }
}
