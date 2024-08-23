<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccesoUsuario extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user',
        'id_zona',
        'fecha',
        'hora',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_user' => 'integer',
        'id_zona' => 'integer',
        'fecha' => 'date',
    ];

    public function idUser(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function idZona(): BelongsTo
    {
        return $this->belongsTo(Zona::class);
    }
}
