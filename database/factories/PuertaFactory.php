<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Puerta;
use App\Models\Zona;

class PuertaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Puerta::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'codigo' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'entrada' => $this->faker->boolean(),
            'salida' => $this->faker->boolean(),
            'status' => $this->faker->boolean(),
            'zona_id' => Zona::factory(),
        ];
    }
}
