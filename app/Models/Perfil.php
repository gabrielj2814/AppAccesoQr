<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perfil extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'status',
    ];

    protected $table = "perfil";
    protected $primaryKey = "id_perfil";
    public $timestamps = true;
    public $incrementing = true;
    protected $keyType = "integer";

    public function PermisoPerfil(){
        return $this->hasMany(PermisoPerfil::class,"id_perfil","id_perfil");
    }

    public function usuarios(){
        return $this->hasMany(User::class,"id","id");
    }

}
