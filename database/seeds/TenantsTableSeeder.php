<?php

use Illuminate\Database\Seeder;
use App\Models\{
    Plan,
    Tenant
};

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();

        $plan->tenants()->create([
            'cnpj' => '23882706000120',
            'name' => 'Diogo Ferreira Food',
            'url' => 'diogoferreirafood',
            'email' => 'contato@diogofmedeiros.com'
        ]);
    }
}
