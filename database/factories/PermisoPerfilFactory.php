<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Perfil;
use App\Models\Permiso;
use App\Models\PermisoPerfil;

class PermisoPerfilFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PermisoPerfil::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id_permiso_perfil' => $this->faker->randomNumber(),
            'id_perfil' => Perfil::factory()->create()->id_perfil,
            'id_permiso' => Permiso::factory()->create()->id_permiso,
            'status' => $this->faker->boolean(),
        ];
    }
}
