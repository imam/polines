<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'student_id' => $faker->numberBetween(1000000, 99999999),
        'class' => 'AA',
        'name' => $faker->name,
    ];
});
