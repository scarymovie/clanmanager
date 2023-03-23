<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'title',
        'invite_link'
    ];

    public function getRouteKeyName()
    {
        return 'title';
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
