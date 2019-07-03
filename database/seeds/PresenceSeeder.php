<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PresenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\Schedule::all()->each(function($schedule){
        factory(\App\Presence::class, 20)
          ->make()
          ->each(function($presence) use($schedule){
            $faker = Faker\Factory::create();
            $presence->schedule_id = $schedule->id;
            $type = $faker->randomElement(['student', 'lecturer']);
            if($type == 'student'){
              $presence->student_id = \App\Student::inRandomOrder()->first()->id;
            }
            if($type == 'lecturer'){
              $presence->lecturer_id = \App\Lecturer::inRandomOrder()->first()->id;
            }
            $presence->date = Carbon::now()->startOfWeek(Carbon::SUNDAY)->addDay($schedule->day)->toDateString();

            //Calculation of entry hour
            $schedule_entry = new Carbon($schedule->entry_hour);
            $presence->entry_hour = $schedule_entry->addMinute($faker->numberBetween(-30, 30))->format('h:i A');

            $presence->save();
        });
      }); 
    }
}
