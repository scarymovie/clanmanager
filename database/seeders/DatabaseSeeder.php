<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CharactersType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
//            UsersSeeder::class,
            CharactersTypeSeeder::class,
//            ClansSeeder::class,
//            MembersSeeder::class,
//            CharactersSeeder::class,
//            EventsSeeder::class,
        ]);
    }
}
