<?php

use Faker\Generator as Faker;

$factory->define(App\Session::class, function (Faker $faker) {
    return [
        'date' => $faker->date,
        'daytime_id' => function () {
            return factory(App\Daytime::class)->create()->id;
        },
    ];
});

$factory->state(App\Session::class, 'same_user', function (Faker $faker) {
    return [
        'date' => $faker->date,
        'user_id' => 10000,
        'daytime_id' => function () {
            return factory(App\Daytime::class)->create()->id;
        },
    ];
});
