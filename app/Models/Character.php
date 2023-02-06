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
        'member_id'
    ];

    public function type()
    {
        return $this->belongsTo(CharactersType::class, 'character_type_id');
    }
}
