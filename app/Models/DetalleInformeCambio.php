<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DetalleInformeCambio extends Model
{
    protected $table = 'detalle_informe';
    public $timestamps = false;
    protected $primaryKey = 'Id';

    public static function GuardarDetalleInforme(DetalleInformeCambio $objdetalleinformecambio){
        if($objdetalleinformecambio->save()){
            return $objdetalleinformecambio->Id;
        }
        return 0 ;
        
    }

    public static function ListarDetalleInforme($InformeId){
   
        $ListadoDetalleInforme = DB::table('detalle_informe')
                            ->join('cronograma_elemento_configuracion', 'cronograma_elemento_configuracion.Id', '=', 'detalle_informe.CronogramaElementoConfiguracionId')
                            ->select('detalle_informe.*', 'cronograma_elemento_configuracion.Nombre as Nombre_ECS')
                            ->where('detalle_informe.InformeCambioId', $InformeId)
                            ->orderBy('detalle_informe.Id','DESC')
                            ->get();

     
         

        return $ListadoDetalleInforme;
    }
   
 
}
