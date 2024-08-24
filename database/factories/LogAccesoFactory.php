<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\LogAcceso;
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
            'fecha' => $this->faker->date(),
            'hora' => $this->faker->time(),
            'qr_usuario_id' => QrUsuario::factory(),
            'user_id' => User::factory(),
        ];
    }
}
