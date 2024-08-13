<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\QrUsuario;
use App\Models\User;

class QrUsuarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QrUsuario::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'url_qr' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'token_qr' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'se_puede_vencer' => $this->faker->boolean(),
            'fecha_vencimiento' => $this->faker->date(),
            'status' => $this->faker->boolean(),
            'id_user' => User::factory(),
            'user_id' => User::factory(),
        ];
    }
}
