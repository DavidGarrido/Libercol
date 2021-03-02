<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Bank;
use App\Models\Wallettype;

class WallettypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wallettype::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(["efectivo","ahorros","daviplata","nequi","movi","ticket","credito"]),
            'bank_id' => Bank::factory(),
            'limit' => $this->faker->numberBetween(-100000, 100000),
        ];
    }
}
