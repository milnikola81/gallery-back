<?php

use Faker\Generator as Faker;
use App\Gallery;

$factory->define(App\Image::class, function (Faker $faker) {
    return [
        'image_url' => $faker->imageUrl($width = 640, $height = 480),
        'gallery_id' => $faker->numberBetween($min=1, $max=Gallery::count())
    ];
});
