<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ElementoConfiguracion as ElementoConfiguracion;
use App\Models\Fase as Fase;
use App\Models\Metodologia as Metodologia;

class ElementoConfiguracionController extends Controller
{
    public function Listar()
    {
        $ObjECS = ElementoConfiguracion::Listar();
        return view('ElementoConfiguracion.Listar', ['ListadoECS' => $ObjECS]);
    }

    public function FrmAgregar()
    {
        return view('ElementoConfiguracion.Agregar');
    }

    public function FrmEditar($ElementoConfiguracionId)
    {
        $ObjECS = ElementoConfiguracion::ObtenerPorId($ElementoConfiguracionId);
        return view('ElementoConfiguracion.Editar', ['ECS' => $ObjECS]);
    }

    public function ActAgregar(Request $request)
    {
        $ObjECS = new ElementoConfiguracion();
        $ObjECS->Codigo = $request->input('TxtCodigo');
        $ObjECS->Nombre = $request->input('TxtNombre');
        if(ElementoConfiguracion::Agregar($ObjECS) > 0)
        {
            return redirect()->action('ElementoConfiguracionController@Listar');
        }
    }

    public function ActEditar(Request $request)
    {
        $ObjECS = ElementoConfiguracion::ObtenerPorId($request->TxtId);
        $ObjECS->Codigo = $request->input('TxtCodigo');
        $ObjECS->Nombre = $request->input('TxtNombre');
        if(ElementoConfiguracion::Editar($ObjECS) > 0)
        {
            return redirect()->action('ElementoConfiguracionController@Listar');
        }
    }

    public function ActEliminar(Request $request)
    {
        try
        {
            $ObjECS = ElementoConfiguracion::ObtenerPorId($request->ElementoConfiguracionId);
            ElementoConfiguracion::Eliminar($ObjECS);
            return redirect()->action('ElementoConfiguracionController@Listar');
        } 
        catch (\Illuminate\Database\QueryException $e)
        {
            return redirect()->back();
        }
    }

    public function CronogramaFase(){
        return $this->hasOne('App\Models\CronogramaFase', 'Id');
    }
}

?>