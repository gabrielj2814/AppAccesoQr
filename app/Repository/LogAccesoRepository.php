<?php

namespace App\Repository;

use App\Contracts\RepositoryBorradoSuave;
use App\Models\LogAcceso;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class LogAccesoRepository implements RepositoryBorradoSuave {


    function registrar(array $datos): Model{
        $logAcceso= new LogAcceso();
        $logAcceso->mensaje=$datos["mensaje"];
        $logAcceso->fecha=$datos["fecha"];
        $logAcceso->hora=$datos["hora"];
        $logAcceso->lado=$datos["lado"];
        $logAcceso->qr_usuario_id=$datos["qr_usuario_id"];
        $logAcceso->puerta_id=$datos["puerta_id"];
        $logAcceso->user_id=$datos["user_id"];
        $logAcceso->save();
        return $logAcceso;
    }

    function actualizar(array $datos): Model
    {
        $logAcceso= $this->consultarPorId($datos["id_logAcceso"]);
        if($logAcceso){
            $logAcceso->mensaje=$datos["mensaje"];
            $logAcceso->fecha=$datos["fecha"];
            $logAcceso->hora=$datos["hora"];
            $logAcceso->lado=$datos["lado"];
            $logAcceso->qr_usuario_id=$datos["qr_usuario_id"];
            $logAcceso->puerta_id=$datos["puerta_id"];
            $logAcceso->user_id=$datos["user_id"];
            $logAcceso->save();
            return $logAcceso;
        }
        else{
            return null;
        }
    }

    function consultarPorId(int $id): Model | null
    {
        return LogAcceso::find($id);
    }

    function consultarTodo(): Collection
    {
        return LogAcceso::all();
    }

    function eliminar(int $id): void
    {
        $logAcceso=$this->consultarPorId($id);
        $logAcceso->delete();
    }

    function consultarTodoDeLaPapelera(): Collection
    {
        return LogAcceso::onlyTrashed()->get();
    }

    function consultarPorIdEnLaPapelera($id): Model | null
    {
        return LogAcceso::onlyTrashed()->find($id);
    }

    function recuperarDeLaPapeleraPorId(int $id): Model | null
    {
        LogAcceso::onlyTrashed()->find($id)->restore();
        return $this->consultarPorId($id);
    }

    function eliminarDeLaPapelera(int $id): void
    {
        LogAcceso::onlyTrashed()->find($id)->forceDelete();
    }

    function consultarPorUnCampo(string $campo, string $condicion, $datoHaBuscar): Model|Collection|null
    {
        return LogAcceso::where($campo, $condicion, $datoHaBuscar)->get();
    }





}




?>
