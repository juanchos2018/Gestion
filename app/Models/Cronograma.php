<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cronograma extends Model
{
    protected $table = 'cronograma';
    public $timestamps = false;

    public static function ListarCronogramaFasePorCronogramaId($CronogramaId){
        CronogramaFase::where('CronogramaId',$CronogramaId)->get();
    }

    public static function Agregar(Cronograma $Cronograma){
        if($Cronograma->save()){
            return $Cronograma->id;
        }
        return 0;
    }

    public static function ObtenerPorProyectoId($ProyectoId)
    {
        return Cronograma::where('ProyectoId',$ProyectoId)->firstOrFail();
    }
}


