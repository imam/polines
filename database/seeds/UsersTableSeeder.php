<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 50)->create()->each(function ($user) {
            if($user->NIM) {
                $student = factory(App\Student::class)->make();
                $student->NIM = $user->NIM;
                $student->save();
            }
            if($user->NIP) {
                $lecturer = factory(App\Lecturer::class)->make();
                $lecturer->NIP = $user->NIP;
                $lecturer->save();
            }
        });
    }
}
