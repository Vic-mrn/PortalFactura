<?php
$obj= new conectar();
$conexion=$obj->conexion();

if (!empty($_POST["btnIngresar"])) {
    if (empty($_POST["usuario"]) and empty($_POST["contra"])) {
        echo '<div class="alert alert-danger">Los campos estan vacios, intenta de nuevo</div>';
    } else {
        $usuario=$_POST["usuario"];
        $clave=$_POST["contra"];
        $sql=$conexion->query("select * from administrativos where Usuario='$usuario' and Contrasenia='$clave'");
        if($datos=$sql->fetch_object()){

            $insert_bitacora = $conexion->query("INSERT INTO bitacora (Usuario, Accion) VALUES ('$usuario', 'Inicio de sesion')");

            header("location:portal.php");
        } else {
            echo '<div class="alert alert-danger">Credenciales incorrectas</div>';
        }
        
    }
}

?>