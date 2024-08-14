<?php

namespace Database\Seeders;

use App\Repository\PerfilRepository;
use App\Repository\PersonaRepository;
use App\Repository\TipoUsuarioRepository;
use App\Repository\UsuarioRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InicializarDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function __construct(
        protected PerfilRepository $PerfilRepository,
        protected TipoUsuarioRepository $TipoUsuarioRepository,
        protected PersonaRepository $PersonaRepository,
        protected UsuarioRepository $UsuarioRepository,
    ) {}

    public function run(): void
    {
        //
        $perfil=null;
        $tipoUsuario=null;
        $persona=null;
        $usuario=null;
        if(count($this->PerfilRepository->consultarPorUnCampo("nombre","=","Root"))==0){
            $datos=[
                "nombre" => "Root",
                "status" => true,
            ];
            $perfil=$this->PerfilRepository->registrar($datos);
        }

        if(count($this->TipoUsuarioRepository->consultarPorUnCampo("nombre","=","web master"))==0){
            $datos=[
                "nombre" => "web master",
                "status" => true,
            ];
            $tipoUsuario=$this->TipoUsuarioRepository->registrar($datos);
        }

        if(count($this->PersonaRepository->consultarPorUnCampo("nombre","=","Nombre Roo"))==0){
            $datos=[
                "nombre" => "Nombre Root",
                "apellido" => "Apellido Root",
                "status" => true,
            ];
            $persona=$this->PersonaRepository->registrar($datos);
        }

        if(count($this->UsuarioRepository->consultarPorUnCampo("name","=","Root"))==0){
            $datos=[
                "name" => "Root",
                "email" => "root@gmail.com",
                "id_perfil" => $perfil->id_perfil,
                "id_persona" => $persona->id_persona,
                "id_tipo_usuario" => $tipoUsuario->id_tipo_usuario,
                "status" => true,
            ];
            $usuario=$this->UsuarioRepository->registrar($datos);
            $actualizarClave=[
                "id" => $usuario->id,
                "password" => env("CLAVE_ADMIN_DEFAULT"),
            ];
            $usuario=$this->UsuarioRepository->actualizarClave($actualizarClave);
        }


    }
}
