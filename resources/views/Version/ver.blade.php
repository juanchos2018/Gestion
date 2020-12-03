@extends('layouts.default')
@section('content')

    <!-- title -->
    <div class="app-title">
        <div class="row">
            <div class="col-12">
                <h3><span class="font-weight-light">{{$ObjVersion->CronogramaEC->Nombre}}</span> <span class="font-weight-bold">{{$ObjVersion->Version}}</span> </h3>
            </div>
            <div class="col-12">
                <h6> Proyecto : <span class="font-weight-light">{{$Proyecto}}</span> </h6>
                <h6>Fase : <span class="font-weight-light">{{$Fase}}</span> </h6>
            </div>

        </div>
    </div>
    <!-- content -->
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body  table-responsive">
                    <div class="w-100 pb-2 text-right">
                        <button type="button" class="btn btn-primary btn-sm btn-add-version" data-toggle="modal" data-target="#ModalAgregarTarea" data-cronograma-ecs="1" data-cronograma-ecs-nombre="Especificación de requerimientos" data-cronograma-fase-nombre="Inicio"><i class="fa fa-plus" aria-hidden="true"></i>Agregar Tarea</button>
                    </div>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-tarea-tab" data-toggle="pill" href="#pills-tarea" role="tab" aria-controls="pills-tarea" aria-selected="true">Tareas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-dependencias-tab" data-toggle="pill" href="#pills-dependencias" role="tab" aria-controls="pills-dependencias" aria-selected="false">Dependencias</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-tarea" role="tabpanel" aria-labelledby="pills-tarea-tab">
                            <table class="table table-hover table-bordered DataTableClase" >
                            <thead>
                            <tr>
                                <th class="text-center" width="25px">#</th>
                                <th>CODIGO</th>
                                <th>RESPONSABLE</th>
                                <th>DESCRIPCION</th>
                                <th>FEC. DE INICIO</th>
                                <th>FEC. DE TERMINO</th>
                                <th class="text-center">% AVANCE</th>
{{--                                <th class="text-center" width="100px">ACCIONES</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ListadoTarea as $Indice => $ObjTarea)
                                <tr>
                                    <td>{{$Indice + 1}}</td>
                                    <td class="text-center">{{$ObjTarea->Codigo}}</td>
                                    <td>{{$ObjTarea->Miembro->Usuario->Nombre . " " .
                                    $ObjTarea->Miembro->Usuario->Apellido}}</td>
                                    <td>{{$ObjTarea->Descripcion}}</td>
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
                        <div class="tab-pane fade" id="pills-dependencias" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <table class="table table-hover table-bordered DataTableClase" >
                                <thead>
                                <tr>
                                    <th class="text-center" width="25px">#</th>
                                    <th>CODIGO</th>
{{--                                    <th>DESCRIPCION</th>--}}
{{--                                    <th>FEC. DE INICIO</th>--}}
{{--                                    <th>FEC. DE TERMINO</th>--}}
                                    <th>REQUIERE DE .</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ListadoTarea as $Indice => $ObjTarea)
                                    <tr>
                                        <td>{{$Indice + 1}}</td>
                                        <td>{{$ObjTarea->Codigo}}</td>

{{--                                        <td>{{$ObjTarea->Descripcion}}</td>--}}
{{--                                        <td>{{$ObjTarea->FechaInicio}}</td>--}}
{{--                                        <td>{{$ObjTarea->FechaTermino}}</td>--}}
                                        @if($ObjTarea->Padre != null)
                                            <td>{{$ObjTarea->Padre->Codigo}}</td>
                                        @else
                                            <td> -- </td>
                                        @endif
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
    <div class="modal fade" id="ModalAgregarTarea" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Tarea</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- form -->
                    <form method="post" action="/tarea/agregar">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="TxtVersionECSId" value="{{$ObjVersion->Id}}">
                        <div class="form-group">
                            <label class="control-label" for="TxtNombre">Nombre de la tarea</label>
                            <input type="text" name="TxtNombre" id="TxtNombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="TxtJustificacion">Justificación</label>
                            <input type="text" name="TxtJustificacion" id="TxtJustificacion" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="TxtCodigo">Codigo</label>
                            <input type="text" id="TxtCodigo" name="TxtCodigo" class="form-control">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label" for="TxtFechaInicio">Fecha de inicio</label>
                                <input type="date" id="TxtFechaInicio" name="TxtFechaInicio" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label" for="TxtFechaTermino">Fecha de finalización</label>
                                <input type="date" id="TxtFechaTermino" name="TxtFechaTermino" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label class="control-label" for="CmbMiembroResponsableId">Responsable</label>
                                <select id="CmbMiembroResponsableId" name="CmbMiembroResponsableId" class="form-control">
                                    <option disabled selected>Seleccione una opción...</option>
                                    @foreach($ListadoMiembro as $ObjMiembro)
                                        <option value="{{$ObjMiembro->Id}}">{{$ObjMiembro->Nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <hr>
                        <h5 class="modal-title pb-2">Dependencia</h5>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label class="control-label" for="TxTTareaPadreId">Tarea Padre</label>
                                <select id="TxTTareaPadreId" name="TxTTareaPadreId" class="form-control">
                                    <option disabled selected>Seleccione una opción...</option>
                                    @foreach($ListadoTarea as $ObjTarea)
                                        <option value="{{$ObjTarea->Id}}">{{$ObjTarea->Descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group pt-2">
                            <button type="submit" class="btn btn-primary text-uppercase">Crear Tarea</button>
                        </div>
                    </form>
                    <!-- form -->
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Agregar Tarea -->
@stop