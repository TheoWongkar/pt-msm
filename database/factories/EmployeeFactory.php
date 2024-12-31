<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'department_id' => Department::inRandomOrder()->first()->id,
            'nik' => fake()->unique()->numberBetween(10000000, 99999999),
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'date_of_birth' => fake()->date(),
            'gender' => fake()->randomElement(['Pria', 'Wanita']),
            'position' => fake()->jobTitle(),
            'date_of_entry' => fake()->date(),
            'profile_picture' => fake()->imageUrl(400, 400, 'people', true, 'Faker'),
        ];
    }
}
