@extends('layouts.default')
@section('content')

<!-- title -->
<div class="app-title">
    <h1><i class="fa fa-dashboard"></i> Agregar de Nueva Solicitud</h1>
</div>
<!-- content -->
<div class="row">
    <div class="col-md-12">
        <form action="/SolicitudCambio/store" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="tile">
                <h3 class="tile-title">Datos del Proyecto</h3>
                <div class="tile-body">     
                    <div class="form-group row">
                        <div class="col-md-9">
                            <label class="control-label">Proyecto </label>
                            <select required class="form-control" name="Proyecto_Id" id="Proyecto_Id">

                                @foreach($ListadoProyecto as $be)
                                <option value="{{ $be->ProyectoId }}">{{ $be->Codigo_Proyecto }} {{ $be->Nombre_Proyecto }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Fecha </label>
                            <input required type="date" value="<?=date('Y-m-d')?>" class="form-control text-center" id="Fecha" name="Fecha">
                        </div>
                    
                    </div>
                    
                </div>
            </div>
            <!-- fases -->
            <div class="tile">
                <h3 class="tile-title">Datos de la Solicitud de Cambio</h3>
                <div class="tile-body">
                    <div class="form-group">
                    <label class="control-label">Objetivo</label>
                       <input type="text" required class="form-control" id="Objetivo" name="Objetivo">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Descripción</label>
                        <textarea required class="form-control" name="Descripcion" id="Descripcion" rows="4"></textarea>
                    </div>
                  
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary text-uppercase" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Crear Solicitud</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    
</script>
@stop