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

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $genre1 = Genre::create([
             'name'=>'FPS',
          ]);
        $genre2 = Genre::create([
              'name'=>'RPG',
        ]);
        Game::factory(5)->create([
            'user_id'=>$user1->id,
            'genre_id'=>$genre1->id,
        ]);

        Game::factory(2)->create([
            'user_id'=>$user2->id,
            'genre_id'=>$genre2->id,
        ]);
        
    }
}
