<?php
session_start();
if (isset($_SESSION['id_user'])) {
  header('location: controller/redirec.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php $titulo; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/sweetalert/sweetalert.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-3">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo_imss.png" alt="">
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div>
                    <h5 class="card-title text-center pb-0 fs-5">Crear una Cuenta</h5>
                    <p class="text-center small">Ingrese sus datos para crear una nueva cuenta</p>
                  </div>

                  <form class="row g-3" id="formulario_registro" enctype="multipart/form-data">
                    <!-- Botón para subir imagen -->
                    <div class="col-12">
                      <label for="imagen_perfil" class="sr-only">Selecciona Foto de Perfil</label>
                      <div class="col-md-8 col-lg-9">
                        <img id="preview" src="#" alt="Profile" width="150" style="display: none; margin-top: 10px;">
                        <div class="pt-2">
                          <input type="file" id="imagen_perfil" name="imagen_perfil" accept="image/*" class="form-control-file" onchange="previewImage(event)" style="display:none;">
                          <a href="#" class="btn btn-primary btn-sm" onclick="document.getElementById('imagen_perfil').click();" title="Upload new profile image">
                            <i class="bi bi-upload"></i>
                          </a>
                          <a href="#" class="btn btn-danger btn-sm" onclick="removeImage();" title="Remove my profile image">
                            <i class="bi bi-trash"></i>
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="user" class="sr-only">Nombre Completo</label>
                      <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="ri-user-3-fill"></i></span>
                        <input type="text" name="nombre" class="form-control">
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="user" class="sr-only">Correo (@imssbienestar.gob.mx)</label>
                      <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="ri-mail-fill"></i></span>
                        <input type="text" name="correo" class="form-control">
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="telefono" class="sr-only">Teléfono</label>
                      <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="ri-phone-fill"></i></span>
                        <input type="tel" id="telefono" name="telefono" class="form-control" pattern="\d{10}" maxlength="10" required placeholder="1234567890">
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="user" class="sr-only">Usuario</label>
                      <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="ri-user-3-fill"></i></span>
                        <input type="text" class="form-control" name="nombre_usuario">
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="contrasenia" class="sr-only">Contraseña</label>
                      <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="ri-lock-fill"></i></span>
                        <input type="password" autocomplete="off" name="contrasenia" class="form-control">
                      </div>
                    </div>

                    <div class="col-12">
                      <label class="sr-only" for="contrasenia">Verificar contraseña</label>
                      <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="ri-lock-fill"></i></span>
                        <input type="password" autocomplete="off" class="form-control" name="contrasenia2">
                      </div>
                    </div>

                    <div class="col-12" id="load" hidden="hidden">
                      <div class="col-xs-4 col-xs-offset-4 col-md-2 col-md-offset-5">
                        <img src="assets/img/load.gif" width="100%" alt="">
                      </div>
                      <div class="col-xs-12 center text-accent">
                        <span>Validando información...</span>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="col-xs-8 col-xs-offset-2">
                        <div class="spacing-2"></div>
                        <button type="button" class="btn btn-primary btn-block w-100" name="button" id="registro">Crear cuenta</button>
                      </div>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Ya tienes cuenta? <a href="index.php">Acceso</a></p>
                    </div>
                  </form>
                </div>
              </div>

              <div class="credits">


              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/jquery/jquery.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/vendor/sweetalert/sweetalert.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/login.js"></script>
</body>

</html>