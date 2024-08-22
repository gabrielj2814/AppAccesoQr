<?php

use App\Contracts\RepositoryBorradoSuave;
use App\Models\PermisoPerfil;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PermisoPerfilRepository implements RepositoryBorradoSuave {

    function registrar(array $datos): Model{
        $permisoPerfil= new PermisoPerfil();
        $permisoPerfil->id_perfil=$datos["id_perfil"];
        $permisoPerfil->id_permiso=$datos["id_permiso"];
        $permisoPerfil->status=$datos["status"];
        $permisoPerfil->save();
        return $permisoPerfil;
    }

    function actualizar(array $datos): Model
    {
        $permisoPerfil= $this->consultarPorId($datos["id"]);
        $permisoPerfil->id_perfil=$datos["id_perfil"];
        $permisoPerfil->id_permiso=$datos["id_permiso"];
        $permisoPerfil->status=$datos["status"];
        $permisoPerfil->save();
        return $permisoPerfil;
    }

    function consultarPorId(int $id): Model
    {
        return PermisoPerfil::find($id);
    }

    function consultarTodo(): Collection
    {
        return PermisoPerfil::all();
    }

    function eliminar(int $id): void
    {
        $permisoPerfil=$this->consultarPorId($id);
        $permisoPerfil->delete();
    }

    function consultarTodoDeLaPapelera(): Collection
    {
        return PermisoPerfil::onlyTrashed()->get();
    }

    function consultarPorIdEnLaPapelera($id): Model
    {
        return PermisoPerfil::onlyTrashed()->find($id);
    }

    function recuperarDeLaPapeleraPorId(int $id): Model
    {
        PermisoPerfil::onlyTrashed()->find($id)->restore();
        return $this->consultarPorId($id);
    }

    function eliminarDeLaPapelera(int $id): void
    {
        PermisoPerfil::onlyTrashed()->find($id)->forceDelete();
    }

    function consultarPorUnCampo(string $campo, string $condicion, $datoHaBuscar): Model|Collection
    {
        return PermisoPerfil::where($campo, $condicion, $datoHaBuscar)->get();
    }


}


?>
