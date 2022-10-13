<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Jenssegers\Mongodb\Auth\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'Bilek',
            'email' => 'bilek@gmail.com',
            'password' => bcrypt('sandi')
        ]);

        // Post::create([
        //     'user_id' => '63459548524cda09810e36f7',
        //     'title' => 'Lemao Projek',
        //     'description' => 'Lemao Description'
        // ]);
    }
}
