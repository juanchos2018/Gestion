@extends('layouts.default')
@section('content')
<!-- title -->
<div class="app-title">
    <div>
        <h1>{{ $ECS->Nombre }}</h1>
        <p>{{ $ECS->Codigo }}</p>
    </div>
</div>
<!-- content -->
<div class="row">
    <div class="col-md-12">
        <form action="/elemento-configuracion/editar" method="POST">
            <div class="tile">
                <div class="w-100">
                    <h4>Editar</h4>
                </div>
                <hr>
                <div class="tile-body">
                    <div class="form-group">
                        <label class="control-label">Código</label>
                        <input class="form-control" name="TxtCodigo" type="text" value="{{ $ECS->Codigo }}" required>
                    </div>     
                    <div class="form-group">
                        <label class="control-label">Nombre</label>
                        <input class="form-control" name="TxtNombre" type="text" value="{{ $ECS->Nombre }}" required>
                    </div>
                </div>
                <div class="tile-footer">
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="TxtId" value="{{ $ECS->Id }}" required>
                        <button class="btn btn-primary text-uppercase" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar cambios</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@stop