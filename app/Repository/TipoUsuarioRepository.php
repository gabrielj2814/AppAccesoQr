<?php

namespace App\Repository;

use App\Contracts\RepositoryBorradoSuave;
use App\Models\TipoUsuario;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TipoUsuarioRepository implements RepositoryBorradoSuave {

    function registrar(array $datos): Model{
        $tipoUsuario= new TipoUsuario();
        $tipoUsuario->nombre=$datos["nombre"];
        $tipoUsuario->status=$datos["status"];
        $tipoUsuario->save();
        return $tipoUsuario;
    }

    function actualizar(array $datos): Model
    {
        $tipoUsuario= $this->consultarPorId($datos["id_tipo_usuario"]);
        $tipoUsuario->nombre=$datos["nombre"];
        $tipoUsuario->status=$datos["status"];
        $tipoUsuario->save();
        return $tipoUsuario;
    }

    function consultarPorId(int $id): Model
    {
        return TipoUsuario::find($id);
    }

    function consultarTodo(): Collection
    {
        return TipoUsuario::all();
    }

    function eliminar(int $id): void
    {
        $tipoUsuario=$this->consultarPorId($id);
        $tipoUsuario->delete();
    }

    function consultarTodoDeLaPapelera(): Collection
    {
        return TipoUsuario::onlyTrashed()->get();
    }

    function consultarPorIdEnLaPapelera($id): Model
    {
        return TipoUsuario::onlyTrashed()->find($id);
    }

    function recuperarDeLaPapeleraPorId(int $id): Model
    {
        TipoUsuario::onlyTrashed()->find($id)->restore();
        return $this->consultarPorId($id);
    }

    function eliminarDeLaPapelera(int $id): void
    {
        TipoUsuario::onlyTrashed()->find($id)->forceDelete();
    }

    function consultarPorUnCampo(string $campo, string $condicion, $datoHaBuscar): Model|Collection
    {
        return TipoUsuario::where($campo, $condicion, $datoHaBuscar)->get();
    }

}


?>
