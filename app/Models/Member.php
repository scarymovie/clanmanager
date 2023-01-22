<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'clan_id',
        'nickname',
        'rank'
    ];

    public function clan()
    {
        return $this->belongsTo(Clan::class);
    }

    public static function checkIfMasterNotExist(Clan $clan)
    {
        if ($clan->members()->where('rank', 'Мастер')->exists()){
            throw new \Exception('Мастер уже существует');
        }

        return true;
    }
}
