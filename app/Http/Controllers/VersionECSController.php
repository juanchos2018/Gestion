<?php

namespace App\Http\Controllers;

use App\Models\MiembroProyecto;
use App\Models\TareaECS;
use App\Models\VersionECS;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class VersionECSController extends Controller
{
    public function ActAgregar(Request $request){
        $ObjECS = new VersionECS();
        $ObjECS->Version = $request->input("TxtVersion");
        $ObjECS->FechaInicio = $request->input("TxtFechaInicio");
        $ObjECS->FechaTermino = $request->input("TxtFechaTermino");
        $ObjECS->ElementoConfiguracionId = $request->input("TxtElementoConfiguracionId");
        $ObjECS->MiembroResponsableId = $request->input("CmbMiembroResponsableId");
        VersionECS::Agregar($ObjECS);
        return redirect()->back();
    }

    public function FrmVer($Id,Request $request){
        return view('Version.ver',
            [
                'ObjVersion' => VersionECS::ObtenerPorId($Id),
                'Proyecto' => $request->input('Proyecto'),
                'Fase' => $request->input('Fase'),
                'ListadoTarea' => TareaECS::ListarPorVersionECSId($Id),
                'ListadoMiembro' => MiembroProyecto::ListarPorProyectoId($request->input('ProyectoId'))
            ]
        );
    }
}
