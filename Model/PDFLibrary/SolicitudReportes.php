<?php

date_default_timezone_set('America/Bogota');
require('fpdf.php');

//echo date("M d, Y");die;

class PDF extends FPDF {

    public $name;
    public $ss;
    public $direccion;
    public $fecha_nacimiento;
    public $ciudad;

// Cabecera de página
    function Header() {
        $this->SetFont('Arial', '', 12);
        $this->SetTextColor(129, 128, 128);
        $this->Ln(8);
        $this->Cell(5); //Para espacio a la izquierda
        $this->Cell(175, 4, $this->name . "                      "
                . "                                              "
                . "" . date("d/m/Y"), 0, 1);
        $this->Ln(1);
        $this->Cell(5); //Para espacio a la izquierda
        $this->Cell(175, 4, $this->direccion, 0, 1);
        $this->Ln(1);
        $this->Cell(5); //Para espacio a la izquierda
        $this->Cell(175, 4, $this->ciudad, 0, 1);
    }

// Pie de página
    function Footer() {
        $this->SetFont('Arial', '', 12);
        $this->SetY(-55);
        $this->Ln(8);
        $this->Cell(5); //Para espacio a la izquierda
        $this->Cell(175, 5, "Full Legal Name: " . $this->name, 0, 1);
        $this->Ln(1);
        $this->Cell(5); //Para espacio a la izquierda
        $this->Cell(175, 5, "Previous address: " . $this->direccion, 0, 1);
        $this->Ln(1);
        $this->Cell(5); //Para espacio a la izquierda
        $this->Cell(175, 5, "Social Security: " . $this->ss, 0, 1);
        $this->Ln(1);
        $this->Cell(5); //Para espacio a la izquierda
        $this->Cell(175, 5, "Date of Birth: " . $this->fecha_nacimiento, 0, 1);
    }

}

class SolicitudReportes {

    public $name;
    public $ss;
    public $direccion;
    public $fecha_nacimiento;
    public $ciudad;

    public function __construct() {
        
    }

    public function Generar() {
        try {
            $pdf = new PDF();
            $pdf->name = $this->name;
            $pdf->ss = $this->ss;
            $pdf->direccion = $this->direccion;
            $pdf->fecha_nacimiento = $this->fecha_nacimiento;
            $pdf->ciudad = $this->ciudad;
            $pdf->AliasNbPages();
            $align_left = 7;


            $array_info = array(
                array("title" => "TRANS UNION CONSUMER RELATIONS",
                    "po" => "P.O. BOX 2000",
                    "ubicacion" => "CHESTER, PA 19022-2000"),
                array("title" => "EXPERIAN CREDIT SERVICES",
                    "po" => "P.O. BOX 2002 ALLEN, TX 75013",
                    "ubicacion" => ""),
                array("title" => "EQUIFAX CREDIT INFORMATION SERVICES",
                    "po" => "P.O. BOX 740241 ATLANTA, GA 30374",
                    "ubicacion" => "")
            );

            $pdf->SetTextColor(24, 24, 24);


            foreach ($array_info as $value) {
                $pdf->AddPage();

                $pdf->SetFont('Arial', '', 12);
                $pdf->Ln(18);
                $pdf->Cell($align_left); //Para espacio a la izquierda
                $pdf->Cell(175, 5, $value["title"], 0, 1);

                $pdf->Ln(4);
                $pdf->Cell($align_left);
                $pdf->Cell(0, 5, $value["po"], 0, 1);

                $pdf->Ln(4);
                $pdf->Cell($align_left);
                $pdf->Cell(0, 5, $value["ubicacion"], 0, 1);


                $pdf->Ln(13);
                $pdf->Cell($align_left);
                $pdf->Cell(0, 5, "RE: FREE CREDIT REPORT", 0, 1);

                $pdf->Ln(13);
                $pdf->Cell($align_left);
                $pdf->Cell(0, 5, "To whom it may concern,", 0, 1);


                $pdf->Ln(13);
                $pdf->Cell($align_left);
                $pdf->MultiCell(170, 5, utf8_decode("I would like to receive my free copy of my credit SCORE report."
                                . " The following personal information is provided below, along with my current address"
                                . " located above. I have also included a copy of my drivers license and my social"
                                . " security card (reflecting address above)."), 0, "J");



                $pdf->Ln(13);
                $pdf->Cell($align_left);
                $pdf->MultiCell(170, 5, utf8_decode("The Fair Credit Reporting Act,15USC section 1681g provides "
                                . "the credit bureau send me information which led to denying my credit application. "
                                . "According to the provisions of 15USC section 1681j, there should be no charge for "
                                . "this information."), 0, "J");

                $pdf->Ln(12);
                $pdf->Cell($align_left);
                $pdf->MultiCell(170, 5, utf8_decode("Please send me my credit report at the below address:"
                                . "\n\n"
                                . $this->direccion . ""
                                . "\n\n\n\n"
                                . "Here is my personal information: "), 0, "J");
            }

    
            //F para guardar, I para mostrar
            $pdf->Output("F", "../../Documentos/" . $this->ss . "/SolicitudReporte_" . $this->ss . ".pdf");

            $response['datalle'] = "Contrato enviado";
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
