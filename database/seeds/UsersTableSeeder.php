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
        \App\Models\User::create([
            'name' => 'Diogo Ferreira',
            'email' => 'diogo.f.m.7@gmail.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
