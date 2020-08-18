<?php

ini_set('display_errors', '0');
error_reporting(0);

require_once 'Docxphp/classes/CreateDocx.inc';

class CrearDocxClass {

    public $document;
    public $ss;
    public $id;
    public $cliente;
    public $direccion;
    public $razon;
    public $telefonos;
    public $dob;
    public $created_at;

    public function __construct() {
        $this->document = new CreateDocx();
    }

    public function Generar() {

        //Config Header
        $formatheader = array(
            'font' => 'Arial',
            'b' => "",
            'sz' => 12,
            'jc' => 'left',
            'textWrap' => 4
        );

        $paramsFooter = array(
            'pager' => 'false',
            'pagerAlignment' => 'left',
            'font' => 'Arial',
            'sz' => 12
        );

        $textHeader = "                                           "
                . "                                                            "
                . "    "
                . "" . $this->cliente . "                             "
                . "                            " . $this->created_at . "       "
                . $this->direccion;

        $textFooter = $this->cliente . "                                        "
                . "                             DOB: " . $this->dob . "                                        "
                . "                                        "
                . "       Phone: " . $this->telefonos;

        $midleText = "This letter is a formal complaint that you are reporting inaccurate credit information."
                . "I am very distressed that you have included the below information in my "
                . "credit profile due to its damaging effects on my good credit standing. As you are no "
                . "doubt aware, credit reporting laws ensure that bureaus report only accurate credit information."
                . " No doubt the inclusion of this inaccurate information is a mistake on either your or the re-porting "
                . "creditor's part. Because of the mistakes on my credit report,"
                . " I have been wrong-fully denied credit recently, which was highly "
                . "embarrassing and has negatively impact-ed my lifestyle.";

        $secondMidelText = "The following information therefore needs to be verified and deleted from the"
                . " report as soon as possible:";

        $this->document->addHeader("");
        $this->document->addHeader($textHeader, $formatheader);


        $this->document->addFooter($textFooter, $paramsFooter);
        $this->document->addFooter();

        // End config header

        $this->document->addBreak('line');

        $textConfig = array(
            'font' => 'Arial',
            'b' => "",
            'sz' => 12
        );

        $this->document->addText("EXPERIAN CREDIT SERVICES                      "
                . "    "
                . "                                        "
                . "P.O. BOX 2002"
                . "                                        "
                . "                                                "
                . "ALLEN, TX 75013", $textConfig);


        $this->document->addText("Dear Credit Bureau,", $textConfig);

        $textConfig = array(
            'font' => 'Arial',
            'b' => "",
            'sz' => 12,
            'jc' => 'both'
        );

        $this->document->addText($midleText, $textConfig);

        $this->document->addText($secondMidelText, $textConfig);

        $this->document->addBreak('line');

        $textConfig = array(
            'font' => 'Arial',
            'b' => "bold",
            'sz' => 12,
            'jc' => 'both'
        );
        $this->document->addText($this->razon, $textConfig);

        // end page 1
        // page 2
        $this->document->addBreak('page');

        $this->document->addBreak('line');

        $textConfig = array(
            'font' => 'Arial',
            'b' => "",
            'sz' => 12
        );

        $this->document->addText("EQUIFAX CREDIT INFORMATION SERVICES               "
                . "    "
                . "                                        "
                . "P.O. BOX 740241"
                . "                                      "
                . "                                                "
                . "ATLANTA, GA 30374", $textConfig);

        $this->document->addText("Dear Credit Bureau,", $textConfig);

        $textConfig = array(
            'font' => 'Arial',
            'b' => "",
            'sz' => 12,
            'jc' => 'both'
        );

        $this->document->addText($midleText, $textConfig);

        $this->document->addText($secondMidelText, $textConfig);

        $this->document->addBreak('line');

        $textConfig = array(
            'font' => 'Arial',
            'b' => "bold",
            'sz' => 12,
            'jc' => 'both'
        );
        $this->document->addText($this->razon, $textConfig);


        // page 3
        $this->document->addBreak('page');

        $this->document->addBreak('line');

        $textConfig = array(
            'font' => 'Arial',
            'b' => "",
            'sz' => 12
        );

        $this->document->addText("TRANSUNION CONSUMER RELATIONS               "
                . "    "
                . "                                        "
                . "P.O. BOX 2000"
                . "                                      "
                . "                                                "
                . "CHESTER, PA 19022-2000", $textConfig);

        $this->document->addText("Dear Credit Bureau,", $textConfig);

        $textConfig = array(
            'font' => 'Arial',
            'b' => "",
            'sz' => 12,
            'jc' => 'both'
        );

        $this->document->addText($midleText, $textConfig);

        $this->document->addText($secondMidelText, $textConfig);

        $this->document->addBreak('line');

        $textConfig = array(
            'font' => 'Arial',
            'b' => "bold",
            'sz' => 12,
            'jc' => 'both'
        );
        $this->document->addText($this->razon, $textConfig);


        $this->document->createDocx("../../Documentos/" . $this->ss . "/Disputa" . $this->id . "_" . $this->ss);
    }

}

?>