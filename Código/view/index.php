<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php $titulo; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">


    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>

    <!-- Template Main CSS File -->
    <link href="../assets/css/styles.css" rel="stylesheet">
</head>

<body>

    <main id="mains" class="mains">
        <div class="card-body">
            <img src="../assets/img/imss.png" class="logo-left" alt="Logo izquierda">
            <img src="../assets/img/mj.png" class="logo-right" alt="Logo derecha">
            <div>
                <h2 class="text-center pb-0">CORRESPONDENCIA<br>
                    DIVISIÓN DE INTEGRACIÓN Y SEGUIMIENTO DE EQUIPAMIENTO</h2>

            </div>
        </div>
        <form class="row g-3" id="formulario_registro" enctype="multipart/form-data" method="post" style="margin-top: 10px;">

            <div class="row gx-4  my-2 flex-wrap">
                <div class="col d-flex align-items-center gap-2">
                    <h4>FOLIO DIISE</h4>
                    <input type="text" name="FOLIO_DIISE" id="FOLIO_DIISE" readonly
                        class="btn btn-outline-secondary btn-filtro m-0"
                        style="width: 40px; color: red; font-weight: bold;">
                </div>

                <div class="col d-flex align-items-center gap-2">
                    <h4>ESTATUS DE FOLIO</h4>
                    <select name="ESTATUS_FOLIO" id="ESTATUS_FOLIO"
                        class="btn btn-outline-secondary btn-filtro m-0"
                        style="width: 115px; text-transform: uppercase;">
                        <option value="">Seleccione...</option>
                    </select>
                </div>
                <div class="col d-flex align-items-center gap-2">
                    <h4>FECHA_CARGA</h4>
                    <input type="date" name="FECHA_CARGA" id="FECHA_CARGA"
                        class="btn btn-outline-secondary btn-filtro m-0">
                </div>
                <div class="col d-flex align-items-center gap-2">
                    <h4>TIPO_FOLIO</h4>
                    <select name="TIPO_FOLIO" id="TIPO_FOLIO" class="btn btn-outline-secondary btn-filtro m-0" style="width: 120px; text-transform: uppercase;">
                        <option value="">Seleccione...</option>
                    </select>
                </div>
                <div class="col d-flex align-items-center gap-2">
                    <h4>OBSERVACION FOLIO</h4>
                    <textarea name="OBSERVACION_FOLIO" id="OBSERVACION_FOLIO"
                        class="btn btn-outline-secondary btn-filtro m-0"
                        style="width: 500px; resize: none; height: 45px; text-transform: uppercase;"></textarea>
                </div>
            </div>

            <div class="row gx-4  my-2 flex-wrap">
                <div class="col d-flex align-items-center gap-2">
                    <h4>EXPEDIENTE</h4>
                    <select name="EXPEDIENTE" id="EXPEDIENTE" class="btn btn-outline-secondary btn-filtro m-0" style="width: 170px; text-transform: uppercase;">
                        <option value="">Seleccione...</option>
                    </select>
                </div>
                <div class="col d-flex align-items-center gap-2">
                    <h4>LEGAJO</h4>
                    <select name="LEGAJO" id="LEGAJO" class="btn btn-outline-secondary btn-filtro m-0" style="width: 170px; text-transform: uppercase;">
                        <option value="">Seleccione...</option>
                    </select>
                </div>
                <div class="col d-flex align-items-center gap-2">
                    <h4>CATEGORIA</h4>
                    <select name="CATEGORIA" id="CATEGORIA" class="btn btn-outline-secondary btn-filtro m-0" style="width: 300px; text-transform: uppercase;">
                    </select>
                </div>
                <div class="col d-flex align-items-center gap-2">
                    <h4>TURNADO</h4>
                    <select name="TURNADO" id="TURNADO" class="btn btn-outline-secondary btn-filtro m-0" style="width: 50px; text-transform: uppercase;">
                    </select>
                </div>
                <div class="col d-flex align-items-center gap-2">
                    <h4>REQUIERE_RESPUESTA</h4>
                    <select name="REQUIERE_RESPUESTA" id="REQUIERE_RESPUESTA" class="btn btn-outline-secondary btn-filtro m-0" style="width: 20px; text-transform: uppercase;">
                    </select>
                </div>
            </div>

            <div class="row gx-4  my-2 flex-wrap">
                <div class="col d-flex align-items-center gap-2">
                    <h4>COPIA_A</h4>
                    <select name="COPIA_A" id="COPIA_A" class="btn btn-outline-secondary btn-filtro m-0" style="width: 100px; text-transform: uppercase;">
                        <option value="">Seleccione...</option>
                    </select>
                </div>
                <div class="col d-flex align-items-center gap-2">
                    <h4>FECHA_LIMITE_RESPUESTA</h4>
                    <input type="date" name="FECHA_LIMITE_RESPUESTA" id="FECHA_LIMITE_RESPUESTA" class="btn btn-outline-secondary btn-filtro m-0">
                </div>
                <div class="col d-flex align-items-center gap-2">
                    <h4>OBSERVACION_RESPUESTA</h4>
                    <textarea name="OBSERVACION_RESPUESTA" id="OBSERVACION_RESPUESTA" class="btn btn-outline-secondary btn-filtro m-0" style="width: 630px; resize: none; height: 50px; text-transform: uppercase;"></textarea>
                </div>
            </div>

            <hr class="my-3" style="border-top: 4px solid #ccc;">

            <div class="row gx-4  my-2 flex-wrap">
                <div class="col d-flex align-items-center gap-2">
                    <h4>ID_COEES</h4>
                    <select name="ID_COEES" id="ID_COEES" class="btn btn-outline-secondary btn-filtro m-0" style="width: 40px; text-transform: uppercase;">
                        <option value="">Seleccione...</option>
                    </select>
                </div>
                <div class="col d-flex align-items-center gap-2">
                    <h4>FECHA_RECEPCION</h4>
                    <input type="date" name="FECHA_RECEPCION" id="FECHA_RECEPCION" class="btn btn-outline-secondary btn-filtro m-0">
                </div>
                <div class="col d-flex align-items-center gap-2">
                    <h4>FOLIOS_RELACIONADOS</h4>
                    <input type="text" name="FOLIOS_RELACIONADOS" id="FOLIOS_RELACIONADOS" class="btn btn-outline-secondary btn-filtro m-0" style="width: 300px; text-transform: uppercase;">
                </div>
                <div class="col d-flex align-items-center gap-2">
                    <h4>TIPO</h4>
                    <select name="TIPO" id="TIPO" class="btn btn-outline-secondary btn-filtro m-0" style="width: 115px; text-transform: uppercase;">
                    </select>
                </div>
                <div class="col d-flex align-items-center gap-2">
                    <h4>FUENTE</h4>
                    <select name="FUENTE" id="FUENTE" class="btn btn-outline-secondary btn-filtro m-0" style="width: 115px; text-transform: uppercase;">
                    </select>
                </div>
            </div>

            <div class="row gx-4  my-2 flex-wrap">
                <div class="col d-flex align-items-center gap-2">
                    <h4>NUMERO</h4>
                    <input type="text" name="NUMERO" id="NUMERO" class="btn btn-outline-secondary btn-filtro m-0" style="width: 100px; text-transform: uppercase;">
                </div>
                <div class="col d-flex align-items-center gap-2">
                    <h4>AREA_REMITENTE</h4>
                    <select name="AREA_REMITENTE" id="AREA_REMITENTE" class="btn btn-outline-secondary btn-filtro m-0" style="width: 100px; text-transform: uppercase;">
                    </select>
                </div>
                <div class="col d-flex align-items-center gap-2">
                    <h4>ASUNTO</h4>
                    <textarea name="ASUNTO" id="ASUNTO" class="btn btn-outline-secondary btn-filtro m-0" style="width: 700px; resize: none; height: 80px; text-transform: uppercase;"></textarea>
                </div>
            </div>

            <div class="row gx-4  my-2 flex-wrap align-items-center">
                <div class="col-md-6 col-lg-4 d-flex align-items-center gap-2">
                    <h4>FECHA_RESPUESTA_1</h4>
                    <input type="date" name="FECHA_RESPUESTA_1" id="FECHA_RESPUESTA_1" class="btn btn-outline-secondary btn-filtro m-0">
                </div>
                <div class="col-md-6 col-lg-4 d-flex align-items-center gap-2">
                    <h4>TIPO_RESPUESTA_1</h4>
                    <input type="text" name="TIPO_RESPUESTA_1" id="TIPO_RESPUESTA_1" class="btn btn-outline-secondary btn-filtro m-0" style="text-transform: uppercase;">
                </div>
                <div class="col-md-6 col-lg-4 d-flex align-items-center gap-2">
                    <h4>NUMERO_RESPUESTA_1</h4>
                    <input type="text" name="NUMERO_RESPUESTA_1" id="NUMERO_RESPUESTA_1" class="btn btn-outline-secondary btn-filtro m-0 w-100" style="text-transform: uppercase;">
                </div>
            </div>

            <div class="row gx-4  my-2 flex-wrap align-items-center">
                <div class="col-md-6 col-lg-4 d-flex align-items-center gap-2">
                    <h4>FECHA_RESPUESTA_2</h4>
                    <input type="date" name="FECHA_RESPUESTA_2" id="FECHA_RESPUESTA_2" class="btn btn-outline-secondary btn-filtro m-0">
                </div>
                <div class="col-md-6 col-lg-4 d-flex align-items-center gap-2">
                    <h4>TIPO_RESPUESTA_2</h4>
                    <input type="text" name="TIPO_RESPUESTA_2" id="TIPO_RESPUESTA_2" class="btn btn-outline-secondary btn-filtro m-0" style="text-transform: uppercase;">
                </div>
                <div class="col-md-6 col-lg-4 d-flex align-items-center gap-2">
                    <h4>NUMERO_RESPUESTA_2</h4>
                    <input type="text" name="NUMERO_RESPUESTA_2" id="NUMERO_RESPUESTA_2" class="btn btn-outline-secondary btn-filtro m-0 w-100" style="text-transform: uppercase;">
                </div>
            </div>

            <div class="row gx-4  my-2 flex-wrap align-items-center">
                <div class="col-md-6 col-lg-4 d-flex align-items-center gap-2">
                    <h4>FECHA_RESPUESTA_3</h4>
                    <input type="date" name="FECHA_RESPUESTA_3" id="FECHA_RESPUESTA_3" class="btn btn-outline-secondary btn-filtro m-0">
                </div>
                <div class="col-md-6 col-lg-4 d-flex align-items-center gap-2">
                    <h4>TIPO_RESPUESTA_3</h4>
                    <input type="text" name="TIPO_RESPUESTA_3" id="TIPO_RESPUESTA_3" class="btn btn-outline-secondary btn-filtro m-0" style="text-transform: uppercase;">
                </div>
                <div class="col-md-6 col-lg-4 d-flex align-items-center gap-2">
                    <h4>NUMERO_RESPUESTA_3</h4>
                    <input type="text" name="NUMERO_RESPUESTA_3" id="NUMERO_RESPUESTA_3" class="btn btn-outline-secondary btn-filtro m-0 w-100" style="text-transform: uppercase;">
                </div>
            </div>

            <div class="row gx-4  my-2 flex-wrap align-items-center">
                <div class="col-md-6 col-lg-4 d-flex align-items-center gap-2">
                    <h4>FECHA_RESPUESTA_4</h4>
                    <input type="date" name="FECHA_RESPUESTA_4" id="FECHA_RESPUESTA_4" class="btn btn-outline-secondary btn-filtro m-0">
                </div>
                <div class="col-md-6 col-lg-4 d-flex align-items-center gap-2">
                    <h4>TIPO_RESPUESTA_4</h4>
                    <input type="text" name="TIPO_RESPUESTA_4" id="TIPO_RESPUESTA_4" class="btn btn-outline-secondary btn-filtro m-0" style="text-transform: uppercase;">
                </div>
                <div class="col-md-6 col-lg-4 d-flex align-items-center gap-2">
                    <h4>NUMERO_RESPUESTA_4</h4>
                    <input type="text" name="NUMERO_RESPUESTA_4" id="NUMERO_RESPUESTA_4" class="btn btn-outline-secondary btn-filtro m-0 w-100" style="text-transform: uppercase;">
                </div>
            </div>

            <div class="row gx-4  my-2 flex-wrap align-items-center">
                <div class="col-md-6 col-lg-4 d-flex align-items-center gap-2">
                    <h4>FECHA_RESPUESTA_5</h4>
                    <input type="date" name="FECHA_RESPUESTA_5" id="FECHA_RESPUESTA_5" class="btn btn-outline-secondary btn-filtro m-0">
                </div>
                <div class="col-md-6 col-lg-4 d-flex align-items-center gap-2">
                    <h4>TIPO_RESPUESTA_5</h4>
                    <input type="text" name="TIPO_RESPUESTA_5" id="TIPO_RESPUESTA_5" class="btn btn-outline-secondary btn-filtro m-0" style="text-transform: uppercase;">
                </div>
                <div class="col-md-6 col-lg-4 d-flex align-items-center gap-2">
                    <h4>NUMERO_RESPUESTA_5</h4>
                    <input type="text" name="NUMERO_RESPUESTA_5" id="NUMERO_RESPUESTA_5" class="btn btn-outline-secondary btn-filtro m-0 w-100" style="text-transform: uppercase;">
                </div>
            </div>

            <div class="row gx-4  my-2 flex-wrap align-items-center">
                <div class="col-md-6 col-lg-4 d-flex align-items-center gap-2">
                    <h4>FECHA_RESPUESTA_6</h4>
                    <input type="date" name="FECHA_RESPUESTA_6" id="FECHA_RESPUESTA_6" class="btn btn-outline-secondary btn-filtro m-0">
                </div>
                <div class="col-md-6 col-lg-4 d-flex align-items-center gap-2">
                    <h4>TIPO_RESPUESTA_6</h4>
                    <input type="text" name="TIPO_RESPUESTA_6" id="TIPO_RESPUESTA_6" class="btn btn-outline-secondary btn-filtro m-0" style="text-transform: uppercase;">
                </div>
                <div class="col-md-6 col-lg-4 d-flex align-items-center gap-2">
                    <h4>NUMERO_RESPUESTA_6</h4>
                    <input type="text" name="NUMERO_RESPUESTA_6" id="NUMERO_RESPUESTA_6" class="btn btn-outline-secondary btn-filtro m-0 w-100" style="text-transform: uppercase;">
                </div>
            </div>

            <div class="row gx-4  my-2 flex-wrap align-items-center">
                <div class="col-md-6 col-lg-4 d-flex align-items-center gap-2">
                    <h4>FECHA_CONCLUSION_FOLIO</h4>
                    <input type="date" name="FECHA_CONCLUSION_FOLIO" id="FECHA_CONCLUSION_FOLIO" class="btn btn-outline-secondary btn-filtro m-0">
                </div>
            </div>

            <div class="row gy-2">
                <div class="row justify-content-center">
                    <!-- Botones de navegación -->
                    <div class="col-md-1 text-center">
                        <button type="button" id="inicio" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-skip-backward"></i>
                        </button>
                    </div>
                    <div class="col-md-1 text-center">
                        <button type="button" id="atras" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                    </div>

                    <!-- Botón Nuevo -->
                    <div class="col-md-1 text-center">
                        <button type="button" id="nuevo" class="btn btn-primary btn-sm w-100">Nuevo</button>
                    </div>

                    <!-- Botón Guardar -->
                    <div class="col-md-1 text-center">
                        <button type="button" id="registro" class="btn btn-primary btn-sm w-100" disabled>Guardar</button>
                    </div>

                    <!-- Botón Corregir -->
                    <div class="col-md-1 text-center">
                        <button type="button" id="corregir" class="btn btn-primary btn-sm w-100">Editar</button>
                    </div>

                    <!-- Botones de navegación hacia adelante -->
                    <div class="col-md-1 text-center">
                        <button type="button" id="adelante" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                    <div class="col-md-1 text-center">
                        <button type="button" id="final" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-skip-forward"></i>
                        </button>
                    </div>
                    <div class="col-md-1 text-center">
                        <button type="button" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-search" id="papeleta"></i>
                        </button>
                    </div>
                    <div class="col-md-1 text-center">
                        <button type="button" id="exportar_excel" class="btn btn-primary btn-sm">
                            <i class="fas fa-file-excel"></i>
                        </button>
                    </div>
                </div>
            </div>
            </div>
        </form>
    </main>
    <!-- Modal para mostrar el PDF -->
    <div class="modal fade" id="modalPDF" tabindex="-1" aria-labelledby="modalPDFLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPDFLabel">Vista Previa del Documento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfViewer" src="" width="100%" height="500px"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.js"></script>
    <script src="../assets/js/registrar.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</body>

</html>