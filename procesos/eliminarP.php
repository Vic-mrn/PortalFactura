<?php 
	
	require_once "../clases/conexion.php";
	require_once "../clases/crudp.php";

	$obj= new crud();

	echo $obj->eliminar($_POST['idPadre']);

 ?>