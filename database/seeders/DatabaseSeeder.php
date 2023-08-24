<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Identity\Role;
use App\Models\Discussion;
use App\Models\Mention;
use App\Models\Post;
use App\Models\Topic;
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
            'role' => Role::ADMIN,
        ]);

        $topic = Topic::factory()->create([
            'title' => 'Laravel',
        ]);

        Discussion::factory()->for($user)->for($topic)->create([
            'title' => 'Do you need an API?',
        ]);
    }
}
