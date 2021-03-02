<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Address;
use App\Models\Contact;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tel' => $this->faker->numberBetween(-100000, 100000),
            'cel_one' => $this->faker->numberBetween(-100000, 100000),
            'cel_two' => $this->faker->numberBetween(-100000, 100000),
            'whatsapp' => $this->faker->numberBetween(-100000, 100000),
            'telegram' => $this->faker->numberBetween(-100000, 100000),
            'facebook' => $this->faker->word,
            'instagram' => $this->faker->word,
            'twitter' => $this->faker->word,
            'linkedin' => $this->faker->word,
            'email' => $this->faker->safeEmail,
            'web' => $this->faker->word,
            'address_id' => Address::factory(),
            'modeltable_type' => $this->faker->word,
            'modeltable_id' => $this->faker->randomNumber(),
        ];
    }
}
