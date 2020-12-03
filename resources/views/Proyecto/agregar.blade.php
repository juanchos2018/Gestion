@extends('layouts.default')
@section('content')

<!-- title -->
<div class="app-title">
    <h1>Nuevo Proyecto</h1>
</div>
<!-- content -->
<div class="row">
    <div class="col-md-12">
        <form action="/proyecto/agregar" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <!-- datos del proyecto -->
            <div class="tile mb-3">
                <h3 class="tile-title">Datos del Proyecto</h3>
                <div class="tile-body">     
                    <div class="form-group">
                        <label class="control-label">Nombre</label>
                        <input class="form-control" name="Nombre" type="text">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Descripción</label>
                        <input class="form-control" name="Descripcion" type="text">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label">Fecha de Inicio</label>
                            <input class="form-control" name="FechaInicio" type="date">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Fecha de Finalización</label>
                            <input class="form-control" name="FechaTermino" type="date">
                        </div>
                    </div>
                    <!-- <div class="form-group"> -->
                        <input type="hidden" name="UsuarioJefeId" value="{{Auth::user()->Id}}">
                        <!-- <label class="control-label">Responsable</label>
                        <input class="form-control" name="responsable" type="text" readonly>
                    </div> -->
                </div>
            </div>
            <!-- datos del proyecto -->
            <!-- metodologia del proyecto -->
            <div class="tile">
                <h3 class="tile-title">Datos de la Metodología</h3>
                <div class="tile-body">
                    <div class="form-group">
                        <!-- HIDDEN identificadores de metodologia -->



                        <label class="control-label">Metodología</label>
                        <select id="CmbMetodologia" name="MetodologiaId" class="form-control">
                            <option disabled selected>Seleccione una opción...</option>
                            @foreach($ListadoMetodologia as $ObjMetodologia)
                                <option value="{{$ObjMetodologia->Id}}">{{$ObjMetodologia->Nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- tabs -->
                    <div id="contenedor_tabs" class="bs-component">

                    </div>
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary text-uppercase" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Crear Proyecto</button>
                </div>
            </div>
            <!-- metodologia del proyecto -->
        </form>
    </div>
</div>

<script>
    let d = document;
    let ListadoFase = [];
    let onChangeMetodologia = (MetodologiaId)=>{
        let url = "{{action('CronogramaFaseController@ListarPorMetodologiaId',['MetodologiaId' => ''])}}/"+MetodologiaId;
        let contenedor_componente = d.getElementById('contenedor_tabs');
        console.log(url)
        fetch(url)
            .then(response => response.text())
            .then(response => {
                $(contenedor_componente).html(response);
            })


    }



    d.getElementById('CmbMetodologia').addEventListener('change',function(){
        let MetodologiaId = this.value;
        onChangeMetodologia(MetodologiaId);
    })
</script>
@stop