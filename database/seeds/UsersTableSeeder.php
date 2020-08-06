<?php

use Illuminate\Database\Seeder;
use App\Models\{
    User,
    Tenant
};

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();

        $tenant->users()->create([
            'name' => 'Diogo Ferreira',
            'email' => 'diogo.f.m.7@gmail.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
