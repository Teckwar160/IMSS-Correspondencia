<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once('../model/registroModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si la acción fue enviada
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    switch ($action) {
        case 'registroTicket':
            registroTicket();
            break;
        case 'actualizarTicket':
            actualizarTicket();
            break;
        case 'obtenerEstatus':
            obtenerEstatus();
            break;
        case 'obtenerExpedientes':
            obtenerExpedientes();
            break;
        case 'obtenerTipoFolio':
            obtenerTipoFolio();
            break;
        case 'obtenerCategorias':
            obtenerCategorias();
            break;
        case 'obtenerTurnados':
            obtenerTurnados();
            break;
        case 'obtenerRespuestas':
            obtenerRespuestas();
            break;
        case 'obtenerCopias':
            obtenerCopias();
            break;
        case 'obtenerTipos':
            obtenerTipos();
            break;
        case 'obtenerLegajos':
            obtenerLegajos();
            break;
        case 'obtenerFuentes':
            obtenerFuentes();
            break;
        case 'obtenerAreas':
            obtenerAreas();
            break;
        case 'exportarExcel':
            exportarExcel();
            break;
        case 'obtenerSiguienteFolio':
            obtenerSiguienteFolio();
            break;
        case 'generarPDF':
            generarPDF();
            break;
        case 'obtenerCoees':
            obtenerCoees();
            break;
        case 'obtenerDatosCoees':
            obtenerDatosCoees();
            break;
        default:
            echo json_encode(['error' => 'Acción no válida']);
            break;
    }
} else {
    echo json_encode(['error' => 'Método no permitido']);
}

function obtenerSiguienteFolio()
{
    $usuario = new registroModel();
    $siguienteFolio = $usuario->obtenerSiguienteFolio();
    echo json_encode(['siguienteFolio' => $siguienteFolio]);
}

function generarPDF()
{
    // Aquí se recogen los datos del formulario
    $data = $_POST;

    // Generar el PDF en memoria
    require_once('../model/pdfGenerator.php');
    $pdf = new PDFGenerator();
    $pdfContent = $pdf->createPDF($data);

    if ($pdfContent) {
        // Enviar el contenido del PDF al navegador codificado en Base64
        echo json_encode(['pdfData' => base64_encode($pdfContent)]);
    } else {
        echo json_encode(['error' => 'Error al generar el PDF.']);
    }
}


function generarPDFTodos()
{
    // Aquí se recogen los datos del formulario
    $data = exportarExcel();

    // Generar el PDF en memoria
    require_once('../model/pdfGenerator.php');
    $pdf = new PDFGenerator();
    $pdfContent = $pdf->createPDF($data);

    if ($pdfContent) {
        // Enviar el contenido del PDF al navegador codificado en Base64
        echo json_encode(['pdfData' => base64_encode($pdfContent)]);
    } else {
        echo json_encode(['error' => 'Error al generar el PDF.']);
    }
}


function registroTicket()
{
    $FOLIO_DIISE = $_POST['FOLIO_DIISE'];
    $ESTATUS_FOLIO = $_POST['ESTATUS_FOLIO'];
    $OBSERVACION_FOLIO = $_POST['OBSERVACION_FOLIO'];
    $FECHA_CARGA = $_POST['FECHA_CARGA'];
    $TIPO_FOLIO = $_POST['TIPO_FOLIO'];
    $EXPEDIENTE = $_POST['EXPEDIENTE'];
    $LEGAJO = $_POST['LEGAJO'];
    $CATEGORIA = $_POST['CATEGORIA'];
    $TURNADO = $_POST['TURNADO'];
    $COPIA_A = $_POST['COPIA_A'];
    $REQUIERE_RESPUESTA = $_POST['REQUIERE_RESPUESTA'];
    $OBSERVACION_RESPUESTA = $_POST['OBSERVACION_RESPUESTA'];
    $FECHA_LIMITE_RESPUESTA = $_POST['FECHA_LIMITE_RESPUESTA'];
    $FECHA_CONCLUSION_FOLIO = $_POST['FECHA_CONCLUSION_FOLIO'];
    $ID_COEES = str_replace('_2024', '', $_POST['ID_COEES']);
    $FOLIOS_RELACIONADOS = $_POST['FOLIOS_RELACIONADOS'];
    $FECHA_RECEPCION = $_POST['FECHA_RECEPCION'];
    $FUENTE = $_POST['FUENTE'];
    $TIPO = $_POST['TIPO'];
    $NUMERO = $_POST['NUMERO'];
    $AREA_REMITENTE = $_POST['AREA_REMITENTE'];
    $ASUNTO = $_POST['ASUNTO'];
    $FECHA_RESPUESTA_1 = $_POST['FECHA_RESPUESTA_1'];
    $TIPO_RESPUESTA_1 = $_POST['TIPO_RESPUESTA_1'];
    $NUMERO_RESPUESTA_1 = $_POST['NUMERO_RESPUESTA_1'];
    $FECHA_RESPUESTA_2 = $_POST['FECHA_RESPUESTA_2'];
    $TIPO_RESPUESTA_2 = $_POST['TIPO_RESPUESTA_2'];
    $NUMERO_RESPUESTA_2 = $_POST['NUMERO_RESPUESTA_2'];
    $FECHA_RESPUESTA_3 = $_POST['FECHA_RESPUESTA_3'];
    $TIPO_RESPUESTA_3 = $_POST['TIPO_RESPUESTA_3'];
    $NUMERO_RESPUESTA_3 = $_POST['NUMERO_RESPUESTA_3'];
    $FECHA_RESPUESTA_4 = $_POST['FECHA_RESPUESTA_4'];
    $TIPO_RESPUESTA_4 = $_POST['TIPO_RESPUESTA_4'];
    $NUMERO_RESPUESTA_4 = $_POST['NUMERO_RESPUESTA_4'];
    $FECHA_RESPUESTA_5 = $_POST['FECHA_RESPUESTA_5'];
    $TIPO_RESPUESTA_5 = $_POST['TIPO_RESPUESTA_5'];
    $NUMERO_RESPUESTA_5 = $_POST['NUMERO_RESPUESTA_5'];
    $FECHA_RESPUESTA_6 = $_POST['FECHA_RESPUESTA_6'];
    $TIPO_RESPUESTA_6 = $_POST['TIPO_RESPUESTA_6'];
    $NUMERO_RESPUESTA_6 = $_POST['NUMERO_RESPUESTA_6'];

    $usuario = new RegistroModel();

    $resultado = $usuario->registroTicket(
        $FOLIO_DIISE,
        $ESTATUS_FOLIO,
        $OBSERVACION_FOLIO,
        $FECHA_CARGA,
        $TIPO_FOLIO,
        $EXPEDIENTE,
        $LEGAJO,
        $CATEGORIA,
        $TURNADO,
        $REQUIERE_RESPUESTA,
        $OBSERVACION_RESPUESTA,
        $COPIA_A,
        $FECHA_LIMITE_RESPUESTA,
        $ID_COEES,
        $FECHA_RECEPCION,
        $FOLIOS_RELACIONADOS,
        $TIPO,
        $FUENTE,
        $NUMERO,
        $AREA_REMITENTE,
        $ASUNTO,
        $FECHA_RESPUESTA_1,
        $TIPO_RESPUESTA_1,
        $NUMERO_RESPUESTA_1,
        $FECHA_RESPUESTA_2,
        $TIPO_RESPUESTA_2,
        $NUMERO_RESPUESTA_2,
        $FECHA_RESPUESTA_3,
        $TIPO_RESPUESTA_3,
        $NUMERO_RESPUESTA_3,
        $FECHA_RESPUESTA_4,
        $TIPO_RESPUESTA_4,
        $NUMERO_RESPUESTA_4,
        $FECHA_RESPUESTA_5,
        $TIPO_RESPUESTA_5,
        $NUMERO_RESPUESTA_5,
        $FECHA_RESPUESTA_6,
        $TIPO_RESPUESTA_6,
        $NUMERO_RESPUESTA_6,
        $FECHA_CONCLUSION_FOLIO,
    );
}

function actualizarTicket()
{
    $FOLIO_DIISE = $_POST['FOLIO_DIISE']; // Identificador único
    $ESTATUS_FOLIO = $_POST['ESTATUS_FOLIO'];
    $OBSERVACION_FOLIO = $_POST['OBSERVACION_FOLIO'];
    $FECHA_CARGA = $_POST['FECHA_CARGA'];
    $TIPO_FOLIO = $_POST['TIPO_FOLIO'];
    $EXPEDIENTE = $_POST['EXPEDIENTE'];
    $LEGAJO = $_POST['LEGAJO'];
    $CATEGORIA = $_POST['CATEGORIA'];
    $TURNADO = $_POST['TURNADO'];
    $REQUIERE_RESPUESTA = $_POST['REQUIERE_RESPUESTA'];
    $OBSERVACION_RESPUESTA = $_POST['OBSERVACION_RESPUESTA'];
    $COPIA_A = $_POST['COPIA_A'];
    $FECHA_LIMITE_RESPUESTA = $_POST['FECHA_LIMITE_RESPUESTA'];
    $ID_COEES = str_replace('_2024', '', $_POST['ID_COEES']);
    $FECHA_RECEPCION = $_POST['FECHA_RECEPCION'];
    $FOLIOS_RELACIONADOS = $_POST['FOLIOS_RELACIONADOS'];
    $TIPO = $_POST['TIPO'];
    $FUENTE = $_POST['FUENTE'];
    $NUMERO = $_POST['NUMERO'];
    $AREA_REMITENTE = $_POST['AREA_REMITENTE'];
    $ASUNTO = $_POST['ASUNTO'];
    $FECHA_RESPUESTA_1 = $_POST['FECHA_RESPUESTA_1'];
    $TIPO_RESPUESTA_1 = $_POST['TIPO_RESPUESTA_1'];
    $NUMERO_RESPUESTA_1 = $_POST['NUMERO_RESPUESTA_1'];
    $FECHA_RESPUESTA_2 = $_POST['FECHA_RESPUESTA_2'];
    $TIPO_RESPUESTA_2 = $_POST['TIPO_RESPUESTA_2'];
    $NUMERO_RESPUESTA_2 = $_POST['NUMERO_RESPUESTA_2'];
    $FECHA_RESPUESTA_3 = $_POST['FECHA_RESPUESTA_3'];
    $TIPO_RESPUESTA_3 = $_POST['TIPO_RESPUESTA_3'];
    $NUMERO_RESPUESTA_3 = $_POST['NUMERO_RESPUESTA_3'];
    $FECHA_RESPUESTA_4 = $_POST['FECHA_RESPUESTA_4'];
    $TIPO_RESPUESTA_4 = $_POST['TIPO_RESPUESTA_4'];
    $NUMERO_RESPUESTA_4 = $_POST['NUMERO_RESPUESTA_4'];
    $FECHA_RESPUESTA_5 = $_POST['FECHA_RESPUESTA_5'];
    $TIPO_RESPUESTA_5 = $_POST['TIPO_RESPUESTA_5'];
    $NUMERO_RESPUESTA_5 = $_POST['NUMERO_RESPUESTA_5'];
    $FECHA_RESPUESTA_6 = $_POST['FECHA_RESPUESTA_6'];
    $TIPO_RESPUESTA_6 = $_POST['TIPO_RESPUESTA_6'];
    $NUMERO_RESPUESTA_6 = $_POST['NUMERO_RESPUESTA_6'];
    $FECHA_CONCLUSION_FOLIO = $_POST['FECHA_CONCLUSION_FOLIO'];
    $usuario = new registroModel();

    try {
        $resultado = $usuario->actualizarTicket($FOLIO_DIISE, $ESTATUS_FOLIO, $OBSERVACION_FOLIO, $FECHA_CARGA, $TIPO_FOLIO, $EXPEDIENTE, $LEGAJO, $CATEGORIA, $TURNADO, $REQUIERE_RESPUESTA, $OBSERVACION_RESPUESTA, $COPIA_A, $FECHA_LIMITE_RESPUESTA, $ID_COEES, $FECHA_RECEPCION, $FOLIOS_RELACIONADOS, $TIPO, $FUENTE, $NUMERO, $AREA_REMITENTE, $ASUNTO, $FECHA_RESPUESTA_1, $TIPO_RESPUESTA_1, $NUMERO_RESPUESTA_1, $FECHA_RESPUESTA_2, $TIPO_RESPUESTA_2, $NUMERO_RESPUESTA_2, $FECHA_RESPUESTA_3, $TIPO_RESPUESTA_3, $NUMERO_RESPUESTA_3, $FECHA_RESPUESTA_4, $TIPO_RESPUESTA_4, $NUMERO_RESPUESTA_4, $FECHA_RESPUESTA_5, $TIPO_RESPUESTA_5, $NUMERO_RESPUESTA_5, $FECHA_RESPUESTA_6, $TIPO_RESPUESTA_6, $NUMERO_RESPUESTA_6, $FECHA_CONCLUSION_FOLIO);
        echo json_encode(['success' => true, 'message' => 'Registro actualizado exitosamente']);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}


function obtenerEstatus()
{
    $registro = new RegistroModel();
    $estatus = $registro->obtenerEstatus();

    if ($estatus) {
        echo json_encode($estatus);
    } else {
        echo json_encode([]);
    }
}

function obtenerExpedientes()
{
    $registro = new RegistroModel();
    $expedientes = $registro->obtenerExpedientes();

    if ($expedientes) {
        echo json_encode($expedientes);
    } else {
        echo json_encode([]);
    }
}

function obtenerTipoFolio()
{
    $registro = new RegistroModel();
    $tipo_folio = $registro->obtenerTipoFolio();

    if ($tipo_folio) {
        echo json_encode($tipo_folio);
    } else {
        echo json_encode([]);
    }
}

function obtenerCategorias()
{
    $registro = new RegistroModel();
    $categorias = $registro->obtenerCategorias();

    if ($categorias) {
        echo json_encode($categorias);
    } else {
        echo json_encode([]);
    }
}

function obtenerTurnados()
{
    $registro = new RegistroModel();
    $turnados = $registro->obtenerTurnados();

    if ($turnados) {
        echo json_encode($turnados);
    } else {
        echo json_encode([]);
    }
}

function obtenerRespuestas()
{
    $registro = new RegistroModel();
    $respuestas = $registro->obtenerRespuestas();

    if ($respuestas) {
        echo json_encode($respuestas);
    } else {
        echo json_encode([]);
    }
}

function obtenerCopias()
{
    $registro = new RegistroModel();
    $copias = $registro->obtenerCopias();

    if ($copias) {
        echo json_encode($copias);
    } else {
        echo json_encode([]);
    }
}

function obtenerTipos()
{
    $registro = new RegistroModel();
    $tipos = $registro->obtenerTipos();

    if ($tipos) {
        echo json_encode($tipos);
    } else {
        echo json_encode([]);
    }
}

function obtenerLegajos()
{
    $registro = new RegistroModel();
    $legajos = $registro->obtenerLegajos();

    if ($legajos) {
        echo json_encode($legajos);
    } else {
        echo json_encode([]);
    }
}

function obtenerFuentes()
{
    $registro = new RegistroModel();
    $fuentes = $registro->obtenerFuentes();

    if ($fuentes) {
        echo json_encode($fuentes);
    } else {
        echo json_encode([]);
    }
}

function obtenerAreas()
{
    $registro = new RegistroModel();
    $areas = $registro->obtenerAreas();

    if ($areas) {
        echo json_encode($areas);
    } else {
        echo json_encode([]);
    }
}

function obtenerCoees()
{
    $registro = new RegistroModel();
    $coees = $registro->obtenerCoees();

    if ($coees) {
        echo json_encode($coees);
    } else {
        echo json_encode([]);
    }
}

function exportarExcel()
{
    $registro = new RegistroModel();
    $registros_excel = $registro->obtenerRegistros();
    if (!$registros_excel) {
        echo json_encode(['error' => 'No se encontraron registros.']);
        return;
    }
    echo json_encode($registros_excel);
}

function obtenerDatosCoees()
{
    $idCoees = isset($_POST['ID_COEES']) ? $_POST['ID_COEES'] : '';
    $registro = new RegistroModel();
    $datosCoees = $registro->obtenerDatosCoees($idCoees);

    if ($datosCoees) {
        echo json_encode($datosCoees);
    } else {
        echo json_encode(null);
    }
}
