<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EyeCondition extends Model
{
    public function segments()
    {
        return $this->hasMany('App\Segment');
    }
}
