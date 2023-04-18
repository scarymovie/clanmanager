<?php

namespace Database\Seeders;

use App\Models\Clan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clan::create([
            'user_id' => 1,
            'title' => 'isouw',
            'invite_link' => Str::random(32)
        ]);
    }
}
