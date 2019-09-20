<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'number',
        'identification',
        'name',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
