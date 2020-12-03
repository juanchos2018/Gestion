@extends('layouts.default')
@section('content')

<!-- title -->
<div class="app-title">
    <div>
        <h1>Miembros</h1>
        <p>{{ $Proyecto->Nombre }}</p>
    </div>
    <div class="py-2">
        <button type="button" data-toggle="modal" data-target="#ModalAgregarMiembro" class="btn btn-sm btn-primary text-uppercase"><i class="fa fa-plus"></i> Agregar</button>
    </div>
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
              <th>USUARIO</th>
              <th>ROL</th>
              <th class="text-center" width="200px">ACCIONES</th>
            </tr>
          </thead>
          <tbody>
            @foreach($ListadoMiembroProyecto as $key => $Miembro)
                <tr>
                    <td class="text-center">{{$key+1}}</td>
                    <td>{{$Miembro->Usuario->Nombre.' '.$Miembro->Usuario->Apellido}}</td>
                    <td>{{$Miembro->Rol->Nombre}}</td>
                    <td class="text-center">
                        <a href="/miembro-proyecto/editar/{{ $Miembro->Id }}/p{{ $Proyecto->Id }}" class="btn btn-success btn-sm text-uppercase">Editar</a>
                        <a href="/miembro-proyecto/eliminar/{{ $Miembro->Id }}/p{{ $Proyecto->Id }}" class="btn btn-danger btn-sm text-uppercase" onclick="return confirm('¿Estás seguro de que deseas eliminar del Proyecto a {{ $Miembro->Usuario->Nombre }}?');">Eliminar</a>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Agregar Miembro -->
<div class="modal fade" id="ModalAgregarMiembro" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuevo Miembro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- form -->
        <form action="{{ url('miembro-proyecto/agregar') }}" method="POST">
            <div class="form-group">
                <label class="control-label">Miembro</label>
                <select name="TxtUsuarioId" class="form-control" required>
                    <option value="">[SELECCIONE UN USUARIO]</option>
                    @foreach($ListadoUsuario as $Usuario)
                    <option value="{{ $Usuario->Id }}">{{ $Usuario->Nombre.' '.$Usuario->Apellido }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="control-label">Rol</label>
                <select name="TxtRolId" class="form-control" required>
                    <option value="">[SELECCIONE UN ROL]</option>
                    @foreach($ListadoRol as $Rol)
                    <option value="{{ $Rol->Id }}">{{ $Rol->Nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group pt-2">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="TxtProyectoId" value="{{ $Proyecto->Id }}" required>
                <button type="submit" class="btn btn-primary text-uppercase"><i class="fa fa-check-circle"></i>Agregar Miembro</button>
            </div>
        </form>
        <!-- form -->
      </div>
    </div>
  </div>
</div>
<!-- Modal Agregar Miembro -->
@stop