
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>{{ config('app.name', 'ordenesdecompra') }}</title>

    <!-- Scripts -->


    
    <!-- Fonts -->


    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.1/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/adminlibs.css') }}" >


    <style type="text/css">  
     .letra_btn:hover
     {
         color: #1a385b 
     }

     .now-ui-icons:hover{
         color: #1a385b !important
     }
     .letra_btn i:hover{
        color: #1a385b !important
    }




</style>

<script>
  window.Laravel = <?php echo json_encode([
      'csrfToken' => csrf_token(),
  ]); ?>
</script>
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">


            <!-- Sidebar - Brand -->

            <a class="sidebar-brand-text mx-3" id="index" href="#">
                <label style="max-width: 271px;color:#ffff">Servicio de Salud Arica</label>
                <div class="col-lg-12" style="padding-right:0 !important;padding-left:0 !important;max-width: 271px;">
                  <div class="row">
                    <div class="col-lg-6" style="padding-right:0 !important;padding-left:0 !important;">
                      <div style="height:4px;background-color:red;width:100%;"></div>
                  </div>
                  <div class="col-lg-6" style="padding-right:0 !important;padding-left:0 !important;">
                      <div style="height:4px;background-color:blue;width:100%;"></div>
                  </div>                            
              </div>
          </div>

          <label class="text-center" style="max-width: 271px;font-size: large;color:#ffff">GESTION ORDENES</label>
      </a>

      <!-- <div class="sidebar-brand-text mx-3">GOC</div> -->


      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{url('/home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>GOC</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Gestion de Ordenes
        </div> 



        <li class="nav-item">
            <a class="nav-link" href="{{url('solicitud_ordenes')}}">
                <i class="fas fa-fw fa-table"></i>
                <span>GENERAR ST/SC</span></a>
            </li> 

            <li class="nav-item">
                <a class="nav-link" href="{{url('listarordenes')}}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>LISTAR MIS ORDENES</span></a>
                </li> 

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitieslicitacion"
                    aria-expanded="true" aria-controls="collapseUtilitieslicitacion">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>CONVENIOS</span>
                </a>
                <div id="collapseUtilitieslicitacion" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Convenios:</h6>
                    <a class="collapse-item" href="{{url('licitacionview')}}">Crear Convenio</a>

                </div>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>ASIGNAR OT</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Asignaciones:</h6>
            <a class="collapse-item" href="{{url('asignarot')}}">Asignar OT</a>
            <a class="collapse-item" href="{{url('reasignar')}}">Reasignar OT</a>
            <a class="collapse-item" href="{{url('buscarot')}}">Buscar OT</a>
        </div>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities4"
    aria-expanded="true" aria-controls="collapseUtilities4">
    <i class="fas fa-fw fa-search"></i>
    <span>BUSCAR</span>
</a>
<div id="collapseUtilities4" class="collapse" aria-labelledby="headingUtilities"
data-parent="#accordionSidebar">
<div class="bg-white py-2 collapse-inner rounded">
    <h6 class="collapse-header">Buscar:</h6>
    <a class="collapse-item" href="{{url('buscarot')}}">Buscar OT</a>
    <a class="collapse-item" href="{{url('buscarcpp')}}">Buscar CPP</a>
</div>
</div>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2"
    aria-expanded="true" aria-controls="collapseUtilities2">
    <i class="fas fa-fw fa-wrench"></i>
    <span>CONFORMIDAD</span>
</a>
<div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities"
data-parent="#accordionSidebar">
<div class="bg-white py-2 collapse-inner rounded">
    <h6 class="collapse-header">Conformidad:</h6>
    <a class="collapse-item" href="{{url('conformidad')}}">Crear Conformidad</a>

</div>
</div>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{url('gestioncompra')}}">
        <i class="fas fa-fw fa-table"></i>
        <span>GESTION COMPRA</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCpp"
        aria-expanded="true" aria-controls="collapseCpp">
        <i class="fas fa-fw fa-wrench"></i>
        <span>CPP</span>
    </a>
    <div id="collapseCpp" class="collapse" aria-labelledby="headingUtilities"
    data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Gestion de CPP:</h6>
        <a class="collapse-item" href="{{url('cpp')}}">Crear CPP</a>


    </div>
</div>
</li>







<!-- Divider -->
<hr class="sidebar-divider">



<!-- Heading -->
<div class="sidebar-heading">
    GESTIÓN DE SOLICITUDES
</div>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsequimico"
    aria-expanded="true" aria-controls="collapseCpp">
    <i class="fas fa-fw fa-wrench"></i>
    <span>SOLICITUDES</span>
</a>
<div id="collapsequimico" class="collapse" aria-labelledby="headingUtilities"
data-parent="#accordionSidebar">
<div class="bg-white py-2 collapse-inner rounded">
    <h6 class="collapse-header">Solicitudes:</h6>
    <a class="collapse-item" href="{{url('listaquimico')}}">Solicitudes Quimicos</a>
    <a class="collapse-item" href="{{url('listafirmas')}}">Solicitudes Firmas</a>


</div>
</div>
</li>


<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
    aria-expanded="true" aria-controls="collapsePages">
    <i class="fas fa-donate"></i>
    <span>CENTROS DE COSTOS</span>
</a>
<div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">OT:</h6>
        <a class="collapse-item"  href="{{route('centroscostos.index',['post'=>1])}}">OT<span class="@if(getCompras() <= 0){
           badge bg-success
       }@else{
           badge bg-danger

       }@endif
       "  style="font-size: 16px"><label style="color:#ffff">{{getCompras()}}</label></span>

   </a> 
   <a class="collapse-item"  href="{{route('centroscostos.index',['post'=>2])}}">Viaticos <span class="@if(getViaticos() <= 0){
       badge bg-success
   }@else{
    badge bg-danger

}@endif
"style="font-size: 16px"><label style="color:#ffff">{{getViaticos()}}</label></span> 
</a>  
<a class="collapse-item" href="{{route('centroscostos.index',['post'=>3])}}">Fondos Fijos <span class="@if(getSolicitudFondoFijo() <= 0){
 badge bg-success
}@else{
    badge bg-danger

}@endif
"  style="font-size: 16px"><label style="color:#ffff">{{getSolicitudFondoFijo()}}</label></span> </a>                  
</div>
</div>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInventary"
    aria-expanded="true" aria-controls="collapseInventary">
    <i class="fa fa-cubes"></i>
    <span>CENTROS DE RESPOSABILIDAD</span>
</a>
<div id="collapseInventary" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">CR:</h6>
        <a class="collapse-item" href="{{route('subdireccion2.index',['post'=>2])}}">SDRFYF</a>
        <a class="collapse-item" href="{{route('subdireccion2.index',['post'=>1])}}">Direccion</a>
        <a class="collapse-item" href="{{route('subdireccion2.index',['post'=>3])}}">SDGA</a>
        <a class="collapse-item" href="{{route('subdireccion2.index',['post'=>4])}}">SDRRHH</a>

    </div>
</div>

</li>
<hr class="sidebar-divider">
<div class="sidebar-heading">
    GESTIÓN DE MANTENEDOR
</div>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMtd"
    aria-expanded="true" aria-controls="collapseCpp">
    <i class="fas fa-fw fa-wrench"></i>
    <span>MANTENEDOR</span>
</a>
<div id="collapseMtd" class="collapse" aria-labelledby="headingUtilities"
data-parent="#accordionSidebar">
<div class="bg-white py-2 collapse-inner rounded">
    <h6 class="collapse-header">Productos:</h6>
    <a class="collapse-item" href="{{url('modificarproductos')}}">Productos OT/CPP</a>
    <a class="collapse-item" href="{{url('generarproductos')}}">ADD Productos</a>
     <a class="collapse-item" href="{{url('generarproveedor')}}">ADD Proveedor</a>    
     <a class="collapse-item" href="{{url('generarcuentasigfe')}}">ADD Cuenta Sigfe</a>
      <a class="collapse-item" href="{{url('liberarcpp')}}">Liberar CPP</a>


</div>
</div>
</li>


<hr class="sidebar-divider d-none d-md-block">



</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->


            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                        placeholder="Search for..." aria-label="Search"
                        aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                @php

                $mensaje = mensajes();
                if (count(array(mensajes())) > 0) {
                    $cont=count(array(mensajes()));
                }else{
                    $cont=0;
                }
                @endphp

                <span class="badge badge-danger badge-counter">{{$cont}}</span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">

                    Centro de Mensajes


                </h6>
                @if (count(array(mensajes())) > 0)

                @foreach($mensaje as $times)
                <a class="dropdown-item d-flex align-items-center" href="{{route('notificaciones2.index',['post'=>$times->id])}}">
                    <div class="dropdown-list-image mr-3">

                        <img class="rounded-circle" src="{{asset('assets/img/exclamacion.png')}}" alt="...">
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate"> {{$times->observacion}}</div>

                    </div>
                </a>

                @endforeach


                @endif




                <a class="dropdown-item text-center small text-gray-500" href="#">Ver Todos Los mensajes</a>
            </div>
        </li>



        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">

            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ current_user()}}</span>
            <img class="img-profile rounded-circle"
            src="{{asset('assets/img/undraw_profile.svg')}}">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="userDropdown">

        <a class="dropdown-item" href="#">
            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
            Registro de actividades
        </a> 
        <div class="dropdown-divider"></div>


        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Cerrar Sesion
        </a>

    </div>
</li>

</ul>

</nav>
<!-- End of Topbar -->

<div class="row" id="app">

    @yield('content')
</div>







</div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Servicio de Salud</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <form action="{{ url('logout') }}" method="POST">
                @csrf
                <button type="submit"  class="btn btn-primary"> Cerrar Session </button>

            </form>
        </div>
    </div>
</div>
</div>

</body>

<script src="{{ asset('js/app.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/adminlibs.js') }}"></script>

</html>
