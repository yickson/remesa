<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    @if(auth()->user()->type == 'admin')
        <li class="nav-item">
            <a href="{{ route('admin.ordenes') }}" class="nav-link">
                <i class="nav-icon fa fa-exchange"></i>
                <p>
                    Listado de ordenes
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.tasas') }}" class="nav-link">
                <i class="nav-icon fa fa-line-chart"></i>
                <p>
                    Módulo de tasas
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.usuarios') }}" class="nav-link">
                <i class="nav-icon fa fa-users"></i>
                <p>
                    Módulo de usuarios
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.bancos') }}" class="nav-link">
                <i class="nav-icon fa fa-bank"></i>
                <p>
                    Módulo de bancos
                </p>
            </a>
        </li>
    @endif
    <li class="nav-item">
        <a href="{{ route('admin.solicitud') }}" class="nav-link">
            <i class="nav-icon fa fa-money"></i>
            <p>
                Solicitar remesa
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.cuentas') }}" class="nav-link">
            <i class="nav-icon fa fa-bank"></i>
            <p>
                Mis cuentas bancarias
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.solicitudes') }}" class="nav-link">
            <i class="nav-icon fa fa-paper-plane"></i>
            <p>
                Mis solicitudes
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('logout') }}" class="nav-link">
            <i class="nav-icon fa fa-sign-out"></i>
            <p>
                Cerrar sesión
            </p>
        </a>
    </li>
</ul>
