<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    protected  $primaryKey ="Id";
    protected $table = 'tipo_usuario';
    public $timestamps = false;

    public static function Listar()
    {
        return TipoUsuario::all();
    }
}
