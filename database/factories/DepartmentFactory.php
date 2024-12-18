<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Department::class;

    public function definition(): array
    {
        $departments = ['IT', 'HR', 'Finance', 'Marketing'];

        $index = session('department_index', 0);
        $name = $departments[$index];
        session(['department_index' => ($index + 1) % count($departments)]);

        return [
            'name' => $name,
        ];
    }
}
