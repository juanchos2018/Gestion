<?php


namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Cronograma;
use App\Models\CronogramaElementoConfiguracion;
use App\Models\CronogramaFase;
use App\Models\MiembroProyecto;
use App\Models\Proyecto;
use App\Models\TareaECS;
use App\Models\VersionECS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class TareaECSController extends Controller
{
    public function Agregar(Request $request){
        Log::info($request->all());
        $ObjTarea = new TareaECS();
        $ObjTarea->Descripcion = $request->input('TxtNombre');
        $ObjTarea->Codigo = $request->input('TxtCodigo');
        $ObjTarea->Justificacion = $request->input('TxtJustificacion');
        $ObjTarea->FechaInicio = $request->input('TxtFechaInicio');
        $ObjTarea->FechaTermino = $request->input('TxtFechaTermino');
        $ObjTarea->MiembroResponsableId = $request->input('CmbMiembroResponsableId');
        $ObjTarea->VersionECSId = $request->input('TxtVersionECSId');
        $ObjTarea->PorcentajeAvance = 0;
        $ObjTarea->UrlEvidencia = 'github.com/lansdiego/prj1/evidencia1.php';
        if($request->input("TxTTareaPadreId") != ""){
            $ObjTarea->TareaPadreId = $request->input("TxTTareaPadreId");
        }


        TareaECS::Agregar($ObjTarea);
        return redirect()->back();
    }

    public function FrmListarPorMiembro(){
         $ListadoMiembro = MiembroProyecto::where('UsuarioMiembroId',Auth::user()->Id)->get();
        $ListadoTarea = [];
        $ListadoTareaTerminado = [];
         foreach ($ListadoMiembro as $ObjMiembro){

             $SubListadoTareaNoTerminado = TareaECS::where('MiembroResponsableId',$ObjMiembro->Id)->where('PorcentajeAvance','<',100)->get();
             foreach ($SubListadoTareaNoTerminado as $ObjTarea){
                 $ObjVersion = VersionECS::where('Id',$ObjTarea->VersionECSId)->first();
                 $ObjTarea->VersionCodigo =  $ObjVersion->Version;
                 $ObjCEC = CronogramaElementoConfiguracion::where('Id',$ObjVersion->ElementoConfiguracionId)->first();
                 $ObjTarea->ElementoNombre =  $ObjCEC->Nombre;
                 $ObjCronogramaFase = CronogramaFase::where('Id',$ObjCEC->CronogramaFaseId)->first();
                 $ObjTarea->Fase = $ObjCronogramaFase->Nombre;
                 $ObjCronograma = Cronograma::where('Id',$ObjCronogramaFase->CronogramaId)->first();
                 $ObjTarea->Proyecto = Proyecto::where('Id', $ObjCronograma->ProyectoId)->first()->Nombre;
                 array_push($ListadoTarea,$ObjTarea);
             }

             $SubListadoTareaTerminado = TareaECS::where('MiembroResponsableId',$ObjMiembro->Id)->where('PorcentajeAvance',100)->get();
             foreach ($SubListadoTareaTerminado as $ObjTarea ){
                 $ObjVersion = VersionECS::where('Id',$ObjTarea->VersionECSId)->first();
                 $ObjTarea->VersionCodigo =  $ObjVersion->Version;
                 $ObjCEC = CronogramaElementoConfiguracion::where('Id',$ObjVersion->ElementoConfiguracionId)->first();
                 $ObjTarea->ElementoNombre =  $ObjCEC->Nombre;
                 $ObjCronogramaFase = CronogramaFase::where('Id',$ObjCEC->CronogramaFaseId)->first();
                 $ObjTarea->Fase = $ObjCronogramaFase->Nombre;
                 $ObjCronograma = Cronograma::where('Id',$ObjCronogramaFase->CronogramaId)->first();
                 $ObjTarea->Proyecto = Proyecto::where('Id', $ObjCronograma->ProyectoId)->first()->Nombre;
                 array_push($ListadoTareaTerminado,$ObjTarea);
             }
         }




        return view('Tarea.ListarPorMiembro',[
            'ListadoTarea' =>$ListadoTarea,
            'ListadoTareaTerminado' => $ListadoTareaTerminado
        ]);

    }


    public function ActEditar($Id,Request $request){
        $ObjTarea = TareaECS::find($Id);
        if($ObjTarea != null){
            $ObjTarea->PorcentajeAvance = $request->input('TxtPorcentajeAvance');
            $ObjTarea->UrlEvidencia = $request->input('TxtUrlEvidencia');
            TareaECS::Editar($ObjTarea);
        }
        return redirect()->back();
    }
}

