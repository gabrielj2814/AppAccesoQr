<?php

namespace App\Repository;

use App\Contracts\RepositoryBorradoSuave;
use App\Models\Permiso;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PermisoRepository implements RepositoryBorradoSuave {

    function registrar(array $datos): Model{
        $permiso= new Permiso();
        $permiso->nombre=$datos["nombre"];
        $permiso->status=$datos["status"];
        $permiso->save();
        return $permiso;
    }

    function actualizar(array $datos): Model
    {
        $permiso= $this->consultarPorId($datos["id"]);
        $permiso->nombre=$datos["nombre"];
        $permiso->status=$datos["status"];
        $permiso->save();
        return $permiso;
    }

    function consultarPorId(int $id): Model | null
    {
        return Permiso::find($id);
    }

    function consultarTodo(): Collection
    {
        return Permiso::all();
    }

    function eliminar(int $id): void
    {
        $permiso=$this->consultarPorId($id);
        $permiso->delete();
    }

    function consultarTodoDeLaPapelera(): Collection
    {
        return Permiso::onlyTrashed()->get();
    }

    function consultarPorIdEnLaPapelera($id): Model | null
    {
        return Permiso::onlyTrashed()->find($id);
    }

    function recuperarDeLaPapeleraPorId(int $id): Model | null
    {
        Permiso::onlyTrashed()->find($id)->restore();
        return $this->consultarPorId($id);
    }

    function eliminarDeLaPapelera(int $id): void
    {
        Permiso::onlyTrashed()->find($id)->forceDelete();
    }

    function consultarPorUnCampo(string $campo, string $condicion, $datoHaBuscar): Model|Collection|null
    {
        return Permiso::where($campo, $condicion, $datoHaBuscar)->get();
    }


}


?>
