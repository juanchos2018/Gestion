<?php

namespace App\Http\Controllers;

use App\Models\Cronograma;
use App\Models\CronogramaElementoConfiguracion;
use App\Models\CronogramaFase;
use App\Models\ElementoConfiguracion;
use App\Models\Metodologia;
use App\Models\MiembroProyecto;
use App\Models\TareaECS;
use Illuminate\Http\Request;
use App\Models\Proyecto as Proyecto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProyectoController extends Controller
{
    public function Listar(){
        $objUsuario = Auth::user();
        $ListadoProyecto = Proyecto::ListarPorJefeUsuarioId($objUsuario->Id);
        return view('Proyecto.listar',[
            'ListadoProyecto' => $ListadoProyecto
        ]);
    }

    public function Ver($ProyectoId)
    {
        $Progreso = TareaECS::Progreso($ProyectoId);
        $Cronograma = Cronograma::ObtenerPorProyectoId($ProyectoId);
        $Proyecto = Proyecto::ObtenerPorId($ProyectoId);
        return view('Proyecto.Ver',[
            'Proyecto' => $Proyecto,
            'Cronograma' => $Cronograma,
            'ListadoFase' => CronogramaFase::ListarPorCronogramaId($Cronograma->Id),
            'Metodologia' => Metodologia::ObtenerPorId($Proyecto->MetodologiaId),
            'ListadoMiembro' => MiembroProyecto::ListarPorProyectoId($ProyectoId),
            'Progreso' => $Progreso
        ]);
    }

    public function FrmAgregar(){
        $ListadoMetodoliga = Metodologia::Listar();
        return view('Proyecto.agregar',[
            'ListadoMetodologia' => $ListadoMetodoliga
        ]);
    }

    public function ActAgregar( Request $request){
        $ObjProyecto = new Proyecto();
        $ObjProyecto->Codigo = "PRJ002";
        $ObjProyecto->Nombre = $request->input('Nombre');
        $ObjProyecto->UsuarioJefeId = $request->input('UsuarioJefeId');
        $ObjProyecto->FechaInicio = $request->input('FechaInicio');
        $ObjProyecto->FechaTermino = $request->input('FechaTermino');
        $ObjProyecto->MetodologiaId = $request->input('MetodologiaId');
        $ObjProyecto->Descripcion = $request->input('Descripcion');
        $ObjProyecto->Estado = 'En Progreso';
        $UsuarioId = $ObjProyecto->UsuarioJefeId;
        if(Proyecto::Agregar($ObjProyecto) > 0){ //PROYECTO
            $Cronograma = new Cronograma();
            $Cronograma->ProyectoId= $ObjProyecto->id;
            $Cronograma->FechaInicio= $request->input('FechaInicio');
            $Cronograma->FechaTermino= $request->input('FechaTermino');
            $insertedIdProyecto = Cronograma::Agregar($Cronograma);
            if( $insertedIdProyecto > 0){ //CRONOGRAMA
                $ListadoFaseNombre = $request->input('FasesNombre');
                //UNIR AL USUARIO JEFE COMO MIEMBRO DEL PROYECTO
                $ObjMiembro = new MiembroProyecto();
                $ObjMiembro->UsuarioMiembroId = $ObjProyecto->UsuarioJefeId;
                $ObjMiembro->RolId = 1; // el 1 es jefe
                $ObjMiembro->ProyectoId = $insertedIdProyecto;
                MiembroProyecto::Agregar($ObjMiembro);
                Log::info($request->all());
                Log::info($ObjProyecto);
                if(isset($ListadoFaseNombre)){

                    Log::info($ListadoFaseNombre);
                    foreach($ListadoFaseNombre  as $FaseNombre){

                        $ObjCronogramaFase = new CronogramaFase();
                        $ObjCronogramaFase->CronogramaId = $Cronograma->id;
                        $ObjCronogramaFase->Nombre = $FaseNombre;
                        if(CronogramaFase::Agregar($ObjCronogramaFase) > 0){//CRONOGRAMA FASE
                            $ListadoElementoNombre = $request->input($ObjCronogramaFase->Nombre);
                            Log::info($request->all());
                            foreach( $ListadoElementoNombre as $ElementoNombre){
                                Log::info('Elemento n°:'.$ElementoNombre);
                                $ElementoConfiguracion = new CronogramaElementoConfiguracion();
                                $ElementoConfiguracion->Codigo = $ElementoNombre;
                                $ElementoConfiguracion->Nombre = $ElementoNombre;
                                $ElementoConfiguracion->CronogramaFaseId = $ObjCronogramaFase->Id;
                                if(CronogramaElementoConfiguracion::Agregar($ElementoConfiguracion) > 0){ // CRONOGRAMA ELEMENTO CONFIGURACION
                                    Log::info('ECS creada con id:'.$ElementoConfiguracion->Id);
//                                return redirect()->route('proyecto.listar');
                                }

                            }
                        }
                    }
                }

            }

        }
        return redirect()->route('proyecto.listar');
    }

}

?>