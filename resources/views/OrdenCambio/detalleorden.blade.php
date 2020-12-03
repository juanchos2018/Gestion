<table class="table">
        <thead>
            <tr>
            <th class="text-center">#</th>
            <th class="text-center">Responsable</th>
            <th class="text-center">ECS</th>
            <th class="text-center">Desde</th>
            <th class="text-center">Hasta</th>
            <th class="text-center">Descripcion</th>
            <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $j = 1;  ?>
            @for ($i = 0; $i < count($ListadoDetalleOrden); $i++)
                @if ($ListadoDetalleOrden[$i]['Eliminado'] == 0)
                    <tr>
                        <td class="text-center">{{ $j }}</td>
                        <td class="text-left">{{ $ListadoDetalleOrden[$i]['Nombre_Responsable'] }}</td>
                        <td class="text-left">{{ $ListadoDetalleOrden[$i]['ESCNombre'] }}</td>
                        <td class="text-right">{{ $ListadoDetalleOrden[$i]['FechaInicioD'] }}</td>
                        <td class="text-right">{{ $ListadoDetalleOrden[$i]['FechaTerminoD'] }}</td>
                        <td class="text-right">{{ $ListadoDetalleOrden[$i]['DescripcionM'] }}</td>
                        <td class="text-center">
                            <a class="btn btn-danger btn-sm" onclick="Fnc_DeleteDetalleOrden({{ $ListadoDetalleOrden[$i]['ECSIdM'] }})"><i class="fa fa-trash fa-2x m-0" aria-hidden="true"></i></a>
                        </td>
                    <tr>
                <?php $j++;  ?>
                @endif
            @endfor
              
            
           
    
        </tbody>
    </table>