<?php

namespace App\Services;

use App\Segment;
use App\Repositories\SegmentRepository;
use Illuminate\Http\Request;

class SegmentService
{
    public function __construct(SegmentRepository $segment)
    {
        $this->segment = $segment;
    }

    public function create(Request $request, $session_id)
    {
        return $this->segment->create($request, $session_id);
    }

    public function totalScreenTime($segments)
    {
        $total = 0;

        foreach ($segments as $segment) {
            $total += $segment->length();
        }

        return $total;
    }
}
