@extends('layouts.default')
@section('content')

<!-- title -->
<div class="app-title">
    <h1>Listado de Roles</h1>
</div>
<!-- content -->
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body table-responsive">
        <table class="table table-hover table-bordered" id="TableData">
          <thead>
            <tr>
              <th class="text-center" width="40px">#</th>
              <th>NOMBRE</th>
              <th class="text-center" width="100px">ACCIONES</th>
            </tr>
          </thead>
          <tbody>
            @foreach($ListadoRol as $key => $Rol)
                <tr>
                    <td class="text-center">{{$key+1}}</td>
                    <td>{{$Rol->Nombre}}</td>
                    <td class="text-center">
                        <a href="/rol/editar/{{ $Rol->Id }}" class="btn btn-success btn-sm text-uppercase">Editar</a>
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