<?php 
if(isset($_SESSION)){ }else{ session_start(); }

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";



class AjaxUsuarios{

    /*==============================
        LISTAR USUARIOS # 1 
      ==============================*/

    public function ajaxUsuariosListar(){
        $res = UsuariosControlador::ctrlUsuariosListar();
        echo json_encode($res,JSON_UNESCAPED_UNICODE);
    }


    /*==============================
        VALIDAR LOGIN # 2 
      ==============================*/
    public function ajaxUsuariosLogin($usuario,$clave)   {
        $respuesta = UsuariosControlador::ctrlUsuariosLogin($usuario,$clave);
        
        if (empty($respuesta)) {
            $res='no';
            echo json_encode($res,JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
        }
    }

    /*============================================
        GUARDAR REGISTRO DE NUEVO USUARIO # 3
      ============================================*/
    public function ajaxUsuariosGuardar($array_datos_usuario, $imagen = null)
    {
        $res = UsuariosControlador::ctrlUsuariosGuardar($array_datos_usuario, $imagen);
        echo json_encode($res,JSON_UNESCAPED_UNICODE);
    }

    /*============================================
        GUARDAR MODIFICACION DE USUARIO # 4
      ============================================*/
    public function ajaxUsuariosModificar($data, $imagen = null)
    {
        $table= "usuarios";
        $id= $data['usuario']; 
        $nameId = "usuario";        
        $res = UsuariosControlador::ctrlUsuariosModificar($table,$id,$nameId,$data, $imagen);
        echo json_encode($res,JSON_UNESCAPED_UNICODE);
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 1) { // parametro para listrar Usuarios
    $res = new AjaxUsuarios();
    $res-> ajaxUsuariosListar();

}else if (isset($_POST['accion']) && $_POST['accion'] == 2) { // Login

    $res = new AjaxUsuarios();
    $res-> ajaxUsuariosLogin($_POST['usuario'],$_POST['clave']);

}else if (isset($_POST['accion']) && $_POST['accion'] == 3) { // Guardar
    //echo "<pre>";print_r($_POST);echo "<pre>";print_r($_FILES);

    $array_datos_usuario = [];
    parse_str($_POST['dato_usuario'], $array_datos_usuario);
    if(isset($_FILES["archivo"]["name"])){

        $imagen["ubicacionTemporal"] =  $_FILES["archivo"]["tmp_name"][0];
        $imagen["nuevoNombre"] = $array_datos_usuario['iptUsuarioMdl'];
        $imagen["folder"] = '../images/user/';
        $imagen["old_name"] = $_FILES["archivo"]["name"][0];

        $res = new AjaxUsuarios();
        $res -> ajaxUsuariosGuardar($array_datos_usuario, $imagen);

    }else{
        $res = new AjaxUsuarios();
        $res -> ajaxUsuariosGuardar($array_datos_usuario);
    }



}else if (isset($_POST['accion']) && $_POST['accion'] == 4) { // save
    $array_datos_usuario = [];
    $imagen=null;
    parse_str($_POST['dato_usuario'], $array_datos_usuario);
    //echo "<pre>";print_r($array_datos_usuario);echo "<pre>";exit();
    if(isset($_FILES["archivo"]["name"])){

        $imagen["ubicacionTemporal"] =  $_FILES["archivo"]["tmp_name"][0];
        $imagen["nuevoNombre"] = $array_datos_usuario['iptUsuarioMdl'];
        $imagen["folder"] = '../images/user/';
        $imagen["old_name"] = $_FILES["archivo"]["name"][0];
    }
    
        $data = array(
            "usuario" => $array_datos_usuario["iptUsuarioMdl"],
            "password1" => $array_datos_usuario["iptPasswordMdl"],
            "cod_farmacia" => $array_datos_usuario["selBodegasMdl"],
            "empleado" => $array_datos_usuario["iptNombresMdl"],
            "rol" => $array_datos_usuario["iptRol"],
            "cedula" => $array_datos_usuario["iptCedulaMdl"],
            "pass_deposito" => $array_datos_usuario["iptPasswordMdl"],
            "id_perfil_usuario" => $array_datos_usuario["selPerfilMdl"],
            "estado" => $array_datos_usuario["selEstadoMdl"],
            "foto" => $array_datos_usuario["iptFoto"],
            "usuario_creacion" => $array_datos_usuario["iptUsuarioCreacionMdl"],
            "fecha" => $array_datos_usuario["iptFechaCreacionMdl"],
        );


        $empleados = new ajaxUsuarios();
        $empleados -> ajaxUsuariosModificar($data, $imagen);

}
