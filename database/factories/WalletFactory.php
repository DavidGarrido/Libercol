<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Wallet;
use App\Models\Wallettype;

class WalletFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wallet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'modeltable_type' => $this->faker->word,
            'modeltable_id' => $this->faker->randomNumber(),
            'wallettype_id' => Wallettype::factory(),
        ];
    }
}
