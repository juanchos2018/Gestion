
@extends('layouts.default')
@section('content')

    <!-- title -->
    <div class="app-title">
        <div class="row">
            <h1>MIS TAREAS</h1>

        </div>
    </div>
    <!-- content -->
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body  table-responsive">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-tarea-tab" data-toggle="pill" href="#pills-tarea" role="tab" aria-controls="pills-tarea" aria-selected="true">Tareas por terminar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-dependencias-tab" data-toggle="pill" href="#pills-dependencias" role="tab" aria-controls="pills-dependencias" aria-selected="false">Tareas terminadas</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-tarea" role="tabpanel" aria-labelledby="pills-tarea-tab">
                            {{--                        TAREAS NO TERMINADAS --}}
                            <table class="table table-hover table-bordered" id="TableData">
                                <thead>
                                <tr>
                                    <th class="text-center" width="25px">#</th>
                                    <th>CODIGO</th>
                                    <th>PROYECTO</th>
                                    <th>FASE</th>
                                    <th>ELEMENT. CONF.</th>
                                    <th>FEC. DE INICIO</th>
                                    <th>FEC. DE TERMINO</th>
                                    <th class="text-center">% AVANCE</th>
                                    <th>ACCIONES</th>
                                    {{--                                <th class="text-center" width="100px">ACCIONES</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ListadoTarea as $Indice => $ObjTarea)
                                    <tr>
                                        <td>{{$Indice + 1}}</td>
                                        <td class="text-center">{{$ObjTarea->Codigo}}</td>
                                        <td>{{$ObjTarea->Proyecto}}</td>
                                        <td>{{$ObjTarea->Fase}}</td>
                                        <td>{{$ObjTarea->ElementoNombre}}</td>
                                        <td>{{$ObjTarea->FechaInicio}}</td>
                                        <td>{{$ObjTarea->FechaTermino}}</td>
                                        <td>{{$ObjTarea->PorcentajeAvance}}%</td>
                                        <td>
                                            <a href="#"
                                               data-url="/tarea/editar/{{$ObjTarea->Id}}"
                                               data-descripcion="{{$ObjTarea->Descripcion}}"
                                               data-codigo="{{$ObjTarea->Codigo}}"
                                               data-evidencia="{{$ObjTarea->UrlEvidencia}}"
                                               data-porcentaje-avance="{{$ObjTarea->PorcentajeAvance}}"
                                               class="btn btn-success btn-sm text-uppercase btn-editar-tarea"
                                               data-toggle="modal" data-target="#ModalEditarTarea">Editar</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

{{--                        TAREAS TERMINADAS --}}
                        <div class="tab-pane fade" id="pills-dependencias" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <table class="table table-hover table-bordered" id="TableData">
                                <thead>
                                <tr>
                                    <th class="text-center" width="25px">#</th>
                                    <th>CODIGO</th>
                                    <th>PROYECTO</th>
                                    <th>FASE</th>
                                    <th>ELEMENT. CONF.</th>
                                    <th>FEC. DE INICIO</th>
                                    <th>FEC. DE TERMINO</th>
                                    <th class="text-center">% AVANCE</th>
                                    {{--                                <th class="text-center" width="100px">ACCIONES</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ListadoTareaTerminado as $Indice => $ObjTarea)
                                    <tr>
                                        <td>{{$Indice + 1}}</td>
                                        <td class="text-center">{{$ObjTarea->Codigo}}</td>
                                        <td>{{$ObjTarea->Proyecto}}</td>
                                        <td>{{$ObjTarea->Fase}}</td>
                                        <td>{{$ObjTarea->ElementoNombre}}</td>
                                        <td>{{$ObjTarea->FechaInicio}}</td>
                                        <td>{{$ObjTarea->FechaTermino}}</td>
                                        <td>{{$ObjTarea->PorcentajeAvance}}%</td>
                                        {{--                                    <td>--}}
                                        {{--                                        <a href="/tarea/editar/{{$ObjTarea->Id}}" class="btn btn-success btn-sm text-uppercase">Editar</a>--}}
                                        {{--                                    </td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Agregar Tarea -->
    <div class="modal fade" id="ModalEditarTarea" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Tarea</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- form -->
                    <form method="post" id="FrmEditarTarea" action="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="control-label" for="TxtNombre">Nombre de la tarea</label>
                            <input type="text" id="descripcion" name="TxtNombre" id="TxtNombre" class="form-control" readonly >
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="TxtCodigo">Codigo</label>
                            <input type="text" id="codigo" name="TxtCodigo" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="TxtCodigo">Porcentaje avance</label>
                            <input type="text" id="porcentaje_avance" name="TxtPorcentajeAvance" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="TxtCodigo">Evidencia URL</label>
                            <input type="text" id="evidencia" name="TxtUrlEvidencia" class="form-control">
                        </div>


                        <div class="form-group pt-2">
                            <button type="submit" class="btn btn-primary text-uppercase">Editar Tarea</button>
                        </div>
                    </form>
                    <!-- form -->
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Agregar Tarea -->
    <script>
        window.onload = ()=>{
            $(document).ready(function(){
                $('.btn-editar-tarea').click(function () {
                    let url = $(this).data("url");
                    let descripcion = $(this).data("descripcion");
                    let codigo = $(this).data("codigo");
                    let evidencia = $(this).data("evidencia");
                    let porcentaje_avance = $(this).data("porcentaje-avance");

                    $("#FrmEditarTarea").attr('action', url);
                    $("#descripcion").val(descripcion)
                    $("#codigo").val(codigo)
                    $("#evidencia").val(evidencia)
                    $("#porcentaje_avance").val(porcentaje_avance)

                })
            })
        }
    </script>
@stop