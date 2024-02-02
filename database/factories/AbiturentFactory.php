<?php

namespace Database\Factories;

use App\Models\Abiturent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Abiturent>
 */
class AbiturentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Abiturent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'gender' => $this->faker->randomElement([0, 1]),
            'group_number' => $this->faker->numberBetween(1000, 9999),
            'total_ege' => $this->faker->numberBetween(0, 400),
            'date_of_birth' => $this->faker->date,
            'phone_number' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            // Add other fields as needed
        ];
    }
}
