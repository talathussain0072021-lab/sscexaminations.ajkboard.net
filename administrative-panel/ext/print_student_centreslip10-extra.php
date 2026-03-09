<?php include('includes/config.php');
include("MPDF57/mpdf.php");
ob_start();
ob_clean();
$mpdf=new mPDF('','A4','','',10,10,16,-02,05,10);
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

$html.="";
$mpdf->SetHTMLHeader('<div style="font-family:sans-serif;"><table width="100%" style="font-family:sans-serif; align:center;">
<tr><td style="text-align:center; font-size:10pt; font-weight:bold;">AZAD JAMMU AND KASHMIR BOARD OF INTERMEDIATE AND SECONDARY EDUCATION MIRPUR</td></tr>
<tr><td style="text-align:center; font-size:10pt; font-weight:bold;">( SSC-II/COMPOSITE '.strtoupper($ExamFullName).' CENTRE SLIP )</td></tr>
</table></div> ','O');

$sql="SELECT Id, RollNo, Name, FatherName, Gender, ExamShift, GroupId, PicURL, IdentityMarks, BATCH_ID, ACentreName, PostalAddress FROM vwrollnoslip10 WHERE Id=".$_REQUEST['Id']."";
$res=mysql_query($sql, $conn1);
$row=mysql_fetch_array($res);

if($row['ExamShift']==1){ $ExamShift='FIRST GROUP'; } else if($row['ExamShift']==2){ $ExamShift='SECOND GROUP'; }

$html.="";
$html.='<div style="width:100%; float:left;">
		<table width="100%" border="0" align="center" style="font-family:sans-serif; text-align:left; border-collapse:collapse; font-size:8.5pt;">
			<tr>
				<td style="width:15%;"></td><td style="width:35%;"></td><td style="width:30%;"></td><td style="width:20%;"></td>
			</tr>
			<tr>
				<td colspan="3"></td>
				<td rowspan="6" style="text-align:center;"><img src="'.'../institution-panel/'.$row['PicURL'].'" style="height:90px; width:80px;"/></td>
			</tr>
			<tr>
				<td style="font-weight:bold;">APP NO : '.$row['Id'].'</td>
				<td>ID NO : '.$row['BATCH_ID'].'</td>
				<td style="text-align:center; font-weight:bold;">'.$ExamShift.'</td>
			</tr>
			<tr>
				<td>STUDENT'."'".'S NAME :</td>
				<td>'.$row['Name'].'</td>
				<td style="text-align:center; font-weight:bold;"><span style="border:1px solid #000;"> &nbsp; ROLL NO : '.$row['RollNo'].' &nbsp;</span></td>
			</tr>
			<tr>
				<td>FATHER'."'".'S NAME :</td>
				<td colspan="2">'.$row['FatherName'].'</td>
			</tr>
			<tr>
				<td>POSTAL ADDRESS :</td>
				<td colspan="2">'.strtoupper($row['PostalAddress']).'</td>
			</tr>
			<tr>
				<td colspan="3">MARK OF IDENTIFICATION : '.strtoupper($row['IdentityMarks']).'</td>
			</tr>
			<tr>
				<td colspan="3" style="font-weight:bold;">CENTRE : '.strtoupper($row['ACentreName']).'</td>
				<td><barcode code="'.$row['RollNo'].'" type="MSI" class="barcode" /></td>
			</tr>
		</table>
		<div>
		<hr/>';

$mpdf->WriteHTML($html);
$mpdf->Output();
?>