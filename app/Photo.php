<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'person_id',
        'path_storage',
    ];

    public function person()
    {
        return $this->belongsTo('App\Person');
    }
}
