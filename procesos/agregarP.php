<?php 
	require_once "../clases/conexion.php";
	require_once "../clases/crudP.php";
	$obj= new crud();



	// Función para generar la CURP
    function generarRFC($nombre, $apellidoPaterno, $apellidoMaterno, $anio, $mes, $dia) {
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
        return $curp;
    }
		
    $dia = $_POST['dia'];
    $mes = $_POST['mes'];
    $anio = $_POST['anio'];

	



	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		// Inicializar un arreglo para errores
		$errores = [];

		// Lista de campos requeridos con sus valores por defecto
		$campos = [
			'nombre' => '',
			'apellidoP' => '',
			'apellidoM' => '',
			'direccion' => '',
			'cp' => '',
			'dia' => '',
			'mes' => 'Mes', // Valor por defecto del <select>
			'anio' => '',
			'sexo' => '',
			// 'estado' => '', // Valor por defecto del <select>
			'rfc' => '',
			'regimen' => 'Elige alguna opcion' // Valor por defecto del <select>
		];

		// Validar cada campo
		foreach ($campos as $campo => $valorPorDefecto) {
			if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '' || $_POST[$campo] === $valorPorDefecto) {
				$errores[] = "El campo '" . ucfirst($campo) . "' es obligatorio.";
			}
		}

		// Si hay errores, mostrarlos
		if (!empty($errores)) {
			foreach ($errores as $error) {
				echo "<p>$error</p>";
				exit;
			}
		} 

			// Validar que el año sea 2009 o posterior
			if ($anio < 1970) {
				echo "El año debe ser 1970 o posterior.";
				exit;
			}

			// Validar la fecha
			if (!checkdate($mes, $dia, $anio)) {
				echo "La fecha de nacimiento no es válida.";
				exit;
			}
	}

	$datos = array(
		$_POST['nombre'],
		$_POST['apellidoP'],
		$_POST['apellidoM'],
		$_POST['direccion'],
		$_POST['cp'],
		$fechaNacimiento = sprintf(
			'%04d-%02d-%02d', // Formato de salida
			intval($_POST['anio']), // Año en 4 dígitos
			intval($_POST['mes']),  // Mes en 2 dígitos
			intval($_POST['dia'])   // Día en 2 dígitos
		),
		generarRFC(
			$_POST['nombre'],
			$_POST['apellidoP'],
			$_POST['apellidoM'],
			$_POST['anio'],
			$_POST['mes'],
			$_POST['dia'],
		),
		// $_POST['rfc'],
		$_POST['regimen']
		
	);
	
		// Insertar en la base de datos
		echo $obj->agregar($datos);
		


	

 ?>