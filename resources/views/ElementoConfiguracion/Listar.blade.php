@extends('layouts.default')
@section('content')
<!-- title -->
<div class="app-title">
    <h1>Listado de Elementos de Configuración</h1>
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
              <th>CÓDIGO</th>
              <th>NOMBRE</th>
              <th class="text-center" width="250px">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($ListadoECS as $Key => $ECS)
                <tr>
                    <td class="text-center">{{ $Key + 1 }}</td>
                    <td>{{ $ECS->Codigo }}</td>
                    <td>{{ $ECS->Nombre }}</td>
                    <td class="text-center">
                        <a href="/elemento-configuracion/editar/{{ $ECS->Id }}" class="btn btn-success btn-sm text-uppercase">Editar</a>
                        <a href="/elemento-configuracion/eliminar/{{ $ECS->Id }}" class="btn btn-danger btn-sm text-uppercase" onclick="return confirm('¿Estás seguro de que deseas eliminar este ECS?');">Eliminar</a>
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