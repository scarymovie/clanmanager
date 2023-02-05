<?php

namespace Database\Seeders;

use App\Models\CharactersType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CharactersTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $characters_type = [
            ['title' => 'Воин'],
            ['title' => 'Маг'],
            ['title' => 'Ганер'],

            ['title' => 'Оборотень'],
            ['title' => 'Друид'],
            ['title' => 'Обезьяна'],

            ['title' => 'Прист'],
            ['title' => 'Лучник'],
            ['title' => 'Паладин'],

            ['title' => 'Шаман'],
            ['title' => 'Син'],

            ['title' => 'Коса'],
            ['title' => 'Гост'],

            ['title' => 'Мистик'],
            ['title' => 'Сикер'],
        ];

        CharactersType::insert($characters_type);
    }
}
