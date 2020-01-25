<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use App\Activity;
use App\Daytime;
use App\EyeCondition;
use App\Glasses;
use App\Monitor;
use App\Seat;
use App\Segment;
use App\Session;
use App\User;

class ActivityTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTotalTimeSpentByDateRange()
    {
        $user = factory(User::class)->create();

        $glasses = factory(Glasses::class)->create([
            'user_id' => $user->id
        ]);

        $monitor = factory(Monitor::class)->create([
            'user_id' => $user->id
        ]);

        $activity = factory(Activity::class)->create([
            'user_id' => $user->id
        ]);

        $seat = factory(Seat::class)->create([
            'user_id' => $user->id
        ]);

        $eyeCondition = factory(EyeCondition::class)->create();

        $daytime = new Daytime;
        $daytime->name = 'Test';
        $daytime->save();

        $session1 = new Session;
        $session1->date = '2019-01-22';
        $session1->daytime_id = $daytime->id;
        $session1->user_id = $user->id;
        $session1->save();

        $session2 = new Session;
        $session2->date = '2019-01-23';
        $session2->daytime_id = $daytime->id;
        $session2->user_id = $user->id;
        $session2->save();

        $session3 = new Session;
        $session3->date = '2019-01-25';
        $session3->daytime_id = $daytime->id;
        $session3->user_id = $user->id;
        $session3->save();

        $session4 = new Session;
        $session4->date = '2019-01-30';
        $session4->daytime_id = $daytime->id;
        $session4->user_id = $user->id;
        $session4->save();

        $segment1 = new Segment;
        $segment1->session_id = $session1->id;
        $segment1->start = new Carbon('2019-01-22 9:00 pm');
        $segment1->end = new Carbon('2019-01-22 9:28 pm');
        $segment1->glasses_id = $glasses->id;
        $segment1->seat_id = $seat->id;
        $segment1->eye_condition_id = $eyeCondition->id;

        $segment2 = new Segment;
        $segment2->session_id = $session2->id;
        $segment2->start = new Carbon('2019-01-23 11:15 am');
        $segment2->end = new Carbon('2019-01-23 11:45 am');
        $segment2->glasses_id = $glasses->id;
        $segment2->seat_id = $seat->id;
        $segment2->eye_condition_id = $eyeCondition->id;

        $segment3 = new Segment;
        $segment3->session_id = $session3->id;
        $segment3->start = new Carbon('2019-01-25 10:01 am');
        $segment3->end = new Carbon('2019-01-25 10:27 am');
        $segment3->glasses_id = $glasses->id;
        $segment3->seat_id = $seat->id;
        $segment3->eye_condition_id = $eyeCondition->id;

        // This segment will be outside of the date range used in the query
        $segment4 = new Segment;
        $segment4->session_id = $session4->id;
        $segment4->start = new Carbon('2019-01-30 3:41 pm');
        $segment4->end = new Carbon('2019-01-30 4:10 pm');
        $segment4->glasses_id = $glasses->id;
        $segment4->seat_id = $seat->id;
        $segment4->eye_condition_id = $eyeCondition->id;

        $activity->segments()->saveMany([$segment1, $segment2, $segment3, $segment4]);

        $segment1->monitors()->attach($monitor);
        $segment2->monitors()->attach($monitor);
        $segment3->monitors()->attach($monitor);
        $segment4->monitors()->attach($monitor);

        $this->assertEquals(84, $activity->calculateTotalTimeSpentByDateRange(new Carbon('2019-01-22'), new Carbon('2019-01-29')));
    }
}
