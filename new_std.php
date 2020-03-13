<?php
$addno=$_POST["addno"];
$name=$_POST["name"];
$address=$_POST["add"];
$mobile=$_POST["mob"];
$dob=$_POST["dob"];
$bgrp=$_POST["bgrp"];
$nationality=$_POST["nationality"];
$caste=$_POST["caste"];
$jdate=$_POST["jdate"];
$mtongue=$_POST["tongue"];
$father_name=$_POST["father"];

$mother_name=$_POST["mother"];
$class=$_POST["jclass"];


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

$sql = "INSERT INTO student (addno,name,father_name,mother_name,dob,address,joining_class,phone,blood_grp,nationality,caste,joining_date,mother_tongue)
VALUES ($addno,'$name','$father_name','$mother_name','$dob','$address',$class,$mobile,'$bgrp','$nationality','$caste','$jdate','$mtongue')";


if ($conn->query($sql) === TRUE)
 {
    echo "<center><h1>New record created successfully</h1></center>";
} else
 {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql="select * from student";
$result=$conn->query($sql);

if ($result->num_rows > 0)
 {
 while($row = $result->fetch_assoc())
 {
       // echo "<tr><td>".$row["rr"]."</td><td>".$row["fname"]."</td><td>".$row["lname"]."</td><td>".$row["address"]." </td><td>".$row["mobile"]." </td><td>".$row["email"]." </td></tr>";
    }
    echo "</table>";
}
 else {
    echo "0 results";
}
}

$conn->close();
?>
<html>
<head>
<title>home</title>
</head>
<body>
<a href="home.html"><center><h2>HOME</h2></center> </a>
</body>
</html>