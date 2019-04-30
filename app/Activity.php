<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;

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

    public function calculateTotalTimeSpentByDate(Carbon $date)
    {
        $segments = $this->segments()->whereDate('start', $date)->get();

        return $this->calculateTotalScreenTime($segments);
    }

    public function calculateTotalTimeSpentByDateRange(Carbon $start, Carbon $end)
    {
        $segments = $this->segments()->whereBetween('start', [$start->startOfDay(), $end->endOfDay()])->get();

        return $this->calculateTotalScreenTime($segments);
    }

    public function calculatePercentOfTotalTimeSpentByDate(Carbon $date)
    {
        $segments = Auth::user()->segments()->whereDate('start', $date)->get();

        $totalScreenTime = $totalScreenTime = $this->calculateTotalScreenTime($segments);

        return round(($this->calculateTotalTimeSpentByDate($date) / $totalScreenTime) * 100);
    }

    public function calculatePercentOfTotalTimeSpentByDateRange(Carbon $start, Carbon $end)
    {
        $segments = Auth::user()->segments()
            ->where('start', '>=', $start)
            ->where('end', '<=', $end)
            ->get();

        $totalScreenTime = $this->calculateTotalScreenTime($segments);

        if ($totalScreenTime === 0) {
            return 0;
        }

        return round(($this->calculateTotalTimeSpentByDateRange($start, $end) / $totalScreenTime) * 100);
    }

    private function calculateTotalScreenTime($segments)
    {
        if (count($segments) === 0) {
            return 0;
        }

        $totalScreenTime = 0;

        foreach ($segments as $segment) {
            $totalScreenTime += $segment->length();
        }

        return $totalScreenTime;
    }
}
