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
class PDF extends FPDF
{
var $B;
var $I;
var $U;
var $HREF;

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

$pdf = new PDF();
$pdf->AddPage();

$pdf->SetFont('Arial','',20);
$pdf->Cell(0,10,"STUDY CERTIFICATE",0,0,'C');
$pdf->SetLeftMargin(15);
$pdf->SetRightMargin(15);


$pdf->SetFont('Times','',12);



$sql = "SELECT * FROM student WHERE name='$name' ";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();

$html="<pre><br><br><br><br>                                                                                                                                  Date:<u>".date("d/m/Y")."</u></pre>";
$pdf->WriteHTML($html);   
$html="<br><br><br><br>This is certify that Sri/Kum<b>"; 
$pdf->WriteHTML($html);
//$pdf->SetFont('Times','',20);
$pdf->Cell(0,5,$row["name"],B,0,'C');
$html="</b><br><br>S/o / D/o<b>";
$pdf->WriteHTML($html);
$pdf->Cell(133,5,$row["father_name"],B,0,'C');
$html="</b>has studied from<b><br><br>";
$pdf->WriteHTML($html);
$aclass=$row["admitted_class"];
$pdf->Cell(48,5,$aclass,B,0,'C');
if($aclass==1)
$html="st</b> standard to<b>";
else if($aclass==2)
$html="nd</b> standard to<b>";
else if($aclass==3)
$html="rd</b> standard to<b>";
else
$html="th</b> standard to<b>";
$pdf->WriteHTML($html);
$pdf->Cell(48,5,$row["leaving_class"],B,0,'C');
$html="th</b> standard in our Institution from<b><br><br>";
$pdf->WriteHTML($html);

$pdf->Cell(38,5,$row["admission_year"].' - ',B,0,'R');
$pdf->Cell(37,5,$row["admission_year"]+1,B,0,'L');
$html="</b>to<b>";
$pdf->WriteHTML($html);
$pdf->Cell(37,5,$row["leaving_year"]-1,B,0,'R');
$pdf->Cell(37,5,' - '.$row["leaving_year"],B,0,'L');
$html="</b>acdemic years.<br><br>";
$pdf->WriteHTML($html);
$html="He/She belongs to<b>";
$pdf->WriteHTML($html);
$pdf->Cell(94,5,$row["caste"],B,0,'C');
$html="</b>caste and mother tongue of the<br><br>";
$pdf->WriteHTML($html);
$html="candidate is<b>";
$pdf->WriteHTML($html);
$pdf->Cell(70,5,$row["mother_tongue"],B,0,'C');
$html="</b>as per the Admission Register of the Institution.<br><br>";
$pdf->WriteHTML($html);



  

$pdf->SetFont('Times','',12);

$html= "<br><br><br>                   This above details are true and correct to the best of my knowledge.<br><br><br><br>
                                               								

										                                 Signature of Head of the Institution<br><br>
							                                                                                                         (name in block letters)<br><br><br><br><br><br>




						                                                                                                      Institution<br>
							                                                                                                             Seal<br><br><br><br><br><br><br><br> 


                                                            COUNTER SIGNED BY ME<br><br><br>


		








                                      Address,Seal & Office,Telephone Number<br>
		                                                    of the Block Educational Officer/DDPI";

$pdf->WriteHTML($html);




     
}
else
{

echo "<script type='text/javascript'>alert('Name Not Exists')</script>";  
echo "<script>setTimeout(\"location.href='study_certificate.html';\",11);</script>";
}





     

          

$pdf->Output();

$conn->close();
?>