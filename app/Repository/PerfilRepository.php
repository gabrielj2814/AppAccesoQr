<?php

namespace App\Repository;

use App\Contracts\RepositoryBorradoSuave;
use App\Models\Perfil;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PerfilRepository implements RepositoryBorradoSuave{

    function registrar(array $datos): void{
        $perfil= new Perfil();
        $perfil->nombre=$datos["nombre"];
        $perfil->status=$datos["status"];
        $perfil->save();
    }

    function actualizar(array $datos): void
    {
        $perfil= $this->consultarPorId($datos["id_perfil"]);
        $perfil->nombre=$datos["nombre"];
        $perfil->status=$datos["status"];
        $perfil->save();
    }

    function consultarPorId(int $id): Model
    {
        return Perfil::find($id);
    }

    function consultarTodo(): Collection
    {
        return Perfil::all();
    }

    function eliminar(int $id): void
    {
        $perfil=$this->consultarPorId($id);
        $perfil->delete();
    }

    function consultarTodoDeLaPapelera(): Collection
    {
        return Perfil::onlyTrashed()->get();
    }

    function consultarPorIdEnLaPapelera($id): Model
    {
        return Perfil::onlyTrashed()->find($id);
    }

    function recuperarDeLaPapeleraPorId(int $id): Model
    {
        Perfil::onlyTrashed()->find($id)->restore();
        return $this->consultarPorId($id);
    }

    function eliminarDeLaPapelera(int $id): void
    {
        Perfil::onlyTrashed()->find($id)->forceDelete();
    }

    function consultarPorUnCampo(string $campo, string $condicion, $datoHaBuscar): Model|Collection
    {
        return Perfil::where($campo, $condicion, $datoHaBuscar)->get();
    }


}


?>
