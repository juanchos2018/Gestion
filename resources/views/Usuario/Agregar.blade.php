@extends('layouts.default')
@section('content')
<!-- title -->
<div class="app-title">
    <h1>Nuevo Usuario</h1>
</div>
<!-- content -->
<div class="row">
    <div class="col-md-12">
        <form action="{{ url('usuario/agregar') }}" method="POST">
            <div class="tile">
                <div class="w-100">
                    <h4>Agregar</h4>
                </div>
                <hr>
                <div class="tile-body">     
                    <div class="form-group">
                        <label class="control-label">Nombre *</label>
                        <input class="form-control" name="TxtNombre" type="text" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Apellido</label>
                        <input class="form-control" name="TxtApellido" type="text" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Correo electrónico *</label>
                        <input class="form-control" name="TxtCorreo" type="email" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tipo de Usuario</label>
                        <select name="TxtTipoUsuarioId" class="form-control" required>
                            <option value="">[SELECCIONE UN TIPO DE USUARIO]</option>
                            @foreach($ListadoTipoUsuario as $TipoUsuario)
                            <option value="{{ $TipoUsuario->Id }}">{{ $TipoUsuario->Nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="tile-footer">
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn btn-primary text-uppercase" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Crear Usuario</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@stop