<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class OrdenCambio extends Model
{
    protected $table = 'orden_cambio';
    public $timestamps = false;
    protected $primaryKey = 'Id';

    
    public static function ListarOrdenCambio($UsuarioId){
        
        $ordencambio = DB::table('orden_cambio')
                            ->join('solicitud_cambio', 'orden_cambio.SolicitudCambioId', '=', 'solicitud_cambio.Id')
                            ->join('proyecto', 'solicitud_cambio.ProyectoId', '=', 'proyecto.Id')
                            ->join('miembro_proyecto', 'orden_cambio.JefeId', '=', 'miembro_proyecto.Id')
                            ->join('usuario', 'miembro_proyecto.UsuarioMiembroId', '=', 'usuario.Id')
                            ->select('orden_cambio.*', 'solicitud_cambio.Codigo as Codigo_Solicitud', 'usuario.Nombre as Nombre_Jefe', 'usuario.Apellido as Apellido_Jefe',  'proyecto.Nombre as Nombre_Proyecto')
                            // ->where('usuario.Id', $UsuarioId)
                            ->orderBy('orden_cambio.Id','DESC')
                            ->get();
       
                            
        return $ordencambio;
    }

    public static function ObtenerOrdenCambioPorId($OrdenCambioId){
        
        $ordencambio = DB::table('orden_cambio')
                            ->join('solicitud_cambio', 'orden_cambio.SolicitudCambioId', '=', 'solicitud_cambio.Id')
                            ->join('proyecto', 'solicitud_cambio.ProyectoId', '=', 'proyecto.Id')
                            ->join('miembro_proyecto', 'orden_cambio.JefeId', '=', 'miembro_proyecto.Id')
                            ->join('usuario', 'miembro_proyecto.UsuarioMiembroId', '=', 'usuario.Id')
                            ->select('orden_cambio.*', 'solicitud_cambio.Codigo as Codigo_Solicitud', 'usuario.Nombre as Nombre_Jefe', 'usuario.Apellido as Apellido_Jefe',  'proyecto.Nombre as Nombre_Proyecto')
                            ->where('orden_cambio.Id', $OrdenCambioId)
                            
                            ->first();
       
                            
        return $ordencambio;
    }


    public static function GuardarOrdenCambio(OrdenCambio $objOrdenCambio){
        if($objOrdenCambio->save()){
            return $objOrdenCambio->Id;
        }
        return 0 ;
        
    }
    public static function EditarOrdenCambio(OrdenCambio $objOrdenCambio)
    {
        if($objOrdenCambio->save())
        {
            return $objOrdenCambio->Id;
        }
        return 0;
    }

    
}
