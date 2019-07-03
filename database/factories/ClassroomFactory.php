<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Classroom;
use Faker\Generator as Faker;

$factory->define(Classroom::class, function (Faker $faker) {
    return [
    'classroom_id' => $faker->numberBetween(1000000, 99999999),
    /* 'day' => $faker->randomElement('Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'), */
    'name' => $faker->company,
    'location' => $faker->address
    ];
});
