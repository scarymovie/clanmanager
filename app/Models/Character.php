<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'nickname',
        'status',
        'character_type_id',
        'link',
        'note',
        'user_id'
    ];
}
