<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class QrUsuario extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_qr_usuario',
        'url_qr',
        'token_qr',
        'se_puede_vencer',
        'fecha_vencimiento',
        'status',
        'id_user',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_qr_usuario' => 'integer',
        'se_puede_vencer' => 'boolean',
        'fecha_vencimiento' => 'date',
        'status' => 'boolean',
        'id_user' => 'integer',
        'user_id' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function idUser(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
