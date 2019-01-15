<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Glasses extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function segments()
    {
        return $this->hasMany('App\Segment');
    }
}
