<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Wallet;
use App\Models\Walletmoviment;

class WalletmovimentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Walletmoviment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value' => $this->faker->numberBetween(-100000, 100000),
            'interest' => $this->faker->numberBetween(-100000, 100000),
            'utc_start' => $this->faker->numberBetween(-100000, 100000),
            'utc_end' => $this->faker->numberBetween(-100000, 100000),
            'type' => $this->faker->randomElement(["inc","dec"]),
            'state' => $this->faker->randomElement(["aprobado","desaprobado"]),
            'wallet_id' => Wallet::factory(),
        ];
    }
}
