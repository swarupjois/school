<?php
//this is a php script for button login
//session start to store user variable
session_start();
if(isset($_POST['login'])){
	//retrieving username and password from the form and store into variables.
	$username=$_POST['username'];
	$password=$_POST['password'];
	//database connection
	$conn=mysql_connect("localhost","root"," ");
	//selecting database if available;
	$sql=mysql_select_db("Account",$conn);
	//conditon to check database connection
	if(!$sql){
		die("Database not selected.");
	}
	
	//checking username and password in the database
	$query=mysql_query("select * from user where username='$username' and password='$password'");
	//to count number of rows
	$count=mysql_num_rows($query);
	//fetching row values
	$row=mysql_fetch_array($query);
	if($count>0){
	//session to storing username
 	$_SESSION['username']=$row['username'];
 	//directing to the required page
 	?>
		<script>
		alert("Login Successfully");
		</script>
		<?php
 	header('location:home.php');
	}
	else{?>
		<script>
		alert("Wrong username or password");
		</script>
		<?php
	}
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
	body,form{
	font-size:14px;
	background:#f4f4f4;
	color:#333;
	text-shadow:0px 0px 0px #fff;
	font-family: "Droid Sans", Helvetica, Arial, sans-serif;
	line-height: 1.125em; /* 18/16 */
	}
  input[type="text"],
 input[type="password"]{
	border: solid 1px #E5E5E5;
	background: #FFFFFF;
	margin: 5px 30px 0px 30px;
	padding: 9px;
	display:block;
	font-size:16px;
	width:76%;
     background:#feffef;
}
table
{
    border:0;
    background:#f5f9f4;
    font-family:verdana,sans-serif;
    font-size:1.1em;
    margin-left:auto;
    margin-right:auto;
    text-align:center;
 }
label{
	display: block;
	text-transform: uppercase;
	color: #2a2e36;
	margin: 0 0 0.3125em 0;
	
}


</style>

</head>
<body>
<form type="text" method="post" action="" id="login-form" autocomplete="off">

<h1><p align=center>Simple Login Form Using Session</h1>
<hr>
<table>
<tr><td></td></tr>
<tr> 
<td><label>UserName:</label></td><td><input type="text" name="username" placeholder="Enter userName" size=50 required /></td>

</tr>
<tr>
<td><label>Password:</label></td><td><input type="password" name="password" placeholder="Enter Password" size=50 required/></td>
</tr>
<tr>
<p align="center"><td ><input type="submit" name="login" value="LOG IN"/></td>
</tr>
</table>

</form>
<hr>
<p align="center">&copy;<?php echo date('Y');?> Copyright  
</body>
</html>
