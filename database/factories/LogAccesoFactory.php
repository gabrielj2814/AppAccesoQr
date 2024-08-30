<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\LogAcceso;
use App\Models\Puerta;
use App\Models\QrUsuario;
use App\Models\User;

class LogAccesoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LogAcceso::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'mensaje' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'fecha' => $this->faker->date(),
            'hora' => $this->faker->time(),
            'lado' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'qr_usuario_id' => QrUsuario::factory(),
            'puerta_id' => Puerta::factory(),
            'user_id' => User::factory(),
        ];
    }
}
