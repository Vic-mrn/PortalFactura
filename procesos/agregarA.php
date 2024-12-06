<?php 
	require_once "../clases/conexion.php";
	require_once "../clases/crud.php";
	$obj= new crud();

	// Validar los datos del formulario
    function validarDatos($datos) {
        foreach ($datos as $dato) {
            if (empty($dato)) {
                return false;
            }
        }
        return true;
    }

	// Función para generar la CURP
    function generarCURP($nombre, $apellidoPaterno, $apellidoMaterno, $anio, $mes, $dia, $sexo, $estado) {
        $nombre = strtoupper($nombre);
        $apellidoPaterno = strtoupper($apellidoPaterno);
        $apellidoMaterno = strtoupper($apellidoMaterno);
        $curp = substr($apellidoPaterno, 0, 1); // Primera letra del apellido paterno
        $primeraVocal = preg_match('/[AEIOU]/', substr($apellidoPaterno, 1), $matches) ? $matches[0] : '';
		$curp .= $primeraVocal;
        $curp .= substr($apellidoMaterno, 0, 1); // Primera letra del apellido materno
        $curp .= substr($nombre, 0, 1); // Primera letra del primer nombre
        $curp .= substr($anio, -2); // Últimos dos dígitos del año de nacimiento
        $curp .= str_pad($mes, 2, '0', STR_PAD_LEFT); // Mes de nacimiento
        $curp .= str_pad($dia, 2, '0', STR_PAD_LEFT); // Día de nacimiento
        $curp .= strtoupper($sexo); // Sexo (H o M)
        $curp .= strtoupper(substr($estado, 0, 2)); // Abreviatura del estado

        return $curp;
    }
		
    $dia = $_POST['dia'];
    $mes = $_POST['mes'];
    $anio = $_POST['anio'];

	
	// Validar que el año sea 2009 o posterior
	if ($anio < 2009) {
		echo "El año debe ser 2009 o posterior.";
		exit;
	}

	// Validar la fecha
	if (!checkdate($mes, $dia, $anio)) {
		echo "La fecha de nacimiento no es válida.";
		exit;
	}

	$fechaNacimiento = "$dia-$mes-$anio"; // Formato YYYY-MM-DD


	$datos = array(
		$_POST['nombre'],
		$_POST['apellidoP'],
		$_POST['apellidoM'],
		"$_POST[dia]-$_POST[mes]-$_POST[anio]", // Fecha de nacimiento
		generarCURP(
			$_POST['nombre'],
			$_POST['apellidoP'],
			$_POST['apellidoM'],
			$_POST['anio'],
			$_POST['mes'],
			$_POST['dia'],
			$_POST['sexo'],
			$_POST['estado']
		),
		$_POST['nivel'],
		$_POST['grado']
		
	);
	
		// Insertar en la base de datos
		echo $obj->agregar($datos);
		


	

 ?>