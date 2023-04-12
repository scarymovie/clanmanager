<?php

namespace Database\Seeders;

use App\Models\Character;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CharactersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Character::create([
            'member_id' => 1,
            'nickname' => Str::random(4),
            'status' => 'main',
            'character_type_id' => 1,
            'link' => Str::random(32)
        ]);
    }
}
