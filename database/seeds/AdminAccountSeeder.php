<?php

use Illuminate\Database\Seeder;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'email'=>'admin@gmail.com',
            'name'=>'Admin',
            'password'=>bcrypt('42839lpo'),
            'role'=>'admin'
        ]);
    }
}
