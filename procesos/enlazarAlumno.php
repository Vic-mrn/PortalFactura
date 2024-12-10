<?php 
	
	require_once "../clases/conexion.php";
	require_once "../clases/crudP.php";

	$obj= new crud();

	echo $obj->enlazar($_POST['idAlumno'], $_POST['idPadre']);

 ?>