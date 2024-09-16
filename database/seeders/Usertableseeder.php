<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class Usertableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user= [
            ['name' => 'Abid hasan', 'email' => 'abidhasanstudent20@gmail.com', 'password' => '1234'],
            ['name' => 'Mahmudul hasan', 'email' => 'Mahmudul@gmail.com', 'password' => '1234'],
            ['name' => 'sm Munna', 'email' => 'munna@gmail.com', 'password' => '1234'],
            ['name' => 'Tayben', 'email' => 'tayben@gmail.com', 'password' => '1234']
        ];
        User::insert($user);
    }
}
