<?php

namespace Database\Seeders;

use App\Repository\PerfilRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InicializarDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function __construct(
        protected PerfilRepository $PerfilRepository
    ) {}

    public function run(): void
    {
        //
        if(count($this->PerfilRepository->consultarPorUnCampo("nombre","=","Root"))==0){
            $datosPerfil=[
                "nombre" => "Root",
                "status" => true,
            ];
            $this->PerfilRepository->registrar($datosPerfil);
        }


    }
}
