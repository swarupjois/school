<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
</head>
<body>

<?php
 require("html2fpdf.php");
 $htmlFile = "form.php";
 $buffer = file_get_contents($htmlFile);
 $pdf = new HTML2FPDF('P', 'mm', 'Letter');
 $pdf->AddPage('L','A4');
 $pdf->WriteHTML($buffer); 
$pdf->Output('test.pdf', 'F'); 
?>
</body>
</html>