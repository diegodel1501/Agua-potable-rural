
    <!DOCTYPE html>
    <!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
    -->
    <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="x-ua-compatible" content="ie=edge">

      <title>Administracion APR</title>
      <!-- Font Awesome Icons -->
      <link rel="stylesheet" href="{{url('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{url('adminlte/dist/css/adminlte.min.css')}}">
      <!-- Google Font: Source Sans Pro -->
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>
    <body class="hold-transition sidebar-mini">
      <div class="wrapper">
        <div class="row">
          <div class="col">
           <nav class="main-header navbar navbar-expand navbar-white navbar-light ">
            <!-- Left navbar links -->
            <ul class="navbar-nav ">
              <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
              </li>
            </ul>
          </nav>
        </div>
        <div class="col">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light ">
            <!-- Left navbar links -->
            <ul class="navbar-nav ">
              <li class="nav-item">
                <a class="nav-link"  role="button"><i class="fas fa-user"></i> @if(auth()->user()!=null)
                  {{auth()->user()->name}}
                  @endif
                </a>
              </li>
            </ul>
          </nav>
        </div>
        <div class="col">
         <nav class="main-header navbar navbar-expand navbar-white navbar-light d-flex justify-content-end">
          <!-- Left navbar links -->
          <ul class="navbar-nav ">
           <li class="nav-item ">
             <a class="nav-link" href="{{Auth::logout()}}" role="button"><i class="fas fa-sign-out-alt"></i> Cerrar Sesion</a>
           </li>
         </ul>
       </nav>
     </div>
    </div>




      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
              <a href="#" class="d-block">Administracion APR</a>
            </div>
          </div>
         <!-- Sidebar Menu -->
          <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              <li class="nav-item has-treeview menu-open">
                <span class="nav-link active administradorpositivoidentificador">
                  <i class="nav-icon  fas fa-laptop"></i>
                  <p>
                    Administracion
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </span>
                <ul class="nav nav-treeview" #administration>
                    <li class="nav-item">
                    <a href="{{url('valorm3')}}" id="menuvalor" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Adm. Valor por m3 </p>
                    </a>
                  </li>
                    <li class="nav-item">
                    <a href="{{url('subsidio')}}" id="menusubsidio" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Adm. Subsidios</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('representante')}}" id="menurepresentante" class="nav-link ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Adm. Socios</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('vivienda')}}" id="menuvivienda" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Adm. viviendas</p>
                    </a>
                  </li>
                    <li class="nav-item">
                    <a href="{{url('saldodiferenciado')}}" id="menusaldo" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Adm.  saldos diferidos</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('medicion')}}" id="menumedicion" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Adm. medicion</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link active administradorpositivoidentificador">
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
              <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link active administradorpositivoidentificador">
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
        </div>
        <!-- /.sidebar -->
      </aside>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
           @yield('ubicacion')
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
          @yield('contenido')
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->


      <!-- Main Footer -->
      <footer class="main-footer">
      </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{url('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{url('adminlte/dist/js/adminlte.min.js')}}"></script>
    @stack('scripts')
    </body>
    </html>