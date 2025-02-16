<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Incluimos la clase conexion para poder heredar los metodos de ella.
require_once('conexion.php');

class registroModel extends Conexion
{

    public function registroTicket(
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
        $FECHA_CONCLUSION_FOLIO
    ) {
        parent::conectar();

        // Sanitizar y validar todas las variables en un array
        $datos = [
            'FOLIO_DIISE' => strtoupper(parent::filtrar($FOLIO_DIISE)),
            'ESTATUS_FOLIO' => strtoupper(parent::filtrar($ESTATUS_FOLIO)),
            'OBSERVACION_FOLIO' => strtoupper(parent::filtrar($OBSERVACION_FOLIO)),
            'FECHA_CARGA' => $this->validarFecha(parent::filtrar($FECHA_CARGA)),
            'TIPO_FOLIO' => strtoupper(parent::filtrar($TIPO_FOLIO)),
            'EXPEDIENTE' => strtoupper(parent::filtrar($EXPEDIENTE)),
            'LEGAJO' => strtoupper(parent::filtrar($LEGAJO)),
            'CATEGORIA' => strtoupper(parent::filtrar($CATEGORIA)),
            'TURNADO' => strtoupper(parent::filtrar($TURNADO)),
            'REQUIERE_RESPUESTA' => strtoupper(parent::filtrar($REQUIERE_RESPUESTA)),
            'OBSERVACION_RESPUESTA' => strtoupper(parent::filtrar($OBSERVACION_RESPUESTA)),
            'COPIA_A' => strtoupper(parent::filtrar($COPIA_A)),
            'FECHA_LIMITE_RESPUESTA' => $this->validarFecha(parent::filtrar($FECHA_LIMITE_RESPUESTA)),

            'ID_COEES' => strtoupper(parent::filtrar($ID_COEES)),
            'FECHA_RECEPCION' => $this->validarFecha(parent::filtrar($FECHA_RECEPCION)),
            'FOLIOS_RELACIONADOS' => strtoupper(parent::filtrar($FOLIOS_RELACIONADOS)),
            'TIPO' => strtoupper(parent::filtrar($TIPO)),
            'FUENTE' => strtoupper(parent::filtrar($FUENTE)),
            'NUMERO' => strtoupper(parent::filtrar($NUMERO)),
            'AREA_REMITENTE' => strtoupper(parent::filtrar($AREA_REMITENTE)),
            'ASUNTO' => strtoupper(parent::filtrar($ASUNTO)),

            // Sanitización de fechas y textos de respuestas
            'FECHA_RESPUESTA_1' => $this->validarFecha(parent::filtrar($FECHA_RESPUESTA_1)),
            'TIPO_RESPUESTA_1' => strtoupper(parent::filtrar($TIPO_RESPUESTA_1)),
            'NUMERO_RESPUESTA_1' => strtoupper(parent::filtrar($NUMERO_RESPUESTA_1)),
            'FECHA_RESPUESTA_2' => $this->validarFecha(parent::filtrar($FECHA_RESPUESTA_2)),
            'TIPO_RESPUESTA_2' => strtoupper(parent::filtrar($TIPO_RESPUESTA_2)),
            'NUMERO_RESPUESTA_2' => strtoupper(parent::filtrar($NUMERO_RESPUESTA_2)),
            'FECHA_RESPUESTA_3' => $this->validarFecha(parent::filtrar($FECHA_RESPUESTA_3)),
            'TIPO_RESPUESTA_3' => strtoupper(parent::filtrar($TIPO_RESPUESTA_3)),
            'NUMERO_RESPUESTA_3' => strtoupper(parent::filtrar($NUMERO_RESPUESTA_3)),
            'FECHA_RESPUESTA_4' => $this->validarFecha(parent::filtrar($FECHA_RESPUESTA_4)),
            'TIPO_RESPUESTA_4' => strtoupper(parent::filtrar($TIPO_RESPUESTA_4)),
            'NUMERO_RESPUESTA_4' => strtoupper(parent::filtrar($NUMERO_RESPUESTA_4)),
            'FECHA_RESPUESTA_5' => $this->validarFecha(parent::filtrar($FECHA_RESPUESTA_5)),
            'TIPO_RESPUESTA_5' => strtoupper(parent::filtrar($TIPO_RESPUESTA_5)),
            'NUMERO_RESPUESTA_5' => strtoupper(parent::filtrar($NUMERO_RESPUESTA_5)),
            'FECHA_RESPUESTA_6' => $this->validarFecha(parent::filtrar($FECHA_RESPUESTA_6)),
            'TIPO_RESPUESTA_6' => strtoupper(parent::filtrar($TIPO_RESPUESTA_6)),
            'NUMERO_RESPUESTA_6' => strtoupper(parent::filtrar($NUMERO_RESPUESTA_6)),
            'FECHA_CONCLUSION_FOLIO' => $this->validarFecha(parent::filtrar($FECHA_CONCLUSION_FOLIO)),
        ];

        // Crear consulta SQL dinámica
        $query = "
            INSERT INTO bd (
                FOLIO_DIISE, ESTATUS_FOLIO, OBSERVACION_FOLIO, FECHA_CARGA, TIPO_FOLIO, EXPEDIENTE, 
                LEGAJO, CATEGORIA, TURNADO, REQUIERE_RESPUESTA, OBSERVACION_RESPUESTA, COPIA_A, FECHA_LIMITE_RESPUESTA, 
                ID_COEES, FECHA_RECEPCION, FOLIOS_RELACIONADOS, TIPO, FUENTE,  NUMERO, AREA_REMITENTE, ASUNTO, 
                FECHA_RESPUESTA_1, TIPO_RESPUESTA_1, NUMERO_RESPUESTA_1, 
                FECHA_RESPUESTA_2, TIPO_RESPUESTA_2, NUMERO_RESPUESTA_2, 
                FECHA_RESPUESTA_3, TIPO_RESPUESTA_3, NUMERO_RESPUESTA_3, 
                FECHA_RESPUESTA_4, TIPO_RESPUESTA_4, NUMERO_RESPUESTA_4, 
                FECHA_RESPUESTA_5, TIPO_RESPUESTA_5, NUMERO_RESPUESTA_5, 
                FECHA_RESPUESTA_6, TIPO_RESPUESTA_6, NUMERO_RESPUESTA_6,
                FECHA_CONCLUSION_FOLIO
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Preparar y ejecutar consulta
        $stmt = parent::prepare($query);
        $stmt->bind_param(
            str_repeat('s', count($datos)), // Generar tipos dinámicamente
            ...array_values($datos) // Pasar los valores
        );
        $stmt->execute();

        parent::cerrar();
    }

    public function actualizarTicket($FOLIO_DIISE, $ESTATUS_FOLIO, $OBSERVACION_FOLIO, $FECHA_CARGA, $TIPO_FOLIO, $EXPEDIENTE, $LEGAJO, $CATEGORIA, $TURNADO, $REQUIERE_RESPUESTA, $OBSERVACION_RESPUESTA, $COPIA_A, $FECHA_LIMITE_RESPUESTA, $ID_COEES, $FECHA_RECEPCION, $FOLIOS_RELACIONADOS, $TIPO, $FUENTE, $NUMERO, $AREA_REMITENTE, $ASUNTO, $FECHA_RESPUESTA_1, $TIPO_RESPUESTA_1, $NUMERO_RESPUESTA_1, $FECHA_RESPUESTA_2, $TIPO_RESPUESTA_2, $NUMERO_RESPUESTA_2, $FECHA_RESPUESTA_3, $TIPO_RESPUESTA_3, $NUMERO_RESPUESTA_3, $FECHA_RESPUESTA_4, $TIPO_RESPUESTA_4, $NUMERO_RESPUESTA_4, $FECHA_RESPUESTA_5, $TIPO_RESPUESTA_5, $NUMERO_RESPUESTA_5, $FECHA_RESPUESTA_6, $TIPO_RESPUESTA_6, $NUMERO_RESPUESTA_6, $FECHA_CONCLUSION_FOLIO)
    {
        parent::conectar();

        $FOLIO_DIISE = parent::filtrar($FOLIO_DIISE);
        $ESTATUS_FOLIO = strtoupper(parent::filtrar($ESTATUS_FOLIO));
        $OBSERVACION_FOLIO = strtoupper(parent::filtrar($OBSERVACION_FOLIO));
        $FECHA_CARGA = $this->validarFecha(parent::filtrar($FECHA_CARGA));
        $TIPO_FOLIO = strtoupper(parent::filtrar($TIPO_FOLIO));
        $EXPEDIENTE  = strtoupper(parent::filtrar($EXPEDIENTE));
        $LEGAJO = strtoupper(parent::filtrar($LEGAJO));
        $CATEGORIA = strtoupper(parent::filtrar($CATEGORIA));
        $TURNADO = strtoupper(parent::filtrar($TURNADO));
        $REQUIERE_RESPUESTA  = strtoupper(parent::filtrar($REQUIERE_RESPUESTA));
        $OBSERVACION_RESPUESTA = strtoupper(parent::filtrar($OBSERVACION_RESPUESTA));
        $COPIA_A = strtoupper(parent::filtrar($COPIA_A));
        $FECHA_LIMITE_RESPUESTA = $this->validarFecha(parent::filtrar($FECHA_LIMITE_RESPUESTA));

        $ID_COEES = strtoupper(parent::filtrar($ID_COEES));
        $FECHA_RECEPCION = $this->validarFecha(parent::filtrar($FECHA_RECEPCION));
        $FOLIOS_RELACIONADOS  = strtoupper(parent::filtrar($FOLIOS_RELACIONADOS));
        $TIPO = strtoupper(parent::filtrar($TIPO));
        $FUENTE = strtoupper(parent::filtrar($FUENTE));
        $NUMERO = strtoupper(parent::filtrar($NUMERO));
        $AREA_REMITENTE  = strtoupper(parent::filtrar($AREA_REMITENTE));
        $ASUNTO = strtoupper(parent::filtrar($ASUNTO));
        $FECHA_RESPUESTA_1 = $this->validarFecha(parent::filtrar($FECHA_RESPUESTA_1));
        $TIPO_RESPUESTA_1 = strtoupper(parent::filtrar($TIPO_RESPUESTA_1));
        $NUMERO_RESPUESTA_1 = strtoupper(parent::filtrar($NUMERO_RESPUESTA_1));
        $FECHA_RESPUESTA_2  = $this->validarFecha(parent::filtrar($FECHA_RESPUESTA_2));
        $TIPO_RESPUESTA_2 = strtoupper(parent::filtrar($TIPO_RESPUESTA_2));
        $NUMERO_RESPUESTA_2 = strtoupper(parent::filtrar($NUMERO_RESPUESTA_2));
        $FECHA_RESPUESTA_3 = $this->validarFecha(parent::filtrar($FECHA_RESPUESTA_3));
        $TIPO_RESPUESTA_3 = strtoupper(parent::filtrar($TIPO_RESPUESTA_3));
        $NUMERO_RESPUESTA_3  = strtoupper(parent::filtrar($NUMERO_RESPUESTA_3));
        $FECHA_RESPUESTA_4 = $this->validarFecha(parent::filtrar($FECHA_RESPUESTA_4));
        $TIPO_RESPUESTA_4 = strtoupper(parent::filtrar($TIPO_RESPUESTA_4));
        $NUMERO_RESPUESTA_4 = strtoupper(parent::filtrar($NUMERO_RESPUESTA_4));
        $FECHA_RESPUESTA_5 = $this->validarFecha(parent::filtrar($FECHA_RESPUESTA_5));
        $TIPO_RESPUESTA_5  = strtoupper(parent::filtrar($TIPO_RESPUESTA_5));
        $NUMERO_RESPUESTA_5 = strtoupper(parent::filtrar($NUMERO_RESPUESTA_5));
        $FECHA_RESPUESTA_6 = $this->validarFecha(parent::filtrar($FECHA_RESPUESTA_6));
        $TIPO_RESPUESTA_6 = strtoupper(parent::filtrar($TIPO_RESPUESTA_6));
        $NUMERO_RESPUESTA_6 = strtoupper(parent::filtrar($NUMERO_RESPUESTA_6));
        $FECHA_CONCLUSION_FOLIO = $this->validarFecha(parent::filtrar($FECHA_CONCLUSION_FOLIO));

        $query = "UPDATE bd 
          SET ESTATUS_FOLIO = '$ESTATUS_FOLIO', OBSERVACION_FOLIO = '$OBSERVACION_FOLIO', FECHA_CARGA = " . ($FECHA_CARGA ? "'$FECHA_CARGA'" : "NULL") . ",
              TIPO_FOLIO = '$TIPO_FOLIO', EXPEDIENTE = '$EXPEDIENTE', LEGAJO = '$LEGAJO', CATEGORIA = '$CATEGORIA', TURNADO = '$TURNADO', 
              REQUIERE_RESPUESTA = '$REQUIERE_RESPUESTA', OBSERVACION_RESPUESTA = '$OBSERVACION_RESPUESTA', COPIA_A = '$COPIA_A', 
              FECHA_LIMITE_RESPUESTA = " . ($FECHA_LIMITE_RESPUESTA ? "'$FECHA_LIMITE_RESPUESTA'" : "NULL") . ",ID_COEES = '$ID_COEES', 
              FECHA_RECEPCION = " . ($FECHA_RECEPCION ? "'$FECHA_RECEPCION'" : "NULL") . ",FOLIOS_RELACIONADOS = '$FOLIOS_RELACIONADOS', 
              FUENTE = '$FUENTE', TIPO = '$TIPO', NUMERO = '$NUMERO', AREA_REMITENTE = '$AREA_REMITENTE', ASUNTO = '$ASUNTO', 
              FECHA_RESPUESTA_1 = " . ($FECHA_RESPUESTA_1 ? "'$FECHA_RESPUESTA_1'" : "NULL") . ",
              TIPO_RESPUESTA_1 = '$TIPO_RESPUESTA_1', NUMERO_RESPUESTA_1 = '$NUMERO_RESPUESTA_1', 
              FECHA_RESPUESTA_2 = " . ($FECHA_RESPUESTA_2 ? "'$FECHA_RESPUESTA_2'" : "NULL") . ",
              TIPO_RESPUESTA_2 = '$TIPO_RESPUESTA_2', NUMERO_RESPUESTA_2 = '$NUMERO_RESPUESTA_2', 
              FECHA_RESPUESTA_3 = " . ($FECHA_RESPUESTA_3 ? "'$FECHA_RESPUESTA_3'" : "NULL") . ",
              TIPO_RESPUESTA_3 = '$TIPO_RESPUESTA_3', NUMERO_RESPUESTA_3 = '$NUMERO_RESPUESTA_3', 
              FECHA_RESPUESTA_4 = " . ($FECHA_RESPUESTA_4 ? "'$FECHA_RESPUESTA_4'" : "NULL") . ",
              TIPO_RESPUESTA_4 = '$TIPO_RESPUESTA_4', NUMERO_RESPUESTA_4 = '$NUMERO_RESPUESTA_4', 
              FECHA_RESPUESTA_5 = " . ($FECHA_RESPUESTA_5 ? "'$FECHA_RESPUESTA_5'" : "NULL") . ",
              TIPO_RESPUESTA_5 = '$TIPO_RESPUESTA_5', NUMERO_RESPUESTA_5 = '$NUMERO_RESPUESTA_5', 
              FECHA_RESPUESTA_6 = " . ($FECHA_RESPUESTA_6 ? "'$FECHA_RESPUESTA_6'" : "NULL") . ",
              TIPO_RESPUESTA_6 = '$TIPO_RESPUESTA_6', NUMERO_RESPUESTA_6 = '$NUMERO_RESPUESTA_6', 
              FECHA_CONCLUSION_FOLIO = " . ($FECHA_CONCLUSION_FOLIO ? "'$FECHA_CONCLUSION_FOLIO'" : "NULL") . " 
          WHERE FOLIO_DIISE = '$FOLIO_DIISE'";

        $resultado = parent::query($query);
        parent::cerrar();

        if ($resultado) {
            return true;
        } else {
            throw new Exception("Error al actualizar el registro");
        }
    }


    public function obtenerEstatus()
    {
        parent::conectar();
        $query = "SELECT DISTINCT ESTATUS_FOLIO FROM bd";
        $result = parent::consultaArregloCompleto($query);
        parent::cerrar();
        return $result;
    }

    public function obtenerExpedientes()
    {
        parent::conectar();
        $query = "SELECT DISTINCT EXPEDIENTE FROM bd";
        $result = parent::consultaArregloCompleto($query);
        parent::cerrar();
        return $result;
    }

    public function obtenerTipoFolio()
    {
        parent::conectar();
        $query = "SELECT DISTINCT TIPO_FOLIO FROM bd";
        $result = parent::consultaArregloCompleto($query);
        parent::cerrar();
        return $result;
    }

    public function obtenerCategorias()
    {
        parent::conectar();
        $query = "SELECT DISTINCT CATEGORIA FROM bd";
        $result = parent::consultaArregloCompleto($query);
        parent::cerrar();
        return $result;
    }

    public function obtenerTurnados()
    {
        parent::conectar();
        $query = "SELECT DISTINCT TURNADO FROM bd";
        $result = parent::consultaArregloCompleto($query);
        parent::cerrar();
        return $result;
    }

    public function obtenerRespuestas()
    {
        parent::conectar();
        $query = "SELECT DISTINCT REQUIERE_RESPUESTA FROM bd";
        $result = parent::consultaArregloCompleto($query);
        parent::cerrar();
        return $result;
    }

    public function obtenerCopias()
    {
        parent::conectar();
        $query = "SELECT DISTINCT COPIA_A FROM bd";
        $result = parent::consultaArregloCompleto($query);
        parent::cerrar();
        return $result;
    }

    public function obtenerTipos()
    {
        parent::conectar();
        $query = "SELECT DISTINCT TIPO FROM bd";
        $result = parent::consultaArregloCompleto($query);
        parent::cerrar();
        return $result;
    }

    public function obtenerLegajos()
    {
        parent::conectar();
        $query = "SELECT DISTINCT LEGAJO FROM bd";
        $result = parent::consultaArregloCompleto($query);
        parent::cerrar();
        return $result;
    }

    public function obtenerFuentes()
    {
        parent::conectar();
        $query = "SELECT DISTINCT FUENTE FROM bd";
        $result = parent::consultaArregloCompleto($query);
        parent::cerrar();
        return $result;
    }

    public function obtenerAreas()
    {
        parent::conectar();
        $query = "SELECT DISTINCT AREA_REMITENTE FROM bd";
        $result = parent::consultaArregloCompleto($query);
        parent::cerrar();
        return $result;
    }

    public function obtenerCoees()
    {
        parent::conectar();
        $query = "SELECT DISTINCT ID_COEES FROM recibidos ORDER BY
        CASE
            WHEN ID_COEES REGEXP '^[0-9]+_[0-9]+$' THEN CAST(SUBSTRING_INDEX(ID_COEES, '_', 1) AS UNSIGNED) ELSE NULL
        END,
        CASE
            WHEN ID_COEES REGEXP '^[0-9]+_[0-9]+$' THEN CAST(SUBSTRING_INDEX(ID_COEES, '_', -1) AS UNSIGNED) ELSE NULL
        END,
        CASE
            WHEN ID_COEES REGEXP '^[0-9]+$' THEN CAST(ID_COEES AS UNSIGNED) ELSE NULL
        END;";

        $result = parent::consultaArregloCompleto($query);
        parent::cerrar();
        return $result;
    }

    public function obtenerRegistroPorIndice($indice)
    {
        parent::conectar();
        $query = "SELECT * FROM bd LIMIT 1 OFFSET $indice";
        $resultado = parent::consultaArreglo($query);
        parent::cerrar();
        return $resultado;
    }

    public function obtenerTotalRegistros()
    {
        parent::conectar();
        $query = "SELECT COUNT(*) AS total FROM bd";
        $resultado = parent::consultaArreglo($query);
        parent::cerrar();
        return $resultado['total'];
    }

    public function obtenerRegistros()
    {
        parent::conectar();
        $query = "SELECT * FROM bd"; // Reemplaza 'bd' con el nombre de tu tabla.
        $resultado = parent::consultaTodo($query); // Usa un método adecuado para obtener todos los resultados.
        parent::cerrar();
        return $resultado;
    }

    public function obtenerDatosCoees($idCoees)
    {
        parent::conectar();

        $idCoees = parent::filtrar($idCoees);
        $query = "SELECT FECHA_RECEPCION, FOLIOS_RELACIONADOS, TIPO, FUENTE, NUMERO, AREA_REMITENTE, ASUNTO, FECHA_RESP_1, TIPO_RESP_1, NUMERO_RESP_1, FECHA_RESP_2, TIPO_RESP_2, NUMERO_RESP_2, FECHA_RESP_3, TIPO_RESP_3, NUMERO_RESP_3, FECHA_RESP_4, TIPO_RESP_4, NUMERO_RESP_4, FECHA_RESP_5, TIPO_RESP_5, NUMERO_RESP_5, FECHA_RESP_6, TIPO_RESP_6, NUMERO_RESP_6 
              FROM recibidos 
              WHERE ID_COEES = '$idCoees'";

        $resultado = parent::consultaTodo($query);
        parent::cerrar();

        return count($resultado) > 0 ? $resultado[0] : null;
    }


    public function obtenerSiguienteFolio()
    {
        parent::conectar();

        // Consulta para obtener el último FOLIO_DIISE
        $result = parent::query("SELECT MAX(FOLIO_DIISE) AS ultimoFolio FROM bd");

        // Verificar si la consulta fue exitosa
        if ($result) {
            // Extraer el resultado como un array asociativo
            $row = $result->fetch_assoc();

            // Extraer el último folio y calcular el siguiente
            $ultimoFolio = isset($row['ultimoFolio']) ? (int)$row['ultimoFolio'] : 0; // Si no hay registros, asignar 0
            $siguienteFolio = $ultimoFolio + 1;

            parent::cerrar();
            return $siguienteFolio;
        } else {
            parent::cerrar();
            throw new Exception("Error al obtener el siguiente folio");
        }
    }

    // Método para validar fechas
    private function validarFecha($fecha)
    {
        return ($fecha === '' || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) ? null : $fecha;
    }
}
