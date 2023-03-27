<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Member extends Model
{
    use HasFactory;
    use HasRoles;

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
        if ($clan->members()->where('rank', 'Мастер')->exists()){
            throw new \Exception('Мастер уже существует');
        }

        return true;
    }
}
