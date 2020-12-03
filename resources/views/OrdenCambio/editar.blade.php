@extends('layouts.default')
@section('content')

<!-- title -->
<div class="app-title">
    <h1><i class="fa fa-dashboard"></i> Crear Orden de Cambio</h1>
</div>
<!-- content -->
<div class="row">
    <div class="col-md-12">
        <form action="/OrdenCambio/editorden" method="post">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <input type="hidden" value="{{$objOrdenCambio->Id}}" name="Id" id="Id">
            
            <!-- fases -->
            <div class="tile">
                <h3 class="tile-title">Datos del Informe de Cambio</h3>
                <div class="tile-body">
                    <div class="form-group row">

                        <div class="col-md-3">
                            <label class="control-label">Solicitud Asociado: </label>
                        <input type="text" class="form-control text-center" readonly value="{{ $objOrdenCambio->Codigo_Solicitud}}">
                        </div>

                        <div class="col-md-3">
                            <label class="control-label">Fecha de Aprobación: </label>
                            <input readonly type="date" readonly class="form-control text-center" value="{{ $objOrdenCambio->FechaAprobación}}" name="FechaAprobación" id="FechaAprobación">
                        </div>

                        <div class="col-md-3">
                            <label class="control-label">Fecha de Inicio: </label>
                            <input readonly type="date"  class="form-control text-center" value="{{ $objOrdenCambio->FechaInicio}}" name="FechaInicio" id="FechaInicio">
                        </div>

                        <div class="col-md-3">
                            <label class="control-label">Fecha de Termino: </label>
                            <input readonly type="date"  class="form-control text-center" value="{{ $objOrdenCambio->FechaTermino}}" name="FechaTermino" id="FechaTermino">
                        </div>

   
                        
                    </div>
                    <div class="form-group row">

                        <div class="col-md-10">
                            <label class="control-label">Descripcion </label>
                            <textarea readonly name="Descripcion" id="Descripcion" class="form-control text-left" cols="30" rows="4">{{ $objOrdenCambio->Descripcion}}</textarea>
                        </div>

                        <div class="col-md-2">
                                <label class="control-label">% Avance: </label>
                                <input required type="number" step="any"  class="form-control text-center" value="{{ $objOrdenCambio->PorcertanjeAvance}}" name="PorcertanjeAvance" id="PorcertanjeAvance">
                                <label class="control-label">Estado: </label>
                                <input required readonly type="text" class="form-control text-center" value="{{ $objOrdenCambio->Estado}}" name="Estado" id="Estado">
                            </div>

                                

        
        
                        <div class="col-md-12">
                        <br><br>
                            <h5 class="tile-title">Detalle Orden de Cambio</h5>
                        </div>

                        <div class="col-md-12">
                        <br>
                        </div>
                        
                        <div class="table-responsive" id="BlockDetalleOrden">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Responsable</th>
                                    <th class="text-center">ECS</th>
                                    <th class="text-center">Desde</th>
                                    <th class="text-center">Hasta</th>
                                    <th class="text-center">% Avance</th>
                                    <th class="text-center">Descripcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i= 1; ?>
                                    @foreach ($ListadoDetalleOrden as $be)
                                    <tr>
                                        <td class="text-center">{{$i}}</td>
                                        <td class="text-left">{{$be->Nombre_Responsable}} {{$be->Apellido_Responsable}}</td>
                                        <td class="text-left">{{$be->Nombre_ECS}}</td>
                                        <td class="text-center">{{$be->FechaInicio}}</td>
                                        <td class="text-center">{{$be->FechaTermino}}</td>
                                        <td class="text-center">{{$be->PorcertanjeAvance}}</td>
                                        <td class="text-left">{{$be->Descripcion}}</td>
                                    </tr> 
                                    <?php $i++; ?>    
                                    @endforeach
                               
                                    
                                </tbody>
                            </table>
                        </div>
                        
                        
                    </div>

                    
             
                  
                </div>
                <div class="tile-footer">
                    
                    <a class="btn btn-primary text-uppercase" href="/OrdenCambio/listar">REGRESAR</a>
                    <button class="btn btn-primary text-uppercase" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar Orden de Cambio</button>
                </div>
            </div>
        </form>
    </div>
</div>






@stop