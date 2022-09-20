<?php

use Illuminate\Database\Seeder;
use App\User;

class userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Ahmed';
        $user->email = 'Ahmed@gmail.com';
       // $user->Department = 'Medical';
        $user->level = 'Admin';
        $user->password = bcrypt(12345678);

        $user->save();

    }
}
