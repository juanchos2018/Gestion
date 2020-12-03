

<ul class="nav nav-tabs">

<?php

?>
@foreach($ListadoMetodologiaFase as $indice  => $ObjFase)

    @php
        $activo = $indice == 0 ? "active show" : "";
    @endphp


    <li class="nav-item"><a class="nav-link {{$activo}}" data-toggle="tab" href="#Fase{{$ObjFase->Id}}">{{$ObjFase->Nombre}}</a></li>

@endforeach



</ul>
<!-- tab content -->
<div class="tab-content" id="myTabContent">
<!-- tab 1 -->
@foreach($ListadoMetodologiaFase as $indice => $ObjFase)

    @php
        $activo = $indice == 0 ? "active show" : "";
    @endphp
    <div class="tab-pane fade {{ $activo }}" id="Fase{{ $ObjFase->Id}}">
        <input type="hidden" name="FasesNombre[]" value="{{$ObjFase->Nombre}}">
        <div class="pt-3">

        @foreach( $ObjFase->ListadoElementoConfiguracion as $ObjElemento)
            <!-- checkbox -->
                <div class="animated-checkbox box-elemento">
                    <label>
                        <input name="{{$ObjFase->Nombre}}[]" value="{{$ObjElemento->ElementoConfiguracion->Nombre}}" type="checkbox"><span class="label-text">{{$ObjElemento->ElementoConfiguracion->Nombre}}</span>
                    </label>
                </div>
                <!-- checkbox -->
            @endforeach
        </div>
    </div>
@endforeach