<?php 

class UsuariosControlador{

    /*==============================
        LISTAR USUARIOS # 1 
      ==============================*/
	static public function ctrlUsuariosListar(){
		$menuUsuario = UsuariosModelo::mdlUsuariosListar();
		return $menuUsuario;
	}

    /*==============================
        LOGIN USUARIOS # 2
      ==============================*/
	static public function ctrlUsuariosLogin($usuario,$clave){
		$respuesta = UsuariosModelo::mdlIniciarSesion($usuario,$clave);
		return $respuesta;
	}

    /*============================================
        GUARDAR REGISTRO DE NUEVO USUARIO # 3
      ============================================*/
	static public function ctrlUsuariosGuardar($array_datos_usuario, $imagen){
			$respuesta = UsuariosModelo::mdlUsuariosGuardar($array_datos_usuario, $imagen);
			return $respuesta;
	}


    /*============================================
        GUARDAR MODIFICACION DE USUARIO # 4
      ============================================*/
    static public function ctrlUsuariosModificar($table,$id,$nameId,$data, $imagen){
        $res = UsuariosModelo::mdlUsuariosModificar($table,$id,$nameId,$data, $imagen);
        return $res;
    }




	/*==========================================================
	   			INICIO EVENTO DE CARGA DE MENU 
	  ==========================================================*/
	static public function ctrObtenerMenuUsuario($id){
		
		$menuUsuario = UsuariosModelo::mdlObtenerMenuUsuario($id);
		return $menuUsuario;
	}
	static public function ctrObtenerSubMenuUsuario($idMenu){
		$subMenuUsuario = UsuariosModelo::mdlObtenerSubMenuUsuario($idMenu);
		return $subMenuUsuario;
	}
	/*==========================================================*/

}

