@section('sidebarporplantilla')
<!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <span class="nav-link active">
              <i class="nav-icon  fas fa-laptop"></i>
              <p>
                Administracion
                <i class="right fas fa-angle-left"></i>
              </p>
            </span>
            <ul class="nav nav-treeview">
            	  <li class="nav-item">
                <a href="{{url('valorm3')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Adm. Valor por m3 </p>
                </a>
              </li>
                <li class="nav-item">
                <a href="{{url('subsidio')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Adm. Subsidios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('representante')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Adm. Socios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('vivienda')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Adm. viviendas</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="{{url('saldodiferenciado')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Adm.  saldos diferidos</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Facturación
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Generar cupon de pago</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ingresar pago</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Reportes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ver estado de cuentas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Historial de consumos</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Estadisticas de Consumo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reportes de pago</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
@endsection
@section('navegacionporplantilla')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              @yield('ubicacion')
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection