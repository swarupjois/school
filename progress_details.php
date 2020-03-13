


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



$sql="select * from student where addno=$addno";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
    echo "<center><b>Student Name ".$row["name"]."<b></center><br>";
echo "<center><b>Class  ".$row["admitted_class"]."</b></center><br>";
}


$sql="select * from test1 where addno=$addno and sub_name='KANNADA'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $kan=$row["fa1"];
 }


$sql="select * from test1 where addno=$addno and sub_name='ENGLISH'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $eng=$row["fa1"];
 }

$sql="select * from test1 where addno=$addno and sub_name='HINDI'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $hin=$row["fa1"];
 }


$sql="select * from test1 where addno=$addno and sub_name='MATHS'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $mat=$row["fa1"];
 }


$sql="select * from test1 where addno=$addno and sub_name='SCIENCE'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $sci=$row["fa1"];
 }



$sql="select * from test1 where addno=$addno and sub_name='SOCIAL SCIENCE'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $ss=$row["fa1"];
 }



//2nd test marks

$sql="select * from test2 where addno=$addno and sub_name='KANNADA'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $kan2=$row["fa2"];
 }


$sql="select * from test2 where addno=$addno and sub_name='ENGLISH'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $eng2=$row["fa2"];
 }

$sql="select * from test2 where addno=$addno and sub_name='HINDI'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $hin2=$row["fa2"];
 }


$sql="select * from test2 where addno=$addno and sub_name='MATHS'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $mat2=$row["fa2"];
 }


$sql="select * from test2 where addno=$addno and sub_name='SCIENCE'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $sci2=$row["fa2"];
 }



$sql="select * from test2 where addno=$addno and sub_name='SOCIAL SCIENCE'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $ss2=$row["fa2"];
 }


//3rd test marks

$sql="select * from sa1 where addno=$addno and sub_name='KANNADA'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $kan3=$row["marks"];
 }


$sql="select * from sa1 where addno=$addno and sub_name='ENGLISH'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $eng3=$row["marks"];
 }

$sql="select * from sa1 where addno=$addno and sub_name='HINDI'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $hin3=$row["marks"];
 }


$sql="select * from sa1 where addno=$addno and sub_name='MATHS'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $mat3=$row["marks"];
 }


$sql="select * from sa1 where addno=$addno and sub_name='SCIENCE'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $sci3=$row["marks"];
 }



$sql="select * from sa1 where addno=$addno and sub_name='SOCIAL SCIENCE'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $ss3=$row["marks"];
 }


//total
$sql="select * from test_total where addno=$addno and sub_name='KANNADA'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $kan1_total=$row["s1_total"];
 }

$sql="select * from test_total where addno=$addno and sub_name='ENGLISH'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $eng1_total=$row["s1_total"];
 }

$sql="select * from test_total where addno=$addno and sub_name='HINDI'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $hin1_total=$row["s1_total"];
 }

$sql="select * from test_total where addno=$addno and sub_name='MATHS'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $mat1_total=$row["s1_total"];
 }

$sql="select * from test_total where addno=$addno and sub_name='SCIENCE'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $sci1_total=$row["s1_total"];
 }




$sql="select * from test_total where addno=$addno and sub_name='SOCIAL SCIENCE'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $ss1_total=$row["s1_total"];
 }




//******FA3********

$sql="select * from test3 where addno=$addno and sub_name='KANNADA'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $kannada3=$row["fa3"];
 }


$sql="select * from test3 where addno=$addno and sub_name='ENGLISH'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $english3=$row["fa3"];
 }

$sql="select * from test3 where addno=$addno and sub_name='HINDI'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $hindi3=$row["fa3"];
 }


$sql="select * from test3 where addno=$addno and sub_name='MATHS'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $maths3=$row["fa3"];
 }


$sql="select * from test3 where addno=$addno and sub_name='SCIENCE'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $science3=$row["fa3"];
 }



$sql="select * from test3 where addno=$addno and sub_name='SOCIAL SCIENCE'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $social3=$row["fa3"];
 }



//4th test marks

$sql="select * from test4 where addno=$addno and sub_name='KANNADA'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $kan4=$row["fa4"];
 }


$sql="select * from test4 where addno=$addno and sub_name='ENGLISH'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $eng4=$row["fa4"];
 }

$sql="select * from test4 where addno=$addno and sub_name='HINDI'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $hin4=$row["fa4"];
 }


$sql="select * from test4 where addno=$addno and sub_name='MATHS'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $mat4=$row["fa4"];
 }


$sql="select * from test4 where addno=$addno and sub_name='SCIENCE'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $sci4=$row["fa4"];
 }



$sql="select * from test4 where addno=$addno and sub_name='SOCIAL SCIENCE'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $ss4=$row["fa4"];
 }


//SA2 test marks

$sql="select * from sa2 where addno=$addno and sub_name='KANNADA'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $kan5=$row["marks"];
 }


$sql="select * from sa2 where addno=$addno and sub_name='ENGLISH'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $eng5=$row["marks"];
 }

$sql="select * from sa2 where addno=$addno and sub_name='HINDI'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $hin5=$row["marks"];
 }


$sql="select * from sa2 where addno=$addno and sub_name='MATHS'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $mat5=$row["marks"];
 }


$sql="select * from sa2 where addno=$addno and sub_name='SCIENCE'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $sci5=$row["marks"];
 }



$sql="select * from sa2 where addno=$addno and sub_name='SOCIAL SCIENCE'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $ss5=$row["marks"];
 }


//total
$sql="select * from test_total where addno=$addno and sub_name='KANNADA'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $kan2_total=$row["s2_total"];
 }

$sql="select * from test_total where addno=$addno and sub_name='ENGLISH'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $eng2_total=$row["s2_total"];
 }

$sql="select * from test_total where addno=$addno and sub_name='HINDI'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $hin2_total=$row["s2_total"];
 }

$sql="select * from test_total where addno=$addno and sub_name='MATHS'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $mat2_total=$row["s2_total"];
 }

$sql="select * from test_total where addno=$addno and sub_name='SCIENCE'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $sci2_total=$row["s2_total"];
 }

$sql="select * from test_total where addno=$addno and sub_name='SOCIAL SCIENCE'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $ss2_total=$row["s2_total"];
 }






//*******total*********

$sql="select * from test_total where addno=$addno and sub_name='KANNADA'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $kantotal=$row["total"];
       if($kantotal>0 AND $kantotal<29)
       $kangrade='C';
       else if($kantotal>30 AND $kantotal<49)
        $kangrade='B';
       else if($kantotal>50 AND $kantotal<69)
       $kangrade='B+';
      else if($kantotal>70 AND $kantotal<89)
       $kangrade='A';
      else if($kantotal>90 AND $kantotal<=100)
      $kantotal='A+';
 }

$sql="select * from test_total where addno=$addno and sub_name='ENGLISH'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $engtotal=$row["total"];
      if($engtotal>0 AND $engtotal<29)
       $enggrade='C';
       else if($engtotal>30 AND $engtotal<49)
        $enggrade='B';
       else if($engtotal>50 AND $engtotal<69)
       $enggrade='B+';
      else if($engtotal>70 AND $engtotal<89)
       $enggrade='A';
      else if($engtotal>90 AND $engtotal<=100)
      $engtotal='A+';
 }

$sql="select * from test_total where addno=$addno and sub_name='HINDI'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $hintotal=$row["total"];
if($hintotal>0 AND $hintotal<29)
       $hingrade='C';
       else if($hintotal>30 AND $hintotal<49)
        $hingrade='B';
       else if($hintotal>50 AND $hintotal<69)
       $hingrade='B+';
      else if($hintotal>70 AND $hintotal<89)
       $hingrade='A';
      else if($kantotal>90 AND $hintotal<=100)
      $hintotal='A+';
 }

$sql="select * from test_total where addno=$addno and sub_name='MATHS'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $mattotal=$row["total"];
if($mattotal>0 AND $mattotal<29)
       $matgrade='C';
       else if($hintotal>30 AND $mattotal<49)
        $matgrade='B';
       else if($mattotal>50 AND $mattotal<69)
       $matgrade='B+';
      else if($mattotal>70 AND $mattotal<89)
       $matgrade='A';
      else if($mattotal>90 AND $mattotal<=100)
      $mattotal='A+';

 }


$sql="select * from test_total where addno=$addno and sub_name='SCIENCE'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $scitotal=$row["total"];
if($scitotal>0 AND $scitotal<29)
       $scigrade='C';
       else if($scitotal>30 AND $scitotal<49)
        $scigrade='B';
       else if($scitotal>50 AND $scitotal<69)
       $scigrade='B+';
      else if($scitotal>70 AND $scitotal<89)
       $scigrade='A';
      else if($scitotal>90 AND $scitotal<=100)
      $scitotal='A+';

 }



$sql="select * from test_total where addno=$addno and sub_name='SOCIAL SCIENCE'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
     $row = $result->fetch_assoc();
      $sstotal=$row["total"];
if($sstotal>0 AND $sstotal<29)
       $ssgrade='C';
       else if($sstotal>30 AND $sstotal<49)
        $ssgrade='B';
       else if($sstotal>50 AND $sstotal<69)
       $ssgrade='B+';
      else if($sstotal>70 AND $sstotal<89)
       $ssgrade='A';
      else if($sstotal>90 AND $sstotal<=100)
      $sstotal='A+';

 }



echo "<br><br><br><center><table border=1>
<tr><th>Sub</th><th>FA1</th><th>FA2</th><th>SA1</th><th>S1_TOTAL</th><th>FA3</th><th>FA4</th><th>SA2</th><th>S2_TOTAL</th><th>TOTAL</th><th>GRADE</th></tr>
<tr><td>KANNADA</td><td>".$kan."</td><td>".$kan2."</td><td>".$kan3."</td><td>".$kan1_total."</td><td>".$kannada3."</td><td>".$kan4."</td><td>".$kan5."</td><td>".$kan2_total."</td><td>".$kantotal."</td><td>".$kangrade."</td></tr>
<tr><td>ENGLISH</td><td>".$eng."</td><td>".$eng2."</td><td>".$eng3."</td><td>".$eng1_total."</td><td>".$english3."</td><td>".$eng4."</td><td>".$eng5."</td><td>".$eng2_total."</td><td>".$engtotal."</td><td>".$enggrade."</td></tr>
<tr><td>HINDI</td><td>".$hin."</td><td>".$hin2."</td><td>".$hin3."</td><td>".$hin1_total."</td><td>".$hindi3."</td><td>".$hin4."</td><td>".$hin5."</td><td>".$hin2_total."</td><td>".$hintotal."</td><td>".$hingrade."</td></tr>
<tr><td>MATHS</td><td>".$mat."</td><td>".$mat2."</td><td>".$mat3."</td><td>".$mat1_total."</td><td>".$maths3."</td><td>".$mat4."</td><td>".$mat5."</td><td>".$mat2_total."</td><td>".$mattotal."</td><td>".$matgrade."</td></tr>
<tr><td>SCIENCE</td><td>".$sci."</td><td>".$sci2."</td><td>".$sci3."</td><td>".$sci1_total."</td><td>".$science3."</td><td>".$sci4."</td><td>".$sci5."</td><td>".$sci2_total."</td><td>".$scitotal."</td><td>".$scigrade."</td></tr>
<tr><td>SOCIAL SCIENCE</td><td>".$ss."</td><td>".$ss2."</td><td>".$ss3."</td><td>".$ss1_total."</td><td>".$social3."</td><td>".$ss4."</td><td>".$ss5."</td><td>".$ss2_total."</td><td>".$sstotal."</td><td>".$ssgrade."</td></tr> 
</table></center>";  
$conn->close();
?>
