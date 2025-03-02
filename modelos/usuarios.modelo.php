	<?php 
//if(isset($_SESSION)){ }else{ session_start(); } 

require_once "conexion.php";

class UsuariosModelo{

    /*==============================
        LISTAR USUARIOS # 1 
      ==============================*/
	static public function mdlUsuariosListar(){
		
		$stmt = Conexion::conectar()->prepare("SELECT '' AS vacio,  au_inc,usuario,password1,cod_farmacia,empleado,rol,cedula,pass_deposito,id_perfil_usuario,estado,foto,usuario_creacion,fecha,fecha_edicion from usuarios where cod_farmacia<>'Com02' ");
		
		$stmt->execute();
		$res = $stmt-> fetchAll(PDO::FETCH_ASSOC);
		return $res;

	}	


	/* *********************************
		validacion de usuarios
	**********************************/
	static public function mdlIniciarSesion($usuario,$password)
	{
		$stmt = Conexion::conectar()->prepare("SELECT *
			from usuarios  
			WHERE usuario = :usuario and password = :password ");

		$stmt->bindParam(":usuario",$usuario,PDO::PARAM_STR);
		$stmt->bindParam(":password",$password,PDO::PARAM_STR);
		$stmt->execute();
		
        $res = $stmt ->fetchAll(PDO::FETCH_CLASS);
		
        if (!empty($res)) {
            $_SESSION['usuario'] = $res[0]; // almacena la respuesta en una sesion
        }

        return $res;
	}


    /*============================================
        GUARDAR REGISTRO DE NUEVO USUARIO # 3
      ============================================*/
    static public function mdlUsuariosGuardar($array_datos_usuario, $imagen){
    	// echo "<pre>";print_r($array_datos_usuario);echo "<pre>";
    	// exit();

        // try {
                     
            $stmt = Conexion::conectar()->prepare("INSERT INTO usuarios(usuario,password1,cod_farmacia,empleado,rol,cedula,pass_deposito,id_perfil_usuario,estado,foto,usuario_creacion,fecha) VALUES(:usuario,:password1,:cod_farmacia,:empleado,:rol,:cedula,:pass_deposito,:id_perfil_usuario,:estado,:foto,:usuario_creacion,:fecha)");

            $stmt->bindParam(":usuario", $array_datos_usuario['iptUsuarioMdl']);
            $stmt->bindParam(":password1", $array_datos_usuario['iptPasswordMdl']); 
            $stmt->bindParam(":cod_farmacia", $array_datos_usuario['selBodegasMdl']); 
            $stmt->bindParam(":empleado", $array_datos_usuario['iptNombresMdl']); 
            $stmt->bindParam(":rol", $array_datos_usuario['iptRol']); 
            $stmt->bindParam(":cedula", $array_datos_usuario['iptCedulaMdl']); 
            $stmt->bindParam(":pass_deposito", $array_datos_usuario['iptPasswordMdl']); 
            $stmt->bindParam(":id_perfil_usuario", $array_datos_usuario['selPerfilMdl']); 
            $stmt->bindParam(":estado", $array_datos_usuario['selEstadoMdl']); 
            $stmt->bindParam(":foto", $array_datos_usuario['iptFoto']); 
            $stmt->bindParam(":usuario_creacion", $array_datos_usuario['iptUsuarioCreacionMdl']); 
            $stmt->bindParam(":fecha", $array_datos_usuario['iptFechaCreacionMdl']);
            
            if ($stmt->execute()){
                if($imagen){
                                
                    $guardarImagen = new UsuariosModelo();
                    $guardarImagen->guardarImagen($imagen["folder"], $imagen["ubicacionTemporal"], $array_datos_usuario['iptFoto']);
                }

               
                $resultado="ok";
                
            }else{
             $resultado="error";
           }
        //// } catch (Exception $e) {
            // $resultado='Exception Capturada'. $e->getMessage(). "\n";  
        // }
           return $resultado;
           
            $stmt=null;
    }    // function guardar


   /*============================================
        GUARDAR MODIFICACION DE USUARIO # 4
      ============================================*/
    static public function mdlUsuariosModificar($table,$id,$nameId,$data, $imagen){

        $set = "";
        foreach ($data as $key => $value){
            $set .= $key." = :".$key.",";
        }

        $set = substr($set, 0, -1);

        $stmt = Conexion::conectar()->prepare("UPDATE $table SET $set WHERE $nameId = :$nameId");
        
        foreach ($data as $key => $value){
            $stmt->bindParam(":".$key, $data[$key], PDO::PARAM_STR);
        }
        
        $stmt->bindParam(":".$nameId, $id, PDO::PARAM_STR);

        if ($stmt->execute()){
            if($imagen){
                            
                $guardarImagen = new UsuariosModelo();
                $guardarImagen->guardarImagen($imagen["folder"], $imagen["ubicacionTemporal"], $data['foto']);
            }                
            $resultado="ok";
        }else{
            $resultado="error";
        }

        return $resultado;
    }





	static public function mdlObtenerMenuUsuario($id){
		$stmt = Conexion::conectar()->prepare("SELECT m.id,modulo, m.icon_menu, m.vista, pm.vista_inicio 
		from usuarios u inner join perfiles p on u.id_perfil_usuario = p.id_perfil
		inner join perfil_modulo pm on pm.id_perfil = p.id_perfil
		inner join modulos m on m.id = pm.id_modulo
		WHERE u.au_inc = :id_usuario
		AND (m.padre_id is null or m.padre_id = 0)
		order by m.orden");
		
		$stmt->bindParam(":id_usuario",$id,PDO::PARAM_STR);
		$stmt->execute();


		return $stmt-> fetchAll(PDO::FETCH_CLASS);

	}


	static public function mdlObtenerSubMenuUsuario($idMenu)
	{
		$id_perfil_login=$_SESSION['usuario']->id_perfil_usuario;
		//$stmt = Conexion::conectar()->prepare("SELECT m.id, m.modulo, m.icon_menu, m.vista from modulos m where m.padre_id= :idMenu order by m.id");
		/* Ordenador por ORDEN no por ID */
		$stmt = Conexion::conectar()->prepare("SELECT m.id, m.modulo, m.icon_menu, m.vista
											from perfil_modulo p
											INNER JOIN modulos m ON m.id = p.id_modulo
											where m.padre_id= :idMenu and p.id_perfil = '$id_perfil_login'
											order by m.orden;");
		
		$stmt->bindParam(":idMenu",$idMenu,PDO::PARAM_STR);
		$stmt->execute();

		return $stmt-> fetchAll(PDO::FETCH_CLASS);

	}
	
	static public function mdlObtenerUsuarios()
	{
		$stmt = Conexion::conectar()->prepare("SELECT '' AS id,  usuario, password1, cod_farmacia, empleado, rol, cedula, fecha, password1, id_perfil_usuario, estado from usuarios where cod_farmacia<>'Com02' ORDER BY cod_farmacia");
		
		//$stmt->bindParam(":idMenu",$idMenu,PDO::PARAM_STR);
		$stmt->execute();
		//return $stmt-> fetchAll(PDO::FETCH_OBJ);
		//return $stmt-> fetchAll(PDO::FETCH_NUM);
		return $stmt-> fetchAll();

	}	






    /*======================================
        GUARDAR IMAGEN/FOTO
      ======================================*/
    public function guardarImagen($folder, $ubicacionTemporal, $nuevoNombre){
        file_put_contents(strtolower($folder.$nuevoNombre), file_get_contents($ubicacionTemporal));
    }
}



 ?>