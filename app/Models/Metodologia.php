<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metodologia extends Model
{
    protected $table = 'metodologia';
    protected $primaryKey = 'Id';
    public $timestamps = false;


    public static function Agregar(Metodologia $ObjMetodologia)
    {
        if($ObjMetodologia->save())
        {
            return $ObjMetodologia->Id;
        }
        return 0;
    }

    public static function Editar(Metodologia $ObjMetodologia)
    {
        if($ObjMetodologia->update())
        {
            return $ObjMetodologia->Id;
        }
        return 0;
    }

    public static function Eliminar(Metodologia $ObjMetodologia)
    {
        return $ObjMetodologia->delete();
    }

    public static function Listar()
    {
        return Metodologia::all();
    }

    public static function ObtenerPorId($MetodologiaId)
    {
        return Metodologia::find($MetodologiaId);
    }
}
