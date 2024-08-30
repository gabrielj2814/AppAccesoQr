<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogAcceso extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mensaje',
        'fecha',
        'hora',
        'lado',
        'qr_usuario_id',
        'puerta_id',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fecha' => 'date',
        'qr_usuario_id' => 'integer',
        'puerta_id' => 'integer',
        'user_id' => 'integer',
    ];

    public function qrUsuario(): BelongsTo
    {
        return $this->belongsTo(QrUsuario::class);
    }

    public function puerta(): BelongsTo
    {
        return $this->belongsTo(Puerta::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
