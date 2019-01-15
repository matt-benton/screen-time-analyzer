<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function segments()
    {
        return $this->belongsToMany('App\Segment');
    }
}
