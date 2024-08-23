<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\AccesoUsuario;
use App\Models\User;
use App\Models\Zona;

class AccesoUsuarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AccesoUsuario::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id_user' => User::factory(),
            'id_zona' => Zona::factory(),
            'fecha' => $this->faker->date(),
            'hora' => $this->faker->time(),
        ];
    }
}
