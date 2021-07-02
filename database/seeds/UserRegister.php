<?php

use Illuminate\Database\Seeder;
use App\User;
class UserRegister extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Testing',
            'email' => 'testing@mail.com',
            'password' => Hash::make('testing456'),
        ]);
    }
}
