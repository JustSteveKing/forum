<?php

namespace App\Providers;

use App\Models\Discussion;
use App\Models\Post;
use App\Policies\DiscussionPolicy;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Discussion::class => DiscussionPolicy::class,
        Post::class => PostPolicy::class,
    ];
}
