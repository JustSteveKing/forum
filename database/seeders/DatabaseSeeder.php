<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Mention;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Steve McDougall',
            'email' => 'juststevemcd@gmail.com',
            'username' => 'juststeveking',
        ]);

        Post::factory()->for($user)->count(10)->create();

        Mention::factory()->for($user)->create();
    }
}
