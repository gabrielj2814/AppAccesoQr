<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermisoPerfil extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_perfil',
        'status',
        'permiso_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_perfil' => 'integer',
        'status' => 'boolean',
        'permiso_id' => 'integer',
    ];

    public function permiso(): BelongsTo
    {
        return $this->belongsTo(Permiso::class);
    }

    public function perfil(): BelongsTo
    {
        return $this->belongsTo(Perfil::class, 'id_perfil', 'id_perfil');
    }
}
