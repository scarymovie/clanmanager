<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = [
            ['clan_id' => null, 'title' => 'Ивент 1', 'weekday' => 'Понедельник', 'time' => '21:00', 'note' => ''],
            ['clan_id' => null, 'title' => 'Ивент 2', 'weekday' => 'Вторник', 'time' => '20:20', 'note' => ''],
            ['clan_id' => null, 'title' => 'Ивент 3', 'weekday' => 'Среда', 'time' => '20:00', 'note' => ''],
            ['clan_id' => null, 'title' => 'Ивент 4', 'weekday' => 'Четверг', 'time' => '19:50', 'note' => ''],
            ['clan_id' => null, 'title' => 'Ивент 5', 'weekday' => 'Суббота', 'time' => '22:00', 'note' => ''],
        ];
        Event::insert($events);
    }
}
