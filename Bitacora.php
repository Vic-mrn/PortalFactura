<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <?php 
    require_once "script.php";
    require_once "clases/conexion.php";

    $obj1 = new conectar();
    $conn = $obj1->conexion();

    $sql1 = "select id, nombre from meses";
    $sql2 = "select inicial, nombre from estados";

    $meses = mysqli_query($conn, $sql1);
    $estados = mysqli_query($conn, $sql2);

    ?>
</head>

<?php include('clases/header.php'); ?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-center">
                    <div class="card-header">
                        Bitacora de inicios de sesion
                    </div>
                    <div class="card-body">
                        <div id="tablaDatatable">
                            
                        </div>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<!-- CARGAR TABLA -->
<script type="text/javascript">
$(document).ready(function() {
    $('#tablaDatatable').load('tablas/tablaB.php');

});
</script>




<?php include('clases/footer.php'); ?>

