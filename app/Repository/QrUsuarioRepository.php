<?php

namespace App\Repository;

use App\Contracts\RepositoryBorradoSuave;
use App\Models\QrUsuario;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class QrUsuarioRepository implements RepositoryBorradoSuave{

    function registrar(array $datos): Model{
        $QrUsuario= new QrUsuario();
        $QrUsuario->uuid=$datos["uuid"];
        $QrUsuario->user_id=$datos["user_id"];
        $QrUsuario->token_qr=$datos["token_qr"];
        if(array_key_exists("se_puede_vencer",$datos)){
            $QrUsuario->se_puede_vencer=$datos["se_puede_vencer"];
        }
        if(array_key_exists("fecha_vencimiento",$datos)){
            $QrUsuario->fecha_vencimiento=$datos["fecha_vencimiento"];
        }
        $QrUsuario->status=$datos["status"];
        $QrUsuario->save();
        return $QrUsuario;
    }

    function actualizar(array $datos): Model
    {
        $QrUsuario= $this->consultarPorId($datos["id_persona"]);
        $QrUsuario->uuid=$datos["uuid"];
        $QrUsuario->user_id=$datos["user_id"];
        $QrUsuario->token_qr=$datos["token_qr"];
        if(array_key_exists("se_puede_vencer",$datos)){
            $QrUsuario->se_puede_vencer=$datos["se_puede_vencer"];
        }
        if(array_key_exists("fecha_vencimiento",$datos)){
            $QrUsuario->fecha_vencimiento=$datos["fecha_vencimiento"];
        }
        $QrUsuario->status=$datos["status"];
        $QrUsuario->save();
        return $QrUsuario;
    }

    function consultarPorId(int $id): Model
    {
        return QrUsuario::find($id);
    }

    function consultarTodo(): Collection
    {
        return QrUsuario::all();
    }

    function eliminar(int $id): void
    {
        $QrUsuario=$this->consultarPorId($id);
        $QrUsuario->delete();
    }

    function consultarTodoDeLaPapelera(): Collection
    {
        return QrUsuario::onlyTrashed()->get();
    }

    function consultarPorIdEnLaPapelera($id): Model
    {
        return QrUsuario::onlyTrashed()->find($id);
    }

    function recuperarDeLaPapeleraPorId(int $id): Model
    {
        QrUsuario::onlyTrashed()->find($id)->restore();
        return $this->consultarPorId($id);
    }

    function eliminarDeLaPapelera(int $id): void
    {
        QrUsuario::onlyTrashed()->find($id)->forceDelete();
    }

    function consultarPorUnCampo(string $campo, string $condicion, $datoHaBuscar): Model|Collection
    {
        return QrUsuario::where($campo, $condicion, $datoHaBuscar)->get();
    }

    function consultarPorIdYOrdenarPor(string $campo,string $datoHaBuscar,string $campoPorOrdenar, string $ordenarPor,): Model|Collection
    {
        return QrUsuario::where($campo,$datoHaBuscar)->OrderBy($campoPorOrdenar, $ordenarPor)->get();
    }



}




?>
