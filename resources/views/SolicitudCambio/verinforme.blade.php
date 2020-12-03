@extends('layouts.default')
@section('content')

<!-- title -->
<div class="app-title">
    <h1><i class="fa fa-dashboard"></i> Informe de Solicitud de Cambio</h1>
</div>
<!-- content -->
<div class="row">
    <div class="col-md-12">
        <form action="/SolicitudCambio/respondersolicitud" method="post">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        {{-- <input type="hidden" value="{{$Asolicitudcambio->Id}}" name="Id" id="Id"> --}}
            
            <!-- fases -->
            <div class="tile">
                <h3 class="tile-title">Datos del Informe de Cambio</h3>
                <div class="tile-body">
                    <div class="form-group row">

                        <div class="col-md-2">
                            <label class="control-label">Codigo : </label>
                            <input type="text" readonly class="form-control text-center" value="{{ $objInforme->Codigo }}" name="Fecha" id="Fecha">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Fecha : </label>
                            <input type="text" readonly class="form-control text-center" value="{{ $objInforme->Fecha }}" name="Fecha" id="Fecha">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Solicitud Asociado: </label>
                            <input type="text" readonly class="form-control text-center" value="{{ $objSolicitud->Codigo }}" name="Codigo_Solicitud" id="Codigo_Solicitud">
                            <input type="hidden" readonly class="form-control text-center" value="{{ $objSolicitud->Id }}" name="SolicitudCambioId" id="SolicitudCambioId">
                            
                        </div>

                        

                        <div class="col-md-3">
                            <label class="control-label">Costo Economico </label>
                        <input type="number" readonly value="{{ $objInforme->CostoEconomico }}" step="any" class="form-control text-right" name="CostoEconomico" id="CostoEconomico">
                        </div>
        
                        <div class="col-md-3">
                            <label class="control-label">Tiempo Estimado (Horas) </label>
                            <input type="number" readonly value="{{ $objInforme->Tiempo }}" step="any" class="form-control text-right" name="Tiempo" id="Tiempo">
                        </div>

                        
                    </div>
                    <div class="form-group row">

                        <div class="col-md-6">
                            <label class="control-label">Descripcion </label>
                            <textarea readonly name="Descripcion" id="Descripcion" class="form-control text-left" cols="30" rows="6">{{ $objInforme->Descripcion }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="control-label">Impacto del Problema </label>
                            <textarea readonly name="ImpactoProblema" id="ImpactoProblema" class="form-control text-left" cols="30" rows="6">{{ $objInforme->ImpactoProblema }}</textarea>
                        </div>

                                

        
        
                        <div class="col-md-12">
                        <br><br>
                            <h5 class="tile-title">Detalle de Informe</h5>
                        </div>
        
    
                        <div class="col-md-12">
                        <br>
                        </div>
                        
                        <div class="table-responsive" id="BlockDetalleInforme">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">ECS</th>
                                    <th class="text-center">Tiempo</th>
                                    <th class="text-center">Costo</th>
                                    <th class="text-center">Descripcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <? $i = 1; ?>
                                   @foreach($ListadoDetalleInforme as $be)
                                   <tr> 
                                   <td class="text-center">{{ $i }}</td>
                                        <td class="text-left">{{ $be->Nombre_ECS }} </td>
                                        <td class="text-left">{{ $be->Tiempo }} </td>
                                        <td class="text-right">{{ $be->Costo }} </td>
                                        <td class="text-left">{{ $be->Descripcion }} </td>
                                    </tr>
                                    <? $i++; ?>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>


                        
                        <div class="col-md-12">
                            <br><br>
                            <h5 class="tile-title">Respuesta de la Solicitud</h5>
                        </div>

                        <div class="col-md-10">
                            <label class="control-label">Respuesta </label>
                            <textarea required name="Respuesta" id="Respuesta" class="form-control text-left" cols="30" rows="5">{{ $objSolicitud->Respuesta }}</textarea>
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Estado </label>
                            <select name="Estado" id="Estado" class="form-control">
                                <option {{ $objSolicitud->Estado == 1 ? 'selected':'' }} value="1">Pendiente</option>
                                <option {{ $objSolicitud->Estado == 2 ? 'selected':'' }} value="2">Atendido</option>
                                <option {{ $objSolicitud->Estado == 3 ? 'selected':'' }} value="3">Aceptado</option>
                                <option {{ $objSolicitud->Estado == 4 ? 'selected':'' }} value="4">Rechazado</option>
                            </select>
                            <br>
                            <button class="btn btn-success text-uppercase form-control" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar</button>
                        </div>

                        
                        
                    </div>

                    
             
                  
                </div>
                <div class="tile-footer">
                    {{-- <button class="btn btn-primary text-uppercase" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Crear Solicitud</button> --}}
                    <a href="../../SolicitudCambio/listar" class="btn btn-primary text-uppercase">REGRESAR</a>
                    
                    
                </div>
            </div>
        </form>
    </div>
</div>




<script>
    
    function Fnc_ECS(){

        var FaseId = $('#FaseIdM').val();
        var _token = $('#_token').val();
        var parametros = {
                    "FaseId" : FaseId,
                    "_token" : _token, 
                };

        $.ajax({

            data:  parametros,
            url:   '../../SolicitudCambio/ViewESC',
            type:  'POST',
            beforeSend: function () {
            
            },
            success:  function (data) {
                // console.log(data);
                $('#ESCIdM').html(data);
            }
        });

    }


    function AddDetalleCambio(){

        var FaseId = $('#FaseIdM').val();
        var ESCId = $('#ESCIdM').val();
        var Tiempo = $('#TiempoM').val();
        var Costo = $('#CostoM').val();
        var Descripcion = $('#DescripcionM').val();
        var _token = $('#_token').val();
        
        var MM_search = "AddDetelleCambio";

        var parametros = {
                            "FaseId" : FaseId,
                            "ESCId" : ESCId,
                            "Tiempo" : Tiempo,
                            "Costo" : Costo,
                            "Descripcion" : Descripcion,
                            "MM_search" : MM_search, 
                            "_token" : _token, 
                        };

        $.ajax({

                data:  parametros,
                url:   '../../SolicitudCambio/AgregarDetalleInforme',
                type:  'POST',
                beforeSend: function () {
                
                },
                success:  function (data) {
                    // console.log(data);
                    $('#BlockDetalleInforme').html(data);
                    Tiempo_Costo();
                }
            });
    
    }

    function Fnc_DeleteDetalleInforme(ESCId){

    
        var _token = $('#_token').val();

        var parametros = {
                            "ESCId" : ESCId,
                            "_token" : _token, 
                        };

        $.ajax({

                data:  parametros,
                url:   '../../SolicitudCambio/EliminarDetalleInforme',
                type:  'POST',
                beforeSend: function () {
                
                },
                success:  function (data) {
                    // console.log(data);
                    $('#BlockDetalleInforme').html(data);
                    Tiempo_Costo();
                }
            });

    }

    function Tiempo_Costo(){

            var MM_search = "AddDetelleCambio";
            var _token = $('#_token').val();
            var parametros = {
                                
                                "MM_search" : MM_search, 
                                "_token" : _token, 
                            };

            $.ajax({

                    data:  parametros,
                    url:   '../../SolicitudCambio/TiempoSolicitud',
                    type:  'POST',
                    dataType: 'json',
                    beforeSend: function () {
                    
                    },
                    success:  function (data) {
                     
                        $('#Tiempo').val(data.Tiempo);
                        $('#CostoEconomico').val(data.Costo);
                    }
                });

    }

    
</script>



@stop