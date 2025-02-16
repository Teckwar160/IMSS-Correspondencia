<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once('../model/registroModel.php');

$accion = $_POST['accion'];
$indice = isset($_POST['indice']) ? (int) $_POST['indice'] : 0;

$model = new registroModel();

switch ($accion) {
    case 'obtenerRegistro':
        $datos = $model->obtenerRegistroPorIndice($indice);
        echo json_encode($datos);
        break;

    case 'totalRegistros':
        $total = $model->obtenerTotalRegistros();
        echo json_encode(['total' => $total]);
        break;

    default:
        echo json_encode(['error' => 'Acción no válida']);
}
