<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MiembroProyecto as MiembroProyecto;
use App\Models\Proyecto as Proyecto;
use App\Models\Rol as Rol;
use App\Models\Usuario as Usuario;

class MiembroProyectoController extends Controller
{
    public function Listar($ProyectoId){
        $ListadoMiembroProyecto = MiembroProyecto::ListarPorProyectoId($ProyectoId);
        $ObjProyecto = Proyecto::ObtenerPorId($ProyectoId);
        $ListadoUsuario = Usuario::Listar();
        $ListadoRol = Rol::Listar();
        return view('MiembroProyecto.Listar',[
            'ListadoMiembroProyecto' => $ListadoMiembroProyecto,
            'Proyecto' => $ObjProyecto,
            'ListadoUsuario' => $ListadoUsuario,
            'ListadoRol' => $ListadoRol
        ]);
    }

    public function FrmEditar($MiembroProyectoId,$ProyectoId)
    {
        $ObjMiembroProyecto = MiembroProyecto::ObtenerPorId($MiembroProyectoId);
        $ListadoUsuario = Usuario::Listar();
        $ListadoRol = Rol::Listar();
        return view('MiembroProyecto.Editar', [
            'MiembroProyecto' => $ObjMiembroProyecto,
            'ListadoRol' => $ListadoRol
        ]);
    }

    public function ActAgregar(Request $request)
    {
        $ObjMiembroProyecto = new MiembroProyecto();
        $ObjMiembroProyecto->UsuarioMiembroId = $request->input('TxtUsuarioId');
        $ObjMiembroProyecto->RolId = $request->input('TxtRolId');
        $ObjMiembroProyecto->ProyectoId = $request->input('TxtProyectoId');
        if(MiembroProyecto::Agregar($ObjMiembroProyecto) > 0)
        {
            return redirect()->action('MiembroProyectoController@Listar', ['ProyectoId' => $ObjMiembroProyecto->ProyectoId]);
        }
    }

    public function ActEditar(Request $request)
    {
        $ObjMiembroProyecto = MiembroProyecto::ObtenerPorId($request->TxtId);
        $ObjMiembroProyecto->RolId = $request->input('TxtRolId');
        $ProyectoId = $request->input('TxtProyectoId');
        if(MiembroProyecto::Editar($ObjMiembroProyecto) > 0)
        {
            return redirect()->action('MiembroProyectoController@Listar', ['ProyectoId' => $ProyectoId]);
        }
    }

    public function ActEliminar(Request $request)
    {
        try
        {
            $ObjMiembroProyecto = MiembroProyecto::ObtenerPorId($request->MiembroProyectoId);
            $ProyectoId = $request->ProyectoId;
            MiembroProyecto::Eliminar($ObjMiembroProyecto);
            return redirect()->action('MiembroProyectoController@Listar', ['ProyectoId' => $ProyectoId]);
        } 
        catch (\Illuminate\Database\QueryException $e)
        {
            return redirect()->action('MiembroProyectoController@Listar', ['ProyectoId' => $ProyectoId]);
        }
    }
}

?>