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
        $user->lastName = 'Mustermann';
        $user->age = 23;
        $user->education = 'FH Hagenberg, Software Engineering';
        $user->isTeacher = true;
        $user->save();

        $user1 = new \App\Models\User;
        $user1->email = 'nadinedurstberger@gmail.com';
        $user1->password = bcrypt('secret');
        $user1->firstName = 'Nadine';
        $user1->lastName = 'Durstberger';
        $user1->age = 23;
        $user1->education = 'FH Hagenberg, Kommunikation Wissen Medien';
        $user1->isTeacher = false;
        $user1->save();

        $user2 = new \App\Models\User;
        $user2->email = 'verenaschickmair@gmail.com';
        $user2->password = bcrypt('secret');
        $user2->firstName = 'Verena';
        $user2->lastName = 'Schickmair';
        $user2->age = 23;
        $user2->education = 'FH Hagenberg, Interactive Media';
        $user2->isTeacher = true;
        $user2->save();

        $user3 = new \App\Models\User;
        $user3->email = 'raphaelabrueckl@gmail.com';
        $user3->password = bcrypt('secret');
        $user3->firstName = 'Raphaela';
        $user3->lastName = 'Brückl';
        $user3->age = 23;
        $user3->education = 'FH Salzburg, Interaction Design';
        $user3->isTeacher = false;
        $user3->save();
    }
}
