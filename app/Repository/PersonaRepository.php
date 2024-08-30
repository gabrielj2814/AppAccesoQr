<?php

namespace App\Repository;

use App\Contracts\RepositoryBorradoSuave;
use App\Models\Persona;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PersonaRepository implements RepositoryBorradoSuave {

    function registrar(array $datos): Model{
        $persona= new Persona();
        $persona->nombre=$datos["nombre"];
        $persona->apellido=$datos["apellido"];
        $persona->status=$datos["status"];
        $persona->save();
        return $persona;
    }

    function actualizar(array $datos): Model
    {
        $persona= $this->consultarPorId($datos["id_persona"]);
        $persona->nombre=$datos["nombre"];
        $persona->apellido=$datos["apellido"];
        $persona->status=$datos["status"];
        $persona->save();
        return $persona;
    }

    function consultarPorId(int $id): Model | null
    {
        return Persona::find($id);
    }

    function consultarTodo(): Collection
    {
        return Persona::all();
    }

    function eliminar(int $id): void
    {
        $persona=$this->consultarPorId($id);
        $persona->delete();
    }

    function consultarTodoDeLaPapelera(): Collection
    {
        return Persona::onlyTrashed()->get();
    }

    function consultarPorIdEnLaPapelera($id): Model | null
    {
        return Persona::onlyTrashed()->find($id);
    }

    function recuperarDeLaPapeleraPorId(int $id): Model | null
    {
        Persona::onlyTrashed()->find($id)->restore();
        return $this->consultarPorId($id);
    }

    function eliminarDeLaPapelera(int $id): void
    {
        Persona::onlyTrashed()->find($id)->forceDelete();
    }

    function consultarPorUnCampo(string $campo, string $condicion, $datoHaBuscar): Model|Collection|null
    {
        return Persona::where($campo, $condicion, $datoHaBuscar)->get();
    }

}



