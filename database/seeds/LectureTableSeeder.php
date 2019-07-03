<?php

use Illuminate\Database\Seeder;

class LectureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Lecture::class, 50)->create();
    }
}
