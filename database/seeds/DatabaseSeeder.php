<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(LectureTableSeeder::class);
        $this->call(ClassroomTableSeeder::class);
        $this->call(ScheduleTableSeeder::class);
        $this->call(PresenceSeeder::class);
    }
}
