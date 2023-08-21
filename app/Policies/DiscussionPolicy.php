<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Discussion;
use App\Models\User;

final class DiscussionPolicy
{
    public function create(User $user): bool
    {
        return $user->hasVerifiedEmail();
    }

    public function reply(User $user): bool
    {
        return $user->hasVerifiedEmail();
    }

    public function delete(User $user, Discussion $discussion): bool
    {
        return $user->id === $discussion->user_id;
    }
}
