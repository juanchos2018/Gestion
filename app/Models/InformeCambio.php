<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class InformeCambio extends Model
{
    protected $table = 'informe_cambio';
    public $timestamps = false;
    protected $primaryKey = 'Id';

    public static function GuardarInforme(InformeCambio $objinformecambio){
        if($objinformecambio->save()){
            return $objinformecambio->Id;
        }
        return 0 ;
        
    }
    
    public static function ObtenerInformePorSolicitudId($SolicitudId){

        $objinforme = DB::table('informe_cambio')
                        ->where('SolicitudCambioId', $SolicitudId)
                        ->first();
                            
        return $objinforme;
    }
 
}
