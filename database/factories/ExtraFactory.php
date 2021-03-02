<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Extra;
use App\Models\Ticket;

class ExtraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Extra::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'concept' => $this->faker->word,
            'value' => $this->faker->numberBetween(-10000, 10000),
            'percent' => $this->faker->numberBetween(-10000, 10000),
            'type' => $this->faker->randomElement(["inc","dec"]),
            'ticket_id' => Ticket::factory(),
        ];
    }
}
