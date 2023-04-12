<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventTiming;
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
            ['clan_id' => 1, 'title' => 'Ивент 1', 'note' => '', 'start_date' => '2023-02-01'],
            ['clan_id' => 1, 'title' => 'Ивент 2', 'note' => '', 'start_date' => '2023-02-02'],
            ['clan_id' => 1, 'title' => 'Ивент 3', 'note' => '', 'start_date' => '2023-02-03'],
            ['clan_id' => 1, 'title' => 'Ивент 4', 'note' => '', 'start_date' => '2023-02-04'],
            ['clan_id' => 1, 'title' => 'Ивент 5', 'note' => '', 'start_date' => '2023-02-05'],
            ['clan_id' => 1, 'title' => 'Ивент 6', 'note' => '', 'start_date' => '2023-02-01'],
            ['clan_id' => 1, 'title' => 'Ивент 7', 'note' => '', 'start_date' => '2023-02-02'],
        ];
        Event::insert($events);
    }
}
