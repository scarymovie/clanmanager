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
        return $this->hasMany(EventMemberStatus::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'event_member_statuses')
            ->withPivot('status', 'event_date')
            ->withTimestamps();
    }

}
