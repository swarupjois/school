

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

 <html xmlns="http://www.w3.org/1999/xhtml">
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Webpage to MS-Word file</title> 
</head> 

<body>
 <fieldset style="background-color:#666; height:200px; padding:20px;">
 <center>
 <form method="post" action=" ">
 <p> Here we have to see about how to convert (or) save a current webpage as Microsoft word document format.
Most of the website willing to provide their webpages in MS-Word format for their user.Most of the application sites, 
Government sites are made their MS Word file from current webpage.First of all previous methods used for conversion of Webpage as MS-Word Documents are
 1.There is toolkit using for conversion of Webpage into MS-Word.
 2.By storing the webpage content in MS-word format and by clicking submit button they word has to be download from database. 
Here is simple method used to convert as MS-Word from Webpage by adding two header file lines with in application concept. 
</p>
 <input type="submit" name="submit" />
 </form>
 </center> 
</fieldset> 
<?php
 if(isset($_POST['submit'])) 
{
 header("Content-type: application/vnd.ms-word");
 header("Content-Disposition: attachment; Filename=SaveAsWordDoc.doc"); 
} 
?>