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

    // public function index()
    // {
    //     return $this->segment->all();
    // }

    public function create(Request $request, $session_id)
    {
        return $this->segment->create($request, $session_id);
    }

    // public function show($id)
    // {
    //     return $this->segment->find($id);
    // }

    // public function update(Request $request, $id)
    // {
    //     return $this->segment->update($id, $request->all());
    // }

    // public function delete($id)
    // {
    //     return $this->segment->delete($id);
    // }
}
