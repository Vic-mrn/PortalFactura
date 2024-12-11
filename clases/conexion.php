<?php

    class conectar{
        public function conexion(){
            $conexion=mysqli_connect('localhost','root','','facturas');
            return $conexion;
        }
    }

    $obj= new conectar();

?>