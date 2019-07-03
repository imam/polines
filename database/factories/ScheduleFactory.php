<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Schedule;
use Faker\Generator as Faker;

$factory->define(Schedule::class, function (Faker $faker) {
    return [
        'schedule_id' => $faker->numberBetween(1000000, 99999999),
        'day' => $faker->numberBetween(0, 6),
        'entry_hour' => $faker->numberBetween(1,12).':00'.$faker->randomElement(['am', 'pm']),
        'lecture_id' => App\Lecture::inRandomOrder()->first()->id,
        'lecturer_id' => App\Lecturer::inRandomOrder()->first()->id,
        'classroom_id' => App\Classroom::inRandomOrder()->first()->id,
    ];
});
