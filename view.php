<HTML>
<head></head>
<BODY bgcolor="yellow">
<a href="student_details.html"><IMG SRC="images-1.jpeg" width="50" height="50"/></a>
<a href="home.html"><img src="home_button.png"  width="50" height="50"/></a>
<a href="logout.php"><img src="logout.jpeg"  width="50" height="50"/></a>
</body>
</html>

<?php
$addno=$_POST["n1"];



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SCHOOL";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
 {
    die("Connection failed: " . $conn->connect_error);
}
echo "<center><h1><b>STUDENT DETAILS</b></h1></center>";


$sql = "SELECT * FROM student order by name ";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
    echo "<center><table border=1><tr><th>ADD.NO</th><th>NAME</th><th>PLACE OF BIRTH</th><th>FATHER NAME</th><th>MOTHER NAME</th><th>DOB</th>
<th>ADDRESS</th><th>CURRENT CLASS</th><th>ADMITTED CLASS</th><th>ADHAR NO.</th><th>TC NO. DATE</th><th>BLOOD GROUP</th><th>PHONE NUMBER</th><th>CASTE</th><th>ADMISSION DATE</th><th>MOTHER TONGUE</th>
</tr></center>";


    // output data of each row
    while($row = $result->fetch_assoc())
 {
       echo "<center><tr><td>".$row["addno"]."</td><td>".$row["name"]."</td><td>".$row["pob"]." </td><td>".$row["father_name"]." </td>
<td>".$row["mother_name"]."</td><td>".$row["dob"]."</td><td>".$row["address"]."</td> <td>".$row["current_class"]."</td><td>".$row["admitted_class"]."</td>
<td>".$row["adhar_no"]."</td>
 <td>".$row["tc_no_date"]."</td>
 <td>".$row["blood_grp"]."</td>
<td>".$row["phone"]." </td><td>".$row["caste"]." </td><td>".$row["admission_date"]." </td><td>".$row["mother_tongue"]."</td>
</tr></center>";
    
}
    echo "</table>";

}
else
{
echo "record not found";
}



$conn->close();
?>
<html>
<head>
<title>details</title>
</head>
<body>
<br><center><a href="home.html"><h2><b><font color="blue">HOME </font></b></h2></a>
</center>
</body>
</html>