<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Userdata;

class UserdataFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Userdata::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'stature' => $this->faker->numberBetween(-10000, 10000),
            'weight' => $this->faker->numberBetween(-10000, 10000),
            'size' => $this->faker->word,
            'gender' => $this->faker->randomElement(["masculino","femenino"]),
            'type_document' => $this->faker->randomElement(["cc","ce","ti","rc","pp"]),
            'number_document' => $this->faker->numberBetween(-100000, 100000),
            'modeltable_type' => $this->faker->word,
            'modeltable_id' => $this->faker->randomNumber(),
        ];
    }
}
