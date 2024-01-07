// application/libraries/Dompdf_lib.php

<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Dompdf_lib {
    protected $dompdf;

    public function __construct() {
        $this->dompdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $this->dompdf->setOptions($options);
    }

    public function generatePdf($html, $paperSize = 'A4', $orientation = 'portrait') {
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper($paperSize, $orientation);
        $this->dompdf->render();

        // Get the PDF content as a string
        $pdfContent = $this->dompdf->output();

        // Encode the PDF content as base64
        return base64_encode($pdfContent);
    }
}
