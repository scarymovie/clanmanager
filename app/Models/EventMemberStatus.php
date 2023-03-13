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
        'character_id',
        'event_date',
        'party_leader_id',
        'note'
    ];

    public function events()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
