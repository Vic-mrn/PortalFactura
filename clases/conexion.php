<?php

    class conectar{
        public function conexion(){
            $conexion=mysqli_connect('localhost','root','con.1234','facturas');
            return $conexion;
        }
    }

    $obj= new conectar();

?>