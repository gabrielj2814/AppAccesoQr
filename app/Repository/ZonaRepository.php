<?php

namespace App\Repository;

use App\Contracts\RepositoryBorradoSuave;
use App\Models\Zona;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ZonaRepository implements RepositoryBorradoSuave{


    function registrar(array $datos): Model{
        $zona= new Zona();
        $zona->nombre=$datos["nombre"];
        $zona->numero_puertas=$datos["numero_puertas"];
        $zona->horario_de_acceso_de_la_zona=$datos["horario_de_acceso_de_la_zona"];
        $zona->horario_de_cierre_de_la_zona=$datos["horario_de_cierre_de_la_zona"];
        $zona->status=$datos["status"];
        $zona->save();
        return $zona;
    }

    function actualizar(array $datos): Model
    {
        $zona= $this->consultarPorId($datos["id"]);
        $zona->nombre=$datos["nombre"];
        $zona->numero_puertas=$datos["numero_puertas"];
        $zona->horario_de_acceso_de_la_zona=$datos["horario_de_acceso_de_la_zona"];
        $zona->horario_de_cierre_de_la_zona=$datos["horario_de_cierre_de_la_zona"];
        $zona->status=$datos["status"];
        $zona->save();
        return $zona;
    }

    function consultarPorId(int $id): Model | null
    {
        return Zona::find($id);
    }

    function consultarTodo(): Collection
    {
        return Zona::all();
    }

    function eliminar(int $id): void
    {
        $zona=$this->consultarPorId($id);
        $zona->delete();
    }

    function consultarTodoDeLaPapelera(): Collection
    {
        return Zona::onlyTrashed()->get();
    }

    function consultarPorIdEnLaPapelera($id): Model | null
    {
        return Zona::onlyTrashed()->find($id);
    }

    function recuperarDeLaPapeleraPorId(int $id): Model | null
    {
        Zona::onlyTrashed()->find($id)->restore();
        return $this->consultarPorId($id);
    }

    function eliminarDeLaPapelera(int $id): void
    {
        Zona::onlyTrashed()->find($id)->forceDelete();
    }

    function consultarPorUnCampo(string $campo, string $condicion, $datoHaBuscar): Model|Collection
    {
        return Zona::where($campo, $condicion, $datoHaBuscar)->get();
    }


}



?>
