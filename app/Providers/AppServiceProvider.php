<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Discussion;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        JsonResource::withoutWrapping();

        Model::shouldBeStrict(
            shouldBeStrict: ! $this->app->environment('production'),
        );

        Relation::enforceMorphMap(
            map: [
                'discussion' => Discussion::class,
                'post' => Post::class,
            ],
        );
    }
}
