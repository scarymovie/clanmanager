<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'start_date',
        'note',
        'points',
        'clan_id'
    ];

//    protected function startDate(): Attribute
//    {
//        return Attribute::make(
//            get: fn ($value, $attributes) => Carbon::create($value)->format('m.d.Y H:i'),
//            set: fn ($value, $attributes) => Carbon::create($value)->format('Y-m-d H:i')
//    );
//}

    public function status()
    {
        return $this->hasOne(EventMemberStatus::class);
    }

    public function weekday()
    {
        return $this->belongsTo(EventTiming::class, 'event_timing_id');
    }

//    protected function weekday(): Attribute
//    {
//        return Attribute::make(
//            get: function (string $value) {
//                return match ($value){
//                    '1' => 'Понедельник',
//                    '2' => 'Вторник',
//                    '3' => 'Среда',
//                    '4' => 'Четверг',
//                    '5' => 'Пятница',
//                    '6' => 'Суббота',
//                    '7' => 'Воскресенье',
//                };
//            },
//            set: function (string $value) {
//                return match ($value){
//                    'Понедельник' =>  '1',
//                    'Вторник' =>  '2',
//                    'Среда' =>  '3',
//                    'Четверг' =>  '4',
//                    'Пятница' =>  '5',
//                    'Суббота' =>  '6',
//                    'Воскресенье' =>  '7',
//                };
//            },
//        );
//    }
}
