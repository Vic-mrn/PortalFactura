<?php
    require_once "../clases/conexion.php";
    $obj = new conectar();
    $conexion = $obj->conexion();
    
    // SELECT Padres.id, Padres.Nombre, Padres.RFC, Alumnos.id, Alumnos.Nombre, Padres.CURP FROM PadreHijo JOIN Padres ON PadreHijo.idPadre = Padres.id JOIN Alumnos ON PadreHijo.idHijo = Alumnos.id;
    $sql = "select Padres.id, Padres.Nombre, Padres.RFC, Alumnos.id, Alumnos.Nombre, Alumnos.CURP FROM PadreHijo JOIN Padres ON PadreHijo.idPadre = Padres.id JOIN Alumnos ON PadreHijo.idHijo = Alumnos.id";
    $result = mysqli_query($conexion, $sql);
?>


<div>
    <table class="table table-hover table-condensed" id="datatable2">
        <thead style="background-color: rgb(37, 110, 170); color: white; font-weight: bold;">
            <tr>
                <td>ID Padre</td>
                <td>Nombre Padre</td>
                <td>RFC</td>
                <td>ID Alumno</td>
                <td>Nombre Alumno</td>
                <td>CURP</td>
                <td>Generar Factura</td>
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
                <td><?php echo $mostrar[5] ?></td>
                <td>
                    <form method="GET" action="GFactura.php">
                        <input type="hidden" name="idP" value="<?php echo $mostrar[0]; ?>" />
                        <input type="hidden" name="idA" value="<?php echo $mostrar[3]; ?>" />
                        <input type="submit" value="+" class="btn btn-primary">
                    </form>
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