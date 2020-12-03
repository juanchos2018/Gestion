<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Fase extends Model
{
    protected $table = "fase";
    protected $primaryKey = 'Id';
    public $timestamps = false;

    public static function Agregar(Fase $ObjFase)
    {
        if($ObjFase->save())
        {
            return $ObjFase->Id;
        }
        return 0;
    }

    public static function Editar(Fase $ObjFase)
    {
        if($ObjFase->update())
        {
            return $ObjFase->Id;
        }
        return 0;
    }

    public static function Eliminar(Fase $ObjFase)
    {
        return $ObjFase->delete();
    }

    public static function ObtenerPorId($FaseId)
    {
        return Fase::find($FaseId);
    }

    public static function ListarPorMetodologia($MetodologiaId)
    {
        return Fase::where('MetodologiaId', $MetodologiaId)->get();
    }
    public static function ListarPorProyecto($ProyectoId)
    {   
        return  DB::table('fase')
                ->join('metodologia', 'fase.MetodologiaId', '=', 'metodologia.Id')
                ->join('proyecto', 'metodologia.Id', '=', 'proyecto.MetodologiaId')
                ->select('fase.*', 'metodologia.Nombre as Nombre_Metodologia')
                ->where('proyecto.Id', $ProyectoId)
                ->orderBy('fase.Id','DESC')
                ->get();
    }
}
