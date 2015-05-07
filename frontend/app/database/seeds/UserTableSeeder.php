<?php

class UserTableSeeder extends Seeder
{

public function run()
{
    DB::table('user')->delete();
    User::create(array(
        'email'    => 'msaadat@vtc.edu',
        'username' => 'msaadat',
        'password' => Hash::make('mahdi1234'),
        'first_name'     => 'Mahdi',
        'last_name'     => 'Saadat',
        'admin'     => true,
        'active'     => true
    ));
}

}