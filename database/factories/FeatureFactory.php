<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Color;
use App\Models\Feature;
use App\Models\Inventary;
use App\Models\Material;

class FeatureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Feature::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reference' => $this->faker->word,
            'weight' => $this->faker->randomFloat(1, 0, 999999999.9),
            'size' => $this->faker->word,
            'width' => $this->faker->numberBetween(-10000, 10000),
            'height' => $this->faker->numberBetween(-10000, 10000),
            'texture' => $this->faker->word,
            'inventary_id' => Inventary::factory(),
            'color_id' => Color::factory(),
            'material_id' => Material::factory(),
        ];
    }
}
