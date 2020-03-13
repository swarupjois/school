<?php 
require_once('fpdf17/fpdf.php');
date_default_timezone_set("Asia/Calcutta");
$con = mysql_connect("localhost","root");
mysql_select_db("rvdental", $con);

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
$P_GENDER=$_POST['D_GENDER'];
$clinic=$_POST['clinic'];
if( $P_GENDER == 'All' && $clinic == 'All')
{
	
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
	
	$sql = mysql_query("select * from dentist where vaild='valid' ORDER BY D_NAME ASC");
	$res=mysql_num_rows($sql);
	if($res != 0)
	{
	while($rows=mysql_fetch_array($sql))
	{
		$pdf->Cell(35,10,$rows['D_NAME'],1,0,'C');
		$pdf->Cell(20,10,$rows['D_GENDER'],1,0,'C');
		$pdf->Cell(60,10,$rows['D_EMAIL'],1,0,'C');
		$pdf->Cell(40,10,$rows['D_PHNO'],1,0,'C');		
		$pdf->Cell(50,10,$rows['Qualification'],1,0,'C');
		$pdf->Cell(30,10,$rows['Experience'],1,0,'C');
		$pdf->Cell(42,10,$rows['clinic'],1,1,'C');	
	}
	$pdf->Cell(0,10,'TOTAL NUMBER OF DENTISTS REGISTERED : '.$res.'',1,1,'C',1);
	$pdf->Output();
	}
	else{
		echo '<script type="text/javascript">alert("No Records Found");window.location=\'Summary_d.php\';</script>';
	}
}
else if( $P_GENDER == 'All' && $clinic == 'Vijayanagar')
{
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
	$sql = mysql_query("select * from dentist where vaild='valid' AND clinic='Vijayanagar' ORDER BY D_NAME ASC");
	$res=mysql_num_rows($sql);
	if($res != 0)
	{
	while($rows=mysql_fetch_array($sql))
	{
		$pdf->Cell(35,10,$rows['D_NAME'],1,0,'C');
		$pdf->Cell(20,10,$rows['D_GENDER'],1,0,'C');
		$pdf->Cell(60,10,$rows['D_EMAIL'],1,0,'C');
		$pdf->Cell(40,10,$rows['D_PHNO'],1,0,'C');		
		$pdf->Cell(50,10,$rows['Qualification'],1,0,'C');
		$pdf->Cell(30,10,$rows['Experience'],1,0,'C');
		$pdf->Cell(42,10,$rows['clinic'],1,1,'C');			
	}
	$pdf->Cell(0,10,'TOTAL NUMBER OF DENTISTS REGISTERED IN VIJAYANAGAR : '.$res.'',1,1,'C',1);
	$pdf->Output();
	}
	else{
		echo '<script type="text/javascript">alert("No Records Found");window.location=\'Summary_d.php\';</script>';
	}
}
else if( $P_GENDER == 'All' && $clinic == 'HSR_Layout')
{
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
	$sql = mysql_query("select * from dentist where vaild='valid' AND clinic='HSR_Layout' ORDER BY D_NAME ASC");
	$res=mysql_num_rows($sql);
	if($res != 0)
	{
	while($rows=mysql_fetch_array($sql))
	{
		$pdf->Cell(35,10,$rows['D_NAME'],1,0,'C');
		$pdf->Cell(20,10,$rows['D_GENDER'],1,0,'C');
		$pdf->Cell(60,10,$rows['D_EMAIL'],1,0,'C');
		$pdf->Cell(40,10,$rows['D_PHNO'],1,0,'C');		
		$pdf->Cell(50,10,$rows['Qualification'],1,0,'C');
		$pdf->Cell(30,10,$rows['Experience'],1,0,'C');
		$pdf->Cell(42,10,$rows['clinic'],1,1,'C');			
	}
	$pdf->Cell(0,10,'TOTAL NUMBER OF DENTISTS REGISTERED IN HSR LAYOUT : '.$res.'',1,1,'C',1);
	$pdf->Output();
	}
	else{
		echo '<script type="text/javascript">alert("No Records Found");window.location=\'Summary_d.php\';</script>';
	}
}
else if( $P_GENDER == 'Male' && $clinic == 'HSR_Layout')
{
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
	$sql = mysql_query("select * from dentist where vaild='valid' AND D_GENDER='Male' AND clinic='HSR_Layout' ORDER BY D_NAME ASC");
	$res=mysql_num_rows($sql);
	if($res != 0)
	{
	while($rows=mysql_fetch_array($sql))
	{
		$pdf->Cell(35,10,$rows['D_NAME'],1,0,'C');
		$pdf->Cell(20,10,$rows['D_GENDER'],1,0,'C');
		$pdf->Cell(60,10,$rows['D_EMAIL'],1,0,'C');
		$pdf->Cell(40,10,$rows['D_PHNO'],1,0,'C');		
		$pdf->Cell(50,10,$rows['Qualification'],1,0,'C');
		$pdf->Cell(30,10,$rows['Experience'],1,0,'C');
		$pdf->Cell(42,10,$rows['clinic'],1,1,'C');			
	}
	$pdf->Cell(0,10,'TOTAL NUMBER OF MALE DENTISTS REGISTERED IN HSR LAYOUT : '.$res.'',1,1,'C',1);
	$pdf->Output();
	}
	else{
		echo '<script type="text/javascript">alert("No Records Found");window.location=\'Summary_d.php\';</script>';
	}
}
else if( $P_GENDER == 'Female' && $clinic == 'HSR_Layout')
{
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
	$sql = mysql_query("select * from dentist where vaild='valid' AND D_GENDER='Female' AND clinic='HSR_Layout' ORDER BY D_NAME ASC");
	$res=mysql_num_rows($sql);
	if($res != 0)
	{
	while($rows=mysql_fetch_array($sql))
	{
		$pdf->Cell(35,10,$rows['D_NAME'],1,0,'C');
		$pdf->Cell(20,10,$rows['D_GENDER'],1,0,'C');
		$pdf->Cell(60,10,$rows['D_EMAIL'],1,0,'C');
		$pdf->Cell(40,10,$rows['D_PHNO'],1,0,'C');		
		$pdf->Cell(50,10,$rows['Qualification'],1,0,'C');
		$pdf->Cell(30,10,$rows['Experience'],1,0,'C');
		$pdf->Cell(42,10,$rows['clinic'],1,1,'C');			
	}
	$pdf->Cell(0,10,'TOTAL NUMBER OF FEMALE DENTISTS REGISTERED IN HSR LAYOUT : '.$res.'',1,1,'C',1);
	$pdf->Output();
	}
	else{
		echo '<script type="text/javascript">alert("No Records Found");window.location=\'Summary_d.php\';</script>';
	}
}
else if( $P_GENDER == 'Female' && $clinic == 'Vijayanagar')
{
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
	$sql = mysql_query("select * from dentist where vaild='valid' AND D_GENDER='Female' AND clinic='Vijayanagar' ORDER BY D_NAME ASC");
	$res=mysql_num_rows($sql);
	if($res != 0)
	{
	while($rows=mysql_fetch_array($sql))
	{
		$pdf->Cell(35,10,$rows['D_NAME'],1,0,'C');
		$pdf->Cell(20,10,$rows['D_GENDER'],1,0,'C');
		$pdf->Cell(60,10,$rows['D_EMAIL'],1,0,'C');
		$pdf->Cell(40,10,$rows['D_PHNO'],1,0,'C');		
		$pdf->Cell(50,10,$rows['Qualification'],1,0,'C');
		$pdf->Cell(30,10,$rows['Experience'],1,0,'C');
		$pdf->Cell(42,10,$rows['clinic'],1,1,'C');			
	}
	$pdf->Cell(0,10,'TOTAL NUMBER OF FEMALE DENTISTS REGISTERED IN VIJAYANAGAR : '.$res.'',1,1,'C',1);
	$pdf->Output();
	}
	else{
		echo '<script type="text/javascript">alert("No Records Found");window.location=\'Summary_d.php\';</script>';
	}
}
else if( $P_GENDER == 'Male' && $clinic == 'Vijayanagar')
{
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
	$sql = mysql_query("select * from dentist where vaild='valid' AND D_GENDER='Male' AND clinic='Vijayanagar' ORDER BY D_NAME ASC");
	$res=mysql_num_rows($sql);
	if($res != 0)
	{
	while($rows=mysql_fetch_array($sql))
	{
		$pdf->Cell(35,10,$rows['D_NAME'],1,0,'C');
		$pdf->Cell(20,10,$rows['D_GENDER'],1,0,'C');
		$pdf->Cell(60,10,$rows['D_EMAIL'],1,0,'C');
		$pdf->Cell(40,10,$rows['D_PHNO'],1,0,'C');		
		$pdf->Cell(50,10,$rows['Qualification'],1,0,'C');
		$pdf->Cell(30,10,$rows['Experience'],1,0,'C');
		$pdf->Cell(42,10,$rows['clinic'],1,1,'C');			
	}
	$pdf->Cell(0,10,'TOTAL NUMBER OF MALE DENTISTS REGISTERED IN VIJAYANAGAR : '.$res.'',1,1,'C',1);
	$pdf->Output();
	}
	else{
		echo '<script type="text/javascript">alert("No Records Found");window.location=\'Summary_d.php\';</script>';
	}
}
else if( $P_GENDER == 'Male' && $clinic == 'All')
{
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
	$sql = mysql_query("select * from dentist where vaild='valid' AND D_GENDER='Male' ORDER BY D_NAME ASC");
	$res=mysql_num_rows($sql);
	if($res != 0)
	{
	while($rows=mysql_fetch_array($sql))
	{
		$pdf->Cell(35,10,$rows['D_NAME'],1,0,'C');
		$pdf->Cell(20,10,$rows['D_GENDER'],1,0,'C');
		$pdf->Cell(60,10,$rows['D_EMAIL'],1,0,'C');
		$pdf->Cell(40,10,$rows['D_PHNO'],1,0,'C');		
		$pdf->Cell(50,10,$rows['Qualification'],1,0,'C');
		$pdf->Cell(30,10,$rows['Experience'],1,0,'C');
		$pdf->Cell(42,10,$rows['clinic'],1,1,'C');			
	}
	$pdf->Cell(0,10,'TOTAL NUMBER OF MALE DENTISTS REGISTERED : '.$res.'',1,1,'C',1);
	$pdf->Output();
	}
	else{
		echo '<script type="text/javascript">alert("No Records Found");window.location=\'Summary_d.php\';</script>';
	}
}
else if( $P_GENDER == 'Female' && $clinic == 'All')
{
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
	$sql = mysql_query("select * from dentist where vaild='valid' AND D_GENDER='Female' ORDER BY D_NAME ASC");
	$res=mysql_num_rows($sql);
	if($res != 0)
	{
	while($rows=mysql_fetch_array($sql))
	{
		$pdf->Cell(35,10,$rows['D_NAME'],1,0,'C');
		$pdf->Cell(20,10,$rows['D_GENDER'],1,0,'C');
		$pdf->Cell(60,10,$rows['D_EMAIL'],1,0,'C');
		$pdf->Cell(40,10,$rows['D_PHNO'],1,0,'C');		
		$pdf->Cell(50,10,$rows['Qualification'],1,0,'C');
		$pdf->Cell(30,10,$rows['Experience'],1,0,'C');
		$pdf->Cell(42,10,$rows['clinic'],1,1,'C');			
	}
	$pdf->Cell(0,10,'TOTAL NUMBER OF FEMALE DENTISTS REGISTERED : '.$res.'',1,1,'C',1);
	$pdf->Output();
	}
	else{
		echo '<script type="text/javascript">alert("No Records Found");window.location=\'Summary_d.php\';</script>';
	}
}
else
		echo '<script type="text/javascript">alert("No Records Found");window.location=\'Summary_d.php\';</script>';
mysql_close($con);	
?>
