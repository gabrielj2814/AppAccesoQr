<?php

namespace App\Repository;

use App\Contracts\RepositoryBorradoSuave;
use App\Models\AccesoUsuario;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AccesoUsuarioRepository implements RepositoryBorradoSuave {


    function registrar(array $datos): Model{
        $acceso= new AccesoUsuario();
        $acceso->user_id=$datos["user_id"];
        $acceso->zona_id=$datos["zona_id"];
        $acceso->save();
        return $acceso;
    }

    function actualizar(array $datos): Model
    {
        $acceso= $this->consultarPorId($datos["id"]);
        $acceso->user_id=$datos["user_id"];
        $acceso->zona_id=$datos["zona_id"];
        $acceso->save();
        return $acceso;
    }

    function consultarPorId(int $id): Model | null
    {
        return AccesoUsuario::find($id);
    }

    function consultarTodo(): Collection
    {
        return AccesoUsuario::all();
    }

    function eliminar(int $id): void
    {
        $acceso=$this->consultarPorId($id);
        $acceso->delete();
    }

    function consultarTodoDeLaPapelera(): Collection
    {
        return AccesoUsuario::onlyTrashed()->get();
    }

    function consultarPorIdEnLaPapelera($id): Model | null
    {
        return AccesoUsuario::onlyTrashed()->find($id);
    }

    function recuperarDeLaPapeleraPorId(int $id): Model
    {
        AccesoUsuario::onlyTrashed()->find($id)->restore();
        return $this->consultarPorId($id);
    }

    function eliminarDeLaPapelera(int $id): void
    {
        AccesoUsuario::onlyTrashed()->find($id)->forceDelete();
    }

    function consultarPorUnCampo(string $campo, string $condicion, $datoHaBuscar): Model|Collection|null
    {
        return AccesoUsuario::where($campo, $condicion, $datoHaBuscar)->get();
    }

    function consultarPorIdZonaYIdUser(string $zona_id,string $user_id): Model|null
    {
        return AccesoUsuario::where("zona_id","=",$zona_id)->where("user_id","=",$user_id)->first();
    }


}




?>
