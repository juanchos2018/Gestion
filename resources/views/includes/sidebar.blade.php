@php
$TU = Auth::user()->TipoUsuarioId;
@endphp
<ul class="app-menu">

        @if($TU==1)
        <li><a class="app-menu__item" href=""><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        @endif

        @if($TU==1)
        <!-- Usuario -->
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-folder"></i><span class="app-menu__label">Usuarios</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="/usuario/listar"><i class="icon fa fa-circle-o"></i> Listar</a></li>
            <li><a class="treeview-item" href="/usuario/agregar"><i class="icon fa fa-circle-o"></i> Agregar</a></li>
          </ul>
        </li>
        <!-- Usuario -->
        @endif
        
        @if($TU==1)
        <!-- Metodologia -->
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-folder"></i><span class="app-menu__label">Metodologí­as</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="/metodologia/listar"><i class="icon fa fa-circle-o"></i> Listar</a></li>
            <li><a class="treeview-item" href="/metodologia/agregar"><i class="icon fa fa-circle-o"></i> Agregar</a></li>
          </ul>
        </li>
        <!-- Metodologia -->
        @endif

        @if($TU==1)
        <!-- Elemento de Configuracion -->
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-folder"></i><span class="app-menu__label">ECS</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="/elemento-configuracion/listar"><i class="icon fa fa-circle-o"></i> Listar</a></li>
            <li><a class="treeview-item" href="/elemento-configuracion/agregar"><i class="icon fa fa-circle-o"></i> Agregar</a></li>
          </ul>
        </li>
        <!-- Elemento de Configuracion -->
        @endif
        
        @if($TU==2)
        <!-- Proyecto -->
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-folder"></i><span class="app-menu__label">Proyectos</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="/proyecto/listar"><i class="icon fa fa-circle-o"></i> Listar</a></li>
            <li><a class="treeview-item" href="/proyecto/agregar"><i class="icon fa fa-circle-o"></i> Agregar</a></li>
          </ul>
        </li>
        @endif

        @if($TU==2 || $TU==3 || $TU==4)
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-folder"></i><span class="app-menu__label">Solicitud de Cambio</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="../../SolicitudCambio/listar"><i class="icon fa fa-circle-o"></i> Listar</a></li>
            <li><a class="treeview-item" href="../../SolicitudCambio/create"><i class="icon fa fa-circle-o"></i> Agregar</a></li>
          </ul>
        </li>
        @endif

        @if($TU==2)
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-folder"></i><span class="app-menu__label">Orden de Cambio</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="../../OrdenCambio/listar"><i class="icon fa fa-circle-o"></i> Listar</a></li>
            <li><a class="treeview-item" href="../../OrdenCambio/create"><i class="icon fa fa-circle-o"></i> Agregar</a></li>
          </ul>
        </li>
        @endif

        @if($TU==2 || $TU==3)
        <li><a class="app-menu__item" href="{{ url('mis-tareas/listar') }}"><i class="app-menu__icon fa fa-folder"></i><span class="app-menu__label">Mis Tareas</span></a></li>
        @endif

        @if($TU==2)
        <li><a class="app-menu__item" href="{{ url('reportes') }}"><i class="app-menu__icon fa fa-folder"></i><span class="app-menu__label">Reportes</span></a></li>
        @endif
</ul>