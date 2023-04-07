<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function status()
    {
        return $this->hasOne(GuildWarsMemberStatus::class, );
    }
}
