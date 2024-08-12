<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Zona;

class ZonaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Zona::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id_zona' => $this->faker->randomNumber(),
            'nombre' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'numero_puertas' => $this->faker->numberBetween(-10000, 10000),
            'horario_de_acceso_de_la_zona' => $this->faker->time(),
            'status' => $this->faker->boolean(),
        ];
    }
}
