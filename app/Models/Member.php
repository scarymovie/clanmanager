<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Member extends Model
{
    use HasFactory;
    use HasRoles;

    const MAIN = 'main';

    protected $fillable = [
        'user_id',
        'clan_id',
        'nickname',
        'rank'
    ];

    protected $guard_name = 'web';

    public function clan()
    {
        return $this->belongsTo(Clan::class);
    }

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public static function checkIfMasterNotExist(Clan $clan)
    {
        $master = $clan->members()->whereHas('roles', function ($query) {
            $query->where('name', 'Master');
        })->first();

        if ($master){
            throw new \Exception('Мастер уже существует');
        }

        return true;
    }

    public function attendedEvents($start_date = null, $end_date = null)
    {
        $query = $this->belongsToMany(Event::class, 'event_member_statuses')
            ->where('status', 'confirmed')
            ->withTimestamps();

        if ($start_date && $end_date) {
            $query->whereBetween('event_member_statuses.event_date', [ $start_date, $end_date]);
        }

        return $query;
    }

    public function attendedGvgs($start_date = null, $end_date = null)
    {
        $query = $this->belongsToMany(GuildWars::class, 'guild_wars_member_statuses')
            ->where('guild_wars.title', 'confirmed')
            ->withTimestamps();

        if ($start_date && $end_date) {
            $query->whereBetween('guild_wars_member_statuses.gvg_date', [ $start_date, $end_date]);
        }

        return $query;
    }

}
