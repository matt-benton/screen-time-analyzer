<?php

use Faker\Generator as Faker;

$factory->define(App\Monitor::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
    ];
});
