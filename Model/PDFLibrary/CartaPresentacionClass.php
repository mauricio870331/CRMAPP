<?php

date_default_timezone_set('America/Bogota');
require('fpdf.php');

class PDF extends FPDF {

// Cabecera de página
    function Header() {
        $this->Image('../PDFLibrary/images/greenlight.png', 18, 20, 60);
        $this->Image('../PDFLibrary/images/Texto.png', 130, 20, 60);
        $this->SetFont('Arial', 'B', 15);
        $this->Ln(45);
    }

// Pie de página
    function Footer() {
        $this->Image('../PDFLibrary/images/greenlight.png', 170, 279, 30);
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 10);
        // Número de página
//        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        $this->Cell(0, 10, 'www.greenlightsadvisory.com', 0, 0, 'C');
    }

}

class CartaPresentacionClass {

    private $name;
    private $ss;
    private $texto = "Con este comunicado, Greenlight Advisory Service LLC quiere brindarle la información sobre los pasos a seguir para asesorarle de acuerdo con sus necesidades específicas, todo nuestro proceso de asesoramiento será estrictamente basado bajo la ley Federal existente para la regulación del crédito. Consumer Credit Protection Act (Ley de protección de crédito del consumidor) encargados de prevenir la discriminación en contra del consumidor a la hora de obtener un préstamo y regula el comportamiento de los Bureaus de Crédito (Equifax, Transunion y Experian). Estas son las entidades encargadas de reportar acreedores y agencias de colección de deudas en el historial de los ciudadanos y residentes de los Estados Unidos.";
    private $texto2 = "El proceso que se emprenderá consiste en verificar todas aquellas cuentas que tiene en su reporte para hacer las disputas directamente con los tres Bureaus de crédito sobre aquellas cuentas incorrectas o injustificadas, ya que según el Fair Credit Reportign Act. Todas las marcas negativas incorrectas o injustificadas deben ser corregidas o eliminadas. Y, todas aquellas deudas en colección que sean reales podrán ser negociadas previo acuerdo con las compañías colectoras para que reduzcan un alto porcentaje de su valor inicial, y usted pueda realizar sus pagos y eliminar los balances pendientes. Y así mejorar su puntaje crediticio.";

    public function __construct() {
        
    }

    public function getName() {
        return $this->name;
    }

    public function getSs() {
        return $this->ss;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function getTexto2() {
        return $this->texto2;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setSs($ss) {
        $this->ss = $ss;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

    public function setTexto2($texto2) {
        $this->texto2 = $texto2;
    }

    public function Generar() {
        try {

            $to = "Sr(a). " . $this->name;
            $pdf = new PDF();
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(10);
            $pdf->Cell(0, 10, date("d/m/Y"), 0, 1);
            $pdf->Ln(3);

            $pdf->Cell(10);
            $pdf->Cell(0, 10, $to, 0, 1);
            $pdf->Ln(5);
            $pdf->Cell(10);
            $pdf->MultiCell(170, 6, utf8_decode($this->texto), 0, "J");

            $pdf->Ln(5);
            $pdf->Cell(10);
            $pdf->Cell(0, 10, "Consumer Credit Protection Act", 0, 1);
            $pdf->Ln(5);

            $pdf->Cell(10);
            $pdf->Cell(0, 6, "Fair Credit Reporting Act", 0, 1);
            $pdf->Cell(10);
            $pdf->Cell(0, 6, "Fair Credit Billing Act", 0, 1);
            $pdf->Cell(10);
            $pdf->Cell(0, 6, "Fair Debt Collection Practices Act ", 0, 1);
            $pdf->Cell(10);
            $pdf->Cell(0, 6, "Equal Credit Opportunity Act", 0, 1);

            $pdf->Ln(8);
            $pdf->Cell(10);
            $pdf->MultiCell(170, 6, utf8_decode($this->texto2), 0, "J");

            $pdf->Ln(7);
            $pdf->Cell(10);
            $pdf->Cell(0, 6, "Cordialmente ", 0, 1);
            $pdf->Cell(10);
            $pdf->Cell(0, 6, "Customer Service Dept", 0, 1);
            $pdf->Cell(10);
            $pdf->Cell(0, 6, "GREENLIGHT ADVISORY SERVICE LLC.", 0, 1);
            $pdf->Output("F", "../../Documentos/" . $this->ss . "/Carta_" . $this->ss . ".pdf");

            $response['datalle'] = "Carta enviada";
            $response['token'] = base64_encode($this->ss);
            $response['msg'] = "success";
            return json_encode($response);
        } catch (Exception $exc) {
            $response['datalle'] = $exc->getTraceAsString();
            $response['msg'] = "error";
            return json_encode($response);
        }
    }

}

?>
