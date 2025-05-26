<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Department;
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
    public function definition()
    {
        return [
            'firstName' => fake()->firstName(),
            'lastName' => fake()->lastName(),
            'email' => fake()->email(),
            'phoneNumber'=>fake()->phoneNumber(),
           'department_id'=>Department::inRandomOrder()->first()->department_id,
        ];
    }
}
