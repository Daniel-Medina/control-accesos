<?php

namespace App\Class;

use Fpdf\Fpdf;

class ConfigPDF extends Fpdf {
 
    public function Header()
    {
        $this->image(\asset('logo.png'), 10, 10, 10, 10);
        $this->SetFont('arial', '', 16);
        
        $this->Cell(14, 6, '', 0, 0);
        $this->Cell(182, 6, \env('APP_NAME'), 0, 1);
        
        $this->SetFont('arial', '', 12);
        $this->Cell(14, 5, '', 0, 0);
        $this->Cell(182, 5, "Historial de accesos", 0, 1);

        $this->Cell(196, 3, '', 'B', 1);

        $this->Ln(4);

    }

}