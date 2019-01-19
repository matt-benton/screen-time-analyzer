<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Session;
use Carbon\Carbon;
use App\EyeCondition;
use App\Segment;

class SessionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTotalScreenTime()
    {
        $eyeCondition = factory(EyeCondition::class)->create();
        $session = factory(Session::class)->create();
        $user = $session->user;
        $activity = $user->activities()->first();
        $glasses = $user->glasses()->first();
        $monitor = $user->monitors()->first();
        $seat = $user->seats()->first();

        $segment1 = new Segment;
        $segment1->start = new Carbon('2019-01-19 4:24 pm');
        $segment1->end = new Carbon('2019-01-19 4:44 pm');
        $segment1->activity_id = $activity->id;
        $segment1->glasses_id = $glasses->id;
        $segment1->monitor_id = $monitor->id;
        $segment1->seat_id = $seat->id;
        $segment1->eye_condition_id = $eyeCondition->id;

        $segment2 = new Segment;
        $segment2->start = new Carbon('2019-01-19 5:00 pm');
        $segment2->end = new Carbon('2019-01-19 5:28 pm');
        $segment2->activity_id = $activity->id;
        $segment2->glasses_id = $glasses->id;
        $segment2->monitor_id = $monitor->id;
        $segment2->seat_id = $seat->id;
        $segment2->eye_condition_id = $eyeCondition->id;

        $session->segments()->saveMany([$segment1, $segment2]);

        $this->assertEquals(48, $session->totalScreenTime());
    }
}
