<?php

namespace App\Http\Controllers;


use App\Models\SolicitudCambio as SolicitudCambio;
use App\Models\Cronograma as Cronograma;
use App\Models\CronogramaFase as CronogramaFase;
use App\Models\CronogramaElementoConfiguracion as CronogramaElementoConfiguracion;
use App\Models\MiembroProyecto as MiembroProyecto;
use Auth;
use App\Models\OrdenCambio as OrdenCambio;
use App\Models\DetalleOrdenCambio as DetalleOrdenCambio;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrdenCambioController extends Controller
{
    public function FrmListar(){

        $ListadoOrdenCambio = OrdenCambio::ListarOrdenCambio(Auth::user()->Id);
        return view('OrdenCambio.listar', ['ListadoOrdenCambio' => $ListadoOrdenCambio]);

    }
    public function FrmAgregar(){
        
        $ListadoSolicitud = SolicitudCambio::ListarSolucitudesAceptadas(Auth::user()->Id);
        session()->forget('DOrdenCambio');
        return view('OrdenCambio.agregar', ['ListadoSolicitud' => $ListadoSolicitud]);
    }


    public function ActFasePorProyecto(Request $request){

        $objSolicitud = SolicitudCambio::ObtenerSolicitudPorId($request->SolicitudCambioId);
        $objCronograma = Cronograma::ObtenerPorProyectoId($objSolicitud->ProyectoId);
        $ListadoFase = CronogramaFase::ListarFasePorCronograma($objCronograma->Id);
        $Fases = '';
        foreach ($ListadoFase as $be) {
            $Fases .= '
                <option value="'.$be->Id.'">'.$be->Nombre.'</option>  
            ';
        }
        return $Fases;
    
      
  
    }

    public function ActMiembrosPorProyeto(Request $request){

        $objSolicitud = SolicitudCambio::ObtenerSolicitudPorId($request->SolicitudCambioId);
        $ListadoProyecto = MiembroProyecto::ListarMiembrosPorProyectoId($objSolicitud->ProyectoId);
        
        $MiembroProyecto = '';
        foreach ($ListadoProyecto as $be) {
            $MiembroProyecto .= '
                <option value="'.$be->Id.'">'.$be->Nombre_Usuario.' '.$be->Apellido_Usuario.'</option>  
            ';
        }
        return $MiembroProyecto;
    
      
  
    }

    public function ActECSPorFase(Request $request){

        $ECS = CronogramaElementoConfiguracion::ListarPorCronogramaFaseId($request->FaseId);
        // dd(DB::getQueryLog());
        $combo = '';
        foreach($ECS as $be){
            $combo.= '<option value="'.$be->Id.'">'.$be->Nombre.'</option>';
        }
        return $combo;

    }
    

    
    public function ActAgregarDetalleOrden(Request $request){
      
        $Ecs = CronogramaElementoConfiguracion::ObtenerPorId($request->ECSIdM);
        $MiembroProyecto = MiembroProyecto::ObtenerMiembroPorId($request->Responsable);
        if (session()->exists('DOrdenCambio')) {
            
            $data = session('DOrdenCambio');
            
            array_push($data,
                array(
                    'ECSIdM' => $request->ECSIdM,
                    'ESCNombre' => $Ecs->Nombre,
                    'Responsable' => $request->Responsable,
                    'Nombre_Responsable' => $MiembroProyecto->Nombre_Usuario.' '.$MiembroProyecto->Apellido_Usuario,
                    'FechaInicioD' => $request->FechaInicioD,
                    'FechaTerminoD' => $request->FechaTerminoD,
                    'DescripcionM' => $request->DescripcionM,
                    'Eliminado' => 0,
                )
            );
            session()->put('DOrdenCambio', $data);
            
            return view('OrdenCambio.detalleorden', ['ListadoDetalleOrden' => $data]);
        }else{
            session('DOrdenCambio');
            $data = array();
            array_push($data,
                array(
                    'ECSIdM' => $request->ECSIdM,
                    'ESCNombre' => $Ecs->Nombre,
                    'Responsable' => $request->Responsable,
                    'Nombre_Responsable' => $MiembroProyecto->Nombre_Usuario.' '.$MiembroProyecto->Apellido_Usuario,
                    'FechaInicioD' => $request->FechaInicioD,
                    'FechaTerminoD' => $request->FechaTerminoD,
                    'DescripcionM' => $request->DescripcionM,
                    'Eliminado' => 0,
                )
            );
            session()->put('DOrdenCambio', $data);

            return view('OrdenCambio.detalleorden', ['ListadoDetalleOrden' => $data]);
  
        }

 
        
    }

    public function ActEliminarDetalleOrden(Request $request){
        
        $data = session('DOrdenCambio');
        $Tiempo = 0;
        $Costo = 0;
      
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['ECSIdM'] == $request->ESCId) {
                $data[$i]['Eliminado'] = 1;
            
            }
        }
        
        session()->forget('DOrdenCambio');
        session('DOrdenCambio');
        session()->put('DOrdenCambio', $data);
        return view('OrdenCambio.detalleorden', ['ListadoDetalleOrden' => $data]);
        
    }


    public function ActGuardarOrdenCambio(Request $request){
        $objsolicitudcambio = SolicitudCambio::find($request->SolicitudCambioId);
        $objMiembro = MiembroProyecto::ObtenerMiembroPorUsuarioProyecto(Auth::user()->Id,$objsolicitudcambio->ProyectoId);
        $objOrdenCambio = new OrdenCambio();
        $objOrdenCambio->SolicitudCambioId = $request->SolicitudCambioId;
        $objOrdenCambio->JefeId = $objMiembro->Id;
        $objOrdenCambio->FechaAprobación = $request->FechaAprobación;
        $objOrdenCambio->FechaInicio = $request->FechaInicio;
        $objOrdenCambio->FechaTermino = $request->FechaTermino;
        $objOrdenCambio->Descripcion = $request->Descripcion;
        $objOrdenCambio->PorcertanjeAvance = 0;
        $objOrdenCambio->Estado = 'Pendiente';
        $OrdenCambioId = OrdenCambio::GuardarOrdenCambio($objOrdenCambio);
        if($OrdenCambioId > 0){

            $data = session('DOrdenCambio');
            for ($i=0; $i < count($data); $i++) { 
                if ($data[$i]['Eliminado'] == 0) {
                    $objDetalleOrdenCambio = new DetalleOrdenCambio();
                    $objDetalleOrdenCambio->OrdenCambioId = $OrdenCambioId;
                    $objDetalleOrdenCambio->CronogramaElementoConfiguracionId = $data[$i]['ECSIdM'];
                    $objDetalleOrdenCambio->MiembroResponsableId = $data[$i]['Responsable'];
                    $objDetalleOrdenCambio->FechaInicio = $data[$i]['FechaInicioD'];
                    $objDetalleOrdenCambio->FechaTermino = $data[$i]['FechaTerminoD'];
                    $objDetalleOrdenCambio->PorcertanjeAvance = 0;
                    $objDetalleOrdenCambio->Predecesora = '';
                    $objDetalleOrdenCambio->Descripcion = $data[$i]['DescripcionM'];
                    DetalleOrdenCambio::GuardarDetalleOrdenCambio($objDetalleOrdenCambio);
                
                }
            }
        }

        return redirect()->action('OrdenCambioController@FrmListar');
        
    }

    public function FrmEditar($OrdenCambioId){
        
        $objOrdenCambio = OrdenCambio::ObtenerOrdenCambioPorId($OrdenCambioId);
        $ListadoDetalleOrden = DetalleOrdenCambio::ListarDetalleOrdenCambioPorId($OrdenCambioId);
        return view('OrdenCambio.editar', ['objOrdenCambio' => $objOrdenCambio,'ListadoDetalleOrden' => $ListadoDetalleOrden ]);
    }

    public function ActEditarOrdenCambio(Request $request){

        $objOrdenCambio = OrdenCambio::find($request->Id);
        $objOrdenCambio->PorcertanjeAvance = $request->PorcertanjeAvance;
        $objOrdenCambio->Estado = $request->PorcertanjeAvance == 100 ? 'Terminado':'Pendiente';
        $OrdenCambioId = OrdenCambio::EditarOrdenCambio($objOrdenCambio);

        return redirect()->action('OrdenCambioController@FrmListar');
        
    }
    
}
