<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a few sample users if they don't exist
        $users = User::count() < 3
                    ? collect([
                        User::create([
                            'name' => 'Alice Developer',
                            'username' => 'alicedev',
                            'email' => 'alice@example.com',
                            'password' => bcrypt('password'),
                        ]),
                        User::create([
                            'name' => 'Bob Builder',
                            'username' => 'bobby',
                            'email' => 'bob@example.com',
                            'password' => bcrypt('password'),
                        ]),
                        User::create([
                            'name' => 'Charlie Coder',
                            'username' => 'charlie',
                            'email' => 'charlie@example.com',
                            'password' => bcrypt('password'),
                        ]),
                    ])
                    : User::take(3)->get();

        // Sample posts
        $posts = [
            'Just discovered Laravel - where has this been all my life? 🚀',
            'Building something cool with Chatter today!',
            'Laravel\'s Eloquent ORM is pure magic ✨',
            'Deployed my first app with Laravel Cloud. So smooth!',
            'Who else is loving Blade components?',
            'Friday deploys with Laravel? No problem! 😎',
        ];

        // Create posts for random users
        foreach ($posts as $message) {
            $users->random()->posts()->create([
                'message' => $message,
                'profile_id' => fake()->numberBetween(1, 3),
                'created_at' => now()->subMinutes(rand(5, 1440)),
            ]);
        }
    }
}
