<?php

class Conexion{
 
    private $connection;

    static public function conectar(){
        try {

            $conn = new PDO("mysql:host=localhost;dbname=hms","rsplusex","Alfaomega@123",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8 "));

            //$conn = new PDO("mysql:host=50.31.188.124;dbname=farmagr1_farmagreen","farmagr1_jas","JfigueroaP@abc",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8 "));
            
            return $conn;
        }
        catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }

    }
}
