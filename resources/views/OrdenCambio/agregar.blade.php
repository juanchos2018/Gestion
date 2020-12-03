@extends('layouts.default')
@section('content')

<!-- title -->
<div class="app-title">
    <h1><i class="fa fa-dashboard"></i> Crear Orden de Cambio</h1>
</div>
<!-- content -->
<div class="row">
    <div class="col-md-12">
        <form action="/OrdenCambio/createorden" method="post">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        {{-- <input type="hidden" value="{{$Asolicitudcambio->Id}}" name="Id" id="Id"> --}}
            
            <!-- fases -->
            <div class="tile">
                <h3 class="tile-title">Datos del Informe de Cambio</h3>
                <div class="tile-body">
                    <div class="form-group row">

                        <div class="col-md-3">
                            <label class="control-label">Solicitud Asociado: </label>
                            <select required onchange="Fnc_FasePorProyecto();" name="SolicitudCambioId" id="SolicitudCambioId" class="form-control">
                                @foreach ($ListadoSolicitud as $be)
                            <option value="{{ $be->Id }}">{{ $be->Codigo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="control-label">Fecha de Aprobación: </label>
                            <input required type="date" readonly class="form-control text-center" value="<?=date('Y-m-d')?>" name="FechaAprobación" id="FechaAprobación">
                        </div>
                        
                        <div class="col-md-3">
                            <label class="control-label">Fecha de Inicio: </label>
                            <input required type="date"  class="form-control text-center" value="" name="FechaInicio" id="FechaInicio">
                        </div>

                        <div class="col-md-3">
                            <label class="control-label">Fecha de Termino: </label>
                            <input required type="date"  class="form-control text-center" value="" name="FechaTermino" id="FechaTermino">
                        </div>

   
                        
                    </div>
                    <div class="form-group row">

                        <div class="col-md-12">
                            <label class="control-label">Descripcion </label>
                            <textarea required name="Descripcion" id="Descripcion" class="form-control text-left" cols="30" rows="4"></textarea>
                        </div>

                                

        
        
                        <div class="col-md-12">
                        <br><br>
                        <h5 class="tile-title">Detalle Orden de Cambio</h5>
                        </div>
        
        
                    
                        
                       
                        <div class="col-md-2">
                            <label class="control-label">Fases </label>
                            <select name="FaseIdM" id="FaseIdM" onchange="Fnc_ECSPorFase()" class="form-control">
                                   
                            </select>
                        </div>
        
                        <div class="col-md-3">
                            <label class="control-label">ECS </label>
                            <select name="ECSIdM" id="ECSIdM" class="form-control">
                               
                            </select>
                        </div>
                        
                        <div class="col-md-3">
                            <label class="control-label">Responsable </label>
                            <select name="Responsable" id="Responsable" class="form-control">
                                
                            </select>
                        </div>

                        <div class="col-md-2">
                                <label class="control-label">Fecha de Inicio </label>
                                <input name="FechaInicioD" id="FechaInicioD" type="date" class="form-control">
                        </div>
                        <div class="col-md-2">
                                <label class="control-label">Fecha de Termino </label>
                                <input name="FechaTerminoD" id="FechaTerminoD" type="date" class="form-control">
                        </div>

                        <div class="col-md-10">
                            <label class="control-label">Descripcion </label>
                            <textarea name="DescripcionM" id="DescripcionM" cols="30" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="col-md-2">
                                <label class="control-label">. </label>
                                <input type="button" onclick="AddDetalleOrdenCambio();" class="form-control btn btn-info" id="" name="" value="AGREGAR">
                            </div>
        
                     
                        
                        
                        
        
        
                        <div class="col-md-12">
                        <br>
                        </div>
                        
                        <div class="table-responsive" id="BlockDetalleOrden">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">ECS</th>
                                    <th class="text-center">Tiempo</th>
                                    <th class="text-center">Costo</th>
                                    <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                  
                               
                                    
                                </tbody>
                            </table>
                        </div>
                        
                        
                    </div>

                    
             
                  
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary text-uppercase" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar Orden de Cambio</button>
                </div>
            </div>
        </form>
    </div>
</div>




<script>
    

    
    function Fnc_FasePorProyecto(){

            var SolicitudCambioId = $('#SolicitudCambioId').val();
            var _token = $('#_token').val();
            var parametros = {
                        "SolicitudCambioId" : SolicitudCambioId,
                        "_token" : _token, 
                    };

            $.ajax({

                data:  parametros,
                url:   '../../OrdenCambio/FasePorProyecto',
                type:  'POST',
                beforeSend: function () {
                
                },
                success:  function (data) {
                    
                    $('#FaseIdM').html(data);
                    Fnc_ECSPorFase();
                    Fnc_MiembrosPorProyecto();
                }
            });

    }
    
    function Fnc_ECSPorFase(){
        var FaseId = $('#FaseIdM').val();
        var _token = $('#_token').val();
        var parametros = {
                    "FaseId" : FaseId,
                    "_token" : _token, 
                };

        $.ajax({

            data:  parametros,
            url:   '../../OrdenCambio/ECSPorFase',
            type:  'POST',
            beforeSend: function () {
            
            },
            success:  function (data) {
                
                $('#ECSIdM').html(data);
            }
        });

    }

    function Fnc_MiembrosPorProyecto(){

        var SolicitudCambioId = $('#SolicitudCambioId').val();
        var _token = $('#_token').val();
        var parametros = {
                    "SolicitudCambioId" : SolicitudCambioId,
                    "_token" : _token, 
                };

        $.ajax({

            data:  parametros,
            url:   '../../OrdenCambio/MiembrosPorProyeto',
            type:  'POST',
            beforeSend: function () {
            
            },
            success:  function (data) {
                
                $('#Responsable').html(data);
            }
        });

    }

    function AddDetalleOrdenCambio(){

        
        var ECSIdM = $('#ECSIdM').val();
        var Responsable = $('#Responsable').val();
        var FechaInicioD = $('#FechaInicioD').val();
        var FechaTerminoD = $('#FechaTerminoD').val();
        var DescripcionM = $('#DescripcionM').val();
        var _token = $('#_token').val();
        
        if(ECSIdM == ""){
            alert("Seleccione un ECS");
            return false;
        }
        if(Responsable == ""){
            alert("Seleccione un responsable");
            return false;
        }
        if(FechaInicioD == ""){
            alert("Seleccione una Fecha de Inicio");
            return false;
        }
        if(FechaTerminoD == ""){
            alert("Seleccione una Fecha de Termino");
            return false;
        }
        if(DescripcionM == ""){
            alert("Seleccione una Descripcion");
            return false;
        }
   
        var parametros = {
                            "ECSIdM" : ECSIdM,
                            "Responsable" : Responsable,
                            "FechaInicioD" : FechaInicioD,
                            "FechaTerminoD" : FechaTerminoD,
                            "DescripcionM" : DescripcionM,
                            "_token" : _token, 
                        };

        $.ajax({

                data:  parametros,
                url:   '../../OrdenCambio/AgregarDetalleOrden',
                type:  'POST',
                beforeSend: function () {
                
                },
                success:  function (data) {
                    console.log(data);
                    $('#BlockDetalleOrden').html(data);
                    // Tiempo_Costo();
                }
            });
    
    }

    function Fnc_DeleteDetalleOrden(ESCId){

    
        var _token = $('#_token').val();

        var parametros = {
                            "ESCId" : ESCId,
                            "_token" : _token, 
                        };

        $.ajax({

                data:  parametros,
                url:   '../../OrdenCambio/EliminarDetalleOrden',
                type:  'POST',
                beforeSend: function () {
                
                },
                success:  function (data) {
                    // console.log(data);
                    $('#BlockDetalleOrden').html(data);
                    
                    
                }
            });

    }

    

    
</script>

<script>
    $( document ).ready(function() {
        
        setTimeout(function(){ Fnc_FasePorProyecto(); }, 2000);
    });

</script>


@stop