<?php
$addno=$_POST["addno"];
$name=$_POST["name"];
$address=$_POST["add"];
$lclass=$_POST["lclass"];
$mobile=$_POST["mob"];
$dob=$_POST["dob"];
$bgrp=$_POST["bgrp"];
$nationality=$_POST["nationality"];
$caste=$_POST["caste"];
$ldate=$_POST["ldate"];
$mtongue=$_POST["tongue"];
$father_name=$_POST["father"];
$mother_name=$_POST["mother"];
$reason=$_POST["reason"];
$cclass=$_POST["cclass"];



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

if($mobile != "")
{
if($mobile<999999999 || $mobile>10000000000)
{
//echo "<center><h1>Invalid Phone Number</h1></center>";
//echo "<center><h1>Mobile Number Must be 10digits</h1></center>";
echo "<script type='text/javascript'>alert('Invalid Mobile Number')</script>";
echo "<script>setTimeout(\"location.href='new_std.html';\",100);</script>";
}
else
{
$sql = "UPDATE TABLE student SET phone=$mobile where addno=$addno";
if ($conn->query($sql) === TRUE)
 {
    echo "<script type='text/javascript'>alert('Updated Successfully')</script>";
echo "<script>setTimeout(\"location.href='std.html';\",100);</script>";

} 
else
 {
    echo "<script type='text/javascript'>alert('Error in Updation...Try Again...')</script>";
echo "<script>setTimeout(\"location.href='std.html';\",100);</script>";

}
}
}


if($name !="")
{

$sql = "UPDATE  student SET name='$name' where addno=$addno";


if ($conn->query($sql) == TRUE)
 {
    echo "<script type='text/javascript'>alert('Updated Successfully')</script>";
echo "<script>setTimeout(\"location.href='update.html';\",100);</script>";

} else
 {
    echo "<script type='text/javascript'>alert('Error in Updation...Try Again...')</script>";
echo "<script>setTimeout(\"location.href='update.html';\",100);</script>";

}
}


if($father_name !="")
{

$sql = "UPDATE TABLE student SET father_name='$father_name' WHERE addno=$addno";

if ($conn->query($sql) == TRUE)
 {
    echo "<script type='text/javascript'>alert('Updated Successfully')</script>";
echo "<script>setTimeout(\"location.href='std.html';\",100);</script>";

} else
 {
    echo "<script type='text/javascript'>alert('Error in Updation...Try Again...')</script>";
echo "<script>setTimeout(\"location.href='std.html';\",100);</script>";

}
}



if($mother_name !="")
{

$sql = "UPDATE TABLE student SET mother_name='$mother_name' WHERE addno=$addno";


if ($conn->query($sql) === TRUE)
 {
    echo "<script type='text/javascript'>alert('Updated Successfully')</script>";
echo "<script>setTimeout(\"location.href='std.html';\",100);</script>";

} else
 {
    echo "<script type='text/javascript'>alert('Error in Updation...Try Again...')</script>";
echo "<script>setTimeout(\"location.href='std.html';\",100);</script>";

}
}




if($address !="")
{

$sql = "UPDATE TABLE student SET address='$address' WHERE addno=$addno";


if ($conn->query($sql) === TRUE)
 {
    echo "<script type='text/javascript'>alert('Updated Successfully')</script>";
echo "<script>setTimeout(\"location.href='std.html';\",100);</script>";

} else
 {
    echo "<script type='text/javascript'>alert('Error in Updation...Try Again...')</script>";
echo "<script>setTimeout(\"location.href='std.html';\",100);</script>";

}
}


if($ldate !="")
{

$sql = "UPDATE  student SET leaving_date='$ldate',leaving_year='$ldate' WHERE addno='$addno'";



if($conn->query($sql)==TRUE)
{
    echo "<script type='text/javascript'>alert('Updated Successfully')</script>";
echo "<script>setTimeout(\"location.href='update.html';\",100);</script>";
}
 else
 {
    echo "<script type='text/javascript'>alert('Error in Updation...Try Again...')</script>";
echo "<script>setTimeout(\"location.href='update.html';\",100);</script>";

}
}

if($lclass !="")
{

$sql ="UPDATE  student SET leaving_class=$lclass WHERE addno='$addno'";

if($conn->query($sql)==TRUE)
{
 echo "<script type='text/javascript'>alert('Updated Successfully')</script>";
echo "<script>setTimeout(\"location.href='update.html';\",100);</script>";
}
 else
 {
    echo "<script type='text/javascript'>alert('Error in updation...Try Again...')</script>";
echo "<script>setTimeout(\"location.href='update.html';\",100);</script>";

}
}

if($cclass !="")
{

$sql ="UPDATE  student SET current_class=$cclass WHERE addno='$addno'";

if($conn->query($sql)==TRUE)
{
 echo "<script type='text/javascript'>alert('Updated Successfully')</script>";
echo "<script>setTimeout(\"location.href='update.html';\",100);</script>";
}
 else
 {
    echo "<script type='text/javascript'>alert('Error in updation...Try Again...')</script>";
echo "<script>setTimeout(\"location.href='update.html';\",100);</script>";

}
}


if($reason !="")
{

$sql ="UPDATE  student SET reason_leaving='$reason' WHERE addno='$addno'";

if($conn->query($sql)==TRUE)
{
 echo "<script type='text/javascript'>alert('Updated Successfully')</script>";
echo "<script>setTimeout(\"location.href='update.html';\",100);</script>";
}
 else
 {
    echo "<script type='text/javascript'>alert('Error in updation...Try Again...')</script>";
echo "<script>setTimeout(\"location.href='update.html';\",100);</script>";

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