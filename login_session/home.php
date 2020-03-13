<?php
//this is a session 
//should be impedded on the header of every page

session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['username'])){
header('location:login_session.php');	
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login-Session</title>
	
	
	
	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<!-- css to design good GUI -->
	<style>
	* ul, li, h1, h2, h3, h4, 
h5, h6, pre, form, label, fieldset, input, p, blockquote, th, td {
	margin: 10px;
	padding: 10px;
}
	body{
	font-size:14px;
	background:#f4f4f4;
	color:#333;
	text-shadow:0px 0px 0px #fff;
	font-family: "Droid Sans", Helvetica, Arial, sans-serif;
	line-height: 1.125em; /* 18/16 */
	}
  
</style>

</head>
<body>

<h1 align="center">Welcome to Home<hl>

<p align="right"><a href="logout.php">LOG-OUT</a> 

<hr>


<p align="center">What is Session?
</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
<hr>
<h5 align="center">&copy;<?php echo date("Y");?> Copyright</h5>
</body>
</html>