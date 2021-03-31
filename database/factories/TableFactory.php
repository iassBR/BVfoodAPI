<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class TableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Table::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tenant_id' => Tenant::factory()->create()->id,
            'identify' => Str::random(5).uniqid(),
            'description' => $this->faker->sentence,
        ];
    }
}


