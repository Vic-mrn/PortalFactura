<?php
    require_once "../clases/conexion.php";
    $obj = new conectar();
    $conexion = $obj->conexion();

    $sql = "select id, Nombre, ApellidoP, ApellidoM, FechaN, CURP, NivelEducativo, Grado from alumnos";

    $result = mysqli_query($conexion, $sql);
?>


<div>
    <table class="table table-hover table-condensed" id="datatable">
        <thead style="background-color: rgb(37, 110, 170); color: white; font-weight: bold;">
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Apellido Paterno</td>
                <td>Apellido Materno</td>
                <td>Fecha de Nacimiento</td>
                <td>CURP</td>
                <td>Nivel Educativo</td>
                <td>Grado</td>
                <td>Editar</td>
                <td>Eliminar</td>
            </tr>
        </thead>
        <tfoot style="background-color: #ffffff; color: white; font-weight: bold;">
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Apellido Paterno</td>
                <td>Apellido Materno</td>
                <td>Fecha de Nacimiento</td>
                <td>CURP</td>
                <td>Nivel Educativo</td>
                <td>Grado</td>
                <td>Editar</td>
                <td>Eliminar</td>
            </tr>
        </tfoot>
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
                <td><?php echo $mostrar[5] ?></td>
                <td><?php echo $mostrar[6] ?></td>
                <td><?php echo $mostrar[7] ?></td>
                <td>
                    <span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ModificarDatosA" onclick="agregaFrmActualizar('<?php echo $mostrar[0] ?>')">
                        <span class="fa-solid fa-user-pen"></span>
                    </span>
                </td>
                
                <td>
                    <span class="btn btn-danger btn-sm" onclick="eliminarDatos('<?php echo $mostrar[0] ?>')">
                        <span class="fa-solid fa-user-minus"></span>
                    </span>
                </td>
            </tr>
            <?php 
                }
            ?>

        </tbody>
    </table>
</div>

<script type="text/javascript">
new DataTable('#datatable');
</script>