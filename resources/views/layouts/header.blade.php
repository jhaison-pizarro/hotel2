<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Sitema de gestión</title>
<!-- Tell the browser to be responsive to screen width -->

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Biz Admin is a Multipurpose bootstrap 4 Based Dashboard & Admin Site Responsive Template by uxliner.">
<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Biz Admin, Biz Adminadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application">
<meta name="author" content="uxliner">
<!-- v4.1.3 -->
<link rel="stylesheet" href="{{ asset('dist/bootstrap/css/bootstrap.min.css') }}">

<!-- Favicon -->
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dist/img/favicon-16x16.png') }}">

<!-- Google Font -->
<link href="{{ asset('../../../css?family=Poppins:300,400,500,600,700') }}" rel="stylesheet">

<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/et-line-font/et-line-font.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/themify-icons/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/simple-lineicon/simple-line-icons.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<link href="{{asset('toastr/build/toastr.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('dist/plugins/calendar/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/plugins/calendar/fullcalendar.print.min.css') }}" media="print">


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper boxed-wrapper">
  <header class="main-header" style="background: rgb(133, 96, 81)"> 
    <!-- Logo --> 
    <a href="index.html" class="logo blue-bg" style="background: rgb(184, 142, 114)"> 
    <!-- mini logo for sidebar mini 50x50 pixels --> 
    <span class="logo-mini"><img src="{{ asset('dist/img/logo-small.png') }}" alt=""></span> 
    <!-- logo for regular state and mobile devices --> 
    <span class="logo-lg"><img src="{{ asset('dist/img/logo-leisuree.png') }}" alt=""></span> </a> 
    <!-- Header Navbar -->
    <nav class="navbar blue-bg navbar-static-top"> 
      <!-- Sidebar toggle button-->
      <ul class="nav navbar-nav pull-left">
        <li><a class="sidebar-toggle" data-toggle="push-menu" href=""></a> </li>
      </ul>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages -->
         
          <!-- Notifications  -->
          <li class="dropdown messages-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bell-o"></i>
            <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Notificaciones</li>
              <li>
                <ul class="menu">
                  <li><a href="#">
                    <div class="pull-left icon-circle red"><i class="icon-lightbulb"></i></div>
                       <h4>Productos por agotarse</h4>
                       <div id="notificaciones" style="font-size:11px; padding:10px 40px 10px; text-align:left; line-height:2px">
                          
                       </div>
                    </a></li>
                    </a>
                  </li>
                </ul>
              </li>
             
            </ul>
          </li>
          <!-- User Account  -->
          <li class="dropdown user user-menu p-ph-res"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="{{ asset('dist/img/img-user.png') }}" class="user-image" alt="User Image"> <span class="hidden-xs">{{ session('usuario') }}</span> </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <div class="pull-left user-img"><img src="{{ asset('dist/img/img-user.png') }}" class="img-responsive img-circle" alt="User"></div>
                <p class="text-left">{{ session('usuario') }}<small></small> </p>
              </li>
             
              <li><a href="{{ route('salir') }}"><i class="fa fa-power-off"></i>Cerrar sesión</a></li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar"> 
    <!-- sidebar -->
    <div class="sidebar"> 
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="image text-center"><img src="{{ asset('dist/img/img-user.png') }}" class="img-circle" alt="User Image"> </div>
        <div class="info">
          <p>{{ session('usuario') }}</p>
         </div>
      </div>
      
      <!-- sidebar menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">PERSONAL</li>
        <li class="treeview"> <a href="#"> <i class="fa fa-institution"></i> <span>Rerservas</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin')}}"><i class="fa fa-angle-right"></i> Panel de control</a></li>
            <li><a href="{{ route('recepcion') }}"><i class="fa fa-angle-right"></i> Recepción</a></li>
            <li><a href="{{ route('calendario.index') }}"><i class="fa fa-angle-right"></i>Calendario</a></li>
            <li><a href="{{ route('clientes_index') }}"><i class="fa fa-angle-right"></i> Clientes</a></li>
       
          </ul>
        </li>
        <li class=""> <a href="{{route('index_ventas')}}"> <i class="fa fa-tags"></i> <span>Ventas</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          
        </li>
        <li class=""> <a href="{{ route('verifi_salidas')}}"> <i class="fa fa-sign-out"></i> <span>Verificacion de salidas</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          
        </li>
        <li class=""> <a href="{{ route('apertura.index') }}"> <i class="fa  fa-money"></i> <span>Apertura de caja</span> <span   class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          
        </li>
        <li class="treeview"> <a href="#"> <i class="fa fa-archive"></i> <span>Reportes</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('reportes.index') }}"><i class="fa fa-angle-right"></i>Reporte diario</a></li>
           
         
          </ul>
        </li>
        <li class="treeview"> <a href="#"> <i class="fa fa-cogs"></i> <span>Mantenimiento</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
           <ul class="treeview-menu">
             <li><a href="{{ route('usuarios') }}"><i class="fa fa-angle-right"></i>Usuarios</a></li>
             <li><a href="{{ route('roles') }}"><i class="fa fa-angle-right"></i>Roles</a></li>
             <li><a href="{{ route('niveles') }}"><i class="fa fa-angle-right"></i>Niveles</a></li>
             <li><a href="{{ route('habitaciones_indexs') }}"><i class="fa fa-angle-right"></i>Tipo habitaciones</a></li>
             <li><a href="{{ route('habitaciones') }}"><i class="fa fa-angle-right"></i>Habitaciones</a></li>
             <li><a href="{{ route('index') }}"><i class="fa fa-angle-right"></i>Configuracion empresa</a></li>
          </ul>
        </li>
        <li class="treeview"> <a href="#"> <i class="fa fa-cogs"></i> <span>Inventario</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('categorias_index') }}"><i class="fa fa-angle-right"></i> Categorias</a></li>
            <li><a href="{{ route('productos_index') }}"><i class="fa fa-angle-right"></i>Productos</a></li>
         </ul>
        </li>
      </ul>
    </div>
    <!-- /.sidebar --> 
  </aside>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1>@yield('title_content_ol')</h1>
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><i class="fa fa-angle-right"></i> <a href="#">Pages</a></li>
        <li><i class="fa fa-angle-right"></i> Blank page</li>
      </ol>
    </div>
    
    <!-- Main content -->
    <div class="content">
      <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                               @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    <!-- /.content --> 
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">Version 1.0</div>
  <a target="_blank" href=""></a></footer>
  
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark"> 
    <!-- Tab panes -->
    <div class="tab-content"> 
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab"></div>
      <!-- /.tab-pane --> 
    </div>
  </aside>
  <!-- /.control-sidebar --> 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper --> 

<!-- jQuery 3 --> 
<script src="{{ asset('dist/js/jquery.min.js') }}"></script>  
<script src="{{ asset('dist/bootstrap/js/bootstrap.min.js') }}"></script> 

<!-- template --> 
<script src="{{ asset('dist/js/bizadmin.js') }}"></script> 
<script src="{{ asset('dist/plugins/popper/popper.min.js') }}"></script> 

<!-- for demo purposes --> 
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script src="{{ asset('dist/plugins/datatables/jquery.dataTables.min.js') }}"></script> 
<script src="{{ asset('dist/plugins/datatables/dataTables.bootstrap.min.js') }}"></script> 
<link rel="stylesheet" id="css-main" href="{{ asset('jquery-ui/jquery-ui.min.css') }}">

	<script src="{{ asset('jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{asset('toastr/build/toastr.min.js') }}"></script>
<script src="{{asset('toastr/toast.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@yield('scripts')
@include('layouts.scripts')
</body>
</html>
