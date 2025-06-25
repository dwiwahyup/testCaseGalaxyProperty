<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'employee_number' => $this->faker->unique()->numerify('EMP-#####'),
            'bank_account_number' => $this->faker->bankAccountNumber(),
            'bank_name' => $this->faker->company(),
            'base_salary' => $this->faker->randomFloat(0, 3000000, 10000000), // in IDR, no decimals
        ];
    }
}
