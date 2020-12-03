<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Metodologia as Metodologia;
use App\Models\Fase as Fase;
use App\Models\ElementoConfiguracion as ElementoConfiguracion;
use App\Models\PlantillaElementoConfiguracion as PlantillaElementoConfiguracion;

class MetodologiaController extends Controller
{
    public function Listar()
    {
        $ObjMetodologia = Metodologia::Listar();
        return view('Metodologia.Listar', ['ListadoMetodologia' => $ObjMetodologia]);
    }

    public function FrmAgregar()
    {
        return view('Metodologia.Agregar');
    }

    public function FrmEditar($MetodologiaId)
    {
        $ObjMetodologia = Metodologia::ObtenerPorId($MetodologiaId);
        return view('Metodologia.Editar', ['Metodologia' => $ObjMetodologia]);
    }

    public function Ver($MetodologiaId)
    {
        $ObjMetodologia = Metodologia::ObtenerPorId($MetodologiaId);
        $ObjFase = Fase::ListarPorMetodologia($ObjMetodologia->Id);
        $ObjElementoConfiguracion = ElementoConfiguracion::Listar();
        $ObjPlantillaECS = PlantillaElementoConfiguracion::Listar();
        return view('Metodologia.Ver', [
            'Metodologia' => $ObjMetodologia, 
            'ListadoFase' => $ObjFase,
            'ListadoElementoConfiguracion' => $ObjElementoConfiguracion,
            'ListadoPlantillaECS' => $ObjPlantillaECS
        ]);
    }

    public function ActAgregar(Request $request)
    {
        $ObjMetodologia = new Metodologia();
        $ObjMetodologia->Nombre = $request->input('TxtNombre');
        if(Metodologia::Agregar($ObjMetodologia) > 0)
        {
            return redirect()->action('MetodologiaController@Listar');
        }
    }

    public function ActEditar(Request $request)
    {
        $ObjMetodologia = Metodologia::ObtenerPorId($request->TxtId);
        $ObjMetodologia->Nombre = $request->input('TxtNombre');
        if(Metodologia::Editar($ObjMetodologia) > 0)
        {
            return redirect()->action('MetodologiaController@Listar');
        }
    }

    public function ActEliminar(Request $request)
    {
        try
        {
            $ObjMetodologia = Metodologia::ObtenerPorId($request->MetodologiaId);
            Metodologia::Eliminar($ObjMetodologia);
            return redirect()->action('MetodologiaController@Listar');
        } 
        catch (\Illuminate\Database\QueryException $e)
        {
            return redirect()->back();
        }
    }
}

?>