<?php

namespace Database\Seeders;

use App\Models\{
    Category,
    Plan,
    Product,
    Table,
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


        Tenant::factory(5)->create(['plan_id' => $plan->id])->each(function ($tenant) {
            Category::factory(5)->create(['tenant_id' => $tenant->id]);
            Table::factory(5)->create(['tenant_id' => $tenant->id]);
            Product::factory(5)->create(['tenant_id' => $tenant->id]);
        });
    }
}
