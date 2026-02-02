<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear 10 usuarios
        $users = User::factory(10)->create();

        // Crear posts para cada usuario
        $users->each(function ($user) {
            // Cada usuario crea entre 2 y 5 posts
            $posts = Post::factory(rand(2, 5))->create([
                'user_id' => $user->id
            ]);

            // Para cada post, crear entre 3 y 10 comentarios
            $posts->each(function ($post) use ($users) {
                Comment::factory(rand(3, 10))->create([
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id
                ]);
            });
        });

        // Seed products from remote repository
        if (class_exists(ProductSeeder::class)) {
            $this->call([
                ProductSeeder::class,
            ]);
        }
    }
}
