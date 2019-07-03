<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Lecturer;
use Faker\Generator as Faker;

$factory->define(Lecturer::class, function (Faker $faker) {
    return [
        'lecturer_id' => $faker->numberBetween(1000000, 99999999),
        'name' => $faker->name,
    ];
});
