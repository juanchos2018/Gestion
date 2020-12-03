@extends('layouts.default')
@section('content')

<!-- title -->
<div class="app-title">
    <h1><i class="fa fa-dashboard"></i> Editar Solicitud</h1>
</div>
<!-- content -->
<div class="row">
    <div class="col-md-12">
        <form action="/SolicitudCambio/update" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" value="{{$ObjSolicitud->Id}}" name="Id" id="Id">
            <div class="tile">
                <h3 class="tile-title">Datos del Proyecto</h3>
                <div class="tile-body">     
                    <div class="form-group row">
                        <div class="col-md-2">
                                <label class="control-label ">Codigo </label>
                                <input type="text" value="{{ $ObjSolicitud->Codigo }}" class="form-control text-center" readonly id="Codigo" name="Codigo">
                        </div>
                        <div class="col-md-7">
                            <label class="control-label">Proyecto </label>
                            <select class="form-control" name="Proyecto_Id" id="Proyecto_Id">
                                    @foreach($ListadoProyecto as $be)
                                    <option value="{{ $be->Id }}" {{ $be->Id == $ObjSolicitud->ProyectoId ? 'selected':'' }}>{{ $be->Nombre }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label ">Fecha </label>
                            <input type="date" value="{{ $ObjSolicitud->Fecha }}" class="form-control text-center" id="Fecha" name="Fecha">
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            <!-- fases -->
            <div class="tile">
                <h3 class="tile-title">Datos de la Solicitud de Cambio</h3>
                <div class="tile-body">
                    <div class="form-group row">
                        <div class="col-md-10">
                            <label class="control-label">Objetivo</label>
                                <input type="text" value="{{ $ObjSolicitud->Objetivo }}" class="form-control" id="Objetivo" name="Objetivo">
                        </div>
                        <div class="col-md-2">
                                <label class="control-label">Solicitante</label>
                                <input readonly type="text" value="{{ $ObjSolicitud->Usuario_Solicitante }}" class="form-control" id="Solicitante" name="Solicitante">
                            </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label">Descripción</label>
                        <textarea class="form-control" name="Descripcion" id="Descripcion" rows="4">{{ $ObjSolicitud->Descripcion }}</textarea>
                    </div>
                  
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary text-uppercase" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar Solicitud</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    
</script>
@stop