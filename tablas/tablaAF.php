<?php
    require_once "../clases/conexion.php";
    
    // $data = json_decode(file_get_contents('php://input'), true);
    // $id = $data['id'] ?? null;
    // echo $id;
    $obj = new conectar();
    $conexion = $obj->conexion();
    
    $sql = "select Alumnos.id, Alumnos.Nombre, Alumnos.ApellidoP, Alumnos.ApellidoM, Alumnos.CURP from padrehijo JOIN Alumnos ON padrehijo.idHijo = Alumnos.id where padrehijo.idPadre = 1";
// '{$id}'
    $result = mysqli_query($conexion, $sql);
    
 
?>

<div>
    <table class="table table-hover table-condensed" id="datatableA">
        <thead style="background-color: rgb(37, 110, 170); color: white; font-weight: bold;">
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Apellido Paterno</td>
                <td>Apellido Materno</td>
                <td>CURP</td>
                <td>Generar factura</td>
            </tr>
        </thead>
        <tbody>
            <?php 
                while ($mostrar=mysqli_fetch_row($result)) {
            ?>
            <tr>
                <td><?php echo $mostrar[0] ?></td>
                <td><?php echo $mostrar[1] ?></td>
                <td><?php echo $mostrar[2] ?></td>
                <td><?php echo $mostrar[3] ?></td>
                <td><?php echo $mostrar[4] ?></td>
                <td>
                    <span class="btn btn-primary" onclick="enlazarPadres('<?php echo $mostrar[0] ?>')">
                        <i class="fa-solid fa-user-plus"></i>
                    </span>
                </td>
            </tr>
            <?php 
                }
            ?>

        </tbody>
    </table>
</div>




<!-- <script type="text/javascript">
new DataTable('#datatableA');
</script> -->