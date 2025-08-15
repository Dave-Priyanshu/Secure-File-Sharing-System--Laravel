<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'path',
        'token',
        'expires_at', // time
        'is_used', // bolean
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_used' => 'boolean',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sharedUsers(){
        return $this->belongsToMany(User::class, 'file_user');
    }
}
