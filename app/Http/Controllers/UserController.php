<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Class\ConfigPDF as Fpdf;
use App\Models\Register;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    public function __invoke()
    {
        //
        return \view('users.index');
    }

    public function generatePDF(Request $request, User $user)
    {
        
        header('Content-type: application/pdf');
        $pdf = new Fpdf('P', 'mm', 'letter');
        $pdf->AddPage();

        // Nombre del usuario
        $pdf->SetFont('Arial','B', 16);
        $pdf->Cell(0, 6, 'Registro de asistencias de: ' . \iconv('utf-8', 'cp1252', $user->name . ' ' . $user->lastname), 0, 1);
        
        // Rango de fechas
        $pdf->SetFont('arial', '', 12);
        $pdf->Cell(0, 8, 'Del '.  Carbon::parse(Register::orderBy('input')->where('user_id', $user->id)->first()->input)->format('d-M-Y') . ' al '. Carbon::parse(Register::orderBy('input')->where('user_id', $user->id)->get()->last()->input)->format('d-M-Y'), 0, 1);

        // Espacio en blanco
        $pdf->Cell(0, 6, '', 0, 1);

        // Mostrar la lista de accesos
        $pdf->SetFont('arial', 'B', 12);
        $pdf->Cell(66, 6, 'Fecha', 1, 0);
        $pdf->Cell(65, 6, 'Entrada', 1, 0);
        $pdf->Cell(65, 6, 'Salida', 1, 1);
        
        $pdf->SetFont('arial', '', 12);
        foreach ($user->registers as  $register) {
            $pdf->Cell(66, 6, Carbon::parse($register->input)->format('d-M-Y'), 1, 0);
            $pdf->Cell(65, 6, Carbon::parse($register->input)->format('h:i.s a'), 1, 0);
            $pdf->Cell(65, 6, $register->output == null ? 'No se ha asignado' : Carbon::parse($register->output)->format('h:i.s a'), 1, 1);
        }        

        $pdf->Output('example2.pdf', 'I', true);
        exit;
    }

}
