<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Gallery::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'description' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
        'user_id' => $faker->numberBetween($min=1, $max=User::count()),
    ];
});
