@extends('layouts.default')
@section('content')
<!-- title -->
<div class="app-title">
    <div>
        <h1>Fase {{ $Fase->Nombre }}</h1>
        <p>Metodología {{ $Metodologia->Nombre }}</p>
    </div>
</div>
<!-- content -->
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="w-100">
                <h4>Editar</h4>
            </div>
            <hr>
            <div class="tile-body">
                <!-- form -->
                <form action="/fase/editar" method="POST">
                    <div class="form-group">
                        <label class="control-label">Nombre</label>
                        <input type="text" name="TxtNombre" class="form-control" value="{{ $Fase->Nombre }}" required>
                    </div>
                    <div class="form-group pt-2">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="TxtId" value="{{ $Fase->Id }}" required>
                        <input type="hidden" name="TxtMetodologia" value="{{ $Fase->MetodologiaId }}" required>
                        <button type="submit" class="btn btn-primary text-uppercase"><i class="fa fa-check-circle" aria-hidden="true"></i>Guardar Cambios</button>
                    </div>
                </form>
                <!-- form -->
            </div>
        </div>
    </div>
</div>
@stop