<?php
    require_once "../clases/conexion.php";
    
    $obj = new conectar();
    $conexion = $obj->conexion();
    
    $sql = "SELECT * FROM bitacora";
// '{$id}'
    $result = mysqli_query($conexion, $sql);
    
 
?>

<div>
    <table class="table table-hover table-condensed" id="datatableA">
        <thead style="background-color: rgb(37, 110, 170); color: white; font-weight: bold;">
            <tr>
                <td>ID</td>
                <td>Usuario</td>
                <td>Acción</td>
                <td>Fecha</td>
                <td>Hora</td>
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
            </tr>
            <?php 
                }
            ?>

        </tbody>
    </table>
</div>




<script type="text/javascript">
new DataTable('#datatableA');
</script>