@extends('layouts.default')
@section('content')
<!-- title -->
<div class="app-title">
    <div>
    <h1>{{ $Usuario->Nombre.' '.$Usuario->Apellido }}</h1>
    <p>{{ $Usuario->Correo }}</p>
    </div>
</div>
<!-- content -->
<div class="row">
    <div class="col-md-12">
        <form action="{{ url('usuario/editar') }}" method="POST">
            <div class="tile">
                <div class="w-100">
                    <h4>Editar</h4>
                </div>
                <hr>
                <div class="tile-body">     
                    <div class="form-group">
                        <label class="control-label">Nombre *</label>
                        <input class="form-control" name="TxtNombre" type="text" value="{{ $Usuario->Nombre }}" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Apellido</label>
                        <input class="form-control" name="TxtApellido" type="text" value="{{ $Usuario->Apellido }}" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Correo electrónico *</label>
                        <input class="form-control" name="TxtCorreo" type="email" value="{{ $Usuario->Correo }}" readonly>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tipo de Usuario</label>
                        <select name="TxtTipoUsuarioId" class="form-control" required>
                            @foreach($ListadoTipoUsuario as $TipoUsuario)
                            <option value="{{ $TipoUsuario->Id }}" {{$TipoUsuario->Id==$Usuario->TipoUsuarioId?'selected':''}}>{{ $TipoUsuario->Nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="tile-footer">
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="TxtId" value="{{ $Usuario->Id }}" required>
                        <button class="btn btn-primary text-uppercase" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@stop