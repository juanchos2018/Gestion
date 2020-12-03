<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantillaElementoConfiguracion extends Model
{
    protected $table = "plantilla_elemento_configuracion";
    protected $primaryKey = 'Id';
    public $timestamps = false;

    public static function Agregar(PlantillaElementoConfiguracion $ObjPECS)
    {
        if($ObjPECS->save())
        {
            return $ObjPECS->Id;
        }
        return 0;
    }

    public static function Listar()
    {
        return PlantillaElementoConfiguracion::all();
    }

    public static function Eliminar(PlantillaElementoConfiguracion $ObjPECS)
    {
        return $ObjPECS->delete();
    }

    public static function ObtenerPorId($PECSId)
    {
        return PlantillaElementoConfiguracion::find($PECSId);
    }

    public function ElementoConfiguracion()
    {
        return $this->belongsTo('App\Models\ElementoConfiguracion', 'ElementoConfiguracionId');
    }
}
