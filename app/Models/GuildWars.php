<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GuildWarsMemberStatus;

class GuildWars extends Model
{
    use HasFactory;

    protected $fillable = [
        'clan_id',
        'title',
        'note',
        'date',
        'points'
    ];

    public function guildWarMemberStatuses()
    {
        return $this->hasMany(GuildWarsMemberStatus::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'guild_wars_member_statuses');
    }
}
