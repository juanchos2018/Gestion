@extends('layouts.default')
@section('content')
<!-- title -->
<div class="app-title">
    <h1><i class="fa fa-pie-chart"></i> Reportes</h1>
</div>
<!-- content -->
<div class="row">
    <!-- col -->
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-header pb-3">
                <h3 class="tile-title text-center">Informe de cambios</h3>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="embed-responsive embed-responsive-16by9">
                        <canvas class="embed-responsive-item" id="pieChartCambios"></canvas>
                    </div>
                </div>
            </div>
            <div class="pt-4">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <ul class="list-inline m-0 p-0 text-center d-sm-flex justify-content-center">
                            <li class="list-inline-item d-flex align-items-center"><span class="square green mr-2"></span><span>Cambios Aceptados ({{ $datos['aceptados'] }})</span></li>
                            <li class="list-inline-item d-flex align-items-center"><span class="square yellow mr-2"></span><span>Cambios en Proceso ({{ $datos['pendientes'] }})</span></li>
                            <li class="list-inline-item d-flex align-items-center"><span class="square red mr-2"></span><span>Cambios Atrasados ({{ $datos['atrasados'] }})</span></li>
                            <li class="list-inline-item d-flex align-items-center"><span class="square blue mr-2"></span><span>Cambios Finalizados ({{ $datos['terminados'] }})</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- col -->
</div>
<style>
.square{
    width: 15px;
    height: 15px;
    display: block;
}
.red{
    background: #F7464A;
}
.blue{
    background: #3F51B5;
}
.yellow{
    background: #FFA900;
}
.green{
    background: #66BB6A;
}
</style>
<!-- content -->
@stop

@section('scripts')
<script type="text/javascript" src="{{ url('assets/js/plugins/chart.js') }}"></script>
<script type="text/javascript">

      var pdata = [
        {
      		value: {{ $datos['aceptados'] }},
      		color: "#66BB6A",
      		highlight: "#8BC34A",
      		label: "Cambios Aceptados"
      	},
      	{
      		value: {{ $datos['pendientes'] }},
      		color:"#FFA900",
      		highlight: "#FFC107",
      		label: "Cambios en Proceso"
      	},
      	{
      		value: {{ $datos['atrasados'] }},
      		color: "#F7464A",
      		highlight: "#EF5350",
      		label: "Cambios Atrasados"
      	},
        {
      		value: {{ $datos['terminados'] }},
      		color: "#3F51B5",
      		highlight: "#5C6BC0",
      		label: "Cambios Finalizados"
      	}
      ];
      
      var ctxp = $("#pieChartCambios").get(0).getContext("2d");
      var pieChart = new Chart(ctxp).Pie(pdata);
      
</script>
@stop