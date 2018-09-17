<?php

use Faker\Generator as Faker;
use App\Gallery;
use App\User;

$factory->define(Gallery::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'description' => $faker->sentences($nb = 3, $asText = false),
        'user_id' => $faker->numberBetween($min = 1, $max = User::count())
    ];
});
