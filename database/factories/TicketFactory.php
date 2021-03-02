<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Point;
use App\Models\Ticket;
use App\Models\User;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total' => $this->faker->numberBetween(-100000, 100000),
            'utc' => $this->faker->numberBetween(-100000, 100000),
            'point_id' => Point::factory(),
            'creator_id' => User::factory(),
            'vendor_id' => User::factory(),
        ];
    }
}
