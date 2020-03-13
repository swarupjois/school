<?php 
require('fpdf.php');


class PDF extends Fpdf
{
    function Header()
    {
        $this->SetFont('Arial','',8);
        $this->Cell(120);
        $this->Cell(0,10,date("d-F-Y h:i A"),0,0,'L');
        $this->Ln(15);

    }
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,$this->PageNo(),0,0,'C');
    }
} 
	
	$pdf=new PDF();
	$pdf->AddPage('L','A4');
	$pdf->SetFont('Arial','B',15);
	$pdf->SetTextColor(100,100,150);
	$pdf->setFillColor(230,230,230); 
	$pdf->Cell(0,10,'Dentist Registration Summary',1,1,'C',1);
	$pdf->Cell(0,10,'',1,1,'C');
	$pdf->SetFont('Arial','B',12.5);
	$pdf->SetTextColor(0,0,0);
	$pdf->setFillColor(195,200,210); 
	$pdf->Cell(35,10,'NAME',1,0,'C',1);
	$pdf->Cell(20,10,'GENDER',1,0,'C',1);
	$pdf->Cell(60,10,'EMAIL',1,0,'C',1);
	$pdf->Cell(40,10,'PHNO',1,0,'C',1);
	$pdf->Cell(50,10,'QUALIFICATION',1,0,'C',1);
	$pdf->Cell(30,10,'EXPERIENCE',1,0,'C',1);
	$pdf->Cell(42,10,'CLINIC',1,1,'C',1);
	$pdf->SetFont('Arial','',12.5);
	
		?>
