@extends('layouts.default')
@section('content')
<!-- title -->
<div class="app-title">
    <div>
    <h1>{{ $Rol->Nombre }}</h1>
    </div>
</div>
<!-- content -->
<div class="row">
    <div class="col-md-12">
        <form action="{{ url('rol/editar') }}" method="POST">
            <div class="tile">
                <div class="w-100">
                    <h4>Editar</h4>
                </div>
                <hr>
                <div class="tile-body">     
                    <div class="form-group">
                        <label class="control-label">Nombre *</label>
                        <input class="form-control" name="TxtNombre" type="text" value="{{ $Rol->Nombre }}" required>
                    </div>
                </div>
                <div class="tile-footer">
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="TxtId" value="{{ $Rol->Id }}" required>
                        <button class="btn btn-primary text-uppercase" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@stop