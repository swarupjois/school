<?php
require('fpdf.php');

$pdf = new FPDF('P','mm',array(100,150));
$pdf->AddPage('L','A4');
$pdf->SetFont('Arial','B',21);
$pdf->Cell(120,10,'STUDY CERTIFICATE');



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
echo "<center><h1><b>STUDY CERTIFICATE</b></h1></center>";


$sql = "SELECT * FROM student WHERE name='$name' ";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$pdf->SetFont('Times','B',21);
$d=date("d/m/Y");


$pdf->SetFont('Times','B',16);
$StudentName=$row["name"];

$pdf->SetFont('Times','B',16);
$FatherName=$row["father_name"];

$pdf->SetFont('Times','B',16);
$Class=$row["class"];

$pdf->SetFont('Times','B',16);
$StudiedTill=$row["studied_till"];

$pdf->SetFont('Times','B',16);
$JoiningDate=$row["joining_date"];

$pdf->SetFont('Times','B',16);
$LeavingDate=$row["leaving_date"];

$pdf->SetFont('Times','B',16);
$Caste=$row["caste"];

$pdf->SetFont('Times','B',16);
$MotherTongue=$row["mother_tongue"];



   echo "<pre>                                                                                                                                               Date:<u>$pdf->cell(120,20,$d);</u></pre>";
    echo "<p>This is certify that Sri/Kum <u><b>".$pdf->cell(120,20,$StudentName)."</b></u> s/o  <u><b>".$pdf->cell(120,20,$FatherName)."
        </b></u> has studied from <u><b>".$pdf->cell(120,20,$Class)."</b></u>th standard to<u><b> ".$pdf->cell(120,20,$StudiedTill)."</b></u> th standard
                       in our Institution from <u><b>".$pdf->cell(120,20,$JoiningDate)."</b></u> to <u><b> ".$pdf->cell(120,20,$LeavingDate)." </b></u> acdemic years.
                       He/She belongs to <u><b>".$pdf->cell(120,20,$Caste)."</b></u> caste and mother tongue of the candidate <u><b>".$pdf->cell(120,20,$MotherTongue)."</b></u> 
                       as per the Admission Register of the Institution.</p>";

echo "<pre>                    This above details are true and correct to the best of my knowledge.
                                               								

										Signature of Head of the Institution
										
										       (name in block letters)


						
							COUNTER SIGNED BY ME


						Address,Seal & Office,Telephone Number
						of the Block Educational Officer/DDPI</pre>";

     
}

$pdf->Output();

$conn->close();
?>



