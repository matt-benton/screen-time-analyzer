<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    protected $dates = [
        'start',
        'end',
    ];

    public function session()
    {
        return $this->belongsTo('App\Session');
    }

    public function activity()
    {
        return $this->belongsTo('App\Activity');
    }

    public function eyeCondition()
    {
        return $this->belongsTo('App\EyeCondition');
    }

    public function glasses()
    {
        return $this->belongsTo('App\Glasses');
    }

    public function monitor()
    {
        return $this->belongsTo('App\Monitor');
    }

    public function monitors()
    {
        return $this->belongsToMany('App\Monitor');
    }

    public function symptoms()
    {
        return $this->belongsToMany('App\Symptom');
    }

    public function seat()
    {
        return $this->belongsTo('App\Seat');
    }

    // return the length of time between the start and the end
    public function length()
    {
        return $this->end->diffInMinutes($this->start);
    }

    public function lengthFormatted()
    {
        return $this->end->diffInMinutes($this->start) . " minutes";
    }

    public function startDate()
    {
        return $this->start->toDateString();
    }

    // this takes the length of a segment and finds what percentage of time it took compared to the day's total screen time
    public function calculatePercentageOfDailyScreenTime(int $totalScreenTime)
    {
        return ($this->length() / $totalScreenTime) * 100;
    }
}
