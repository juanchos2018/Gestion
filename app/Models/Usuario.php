<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected  $primaryKey ="Id";
    protected $table = 'usuario';
    public $timestamps = false;

    public static function Agregar(Usuario $ObjUsuario)
    {
        if($ObjUsuario->save())
        {
            return $ObjUsuario->Id;
        }
        return 0;
    }

    public static function Editar(Usuario $ObjUsuario)
    {
        if($ObjUsuario->update())
        {
            return $ObjUsuario->Id;
        }
        return 0;
    }

    public static function Listar()
    {
        return Usuario::all();
    }

    public static function ObtenerPorId($UsuarioId)
    {
        return Usuario::find($UsuarioId);
    }
    
}

?>