<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fase as Fase;
use App\Models\Metodologia as Metodologia;

class FaseController extends Controller
{
    public function FrmEditar($FaseId)
    {
        $ObjFase = Fase::ObtenerPorId($FaseId);
        $ObjMetodologia = Metodologia::ObtenerPorId($ObjFase->MetodologiaId);
        return view('Fase.Editar', [
            'Fase' => $ObjFase,
            'Metodologia' => $ObjMetodologia
        ]);
    }

    public function ActAgregar(Request $request)
    {
        $ObjFase = new Fase();
        $ObjFase->Nombre = $request->input('TxtNombre');
        $ObjFase->MetodologiaId = $request->input('TxtMetodologia');
        if(Fase::Agregar($ObjFase) > 0)
        {
            return redirect()->action('MetodologiaController@Ver', ['MetodologiaId' => $ObjFase->MetodologiaId]);
        }
    }

    public function ActEditar(Request $request)
    {
        $ObjFase = Fase::ObtenerPorId($request->TxtId);
        $ObjFase->Nombre = $request->input('TxtNombre');
        if(Fase::Editar($ObjFase) > 0)
        {
            return redirect()->action('MetodologiaController@Ver', ['MetodologiaId' => $request->input('TxtMetodologia')]);
        }
    }

    public function ActEliminar(Request $request)
    {
        try
        {
            $ObjFase = Fase::ObtenerPorId($request->FaseId);
            $MetodologiaId = $request->Metodologia;
            Fase::Eliminar($ObjFase);
            return redirect()->action('MetodologiaController@Ver', ['MetodologiaId' => $MetodologiaId]);
        } 
        catch (\Illuminate\Database\QueryException $e)
        {
            return redirect()->back();
        } 
    }
}

?>