<?php

namespace Database\Seeders;

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
        $user = new \App\Models\User;
        $user->email = 'testuser@gmail.com';
        $user->password = bcrypt('secret');
        $user->firstName = 'Max';
        $user->lastName = 'Musermann';
        $user->age = 23;
        $user->education = 'FH Hagenberg, Software Engineering';
        $user->isTeacher = true;
        $user->save();
    }
}
