<?php 
session_start();
require_once "constantes.php";
    if(isset($_GET['cerrar_sesion']) && $_GET['cerrar_sesion'] == 1){
        header('location:'.RUTA);
        session_unset();
        session_destroy();        
    }
    
    //$v_id_modulo = isset($_SESSION['usuario']->id_perfil)?$_SESSION['usuario']->id_perfil:"";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sistema Clínico | HMS</title>
  
<!-- ----------------------------- plugins CSS ----------------------------- -->  
  <!-- ICONS plugins:css -->
  <link rel="stylesheet" href="vistas/assets/vendors/feather/feather.css"> 
  <link rel="stylesheet" href="vistas/assets/vendors/ti-icons/css/themify-icons.css">
  <!-- <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css"> -->

  
  <!-- DATATABLES -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">

  <link rel="stylesheet" href="vistas/assets/css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="vistas/assets/images/favicon.png" />




  <!-- ----------------------------- plugins:js ----------------------------- -->
  <script src="vistas/assets/vendors/js/vendor.bundle.base.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- <script src="vendors/datatables.net/jquery.dataTables.js"></script> -->
  <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

  <script src="vistas/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="vistas/assets/js/dataTables.select.min.js"></script>


  
  <!-- PARA QUE FUNCIONE EL MENU SIDEBAR Y NAVBAR -->
  <script src="vistas/assets/js/off-canvas.js"></script>
  <script src="vistas/assets/js/hoverable-collapse.js"></script>
  <script src="vistas/assets/js/template.js"></script>
  <script src="vistas/assets/js/settings.js"></script>

  <!-- <script src="js/dashboard.js"></script> -->
  <!-- <script src="js/Chart.roundedBarCharts.js"></script> -->

<style>
  


.sidebar .nav.sub-menu .nav-item .nav-link:hover {
    background: #4a4e52;
}


.sidebar .nav .nav-item.active > .nav-link {
    background: #007bff;
}

.sidebar .nav:not(.sub-menu) > .nav-item:hover > .nav-link, .sidebar .nav:not(.sub-menu) > .nav-item:hover[aria-expanded="true"] {
    background: #007bff;
}

.sidebar .nav:not(.sub-menu) > .nav-item.active {
     background: white; 
/*     background: #4B49AC; */
}


@media (min-width: 992px) {
    .sidebar-icon-only .sidebar .nav .nav-item .nav-link .menu-title {
/*        border-radius: 0 5px 5px 0px;*/
        background: white;
    }
    .sidebar-icon-only .sidebar .nav .nav-item.hover-open .nav-link:hover .menu-title {
        background: #343a40;
    }
}

</style>

</head>
<?php if(isset($_SESSION['usuario'])): ?>
    <body>
      <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <?php 
                include "modulos/aside.php";
                include "modulos/navbar.php"; 
            ?>

          <div class="main-panel">
            <div class="content-wrapper">
              
              <?php include "dashboard.php"; ?>

            </div>
           
          </div>
        </div>
      </div>


    </body>

<?php else: ?>
    <body>
       <?php include "vistas/login.php";?> 
    </body>
<?php endif; ?>
</html>



 <script>
    //click active menu and submenu
    $(".nav-item").on('click',function(){
        $(".nav-item").removeClass('active');
        $(this).addClass('active');
    })
    
    //// oculta em menu lateral aqui ragde
    $('body').addClass('sidebar-collapse')
    $('body').removeClass('sidebar-mini')
    $('body').removeClass('sidebar-mini-md')
    $(window).trigger('resize')



 </script>  