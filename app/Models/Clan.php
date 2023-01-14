<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title'
    ];

    public function getRouteKeyName()
    {
        return 'title';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
