<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoUsuario extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'status',
    ];

    protected $table = "tipo_usuario";
    protected $primaryKey = "id_tipo_usuario";
    public $timestamps = true;
    public $incrementing = true;
    protected $keyType = "integer";

    public function usuarios(){
        return $this->hasMany(User::class,"id","id");
    }

}
