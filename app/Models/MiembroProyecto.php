<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class MiembroProyecto extends Model
{
    protected $primaryKey ="Id";
    protected $table = 'miembro_proyecto';
    public $timestamps = false;

    public static function ListarPorProyectoId($ProyectoId)
    {
        return MiembroProyecto::where('ProyectoId',$ProyectoId)->get()->map(function($ObjMiembro){
            $ObjUsuario = Usuario::find($ObjMiembro->UsuarioMiembroId);
            $ObjMiembro->Nombre = $ObjUsuario->Nombre ." ".  $ObjUsuario->Apellido ;
            return $ObjMiembro;
        });
    }

    //Relations
    public function Usuario(){
        return $this->hasOne('App\Models\Usuario', 'Id','UsuarioMiembroId');
    }

    public function Rol(){
        return $this->hasOne('App\Models\Rol', 'Id','RolId');
    }

    public function Proyecto(){
        return $this->hasOne('App\Models\Proyecto', 'Id','ProyectoId');
    }

    //ADD
    public static function Agregar(MiembroProyecto $ObjMiembroProyecto)
    {
        if($ObjMiembroProyecto->save())
        {
            return $ObjMiembroProyecto->Id;
        }
        return 0;
    }

    public static function Editar(MiembroProyecto $ObjMiembroProyecto)
    {
        if($ObjMiembroProyecto->update())
        {
            return $ObjMiembroProyecto->Id;
        }
        return 0;
    }

    public static function ObtenerPorId($ObjMiembroProyecto)
    {
        return MiembroProyecto::find($ObjMiembroProyecto);
    }

    public static function Eliminar(MiembroProyecto $ObjMiembroProyecto)
    {
        return $ObjMiembroProyecto->delete();
    }

    public static function ListarMiembrosPorProyectoId($ProyectoId)
    {
        $ListadoMiembroProyecto = DB::table('miembro_proyecto')
                                ->join('usuario', 'miembro_proyecto.UsuarioMiembroId', '=', 'usuario.Id')
                                ->select('miembro_proyecto.*', 'usuario.Nombre as Nombre_Usuario','usuario.Apellido as Apellido_Usuario')
                                ->where('miembro_proyecto.ProyectoId', $ProyectoId)
                                ->get();
        return $ListadoMiembroProyecto;
        
    }

    public static function ListarProyectosPorUsuarioId($UsuarioId)
    {
        $ListadoMiembroProyecto = DB::table('miembro_proyecto')
                                ->join('proyecto', 'proyecto.Id', '=', 'miembro_proyecto.ProyectoId')
                                ->select('miembro_proyecto.*', 'proyecto.Codigo as Codigo_Proyecto', 'proyecto.Nombre as Nombre_Proyecto', 'proyecto.Id as ProyectoId')
                                ->where('miembro_proyecto.UsuarioMiembroId', $UsuarioId)
                                ->get();
        return $ListadoMiembroProyecto;
        
    }

    public static function ObtenerMiembroPorId($MiembroId)
    {
        $objMiembroProyecto = DB::table('miembro_proyecto')
                                ->join('usuario', 'miembro_proyecto.UsuarioMiembroId', '=', 'usuario.Id')
                                ->select('miembro_proyecto.*', 'usuario.Nombre as Nombre_Usuario', 'usuario.Apellido as Apellido_Usuario')
                                ->where('miembro_proyecto.Id', $MiembroId)
                                ->first();
        return $objMiembroProyecto;
        
    }

    public static function ObtenerMiembroPorUsuarioProyecto($UsuarioId,$ProyectoId)
    {
        $objMienbro = DB::table('miembro_proyecto')
                                ->select('miembro_proyecto.*')
                                ->where('miembro_proyecto.UsuarioMiembroId', $UsuarioId)
                                ->where('miembro_proyecto.ProyectoId', $ProyectoId)
                                ->first();
        return $objMienbro;
        
    }

}

?>