<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Enums\CacheTime;
use App\Http\Resources\Web\DiscussionResource;
use App\Http\Resources\Web\UserResource;
use App\Models\Discussion;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

final class HandleInertiaRequests extends Middleware
{
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => Auth::check()
                    ? new UserResource(
                        resource: $request->user(),
                    ) : null,
            ],
            'topics' => Cache::remember(
                key: 'topics',
                ttl: CacheTime::HOUR->value * 2,
                callback: static fn (): Collection|array => Topic::query()->get(),
            ),
            'trending' => Cache::remember(
                key: 'trending',
                ttl: CacheTime::HOUR->value * 2,
                callback: static fn (): AnonymousResourceCollection => DiscussionResource::collection(
                    resource: Discussion::query()->with(['user'])->orderBy('likes')->limit(5)->get(),
                ),
            ),
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy())->toArray(), [
                    'location' => $request->url(),
                ]);
            },
        ]);
    }
}
