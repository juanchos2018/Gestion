<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElementoConfiguracion extends Model
{
    protected $table = "elemento_configuracion";
    protected $primaryKey = 'Id';
    public $timestamps = false;

    public static function Agregar(ElementoConfiguracion $ObjEcs)
    {
        if($ObjEcs->save())
        {
            return $ObjEcs->Id;
        }
        return 0;
    }

    public static function Editar(ElementoConfiguracion $ObjEcs)
    {
        if($ObjEcs->update())
        {
            return $ObjEcs->Id;
        }
        return 0;
    }

    public static function Eliminar(ElementoConfiguracion $ObjEcs)
    {
        return $ObjEcs->delete();
    }

    public static function Listar()
    {
        return ElementoConfiguracion::all();
    }

    public static function ObtenerPorId($EcsId)
    {
        return ElementoConfiguracion::find($EcsId);
    }
}
