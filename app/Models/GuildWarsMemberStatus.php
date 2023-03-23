<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuildWarsMemberStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'clan_id',
        'guild_wars_id',
        'member_id',
        'character_id',
        'title',
        'party_leader_id',
        'note',
    ];
}
