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
            <?php $j = 1;  ?>
            @for ($i = 0; $i < count($ADetalleInforme); $i++)
                @if ($ADetalleInforme[$i]['Eliminado'] == 0)
                    <tr>
                        <td class="text-center">{{ $j }}</td>
                        <td class="text-left">{{ $ADetalleInforme[$i]['ESCNombre'] }}</td>
                        <td class="text-left">{{ $ADetalleInforme[$i]['Tiempo'] }}</td>
                        <td class="text-right">S/. {{ $ADetalleInforme[$i]['Costo'] }}</td>
                        <td class="text-center">
                            <a class="btn btn-danger btn-sm" onclick="Fnc_DeleteDetalleInforme({{ $ADetalleInforme[$i]['ESCId'] }})"><i class="fa fa-trash fa-2x m-0" aria-hidden="true"></i></a>
                        </td>
                    <tr>
                <?php $j++;  ?>
                @endif
            @endfor
              
            
           
    
        </tbody>
    </table>