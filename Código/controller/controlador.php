<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../model/conexion.php';
require_once '../model/modelo.php';

class Controlador
{
    private $conexion;
    private $modelo;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
        $this->modelo = new Modelo($conexion);
    }

    public function __destruct()
    {
        $this->conexion->close();
    }

    public function manejarSolicitud($accion)
    {
        switch ($accion) {
            case 'mostrarRegistros':
            $this->mostrarRegistros();
            break;
            default:
                // Acción por defecto
            echo "Acción inválida.";
            break;
        }
    }

    private function mostrarRegistros()
    {
        $registros = $this->modelo->obtenerRegistros();
        if (empty($registros)) {
            echo "No se encontraron registros.";
            return;
        }

        echo json_encode($registros);
    }

    private function obtenerValorGET($parametro)
    {
        return isset($_GET[$parametro]) ? $_GET[$parametro] : null;
    }
}

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';
$controlador = new Controlador($conexion);
$controlador->manejarSolicitud($accion);
