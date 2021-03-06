<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/png" href="{{ URL::asset('img/favicon.png') }}"/>
  <link rel="shortcut icon" type="image/png" href="{{ URL::asset('img/favicon.png') }}"/>
  <title>Sistema | Panel Control</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/dataTables.bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('fonts/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ URL::asset('fonts/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::asset('dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ URL::asset('dist/css/skins/_all-skins.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/iCheck/flat/blue.css') }}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/morris/morris.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/datepicker/datepicker3.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('plugins/chosen/chosen.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/chosen/chosen.min.css') }}">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> -->


  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker-bs3.css') }}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

  <link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}">

  <link href="{{ URL::asset('/assets/sweetalert2-9.7.0/package/dist/sweetalert2.min.css') }}" rel="stylesheet">


<script src="{{ URL::asset('js/jquery-3.0.0.min.js') }}"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style>
    .navbar-static-top{
      background-color: #fff !important;
    }
    .nav>li>a{
      color: #616161 !important;
    }
    .sidebar-toggle{
      color: #616161 !important;
    }
    .sidebar-toggle:hover{
      background-color: white !important;
    }
    .logo{
      background-color: #37aee6 !important;
    }
  </style>

<style>
  .form-group{
    margin: 6px 0px !important;
  }

  .chosen-default{
    height: 34px !important;
    padding: 4px 10px !important;
    background: white !important;
  }

  .form-control{
    border-radius: 4px;
  }

  .box.box-primary {
    border-top-color: #ffffff !important;;
  }

</style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="{{ URL::asset('/') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>M</b>NU</span>
        <!-- logo for regular state and mobile devices -->
        <!--
        <span class="logo-lg"><span class="glyphicon glyphicon-user"> {{ Auth::user()->usuario }}</span></span>
        -->
        <span class="logo-lg" style="text-align: start;"><span class="" style="FONT-FAMILY: fantasy;font-size: 130%;">COREIESU</span></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle glyphicon-align-justify" data-toggle="offcanvas" role="button">

          <span class="sr-only glyphicon">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <!-- User Account: style can be found in dropdown.less -->


            <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" >
                <div class="div-content-font-control">
                  <div class="div-control div-control-plus">
                    <span class="glyphicon glyphicon-text-size"> </span><span class="glyphicon glyphicon-plus"></span>
                  </div>
                </div>
              </a>
            </li>

            <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" >
                <div class="div-content-font-control">

                  <div class="div-control div-control-minus">
                    <span class="glyphicon glyphicon-text-size"> </span><span class="glyphicon glyphicon-minus"></span>
                  </div>
                </div>
              </a>
            </li>


            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-user"></span>
                <span class="hidden-xs">{{ Auth::user()->name }}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                
                <li class="user-header" style="height: 75px;">
                  <p>
                  <span class="glyphicon glyphicon-user"></span> {{ Auth::user()->nombre }}
                    <small> 
                      @if(Auth::user()->idrol==1)
                        Administrador
                      @elseif(Auth::user()->idrol==2)
                        Empleado
                      @endif
                    </small>
                  </p>
                </li>

                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="{{ url('/modificarUsuario') }}/{{Auth::user()->id}}" class="btn btn-default btn-flat">Cambiar contraseña</a>
                  </div>
                  <!-- <div class="pull-right">
                    <a href="{{ url('admin/formActualizarDatos')}}" class="btn btn-default btn-flat">Cambiar datos</a>
                  </div> -->
                </li>

              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">


        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header"></li>

        @if(Auth::user()->idrol==1)
          <!-- Ussuarios -->
          <li>
            <a href="{{ URL::asset('/usuarios') }}">
              <i class="glyphicon glyphicon-user"></i> <span>Usuarios</span> <i class="fa fa-angle-left pull-right"></i>
              <small class="label pull-right bg-blue">
                <span class="glyphicon glyphicon-user"></span>
              </small>
            </a>
          </li>
        @endif
          <!-- Empleados -->
          <li>
            <a href="{{ URL::asset('/empleados') }}">
              <i class="glyphicon glyphicon-list-alt"></i> <span>Empleados</span> <i class="fa fa-angle-left pull-right"></i>
              <small class="label pull-right bg-green">
                <span class="glyphicon glyphicon-list-alt"></span>
              </small>
            </a>
          </li>

          <li>
            <a href="{{ URL::asset('/listaCuentaBancaria') }}">
              <i class="glyphicon glyphicon-credit-card"></i> <span>Cuentas Bancarias</span> <i class="fa fa-angle-left pull-right"></i>
              <small class="label pull-right bg-orange">
                <span class="glyphicon glyphicon-credit-card"></span>
              </small>
            </a>
          </li>

          <li>
            <a href="{{ URL::asset('/listaRubros') }}">
              <i class="glyphicon glyphicon-flag"></i> <span>Rubros</span> <i class="fa fa-angle-left pull-right"></i>
              <small class="label pull-right bg-blue">
                <span class="glyphicon glyphicon-tag"></span>
              </small>
            </a>
          </li>
          <li>
            <a href="{{ URL::asset('/listaPuestos') }}">
              <i class="glyphicon glyphicon-bookmark"></i> <span>Puestos</span> <i class="fa fa-angle-left pull-right"></i>
              <small class="label pull-right bg-gray">
                <span class="glyphicon glyphicon-bookmark"></span>
              </small>
            </a>
          </li>
          <li>
            <a href="{{ URL::asset('/listaCuentaPC') }}">
              <i class="glyphicon glyphicon-thumbs-up"></i> <span>Cuentas por Cobrar</span> <i class="fa fa-angle-left pull-right"></i>
              <small class="label pull-right bg-green">
                <span class="glyphicon glyphicon-thumbs-up"></span>
              </small>
            </a>
          </li>
          <li>
            <a href="{{ URL::asset('/listaCuentaPP') }}">
              <i class="glyphicon glyphicon-thumbs-down"></i> <span>Cuentas por Pagar</span> <i class="fa fa-angle-left pull-right"></i>
              <small class="label pull-right bg-purple">
                <span class="glyphicon glyphicon-thumbs-down"></span>
              </small>
            </a>
          </li>
          <li>
            <a href="{{ URL::asset('/listaSalarios') }}">
              <i class="glyphicon glyphicon-usd"></i> <span>Salarios</span> <i class="fa fa-angle-left pull-right"></i>
              <small class="label pull-right bg-purple">
                <span class="glyphicon glyphicon-usd"></span>
              </small>
            </a>
          </li>
          <li>
            <a href="{{ URL::asset('/listaEntradas') }}">
              <i class="glyphicon glyphicon-arrow-up"></i> <span> Entradas</span> <i class="fa fa-angle-left pull-right"></i>
              <small class="label pull-right bg-green">
                <span class="glyphicon glyphicon-arrow-up"></span>
              </small>
            </a>
          </li>
          <li>
            <a href="{{ URL::asset('/listaSalidas') }}">
              <i class="glyphicon glyphicon-arrow-down"></i> <span> Salidas</span> <i class="fa fa-angle-left pull-right"></i>
              <small class="label pull-right bg-red">
                <span class="glyphicon glyphicon-arrow-down"></span>
              </small>
            </a>
          </li>

          <li>
            <a href="{{ URL::asset('/reportesMovimientos') }}">
              <i class="glyphicon glyphicon-file"></i> <span> Reporte de Movimientos</span> <i class="fa fa-angle-left pull-right"></i>
              <small class="label pull-right bg-red">
                <span class="glyphicon glyphicon-file"></span>
              </small>
            </a>
          </li>

      <li class="active treeview">
        <a href="">
            <i class="glyphicon glyphicon-apple"></i><span>Soda</span>
         <i class="fa fa-angle-left pull-right"></i>
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li ><a href="{{ URL::asset('/listaGruposSoda') }}"><i class="glyphicon glyphicon-tags"></i> Grupos</a></li>
          <li ><a href="{{ URL::asset('/listaEntradasSoda') }}"><i class="glyphicon glyphicon-upload"></i> Ingresos</a></li>
          <li><a href="{{ URL::asset('/listaSalidasSoda') }}"><i class="glyphicon glyphicon-download"></i> Gastos</a></li>
        </ul>
      </li>
          <!-- <li>
          <a href="{{ URL::asset('/nuevoUsuario') }}">
          <i class="fa fa-plus-circle"></i> <span>Nuevo usuario</span>
          <small class="label pull-right bg-green">
          <span class="glyphicon glyphicon-plus"></span>
        </small>
      </a>
    </li> -->
    @if(Auth::user()->idrol==1)

    <li>
      <a href="{{ URL::asset('/logs') }}">
        <i class="glyphicon glyphicon-th-list"></i> <span>Logs</span> <i class="fa fa-angle-left pull-right"></i>
        <small class="label pull-right bg-blue">
          <span class="glyphicon glyphicon-th-list"></span>
        </small>
      </a>
    </li>
        @endif
    <li>
      <a href="{{ URL::asset('/aout') }}">
        <i class="glyphicon glyphicon-off"></i> <span>cerrar sesión</span><i class="fa fa-angle-left pull-right"></i>
        <small class="label pull-right bg-red">
          <span class="glyphicon glyphicon-off"></span>
        </small>
      </a>
    </li>
    <!-- <li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
    <button type="submit">Salir</button>
  </form>
</li> -->

</ul>
</section>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) 
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>

  </section>
  -->
  <!-- Main content -->
  <section class="content" style="padding-left: 40px;">
    @yield('content')


  </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery-1.12.4.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ URL::asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>



<!-- Morris.js charts -->
<script src="{{ URL::asset('plugins/raphael-min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ URL::asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ URL::asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ URL::asset('plugins/knob/jquery.knob.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ URL::asset('plugins/moment.min.js') }}"></script>
<script src="{{ URL::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ URL::asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ URL::asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ URL::asset('plugins/fastclick/fastclick.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('dist/js/app.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<script src="{{ URL::asset('bootstrap/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('bootstrap/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('plugins/chosen/chosen.jquery.min.js') }}"></script>

<script src="{{ URL::asset('/assets/sweetalert2-9.7.0/package/dist/sweetalert2.all.min.js') }}"></script>

<script src="{{ URL::asset('js/mainJS.js') }}"></script>
@yield('scripts')


<script type="text/javascript">
$(document).ready(function() {

  $('#example').DataTable({
                        language: {
                            "decimal": "",
                            "emptyTable": "No hay información",
                            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                            "infoPostFix": "",
                            "thousands": ",",
                            "lengthMenu": "Mostrar _MENU_ Entradas",
                            "loadingRecords": "Cargando...",
                            "processing": "Procesando...",
                            "search": "Buscar:",
                            "zeroRecords": "Sin resultados encontrados",
                            "paginate": {
                                "first": "Primero",
                                "last": "Ultimo",
                                "next": "Siguiente",
                                "previous": "Anterior"
                            }
                        },
                    });

   $(".chosen-select").chosen();
   $("#rubro").chosen({
      placeholder_text_single: "Seleccione un rubro",
      no_results_text: "no se encontraron resultados"
    });


    });

        function creandoElemento(titulo,mensaje,icon,tiempo){
            Swal.fire({
                            icon: icon,
                            title: titulo,
                            text: mensaje,
            })
        }

        function creandoElementoLoading(titulo,mensaje){
            Swal.fire({
                title: titulo,
                html: mensaje,
                timerProgressBar: true,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
            })
        }

</script>
</body>
</html>
