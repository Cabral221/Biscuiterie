<?php

namespace Database\Factories;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'birthday' => Carbon::now()->subYears(10),
            'where_birthday' => $this->faker->city,
            'kind' => $this->faker->boolean(),
            'address' => $this->faker->address,
            'father_name' => $this->faker->firstName,
            'father_phone' => $this->faker->numberBetween(700000000, 789999999),
            'mother_first_name' => $this->faker->firstName,
            'mother_last_name' => $this->faker->lastName,
            'mother_phone' => $this->faker->numberBetween(700000000, 789999999),
            'classe_id' => $this->faker->numberBetween(1, 12),
        ];
    }
}
