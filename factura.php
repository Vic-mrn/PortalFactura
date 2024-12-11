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

    $Var = 0;
    ?>
</head>

<?php include('clases/header.php'); ?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-center">
                    <div class="card-header">
                        Selecciona algun padre de familia para crear la factura
                    </div>
                    <div class="card-body">

                        <div id="tablaDatatable">

                        </div>
                    </div>
                    <div class="card-footer">
                        <div id="tablaDatatableE">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="GenerarFactura" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Agrega nuevos alumnos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="row g-3" id="FormAgregarP">
                        <label class="form-label">Datos generales</label>
                        <!-- Nombre -->
                        <div class="col-md-4">
                            <label class="form-label">Concepto</label>
                            <select class="form-select" name="regimen">
                                <option selected>Elige alguna opcion</option>
                                <option value="1">Gastos en general</option>
                                <option value="2">Transporte escolar</option>
                                <option value="3">Pagos por servicios educativos</option>
                            </select>
                        </div>

                        <div class="col-3">
                            <label class="form-label">Monto</label>
                            <input type="text" class="form-control" name="nombre"/>
                        </div>

                        <div class="col-4">
                            <label class="form-label">Apellido paterno</label>
                            <input type="text" class="form-control" name="apellidoP" placeholder="Lopez" />
                        </div>

                        <div class="col-4">
                            <label class="form-label">Apellido materno</label>
                            <input type="text" class="form-control" name="apellidoM" placeholder="Perez" />
                        </div>

                        <div class="col-8">
                            <label class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="direccion"
                                placeholder="Ingresa tu dirección" />
                        </div>

                        <div class="col-4">
                            <label class="form-label">Codigo Postal</label>
                            <input type="text" class="form-control" name="cp" placeholder="Ingresa tu CP" />
                        </div>

                        <div class="col-2">
                            <label for="inputAddress" class="form-label">Dia</label>
                            <input type="text" class="form-control" name="dia" placeholder="00" maxlength="2"
                                pattern="\d{1,2}" title="Solo se permiten números (máx. 2 dígitos)" required />
                        </div>


                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="RegistrarP">Registrar padre</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<!-- CARGAR TABLA -->
<script type="text/javascript">
$(document).ready(function() {
    $('#tablaDatatable').load('tablas/tablaPF.php');

});
</script>

<!-- CARGAR TABLA DE ENLACE-->
<!-- <script type="text/javascript">
$(document).ready(function() {
    $('#tablaDatatableE').load('tablas/tablaAF.php');

});
</script> -->

<!-- ACTUALIZA Y ELIMINAR -->
<script type="text/javascript">
// function obtenerNumero(id) {
//     $.ajax({
//         type: "POST",
//         data: "id=" + id,
//         url: "tablas/tablaAF.php",
//         success: function(r) {
//             if (r == 1) {
//                 alertify.success("Enlazado con exito!");
//             } else {
//                 console.log(r);
//                 alertify.error("No se pudo enlazar al padre");
//             }
//         }
//     });
// }

function Guardar(num1, num2) {

}

function GuardarDatosFactura(idP, idA) {
    $.ajax({
        type: "POST",
        data: "idAlumno=" + idA + "&idPadre=" + idP,
        url: "GFactura.php",
        success: function(r) {
            if (r == 1) {
                alertify.success("Enlazado con exito!");
            } else {
                alertify.error("No se pudo enlazar al padre");
            }
        }
    });
}
</script>



<?php include('clases/footer.php'); ?>