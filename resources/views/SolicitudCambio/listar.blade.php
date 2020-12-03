@extends('layouts.default')
@section('content')

<!-- title -->
<div class="app-title">
    <h1><i class="fa fa-dashboard"></i> Listado de Solicitudes de Cambio </h1>
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
              <th class="text-center" width="10%">CODIGO</th>
              <th class="text-center" width="30%">PROYECTO</th>
              <th class="text-center" width="20%">Solicitante</th>
              
              <th class="text-center" width="10%">ESTADO</th>
              <th class="text-center" width="10%">FECHA</th>
              <th class="text-center" width="10%">Acciones</th>
            </tr>
          </thead>
          <tbody>

                @foreach($ListadoSolicitud as $be)
      
                  <tr>
                      <td class="text-center">1</td>
                      <td class="text-left">{{ $be->Codigo }}</td>
                      <td class="text-left">{{ $be->Nombre_Proyecto }}</td>
                      <td class="text-left">{{ $be->Nombre_Solicitante.' '.$be->Apellido_Solicitante }}</td>
                      <td class="text-center">
                        @php
                            switch($be->Estado){
                              case 1: $Estado = 'Pendiente'; break;
                              case 2: $Estado = 'Atendido'; break;
                              case 3: $Estado = 'Aceptado'; break;
                              case 4: $Estado = 'Rechazado'; break;
                            }
                        @endphp
                        
                        {{ $Estado}}
                      </td>
                      <td class="text-center">{{ $be->Fecha }}</td>
                      <td class="text-center">
                          @if (Auth::user()->TipoUsuarioId == 2)
                          <a href="../../SolicitudCambio/informe/{{$be->Id}}" class="btn btn-primary btn-sm"><i class="fa fa-file-text" aria-hidden="true"></i></a>    
                          @endif
                          
                          <a href="./../SolicitudCambio/edit/{{$be->Id}}" class="btn btn-warning btn-sm <?=$be->Estado == 1 ? '':'disabled' ?> "><i class="fa fa-pencil fa-2x m-0" aria-hidden="true"></i></a>
                          
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