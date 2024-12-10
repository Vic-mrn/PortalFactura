<?php
    require_once "../clases/conexion.php";
    $obj = new conectar();
    $conexion = $obj->conexion();

    $sql = "select id, Nombre, ApellidoP, ApellidoM, Direccion, CP, FechaN, RFC, RegimenFiscal from padres";

    $result = mysqli_query($conexion, $sql);
?>


<div>
    <table class="table table-hover table-condensed" id="datatable2">
        <thead style="background-color: rgb(37, 110, 170); color: white; font-weight: bold;">
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Apellido Paterno</td>
                <td>Apellido Materno</td>
                <td>Direccion</td>
                <td>Codigo Postal</td>
                <td>Fecha de Nacimiento</td>
                <td>RFC</td>
                <td>Regimen fiscal</td>
                <td>Editar</td>
                <td>Eliminar</td>
                <td>Enlazar alumno</td>
            </tr>
        </thead>
        <tfoot style="background-color: #ffffff; color: white; font-weight: bold;">
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Apellido Paterno</td>
                <td>Apellido Materno</td>
                <td>Direccion</td>
                <td>Codigo Postal</td>
                <td>Fecha de Nacimiento</td>
                <td>RFC</td>
                <td>Regimen fiscal</td>
                <td>Editar</td>
                <td>Eliminar</td>
                <td>Enlazar alumno</td>
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
                <td><?php echo $mostrar[8] ?></td>
                <td>
                    <span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ModificarDatosA"
                        onclick="agregaFrmActualizar('<?php echo $mostrar[0] ?>')">
                        <i class="fa-solid fa-user-pen"></i>
                    </span>
                </td>

                <td>
                    <span class="btn btn-danger btn-sm" onclick="eliminarDatos('<?php echo $mostrar[0] ?>')">
                        <i class="fa-solid fa-user-minus"></i>
                    </span>
                </td>

                <td>
                    <span class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EnlazarAlumno" onclick="obtenerNumero('<?php echo $mostrar[0] ?>')">
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

<script type="text/javascript">
new DataTable('#datatable2', {
    language: {
        url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json',
    },
}

);
</script>