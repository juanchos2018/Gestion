<?php

namespace App\Http\Controllers;

use App\Models\CronogramaFase;
use Illuminate\Http\Request;

class CronogramaFaseController extends Controller
{
    public function ListarPorMetodologiaId($MetodologiaId){

        return view('MetodologiaFase.componente_listar_por_metodologia',[
            'ListadoMetodologiaFase' => CronogramaFase::ListarPorMetodologiaId($MetodologiaId) //CronogramaFase::
        ]);
    }


}

?>