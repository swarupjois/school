

<?php
$name=$_POST["n1"];



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
echo "<center><h1><b>STUDY CERTIFICATE</b></h1></center>";


$sql = "SELECT * FROM student WHERE name='$name' ";

$result = $conn->query($sql);

if ($result->num_rows > 0)
 {
$row = $result->fetch_assoc();

   echo "<pre>                                                                                                                                               Date:<u>".date("d/m/Y")."</u></pre>";
    echo "<p>This is certify that Sri/Kum <u><b>".$row["name"]."</b></u> s/o  <u><b>".$row["father_name"]."
        </b></u> has studied from <u><b>".$row["class"]."</b></u>th standard to<u><b> ".$row["studied_till"]."</b></u> th standard
                       in our Institution from <u><b>".$row["joining_date"]."</b></u> to <u><b> ".$row["leaving_date"]." </b></u> acdemic years.
                       He/She belongs to <u><b>".$row["caste"]."</b></u> caste and mother tongue of the candidate <u><b>".$row["mother_tongue"]."</b></u> 
                       as per the Admission Register of the Institution.</p>";

echo "<pre>                    This above details are true and correct to the best of my knowledge.
                                               								

										Signature of Head of the Institution
										
										       (name in block letters)


						
							COUNTER SIGNED BY ME


						Address,Seal & Office,Telephone Number
						of the Block Educational Officer/DDPI</pre>";

     
}



$conn->close();
?>



</body>
</html>



