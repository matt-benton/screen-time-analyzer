<?php

use Faker\Generator as Faker;

$factory->define(App\Segment::class, function (Faker $faker) {
    return [
        'start' => $faker->dateTime,    // these dates are random and probably need to
        'end' => $faker->dateTime,      // be changed to represent a segment accurately
    ];
});
