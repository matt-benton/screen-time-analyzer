<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function daytimes()
    {
        return $this->hasMany('App\Daytime');
    }

    public function sessions()
    {
        return $this->hasMany('App\Session');
    }

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function glasses()
    {
        return $this->hasMany('App\Glasses');
    }

    public function monitors()
    {
        return $this->hasMany('App\Monitor');
    }

    public function seats()
    {
        return $this->hasMany('App\Seat');
    }

    public function symptoms()
    {
        return $this->hasMany('App\Symptom');
    }

    public function segments()
    {
        return $this->hasManyThrough('App\Segment', 'App\Session');
    }
}
