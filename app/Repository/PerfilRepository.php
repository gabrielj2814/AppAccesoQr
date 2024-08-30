<?php

namespace App\Repository;

use App\Contracts\RepositoryBorradoSuave;
use App\Models\Perfil;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PerfilRepository implements RepositoryBorradoSuave{

    function registrar(array $datos): Model{
        $perfil= new Perfil();
        $perfil->nombre=$datos["nombre"];
        $perfil->status=$datos["status"];
        $perfil->save();
        return $perfil;
    }

    function actualizar(array $datos): Model
    {
        $perfil= $this->consultarPorId($datos["id_perfil"]);
        if($perfil){
            $perfil->nombre=$datos["nombre"];
            $perfil->status=$datos["status"];
            $perfil->save();
            return $perfil;
        }
        else{
            return null;
        }
    }

    function consultarPorId(int $id): Model | null
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

    function consultarPorIdEnLaPapelera($id): Model | null
    {
        return Perfil::onlyTrashed()->find($id);
    }

    function recuperarDeLaPapeleraPorId(int $id): Model | null
    {
        Perfil::onlyTrashed()->find($id)->restore();
        return $this->consultarPorId($id);
    }

    function eliminarDeLaPapelera(int $id): void
    {
        Perfil::onlyTrashed()->find($id)->forceDelete();
    }

    function consultarPorUnCampo(string $campo, string $condicion, $datoHaBuscar): Model|Collection|null
    {
        return Perfil::where($campo, $condicion, $datoHaBuscar)->get();
    }


}


?>
