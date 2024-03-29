<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'libele' => $this->faker->word(),
            'dividente' =>  rand(5, 20),
            'activitable_id' => $this->faker->randomNumber(),
            'activitable_type' => '\App\Classe',
        ];
    }
}
