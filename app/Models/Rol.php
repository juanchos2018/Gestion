<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected  $primaryKey ="Id";
    protected $table = 'rol';
    public $timestamps = false;

    public static function Agregar(Rol $ObjRol)
    {
        if($ObjRol->save())
        {
            return $ObjRol->Id;
        }
        return 0;
    }

    public static function Editar(Rol $ObjRol)
    {
        if($ObjRol->update())
        {
            return $ObjRol->Id;
        }
        return 0;
    }

    public static function Listar()
    {
        return Rol::all();
    }

    public static function ObtenerPorId($RolId)
    {
        return Rol::find($RolId);
    }
}

?>