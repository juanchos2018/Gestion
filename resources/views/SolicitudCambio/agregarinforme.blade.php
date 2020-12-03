@extends('layouts.default')
@section('content')

<!-- title -->
<div class="app-title">
    <h1><i class="fa fa-dashboard"></i> Crear Informe de Solicitud de Cambio</h1>
</div>
<!-- content -->
<div class="row">
    <div class="col-md-12">
        <form action="/SolicitudCambio/createinforme" method="post">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        {{-- <input type="hidden" value="{{$Asolicitudcambio->Id}}" name="Id" id="Id"> --}}
            
            <!-- fases -->
            <div class="tile">
                <h3 class="tile-title">Datos del Informe de Cambio</h3>
                <div class="tile-body">
                    <div class="form-group row">

                        <div class="col-md-3">
                            <label class="control-label">Fecha : </label>
                            <input type="date" readonly class="form-control text-center" value="<?=date('Y-m-d')?>" name="Fecha" id="Fecha">
                        </div>

                        <div class="col-md-3">
                            <label class="control-label">Solicitud Asociado: </label>
                            <input type="text" readonly class="form-control text-center" value="{{ $objSolicitud->Codigo }}" name="Codigo_Solicitud" id="Codigo_Solicitud">
                            <input type="hidden" class="form-control text-center" value="{{ $objSolicitud->Id }}" name="SolicitudCambioId" id="SolicitudCambioId">
                        </div>

                        

                        <div class="col-md-3">
                            <label class="control-label">Costo Economico </label>
                            <input required type="number" readonly value="0.00" step="any" class="form-control text-right" name="CostoEconomico" id="CostoEconomico">
                        </div>
        
                        <div class="col-md-3">
                            <label class="control-label">Tiempo Estimado (Horas) </label>
                            <input required type="number" readonly value="0" step="any" class="form-control text-right" name="Tiempo" id="Tiempo">
                        </div>

                        
                    </div>
                    <div class="form-group row">

                        <div class="col-md-6">
                            <label class="control-label">Descripcion </label>
                            <textarea required name="Descripcion" id="Descripcion" class="form-control text-left" cols="30" rows="6"></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="control-label">Impacto del Problema </label>
                            <textarea required name="ImpactoProblema" id="ImpactoProblema" class="form-control text-left" cols="30" rows="6"></textarea>
                        </div>

                                

        
        
                        <div class="col-md-12">
                        <br><br>
                            <h5 class="tile-title">DETALLE DE INFORME</h5>
                        </div>
        
        
                    
                        
                       
                        <div class="col-md-3">
                            <label class="control-label">Fases </label>
                            <select name="FaseIdM" id="FaseIdM" onchange="Fnc_ECS()" class="form-control">
                                    @foreach($ListadoFase as $be)
                                    <option value="{{ $be->Id }}" >{{ $be->Nombre }}</option>
                                    @endforeach
                            </select>
                        </div>
        
                        <div class="col-md-3">
                            <label class="control-label">ESC </label>
                            <select name="ESCIdM" id="ESCIdM" class="form-control">
                               
                            </select>
                        </div>
        
                        <div class="col-md-3">
                            <label class="control-label">Tiempo </label>
                            <input type="number" class="form-control" id="TiempoM" name="TiempoM">
                        </div>
        
                        <div class="col-md-3">
                            <label class="control-label">Costo </label>
                            <input type="number" step="any" class="form-control text-right" id="CostoM" name="CostoM">
                        </div>
        
        
                        <div class="col-md-12">
                            <label class="control-label">Descripcion </label>
                            <textarea name="DescripcionM" id="DescripcionM" cols="30" rows="3" class="form-control"></textarea>
                        </div>
        
                     
                        
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                            <label class="control-label">. </label>
                            <input type="button" onclick="AddDetalleCambio();" class="form-control btn btn-info" id="" name="" value="AGREGAR">
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
                    <button class="btn btn-primary text-uppercase" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar Informe</button>
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
        if(FaseId == ""){
            alert("Seleccione una Fase");
            return false;
        }
        if(ESCId == ""){
            alert("Seleccione un ECS");
            return false;
        }
        if(Tiempo == ""){
            alert("Ingrese un Tiempo");
            return false;
        }
        if(Costo == ""){
            alert("Ingrese un Costo");
            return false;
        }
        if(Descripcion == ""){
            alert("Ingrese una Descripcion");
            return false;
        }
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