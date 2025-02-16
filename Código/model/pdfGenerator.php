<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require('../fpdf/fpdf.php');

class PDFGenerator
{
    private $pdf;
    private $font;

    public function __construct()
    {
        $this->pdf = new FPDF();

        // Agregar la fuente Noto Sans (asegurarse de haberla cargado correctamente)
        $this->pdf->AddFont('NotoSans', '', 'NotoSans-Regular.php');  // Agregar la fuente Noto Sans
        $this->font = 'NotoSans';  // Usar Noto Sans como fuente predeterminada
    }

    public function createPDF($data)
    {
        $this->pdf->AddPage();
        $this->pdf->SetMargins(10, 10, 10); // Márgenes mínimos de 5 mm
        $this->pdf->SetAutoPageBreak(true, 5); // Salto automático con margen inferior de 5 mm

        $this->pdf->SetFont($this->font, '', 12);  // Usar Noto Sans y tamaño 12

        // Imagen "Acuse" centrada en la parte superior
        $this->addCenteredImage('../assets/img/Acuse.png', 25);
        // Parte superior (primera mitad)
        $this->addHeaderAndContent($data, 'upper');
        // Línea divisoria punteada
        $this->addDottedLine();
        // Parte inferior (segunda mitad)
        $this->addHeaderAndContent($data, 'lower');
        // Generar PDF en memoria
        return $this->pdf->Output('S'); // Devuelve el contenido del PDF como una cadena
    }

    private function addHeaderAndContent($data, $position)
    {
        // Ajustar posición según la sección
        $yPosition = ($position === 'upper') ? 10 : 150;
        $this->pdf->SetY($yPosition);

        // Logo en la parte izquierda
        $this->pdf->Image('../assets/img/logo.png', 0, $this->pdf->GetY() + 5, 105);
        // Encabezado de la sección
        $this->pdf->SetFont($this->font, 'B', 18);
        $headerY = ($position === 'upper') ? 15 : 155;
        $this->pdf->SetXY(10, $headerY);
        $this->pdf->Cell(0, 10, utf8_decode('Correspondencia'), 0, 1, 'R');
        $this->pdf->SetX(70);
        $this->pdf->Cell(0, 10, utf8_decode('DIISE - 2025'), 0, 1, 'R');

        // Contenido dinámico
        $this->addDynamicContent($data);
    }

    private function addDynamicContent($data)
    {
        $this->pdf->SetFont($this->font, '', 10);

        // Primera fila
        $this->pdf->Ln(12);
        $this->addCellPair('Fecha:', $data['FECHA_CARGA'] ?? '', 12, 20, 'C');
        $this->addCellPair('Tipo:', $data['TIPO_FOLIO'] ?? '', 12, 35, 'C');
        $this->pdf->SetFont($this->font, '', 10);
        $this->pdf->Cell(25, 6, 'Folio COEES:', 0, 0, 'C'); // Primera celda (etiqueta)
        $this->pdf->SetFont($this->font, '', 10);
        $this->pdf->Cell(20, 6, !empty($data['ID_COEES']) ? $data['ID_COEES'] : 'N/A', 'B', 0, 'C');

        $this->pdf->Cell(36, 6, 'Folio DIISE:', 0, 0, 'C'); // Primera celda (etiqueta)
        $this->pdf->SetFont($this->font, '', 18);
        $this->pdf->Cell(30, 6, sprintf('%02d', $data['FOLIO_DIISE'] ?? ''), 'B', 0, 'C'); // Borde inferior más pegado, sin salto de línea
        $this->pdf->SetFont($this->font, '', 10);

        // Continúa el resto del contenido dinámico...
    }

    private function addCellPair($label, $value, $labelWidth, $valueWidth, $align = 'L', $fontSize = 10, $multiline = false, $lineStyle = '')
    {
        // Posicionamiento de la celda
        $currentX = $this->pdf->GetX();
        $currentY = $this->pdf->GetY();

        // Etiqueta (label)
        $this->pdf->SetFont($this->font, 'B', $fontSize);
        $this->pdf->Cell($labelWidth, 6, utf8_decode($label), 0, 0, 'L');

        // Celda de valor
        $this->pdf->SetFont($this->font, '', $fontSize);

        if ($multiline) {
            $this->pdf->MultiCell($valueWidth, 6, utf8_decode($value), 0, $align);
        } else {
            $this->pdf->Cell($valueWidth, 6, utf8_decode($value), 0, 0, $align);
        }

        // Dibujar la línea solo debajo del área del valor (no de la etiqueta)
        $this->addLine($currentX + $labelWidth, $currentY + 6, $currentX + $labelWidth + $valueWidth, $currentY + 6);
    }

    private function addLine($x1, $y1, $x2, $y2, $width = 0.05, $r = 120, $g = 120, $b = 120)
    {
        // Establece el ancho de la línea (más delgada)
        $this->pdf->SetLineWidth($width);

        // Define el color de la línea
        $this->pdf->SetDrawColor($r, $g, $b);

        // Dibuja la línea
        $this->pdf->Line($x1, $y1, $x2, $y2);
    }

    private function addDottedLine()
    {
        $x1 = 10;
        $x2 = 200;
        $y = 148;
        $dotLength = 2;
        $spaceLength = 2;

        for ($x = $x1; $x < $x2; $x += $dotLength + $spaceLength) {
            $this->pdf->SetXY($x, $y);
            $this->pdf->Cell($dotLength, 0, '.', 0, 0, 'C');
        }
    }

    private function addCenteredImage($imagePath, $width)
    {
        $this->pdf->Image($imagePath, 100, 33, $width);
    }
}
