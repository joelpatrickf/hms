<?php 
require_once "constantes.php";
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sistema Clínico | HMS</title>
    <link rel="stylesheet" href="vistas/assets/css/login.css">
  </head>
  <body>

    <div class="login-box">
      <img src="images/logo.png" class="avatar" alt="Avatar Image">
      <h1>Health Medical Services (HMS)</h1>
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
  </body>
</html>
<script>
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