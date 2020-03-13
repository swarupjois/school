<?php
$addno=$_POST["addno"];
$test=$_POST["test"];
$kannada=$_POST["kannada"];
$english=$_POST["english"];
$hindi=$_POST["hindi"];
$maths=$_POST["maths"];
$science=$_POST["science"];
$social=$_POST["social"];
$class=$_POST["class"];



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

if($test=='FA1')
{
$sql="INSERT INTO test1(addno,sub_name,fa1) values ($addno,'KANNADA',$kannada)";
$conn->query($sql);
$sql="INSERT INTO test1(addno,sub_name,fa1) values ($addno,'ENGLISH',$english)";
$conn->query($sql);
$sql="INSERT INTO test1(addno,sub_name,fa1) values ($addno,'HINDI',$hindi)";
$conn->query($sql);
$sql="INSERT INTO test1(addno,sub_name,fa1) values ($addno,'MATHS',$maths)";
$conn->query($sql);
$sql="INSERT INTO test1(addno,sub_name,fa1) values ($addno,'SCIENCE',$science)";
$conn->query($sql);
$sql="INSERT INTO test1(addno,sub_name,fa1) values ($addno,'SOCIAL SCIENCE',$social)";
$conn->query($sql);


$sql="select fa1 from test1 where sub_name='KANNADA' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa1=$row["fa1"];

}
$s1_total=$fa1;

//$total=$s1_total;

$sql="INSERT INTO test_total(addno,sub_name,s1_total) values ($addno,'KANNADA',$s1_total)";
$conn->query($sql);

$sql="select fa1 from test1 where sub_name='ENGLISH' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa1=$row["fa1"];

}
$s1_total=$fa1;
//$total=$s1e_total;
$sql="INSERT INTO test_total(addno,sub_name,s1_total) values ($addno,'ENGLISH',$s1_total)";
$conn->query($sql);

$sql="select fa1 from test1 where sub_name='HINDI' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa1=$row["fa1"];

}
$s1_total=$fa1;
//$total=$s1h_total;
$sql="INSERT INTO test_total(addno,sub_name,s1_total) values ($addno,'HINDI',$s1_total)";
$conn->query($sql);

$sql="select fa1 from test1 where sub_name='MATHS' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa1=$row["fa1"];

}
$s1_total=$fa1;
//$total=$s1m_total;
$sql="INSERT INTO test_total(addno,sub_name,s1_total) values ($addno,'MATHS',$s1_total)";
$conn->query($sql);


$sql="select fa1 from test1 where sub_name='SCIENCE' and addno=$addno ";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa1=$row["fa1"];

}
$s1_total=$fa1;
//$total=$s1s_total;
$sql="INSERT INTO test_total(addno,sub_name,s1_total) values ($addno,'SCIENCE',$s1_total)";
$conn->query($sql);

$sql="select fa1 from test1 where sub_name='SOCIAL SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa1=$row["fa1"];
}
$s1_total=$fa1;
//$total=$s1_total;
$sql="INSERT INTO test_total(addno,sub_name,s1_total) values ($addno,'SOCIAL SCIENCE',$s1_total)";
$conn->query($sql);




}


if($test=='FA2')
{
$sql="INSERT INTO test2(addno,sub_name,fa2) values ($addno,'KANNADA',$kannada)";
$conn->query($sql);
$sql="INSERT INTO test2(addno,sub_name,fa2) values ($addno,'ENGLISH',$english)";
$conn->query($sql);
$sql="INSERT INTO test2(addno,sub_name,fa2) values ($addno,'HINDI',$hindi)";
$conn->query($sql);
$sql="INSERT INTO test2(addno,sub_name,fa2) values ($addno,'MATHS',$maths)";
$conn->query($sql);
$sql="INSERT INTO test2(addno,sub_name,fa2) values ($addno,'SCIENCE',$science)";
$conn->query($sql);
$sql="INSERT INTO test2(addno,sub_name,fa2) values ($addno,'SOCIAL SCIENCE',$social)";
$conn->query($sql);



$sql="select fa1 from test1 where sub_name='KANNADA' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa1=$row["fa1"];

}


$sql="select fa2 from test2 where sub_name='KANNADA' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
}


$s1_total=$fa1+$fa2;
//$total=$s1k_total;
$sql="UPDATE test_total set s1_total=$s1_total where addno=$addno and sub_name='KANNADA'";
$conn->query($sql);



$sql="select fa1 from test1 where sub_name='ENGLISH' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa1=$row["fa1"];
}


$sql="select fa2 from test2 where sub_name='ENGLISH' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
}


$s1_total=$fa1+$fa2;
//$total=$s1e_total;
$sql="UPDATE test_total set s1_total=$s1_total where addno=$addno and sub_name='ENGLISH'";
$conn->query($sql);



$sql="select fa1 from test1 where sub_name='HINDI' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa1=$row["fa1"];

}


$sql="select fa2 from test2 where sub_name='HINDI' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
}


$s1_total=$fa1+$fa2;
//$total=$s1_total;
$sql="UPDATE test_total set s1_total=$s1_total where addno=$addno and sub_name='HINDI'";
$conn->query($sql);



$sql="select fa1 from test1 where sub_name='MATHS' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa1=$row["fa1"];
echo $fa1;
}


$sql="select fa2 from test2 where sub_name='MATHS' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
}


$s1_total=$fa1+$fa2;
//$total=$s1_total;
$sql="UPDATE test_total set s1_total=$s1_total where addno=$addno and sub_name='MATHS'";
$conn->query($sql);



$sql="select fa1 from test1 where sub_name='SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa1=$row["fa1"];

}


$sql="select fa2 from test2 where sub_name='SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
}


$s1_total=$fa1+$fa2;
//$total=$s1_toatl;
$sql="UPDATE test_total set s1_total=$s1_total where addno=$addno and sub_name='SCIENCE'";
$conn->query($sql);



$sql="select fa1 from test1 where sub_name='SOCIAL SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa1=$row["fa1"];
}


$sql="select fa2 from test2 where sub_name='SOCIAL SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
}


$s1_total=$fa1+$fa2;
//$total=$s1_total;
$sql="UPDATE test_total set s1_total=$s1_total where addno=$addno and sub_name='SOCIAL SCIENCE'";
$conn->query($sql);




}


if($test=='SA1')
{
$sql="INSERT INTO sa1(addno,sub_name,marks) values ($addno,'KANNADA',$kannada)";
$conn->query($sql);
$sql="INSERT INTO sa1(addno,sub_name,marks) values ($addno,'ENGLISH',$english)";
$conn->query($sql);
$sql="INSERT INTO sa1(addno,sub_name,marks) values ($addno,'HINDI',$hindi)";
$conn->query($sql);
$sql="INSERT INTO sa1(addno,sub_name,marks) values ($addno,'MATHS',$maths)";
$conn->query($sql);
$sql="INSERT INTO sa1(addno,sub_name,marks) values ($addno,'SCIENCE',$science)";
$conn->query($sql);
$sql="INSERT INTO sa1(addno,sub_name,marks) values ($addno,'SOCIAL SCIENCE',$social)";
$conn->query($sql);


$sql="select fa1 from test1 where sub_name='KANNADA' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa1=$row["fa1"];

}


$sql="select fa2 from test2 where sub_name='KANNADA' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
}

$sql="select marks from sa1 where sub_name='KANNADA' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$sa1=$row["marks"];
}

$s1_total=$fa1+$fa2+$sa1;
//$total=$s1k_total;
$sql="UPDATE test_total set s1_total=$s1_total where addno=$addno and sub_name='KANNADA'";
$conn->query($sql);



$sql="select fa1 from test1 where sub_name='ENGLISH' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa1=$row["fa1"];

}


$sql="select fa2 from test2 where sub_name='ENGLISH' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
}

$sql="select marks from sa1 where sub_name='ENGLISH' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$sa1=$row["marks"];
}

$s1_total=$fa1+$fa2+$sa1;
//$total=$s1_total;
$sql="UPDATE test_total set s1_total=$s1_total where addno=$addno and sub_name='ENGLISH'";
$conn->query($sql);



$sql="select fa1 from test1 where sub_name='HINDI' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa1=$row["fa1"];
echo $fa1;
}


$sql="select fa2 from test2 where sub_name='HINDI' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
}

$sql="select marks from sa1 where sub_name='HINDI' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$sa1=$row["marks"];
}

$s1_total=$fa1+$fa2+$sa1;

//$total=$s1_total;
$sql="UPDATE test_total set s1_total=$s1_total where addno=$addno and sub_name='HINDI'";
$conn->query($sql);


$sql="select fa1 from test1 where sub_name='MATHS' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa1=$row["fa1"];
echo $fa1;
}


$sql="select fa2 from test2 where sub_name='MATHS' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
}

$sql="select marks from sa1 where sub_name='MATHS' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$sa1=$row["marks"];
}

$s1_total=$fa1+$fa2+$sa1;

//$total=$s1_total;
$sql="UPDATE test_total set s1_total=$s1_total where addno=$addno and sub_name='MATHS'";
$conn->query($sql);



$sql="select fa1 from test1 where sub_name='SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa1=$row["fa1"];
echo $fa1;
}


$sql="select fa2 from test2 where sub_name='SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
}

$sql="select marks from sa1 where sub_name='SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$sa1=$row["marks"];
}

$s1_total=$fa1+$fa2+$sa1;

//$total=$s1_total;
$sql="UPDATE test_total set s1_total=$s1_total where addno=$addno and sub_name='SCIENCE'";
$conn->query($sql);



$sql="select fa1 from test1 where sub_name='SOCIAL SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa1=$row["fa1"];

}


$sql="select fa2 from test2 where sub_name='SOCIAL SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa2=$row["fa2"];
}

$sql="select marks from sa1 where sub_name='SOCIAL SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$sa1=$row["marks"];
}

$s1_total=$fa1+$fa2+$sa1;

//$total=$s1_total;
$sql="UPDATE test_total set s1_total=$s1_total where addno=$addno and sub_name='SOCIAL SCIENCE'";
$conn->query($sql);




}











if($test=='FA3')
{
$sql="INSERT INTO test3(addno,sub_name,fa3) values ($addno,'KANNADA',$kannada)";
$conn->query($sql);
$sql="INSERT INTO test3(addno,sub_name,fa3) values ($addno,'ENGLISH',$english)";
$conn->query($sql);
$sql="INSERT INTO test3(addno,sub_name,fa3) values ($addno,'HINDI',$hindi)";
$conn->query($sql);
$sql="INSERT INTO test3(addno,sub_name,fa3) values ($addno,'MATHS',$maths)";
$conn->query($sql);
$sql="INSERT INTO test3(addno,sub_name,fa3) values ($addno,'SCIENCE',$science)";
$conn->query($sql);
$sql="INSERT INTO test3(addno,sub_name,fa3) values ($addno,'SOCIAL SCIENCE',$social)";
$conn->query($sql);


$sql="select fa3 from test3 where sub_name='KANNADA' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa3=$row["fa3"];
}
$s2_total=$fa3;
//$total=$s1_total+$s2_total;
$sql="update test_total set s2_total=$s2_total where addno=$addno and sub_name='KANNADA'";

//$sql="INSERT INTO test_total(addno,sub_name,s1_total,s2_total) values ($addno,'KANNADA',$s1_total,$s2_total)";
$conn->query($sql);

$sql="select fa3 from test3 where sub_name='ENGLISH' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa3=$row["fa3"];

}
$s2_total=$fa3;
//$total=$s1_total+$s2_total;
$sql="update test_total set s2_total=$s2_total where addno=$addno and sub_name='ENGLISH'";

//$sql="INSERT INTO test_total(addno,sub_name,s1_total,s2_total,$total) values ($addno,'ENGLISH',$s1_total,$s2_total,$total)";
$conn->query($sql);

$sql="select fa3 from test3 where sub_name='HINDI' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa3=$row["fa3"];

}
$s2_total=$fa3;
//$total=$s1_total+$s2_total;

$sql="update test_total set s2_total=$s2_total where addno=$addno and sub_name='HINDI'";

//$sql="INSERT INTO test_total(addno,sub_name,s1_total,s2_total,$total) values ($addno,'HINDI',$s1_total,$s2_total,$total)";
$conn->query($sql);

$sql="select fa3 from test3 where sub_name='MATHS' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa3=$row["fa3"];

}
$s2_total=$fa3;
//$total=$s1_total+$s2_total;

$sql="update test_total set s2_total=$s2_total where addno=$addno and sub_name='MATHS'";

//$sql="INSERT INTO test_total(addno,sub_name,s1_total,s2_total,$total) values ($addno,'MATHS',$s1_total,$s2_total,$total)";
$conn->query($sql);



$sql="select fa3 from test3 where sub_name='SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa3=$row["fa3"];

}
$s2_total=$fa3;
//$total=$s1_total+$s2_total;
$sql="update test_total set s2_total=$s2_total where addno=$addno and sub_name='SCIENCE'";

//$sql="INSERT INTO test_total(addno,sub_name,s1_total,s2_total,$total) values ($addno,'SCIENCE',$s1_total,$s2_total,$total)";
$conn->query($sql);

$sql="select fa3 from test3 where sub_name='SOCIAL SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa3=$row["fa3"];

}
$s2_total=$fa3;
//$total=$s1_total+$s2_total;
$sql="update test_total set s2_total=$s2_total where addno=$addno and sub_name='SOCIAL SCIENCE'";

//$sql="INSERT INTO test_total(addno,sub_name,s1_total,s2_total,$total) values ($addno,'SOCIAL SCIENCE',$s1_total,$s2_total,$total)";
$conn->query($sql);
}



if($test=='FA4')
{
$sql="INSERT INTO test4(addno,sub_name,fa4) values ($addno,'KANNADA',$kannada)";
$conn->query($sql);
$sql="INSERT INTO test4(addno,sub_name,fa4) values ($addno,'ENGLISH',$english)";
$conn->query($sql);
$sql="INSERT INTO test4(addno,sub_name,fa4) values ($addno,'HINDI',$hindi)";
$conn->query($sql);
$sql="INSERT INTO test4(addno,sub_name,fa4) values ($addno,'MATHS',$maths)";
$conn->query($sql);
$sql="INSERT INTO test4(addno,sub_name,fa4) values ($addno,'SCIENCE',$science)";
$conn->query($sql);
$sql="INSERT INTO test4(addno,sub_name,fa4) values ($addno,'SOCIAL SCIENCE',$social)";
$conn->query($sql);



$sql="select fa3 from test3 where sub_name='KANNADA' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa3=$row["fa3"];
}


$sql="select fa4 from test4 where sub_name='KANNADA' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
}


$s2_total=$fa3+$fa4;
//$total=$s1_total+$s2k_total;

$sql="update test_total set s2_total=$s2_total where addno=$addno and sub_name='KANNADA'";
$conn->query($sql);



$sql="select fa3 from test3 where sub_name='ENGLISH' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa3=$row["fa3"];
}


$sql="select fa4 from test4 where sub_name='ENGLISH' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
}


$s2_total=$fa3+$fa4;
//$total=$s1_total+$s2_total;

$sql="update test_total set s2_total=$s2_total where addno=$addno and sub_name='ENGLISH'";
$conn->query($sql);



$sql="select fa3 from test3 where sub_name='HINDI' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa3=$row["fa3"];
}


$sql="select fa4 from test4 where sub_name='HINDI' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
}


$s2_total=$fa3+$fa4;
//$total=$s1_total+$s2_total;

$sql="update test_total set s2_total=$s2_total where addno=$addno and sub_name='HINDI'";
$conn->query($sql);



$sql="select fa3 from test3 where sub_name='MATHS' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa3=$row["fa3"];
}


$sql="select fa4 from test4 where sub_name='MATHS' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
}


$s2_total=$fa3+$fa4;
//$total=$s1_total+$s2_total;

$sql="update test_total set s2_total=$s2_total where addno=$addno and sub_name='MATHS'";
$conn->query($sql);



$sql="select fa3 from test3 where sub_name='SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa3=$row["fa3"];
}


$sql="select fa4 from test4 where sub_name='SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
}


$s2_total=$fa3+$fa4;
//$total=$s1_total+$s2_total;

$sql="update test_total set s2_total=$s2_total where addno=$addno and sub_name='SCIENCE'";
$conn->query($sql);




$sql="select fa3 from test3 where sub_name='SOCIAL SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa3=$row["fa3"];
}


$sql="select fa4 from test4 where sub_name='SOCIAL SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
}


$s2_total=$fa3+$fa4;
//$total=$s1_total+$s2_total;

$sql="update test_total set s2_total=$s2_total where addno=$addno and sub_name='SOCIAL SCIENCE'";
$conn->query($sql);





}


if($test=='SA2')
{
$sql="INSERT INTO sa2(addno,sub_name,marks) values ($addno,'KANNADA',$kannada)";
$conn->query($sql);
$sql="INSERT INTO sa2(addno,sub_name,marks) values ($addno,'ENGLISH',$english)";
$conn->query($sql);
$sql="INSERT INTO sa2(addno,sub_name,marks) values ($addno,'HINDI',$hindi)";
$conn->query($sql);
$sql="INSERT INTO sa2(addno,sub_name,marks) values ($addno,'MATHS',$maths)";
$conn->query($sql);
$sql="INSERT INTO sa2(addno,sub_name,marks) values ($addno,'SCIENCE',$science)";
$conn->query($sql);
$sql="INSERT INTO sa2(addno,sub_name,marks) values ($addno,'SOCIAL SCIENCE',$social)";
$conn->query($sql);


$sql="select fa3 from test3 where sub_name='KANNADA' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa3=$row["fa3"];

}


$sql="select fa4 from test4 where sub_name='KANNADA' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
}

$sql="select marks from sa2 where sub_name='KANNADA' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$sa2=$row["marks"];
}

$s2_total=$fa3+$fa4+$sa2;

//$total=$s1_total+$s2_total;

$sql="update test_total set s2_total=$s2_total where addno=$addno and sub_name='KANNADA'";
$conn->query($sql);



$sql="select fa3 from test3 where sub_name='ENGLISH' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa3=$row["fa3"];

}


$sql="select fa4 from test4 where sub_name='ENGLISH' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
}

$sql="select marks from sa2 where sub_name='ENGLISH' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$sa2=$row["marks"];
}

$s2_total=$fa3+$fa4+$sa2;

//$total=$s1_total+$s2_total;

$sql="update test_total set s2_total=$s2_total where addno=$addno and sub_name='ENGLISH'";
$conn->query($sql);



$sql="select fa3 from test3 where sub_name='HINDI' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa3=$row["fa3"];

}


$sql="select fa4 from test4 where sub_name='HINDI' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
}

$sql="select marks from sa2 where sub_name='HINDI' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$sa2=$row["marks"];
}

$s2_total=$fa3+$fa4+$sa2;

//$total=$s1_total+$s2_total;

$sql="update test_total set s2_total=$s2_total where addno=$addno and sub_name='HINDI'";
$conn->query($sql);




$sql="select fa3 from test3 where sub_name='MATHS' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa3=$row["fa3"];

}


$sql="select fa4 from test4 where sub_name='MATHS' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
}

$sql="select marks from sa2 where sub_name='MATHS' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$sa2=$row["marks"];
}

$s2_total=$fa3+$fa4+$sa2;

//$total=$s1_total+$s2_total;

$sql="update test_total set s2_total=$s2_total where addno=$addno and sub_name='MATHS'";
$conn->query($sql);




$sql="select fa3 from test3 where sub_name='SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa3=$row["fa3"];

}


$sql="select fa4 from test4 where sub_name='SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
}

$sql="select marks from sa2 where sub_name='SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$sa2=$row["marks"];
}

$s2_total=$fa3+$fa4+$sa2;

//$total=$s1_total+$s2_total;

$sql="update test_total set s2_total=$s2_total where addno=$addno and sub_name='SCIENCE'";
$conn->query($sql);




$sql="select fa3 from test3 where sub_name='SOCIAL SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa3=$row["fa3"];

}


$sql="select fa4 from test4 where sub_name='SOCIAL SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$fa4=$row["fa4"];
}

$sql="select marks from sa2 where sub_name='SOCIAL SCIENCE' and addno=$addno";
$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$sa2=$row["marks"];
}

$s2_total=$fa3+$fa4+$sa2;

//$total=$s1_total+$s2_total;

$sql="update test_total set s2_total=$s2_total where addno=$addno and sub_name='SOCIAL SCIENCE'";
$conn->query($sql);


}

$sql="select s1_total,s2_total from test_total where addno=$addno and sub_name='KANNADA'";

$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$s1=$row["s1_total"];
$s2=$row["s2_total"];
}
$total=$s1+$s2;
$sql="update test_total SET total=$total where addno=$addno and sub_name='KANNADA'";
$conn->query($sql);


$sql="select s1_total,s2_total from test_total where addno=$addno and sub_name='ENGLISH'";

$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$s1=$row["s1_total"];
$s2=$row["s2_total"];
}
$total=$s1+$s2;
$sql="update test_total SET total=$total where addno=$addno and sub_name='ENGLISH'";
$conn->query($sql);

$sql="select s1_total,s2_total from test_total where addno=$addno and sub_name='HINDI'";

$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$s1=$row["s1_total"];
$s2=$row["s2_total"];
}
$total=$s1+$s2;
$sql="update test_total SET total=$total where addno=$addno and sub_name='HINDI'";
$conn->query($sql);

$sql="select s1_total,s2_total from test_total where addno=$addno and sub_name='MATHS'";

$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$s1=$row["s1_total"];
$s2=$row["s2_total"];
}
$total=$s1+$s2;
$sql="update test_total SET total=$total where addno=$addno and sub_name='MATHS'";
$conn->query($sql);

$sql="select s1_total,s2_total from test_total where addno=$addno and sub_name='SCIENCE'";

$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$s1=$row["s1_total"];
$s2=$row["s2_total"];
}
$total=$s1+$s2;
$sql="update test_total SET total=$total where addno=$addno and sub_name='SCIENCE'";
$conn->query($sql);

$sql="select s1_total,s2_total from test_total where addno=$addno and sub_name='SOCIAL SCIENCE'";

$result=$conn->query($sql);
if ($result->num_rows > 0)
{
$row = $result->fetch_assoc();
$s1=$row["s1_total"];
$s2=$row["s2_total"];
}
$total=$s1+$s2;
$sql="update test_total SET total=$total where addno=$addno and sub_name='SOCIAL SCIENCE'";
$conn->query($sql);






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