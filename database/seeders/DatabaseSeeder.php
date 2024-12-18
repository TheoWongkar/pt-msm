<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Kpi;
use App\Models\KpiTotal;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Department::factory(4)->create();

        Employee::factory(3)->create();

        Kpi::factory(20)->create();

        KpiTotal::factory(5)->create();

        User::factory()->create([
            'employee_id' => 1,
            'name' => 'admin',
            'email' => 'admin@example.com',
        ]);

        User::factory(2)->create();
    }
}
