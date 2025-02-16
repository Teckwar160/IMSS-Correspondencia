<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'conexion.php';

class Modelo
{
    private $conexion;

    public function __construct(mysqli $conexion)
    {
        $this->conexion = $conexion;
    }



    public function obtenerRegistros()
    {
        $query = "SELECT FOLIO_DIISE, ESTATUS_FOLIO, OBSERVACION_FOLIO, FECHA_CARGA, TIPO_FOLIO, EXPEDIENTE, LEGAJO, 
    CATEGORIA, TURNADO, COPIA_A, REQUIERE_RESPUESTA, OBSERVACION_RESPUESTA, FECHA_LIMITE_RESPUESTA, 
    FECHA_CONCLUSION_FOLIO, ID_COEES, FOLIOS_RELACIONADOS, FECHA_RECEPCION, FUENTE, TIPO, NUMERO, 
    AREA_REMITENTE, ASUNTO, FECHA_RESPUESTA_1, TIPO_RESPUESTA_1, NUMERO_RESPUESTA_1, FECHA_RESPUESTA_2, 
    TIPO_RESPUESTA_2, NUMERO_RESPUESTA_2, FECHA_RESPUESTA_3, TIPO_RESPUESTA_3, NUMERO_RESPUESTA_3, 
    FECHA_RESPUESTA_4, TIPO_RESPUESTA_4, NUMERO_RESPUESTA_4, FECHA_RESPUESTA_5, TIPO_RESPUESTA_5, 
    NUMERO_RESPUESTA_5, FECHA_RESPUESTA_6, TIPO_RESPUESTA_6, NUMERO_RESPUESTA_6 
    FROM " . TBLNAME;

        $result = $this->ejecutarConsulta($query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    private function ejecutarConsulta($query, $params = array())
    {
        $stmt = mysqli_prepare($this->conexion, $query);

        if ($stmt) {
            if (!empty($params)) {
                $types = str_repeat('s', count($params));
                mysqli_stmt_bind_param($stmt, $types, ...$params);
            }

            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (!$result) {
                throw new Exception('Consulta fallida: ' . mysqli_error($this->conexion));
            }
            mysqli_stmt_close($stmt);
            return $result;
        } else {
            throw new Exception('Error al preparar la consulta: ' . mysqli_error($this->conexion));
        }
    }
}
