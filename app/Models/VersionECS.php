<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VersionECS extends Model
{
    protected $table = "version_ecs";
    protected $primaryKey = "Id";
    public $timestamps = false;

    public static function Agregar(VersionECS $ObjECS)
    {
        return $ObjECS->save();
    }

    public static function ListarPorCronogramaEC($CronogramaECId)
    {
        return VersionECS::where('ElementoConfiguracionId',$CronogramaECId)->get();
    }

    public static function ObtenerPorId($Id){
        return VersionECS::find($Id);
    }

    //Relations
    public function CronogramaEC(){
        return $this->hasOne('App\Models\CronogramaElementoConfiguracion', 'Id','ElementoConfiguracionId');
    }

}
