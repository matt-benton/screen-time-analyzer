<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Segment;
use Carbon\Carbon;

class SegmentTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLength()
    {
        $segment = new Segment;
        $segment->start = new Carbon('2019-01-19 5:00 pm');
        $segment->end = new Carbon('2019-01-19 5:28 pm');
        $this->assertEquals(28, $segment->length());
    }
}
