<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventMemberStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'clan_id',
        'member_id',
        'status',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
