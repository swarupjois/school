<?php
require_once('fpdf/fpdf.php');
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


class PDF extends Fpdf
{
    function Header()
    {
        $this->SetFont('Arial','',8);
        $this->Cell(120);
        //$this->Cell(0,10,date("d-F-Y h:i A"),0,0,'L');
        $this->Ln(15);

    }
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        //$this->Cell(0,10,$this->PageNo(),0,0,'C');
    }
function OpenTag($tag, $attr)
{
    // Opening tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

function CloseTag($tag)
{
    // Closing tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}
function SetStyle($tag, $enable)
{
    // Modify style and select corresponding font
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('',$style);
}
function PutLink($URL, $txt)
{
    // Put a hyperlink
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}

function WriteHTML($html)
{
    // HTML parser
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            // Tag
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extract attributes
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}


} 
	

$pdf = new PDF();



	   $pdf->SetMargins(10, 3, 3);
                     $pdf->AddPage('L','A4');
               

	$pdf->SetFont('Times','B',35);
	//$pdf->SetTextColor(100,100,150);
	$pdf->setFillColor(230,230,230); 
	$pdf->Cell(0,10,'STUDY CERTIFICATE',0,0,'C');

	

$sql = "SELECT * FROM student WHERE name='$name' ";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
  
$pdf->SetFont('Times','',16);
$pdf->Cell(0,40,date("d/m/Y"),0,0,'R');
$pdf->Ln(10);
      
 $pdf->SetFont('Times','',16);
 $pdf->Cell(80,60,'This is certify that Sri/Kum ',0,0,'C');
    


      $pdf->SetFont('Times','B',25);

     $pdf->Cell(0,60,$row["name"],0,0,'C'); 
     
        $pdf->Ln(10);
     
     $pdf->SetFont('Times','',16);
$pdf->Cell(40,70,'S/o / D/o',0,0,'C');
      

    $pdf->SetFont('Times','B',25);
 $pdf->Cell(200,70,$row["father_name"],0,0,'C');
    
     

    $pdf->SetFont('Times','',16);
 $pdf->Cell(20,70,' has studied from  ',0,0,'C');

       $pdf->Ln(10);
 
     $pdf->SetFont('Times','B',25);
 $pdf->Cell(75,80,$row["class"],0,0,'C');

     $pdf->SetFont('Times','',16);
 $pdf->Cell(45,80,'th standard to ',0,0,'C');
  
$pdf->SetFont('Times','B',25);
$pdf->Cell(75,80,$row["studied_till"] ,0,0,'C');

$pdf->SetFont('Times','',16);
$pdf->Cell(75,80,'th standard in our Institution from ',0,0,'C');

       $pdf->Ln(10);
$pdf->SetFont('Times','B',25);
$pdf->Cell(105,90,$row["joining_date"] ,0,0,'C');


      $pdf->SetFont('Times','',16);
    $pdf->Cell(10,90,'to ',0,0,'C');
   

$pdf->SetFont('Times','B',25);
$pdf->Cell(105,90, $row["leaving_date"],0,0,'C');

     

$pdf->SetFont('Times','',16);
$pdf->Cell(60,90,'  acdemic years.',0,0,'C');


$pdf->Ln(10);


  $pdf->SetFont('Times','',16);
$pdf->Cell(75,100,' He/She belongs to',0,0,'C');



                      
  $pdf->SetFont('Times','B',25);
$pdf->Cell(110,100,$row["caste"],0,0,'C');
 



   $pdf->SetFont('Times','',16);
  $pdf->Cell(80,100,'caste and mother tongue of the ',0,0,'C');

$pdf->Ln(10);

$pdf->SetFont('Times','',16);
  $pdf->Cell(35,110,'candidate is ',0,0,'C');


$pdf->SetFont('Times','B',25);
$pdf->Cell(50,110,$row["mother_tongue"] ,0,0,'C');

     $pdf->SetFont('Times','',16);
 $pdf->Cell(80,110,'as per the Admission Register of the Institution. ',0,0,'C');

$html = 'You can now easily print text mixing different styles: <b>bold</b>, <i>italic</i>,
<u>underlined</u>, or <b><i><u>all at once</u></i></b>!<br><br>You can also insert links on
text, such as <a href="http://www.fpdf.org">www.fpdf.org</a>, or on an image: click on the logo.';
$pdf->WriteHTML($html);



     

          }

$pdf->Output();

$conn->close();
?>