<?php 
require_once('fpdf17/fpdf.php');
$addno=$_POST["addno"];

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

date_default_timezone_set("Asia/Calcutta");


class PDF extends Fpdf
{
var $B;
var $I;
var $U;
var $HREF;

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


function PDF($orientation='P', $unit='mm', $size='A4')
{
    // Call parent constructor
    $this->FPDF($orientation,$unit,$size);
    // Initialization
    $this->B = 0;
    $this->I = 0;
    $this->U = 0;
    $this->HREF = '';
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
}
  



$sql = "SELECT * FROM student WHERE addno=$addno";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$name=$row["name"];
$class=$row["current_class"];





$pdf=new PDF();
	$pdf->AddPage('L','A4');
	$pdf->SetFont('Arial','B',15);
	$pdf->SetTextColor(100,100,150);
	$pdf->setFillColor(230,230,230); 
	$pdf->Cell(0,10,'PROGRESS REPORT',1,1,'C',1);
	$pdf->Cell(0,10,'Addmission No:-'.$addno.'                                                                                          Name:-'.$name,1,1,'L');
                  $pdf->Cell(0,10,' Standard:'.$class,1,1,'L');
               

                 
	$pdf->SetFont('Arial','B',12.5);
	$pdf->SetTextColor(0,0,0);
	$pdf->setFillColor(195,200,210); 
	$pdf->Cell(35,10,'SUBJECT',1,0,'C',1);
	$pdf->Cell(13,10,'FA1',1,0,'C',1);
$pdf->Cell(7,10,'G',1,0,'C',1);
	$pdf->Cell(13,10,'FA2',1,0,'C',1);
$pdf->Cell(7,10,'G',1,0,'C',1);
	$pdf->Cell(13,10,'SA1',1,0,'C',1);
$pdf->Cell(7,10,'G',1,0,'C',1);
	$pdf->SetFont('Arial','B',11.5);
	$pdf->Cell(23,10,'S1 TOTAL',1,0,'C',1);
	$pdf->SetFont('Arial','B',12.5);
$pdf->Cell(7,10,'G',1,0,'C',1);
	$pdf->Cell(13,10,'FA3',1,0,'C',1);
$pdf->Cell(7,10,'G',1,0,'C',1);
	$pdf->Cell(13,10,'FA4',1,0,'C',1);
$pdf->Cell(7,10,'G',1,0,'C',1);
                  
	$pdf->Cell(13,10,'SA2',1,0,'C',1);
$pdf->Cell(7,10,'G',1,0,'C',1);
	$pdf->SetFont('Arial','B',11.5);
	$pdf->Cell(23,10,'S2 TOTAL',1,0,'C',1);
	$pdf->SetFont('Arial','B',12.5);
$pdf->Cell(7,10,'G',1,0,'C',1);

	$pdf->Cell(42,10,'TOTAL',1,0,'C',1);
	$pdf->Cell(20,10,'GRADE',1,1,'C',1);
	$pdf->SetFont('Arial','',12.5);

if($class>=1 AND $class<=5)
{
$sql = "SELECT * FROM test1 WHERE addno=$addno and sub_name='KANNADA'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa1=$row["fa1"];
$avg=($fa1/15)*100;
if($avg>=0 AND $avg<=29)
       $grade1='C';
       else if($avg>=30 AND $avg<=49)
        $grade1='B';
       else if($avg>=50 AND $avg<=69)
       $grade1='B+';
      else if($avg>=70 AND $avg<=89)
       $grade1='A';
      else if($avg>=90 AND $avg<=100)
      $grade1='A+';
}

$sql = "SELECT * FROM test2 WHERE addno=$addno and sub_name='KANNADA'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
$avg=($fa2/15)*100;
if($avg>=0 AND $avg<=29)
       $grade2='C';
       else if($avg>=30 AND $avg<=49)
        $grade2='B';
       else if($avg>=50 AND $avg<=69)
       $grade2='B+';
      else if($avg>=70 AND $avg<=89)
       $grade2='A';
      else if($avg>=90 AND $avg<=100)
      $grade2='A+';

}
$sql = "SELECT * FROM sa1 WHERE addno=$addno and sub_name='KANNADA'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa1=$row["marks"];
$avg=($sa1/20)*100;
if($avg>=0 AND $avg<=29)
       $grade11='C';
       else if($avg>=30 AND $avg<=49)
        $grade11='B';
       else if($avg>=50 AND $avg<=69)
       $grade11='B+';
      else if($avg>=70 AND $avg<=89)
       $grade11='A';
      else if($avg>=90 AND $avg<=100)
      $grade11='A+';

}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='KANNADA'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s1_total=$row["s1_total"];
$avg=($s1_total/50)*100;
if($avg>=0 AND $avg<=29)
       $gradet1='C';
       else if($avg>=30 AND $avg<=49)
        $gradet1='B';
       else if($avg>=50 AND $avg<=69)
       $gradet1='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet1='A';
      else if($avg>=90 AND $avg<=100)
      $gradet1='A+';

}

$sql = "SELECT * FROM test3 WHERE addno=$addno and sub_name='KANNADA'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa3=$row["fa3"];
$avg=($fa3/15)*100;
if($avg>=0 AND $avg<=29)
       $grade3='C';
       else if($avg>=30 AND $avg<=49)
        $grade3='B';
       else if($avg>=50 AND $avg<=69)
       $grade3='B+';
      else if($avg>=70 AND $avg<=89)
       $grade3='A';
      else if($avg>=90 AND $avg<=100)
      $grade3='A+';

}

$sql = "SELECT * FROM test4 WHERE addno=$addno and sub_name='KANNADA'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
$avg=($fa4/15)*100;
if($avg>0 AND $avg<29)
       $grade4='C';
       else if($avg>=30 AND $avg<=49)
        $grade4='B';
       else if($avg>=50 AND $avg<=69)
       $grade4='B+';
      else if($avg>=70 AND $avg<=89)
       $grade4='A';
      else if($avg>=90 AND $avg<=100)
      $grade4='A+';

}
$sql = "SELECT * FROM sa2 WHERE addno=$addno and sub_name='KANNADA'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa2=$row["marks"];
$avg=($sa2/20)*100;
if($avg>0 AND $avg<29)
       $gradesa2='C';
       else if($avg>=30 AND $avg<=49)
        $gradesa2='B';
       else if($avg>=50 AND $avg<=69)
       $gradesa2='B+';
      else if($avg>=70 AND $avg<=89)
       $gradesa2='A';
      else if($avg>=90 AND $avg<=100)
      $gradesa2='A+';

}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='KANNADA'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s2_total=$row["s2_total"];
$avg=($s2_total/50)*100;
if($avg>0 AND $avg<29)
       $gradet2='C';
       else if($avg>=30 AND $avg<=49)
        $gradet2='B';
       else if($avg>=50 AND $avg<=69)
       $gradet2='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet2='A';
      else if($avg>=90 AND $avg<=100)
      $gradet2='A+';

}
$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='KANNADA'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$total=$row["total"];
}
$sql="select * from test_total where addno=$addno and sub_name='KANNADA'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $kantotal=$row["total"];
       if($kantotal>=0 AND $kantotal<=29)
       $kangrade='C';
       else if($kantotal>=30 AND $kantotal<=49)
        $kangrade='B';
       else if($kantotal>=50 AND $kantotal<=69)
       $kangrade='B+';
      else if($kantotal>=70 AND $kantotal<=89)
       $kangrade='A';
      else if($kantotal>=90 AND $kantotal<=100)
      $kangrade='A+';
 }





                  $pdf->Cell(35,10,'KANNADA',1,0,'C');
		$pdf->Cell(13,10,$fa1,1,0,'C');
$pdf->Cell(7,10,$grade1,1,0,'C');

		$pdf->Cell(13,10,$fa2,1,0,'C');
$pdf->Cell(7,10,$grade2,1,0,'C');
		$pdf->Cell(13,10,$sa1,1,0,'C');
$pdf->Cell(7,10,$grade11,1,0,'C');		
		$pdf->Cell(23,10,$s1_total,1,0,'C');
$pdf->Cell(7,10,$gradet1,1,0,'C');
		$pdf->Cell(13,10,$fa3,1,0,'C');
$pdf->Cell(7,10,$grade3,1,0,'C');
		$pdf->Cell(13,10,$fa4,1,0,'C');
$pdf->Cell(7,10,$grade4,1,0,'C');
                                   $pdf->Cell(13,10,$sa2,1,0,'C');
$pdf->Cell(7,10,$gradesa2,1,0,'C');
		$pdf->Cell(23,10,$s2_total,1,0,'C');
$pdf->Cell(7,10,$gradet2,1,0,'C');
		$pdf->Cell(42,10,$total,1,0,'C');		
		$pdf->Cell(20,10,$kangrade,1,1,'C');

//*********english marks***********//

$sql = "SELECT * FROM test1 WHERE addno=$addno and sub_name='ENGLISH'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa1=$row["fa1"];
$avg=($fa1/15)*100;
if($avg>=0 AND $avg<=29)
       $grade1='C';
       else if($avg>=30 AND $avg<=49)
        $grade1='B';
       else if($avg>=50 AND $avg<=69)
       $grade1='B+';
      else if($avg>=70 AND $avg<=89)
       $grade1='A';
      else if($avg>=90 AND $avg<=100)
      $grade1='A+';

}
$sql = "SELECT * FROM test2 WHERE addno=$addno and sub_name='ENGLISH'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
$avg=($fa2/15)*100;
if($avg>0 AND $avg<29)
       if($avg>=0 AND $avg<=29)
       $grade2='C';
       else if($avg>=30 AND $avg<=49)
        $grade2='B';
       else if($avg>=50 AND $avg<=69)
       $grade2='B+';
      else if($avg>=70 AND $avg<=89)
       $grade2='A';
      else if($avg>=90 AND $avg<=100)
      $grade2='A+';

}
$sql = "SELECT * FROM sa1 WHERE addno=$addno and sub_name='ENGLISH'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa1=$row["marks"];
$avg=($sa1/20)*100;
if($avg>=0 AND $avg<=29)
       $grade11='C';
       else if($avg>=30 AND $avg<=49)
        $grade11='B';
       else if($avg>=50 AND $avg<=69)
       $grade11='B+';
      else if($avg>=70 AND $avg<=89)
       $grade11='A';
      else if($avg>=90 AND $avg<=100)
      $grade11='A+';

}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='ENGLISH'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s1_total=$row["s1_total"];
$avg=($s1_total/50)*100;
if($avg>=0 AND $avg<=29)
       $gradet1='C';
       else if($avg>=30 AND $avg<=49)
        $gradet1='B';
       else if($avg>=50 AND $avg<=69)
       $gradet1='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet1='A';
      else if($avg>=90 AND $avg<=100)
      $gradet1='A+';

}

$sql = "SELECT * FROM test3 WHERE addno=$addno and sub_name='ENGLISH'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa3=$row["fa3"];
$avg=($fa3/15)*100;
if($avg>=0 AND $avg<=29)
       $grade3='C';
       else if($avg>=30 AND $avg<=49)
        $grade3='B';
       else if($avg>=50 AND $avg<=69)
       $grade3='B+';
      else if($avg>=70 AND $avg<=89)
       $grade3='A';
      else if($avg>=90 AND $avg<=100)
      $grade3='A+';

}

$sql = "SELECT * FROM test4 WHERE addno=$addno and sub_name='ENGLISH'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
$avg=($fa4/15)*100;
if($avg>=0 AND $avg<=29)
       $grade4='C';
       else if($avg>=30 AND $avg<=49)
        $grade4='B';
       else if($avg>=50 AND $avg<=69)
       $grade4='B+';
      else if($avg>=70 AND $avg<=89)
       $grade4='A';
      else if($avg>=90 AND $avg<=100)
      $grade4='A+';

}
$sql = "SELECT * FROM sa2 WHERE addno=$addno and sub_name='ENGLISH'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa2=$row["marks"];
$avg=($sa2/20)*100;
if($avg>=0 AND $avg<=29)
       $grade12='C';
       else if($avg>=30 AND $avg<=49)
        $grade12='B';
       else if($avg>=50 AND $avg<=69)
       $grade12='B+';
      else if($avg>=70 AND $avg<=89)
       $grade12='A';
      else if($avg>=90 AND $avg<=100)
      $grade12='A+';

}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='ENGLISH'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s2_total=$row["s2_total"];
$avg=($s2_total/50)*100;
if($avg>=0 AND $avg<=29)
       $gradet2='C';
       else if($avg>=30 AND $avg<=49)
        $gradet2='B';
       else if($avg>=50 AND $avg<=69)
       $gradet2='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet2='A';
      else if($avg>=90 AND $avg<=100)
      $gradet2='A+';

}
$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='ENGLISH'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$total=$row["total"];
}
$sql="select * from test_total where addno=$addno and sub_name='ENGLISH'";
$result = $conn->query($sql);
if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $kantotal=$row["total"];
       if($kantotal>=0 AND $kantotal<=29)
       $grade='C';
       else if($kantotal>=30 AND $kantotal<=49)
        $grade='B';
       else if($kantotal>=50 AND $kantotal<=69)
       $grade='B+';
      else if($kantotal>=70 AND $kantotal<=89)
       $grade='A';
      else if($kantotal>=90 AND $kantotal<=100)
      $grade='A+';
 }





                  $pdf->Cell(35,10,'ENGLISH',1,0,'C');
		$pdf->Cell(13,10,$fa1,1,0,'C');
$pdf->Cell(7,10,$grade1,1,0,'C');
		$pdf->Cell(13,10,$fa2,1,0,'C');
$pdf->Cell(7,10,$grade2,1,0,'C');
		$pdf->Cell(13,10,$sa1,1,0,'C');	
$pdf->Cell(7,10,$grade11,1,0,'C');	
		$pdf->Cell(23,10,$s1_total,1,0,'C');
$pdf->Cell(7,10,$gradet1,1,0,'C');
		$pdf->Cell(13,10,$fa3,1,0,'C');
$pdf->Cell(7,10,$grade3,1,0,'C');
		$pdf->Cell(13,10,$fa4,1,0,'C');
$pdf->Cell(7,10,$grade4,1,0,'C');
                                   $pdf->Cell(13,10,$sa2,1,0,'C');
$pdf->Cell(7,10,$grade12,1,0,'C');
		$pdf->Cell(23,10,$s2_total,1,0,'C');
$pdf->Cell(7,10,$gradet2,1,0,'C');
		$pdf->Cell(42,10,$total,1,0,'C');		
		$pdf->Cell(20,10,$grade,1,1,'C');

//**********HINDI*********//


$sql = "SELECT * FROM test1 WHERE addno=$addno and sub_name='HINDI'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa1=$row["fa1"];
$avg=($fa1/15)*100;
if($avg>=0 AND $avg<=29)
$grade1='C';
       else if($avg>=30 AND $avg<=49)
        $grade1='B';
       else if($avg>=50 AND $avg<=69)
       $grade1='B+';
      else if($avg>=70 AND $avg<=89)
       $grade1='A';
      else if($avg>=90 AND $avg<=100)
      $grade1='A+';


}
$sql = "SELECT * FROM test2 WHERE addno=$addno and sub_name='HINDI'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
$avg=($fa2/15)*100;
if($avg>=0 AND $avg<=29)
       $grade2='C';
       else if($avg>=30 AND $avg<=49)
        $grade2='B';
       else if($avg>=50 AND $avg<=69)
       $grade2='B+';
      else if($avg>=70 AND $avg<=89)
       $grade2='A';
      else if($avg>=90 AND $avg<=100)
      $grade2='A+';

}
$sql = "SELECT * FROM sa1 WHERE addno=$addno and sub_name='HINDI'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa1=$row["marks"];
$avg=($sa1/20)*100;
if($avg>=0 AND $avg<=29)
$grade11='C';
       else if($avg>=30 AND $avg<=49)
        $grade11='B';
       else if($avg>=50 AND $avg<=69)
       $grade11='B+';
      else if($avg>=70 AND $avg<=89)
       $grade11='A';
      else if($avg>=90 AND $avg<=100)
      $grade11='A+';

}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='HINDI'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s1_total=$row["s1_total"];
$avg=($s1_total/50)*100;
if($avg>=0 AND $avg<=29)
$gradet1='C';
       else if($avg>=30 AND $avg<=49)
        $gradet1='B';
       else if($avg>=50 AND $avg<=69)
       $gradet1='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet1='A';
      else if($avg>=90 AND $avg<=100)
      $gradet1='A+';

}

$sql = "SELECT * FROM test3 WHERE addno=$addno and sub_name='HINDI'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa3=$row["fa3"];
$avg=($fa3/15)*100;
if($avg>=0 AND $avg<=29)
$grade3='C';
       else if($avg>=30 AND $avg<=49)
        $grade3='B';
       else if($avg>=50 AND $avg<=69)
       $grade3='B+';
      else if($avg>=70 AND $avg<=89)
       $grade3='A';
      else if($avg>=90 AND $avg<=100)
      $grade3='A+';

}

$sql = "SELECT * FROM test4 WHERE addno=$addno and sub_name='HINDI'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
$avg=($fa4/15)*100;
if($avg>=0 AND $avg<=29)
$grade4='C';
       else if($avg>=30 AND $avg<=49)
        $grade4='B';
       else if($avg>=50 AND $avg<=69)
       $grade4='B+';
      else if($avg>=70 AND $avg<=89)
       $grade4='A';
      else if($avg>=90 AND $avg<=100)
      $grade4='A+';

}
$sql = "SELECT * FROM sa2 WHERE addno=$addno and sub_name='HINDI'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa2=$row["marks"];
$avg=($sa2/20)*100;
if($avg>=0 AND $avg<=29)
$grade12='C';
       else if($avg>=30 AND $avg<=49)
        $grade12='B';
       else if($avg>=50 AND $avg<=69)
       $grade12='B+';
      else if($avg>=70 AND $avg<=89)
       $grade12='A';
      else if($avg>=90 AND $avg<=100)
      $grade12='A+';

}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='HINDI'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s2_total=$row["s2_total"];
$avg=($s2_total/50)*100;
if($avg>=0 AND $avg<=29)
$gradet2='C';
       else if($avg>=30 AND $avg<=49)
        $gradet2='B';
       else if($avg>=50 AND $avg<=69)
       $gradet2='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet2='A';
      else if($avg>=90 AND $avg<=100)
      $gradet2='A+';

}
$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='HINDI'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$total=$row["total"];
}
$sql="select * from test_total where addno=$addno and sub_name='HINDI'";
$result = $conn->query($sql);
if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $kantotal=$row["total"];
       if($kantotal>=0 AND $kantotal<=29)
       $grade='C';
       else if($kantotal>=30 AND $kantotal<=49)
        $grade='B';
       else if($kantotal>=50 AND $kantotal<=69)
       $grade='B+';
      else if($kantotal>=70 AND $kantotal<=89)
       $grade='A';
      else if($kantotal>=90 AND $kantotal<=100)
      $grade='A+';
 }





                  $pdf->Cell(35,10,'HINDI',1,0,'C');
		$pdf->Cell(13,10,$fa1,1,0,'C');
$pdf->Cell(7,10,$grade1,1,0,'C');
		$pdf->Cell(13,10,$fa2,1,0,'C');
$pdf->Cell(7,10,$grade2,1,0,'C');

		$pdf->Cell(13,10,$sa1,1,0,'C');	
$pdf->Cell(7,10,$grade11,1,0,'C');
	
		$pdf->Cell(23,10,$s1_total,1,0,'C');
$pdf->Cell(7,10,$gradet1,1,0,'C');

		$pdf->Cell(13,10,$fa3,1,0,'C');
$pdf->Cell(7,10,$grade3,1,0,'C');

		$pdf->Cell(13,10,$fa4,1,0,'C');
$pdf->Cell(7,10,$grade4,1,0,'C');

                                   $pdf->Cell(13,10,$sa2,1,0,'C');
$pdf->Cell(7,10,$grade12,1,0,'C');

		$pdf->Cell(23,10,$s2_total,1,0,'C');
$pdf->Cell(7,10,$gradet2,1,0,'C');

		$pdf->Cell(42,10,$total,1,0,'C');		
		$pdf->Cell(20,10,$grade,1,1,'C');


//********MATHS*******//


$sql = "SELECT * FROM test1 WHERE addno=$addno and sub_name='MATHS'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa1=$row["fa1"];
$avg=($fa1/15)*100;
if($avg>=0 AND $avg<=29)
$grade1='C';
       else if($avg>=30 AND $avg<=49)
        $grade1='B';
       else if($avg>=50 AND $avg<=69)
       $grade1='B+';
      else if($avg>=70 AND $avg<=89)
       $grade1='A';
      else if($avg>=90 AND $avg<=100)
      $grade1='A+';

}
$sql = "SELECT * FROM test2 WHERE addno=$addno and sub_name='MATHS'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
$avg=($fa2/15)*100;
if($avg>=0 AND $avg<=29)
$grade2='C';
       else if($avg>=30 AND $avg<=49)
        $grade2='B';
       else if($avg>=50 AND $avg<=69)
       $grade2='B+';
      else if($avg>=70 AND $avg<=89)
       $grade2='A';
      else if($avg>=90 AND $avg<=100)
      $grade2='A+';
}
$sql = "SELECT * FROM sa1 WHERE addno=$addno and sub_name='MATHS'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa1=$row["marks"];
$avg=($sa1/20)*100;
if($avg>=0 AND $avg<=29)
$grade11='C';
       else if($avg>=30 AND $avg<=49)
        $grade11='B';
       else if($avg>=50 AND $avg<=69)
       $grade11='B+';
      else if($avg>=70 AND $avg<=89)
       $grade11='A';
      else if($avg>=90 AND $avg<=100)
      $grade11='A+';
}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='MATHS'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s1_total=$row["s1_total"];
$avg=($s1_total/50)*100;
if($avg>=0 AND $avg<=29)
$gradet1='C';
       else if($avg>=30 AND $avg<=49)
        $gradet1='B';
       else if($avg>=50 AND $avg<=69)
       $gradet1='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet1='A';
      else if($avg>=90 AND $avg<=100)
      $gradet1='A+';
}

$sql = "SELECT * FROM test3 WHERE addno=$addno and sub_name='MATHS'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa3=$row["fa3"];
$avg=($fa3/15)*100;
if($avg>=0 AND $avg<=29)
$grade3='C';
       else if($avg>=30 AND $avg<=49)
        $grade3='B';
       else if($avg>=50 AND $avg<=69)
       $grade3='B+';
      else if($avg>=70 AND $avg<=89)
       $grade3='A';
      else if($avg>=90 AND $avg<=100)
      $grade3='A+';
}

$sql = "SELECT * FROM test4 WHERE addno=$addno and sub_name='MATHS'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
$avg=($fa4/15)*100;
if($avg>=0 AND $avg<=29)
$grade4='C';
       else if($avg>=30 AND $avg<=49)
        $grade4='B';
       else if($avg>=50 AND $avg<=69)
       $grade4='B+';
      else if($avg>=70 AND $avg<=89)
       $grade4='A';
      else if($avg>=90 AND $avg<=100)
      $grade4='A+';
}
$sql = "SELECT * FROM sa2 WHERE addno=$addno and sub_name='MATHS'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa2=$row["marks"];
$avg=($sa2/20)*100;
if($avg>=0 AND $avg<=29)
$grade12='C';
       else if($avg>=30 AND $avg<=49)
        $grade12='B';
       else if($avg>=50 AND $avg<=69)
       $grade12='B+';
      else if($avg>=70 AND $avg<=89)
       $grade12='A';
      else if($avg>=90 AND $avg<=100)
      $grade12='A+';
}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='MATHS'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s2_total=$row["s2_total"];
$avg=($s2_total/50)*100;
if($avg>=0 AND $avg<=29)
$gradet2='C';
       else if($avg>=30 AND $avg<=49)
        $gradet2='B';
       else if($avg>=50 AND $avg<=69)
       $gradet2='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet2='A';
      else if($avg>=90 AND $avg<=100)
      $gradet2='A+';
}
$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='MATHS'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$total=$row["total"];
}
$sql="select * from test_total where addno=$addno and sub_name='MATHS'";
$result = $conn->query($sql);
if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $kantotal=$row["total"];
       if($kantotal>=0 AND $kantotal<=29)
       $grade='C';
       else if($kantotal>=30 AND $kantotal<=49)
        $grade='B';
       else if($kantotal>=50 AND $kantotal<=69)
       $grade='B+';
      else if($kantotal>=70 AND $kantotal<=89)
       $grade='A';
      else if($kantotal>=90 AND $kantotal<=100)
      $grade='A+';
 }





$pdf->SetFont('Arial','',12);
                  $pdf->Cell(35,10,'MATHEMATICS',1,0,'C');
$pdf->SetFont('Arial','',12.5);
		$pdf->Cell(13,10,$fa1,1,0,'C');
$pdf->Cell(7,10,$grade1,1,0,'C');
		$pdf->Cell(13,10,$fa2,1,0,'C');
$pdf->Cell(7,10,$grade2,1,0,'C');

		$pdf->Cell(13,10,$sa1,1,0,'C');	
$pdf->Cell(7,10,$grade11,1,0,'C');
	
		$pdf->Cell(23,10,$s1_total,1,0,'C');
$pdf->Cell(7,10,$gradet1,1,0,'C');

		$pdf->Cell(13,10,$fa3,1,0,'C');
$pdf->Cell(7,10,$grade3,1,0,'C');

		$pdf->Cell(13,10,$fa4,1,0,'C');
$pdf->Cell(7,10,$grade4,1,0,'C');

                                   $pdf->Cell(13,10,$sa2,1,0,'C');
$pdf->Cell(7,10,$grade12,1,0,'C');

		$pdf->Cell(23,10,$s2_total,1,0,'C');
$pdf->Cell(7,10,$gradet2,1,0,'C');

		$pdf->Cell(42,10,$total,1,0,'C');		
		$pdf->Cell(20,10,$grade,1,1,'C');


//**********SCIENCE********//


$sql = "SELECT * FROM test1 WHERE addno=$addno and sub_name='SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa1=$row["fa1"];
$avg=($fa1/15)*100;
if($avg>=0 AND $avg<=29)
$grade1='C';
       else if($avg>=30 AND $avg<=49)
        $grade1='B';
       else if($avg>=50 AND $avg<=69)
       $grade1='B+';
      else if($avg>=70 AND $avg<=89)
       $grade1='A';
      else if($avg>=90 AND $avg<=100)
      $grade1='A+';

}
$sql = "SELECT * FROM test2 WHERE addno=$addno and sub_name='SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
$avg=($fa2/15)*100;
if($avg>=0 AND $avg<=29)
$grade2='C';
       else if($avg>=30 AND $avg<=49)
        $grade2='B';
       else if($avg>=50 AND $avg<=69)
       $grade2='B+';
      else if($avg>=70 AND $avg<=89)
       $grade2='A';
      else if($avg>=90 AND $avg<=100)
      $grade2='A+';

}
$sql = "SELECT * FROM sa1 WHERE addno=$addno and sub_name='SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa1=$row["marks"];
$avg=($sa1/20)*100;
if($avg>=0 AND $avg<=29)
$grade11='C';
       else if($avg>=30 AND $avg<=49)
        $grade11='B';
       else if($avg>=50 AND $avg<=69)
       $grade11='B+';
      else if($avg>=70 AND $avg<=89)
       $grade11='A';
      else if($avg>=90 AND $avg<=100)
      $grade11='A+';

}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s1_total=$row["s1_total"];
$avg=($s1_total/50)*100;
if($avg>=0 AND $avg<=29)
$gradet1='C';
       else if($avg>=30 AND $avg<=49)
        $gradet1='B';
       else if($avg>=50 AND $avg<=69)
       $gradet1='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet1='A';
      else if($avg>=90 AND $avg<=100)
      $gradet1='A+';

}

$sql = "SELECT * FROM test3 WHERE addno=$addno and sub_name='SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa3=$row["fa3"];
$avg=($fa3/15)*100;
if($avg>=0 AND $avg<=29)
$grade3='C';
       else if($avg>=30 AND $avg<=49)
        $grade3='B';
       else if($avg>=50 AND $avg<=69)
       $grade3='B+';
      else if($avg>=70 AND $avg<=89)
       $grade3='A';
      else if($avg>=90 AND $avg<=100)
      $grade3='A+';

}

$sql = "SELECT * FROM test4 WHERE addno=$addno and sub_name='SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
$avg=($fa4/15)*100;
if($avg>=0 AND $avg<=29)
$grade4='C';
       else if($avg>=30 AND $avg<=49)
        $grade4='B';
       else if($avg>=50 AND $avg<=69)
       $grade4='B+';
      else if($avg>=70 AND $avg<=89)
       $grade4='A';
      else if($avg>=90 AND $avg<=100)
      $grade4='A+';

}
$sql = "SELECT * FROM sa2 WHERE addno=$addno and sub_name='SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa2=$row["marks"];
$avg=($sa2/20)*100;
if($avg>=0 AND $avg<=29)
$grade12='C';
       else if($avg>=30 AND $avg<=49)
        $grade12='B';
       else if($avg>=50 AND $avg<=69)
       $grade12='B+';
      else if($avg>=70 AND $avg<=89)
       $grade12='A';
      else if($avg>=90 AND $avg<=100)
      $grade12='A+';

}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s2_total=$row["s2_total"];
$avg=($s2_total/50)*100;
if($avg>=0 AND $avg<=29)
$gradet2='C';
       else if($avg>=30 AND $avg<=49)
        $gradet2='B';
       else if($avg>=50 AND $avg<=69)
       $gradet2='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet2='A';
      else if($avg>=90 AND $avg<=100)
      $gradet2='A+';

}
$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$total=$row["total"];
}
$sql="select * from test_total where addno=$addno and sub_name='SCIENCE'";
$result = $conn->query($sql);
if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $kantotal=$row["total"];
       if($kantotal>=0 AND $kantotal<=29)
       $grade='C';
       else if($kantotal>=30 AND $kantotal<=49)
        $grade='B';
       else if($kantotal>=50 AND $kantotal<=69)
       $grade='B+';
      else if($kantotal>=70 AND $kantotal<=89)
       $grade='A';
      else if($kantotal>=90 AND $kantotal<=100)
      $grade='A+';
 }




$pdf->SetFont('Arial','',12.5);
                  $pdf->Cell(35,10,'SCIENCE',1,0,'C');
		$pdf->Cell(13,10,$fa1,1,0,'C');
$pdf->Cell(7,10,$grade1,1,0,'C');
		$pdf->Cell(13,10,$fa2,1,0,'C');
$pdf->Cell(7,10,$grade2,1,0,'C');

		$pdf->Cell(13,10,$sa1,1,0,'C');	
$pdf->Cell(7,10,$grade11,1,0,'C');
	
		$pdf->Cell(23,10,$s1_total,1,0,'C');
$pdf->Cell(7,10,$gradet1,1,0,'C');

		$pdf->Cell(13,10,$fa3,1,0,'C');
$pdf->Cell(7,10,$grade3,1,0,'C');

		$pdf->Cell(13,10,$fa4,1,0,'C');
$pdf->Cell(7,10,$grade4,1,0,'C');

                                   $pdf->Cell(13,10,$sa2,1,0,'C');
$pdf->Cell(7,10,$grade12,1,0,'C');

		$pdf->Cell(23,10,$s2_total,1,0,'C');
$pdf->Cell(7,10,$gradet2,1,0,'C');

		$pdf->Cell(42,10,$total,1,0,'C');		
		$pdf->Cell(20,10,$grade,1,1,'C');




//*********SOCIAL SCIENCE*********//
$sql = "SELECT * FROM test1 WHERE addno=$addno and sub_name='SOCIAL SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa1=$row["fa1"];
$avg=($fa1/15)*100;
if($avg>=0 AND $avg<=29)
$grade1='C';
       else if($avg>=30 AND $avg<=49)
        $grade1='B';
       else if($avg>=50 AND $avg<=69)
       $grade1='B+';
      else if($avg>=70 AND $avg<=89)
       $grade1='A';
      else if($avg>=90 AND $avg<=100)
      $grade1='A+';

}
$sql = "SELECT * FROM test2 WHERE addno=$addno and sub_name='SOCIAL SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
$avg=($fa2/15)*100;
if($avg>=0 AND $avg<=29)
$grade2='C';
       else if($avg>=30 AND $avg<=49)
        $grade2='B';
       else if($avg>=50 AND $avg<=69)
       $grade2='B+';
      else if($avg>=70 AND $avg<=89)
       $grade2='A';
      else if($avg>=90 AND $avg<=100)
      $grade2='A+';

}
$sql = "SELECT * FROM sa1 WHERE addno=$addno and sub_name='SOCIAL SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa1=$row["marks"];
$avg=($sa1/20)*100;
if($avg>=0 AND $avg<=29)
$grade11='C';
       else if($avg>=30 AND $avg<=49)
        $grade11='B';
       else if($avg>=50 AND $avg<=69)
       $grade11='B+';
      else if($avg>=70 AND $avg<=89)
       $grade11='A';
      else if($avg>=90 AND $avg<=100)
      $grade11='A+';

}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='SOCIAL SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s1_total=$row["s1_total"];
}

$sql = "SELECT * FROM test3 WHERE addno=$addno and sub_name='SOCIAL SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa3=$row["fa3"];
$avg=($fa3/15)*100;
if($avg>=0 AND $avg<=29)
$grade3='C';
       else if($avg>=30 AND $avg<=49)
        $grade3='B';
       else if($avg>=50 AND $avg<=69)
       $grade3='B+';
      else if($avg>=70 AND $avg<=89)
       $grade3='A';
      else if($avg>=90 AND $avg<=100)
      $grade3='A+';

}

$sql = "SELECT * FROM test4 WHERE addno=$addno and sub_name='SOCIAL SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
$avg=($fa4/15)*100;
if($avg>=0 AND $avg<=29)
$grade4='C';
       else if($avg>=30 AND $avg<=49)
        $grade4='B';
       else if($avg>=50 AND $avg<=69)
       $grade4='B+';
      else if($avg>=70 AND $avg<=89)
       $grade4='A';
      else if($avg>=90 AND $avg<=100)
      $grade4='A+';

}
$sql = "SELECT * FROM sa2 WHERE addno=$addno and sub_name='SOCIAL SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa2=$row["marks"];
$avg=($sa2/20)*100;
if($avg>=0 AND $avg<=29)
$grade12='C';
       else if($avg>=30 AND $avg<=49)
        $grade12='B';
       else if($avg>=50 AND $avg<=69)
       $grade12='B+';
      else if($avg>=70 AND $avg<=89)
       $grade12='A';
      else if($avg>=90 AND $avg<=100)
      $grade12='A+';

}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='SOCIAL SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s2_total=$row["s2_total"];
$avg=($s2_total/50)*100;
if($avg>=0 AND $avg<=29)
$gradet2='C';
       else if($avg>=30 AND $avg<=49)
        $gradet2='B';
       else if($avg>=50 AND $avg<=69)
       $gradet2='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet2='A';
      else if($avg>=90 AND $avg<=100)
      $gradet2='A+';

}
$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='SOCIAL SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$total=$row["total"];
}
$sql="select * from test_total where addno=$addno and sub_name='SOCIAL SCIENCE'";
$result = $conn->query($sql);
if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $kantotal=$row["total"];
       if($kantotal>=0 AND $kantotal<=29)
       $grade='C';
       else if($kantotal>=30 AND $kantotal<=49)
        $grade='B';
       else if($kantotal>=50 AND $kantotal<=69)
       $grade='B+';
      else if($kantotal>=70 AND $kantotal<=89)
       $grade='A';
      else if($kantotal>=90 AND $kantotal<=100)
      $grade='A+';
 }




$pdf->SetFont('Arial','',12);
                  $pdf->Cell(35,10,'SOCIAL SCIENCE',1,0,'C');
$pdf->SetFont('Arial','',12.5);
		$pdf->Cell(13,10,$fa1,1,0,'C');
$pdf->Cell(7,10,$grade1,1,0,'C');
		$pdf->Cell(13,10,$fa2,1,0,'C');
$pdf->Cell(7,10,$grade2,1,0,'C');

		$pdf->Cell(13,10,$sa1,1,0,'C');	
$pdf->Cell(7,10,$grade11,1,0,'C');
	
		$pdf->Cell(23,10,$s1_total,1,0,'C');
$pdf->Cell(7,10,$gradet1,1,0,'C');

		$pdf->Cell(13,10,$fa3,1,0,'C');
$pdf->Cell(7,10,$grade3,1,0,'C');

		$pdf->Cell(13,10,$fa4,1,0,'C');
$pdf->Cell(7,10,$grade4,1,0,'C');

                                   $pdf->Cell(13,10,$sa2,1,0,'C');
$pdf->Cell(7,10,$grade12,1,0,'C');

		$pdf->Cell(23,10,$s2_total,1,0,'C');
$pdf->Cell(7,10,$gradet2,1,0,'C');
		$pdf->Cell(42,10,$total,1,0,'C');		
		$pdf->Cell(20,10,$grade,1,1,'C');

}


////****************************************************************************6 to 10***********************************************************************************////
else if($class>=6 AND $class<=10)
{
$sql = "SELECT * FROM test1 WHERE addno=$addno and sub_name='KANNADA'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa1=$row["fa1"];
$avg=($fa1/10)*100;
if($avg>=0 AND $avg<=29)
       $grade1='C';
       else if($avg>=30 AND $avg<=49)
        $grade1='B';
       else if($avg>=50 AND $avg<=69)
       $grade1='B+';
      else if($avg>=70 AND $avg<=89)
       $grade1='A';
      else if($avg>=90 AND $avg<=100)
      $grade1='A+';
}

$sql = "SELECT * FROM test2 WHERE addno=$addno and sub_name='KANNADA'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
$avg=($fa2/10)*100;
if($avg>=0 AND $avg<=29)
       $grade2='C';
       else if($avg>=30 AND $avg<=49)
        $grade2='B';
       else if($avg>=50 AND $avg<=69)
       $grade2='B+';
      else if($avg>=70 AND $avg<=89)
       $grade2='A';
      else if($avg>=90 AND $avg<=100)
      $grade2='A+';

}
$sql = "SELECT * FROM sa1 WHERE addno=$addno and sub_name='KANNADA'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa1=$row["marks"];
$avg=($sa1/30)*100;
if($avg>=0 AND $avg<=29)
       $grade11='C';
       else if($avg>=30 AND $avg<=49)
        $grade11='B';
       else if($avg>=50 AND $avg<=69)
       $grade11='B+';
      else if($avg>=70 AND $avg<=89)
       $grade11='A';
      else if($avg>=90 AND $avg<=100)
      $grade11='A+';

}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='KANNADA'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s1_total=$row["s1_total"];
$avg=($s1_total/50)*100;
if($avg>=0 AND $avg<=29)
       $gradet1='C';
       else if($avg>=30 AND $avg<=49)
        $gradet1='B';
       else if($avg>=50 AND $avg<=69)
       $gradet1='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet1='A';
      else if($avg>=90 AND $avg<=100)
      $gradet1='A+';

}

$sql = "SELECT * FROM test3 WHERE addno=$addno and sub_name='KANNADA'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa3=$row["fa3"];
$avg=($fa3/10)*100;
if($avg>=0 AND $avg<=29)
       $grade3='C';
       else if($avg>=30 AND $avg<=49)
        $grade3='B';
       else if($avg>=50 AND $avg<=69)
       $grade3='B+';
      else if($avg>=70 AND $avg<=89)
       $grade3='A';
      else if($avg>=90 AND $avg<=100)
      $grade3='A+';

}

$sql = "SELECT * FROM test4 WHERE addno=$addno and sub_name='KANNADA'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
$avg=($fa4/10)*100;
if($avg>0 AND $avg<29)
       $grade4='C';
       else if($avg>=30 AND $avg<=49)
        $grade4='B';
       else if($avg>=50 AND $avg<=69)
       $grade4='B+';
      else if($avg>=70 AND $avg<=89)
       $grade4='A';
      else if($avg>=90 AND $avg<=100)
      $grade4='A+';

}
$sql = "SELECT * FROM sa2 WHERE addno=$addno and sub_name='KANNADA'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa2=$row["marks"];
$avg=($sa2/30)*100;
if($avg>0 AND $avg<29)
       $gradesa2='C';
       else if($avg>=30 AND $avg<=49)
        $gradesa2='B';
       else if($avg>=50 AND $avg<=69)
       $gradesa2='B+';
      else if($avg>=70 AND $avg<=89)
       $gradesa2='A';
      else if($avg>=90 AND $avg<=100)
      $gradesa2='A+';

}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='KANNADA'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s2_total=$row["s2_total"];
$avg=($s2_total/50)*100;
if($avg>0 AND $avg<29)
       $gradet2='C';
       else if($avg>=30 AND $avg<=49)
        $gradet2='B';
       else if($avg>=50 AND $avg<=69)
       $gradet2='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet2='A';
      else if($avg>=90 AND $avg<=100)
      $gradet2='A+';

}
$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='KANNADA'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$total=$row["total"];
}
$sql="select * from test_total where addno=$addno and sub_name='KANNADA'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $kantotal=$row["total"];
       if($kantotal>=0 AND $kantotal<=29)
       $kangrade='C';
       else if($kantotal>=30 AND $kantotal<=49)
        $kangrade='B';
       else if($kantotal>=50 AND $kantotal<=69)
       $kangrade='B+';
      else if($kantotal>=70 AND $kantotal<=89)
       $kangrade='A';
      else if($kantotal>=90 AND $kantotal<=100)
      $kangrade='A+';
 }





                  $pdf->Cell(35,10,'KANNADA',1,0,'C');
		$pdf->Cell(13,10,$fa1,1,0,'C');
$pdf->Cell(7,10,$grade1,1,0,'C');

		$pdf->Cell(13,10,$fa2,1,0,'C');
$pdf->Cell(7,10,$grade2,1,0,'C');
		$pdf->Cell(13,10,$sa1,1,0,'C');
$pdf->Cell(7,10,$grade11,1,0,'C');		
		$pdf->Cell(23,10,$s1_total,1,0,'C');
$pdf->Cell(7,10,$gradet1,1,0,'C');
		$pdf->Cell(13,10,$fa3,1,0,'C');
$pdf->Cell(7,10,$grade3,1,0,'C');
		$pdf->Cell(13,10,$fa4,1,0,'C');
$pdf->Cell(7,10,$grade4,1,0,'C');
                                   $pdf->Cell(13,10,$sa2,1,0,'C');
$pdf->Cell(7,10,$gradesa2,1,0,'C');
		$pdf->Cell(23,10,$s2_total,1,0,'C');
$pdf->Cell(7,10,$gradet2,1,0,'C');
		$pdf->Cell(42,10,$total,1,0,'C');		
		$pdf->Cell(20,10,$kangrade,1,1,'C');

//*********english marks***********//

$sql = "SELECT * FROM test1 WHERE addno=$addno and sub_name='ENGLISH'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa1=$row["fa1"];
$avg=($fa1/10)*100;
if($avg>=0 AND $avg<=29)
       $grade1='C';
       else if($avg>=30 AND $avg<=49)
        $grade1='B';
       else if($avg>=50 AND $avg<=69)
       $grade1='B+';
      else if($avg>=70 AND $avg<=89)
       $grade1='A';
      else if($avg>=90 AND $avg<=100)
      $grade1='A+';

}
$sql = "SELECT * FROM test2 WHERE addno=$addno and sub_name='ENGLISH'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
$avg=($fa2/10)*100;
if($avg>0 AND $avg<29)
       if($avg>=0 AND $avg<=29)
       $grade2='C';
       else if($avg>=30 AND $avg<=49)
        $grade2='B';
       else if($avg>=50 AND $avg<=69)
       $grade2='B+';
      else if($avg>=70 AND $avg<=89)
       $grade2='A';
      else if($avg>=90 AND $avg<=100)
      $grade2='A+';

}
$sql = "SELECT * FROM sa1 WHERE addno=$addno and sub_name='ENGLISH'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa1=$row["marks"];
$avg=($sa1/30)*100;
if($avg>=0 AND $avg<=29)
       $grade11='C';
       else if($avg>=30 AND $avg<=49)
        $grade11='B';
       else if($avg>=50 AND $avg<=69)
       $grade11='B+';
      else if($avg>=70 AND $avg<=89)
       $grade11='A';
      else if($avg>=90 AND $avg<=100)
      $grade11='A+';

}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='ENGLISH'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s1_total=$row["s1_total"];
$avg=($s1_total/50)*100;
if($avg>=0 AND $avg<=29)
       $gradet1='C';
       else if($avg>=30 AND $avg<=49)
        $gradet1='B';
       else if($avg>=50 AND $avg<=69)
       $gradet1='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet1='A';
      else if($avg>=90 AND $avg<=100)
      $gradet1='A+';

}

$sql = "SELECT * FROM test3 WHERE addno=$addno and sub_name='ENGLISH'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa3=$row["fa3"];
$avg=($fa3/10)*100;
if($avg>=0 AND $avg<=29)
       $grade3='C';
       else if($avg>=30 AND $avg<=49)
        $grade3='B';
       else if($avg>=50 AND $avg<=69)
       $grade3='B+';
      else if($avg>=70 AND $avg<=89)
       $grade3='A';
      else if($avg>=90 AND $avg<=100)
      $grade3='A+';

}

$sql = "SELECT * FROM test4 WHERE addno=$addno and sub_name='ENGLISH'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
$avg=($fa4/10)*100;
if($avg>=0 AND $avg<=29)
       $grade4='C';
       else if($avg>=30 AND $avg<=49)
        $grade4='B';
       else if($avg>=50 AND $avg<=69)
       $grade4='B+';
      else if($avg>=70 AND $avg<=89)
       $grade4='A';
      else if($avg>=90 AND $avg<=100)
      $grade4='A+';

}
$sql = "SELECT * FROM sa2 WHERE addno=$addno and sub_name='ENGLISH'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa2=$row["marks"];
$avg=($sa2/30)*100;
if($avg>=0 AND $avg<=29)
       $grade12='C';
       else if($avg>=30 AND $avg<=49)
        $grade12='B';
       else if($avg>=50 AND $avg<=69)
       $grade12='B+';
      else if($avg>=70 AND $avg<=89)
       $grade12='A';
      else if($avg>=90 AND $avg<=100)
      $grade12='A+';

}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='ENGLISH'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s2_total=$row["s2_total"];
$avg=($s2_total/50)*100;
if($avg>=0 AND $avg<=29)
       $gradet2='C';
       else if($avg>=30 AND $avg<=49)
        $gradet2='B';
       else if($avg>=50 AND $avg<=69)
       $gradet2='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet2='A';
      else if($avg>=90 AND $avg<=100)
      $gradet2='A+';

}
$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='ENGLISH'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$total=$row["total"];
}
$sql="select * from test_total where addno=$addno and sub_name='ENGLISH'";
$result = $conn->query($sql);
if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $kantotal=$row["total"];
       if($kantotal>=0 AND $kantotal<=29)
       $grade='C';
       else if($kantotal>=30 AND $kantotal<=49)
        $grade='B';
       else if($kantotal>=50 AND $kantotal<=69)
       $grade='B+';
      else if($kantotal>=70 AND $kantotal<=89)
       $grade='A';
      else if($kantotal>=90 AND $kantotal<=100)
      $grade='A+';
 }





                  $pdf->Cell(35,10,'ENGLISH',1,0,'C');
		$pdf->Cell(13,10,$fa1,1,0,'C');
$pdf->Cell(7,10,$grade1,1,0,'C');
		$pdf->Cell(13,10,$fa2,1,0,'C');
$pdf->Cell(7,10,$grade2,1,0,'C');
		$pdf->Cell(13,10,$sa1,1,0,'C');	
$pdf->Cell(7,10,$grade11,1,0,'C');	
		$pdf->Cell(23,10,$s1_total,1,0,'C');
$pdf->Cell(7,10,$gradet1,1,0,'C');
		$pdf->Cell(13,10,$fa3,1,0,'C');
$pdf->Cell(7,10,$grade3,1,0,'C');
		$pdf->Cell(13,10,$fa4,1,0,'C');
$pdf->Cell(7,10,$grade4,1,0,'C');
                                   $pdf->Cell(13,10,$sa2,1,0,'C');
$pdf->Cell(7,10,$grade12,1,0,'C');
		$pdf->Cell(23,10,$s2_total,1,0,'C');
$pdf->Cell(7,10,$gradet2,1,0,'C');
		$pdf->Cell(42,10,$total,1,0,'C');		
		$pdf->Cell(20,10,$grade,1,1,'C');

//**********HINDI*********//


$sql = "SELECT * FROM test1 WHERE addno=$addno and sub_name='HINDI'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa1=$row["fa1"];
$avg=($fa1/10)*100;
if($avg>=0 AND $avg<=29)
$grade1='C';
       else if($avg>=30 AND $avg<=49)
        $grade1='B';
       else if($avg>=50 AND $avg<=69)
       $grade1='B+';
      else if($avg>=70 AND $avg<=89)
       $grade1='A';
      else if($avg>=90 AND $avg<=100)
      $grade1='A+';


}
$sql = "SELECT * FROM test2 WHERE addno=$addno and sub_name='HINDI'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
$avg=($fa2/10)*100;
if($avg>=0 AND $avg<=29)
       $grade2='C';
       else if($avg>=30 AND $avg<=49)
        $grade2='B';
       else if($avg>=50 AND $avg<=69)
       $grade2='B+';
      else if($avg>=70 AND $avg<=89)
       $grade2='A';
      else if($avg>=90 AND $avg<=100)
      $grade2='A+';

}
$sql = "SELECT * FROM sa1 WHERE addno=$addno and sub_name='HINDI'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa1=$row["marks"];
$avg=($sa1/30)*100;
if($avg>=0 AND $avg<=29)
$grade11='C';
       else if($avg>=30 AND $avg<=49)
        $grade11='B';
       else if($avg>=50 AND $avg<=69)
       $grade11='B+';
      else if($avg>=70 AND $avg<=89)
       $grade11='A';
      else if($avg>=90 AND $avg<=100)
      $grade11='A+';

}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='HINDI'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s1_total=$row["s1_total"];
$avg=($s1_total/50)*100;
if($avg>=0 AND $avg<=29)
$gradet1='C';
       else if($avg>=30 AND $avg<=49)
        $gradet1='B';
       else if($avg>=50 AND $avg<=69)
       $gradet1='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet1='A';
      else if($avg>=90 AND $avg<=100)
      $gradet1='A+';

}

$sql = "SELECT * FROM test3 WHERE addno=$addno and sub_name='HINDI'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa3=$row["fa3"];
$avg=($fa3/10)*100;
if($avg>=0 AND $avg<=29)
$grade3='C';
       else if($avg>=30 AND $avg<=49)
        $grade3='B';
       else if($avg>=50 AND $avg<=69)
       $grade3='B+';
      else if($avg>=70 AND $avg<=89)
       $grade3='A';
      else if($avg>=90 AND $avg<=100)
      $grade3='A+';

}

$sql = "SELECT * FROM test4 WHERE addno=$addno and sub_name='HINDI'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
$avg=($fa4/10)*100;
if($avg>=0 AND $avg<=29)
$grade4='C';
       else if($avg>=30 AND $avg<=49)
        $grade4='B';
       else if($avg>=50 AND $avg<=69)
       $grade4='B+';
      else if($avg>=70 AND $avg<=89)
       $grade4='A';
      else if($avg>=90 AND $avg<=100)
      $grade4='A+';

}
$sql = "SELECT * FROM sa2 WHERE addno=$addno and sub_name='HINDI'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa2=$row["marks"];
$avg=($sa2/30)*100;
if($avg>=0 AND $avg<=29)
$grade12='C';
       else if($avg>=30 AND $avg<=49)
        $grade12='B';
       else if($avg>=50 AND $avg<=69)
       $grade12='B+';
      else if($avg>=70 AND $avg<=89)
       $grade12='A';
      else if($avg>=90 AND $avg<=100)
      $grade12='A+';

}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='HINDI'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s2_total=$row["s2_total"];
$avg=($s2_total/50)*100;
if($avg>=0 AND $avg<=29)
$gradet2='C';
       else if($avg>=30 AND $avg<=49)
        $gradet2='B';
       else if($avg>=50 AND $avg<=69)
       $gradet2='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet2='A';
      else if($avg>=90 AND $avg<=100)
      $gradet2='A+';

}
$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='HINDI'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$total=$row["total"];
}
$sql="select * from test_total where addno=$addno and sub_name='HINDI'";
$result = $conn->query($sql);
if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $kantotal=$row["total"];
       if($kantotal>=0 AND $kantotal<=29)
       $grade='C';
       else if($kantotal>=30 AND $kantotal<=49)
        $grade='B';
       else if($kantotal>=50 AND $kantotal<=69)
       $grade='B+';
      else if($kantotal>=70 AND $kantotal<=89)
       $grade='A';
      else if($kantotal>=90 AND $kantotal<=100)
      $grade='A+';
 }





                  $pdf->Cell(35,10,'HINDI',1,0,'C');
		$pdf->Cell(13,10,$fa1,1,0,'C');
$pdf->Cell(7,10,$grade1,1,0,'C');
		$pdf->Cell(13,10,$fa2,1,0,'C');
$pdf->Cell(7,10,$grade2,1,0,'C');

		$pdf->Cell(13,10,$sa1,1,0,'C');	
$pdf->Cell(7,10,$grade11,1,0,'C');
	
		$pdf->Cell(23,10,$s1_total,1,0,'C');
$pdf->Cell(7,10,$gradet1,1,0,'C');

		$pdf->Cell(13,10,$fa3,1,0,'C');
$pdf->Cell(7,10,$grade3,1,0,'C');

		$pdf->Cell(13,10,$fa4,1,0,'C');
$pdf->Cell(7,10,$grade4,1,0,'C');

                                   $pdf->Cell(13,10,$sa2,1,0,'C');
$pdf->Cell(7,10,$grade12,1,0,'C');

		$pdf->Cell(23,10,$s2_total,1,0,'C');
$pdf->Cell(7,10,$gradet2,1,0,'C');

		$pdf->Cell(42,10,$total,1,0,'C');		
		$pdf->Cell(20,10,$grade,1,1,'C');


//********MATHS*******//


$sql = "SELECT * FROM test1 WHERE addno=$addno and sub_name='MATHS'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa1=$row["fa1"];
$avg=($fa1/10)*100;
if($avg>=0 AND $avg<=29)
$grade1='C';
       else if($avg>=30 AND $avg<=49)
        $grade1='B';
       else if($avg>=50 AND $avg<=69)
       $grade1='B+';
      else if($avg>=70 AND $avg<=89)
       $grade1='A';
      else if($avg>=90 AND $avg<=100)
      $grade1='A+';

}
$sql = "SELECT * FROM test2 WHERE addno=$addno and sub_name='MATHS'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
$avg=($fa2/10)*100;
if($avg>=0 AND $avg<=29)
$grade2='C';
       else if($avg>=30 AND $avg<=49)
        $grade2='B';
       else if($avg>=50 AND $avg<=69)
       $grade2='B+';
      else if($avg>=70 AND $avg<=89)
       $grade2='A';
      else if($avg>=90 AND $avg<=100)
      $grade2='A+';
}
$sql = "SELECT * FROM sa1 WHERE addno=$addno and sub_name='MATHS'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa1=$row["marks"];
$avg=($sa1/30)*100;
if($avg>=0 AND $avg<=29)
$grade11='C';
       else if($avg>=30 AND $avg<=49)
        $grade11='B';
       else if($avg>=50 AND $avg<=69)
       $grade11='B+';
      else if($avg>=70 AND $avg<=89)
       $grade11='A';
      else if($avg>=90 AND $avg<=100)
      $grade11='A+';
}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='MATHS'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s1_total=$row["s1_total"];
$avg=($s1_total/50)*100;
if($avg>=0 AND $avg<=29)
$gradet1='C';
       else if($avg>=30 AND $avg<=49)
        $gradet1='B';
       else if($avg>=50 AND $avg<=69)
       $gradet1='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet1='A';
      else if($avg>=90 AND $avg<=100)
      $gradet1='A+';
}

$sql = "SELECT * FROM test3 WHERE addno=$addno and sub_name='MATHS'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa3=$row["fa3"];
$avg=($fa3/10)*100;
if($avg>=0 AND $avg<=29)
$grade3='C';
       else if($avg>=30 AND $avg<=49)
        $grade3='B';
       else if($avg>=50 AND $avg<=69)
       $grade3='B+';
      else if($avg>=70 AND $avg<=89)
       $grade3='A';
      else if($avg>=90 AND $avg<=100)
      $grade3='A+';
}

$sql = "SELECT * FROM test4 WHERE addno=$addno and sub_name='MATHS'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
$avg=($fa4/10)*100;
if($avg>=0 AND $avg<=29)
$grade4='C';
       else if($avg>=30 AND $avg<=49)
        $grade4='B';
       else if($avg>=50 AND $avg<=69)
       $grade4='B+';
      else if($avg>=70 AND $avg<=89)
       $grade4='A';
      else if($avg>=90 AND $avg<=100)
      $grade4='A+';
}
$sql = "SELECT * FROM sa2 WHERE addno=$addno and sub_name='MATHS'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa2=$row["marks"];
$avg=($sa2/30)*100;
if($avg>=0 AND $avg<=29)
$grade12='C';
       else if($avg>=30 AND $avg<=49)
        $grade12='B';
       else if($avg>=50 AND $avg<=69)
       $grade12='B+';
      else if($avg>=70 AND $avg<=89)
       $grade12='A';
      else if($avg>=90 AND $avg<=100)
      $grade12='A+';
}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='MATHS'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s2_total=$row["s2_total"];
$avg=($s2_total/50)*100;
if($avg>=0 AND $avg<=29)
$gradet2='C';
       else if($avg>=30 AND $avg<=49)
        $gradet2='B';
       else if($avg>=50 AND $avg<=69)
       $gradet2='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet2='A';
      else if($avg>=90 AND $avg<=100)
      $gradet2='A+';
}
$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='MATHS'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$total=$row["total"];
}
$sql="select * from test_total where addno=$addno and sub_name='MATHS'";
$result = $conn->query($sql);
if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $kantotal=$row["total"];
       if($kantotal>=0 AND $kantotal<=29)
       $grade='C';
       else if($kantotal>=30 AND $kantotal<=49)
        $grade='B';
       else if($kantotal>=50 AND $kantotal<=69)
       $grade='B+';
      else if($kantotal>=70 AND $kantotal<=89)
       $grade='A';
      else if($kantotal>=90 AND $kantotal<=100)
      $grade='A+';
 }





$pdf->SetFont('Arial','',12);
                  $pdf->Cell(35,10,'MATHEMATICS',1,0,'C');
$pdf->SetFont('Arial','',12.5);
		$pdf->Cell(13,10,$fa1,1,0,'C');
$pdf->Cell(7,10,$grade1,1,0,'C');
		$pdf->Cell(13,10,$fa2,1,0,'C');
$pdf->Cell(7,10,$grade2,1,0,'C');

		$pdf->Cell(13,10,$sa1,1,0,'C');	
$pdf->Cell(7,10,$grade11,1,0,'C');
	
		$pdf->Cell(23,10,$s1_total,1,0,'C');
$pdf->Cell(7,10,$gradet1,1,0,'C');

		$pdf->Cell(13,10,$fa3,1,0,'C');
$pdf->Cell(7,10,$grade3,1,0,'C');

		$pdf->Cell(13,10,$fa4,1,0,'C');
$pdf->Cell(7,10,$grade4,1,0,'C');

                                   $pdf->Cell(13,10,$sa2,1,0,'C');
$pdf->Cell(7,10,$grade12,1,0,'C');

		$pdf->Cell(23,10,$s2_total,1,0,'C');
$pdf->Cell(7,10,$gradet2,1,0,'C');

		$pdf->Cell(42,10,$total,1,0,'C');		
		$pdf->Cell(20,10,$grade,1,1,'C');


//**********SCIENCE********//


$sql = "SELECT * FROM test1 WHERE addno=$addno and sub_name='SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa1=$row["fa1"];
$avg=($fa1/10)*100;
if($avg>=0 AND $avg<=29)
$grade1='C';
       else if($avg>=30 AND $avg<=49)
        $grade1='B';
       else if($avg>=50 AND $avg<=69)
       $grade1='B+';
      else if($avg>=70 AND $avg<=89)
       $grade1='A';
      else if($avg>=90 AND $avg<=100)
      $grade1='A+';

}
$sql = "SELECT * FROM test2 WHERE addno=$addno and sub_name='SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
$avg=($fa2/10)*100;
if($avg>=0 AND $avg<=29)
$grade2='C';
       else if($avg>=30 AND $avg<=49)
        $grade2='B';
       else if($avg>=50 AND $avg<=69)
       $grade2='B+';
      else if($avg>=70 AND $avg<=89)
       $grade2='A';
      else if($avg>=90 AND $avg<=100)
      $grade2='A+';

}
$sql = "SELECT * FROM sa1 WHERE addno=$addno and sub_name='SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa1=$row["marks"];
$avg=($sa1/30)*100;
if($avg>=0 AND $avg<=29)
$grade11='C';
       else if($avg>=30 AND $avg<=49)
        $grade11='B';
       else if($avg>=50 AND $avg<=69)
       $grade11='B+';
      else if($avg>=70 AND $avg<=89)
       $grade11='A';
      else if($avg>=90 AND $avg<=100)
      $grade11='A+';

}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s1_total=$row["s1_total"];
$avg=($s1_total/50)*100;
if($avg>=0 AND $avg<=29)
$gradet1='C';
       else if($avg>=30 AND $avg<=49)
        $gradet1='B';
       else if($avg>=50 AND $avg<=69)
       $gradet1='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet1='A';
      else if($avg>=90 AND $avg<=100)
      $gradet1='A+';

}

$sql = "SELECT * FROM test3 WHERE addno=$addno and sub_name='SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa3=$row["fa3"];
$avg=($fa3/10)*100;
if($avg>=0 AND $avg<=29)
$grade3='C';
       else if($avg>=30 AND $avg<=49)
        $grade3='B';
       else if($avg>=50 AND $avg<=69)
       $grade3='B+';
      else if($avg>=70 AND $avg<=89)
       $grade3='A';
      else if($avg>=90 AND $avg<=100)
      $grade3='A+';

}

$sql = "SELECT * FROM test4 WHERE addno=$addno and sub_name='SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
$avg=($fa4/10)*100;
if($avg>=0 AND $avg<=29)
$grade4='C';
       else if($avg>=30 AND $avg<=49)
        $grade4='B';
       else if($avg>=50 AND $avg<=69)
       $grade4='B+';
      else if($avg>=70 AND $avg<=89)
       $grade4='A';
      else if($avg>=90 AND $avg<=100)
      $grade4='A+';

}
$sql = "SELECT * FROM sa2 WHERE addno=$addno and sub_name='SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa2=$row["marks"];
$avg=($sa2/30)*100;
if($avg>=0 AND $avg<=29)
$grade12='C';
       else if($avg>=30 AND $avg<=49)
        $grade12='B';
       else if($avg>=50 AND $avg<=69)
       $grade12='B+';
      else if($avg>=70 AND $avg<=89)
       $grade12='A';
      else if($avg>=90 AND $avg<=100)
      $grade12='A+';

}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s2_total=$row["s2_total"];
$avg=($s2_total/50)*100;
if($avg>=0 AND $avg<=29)
$gradet2='C';
       else if($avg>=30 AND $avg<=49)
        $gradet2='B';
       else if($avg>=50 AND $avg<=69)
       $gradet2='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet2='A';
      else if($avg>=90 AND $avg<=100)
      $gradet2='A+';

}
$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$total=$row["total"];
}
$sql="select * from test_total where addno=$addno and sub_name='SCIENCE'";
$result = $conn->query($sql);
if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $kantotal=$row["total"];
       if($kantotal>=0 AND $kantotal<=29)
       $grade='C';
       else if($kantotal>=30 AND $kantotal<=49)
        $grade='B';
       else if($kantotal>=50 AND $kantotal<=69)
       $grade='B+';
      else if($kantotal>=70 AND $kantotal<=89)
       $grade='A';
      else if($kantotal>=90 AND $kantotal<=100)
      $grade='A+';
 }




$pdf->SetFont('Arial','',12.5);
                  $pdf->Cell(35,10,'SCIENCE',1,0,'C');
		$pdf->Cell(13,10,$fa1,1,0,'C');
$pdf->Cell(7,10,$grade1,1,0,'C');
		$pdf->Cell(13,10,$fa2,1,0,'C');
$pdf->Cell(7,10,$grade2,1,0,'C');

		$pdf->Cell(13,10,$sa1,1,0,'C');	
$pdf->Cell(7,10,$grade11,1,0,'C');
	
		$pdf->Cell(23,10,$s1_total,1,0,'C');
$pdf->Cell(7,10,$gradet1,1,0,'C');

		$pdf->Cell(13,10,$fa3,1,0,'C');
$pdf->Cell(7,10,$grade3,1,0,'C');

		$pdf->Cell(13,10,$fa4,1,0,'C');
$pdf->Cell(7,10,$grade4,1,0,'C');

                                   $pdf->Cell(13,10,$sa2,1,0,'C');
$pdf->Cell(7,10,$grade12,1,0,'C');

		$pdf->Cell(23,10,$s2_total,1,0,'C');
$pdf->Cell(7,10,$gradet2,1,0,'C');

		$pdf->Cell(42,10,$total,1,0,'C');		
		$pdf->Cell(20,10,$grade,1,1,'C');




//*********SOCIAL SCIENCE*********//




$sql = "SELECT * FROM test1 WHERE addno=$addno and sub_name='SOCIAL SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa1=$row["fa1"];
$avg=($fa1/10)*100;
if($avg>=0 AND $avg<=29)
$grade1='C';
       else if($avg>=30 AND $avg<=49)
        $grade1='B';
       else if($avg>=50 AND $avg<=69)
       $grade1='B+';
      else if($avg>=70 AND $avg<=89)
       $grade1='A';
      else if($avg>=90 AND $avg<=100)
      $grade1='A+';

}
$sql = "SELECT * FROM test2 WHERE addno=$addno and sub_name='SOCIAL SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
$avg=($fa2/10)*100;
if($avg>=0 AND $avg<=29)
$grade2='C';
       else if($avg>=30 AND $avg<=49)
        $grade2='B';
       else if($avg>=50 AND $avg<=69)
       $grade2='B+';
      else if($avg>=70 AND $avg<=89)
       $grade2='A';
      else if($avg>=90 AND $avg<=100)
      $grade2='A+';

}
$sql = "SELECT * FROM sa1 WHERE addno=$addno and sub_name='SOCIAL SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa1=$row["marks"];
$avg=($sa1/30)*100;
if($avg>=0 AND $avg<=29)
$grade11='C';
       else if($avg>=30 AND $avg<=49)
        $grade11='B';
       else if($avg>=50 AND $avg<=69)
       $grade11='B+';
      else if($avg>=70 AND $avg<=89)
       $grade11='A';
      else if($avg>=90 AND $avg<=100)
      $grade11='A+';

}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='SOCIAL SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s1_total=$row["s1_total"];
$avg=($s1_total/50)*100;
if($avg>=0 AND $avg<=29)
$gradet1='C';
       else if($avg>=30 AND $avg<=49)
        $gradet1='B';
       else if($avg>=50 AND $avg<=69)
       $gradet1='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet1='A';
      else if($avg>=90 AND $avg<=100)
      $gradet1='A+';

}

$sql = "SELECT * FROM test3 WHERE addno=$addno and sub_name='SOCIAL SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa3=$row["fa3"];
$avg=($fa3/10)*100;
if($avg>=0 AND $avg<=29)
$grade3='C';
       else if($avg>=30 AND $avg<=49)
        $grade3='B';
       else if($avg>=50 AND $avg<=69)
       $grade3='B+';
      else if($avg>=70 AND $avg<=89)
       $grade3='A';
      else if($avg>=90 AND $avg<=100)
      $grade3='A+';

}

$sql = "SELECT * FROM test4 WHERE addno=$addno and sub_name='SOCIAL SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
$avg=($fa4/10)*100;
if($avg>=0 AND $avg<=29)
$grade4='C';
       else if($avg>=30 AND $avg<=49)
        $grade4='B';
       else if($avg>=50 AND $avg<=69)
       $grade4='B+';
      else if($avg>=70 AND $avg<=89)
       $grade4='A';
      else if($avg>=90 AND $avg<=100)
      $grade4='A+';

}
$sql = "SELECT * FROM sa2 WHERE addno=$addno and sub_name='SOCIAL SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$sa2=$row["marks"];
$avg=($sa2/30)*100;
if($avg>=0 AND $avg<=29)
$grade12='C';
       else if($avg>=30 AND $avg<=49)
        $grade12='B';
       else if($avg>=50 AND $avg<=69)
       $grade12='B+';
      else if($avg>=70 AND $avg<=89)
       $grade12='A';
      else if($avg>=90 AND $avg<=100)
      $grade12='A+';

}

$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='SOCIAL SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$s2_total=$row["s2_total"];
$avg=($s2_total/50)*100;
if($avg>=0 AND $avg<=29)
$gradet2='C';
       else if($avg>=30 AND $avg<=49)
        $gradet2='B';
       else if($avg>=50 AND $avg<=69)
       $gradet2='B+';
      else if($avg>=70 AND $avg<=89)
       $gradet2='A';
      else if($avg>=90 AND $avg<=100)
      $gradet2='A+';

}
$sql = "SELECT * FROM test_total WHERE addno=$addno and sub_name='SOCIAL SCIENCE'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();
$total=$row["total"];
}
$sql="select * from test_total where addno=$addno and sub_name='SOCIAL SCIENCE'";
$result = $conn->query($sql);
if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $kantotal=$row["total"];
       if($kantotal>=0 AND $kantotal<=29)
       $grade='C';
       else if($kantotal>=30 AND $kantotal<=49)
        $grade='B';
       else if($kantotal>=50 AND $kantotal<=69)
       $grade='B+';
      else if($kantotal>=70 AND $kantotal<=89)
       $grade='A';
      else if($kantotal>=90 AND $kantotal<=100)
      $grade='A+';
 }




$pdf->SetFont('Arial','',12);
                  $pdf->Cell(35,10,'SOCIAL SCIENCE',1,0,'C');
$pdf->SetFont('Arial','',12.5);
		$pdf->Cell(13,10,$fa1,1,0,'C');
$pdf->Cell(7,10,$grade1,1,0,'C');
		$pdf->Cell(13,10,$fa2,1,0,'C');
$pdf->Cell(7,10,$grade2,1,0,'C');

		$pdf->Cell(13,10,$sa1,1,0,'C');	
$pdf->Cell(7,10,$grade11,1,0,'C');
	
		$pdf->Cell(23,10,$s1_total,1,0,'C');
$pdf->Cell(7,10,$gradet1,1,0,'C');

		$pdf->Cell(13,10,$fa3,1,0,'C');
$pdf->Cell(7,10,$grade3,1,0,'C');

		$pdf->Cell(13,10,$fa4,1,0,'C');
$pdf->Cell(7,10,$grade4,1,0,'C');

                                   $pdf->Cell(13,10,$sa2,1,0,'C');
$pdf->Cell(7,10,$grade12,1,0,'C');

		$pdf->Cell(23,10,$s2_total,1,0,'C');
$pdf->Cell(7,10,$gradet2,1,0,'C');
		$pdf->Cell(42,10,$total,1,0,'C');		
		$pdf->Cell(20,10,$grade,1,1,'C');

}



$pdf->SetFont('Arial','',12);	
$pdf->SetFont('Arial','',12.5);	
	
	
$html= "<br><br><br>                   
                                               								

										                                             
							                                                                                                       



                                                                                                                                                Signature of HM                                                    Signature of ClassTeacher ";
						                                                                                                    					                                                                                   

$pdf->WriteHTML($html);
	


}

else
{
echo "<script type='text/javascript'>alert('Admission Number Not Exists')</script>";  
echo "<script>setTimeout(\"location.href='prog_details.html';\",11);</script>";
}
			
	$pdf->Output();
	$conn->close();
?>