<?php

namespace Database\Factories;

use App\Models\Niveau;
use Illuminate\Database\Eloquent\Factories\Factory;

class NiveauFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Niveau::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'libele' => $this->faker->unique()->word,
            'program_id' => $this->faker->numberBetween(1,3),
        ];
    }
}
