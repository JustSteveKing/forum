<?php

declare(strict_types=1);

namespace App\Http\Resources\Web;

use App\Http\Resources\DateResource;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Discussion $resource
 */
final class DiscussionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'views' => $this->resource->views,
            'topic' => new TopicResource(
                resource: $this->whenLoaded(
                    relationship: 'topic',
                ),
            ),
            'user' => new UserResource(
                resource: $this->whenLoaded(
                    relationship: 'user',
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
