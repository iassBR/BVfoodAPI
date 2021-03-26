<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class TenantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tenant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->company;
        return [
            'cnpj' => $this->faker->cnpj,
            'name' => $name,
            'email' => $this->faker->unique()->safeEmail,
            'plan_id' => Plan::factory()->create()->id,
        ];
    }
}
