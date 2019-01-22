<?php

namespace App\Repositories;

use App\Activity;
use Auth;

class ActivityRepository
{

    protected $activity;



    public function __construct(Activity $activity)
    {
        $this->activity = $activity;
    }

    public function create($attributes)
    {
        return Auth::user()->activities()->create($attributes);
    }

    public function all()
    {
        return Auth::user()->activities;
    }

    public function find($id)
    {
        return Auth::user()->activities()->where('id', $id)->first();
    }

    public function update($id, array $attributes)
    {
        return Auth::user()->activities()->where('id', $id)->first()->update($attributes);
    }

    public function delete($id)
    {
        return Auth::user()->activities()->where('id', $id)->delete();
    }
}
