<?php 
	class crud{
		public function agregar($datos){

			$obj= new conectar();
			$conexion=$obj->conexion();

			$sql="INSERT into alumnos (Nombre, ApellidoP, ApellidoM, FechaN, CURP, NivelEducativo, Grado)
									values ('$datos[0]',
											'$datos[1]',
											'$datos[2]',
                                            '$datos[3]',
											'$datos[4]',
											'$datos[5]',
                                            '$datos[6]' )";
			return mysqli_query($conexion,$sql);
		}

		public function obtenDatos($idjuego){
			$obj= new conectar();
			$conexion=$obj->conexion();

			$sql="SELECT id_juego,
							nombre,
							anio,
							empresa
					from t_juegos 
					where id_juego='$idjuego'";
			$result=mysqli_query($conexion,$sql);
			$ver=mysqli_fetch_row($result);

			$datos=array(
				'id_juego' => $ver[0],
				'nombre' => $ver[1],
				'anio' => $ver[2],
				'empresa' => $ver[3]
				);
			return $datos;
		}

		public function actualizar($datos){
			$obj= new conectar();
			$conexion=$obj->conexion();

			$sql="UPDATE t_juegos set nombre='$datos[0]',
										anio='$datos[1]',
										empresa='$datos[2]'
						where id_juego='$datos[3]'";
			return mysqli_query($conexion,$sql);
		}
		
		public function eliminar($idAlumno){
			$obj= new conectar();
			$conexion=$obj->conexion();

			$sql="DELETE from alumnos where id='$idAlumno'";
			return mysqli_query($conexion,$sql);
		}
	}

 ?>