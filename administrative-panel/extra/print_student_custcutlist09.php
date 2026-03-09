<?php include('includes/config.php');
include("MPDF57/mpdf.php");
ob_start();
ob_clean();
$mpdf=new mPDF('','A4-L','','',10,10,27,-02,05,10);
$mpdf->useOnlyCoreFonts = true; // false is default
$mpdf->SetProtection(array('print'));
$mpdf->SetDisplayMode('fullpage');
$mpdf->zoom = 100;

$h = "5"; $hm = $h * 60; $ms = $hm * 60;
$Dated = gmdate("d-m-Y", time()+($ms));

$sql_exams="SELECT * FROM exams WHERE IsCurrent=1 ORDER BY Id DESC limit 1;";
$res_exams=mysql_query($sql_exams, $conn1);
$row_exams=mysql_fetch_array($res_exams);
$ExamId=$row_exams['Id'];
$ExamName=$row_exams['Name'];
$ExamFullName=$row_exams['FullName'];

$sql_centres="SELECT Name FROM centres WHERE Code=".$_REQUEST['CentreCode']."";
$res_centres=mysql_query($sql_centres, $conn1);
$row_centres=mysql_fetch_array($res_centres);

$first_number=$_REQUEST['first_number']-1;

$html.="";
$mpdf->SetHTMLHeader('<div style="font-family:sans-serif;"><table width="100%" style="font-family:sans-serif; text-align:center; align:center; font-size:9pt;">
<tr><td colspan="8" style="text-align:center; font-size:10pt; font-weight:bold;">AZAD JAMMU AND KASHMIR BOARD OF INTERMEDIATE AND SECONDARY EDUCATION MIRPUR</td></tr>
<tr><td colspan="8" style="text-align:center; font-size:10pt; font-weight:bold;">( SSC-I '.strtoupper($ExamFullName).' CUT LIST )</td></tr>
<tr><td colspan="8" style="text-align:left; font-weight:bold;"> CENTRE : '.strtoupper($row_centres['Name']).'</td></tr>
<tr>
	<td style="width:5%; font-weight:bold;">RollNo</td>
	<td style="width:10%; font-weight:bold;">BCN-SR</td>
	<td style="width:25%; font-weight:bold;">Candidate Name</td>
	<td style="width:5%; font-weight:bold;">Shift</td>
	<td style="width:5%; font-weight:bold;">GRP</td>
	<td style="width:5%; font-weight:bold;">GND</td>
	<td style="width:5%; font-weight:bold;">R/P</td>
	<td style="width:40%; font-weight:bold;">Subjects</td>
</tr>
</table></div> ','O');

$Counter=1;
$sql="SELECT Id, Name, FatherName, PicURL, Gender, PostalAddress, GroupId, IsRegular, Sub5SmName, Sub6SmName, Sub7SmName, Sub8SmName, AdmBatchNo, AdmBatchSr, ExamShift, ACentreName, RollNo FROM vwcutlist09 WHERE ACentreCode='".$_REQUEST['CentreCode']."' ORDER BY ACentreCode, ExamShift, RollNo ASC limit {$first_number}, 500";
$res=mysql_query($sql, $conn1);
while($row=mysql_fetch_array($res))
{

$html.='<div style="width:100%; float:left;">
		<table width="100%" border="0" align="center" style="font-family:sans-serif; text-align:center; border-collapse:collapse; font-size:8.5pt;">
			<tr>
				<td style="width:5%;"></td>
				<td style="width:10%;"></td>
				<td style="width:25%;"></td>
				<td style="width:5%;"></td>
				<td style="width:5%;"></td>
				<td style="width:5%;"></td>
				<td style="width:5%;"></td>
				<td style="width:5%;"></td>
				<td style="width:5%;"></td>
				<td style="width:5%;"></td>
				<td style="width:5%;"></td>
				<td style="width:20%;"></td>
			</tr>
			<tr>
				<td rowspan="3" style="border-top:1px solid #000; border-bottom:1px solid #000; border-left:1px solid #000;">'.$row['RollNo'].'</td>
				<td rowspan="2" style="border-top:1px solid #000;">'.$row['AdmBatchNo'].'-'.$row['AdmBatchSr'].'</td>
				<td style="border-top:1px solid #000; text-align:left;">'.$row['Name'].'</td>
				<td rowspan="2" style="border-top:1px solid #000;">'.$row['ExamShift'].'</td>
				<td rowspan="2" style="border-top:1px solid #000;">'.$row['GroupId'].'</td>
				<td rowspan="2" style="border-top:1px solid #000;">'.$row['Gender'].'</td>
				<td rowspan="2" style="border-top:1px solid #000;">'.$row['IsRegular'].'</td>
				<td rowspan="2" style="border-top:1px solid #000;">'.$row['Sub5SmName'].'</td>
				<td rowspan="2" style="border-top:1px solid #000;">'.$row['Sub6SmName'].'</td>
				<td rowspan="2" style="border-top:1px solid #000;">'.$row['Sub7SmName'].'</td>
				<td rowspan="2" style="border-top:1px solid #000;">'.$row['Sub8SmName'].'</td>
				<td rowspan="3" style="border-top:1px solid #000; border-bottom:1px solid #000; border-right:1px solid #000; text-align:center;"><img src="'.'../institution-panel/'.$row['PicURL'].'" style="height:90px; width:90px;"/></td>
			</tr>
			<tr>
				<td style="text-align:left;">'.$row['FatherName'].'</td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid #000; font-weight:bold;">Address: </td>
				<td colspan="9" style="border-bottom:1px solid #000; text-align:left;">'.strtoupper($row['PostalAddress']).'</td>
			</tr>
		</table>
		<div>';
		
		if($Counter % 6 == 0){ $html.='<pagebreak />'; $Counter=0; }
		$Counter++;
}

$mpdf->WriteHTML($html);
$mpdf->Output();
?>