<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyecto';
    public $timestamps = false;

    public static function Agregar(Proyecto $ObjProyecto){
        if($ObjProyecto->save()){
            return $ObjProyecto->id;
        }
        return 0 ;
        
    }

    public static function ObtenerPorId($ProyectoId){
        return Proyecto::findOrFail($ProyectoId);
    }

    public static function ListarPorJefeUsuarioId($UsuarioId){
        return Proyecto::where('UsuarioJefeId',$UsuarioId)->get();
    }

    public static function ListarPorParticipanteId($UsuarioId){
        return Proyecto::where('Estado','En Progreso')->get();
    }


    public function ListarMetodologiaFase($MetodologiaId){
        return MetodologiaFase::where('MetodologiaId',$MetodologiaId)->get();
    }

    
}

?>