<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zona extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'horario_de_acceso_de_la_zona',
        'horario_de_cierre_de_la_zona',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'status' => 'boolean',
    ];

    public function puertas(): HasMany
    {
        return $this->hasMany(Puerta::class);
    }

    public function accesoUsuarios(): HasMany
    {
        return $this->hasMany(AccesoUsuario::class);
    }
}
