@extends('layouts.default')
@section('content')
<!-- title -->
<div class="app-title">
    <h1>Listado de Metodologías</h1>
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
              <th>NOMBRE</th>
              <th class="text-center" width="250px">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($ListadoMetodologia as $Key => $Metodologia)
                <tr>
                    <td class="text-center">{{ $Key + 1 }}</td>
                    <td>{{ $Metodologia->Nombre }}</td>
                    <td class="text-center">
                        <a href="/metodologia/ver/{{ $Metodologia->Id }}" class="btn btn-primary btn-sm text-uppercase">Ver</a>
                        <a href="/metodologia/editar/{{ $Metodologia->Id }}" class="btn btn-success btn-sm text-uppercase">Editar</a>
                        <a href="/metodologia/eliminar/{{ $Metodologia->Id }}" class="btn btn-danger btn-sm text-uppercase" onclick="return confirm('¿Estás seguro de que deseas eliminar esta Metodología?');">Eliminar</a>
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