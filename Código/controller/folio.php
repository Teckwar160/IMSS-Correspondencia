<?php
require_once '../model/conexion.php';

class FolioModel extends Conexion {
    public function getNextFolio() {
        parent::conectar();

        $query = "SELECT MAX(FOLIO_DIISE) AS max_folio FROM bd";
        $result = parent::query($query);

        $nextFolio = 1; // Valor inicial por defecto
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $maxFolio = intval($row['max_folio']);
            $nextFolio = $maxFolio + 1; // Incrementar en 1
        }

        parent::cerrar();
        return $nextFolio;
    }
}

// Respuesta al cliente
$model = new FolioModel();
$nextFolio = $model->getNextFolio();
echo json_encode(['folio' => $nextFolio]);
?>
