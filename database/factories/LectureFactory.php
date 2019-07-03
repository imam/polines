<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Lecture;
use Faker\Generator as Faker;

$factory->define(Lecture::class, function (Faker $faker) {
    return [
        'lecture_id' => $faker->numberBetween(1000000, 99999999),
        'name' => $faker->sentence,
        'sks' => $faker->numberBetween(1, 4)
    ];
});
