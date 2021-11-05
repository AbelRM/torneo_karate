<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <title>Solicitud Registro</title>

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
                <h1 class="h4 text-gray-900 mb-4">SOLICITAR REGISTRO</h1>
              </div>
              <form action="procesos/solicitar_regi.php" class="needs-validation user" method="POST">
                <div class="row g-3">
                  <div class="col-md-8 col-sm-12 mb-2 mb-sm-0">
                    <label for="nombres" class="form-label">(*) Nombres de la Liga o Club</label>
                    <input type="text" style="text-transform: uppercase;" class="form-control" name="nombres" required>
                    <div class="valid-feedback">Nombres correctos</div>
                    <div class="invalid-feedback">Colocar nombre completo!</div>
                  </div>
                  <div class="col-md-4 col-sm-6 mb-2 mb-sm-0">
                    <label for="region" class="form-label">(*) Región procedencia</label>
                    <input type="text" class="form-control" style="text-transform: uppercase;" name="region" required>
                  </div>
                  <div class="col-md-6 col-sm-12 mb-2 mb-sm-0">
                    <label for="delegado" class="form-label">(*) Nombre delegado</label>
                    <input type="text" style="text-transform: capitalize;" class="form-control" name="delegado" required>
                  </div>
                  <div class="col-md-6 col-sm-12 mb-2 mb-sm-0">
                    <label for="correo" class="form-label">(*) Correo electronico</label>
                    <input type="email" class="form-control" name="correo" required>
                  </div>
                  <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                    <label for="celular" class="form-label">(*) Nº Celular</label>
                    <input type="text" class="form-control" name="celular" required>
                  </div>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                  <button type="submit" class="btn btn-danger btn-lg">Solicitar</button>
                </div>

              </form>
              <hr>
              <div class="row">
                <p class="fw-bolder text-dark"><i class="fas fa-chevron-right"></i> Si ya hiciste tu registro revisa tu bandeja de tu correo y/o el Whatsapp de tu número registrado.</>
              </div>
              <div class="text-center">
                <a class="font-weight-bolder" href="index.php"><i class="fas fa-sign-in-alt"></i> Ya hiciste tu solicitud? Ingresa!</a>
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