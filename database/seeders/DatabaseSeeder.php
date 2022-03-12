<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  \App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Genre::truncate();
        User::truncate();
        Game::truncate();

        $user = User::factory()->create();

        $genre1 = Genre::factory()->create();
        $genre2 = Genre::factory()->create();


        Game::factory(5)->create([
            'user_id'=>$user->id,
            'genre_id'=>$genre1->id,
        ]);

        Game::factory(2)->create([
            'user_id'=>$user->id,
            'genre_id'=>$genre2->id,
        ]);
        
    }
}
