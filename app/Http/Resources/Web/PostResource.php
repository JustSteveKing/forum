<?php

declare(strict_types=1);

namespace App\Http\Resources\Web;

use App\Http\Resources\DateResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Post $resource
 */
final class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'status' => $this->resource->status->value,
            'content' => $this->resource->content,
            'likes' => $this->resource->likes,
            'user' => new UserResource(
                resource: $this->whenLoaded(
                    relationship: 'user',
                ),
            ),
            'discussion' => new DiscussionResource(
                resource: $this->whenLoaded(
                    relationship: 'discussion',
                ),
            ),
            'parent' => new PostResource(
                resource: $this->whenLoaded(
                    relationship: 'parent',
                ),
            ),
            'posts' => PostResource::collection(
                resource: $this->whenLoaded(
                    relationship: 'posts',
                ),
            ),
            'created' => new DateResource(
                resource: $this->resource->created_at,
            ),
        ];
    }
}
