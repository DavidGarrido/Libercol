<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\Score;

class ScoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Score::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sales' => $this->faker->randomNumber(),
            'profit' => $this->faker->randomNumber(),
            'starts' => $this->faker->randomNumber(),
            'client_id' => Client::factory(),
        ];
    }
}
