<?php

declare(strict_types=1);

namespace App\Http\Resources\Web;

use App\Http\Resources\DateResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read User $resource
 */
final class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'email' => $this->resource->email,
            'avatar' => $this->resource->avatar ?? "https://unavatar.io/{$this->resource->email}",
            'verified' => new DateResource(
                resource: $this->resource->email_verified_at,
            ),
        ];
    }
}
