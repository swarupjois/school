<?php
$addno=$_POST["addno"];
$name=$_POST["name"];
$dob=$_POST["dob"];
$pob=$_POST["pob"];
$father_name=$_POST["father"];
$mother_name=$_POST["mother"];
$caste=$_POST["caste"];
$address=$_POST["add"];
$adhar_no=$_POST["adhar"];
$pre_school=$_POST["psn"];
$tc_date=$_POST["tcdate"];
$admit_class=$_POST["aclass"];
$admit_date=$_POST["adate"];
$admit_year=$_POST["adate"];
$mobile=$_POST["mob"];
$bgrp=$_POST["bgrp"];
$nationality=$_POST["nationality"];
$mtongue=$_POST["tongue"];
$current_class=$_POST["aclass"];




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
if($mobile<999999999 || $mobile>10000000000)
{
//echo "<center><h1>Invalid Phone Number</h1></center>";
//echo "<center><h1>Mobile Number Must be 10digits</h1></center>";
echo "<script type='text/javascript'>alert('Invalid Mobile Number')</script>";
echo "<script>setTimeout(\"location.href='new_std.html';\",100);</script>";
}
else
{

$sql = "INSERT INTO student (addno,name,dob,pob,father_name,mother_name,caste,address,adhar_no,pre_school,tc_no_date,admitted_class,admission_date,admission_year,phone,blood_grp,nationality,mother_tongue,current_class)
VALUES ($addno,'$name','$dob','$pob','$father_name','$mother_name','$caste','$address','$adhar_no','$pre_school','$tc_date',$admit_class,'$admit_date','$admit_year',$mobile,'$bgrp','$nationality','$mtongue',$current_class)";


if ($conn->query($sql) === TRUE)
 {
    echo "<script type='text/javascript'>alert('New Student Added Successfully')</script>";
    echo "<script>setTimeout(\"location.href='std.html';\",100);</script>";

} 

else
{
    echo "<script type='text/javascript'>alert('Error in Connection...Try Again...')</script>";
    echo "<script>setTimeout(\"location.href='std.html';\",100);</script>";
}

$sql="select * from student";
$result=$conn->query($sql);
}

$conn->close();
?>
<html>
<head>
<title>home</title>
</head>
<body>
<a href="home.html"><center><h2>HOME</h2></center> </a>
ss</body>
</html>