<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['name', 'description'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function segments()
    {
        return $this->hasMany('App\Segment');
    }

    public function calculateTotalTimeSpentByDate($date)
    {
        $segments = $this->segments()->whereDate('start', $date)->get();

        $total = 0;

        foreach ($segments as $segment) {
            $total += $segment->length();
        }

        return $total;
    }

    public function calculatePercentOfTotalTimeSpentByDate($date, $totalScreenTime)
    {
        return round(($this->calculateTotalTimeSpentByDate($date) / $totalScreenTime) * 100);
    }
}
