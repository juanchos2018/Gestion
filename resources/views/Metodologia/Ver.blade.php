@extends('layouts.default')
@section('content')
<div class="app-title">
    <div>
        <h1>Metodología {{ $Metodologia->Nombre }}</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tile p-0">
            <div class="card">
                <div class="card-header card-header-m d-flex align-items-center">
                    <span>Fases de la metodología</span>
                    <div class="ml-auto d-flex">
                      <a href="#" data-toggle="modal" data-target="#ModalAgregarFase" class="btn btn-sm btn-primary text-uppercase mr-1"><i class="fa fa-plus" aria-hidden="true"></i>Fase</a>
                      <a href="#" data-toggle="modal" data-target="#ModalAgregarElementoConfiguracion" class="btn btn-sm btn-secondary text-uppercase"><i class="fa fa-plus" aria-hidden="true"></i>ECS</a>
                    </div>
                </div>
            </div>
            <!-- accordion -->
            <div class="accordion" id="accordionFase">
                @foreach($ListadoFase as $Fase)
                <!-- item -->
                <div class="card">
                    <!-- header -->
                    <div class="card-header card-header-mm d-flex align-items-center"> 
                        <a href="#" data-toggle="collapse" data-target="#Fase{{ $Fase->Id }}">{{ $Fase->Nombre }}</a>
                        <div class="ml-auto">
                          <a href="/fase/editar/{{ $Fase->Id }}" class="btn btn-sm btn-success"><i class="fa fa-pencil m-0" aria-hidden="true"></i></a>
                          <a href="/fase/eliminar/{{ $Fase->Id }}?Metodologia={{ $Metodologia->Id }}" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta Fase?');"><i class="fa fa-trash m-0" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <!-- body -->
                    <div id="Fase{{ $Fase->Id }}" class="collapse show_x" data-parent="#accordionFase">
                        <div class="card-body">
                            @foreach($ListadoPlantillaECS as $PECS)
                            @if($PECS->FaseId == $Fase->Id)
                            <!-- element -->
                            <div class="element-item">
                                <div class="element-wrapper d-sm-flex align-items-center">
                                    <div class="element-header py-2 py-lg-0">
                                        <h4 class="element-header__title">{{ $PECS->ElementoConfiguracion->Nombre }}</h4>
                                        <span class="element-header__code">{{ $PECS->ElementoConfiguracion->Codigo }}</span>
                                    </div>
                                    <div class="element-control ml-auto">
                                        <a href="/plantilla-elemento-configuracion/eliminar/{{ $PECS->Id }}?Metodologia={{ $Metodologia->Id }}" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este ECS?');"><i class="fa fa-trash m-0" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- element -->
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- item -->
                @endforeach
            </div>
            <!-- accordion -->
        </div>
    </div>
</div>
<!-- Modal Agregar Fase -->
<div class="modal fade" id="ModalAgregarFase" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nueva Fase</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- form -->
        <form action="/fase/agregar" method="POST">
            <div class="form-group">
                <label class="control-label">Nombre</label>
                <input type="text" name="TxtNombre" class="form-control" required>
            </div>
            <div class="form-group pt-2">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="TxtMetodologia" value="{{ $Metodologia->Id }}" required>
                <button type="submit" class="btn btn-primary text-uppercase"><i class="fa fa-check-circle" aria-hidden="true"></i>Crear fase</button>
            </div>
        </form>
        <!-- form -->
      </div>
    </div>
  </div>
</div>
<!-- Modal Agregar Fase -->
<!-- Modal Agregar elemento de configuracion -->
<div class="modal fade" id="ModalAgregarElementoConfiguracion" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuevo elemento de configuración</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- form -->
        <form action="/plantilla-elemento-configuracion/agregar" method="POST">
            <div class="form-group">
                <label class="control-label">Fase</label>
                <select name="TxtFase" class="form-control" required>
                  <option value="">Seleccione la fase a que pertenece</option>
                  @foreach($ListadoFase as $Fase)
                  <option value="{{ $Fase->Id }}">{{ $Fase->Nombre }}</option>
                  @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="control-label">Elemento de configuración</label>
                <select name="TxtElementoConfiguracion" class="form-control" required>
                  <option value="">Seleccione un elemento de configuración</option>
                  @foreach($ListadoElementoConfiguracion as $ECS)
                  <option value="{{ $ECS->Id }}">{{ $ECS->Codigo }} - {{ $ECS->Nombre }}</option>
                  @endforeach
                </select>
            </div>
            <div class="form-group pt-2">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="TxtMetodologia" value="{{ $Metodologia->Id }}" required>
                <button type="submit" class="btn btn-primary text-uppercase"><i class="fa fa-check-circle" aria-hidden="true"></i>Crear elemento</button>
            </div>
        </form>
        <!-- form -->
      </div>
    </div>
  </div>
</div>
<!-- Modal Agregar elemento de configuracion -->
@stop