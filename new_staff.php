<?php
$empid=$_POST["empid"];
$name=$_POST["name"];
$dob=$_POST["dob"];
$doj=$_POST["doj"];
$date_of_comming=$_POST["docmgschool"];
$kgid=$_POST["kgid"];
$adhar=$_POST["adhar"];
$epic=$_POST["epic"];
$pan=$_POST["pan"];
$address=$_POST["address"];
$traning_details=$_POST["td"];
$mobile=$_POST["mobile"];



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
echo "<script>setTimeout(\"location.href='new_employee.html';\",100);</script>";
}
else
{

$sql = "INSERT INTO employee (empid,name,date_of_birth,date_of_join,date_of_comming,mobile,kgid,adharno,epic_no,pan_no,address,training_details)
VALUES ('$empid','$name','$dob','$doj','$date_of_comming',$mobile,'$kgid','$adhar','$epic','$pan','$address','$traning_details')";


if ($conn->query($sql) === TRUE)
 {
    echo "<script type='text/javascript'>alert('New Staff Registered Successfully')</script>";
    echo "<script>setTimeout(\"location.href='new_employee.html';\",100);</script>";

} 

else
{
    echo "<script type='text/javascript'>alert('Error in Connection...Try Again...')</script>";
    echo "<script>setTimeout(\"location.href='new_employee.html';\",100);</script>";
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