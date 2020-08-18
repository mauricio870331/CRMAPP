<?php

date_default_timezone_set('America/Bogota');
require('fpdf.php');

//echo date("M d, Y");die;

class PDF extends FPDF {

// Cabecera de página
    function Header() {
//                     $file,                                 $x=null, $y=null, $w=0, $h=0, $type='', $link=''
        $this->Image('../PDFLibrary/images/greenlight.png', 15, 12, 45);
        $this->Image('../PDFLibrary/images/Texto.png', 150, 12, 45);
//        $this->SetFont('Arial', 'B', 15);
        $this->Ln(25);
    }

// Pie de página
    function Footer() {
        $this->Image('../PDFLibrary/images/greenlight.png', 170, 279, 25);
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 10);
        // Número de página
//        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        $this->Cell(0, 8, 'www.greenlightsadvisory.com', 0, 0, 'C');
    }

}

class AcuerdosDePagoClass {

  
    public $ss;  
    public $titular_cuenta;
    public $numero_cuenta;
    public $numero_ruta;
    public $pagos;
    public $banco;
    

    public function __construct() {
        
    }

    // Simple table
    function BasicTable($header, $data, $pdf, $x = 0, $y = 0) {
        // Header
        //$pdf->Cell(30, 7, $col, 1);
        $pdf->setDrawColor(214, 210, 210);
        $pdf->SetY($y);
        $pdf->SetX($x);
        $pdf->MultiCell(40, 7, $header[0], 1, "C");

        $pdf->SetY($y);
        $pdf->SetX($x + 40);
        $pdf->MultiCell(40, 7, $header[1], 1, "C");

//        $pdf->Ln();
        // Data
        $pdf->Cell(38);
        $currentRow = 0;
//        $w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link=''
        foreach ($data as $row) {
            foreach ($row as $col) {
                if ($currentRow == 0) {
                    $pdf->SetX($x);
                    $pdf->Cell(40, 8, $col, 1, 0, "C");
                } else {
                    $pdf->SetX($x + 40);
                    $pdf->Cell(40, 8, "" . $col, 1, 0, "C");
                }
                $currentRow++;
            }
            $currentRow = 0;
            $pdf->Ln();
        }
        $pdf->setDrawColor(0, 0, 0);

        //defaultConfigSignatureClient to 8 rowa
        //ConfigSignatureClient
        $lineG1 = 25;
        $lineG2 = 10;
        $y1y2 = 196;
        $totalrows = count($data);
        if ($totalrows <= 10) {
            for ($index = 1; $index < $totalrows; $index++) {
                $y1y2 += 8;
            }
        } else {

            if ($totalrows == 11) {
                $lineG1 = 20;
                $lineG2 = 10;
                $y1y2 = 271;
            }

            if ($totalrows == 12) {
                $lineG1 = 11;
                $lineG2 = 9;
                $y1y2 = 269;
            }


            if ($totalrows == 13 || $totalrows == 14) {
                for ($index1 = 0; $index1 < 5; $index1++) {
                    $pdf->Cell(0, 5, "", 0, 1);
                    $pdf->Ln();
                }
                $lineG1 = 10;
                $lineG2 = 9;
                $y1y2 = 88;
            }

            if ($totalrows == 15) {
                for ($index1 = 0; $index1 < 4; $index1++) {
                    $pdf->Cell(0, 5, "", 0, 1);
                    $pdf->Ln();
                }
                $lineG1 = 10;
                $lineG2 = 9;
                $y1y2 = 88;
            }


            if ($totalrows == 16) {
                for ($index1 = 0; $index1 < 3; $index1++) {
                    $pdf->Cell(0, 5, "", 0, 1);
                    $pdf->Ln();
                }
                $lineG1 = 10;
                $lineG2 = 9;
                $y1y2 = 88;
            }


            if ($totalrows == 17) {
                for ($index1 = 0; $index1 < 2; $index1++) {
                    $pdf->Cell(0, 5, "", 0, 1);
                    $pdf->Ln();
                }
                $lineG1 = 10;
                $lineG2 = 9;
                $y1y2 = 88;
            }


            if ($totalrows == 18) {
                for ($index1 = 0; $index1 < 1; $index1++) {
                    $pdf->Cell(0, 5, "", 0, 1);
                    $pdf->Ln();
                }
                $lineG1 = 10;
                $lineG2 = 9;
                $y1y2 = 88;
            }

            if ($totalrows == 19) {
                $pdf->Ln();
                $lineG1 = 10;
                $lineG2 = 9;
                $y1y2 = 94;
            }



            if ($totalrows == 20) {
                $pdf->Ln();
                $lineG1 = 10;
                $lineG2 = 9;
                $y1y2 = 102;
            }


            if ($totalrows > 20) {
                $y1y2 = 102;
                $pdf->Ln();
                $lineG1 = 10;
                $lineG2 = 9;
                for ($index1 = 20; $index1 < $totalrows; $index1++) {
                    $y1y2 += 8;
                }
            }
        }


        $pdf->Ln($lineG1);
        $pdf->SetFont('Times', '', 11);
        $pdf->Cell(10);
        $pdf->MultiCell(165, 5, utf8_decode("Bank name: " . $this->banco . "\n"
                        . "Account holder: " . $this->titular_cuenta . "\n"
                        . "Account number: " . $this->numero_cuenta . "\n"
                        . "Routing number: " . $this->numero_ruta), 0, "J");

        $pdf->Ln($lineG2);
        $pdf->Cell(10);
        $pdf->Cell(0, 5, "Client Signature:", 0, 1);
        $pdf->Line(50, $y1y2, 100, $y1y2);
        $pdf->Ln(4);
    }

    public function Generar() {
        try {
            $pdf = new PDF();
            $pdf->AliasNbPages();       
                  
            $pdf->AddPage();

            $pdf->SetFont('Times', '', 12);
            $pdf->Ln(5);
            $pdf->Cell(72);
            $pdf->Cell(0, 5, utf8_decode("INFORMACIÓN DE PAGOS"), 0, 1);


            $pdf->Cell(77);
            $pdf->SetFont('Times', 'I', 12);
            $pdf->Cell(0, 5, utf8_decode("(Payments information)"), 0, 1);
            $pdf->Ln(13);

            $pdf->SetFont('Times', '', 12);

            $pdf->Cell(10);
            $pdf->MultiCell(165, 5, utf8_decode("A continuación, encontrará relacionada la información correspondiente a"
                            . " los pagos electrónicos programados, que serán debitados de su cuenta según "
                            . "lo acordado telefónicamente por usted y su analista financiero:"), 0, "J");
            $pdf->Ln(5);

            $pdf->SetFont('Times', 'I', 12);
            $pdf->Cell(10);
            $pdf->MultiCell(165, 5, utf8_decode("(As follows you will find the information corresponding to "
                            . "the electronic payments that would be withdrawn from your account in accordance to "
                            . "the phone call that took place with you and your financial analyst.)"), 0, "J");
            $pdf->Ln(5);

            $pdf->SetFont('Times', '', 12);
            $header = array('Payment date (month/day/year)', 'Authorized Amount  (USD)');
//                            $header, $data, $pdf, $x = 0, $y =0
            $this->BasicTable($header, $this->pagos, $pdf, 62, 115);                     
           
          
            //F para guardar, I para mostrar
            $pdf->Output("F", "../../Documentos/" . $this->ss . "/AcuerdoDePagos_" . $this->ss . ".pdf");

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
