<?php include('includes/config.php');
include("MPDF57/mpdf.php");
ob_start();
ob_clean();
$mpdf=new mPDF('','A4','','',10,10,04,-04,05,10);
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

$first_number=$_REQUEST['first_number']-1;
$Counter=1;

$sql="SELECT Id, RollNo, Name, FatherName, Gender, ExamShift, GroupId, PicURL, IdentityMarks, BATCH_ID, ACentreName, PostalAddress,
Sub1Name, Sub1Day, Sub1Date, Sub1Time, Sub2Name, Sub2Day, Sub2Date, Sub2Time, Sub3Name, Sub3Day, Sub3Date, Sub3Time,
Sub4Name, Sub4Day, Sub4Date, Sub4Time, Sub5Name, Sub5Day, Sub5Date, Sub5Time, Sub6Name, Sub6Day, Sub6Date, Sub6Time,
Sub7Name, Sub7Day, Sub7Date, Sub7Time, Sub8Name, Sub8Day, Sub8Date, Sub8Time, Sub9Name, Sub9Day, Sub9Date, Sub9Time 
FROM vwrollnoslip09 WHERE IsRegular=0";

if(isset($_REQUEST['StdudentId']) && $_REQUEST['StdudentId']!='')
{ $sql.=" AND Id IN (".$_REQUEST['StdudentId'].")"; }

if(isset($_REQUEST['RegistrationNo']) && $_REQUEST['RegistrationNo']!='')
{ $sql.=" AND RegistrationNo='".$_REQUEST['RegistrationNo']."'"; }

if(isset($_REQUEST['RollNo']) && $_REQUEST['RollNo']!='')
{ $sql.=" AND RollNo IN (".$_REQUEST['RollNo'].")"; }

if(isset($_REQUEST['BatchSr']) && $_REQUEST['BatchSr']!='')
{ $sql.=" AND BATCH_ID LIKE '".$_REQUEST['BatchSr']."%'"; }

if(isset($_REQUEST['Name']) && $_REQUEST['Name']!='')
{ $sql.=" AND Name LIKE '".$_REQUEST['Name']."%'"; }

if(isset($_REQUEST['CentreCode']) && $_REQUEST['CentreCode']!='')
{ $sql.=" AND ACentreCode='".$_REQUEST['CentreCode']."'"; }

$sql.=" ORDER BY RollNo ASC limit {$first_number}, 100";
$res=mysql_query($sql, $conn1);
while($row=mysql_fetch_array($res))
{

if($row['ExamShift']==1){ $ExamShift='FIRST GROUP'; } else if($row['ExamShift']==2){ $ExamShift='SECOND GROUP'; }

$html.="";
$html.='<div style="width:100%; float:left;">
		<table width="100%" border="0" align="center" style="font-family:sans-serif; text-align:left; border-collapse:collapse; font-size:8.5pt;">
			<tr><td colspan="4" style="text-align:center; font-size:10pt; font-weight:bold;">AZAD JAMMU AND KASHMIR BOARD OF INTERMEDIATE AND SECONDARY EDUCATION MIRPUR</td></tr>
			<tr><td colspan="4" style="text-align:center; font-size:10pt; font-weight:bold;">( PROVISIONAL ROLLNO SLIP WITH DATE SHEET )</td></tr>
			<tr><td colspan="4" style="text-align:center; font-size:9pt;">SSC-I '.strtoupper($ExamFullName).'</td></tr>
			<tr>
				<td style="width:15%;"></td><td style="width:32%;"></td><td style="width:33%;"></td><td style="width:20%;"></td>
			</tr>
			<tr>
				<td style="font-weight:bold;">APP NO : '.$row['Id'].'</td>
				<td>ID NO : '.$row['BATCH_ID'].'</td>
				<td style="text-align:left; font-weight:bold;">ROLL NO : '.$row['RollNo'].'</td>
				<td style="text-align:center; font-weight:bold; font-size:9pt;">'.$ExamShift.'</td>
			</tr>
			<tr>
				<td>STUDENT'."'".'S NAME :</td>
				<td colspan="2">'.$row['Name'].'</td>
				<td rowspan="4" style="text-align:center;"><img src="'.'../institution-panel/'.$row['PicURL'].'" style="height:90px; width:80px;"/></td>
			</tr>
			<tr>
				<td>FATHER'."'".'S NAME :</td>
				<td colspan="2">'.$row['FatherName'].'</td>
			</tr>
			<tr>
				<td>POSTAL ADDRESS :</td>
				<td colspan="2"><b>'.strtoupper($row['PostalAddress']).'</b></td>
			</tr>
			<tr>
				<td colspan="3">MARK OF IDENTIFICATION : '.strtoupper($row['IdentityMarks']).'</td>
			</tr>
		</table>
		</div>';

$DateArray = array($row['Sub1Date'], $row['Sub2Date'], $row['Sub3Date'], $row['Sub4Date'], $row['Sub5Date'], $row['Sub6Date'], $row['Sub7Date'], $row['Sub8Date'], $row['Sub9Date']);
$SubNameArray = array($row['Sub1Name'], $row['Sub2Name'], $row['Sub3Name'], $row['Sub4Name'], $row['Sub5Name'], $row['Sub6Name'], $row['Sub7Name'], $row['Sub8Name'], $row['Sub9Name']);
$SubDayArray = array($row['Sub1Day'], $row['Sub2Day'], $row['Sub3Day'], $row['Sub4Day'], $row['Sub5Day'], $row['Sub6Day'], $row['Sub7Day'], $row['Sub8Day'], $row['Sub9Day']);
$SubTimeArray = array($row['Sub1Time'], $row['Sub2Time'], $row['Sub3Time'], $row['Sub4Time'], $row['Sub5Time'], $row['Sub6Time'], $row['Sub7Time'], $row['Sub8Time'], $row['Sub9Time']);

//Filtering Null Value From Array
$DateArray = array_values(array_filter($DateArray));
$SubNameArray = array_values(array_filter($SubNameArray));
$SubDayArray = array_values(array_filter($SubDayArray));
$SubTimeArray = array_values(array_filter($SubTimeArray));

$DateArraySize = count($DateArray);

for($i = 0; $i < $DateArraySize; $i++)
{
	for($j = 0; $j < $DateArraySize; $j++)
	{
		if($DateArray[$i] < $DateArray[$j])
		{
			$Temp1 = $DateArray[$i]; $DateArray[$i] = $DateArray[$j]; $DateArray[$j] = $Temp1;
			
			$Temp2 = $SubNameArray[$i]; $SubNameArray[$i] = $SubNameArray[$j]; $SubNameArray[$j] = $Temp2;
			
			$Temp3 = $SubDayArray[$i]; $SubDayArray[$i] = $SubDayArray[$j]; $SubDayArray[$j] = $Temp3;
			
			$Temp4 = $SubTimeArray[$i]; $SubTimeArray[$i] = $SubTimeArray[$j]; $SubTimeArray[$j] = $Temp4;
		}
	}
}

$SrNo=1;
$html.='<div style="width:79%; float:left;">
		<table width="95%" border="1" style="font-family:sans-serif; text-align:center; border-collapse:collapse; font-size:8.5pt; margin-top:1px; margin-left:50px;">
			<tr>
				<td style="width:5%; font-weight:bold;">SNO</td>
				<td style="width:50%; font-weight:bold;">SUBJECT NAME</td>
				<td style="width:15%; font-weight:bold;">DATE</td>
				<td style="width:15%; font-weight:bold;">DAY</td>
				<td style="width:15%; font-weight:bold;">TIME</td>
			</tr>';

	//$DateArraySize
	for($i = 0; $i < $DateArraySize; $i++)
	{
	$html.='<tr>
				<td>'.$SrNo.'</td>
				<td style="text-align:left;"> &nbsp; '.strtoupper($SubNameArray[$i]).'</td>
				<td>'.date('d-m-Y',strtotime($DateArray[$i])).'</td>
				<td>'.$SubDayArray[$i].'</td>
				<td>'.$SubTimeArray[$i].'</td>
			</tr>';
			$SrNo++;
	}
$html.='</table>
		</div>
		<div style="width:20%; float:right;">
			<div align="center"><barcode code="'.$row['RollNo'].'" type="MSI" class="barcode"/></div>
			<div style="height:50px;"></div>
			<div align="center"><img src="images/controller.jpg" style="height:50px; width:100px;"/></div>
		</div>';

$html.='<div style="width:100%; float:left;">
		<table width="100%" border="0" align="center" style="font-family:sans-serif; text-align:left; border-collapse:collapse; font-size:8.5pt; margin-top:1px;">
			<tr>
				<td style="width:10%;"></td><td style="width:30%;"></td><td style="width:30%;"></td><td style="width:30%;"></td>
			</tr>
			<tr>
				<td rowspan="2" style="font-weight:bold;">CENTRE :</td>
				<td rowspan="2" colspan="2" style="font-weight:bold;">'.strtoupper($row['ACentreName']).'</td>
				<td style="padding-top:5px; text-align:right;"><b>CONTROLLER OF EXAMINATIONS</b></td>
			</tr>
			<tr>
				<td style="padding-top:5px; text-align:right;"><span style="font-size:8pt;">Note: Errors / Omissions excepted</span></td>
			</tr>
			<tr>
				<td colspan="4"><img src="images/pi_rollnoslip.jpg"/></td>
			</tr>
		</table>
		</div><br><hr/>';
		
		if($Counter % 2 == 0){ $html.='<pagebreak />'; }
		$Counter++;
}

$mpdf->WriteHTML($html);
$mpdf->Output();
?>