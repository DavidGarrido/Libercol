<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Asset;
use App\Models\Inventary;
use App\Models\Point;

class InventaryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Inventary::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'point_id' => Point::factory(),
            'asset_id' => Asset::factory(),
            'units' => $this->faker->word,
            'max' => $this->faker->numberBetween(-10000, 10000),
            'min' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
