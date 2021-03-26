<?php

namespace Database\Seeders;

use App\Models\{
    Category,
    Plan,
    Tenant
};
use Illuminate\Database\Seeder;

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
            'name' => 'EspecializaTi',
            'url' => 'especializati',
            'email' => 'carlos@especializati.com.br',
        ]);


        Tenant::factory(5)->create()->each(function ($tenant) {
            Category::factory(5)->create(['tenant_id' => $tenant->id]);
        });
    }
}
