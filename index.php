<?php 

include 'controladores/plantilla.controlador.php';

require_once "controladores/usuarios.controlador.php";
require_once "modelos/usuarios.modelo.php";


$plantilla= new ControladorPlantilla;
$plantilla->controladorPlantilla();
