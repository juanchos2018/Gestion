@extends('layouts.default')
@section('content')
<!-- title -->
<div class="app-title">
    <div>
        <h1>{{ $MiembroProyecto->Usuario->Nombre.' '.$MiembroProyecto->Usuario->Apellido }}</h1>
        <p>{{ $MiembroProyecto->Rol->Nombre }} - {{ $MiembroProyecto->Proyecto->Nombre }}</p>
    </div>
</div>
<!-- content -->
<div class="row">
    <div class="col-md-12">
        <form action="{{ url('miembro-proyecto/editar') }}" method="POST">
            <div class="tile">
                <div class="w-100">
                    <h4>Editar</h4>
                </div>
                <hr>
                <div class="form-group">
                    <label class="control-label">Miembro</label>
                    <input type="text" class="form-control" value="{{ $MiembroProyecto->Usuario->Nombre }}" readonly/>
                </div>
                <div class="form-group">
                    <label class="control-label">Rol</label>
                    <select name="TxtRolId" class="form-control" required>
                        @foreach($ListadoRol as $Rol)
                        <option value="{{ $Rol->Id }}" {{ ($Rol->Id==$MiembroProyecto->Rol->Id?'selected':'') }}>{{ $Rol->Nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="tile-footer">
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="TxtId" value="{{ $MiembroProyecto->Id }}" required>
                        <input type="hidden" name="TxtProyectoId" value="{{ $MiembroProyecto->Proyecto->Id }}" required>
                        <button class="btn btn-primary text-uppercase" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@stop