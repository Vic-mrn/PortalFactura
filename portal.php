<?php include('clases/header.php'); ?>

<div class="container rounded-shadow ">
    <div class="row">
        <div class="col-4 py-1">
            <div class="container rounded-shadow text-center">
                <img src="img/estudiante.png" height="150 px" width="150 px" alt="">
                <h2>Alumnos</h2>
                <p>Gestiona los alumnos registrados</p>
                <a href="Alumnos.php">
                    <input type="submit" class="btn btn-primary" value="Ir a alumnos" />
                </a>
            </div>
        </div>
        <div class="col-4 py-1">
            <div class="container rounded-shadow text-center">
                <img src="img/padre.png" height="150 px" width="150 px" alt="">
                <h2>Padres</h2>
                <p>Gestiona los padres registrados</p>
                <a href="MenuP.php">
                    <input type="submit" class="btn btn-primary" value="Ir a padres" />
                </a>
            </div>
        </div>
        <div class="col-4 py-1">
            <div class="container rounded-shadow text-center">
                <img src="img/factura.png" height="150 px" width="150 px" alt="">
                <h2>Facturas</h2>
                <p>Genera facturas a partir de los padres y alumnos registrados</p>
                <a href="">
                    <input type="submit" class="btn btn-primary" value="Ir a facturas" />
                </a>
            </div>
        </div>
    </div>
</div>

<?php include('clases/footer.php'); ?>