<?php

namespace App;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function daytime()
    {
        return $this->belongsTo('App\Daytime');
    }

    public function segments()
    {
        return $this->hasMany('App\Segment');
    }

    // start time of earliest segment
    public function start()
    {
        return new Carbon($this->segments()->select('start')->orderBy('start')->value('start'));
    }

    // end time of the latest segment
    public function end()
    {
        return new Carbon($this->segments()->select('end')->orderBy('end', 'desc')->value('end'));
    }

    public function startFormatted()
    {
        return $this->start()->format('g:i a');
    }

    public function endFormatted()
    {
        return $this->end()->format('g:i a');
    }

    // length of time from start to finish, including breaks
    public function length()
    {
        return $this->end()->diffInMinutes($this->start());
    }

    public function lengthFormatted()
    {
        return $this->end()->diffInMinutes($this->start()) . " minutes";
    }

    // the sum of the length of each segment
    public function totalScreenTime()
    {
        $total = 0;

        foreach ($this->segments as $segment) {
            $total += $segment->length();
        }

        return $total;
    }
}
