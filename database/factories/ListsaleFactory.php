<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Feature;
use App\Models\Listsale;

class ListsaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Listsale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'feature_id' => Feature::factory(),
            'value' => $this->faker->numberBetween(-100000, 100000),
            'state' => $this->faker->randomElement(["activo","inactivo"]),
            'utc_start' => $this->faker->numberBetween(-100000, 100000),
            'utc_end' => $this->faker->numberBetween(-100000, 100000),
        ];
    }
}
