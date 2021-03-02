<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\File;

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'format' => $this->faker->randomElement(["image","doc","pdf","url"]),
            'type' => $this->faker->randomElement(["transaccion","perfil","producto","rut","cedula","camara","ref_comercial","ref_personal","ref_bancaria","cer_libertad","balance","tarjeta_profesional","extecto","nit"]),
            'route' => $this->faker->word,
            'comment' => $this->faker->text,
            'modeltable_type' => $this->faker->word,
            'modeltable_id' => $this->faker->randomNumber(),
        ];
    }
}
