
<!DOCTYPE HTML>
<html>
	<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Hospital Management System</title>
		
		<link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
		
    	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<style>


	</style>
	<link rel="stylesheet" href="vistas/assets/css/login.css">

	</head>
	<body>
		

<nav class="navbar">
	<div class="col-12 col-lg-6">
		<h3>Health Medical Services (HMS)</h3>
	</div>
	<div class="col-12 col-lg-6">
		  <ul class="nav-list">
		    <li><a href="index.html">Inicio</a></li>
		    <li><a href="contact.php">Contacto</a></li>
		  </ul>
		
	</div>	
</nav>

	<!-- Carrusel -->
	<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">


	    <div class="carousel-inner">


	        <div class="carousel-item active">
	            <img src="images/slider-image1.jpg" class="d-block w-100" alt="Imagen 1">
	        </div>
	        <div class="carousel-item">
	            <img src="images/slider-image2.jpg" class="d-block w-100" alt="Imagen 2">
	        </div>
	        <div class="carousel-item">
	            <img src="images/slider-image3.jpg" class="d-block w-100" alt="Imagen 3">
	        </div>
	    </div>
	    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
	        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	        <span class="visually-hidden">Anterior</span>
	    </button>
	    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
	        <span class="carousel-control-next-icon" aria-hidden="true"></span>
	        <span class="visually-hidden">Siguiente</span>
	    </button>    

    <div class="login-box">
      <img src="images/logo2.png" class="avatar" alt="Avatar Image">
      <h1>Login (HMS)</h1>
      <form>
        
        <label for="iptUsuario">Correo</label>
        <input type="text" id="iptUsuario" placeholder="Ingrese un Correo">
        
        <label for="iptPassword">Contraseña</label>
        <input type="password" id="iptPassword" placeholder="Ingrese la Contraseña">
        <br>
        <br>

        <input type="submit" id="btnLogin" value="Ingresar">
        <br><br>

      </form>
    </div>	


	</div>





	
	</body>
</html>
<!-- Bootstrap JS -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myCarousel = document.querySelector('#carouselExample');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 10000 // 10 segundos
        });
    });

  $(document).ready(function(){

    $("#btnLogin").on('click',function(e){
      e.preventDefault();
      var usuario = $("#iptUsuario").val();
      var pass = $("#iptPassword").val();
      $.ajax({
        url:"ajax/usuarios.ajax.php",
        type: "POST",
        data: {
          'accion': 2,
          'usuario': usuario ,
          'clave': pass
        },
        dataType: 'json',
        success:function(respuesta){
            console.log(respuesta);            
            if (respuesta === 'no'){
              //toastr["error"](" Credenciales Incorrectas", "!Atención!");
              alert("credenciall incorrect");
              $("#iptUsuario").val("");
              $("#iptPassword").val("");
              return;
              
            }else{
              var rutaJs = '<?php echo RUTA ?>';
              window.location = rutaJs;
                
            }
        }
    });
    });  
  });     
</script>