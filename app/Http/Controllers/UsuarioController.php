<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario as Usuario;
use App\Models\TipoUsuario as TipoUsuario;

class UsuarioController extends Controller
{
    public function Listar(){
        $ListadoUsuario = Usuario::Listar();
        return view('Usuario.Listar',[
            'ListadoUsuario' => $ListadoUsuario
        ]);
    }

    public function FrmAgregar()
    {
        $ListadoTipoUsuario = TipoUsuario::Listar();
        return view('Usuario.Agregar',[
            'ListadoTipoUsuario' => $ListadoTipoUsuario
        ]);
    }

    public function FrmEditar($UsuarioId)
    {
        $ObjUsuario = Usuario::ObtenerPorId($UsuarioId);
        $ListadoTipoUsuario = TipoUsuario::Listar();
        return view('Usuario.Editar', [
            'Usuario' => $ObjUsuario,
            'ListadoTipoUsuario' => $ListadoTipoUsuario
        ]);
    }

    public function ActAgregar(Request $request)
    {
        try
        {
            $ObjUsuario = new Usuario();
            $ObjUsuario->Nombre = $request->input('TxtNombre');
            $ObjUsuario->Apellido = $request->input('TxtApellido');
            $ObjUsuario->Correo = strtolower($request->input('TxtCorreo'));
            $ObjUsuario->password = bcrypt('gestion');
            $ObjUsuario->TipoUsuarioId = $request->input('TxtTipoUsuarioId');
            if(Usuario::Agregar($ObjUsuario) > 0)
            {
                return redirect()->action('UsuarioController@Listar');
            }
        } 
        catch (\Illuminate\Database\QueryException $e)
        {
            return redirect()->action('UsuarioController@Listar');
        }
    }

    public function ActEditar(Request $request)
    {
        $ObjUsuario = Usuario::ObtenerPorId($request->TxtId);
        $ObjUsuario->Nombre = $request->input('TxtNombre');
        $ObjUsuario->Apellido = $request->input('TxtApellido');
        $ObjUsuario->TipoUsuarioId = $request->input('TxtTipoUsuarioId');
        if(Usuario::Editar($ObjUsuario) > 0)
        {
            return redirect()->action('UsuarioController@Listar');
        }
    }
}

?>