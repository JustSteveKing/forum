<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Search;

use App\Http\Resources\Web\DiscussionResource;
use App\Models\Discussion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class SearchController
{
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(
            data: DiscussionResource::collection(
                resource: Discussion::search(
                    $request->get('search'),
                )->get(),
            ),
        );
    }
}
