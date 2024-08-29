<?php

namespace App\Repository;

use App\Contracts\RepositoryBorradoSuave;
use App\Models\Puerta;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PuertaRepository implements RepositoryBorradoSuave{

    function registrar(array $datos): Model{
        $puerta= new Puerta();
        $puerta->nombre=$datos["nombre"];
        $puerta->codigo=$datos["codigo"];
        $puerta->entrada=$datos["entrada"];
        $puerta->salida=$datos["salida"];
        $puerta->zona_id=$datos["zona_id"];
        $puerta->status=$datos["status"];
        $puerta->save();
        return $puerta;
    }

    function actualizar(array $datos): Model
    {
        $puerta= $this->consultarPorId($datos["id"]);
        $puerta->nombre=$datos["nombre"];
        $puerta->codigo=$datos["codigo"];
        $puerta->entrada=$datos["entrada"];
        $puerta->salida=$datos["salida"];
        $puerta->zona_id=$datos["zona_id"];
        $puerta->status=$datos["status"];
        $puerta->save();
        return $puerta;
    }

    function consultarPorId(int $id): Model | null
    {
        return Puerta::find($id);
    }

    function consultarTodo(): Collection
    {
        return Puerta::all();
    }

    function eliminar(int $id): void
    {
        $puerta=$this->consultarPorId($id);
        $puerta->delete();
    }

    function consultarTodoDeLaPapelera(): Collection
    {
        return Puerta::onlyTrashed()->get();
    }

    function consultarPorIdEnLaPapelera($id): Model | null
    {
        return Puerta::onlyTrashed()->find($id);
    }

    function recuperarDeLaPapeleraPorId(int $id): Model | null
    {
        Puerta::onlyTrashed()->find($id)->restore();
        return $this->consultarPorId($id);
    }

    function eliminarDeLaPapelera(int $id): void
    {
        Puerta::onlyTrashed()->find($id)->forceDelete();
    }

    function consultarPorUnCampo(string $campo, string $condicion, $datoHaBuscar): Model|Collection
    {
        return Puerta::where($campo, $condicion, $datoHaBuscar)->get();
    }


}

?>
