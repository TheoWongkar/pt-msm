<?php

namespace Database\Factories;

use App\Models\KpiTotal;
use App\Models\Employee;
use App\Models\Kpi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KpiTotal>
 */
class KpiTotalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = KpiTotal::class;

    public function definition(): array
    {
        return [
            'employee_id' => Employee::inRandomOrder()->first()->id,
            'value' => Kpi::where('employee_id', Employee::inRandomOrder()->first()->id)->sum('value'),
        ];
    }
}
