<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TareaECS extends Model
{
    protected $table = "tarea_ecs";
    protected $primaryKey = "Id";
    public $timestamps = false;

    public static function ListarPorVersionECSId($VersionICSId){
//        DB::enableQueryLog();
        $ListadoTarea = TareaECS::where('VersionECSId',$VersionICSId)->get();
//        dd(DB::getQueryLog());
        return $ListadoTarea;
    }

    public static function Progreso($ProyectoId){

        $Terminados = DB::table('tarea_ecs')
            ->join('version_ecs', 'tarea_ecs.VersionECSId', '=', 'version_ecs.Id')
            ->join('cronograma_elemento_configuracion', 'version_ecs.ElementoConfiguracionId', '=', 'cronograma_elemento_configuracion.Id')
            ->join('cronograma_fase', 'cronograma_elemento_configuracion.CronogramaFaseId', '=', 'cronograma_fase.Id')
            ->join('cronograma', 'cronograma_fase.CronogramaId', '=', 'cronograma.Id')
            ->join('proyecto', 'cronograma.ProyectoId', '=', 'proyecto.Id')
            ->select('tarea_ecs.*')
            ->where('proyecto.Id', $ProyectoId)
            ->where('tarea_ecs.PorcentajeAvance','=' , 100)
            ->count();
        $Abiertos = DB::table('tarea_ecs')
            ->join('version_ecs', 'tarea_ecs.VersionECSId', '=', 'version_ecs.Id')
            ->join('cronograma_elemento_configuracion', 'version_ecs.ElementoConfiguracionId', '=', 'cronograma_elemento_configuracion.Id')
            ->join('cronograma_fase', 'cronograma_elemento_configuracion.CronogramaFaseId', '=', 'cronograma_fase.Id')
            ->join('cronograma', 'cronograma_fase.CronogramaId', '=', 'cronograma.Id')
            ->join('proyecto', 'cronograma.ProyectoId', '=', 'proyecto.Id')
            ->select('tarea_ecs.*')
            ->where('proyecto.Id', $ProyectoId)
        ->where('tarea_ecs.PorcentajeAvance','=' , 0)
            ->count();
        $Proceso = DB::table('tarea_ecs')
            ->join('version_ecs', 'tarea_ecs.VersionECSId', '=', 'version_ecs.Id')
            ->join('cronograma_elemento_configuracion', 'version_ecs.ElementoConfiguracionId', '=', 'cronograma_elemento_configuracion.Id')
            ->join('cronograma_fase', 'cronograma_elemento_configuracion.CronogramaFaseId', '=', 'cronograma_fase.Id')
            ->join('cronograma', 'cronograma_fase.CronogramaId', '=', 'cronograma.Id')
            ->join('proyecto', 'cronograma.ProyectoId', '=', 'proyecto.Id')
            ->select('tarea_ecs.*')
            ->where('proyecto.Id', $ProyectoId)
            ->where('tarea_ecs.PorcentajeAvance','<' , 100 )
            ->where('tarea_ecs.PorcentajeAvance','>' , 0 )
            ->count();
        return [ "Terminados" => $Terminados , "Abiertos" => $Abiertos, 'Proceso' => $Proceso];
    }


    //Relations
    public static function Agregar(TareaECS $ObjTarea)
    {
        return $ObjTarea->save();
    }

    public static function Editar(TareaECS $ObjTarea)
    {
        return $ObjTarea->save();
    }

    public function Miembro(){
        return $this->hasOne('App\Models\MiembroProyecto', 'Id','MiembroResponsableId')->with('Usuario');
    }

    public function Padre(){
        return $this->hasOne('App\Models\TareaECS', 'Id','TareaPadreId');
    }
}
