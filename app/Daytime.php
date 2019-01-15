<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daytime extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function sessions()
    {
        return $this->hasMany('App\Session');
    }
}
