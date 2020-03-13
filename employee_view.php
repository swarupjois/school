<HTML>
<head></head>
<BODY bgcolor="yellow">
<a href="employee_details.html"><IMG SRC="images-1.jpeg" width="50" height="50"/></a>
<a href="home.html"><img src="home_button.png"  width="50" height="50"/></a>
<a href="logout.php"><img src="logout.jpeg"  width="50" height="50"/></a>
</body>
</html>

<?php
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
echo "<center><h1><b>EMPLOYEE DETAILS</b></h1></center>";


$sql = "SELECT * FROM employee ORDER BY empid";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
    echo "<center><table border=1><tr><th>EMP ID</th><th>NAME</th><th>DOB</th><th>DATE OF JOIN</th><th>DATE OF COMMING INTO THIS SCHOOL</th><th>PHONE NO.</th>
<th>KGID NO.</th><th>ADHAR NO.</th><th>EPIC NO.</th><th>PAN NO.</th><th>ADDRESS</th><th>TRAINNING DETAILS</th></tr></center>";


    // output data of each row
    while($row = $result->fetch_assoc())
 {
       echo "<center><tr><td>".$row["empid"]."</td><td>".$row["name"]."</td><td>".$row["date_of_birth"]." </td><td>".$row["date_of_join"]." </td>
<td>".$row["date_of_comming"]."</td><td>".$row["mobile"]."</td><td>".$row["kgid"]."</td> <td>".$row["adharno"]."</td>
 <td>".$row["epic_no"]."</td>
 <td>".$row["pan_no"]."</td>
 <td>".$row["address"]."</td>
<td>".$row["training_details"]." </td>
</tr></center>";
    
}
    echo "</table>";

}
else
{
echo "<center>record not found</center>";
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