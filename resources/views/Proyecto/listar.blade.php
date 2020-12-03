@extends('layouts.default')
@section('content')

<!-- title -->
<div class="app-title">
    <h1><i class="fa fa-dashboard"></i> Listado de Proyectos </h1>
</div>
<!-- content -->
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body table-responsive">
        <table class="table table-hover table-bordered" id="TableData">
          <thead>
            <tr>
              <th class="text-center" width="25px">#</th>
              <th>NOMBRE DEL PROYECTO</th>
              <th>FECHA DE INICIO</th>
              <th>FECHA DE FINALIZACION</th>
              <th class="text-center">ESTADO</th>
              <th class="text-center" width="200px">ACCIONES</th>
            </tr>
          </thead>
          <tbody>
            @foreach($ListadoProyecto as $Proyecto)
                <tr>
                    <td class="text-center">{{$Proyecto->Id}}</td>
                    <td>{{$Proyecto->Nombre}}</td>
                    <td>{{$Proyecto->FechaInicio}}</td>
                    <td>{{$Proyecto->FechaTermino}}</td>
                    <td class="text-center">{{$Proyecto->Estado}}</td>
                    <td class="text-center">
                        <a href="/proyecto/p{{$Proyecto->Id}}" class="btn btn-success btn-sm text-uppercase">Seleccionar</a>
                        <a href="/miembro-proyecto/listar/p{{$Proyecto->Id}}" class="btn btn-primary btn-sm text-uppercase">Miembros</a>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@stop