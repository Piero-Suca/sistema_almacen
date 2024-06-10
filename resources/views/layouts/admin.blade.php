<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en" xmlns:mso="urn:schemas-microsoft-com:office:office"
    xmlns:msdt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <!--[if gte mso 9]><xml>
<mso:CustomDocumentProperties>
<mso:display_urn_x003a_schemas-microsoft-com_x003a_office_x003a_office_x0023_SharedWithUsers msdt:dt="string">Integrantes de la TIENDA VIRTUAL G14</mso:display_urn_x003a_schemas-microsoft-com_x003a_office_x003a_office_x0023_SharedWithUsers>
<mso:SharedWithUsers msdt:dt="string">28;#Integrantes de la TIENDA VIRTUAL G14</mso:SharedWithUsers>
</mso:CustomDocumentProperties>
</xml><![endif]-->
    @routes
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#" data-widget="pushmenu" style="color: aliceblue;">
                        <i class="fas fa-bars" style="font-size: 24px;"></i>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/salle_sisga/public/admin" style="color: aliceblue;">
                        <b style="margin-top: -5px;">Ir al inicio</b>
                    </a>
                </li>
            </ul>
        
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" style="color: aliceblue;">
                        <b>Salir</b>
                        <i class="fas fa-sign-out-alt" onclick="document.getElementById('formulario-logout').submit()" style="font-size: 20px; padding-left: 5px;"  role="button"></i>
                    </a>
                    <form id="formulario-logout" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
            
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #B8742D">
            <!-- Brand Logo -->
            <a href="http://localhost/salle_sisga/public/admin" class="brand-link"  style="background-color:#B8742D">
                <img src="{{ asset('dist/img/logo.png') }}"  alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3"  style="opacity: .8">
                <span class="brand-text font-weight-light">SISGA</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('dist/img/logotipe.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a  class="d-block">{{Auth::user()->name}}</a>   <!-- CONEXIÓN CON EL NOMBRE -->
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a  class="nav-link">
                                <i class=""></i>
                                <p>
                                   MENÚ DE ALMACÉN
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-toolbox"></i>
                                <p>
                                    Almacén
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('articulo.index') }}" class="nav-link">
                                        <i class="fas fa-tools nav-icon"></i>
                                        <p>Inventario</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('entrada.index') }}" class="nav-link">
                                        <i class="fas fa-arrow-right nav-icon"></i>
                                        <p>Entradas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('salida.index') }}" class="nav-link">
                                        <i class="fas fa-arrow-left nav-icon"></i>
                                        <p>Salidas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('categoria.index') }}" class="nav-link">
                                        <i class="fas fa-tags nav-icon"></i>
                                        <p>Categorias</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('proveedor.index') }}" class="nav-link">
                                        <i class="fas fa-truck nav-icon"></i>
                                        <p>Proveedores</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Configuraciones
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('programa.index') }}" class="nav-link">
                                        <i class="fas fa-book-open nav-icon"></i>
                                        <p>Programas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('estudiante.index') }}" class="nav-link">
                                        <i class="fas fa-user-graduate nav-icon"></i>
                                        <p>Estudiantes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('docente.index') }}" class="nav-link">
                                        <i class="fas fa-chalkboard-teacher nav-icon"></i>
                                        <p>Docentes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('personal.index') }}" class="nav-link">
                                        <i class="fas fa-user-tie nav-icon"></i>
                                        <p>Personal</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('persona.index') }}" class="nav-link">
                                        <i class="fas fa-user nav-icon"></i>
                                        <p>Persona</p>
                                    </a>
                                </li>
                                
                                <li class="nav-item"> 
                                    <a href="{{ route('especialidad.index') }}" class="nav-link"> 
                                        <i class="fas fa-user-cog nav-icon"></i> 
                                        <p>Especialidades</p> 
                                    </a> 
                                </li> 
                                <li class="nav-item"> 
                                    <a href="{{ route('oficina.index') }}" class="nav-link"> 
                                        <i class="fas fa-building nav-icon"></i> 
                                        <p>Oficinas</p> 
                                    </a> 
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('usuario.index') }}" class="nav-link">
                                        <i class="fas fa-user-check nav-icon"></i>
                                        <p>Usuarios</p>
                                    </a>
                                </li>

                            </ul>
                            
                        </li>



                       

                        
                        



                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('contenido')

        <!-- Control Sidebar -->
        {{-- <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside> --}}
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            {{-- <div class="float-right d-none d-sm-inline">
                Slogan
            </div> --}}
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> Todos los
            derechos reservados.
        </footer>
    </div>


<style>

    <style>
        .mt-2{
            background: #B8742D;
        }
        </style>

<style>
        .sidebar{
            background:#B8742D;
        }
        </style>

<style>
        .Navbar{
            background: #B8742D;
        }
        </style>


<style>
        .control-sidebar{
            background:#B8742D;
        }
        </style>
    <!-- ./wrapper -->

    @yield('modales')

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('js/funciones.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @yield('javascript')
</body>

</html>
