<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <title>Registro de Usuario</title>

  <link rel="icon" type="image/png" href="img/icon_ipd.ico" />
  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

  <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="signin.css" rel="stylesheet">
</head>

<body>

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-4 d-none d-lg-flex justify-content-center">
            <img src="img/register.jpg" style="max-width: 100%; margin: auto;" alt="Imagen de formulario registro">
          </div>
          <div class="col-lg-8">
            <div class="p-4">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">CREAR CUENTA</h1>
              </div>
              <form id="form" action="procesos/guardar_user.php" class="needs-validation user" method="POST">
                <div class="form-group row">
                  <div class="col-md-6 col-sm-6 mb-2 mb-sm-0">
                    <label for="nombres">(*) Nombres</label>
                    <input type="text" style="text-transform: uppercase;" class="form-control form-control-user" id="nombres" name="nombres" required>
                    <div class="valid-feedback">Nombres correctos</div>
                    <div class="invalid-feedback">Colocar nombres completos!</div>
                  </div>
                  <div class="col-md-6 col-sm-6 mb-2 mb-sm-0">
                    <label for="ape_pat">(*) Apellido completos</label>
                    <input type="text" style="text-transform: uppercase;" class="form-control form-control-user" id="ape_pat" name="apellidos" required>
                  </div>
                  <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                    <label for="dni" id="nCuenta" style="display:block;">D.N.I.</label>
                    <input type="text" class="form-control form-control-user" id="dni" name="dni">
                  </div>

                  <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                    <label for="clave">(**) Contraseña (8 mínimo)</label>
                    <div class="input-group">
                      <input type="password" class="form-control" id="clave" name="clave" required="true" pattern="[A-Za-z0-9_-]{1,20}" required><span class="help-block"></span>
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="button" onclick="mostrarPassword()"><span class="fa fa-eye-slash icon"></span></button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                    <label for="confi_clave">(**) Confirmar contraseña</label>
                    <div class="input-group">
                      <input type="password" class="form-control" id="confi_clave" name="confi_clave" required pattern="[A-Za-z0-9_-]{1,20}" required><span class="help-block"></span>
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="button" onclick="mostrarPasswordRep()"><span class="fa fa-eye-slash iconRep"></span></button>
                      </div>
                    </div>
                    <label id="mensaje_error" class="control-label col-md-12 text-danger" style="display: block; font-weight:700;">Las constraseñas si coinciden</label>
                  </div>
                  <div class="col-md-12 col-sm-12 pt-2">
                    <h6 class="text-danger font-weight-bold">(**) La contraseña debe contener solo mayúsculas, letras y/o números, no debe usar simbolos como (*, ', -, +, ñ, etc)</h6>
                  </div>
                </div>
                <div class="row d-flex justify-content-center">
                  <div class="col-md-3 col-sm-12">
                    <button type="submit" class="btn btn-lg text-light" style="background-color: rgb(203, 47, 29);">Registrar</button>
                  </div>

                </div>

              </form>
              <hr>
              <div class=" text-center">
                <a class="font-weight-bolder" href="index.php"><i class="fas fa-sign-in-alt"></i> Ya tienes una cuenta? Ingresa!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/jquery.js"></script>


</body>

</html>