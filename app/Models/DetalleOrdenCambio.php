<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class DetalleOrdenCambio extends Model
{
    protected $table = 'orden_cambio_detalle';
    public $timestamps = false;
    protected $primaryKey = 'Id';

    public static function ListarDetalleOrdenCambioPorId($OrdenCambioId){
        
        $ordencambio = DB::table('orden_cambio_detalle')
                            ->join('cronograma_elemento_configuracion', 'cronograma_elemento_configuracion.Id', '=', 'orden_cambio_detalle.CronogramaElementoConfiguracionId')
                            ->join('miembro_proyecto', 'miembro_proyecto.Id', '=', 'orden_cambio_detalle.MiembroResponsableId')
                            ->join('usuario', 'miembro_proyecto.UsuarioMiembroId', '=', 'usuario.Id')
                            ->select('orden_cambio_detalle.*', 'cronograma_elemento_configuracion.Nombre as Nombre_ECS', 'usuario.Nombre as Nombre_Responsable', 'usuario.Apellido as Apellido_Responsable')
                            ->where('orden_cambio_detalle.OrdenCambioId', $OrdenCambioId)
                            ->orderBy('orden_cambio_detalle.Id','DESC')
                            ->get();
       
                            
        return $ordencambio;
    }

    public static function GuardarDetalleOrdenCambio(DetalleOrdenCambio $objDetalleOrdenCambio){
        if($objDetalleOrdenCambio->save()){
            return $objDetalleOrdenCambio->Id;
        }
        return 0 ;
        
    }
    public static function EditarDetalleOrdenCambio(DetalleOrdenCambio $objDetalleOrdenCambio)
    {
        if($objDetalleOrdenCambio->save())
        {
            return $objDetalleOrdenCambio->Id;
        }
        return 0;
    }

    
}
