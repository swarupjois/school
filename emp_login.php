<?php
session_start();

$user=$_POST["user1"];

$pass=$_POST["pass1"];



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



$sql = "SELECT username,password FROM admin where  password='$pass' and username='$user'";

$result = $conn->query($sql);

//$result = $mysqli->query($sql);

while($row = $result->fetch_object())
{
$key1=$row->username;
$key2=$row->password;
}
        
 if($key2 == $pass && $key1 == $user)
    {

   header( 'Location: home.html' ) ;


} 

else
{

echo "<script type='text/javascript'>alert('Invalid Username/Password')</script>";
echo "<script>setTimeout(\"location.href='login.html';\",11);</script>";
}

unset($_SESSION["user1"]);  
unset($_SESSION["pass1"]);
$conn->close();
?>




  
       