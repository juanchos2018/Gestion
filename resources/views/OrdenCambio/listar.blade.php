@extends('layouts.default')
@section('content')

<!-- title -->
<div class="app-title">
    <h1><i class="fa fa-dashboard"></i> Listado de Orden de Cambios </h1>
</div>
<!-- content -->
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body table-responsive">
        <table class="table table-hover table-bordered" id="TableData">
          <thead>
            <tr>
              <th class="text-center" width="5%">#</th>
              <th class="text-center" width="10%">Sol. Asoc.</th>
              <th class="text-center" width="30%">PROYECTO</th>
              <th class="text-center" width="20%">Jefe</th>
              <th class="text-center" width="10%">Fecha</th>
              <th class="text-center" width="10%">Estado</th>
              <th class="text-center" width="10%">Acciones</th>
            </tr>
          </thead>
          <tbody>
                <?php
                $i = 1;
                ?>
                @foreach ($ListadoOrdenCambio as $be)
                <tr>
                    <td class="text-center">{{$i}}</td>
                    <td class="text-center">{{$be->Codigo_Solicitud}}</td>
                    <td class="text-center">{{$be->Nombre_Proyecto}}</td>
                    <td class="text-center">{{$be->Nombre_Jefe}} {{$be->Apellido_Jefe}}</td>
                    <td class="text-center">{{$be->FechaAprobación}}</td>
                    <td class="text-center">{{$be->Estado}}</td>
                    <td class="text-center">
                      
                      <a href="./../OrdenCambio/edit/{{$be->Id}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil fa-2x m-0" aria-hidden="true"></i></a>
                      
                  </td>
                </tr>  
                <?php
                $i++;
                ?>
                @endforeach
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@stop