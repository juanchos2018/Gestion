<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rol as Rol;

class RolController extends Controller
{
    public function Listar(){
        $ListadoRol = Rol::Listar();
        return view('Rol.Listar',[
            'ListadoRol' => $ListadoRol
        ]);
    }

    public function FrmAgregar()
    {
        return view('Rol.Agregar');
    }

    public function FrmEditar($RolId)
    {
        $ObjRol = Rol::ObtenerPorId($RolId);
        return view('Rol.Editar', ['Rol' => $ObjRol]);
    }

    public function ActAgregar(Request $request)
    {
        $ObjRol = new Rol();
        $ObjRol->Nombre = $request->input('TxtNombre');
        if(Rol::Agregar($ObjRol) > 0)
        {
            return redirect()->action('RolController@Listar');
        }
    }

    public function ActEditar(Request $request)
    {
        $ObjRol = Rol::ObtenerPorId($request->TxtId);
        $ObjRol->Nombre = $request->input('TxtNombre');
        if(Rol::Editar($ObjRol) > 0)
        {
            return redirect()->action('RolController@Listar');
        }
    }
}

?>