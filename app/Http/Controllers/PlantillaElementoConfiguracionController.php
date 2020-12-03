<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlantillaElementoConfiguracion as PlantillaElementoConfiguracion;

class PlantillaElementoConfiguracionController extends Controller
{
    public function ActAgregar(Request $request)
    {
        $ObjPECS = new PlantillaElementoConfiguracion();
        $ObjPECS->FaseId = $request->input('TxtFase');
        $ObjPECS->ElementoConfiguracionId = $request->input('TxtElementoConfiguracion');
        $MetodologiaId = $request->input('TxtMetodologia');
        if(PlantillaElementoConfiguracion::Agregar($ObjPECS) > 0)
        {
            return redirect()->action('MetodologiaController@Ver', ['MetodologiaId' => $MetodologiaId]);
        }
    }

    public function ActEliminar(Request $request)
    {
        try
        {
            $ObjPECS = PlantillaElementoConfiguracion::ObtenerPorId($request->PlantillaElementoConfiguracionId);
            $MetodologiaId = $request->Metodologia;
            PlantillaElementoConfiguracion::Eliminar($ObjPECS);
            return redirect()->action('MetodologiaController@Ver', ['MetodologiaId' => $MetodologiaId]);
        } 
        catch (\Illuminate\Database\QueryException $e)
        {
            return redirect()->back();
        }
    }
}

?>