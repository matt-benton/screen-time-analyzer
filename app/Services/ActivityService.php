<?php

namespace App\Services;

use App\Activity;
use App\Repositories\ActivityRepository;
use Illuminate\Http\Request;

class ActivityService
{
    public function __construct(ActivityRepository $activity)
    {
        $this->activity = $activity;
    }

    public function index()
    {
        return $this->activity->all();
    }

    public function create(Request $request)
    {
        return $this->activity->create($request->all());
    }

    public function show($id)
    {
        return $this->activity->find($id);
    }

    public function update(Request $request, $id)
    {
        return $this->activity->update($id, $request->all());
    }

    public function delete($id)
    {
        return $this->activity->delete($id);
    }
}
