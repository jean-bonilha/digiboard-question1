<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'name',
    ];

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
}
