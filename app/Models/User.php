<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'id_persona',
        'id_tipo_usuario',
        'id_perfil',
        'password',
        'pin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function perfil(){
        return $this->belongsTo(Perfil::class,"id_perfil","id_perfil");
    }

    public function tipoUsuario(){
        return $this->belongsTo(TipoUsuario::class,"id_tipo_usuario","id_tipo_usuario");
    }

    public function persona(){
        return $this->belongsTo(Persona::class,"id_persona","id_persona");
    }

    public function qrusuario(){
        return $this->belongsTo(QrUsuario::class,"user_id","id");
    }

    public function acceso(){
        return $this->hasMany(AccesoUsuario::class,"user_id","id");
    }

}
