<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'apellido',
        'status',
    ];


    protected $table = "persona";
    protected $primaryKey = "id_persona";
    public $timestamps = true;
    public $incrementing = true;
    protected $keyType = "integer";

    public function usuarios(){
        return $this->hasMany(User::class,"id","id");
    }

}
