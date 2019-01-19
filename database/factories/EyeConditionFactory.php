<?php

use Faker\Generator as Faker;

$factory->define(App\EyeCondition::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'definition' => $faker->sentence,
        'numeric_value' => 0,
    ];
});
