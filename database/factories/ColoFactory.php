<?php

use Faker\Generator as Faker;

$factory->define(App\ColorCode::class, function (Faker $faker) {
    return [
        'color' => $faker->colorName,
        'slug' => $faker->safeColorName,
        'code' => $faker->hexcolor,
    ];
});
