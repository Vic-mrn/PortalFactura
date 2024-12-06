<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>PHP CRUD MYSQL</title>
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <!-- BOOTSTRAP 5 -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    />
    <!-- BOOTSTRAP 5 (OFFLINE)-->
    <link rel="stylesheet" href="./css/bootstrap.css" />
    <script src="./js/jquery-3.6.0.js"></script>
    <script src="./js/bootstrap.js"></script>
  </head>
  <body>
    <section>
      <div class="container mt-5 pt-5">
        <div class="row">
          <div class="col-4 m-auto">
            <div class="card border-0 shadow">
              <div class="card-body">
                <form method="post">
                  <div class="text-center mt-3">
                    <img src="img/logo.svg" height="200 px" width="200 px" alt="">
                    <div class="display-6">Inicio de sesion</div>
                  </div>
                  <br />
                  <?php 
                    include("clases/conexion.php"); 
                    include("clases/inicioSesion.php"); 
                    ?>
                  <input class="form-control my-4 py-3" name="usuario" placeholder="Usuario"/>
                  <input type="password" class="form-control  my-4 py-3" name="contra" placeholder="Contraseña"/>
                  <div class="text-center">
                    <input class="btn btn-primary" name="btnIngresar" type="submit" value="Iniciar sesion">
                    </input>
                    <br>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
