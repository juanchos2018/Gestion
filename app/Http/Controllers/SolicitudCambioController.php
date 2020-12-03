<?php

namespace App\Http\Controllers;

use App\Models\SolicitudCambio as SolicitudCambio;
use App\Models\Proyecto as Proyecto;

use App\Models\Cronograma as Cronograma;
use App\Models\CronogramaFase as CronogramaFase;
use App\Models\CronogramaElementoConfiguracion as CronogramaElementoConfiguracion;

use App\Models\MiembroProyecto as MiembroProyecto;

use App\Models\InformeCambio as InformeCambio;
use App\Models\DetalleInformeCambio as DetalleInformeCambio;

use Auth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SolicitudCambioController extends Controller
{
    public function FrmListar(){
        // DB::enableQueryLog();
        
        $ListadoSolicitud = SolicitudCambio::ListarSolicitud(Auth::user()->Id,Auth::user()->TipoUsuarioId);
        // dd(DB::getQueryLog());
        return view('SolicitudCambio.listar', ['ListadoSolicitud' => $ListadoSolicitud]);

    }
    public function FrmAgregar(){
        
        $ListadoProyecto = MiembroProyecto::ListarProyectosPorUsuarioId(Auth::user()->Id);
       
        return view('SolicitudCambio.agregar', ['ListadoProyecto' => $ListadoProyecto]);
    }


    public function ActAgregarSolicitud(Request $request){
        
        $objMiembro = MiembroProyecto::ObtenerMiembroPorUsuarioProyecto(Auth::user()->Id,$request->Proyecto_Id);
        $solicitudcambio = new SolicitudCambio;
        $solicitudcambio->Codigo = "SC-".rand(10,99).rand(100,999);
        $solicitudcambio->Proyectoid = $request->Proyecto_Id;
        $solicitudcambio->Miembrosolicitanteid = $objMiembro->Id;
        $solicitudcambio->Fecha = $request->Fecha;
        $solicitudcambio->Objetivo = $request->Objetivo;
        $solicitudcambio->Descripcion = $request->Descripcion;
        $solicitudcambio->Estado = 1;
        $solicitudcambio->Miembrojefeid = $objMiembro->Id;
        $solicitudcambio->Respuesta = '';
        SolicitudCambio::GuardarSolicitud($solicitudcambio);
        return redirect()->action('SolicitudCambioController@FrmListar');
  
    }

    public function FrmEditar($SolicitudId){
       
        $ListadoProyecto = Proyecto::ListarPorParticipanteId(1);
        $ObjSolicitud = SolicitudCambio::ObtenerSolicitudPorId($SolicitudId);
        return view('SolicitudCambio.editar',['ListadoProyecto' => $ListadoProyecto, 'ObjSolicitud' => $ObjSolicitud ] );
    }
    public function ActEditarSolicitud(Request $request){


        // DB::enableQueryLog();
        // dd(DB::getQueryLog());
        // dd($request->all());
        // dd($objsolicitudcambio);

        $objsolicitudcambio = SolicitudCambio::find($request->Id);
        $objsolicitudcambio->ProyectoId = $request->Proyecto_Id;
        $objsolicitudcambio->Fecha = $request->Fecha;
        $objsolicitudcambio->Objetivo = $request->Objetivo;
        $objsolicitudcambio->Descripcion = $request->Descripcion;
        if(SolicitudCambio::EditarSolicitud($objsolicitudcambio) > 0){
            return redirect()->action('SolicitudCambioController@FrmListar');
        }

    }
    public function FrmInformeCambio($SolicitudId){
        $objSolicitud = SolicitudCambio::ObtenerSolicitudPorId($SolicitudId);
        $objCronograma = Cronograma::ObtenerPorProyectoId($objSolicitud->ProyectoId);
        $objInforme = InformeCambio::ObtenerInformePorSolicitudId($SolicitudId);
        
        
        if(!empty($objInforme->Id)){

            $ListadoDetalleInforme = DetalleInformeCambio::ListarDetalleInforme($objInforme->Id);
            
            return view('SolicitudCambio.verinforme',
                [
                    'objInforme' => $objInforme,
                    'objSolicitud' => $objSolicitud,
                    'ListadoDetalleInforme' => $ListadoDetalleInforme,
           
                ]
            );
        }else{

            $ListadoFase = CronogramaFase::ListarFasePorCronograma($objCronograma->Id);
            session()->forget('DInformeCambio');
            return view('SolicitudCambio.agregarinforme',
                [
                    'objSolicitud' => $objSolicitud,
                    'ListadoFase' => $ListadoFase,
           
                ]
            );
        }
       
    }
    public function delete(){
        return view('SolicitudCambio.agregar');
    }

    public function ViewESC(Request $request){
        //  DB::enableQueryLog();
        
        $ECS = CronogramaElementoConfiguracion::ListarPorCronogramaFaseId($request->FaseId);
        // dd(DB::getQueryLog());
        $combo = '';
        foreach($ECS as $be){
            $combo.= '<option value="'.$be->Id.'">'.$be->Nombre.'</option>';
        }
        return $combo;
    }

    public function AccAgregarDetalleInforme(Request $request){
      
        $Ecs = CronogramaElementoConfiguracion::ObtenerPorId($request->ESCId);
        if (session()->exists('DInformeCambio')) {
            
            $data = session('DInformeCambio');
            
            array_push($data,
                array(
                    'FaseId' => $request->FaseId,
                    'ESCId' => $request->ESCId,
                    'ESCNombre' => $Ecs->Nombre,
                    'Tiempo' => $request->Tiempo,
                    'Costo' => $request->Costo,
                    'Descripcion' => $request->Descripcion,
                    'Eliminado' => 0,
                )
            );
            session()->put('DInformeCambio', $data);

            return view('SolicitudCambio.detalleinforme', ['ADetalleInforme' => $data]);
        }else{
            session('DInformeCambio');
            $data = array();
            array_push($data,
                array(
                    'FaseId' => $request->FaseId,
                    'ESCId' => $request->ESCId,
                    'ESCNombre' => $Ecs->Nombre,
                    'Tiempo' => $request->Tiempo,
                    'Costo' => $request->Costo,
                    'Descripcion' => $request->Descripcion,
                    'Eliminado' => 0,
                )
            );
            session()->put('DInformeCambio', $data);

            return view('SolicitudCambio.detalleinforme', ['ADetalleInforme' => $data]);
  
        }

 
        
    }

    public function AccEliminarDetalleInforme(Request $request){
      
        $data = session('DInformeCambio');
        $Tiempo = 0;
        $Costo = 0;
      
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['ESCId'] == $request->ESCId) {
                $data[$i]['Eliminado'] = 1;
            
            }
        }
        
        session()->forget('DInformeCambio');
        session('DInformeCambio');
        session()->put('DInformeCambio', $data);
        return view('SolicitudCambio.detalleinforme', ['ADetalleInforme' => $data]);
        
    }

    public function ViewDetalleInforme(){
        // $data = session('DInformeCambio');

        return view('SolicitudCambio.detalleinforme');
    }

    public function ActTiempoSolicitud(){

        $data = session('DInformeCambio');
        $Tiempo = 0;
        $Costo = 0;
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['Eliminado'] == 0) {
                $Tiempo += $data[$i]['Tiempo'];
                $Costo += $data[$i]['Costo'];
            }
        }
        
        return response()->json([
            'Tiempo' => number_format($Tiempo,2,'.',''),
            'Costo' => number_format($Costo,2,'.','')
        ]);
    }

    

    public function ActAgregarInformeCambio(Request $request){
        $ObjSolicitud = SolicitudCambio::ObtenerSolicitudPorId($request->SolicitudCambioId);
        $objMiembro = MiembroProyecto::ObtenerMiembroPorUsuarioProyecto(Auth::user()->Id,$ObjSolicitud->ProyectoId);
        $informecambio = new InformeCambio;
        $informecambio->Codigo = "IC-".rand(10,99).rand(100,999);
        $informecambio->SolicitudCambioId = $request->SolicitudCambioId;
        $informecambio->Descripcion = $request->Descripcion;
        $informecambio->Tiempo = $request->Tiempo;
        $informecambio->CostoEconomico = $request->CostoEconomico;
        $informecambio->ImpactoProblema = $request->ImpactoProblema;
        $informecambio->Fecha = $request->Fecha;
        $informecambio->Miembrojefeid = $objMiembro->Id;
        $informecambio->Estado = 'Activo';
        $InformeId = InformeCambio::GuardarInforme($informecambio);
        
        if($InformeId > 0){
            $objsolicitudcambio = SolicitudCambio::find($request->SolicitudCambioId);
            $objsolicitudcambio->Estado = 2;
            SolicitudCambio::EditarSolicitud($objsolicitudcambio);
             

            $data = session('DInformeCambio');
            for ($i=0; $i < count($data); $i++) { 
                if ($data[$i]['Eliminado'] == 0) {
                    $detalleinforme = new DetalleInformeCambio;
                    $detalleinforme->InformeCambioId = $InformeId;
                    $detalleinforme->CronogramaElementoConfiguracionId = $data[$i]['ESCId'];
                    $detalleinforme->Tiempo = $data[$i]['Tiempo'];
                    $detalleinforme->Costo = $data[$i]['Costo'];
                    $detalleinforme->Descripcion = $data[$i]['Descripcion'];
                    DetalleInformeCambio::GuardarDetalleInforme($detalleinforme);
                   
                }
            }

           

        }
   
        return redirect()->action('SolicitudCambioController@FrmListar');
  
        
  
    }

    public function ActResponderSolicitud(Request $request){
        
        
        $objsolicitudcambio = SolicitudCambio::find($request->SolicitudCambioId);
        
        $objMiembro = MiembroProyecto::ObtenerMiembroPorUsuarioProyecto(Auth::user()->Id,$objsolicitudcambio->ProyectoId);
        $objsolicitudcambio->Respuesta = $request->Respuesta;
        $objsolicitudcambio->Estado = $request->Estado;
        $objsolicitudcambio->MiembroJefeId = $objMiembro->Id;

        if(SolicitudCambio::EditarSolicitud($objsolicitudcambio) > 0){
            if($request->Estado == 3){
                return redirect()->action('OrdenCambioController@FrmAgregar');
            }
            if($request->Estado == 4){
                return redirect()->action('SolicitudCambioController@FrmListar');
            }
            
        }
        
  
    }
    
}
