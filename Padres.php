<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php 
    require_once "script.php";
    require_once "clases/conexion.php";

    $obj1 = new conectar();
    $conn = $obj1->conexion();

    $sql1 = "select id, nombre from meses";
    $sql2 = "select id, nombre from estados";

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
                        Tabla dinamica
                    </div>
                    <div class="card-body">
                        <span class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AgregarAlumnos">
                            Agregar
                            <i class="fa-solid fa-user-plus"></i>
                        </span>
                        <hr>

                        <div id="tablaDatatable">

                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="AgregarAlumnos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Agrega nuevos alumnos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="FormAgregarA">
                        <label class="form-label">Datos generales</label>
                        <!-- Nombre -->
                        <div class="col-4">
                            <label class="form-label">Nombre(s)</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Juan Carlos" />
                        </div>

                        <div class="col-4">
                            <label class="form-label">Apellido paterno</label>
                            <input type="text" class="form-control" name="apellidoP" placeholder="Lopez" />
                        </div>

                        <div class="col-4">
                            <label class="form-label">Apellido materno</label>
                            <input type="text" class="form-control" name="apellidoM" placeholder="Perez" />
                        </div>

                        <!-- Fecha de nacimiento -->
                        <hr>
                        <div class="col-2">
                            <label for="inputAddress" class="form-label">Dia</label>
                            <input type="text" class="form-control" name="dia" placeholder="00" maxlength="2"
                                pattern="\d{1,2}" title="Solo se permiten números (máx. 2 dígitos)" required />
                        </div>

                        <div class="col-2">
                            <label class="form-label">Mes</label>
                            <select class="form-select" name="mes">
                                <option selected>Mes</option>
                                <?php
                                    // Iterar los resultados y crear las opciones del select
                                    if ($meses->num_rows > 0) {
                                        while ($row = $meses->fetch_assoc()) {
                                            echo "<option value='" . $row['iniciales'] . "'>" . $row['nombre'] . "</option>";
                                        }
                                    } else {
                                        echo "<option>No hay datos</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="col-2">
                            <label for="inputAddress" class="form-label">Año</label>
                            <input type="text" class="form-control" name="anio" placeholder="2009" maxlength="4"
                                pattern="\d{4}" title="Solo se permiten números (exactamente 4 dígitos)" required />
                        </div>

                        <div class="col-2">
                            <label class="form-label">Sexo</label>
                            <select class="form-select" name="sexo">
                                <option selected value="M">Mujer</option>
                                <option value="H">Hombre</option>
                            </select>
                        </div>

                        <div class="col-4">
                            <label class="form-label">Estado</label>
                            <select class="form-select" name="estado">
                                <option selected>Selecciona un estado</option>
                                <?php
                                // Iterar los resultados y crear las opciones del select
                                if ($meses->num_rows > 0) {
                                    while ($row = $estados->fetch_assoc()) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                                    }
                                } else {
                                    echo "<option>No hay datos</option>";
                                }
                                ?>
                            </select>
                        </div>


                        <?php
                        // Cerrar la conexión
                        $conn->close();
                        ?>
                        <hr>
                        <label class="form-label">Datos escolares</label>
                        <!-- Nivel educativo -->
                        <div class="col-md-4">
                            <label class="form-label">Nivel educativo</label>
                            <select class="form-select" name="nivel">
                                <option selected>Elige alguna opcion</option>
                                <option>Preescolar</option>
                                <option>Primaria</option>
                                <option>Secundaria</option>
                            </select>
                        </div>

                        <!-- Grado  -->
                        <div class="col-md-3">
                            <label class="form-label">Grado</label>
                            <select class="form-select" name="grado">
                                <option selected>Elige alguna opcion</option>
                                <option>1ro</option>
                                <option>2do</option>
                                <option>3ro</option>
                                <option>4to</option>
                                <option>5to</option>
                                <option>6to</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="RegistrarA">Registrar Alumno</button>
                </div>
            </div>
        </div>
    </div>





</body>

</html>

<!-- CARGAR TABLA -->
<script type="text/javascript">
$(document).ready(function() {
    $('#tablaDatatable').load('tablas/tablaP.php');

});
</script>

<!-- BOTONES -->
<script type="text/javascript">
$(document).ready(function() {
    $('#RegistrarA').click(function() {
        datos = $('#FormAgregarA').serialize();

        $.ajax({
            type: "POST",
            data: datos,
            url: "procesos/agregarA.php",
            success: function(r) {
                if (r == 1) {
                    $('#FormAgregarA')[0].reset();
                    $('#tablaDatatable').load('tabla.php');
                    alertify.success("Agregado con exito");
                } else {
                    alertify.error(r);
                }
            }
        });
    });

    $('#btnActualizar').click(function() {
        datos = $('#frmnuevoU').serialize();

        $.ajax({
            type: "POST",
            data: datos,
            url: "procesos/actualizar.php",
            success: function(r) {
                if (r == 1) {
                    $('#tablaDatatable').load('tabla.php');
                    alertify.success("Actualizado con exito :D");
                } else {
                    alertify.error("Fallo al actualizar :(");
                }
            }
        });
    });
});
</script>

<!-- ACTUALIZA Y ELIMINAR -->
<script type="text/javascript">
function agregaFrmActualizar(idjuego) {
    $.ajax({
        type: "POST",
        data: "idjuego=" + idjuego,
        url: "procesos/obtenDatos.php",
        success: function(r) {
            datos = jQuery.parseJSON(r);
            $('#idjuego').val(datos['id_juego']);
            $('#nombreU').val(datos['nombre']);
            $('#anioU').val(datos['anio']);
            $('#empresaU').val(datos['empresa']);
        }
    });
}

function eliminarDatos(idAlumno) {
    alertify.confirm('Eliminar Alumno', '¿Seguro de eliminar este alumno?, este proceso no se puede deshacer',
        function() {

            $.ajax({
                type: "POST",
                data: "idAlumno=" + idAlumno,
                url: "procesos/eliminarA.php",
                success: function(r) {
                    if (r == 1) {
                        $('#tablaDatatable').load('tablas.tablaA.php');
                        alertify.success("Eliminado con exito !");
                    } else {
                        alertify.error("No se pudo eliminar");
                    }
                }
            });
        },
        function() {

        });
}
</script>

<?php include('clases/footer.php'); ?>