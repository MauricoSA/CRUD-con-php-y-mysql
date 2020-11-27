<?php 
	require_once "../clases/Conexion.php";
	require_once "../clases/crud.php";
	$obj = new crud();
	
	echo $obj->eliminar($_POST['idjuego']);
 ?>