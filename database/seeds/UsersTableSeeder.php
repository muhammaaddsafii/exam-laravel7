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
        \App\User::create([
            'name' => 'The Rotten Bug',
            'username' => 'therottenbug',
            'email' => 'therottenbug.com',
            'password' => bcrypt('password')
        ]);
    }
}
