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

    public function heatmapCounter(int $minutes)
    {
        $hours = $minutes / 60;

        if ($hours < 2) {
            return '1';
        } else if ($hours < 4) {
            return '2';
        } else if ($hours < 6) {
            return '3';
        } else if ($hours > 6) {
            return '4';
        }
    }
}
