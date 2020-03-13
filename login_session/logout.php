<?php
session_start();//to start session
session_destroy();//to destroy session variable
//unset($_SESSION["id"]);
unset($_SESSION["username"]);
//unset($_SESSION["usertype"]);
header("location:login_session.php");
?>