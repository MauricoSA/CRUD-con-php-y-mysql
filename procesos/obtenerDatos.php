<?php 
	require_once "../clases/Conexion.php";
	require_once "../clases/crud.php";
	$obj = new crud();
	
	echo json_encode($obj->obtenerDatos($_POST['idjuego']));
 ?>