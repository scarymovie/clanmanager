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
        $timings = [
            ['day_number' => 1, 'title' => 'Понедельник', 'time' => '21:00']
        ];

        $events = [
            ['clan_id' => null, 'title' => 'Ивент 1', 'note' => '', 'event_timing_id' => '1', 'start_date' => '2023-02-01'],
            ['clan_id' => null, 'title' => 'Ивент 2', 'note' => '', 'event_timing_id' => '1', 'start_date' => '2023-02-02'],
            ['clan_id' => null, 'title' => 'Ивент 3', 'note' => '', 'event_timing_id' => '1', 'start_date' => '2023-02-03'],
            ['clan_id' => null, 'title' => 'Ивент 4', 'note' => '', 'event_timing_id' => '1', 'start_date' => '2023-02-04'],
            ['clan_id' => null, 'title' => 'Ивент 5', 'note' => '', 'event_timing_id' => '1', 'start_date' => '2023-02-05'],
            ['clan_id' => null, 'title' => 'Ивент 6', 'note' => '', 'event_timing_id' => '1', 'start_date' => '2023-02-01'],
            ['clan_id' => null, 'title' => 'Ивент 7', 'note' => '', 'event_timing_id' => '1', 'start_date' => '2023-02-02'],
        ];
        EventTiming::insert($timings);
        Event::insert($events);
    }
}
