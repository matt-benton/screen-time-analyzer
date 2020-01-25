<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use App\Session;
use App\EyeCondition;
use App\Segment;
use App\User;

class SessionTest extends TestCase
{
    use RefreshDatabase;

    protected $sessionService;

    public function setUp()
    {
        parent::setUp();

        $this->sessionService = $this->app->make('App\Services\SessionService');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTotalScreenTime()
    {
        $user = factory(User::class)->create();
        $activity = $user->activities()->first();
        $glasses = $user->glasses()->first();
        $monitor = $user->monitors()->first();
        $seat = $user->seats()->first();
        $eyeCondition = factory(EyeCondition::class)->create();

        $session = $user->sessions()->save(
            factory(Session::class)->make([
                'date' => '2019-01-19'
            ])
        );

        $segment1 = new Segment;
        $segment1->start = new Carbon('2019-01-19 4:24 pm');
        $segment1->end = new Carbon('2019-01-19 4:44 pm');
        $segment1->activity_id = $activity->id;
        $segment1->glasses_id = $glasses->id;
        $segment1->seat_id = $seat->id;
        $segment1->eye_condition_id = $eyeCondition->id;

        $segment2 = new Segment;
        $segment2->start = new Carbon('2019-01-19 5:00 pm');
        $segment2->end = new Carbon('2019-01-19 5:28 pm');
        $segment2->activity_id = $activity->id;
        $segment2->glasses_id = $glasses->id;
        $segment2->seat_id = $seat->id;
        $segment2->eye_condition_id = $eyeCondition->id;

        $session->segments()->saveMany([$segment1, $segment2]);

        $segment1->monitors()->attach($monitor);
        $segment2->monitors()->attach($monitor);

        $this->assertEquals(48, $session->totalScreenTime());
    }

    public function testGetScreenTimeByDate()
    {
        $user = factory(User::class)->create();
        $activity = $user->activities()->first();
        $glasses = $user->glasses()->first();
        $monitor = $user->monitors()->first();
        $seat = $user->seats()->first();
        $eyeCondition = factory(EyeCondition::class)->create();

        $sessions = $user->sessions()->saveMany([
            factory(Session::class)->make([
                'date' => '2019-04-22'
            ]),
            factory(Session::class)->make([
                'date' => '2019-04-24'
            ]),
            factory(Session::class)->make([
                'date' => '2019-04-25'
            ])
        ]);

        $segment1 = new Segment;
        $segment1->start = new Carbon('2019-04-22 10:38 am');
        $segment1->end = new Carbon('2019-04-22 11:01 am');
        $segment1->activity_id = $activity->id;
        $segment1->glasses_id = $glasses->id;
        $segment1->seat_id = $seat->id;
        $segment1->eye_condition_id = $eyeCondition->id;

        $sessions[0]->segments()->save($segment1);
        $segment1->monitors()->save($monitor);


        $segment2 = new Segment;
        $segment2->start = new Carbon('2019-04-24 9:00 am');
        $segment2->end = new Carbon('2019-04-24 9:30 am');
        $segment2->activity_id = $activity->id;
        $segment2->glasses_id = $glasses->id;
        $segment2->seat_id = $seat->id;
        $segment2->eye_condition_id = $eyeCondition->id;

        $sessions[1]->segments()->save($segment2);
        $segment2->monitors()->save($monitor);

        $segment3 = new Segment;
        $segment3->start = new Carbon('2019-04-25 1:00 pm');
        $segment3->end = new Carbon('2019-04-25 1:45 pm');
        $segment3->activity_id = $activity->id;
        $segment3->glasses_id = $glasses->id;
        $segment3->seat_id = $seat->id;
        $segment3->eye_condition_id = $eyeCondition->id;

        $sessions[2]->segments()->save($segment3);
        $segment3->monitors()->save($monitor);

        $this->assertEquals(98, $this->sessionService->getScreenTimeByDateRange($user, new Carbon('2019-04-22'), new Carbon('2019-04-25')));
    }
}
