<?php
require('fpdf.php');
$name=$_POST["n1"];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SCHOOL";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$pdf = new FPDF('P','mm',array(100,150));


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
	

echo "<center><h1><b>STUDY CERTIFICATE</b></h1></center>";


$sql = "SELECT * FROM student WHERE name='$name' ";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();

   echo "<pre>                                                                                                                                               Date:<u>".date("d/m/Y")."</u></pre>";
    echo "<p>This is certify that Sri/Kum <u><b>$pdf->Cell(50,10,$row["name"],1,0,'C',1);</b></u> s/o  <u><b>$pdf->Cell(70,10,$row["father_name"],1,0,'C',1);
        </b></u> has studied from <u><b>$pdf->Cell(100,10,$row["class"],1,0,'C',1);</b></u>th standard to<u><b> $pdf->Cell(150,10,$row["studied_till"],1,0,'C',1);</b></u> th standard
                       in our Institution from <u><b>$pdf->Cell(180,10,$row["joining_date"],1,0,'C',1);</b></u> to <u><b> $pdf->Cell(130,10,$row["leaving_date"],1,0,'C',1);</b></u> acdemic years.
                       He/She belongs to <u><b>$pdf->Cell(200,10,$row["caste"],1,0,'C',1);</b></u> caste and mother tongue of the candidate <u><b>$pdf->Cell(220,10,$row["mother_tongue"],1,0,'C',1);</b></u> 
                       as per the Admission Register of the Institution.</p>";

echo "<pre>                    This above details are true and correct to the best of my knowledge.
                                               								

										Signature of Head of the Institution
										
										       (name in block letters)


						
							COUNTER SIGNED BY ME


						Address,Seal & Office,Telephone Number
						of the Block Educational Officer/DDPI</pre>";

     
}



$conn->close();
?>



</body>
</html>




	



$pdf->Output();

$conn->close();
?>



