<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class CronogramaFase extends Model
{
    protected $table = 'cronograma_fase';
    protected $primaryKey = 'Id';
    public $timestamps = false;

    public static function ListarPorMetodologiaId($MetodologiaId)
    {
        $ListadoMetodologiaFase = Fase::where('MetodologiaId',$MetodologiaId)->get();
        foreach ($ListadoMetodologiaFase as $ObjMetodologiaFase){
            $ObjMetodologiaFase->ListadoElementoConfiguracion = PlantillaElementoConfiguracion::where('FaseId',$ObjMetodologiaFase->Id)->get();
        }

        return $ListadoMetodologiaFase;
    }

    public static function ListarPorCronogramaId($CronogramaId){

        $ListadoCronogramaFase = CronogramaFase::where('CronogramaId',$CronogramaId)->get();
        $ListadoCronogramaFase2 = $ListadoCronogramaFase->map(function($ObjCronogramaFase){
            $ObjCronogramaFase->ListadoCronogramaEC = CronogramaElementoConfiguracion::ListarPorCronogramaFaseId($ObjCronogramaFase->Id)
                ->map(function($ObjCronogramaECS){
                    $ObjCronogramaECS->ListadoVersion = VersionECS::ListarPorCronogramaEC($ObjCronogramaECS->Id);
                    return $ObjCronogramaECS;
                });
            return $ObjCronogramaFase;
        });
        return $ListadoCronogramaFase2;
    }

    public static function Agregar(CronogramaFase $ObjCronogramaFase){
        $ObjCronogramaFase->save();
        return $ObjCronogramaFase->Id;
    }

    public static function ListarFasePorCronograma($Id_Cronograma){
        
        return CronogramaFase::where('CronogramaId',$Id_Cronograma)->get();
    }

}
