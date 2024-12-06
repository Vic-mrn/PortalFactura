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
                        Tabla Padres
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
                    <form class="row g-3" id="FormAgregarP">
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

                        <div class="col-2">
                            <label class="form-label">Mes</label>
                            <select class="form-select" name="mes">
                                <option selected>Mes</option>
                                <?php
                                    // Iterar los resultados y crear las opciones del select
                                    if ($meses->num_rows > 0) {
                                        while ($row = $meses->fetch_assoc()) {
                                            echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
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
                                <option selected value="">Selecciona un estado</option>
                                <?php
                                // Iterar los resultados y crear las opciones del select
                                if ($meses->num_rows > 0) {
                                    while ($row = $estados->fetch_assoc()) {
                                        echo "<option value='" . $row['inicial'] . "'>" . $row['nombre'] . "</option>";
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
                        <hr> <!-- Datos fiscales -->
                        <label class="form-label">Datos fiscales</label>

                        <div class="col-4">
                            <label class="form-label">RFC</label>
                            <input type="text" class="form-control" name="rfc" placeholder="Ingresa tu RFC" />
                        </div>
                        
                        <div class="col-md-8">
                            <label class="form-label">Regimen fiscal</label>
                            <select class="form-select" name="regimen">
                                <option selected>Elige alguna opcion</option>
                                <option value="1">Sueldos y Salarios e Ingresos Asimilados a Salarios
                                </option>
                                <option value="2">Simplificado de Confianza</option>
                                <option value="3">Persona Física con Actividad Empresarial</option>
                            </select>
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
    $('#tablaDatatable').load('tablas/tablaP.php');

});
</script>

<!-- BOTONES -->
<script type="text/javascript">
$(document).ready(function() {
    $('#RegistrarP').click(function() {
        datos = $('#FormAgregarP').serialize();

        $.ajax({
            type: "POST",
            data: datos,
            url: "procesos/agregarP.php",
            success: function(r) {
                if (r == 1) {
                    $('#FormAgregarP')[0].reset();
                    $('#tablaDatatable').load('tablas/tablaP.php');
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

function eliminarDatos(idPadre) {
    alertify.confirm('Eliminar Padre', '¿Seguro de eliminar este alumno?, este proceso no se puede deshacer',
        function() {

            $.ajax({
                type: "POST",
                data: "idPadre=" + idPadre,
                url: "procesos/eliminarP.php",
                success: function(r) {
                    if (r == 1) {
                        $('#tablaDatatable').load('tablas/tablaP.php');
                        alertify.success("Eliminado con exito!");
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