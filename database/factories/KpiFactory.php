<?php

namespace Database\Factories;

use App\Models\Kpi;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kpi>
 */
class KpiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Kpi::class;

    public function definition(): array
    {
        $weight = fake()->numberBetween(10, 100);
        $rating = fake()->numberBetween(1, 5);
        $value = ($weight / 100) * $rating;

        return [
            'employee_id' => Employee::inRandomOrder()->first()->id,
            'description' => fake()->sentence(),
            'weight' => $weight,
            'rating' => $rating,
            'value' => $value,
        ];
    }
}
