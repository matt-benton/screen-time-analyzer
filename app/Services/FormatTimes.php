<?php

namespace App\Services;

use Carbon\Carbon;

class FormatTimes
{
    public function hoursAndMinutes(int $minutes)
    {
        if ($minutes < 60) {
            return $minutes . " min";
        } else {
            $hours = floor($minutes / 60) . " hr, ";
            $minutes = $minutes % 60 . " min";
            return $hours . $minutes;
        }
    }
}
