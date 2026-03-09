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
$row_exams=mysql_fetch_assoc($res_exams);
$ExamId=$row_exams['Id'];
$ExamName=$row_exams['Name'];
$ExamFullName=$row_exams['FullName'];

$first_number=$_REQUEST['first_number']-1;
$Counter=1;

$sql="SELECT * FROM tblpractrollnoslip10 WHERE AdmStatus=1";

if(isset($_REQUEST['Id']) && $_REQUEST['Id']!='') { 
	$sql.=" AND Id=".$_REQUEST['Id']."";
}
else {
	if(isset($_REQUEST['StdudentId']) && $_REQUEST['StdudentId']!='')
	{ $sql.=" AND Id IN (".$_REQUEST['StdudentId'].")"; }

	if(isset($_REQUEST['RollNo']) && $_REQUEST['RollNo']!='')
	{ $sql.=" AND RollNo IN (".$_REQUEST['RollNo'].")"; }

	if(isset($_REQUEST['BatchSr']) && $_REQUEST['BatchSr']!='')
	{ $sql.=" AND AdmBatchNo LIKE '".$_REQUEST['BatchSr']."%'"; }

	if(isset($_REQUEST['Name']) && $_REQUEST['Name']!='')
	{ $sql.=" AND Name LIKE '".$_REQUEST['Name']."%'"; }

	if(isset($_REQUEST['CentreCode']) && $_REQUEST['CentreCode']!='')
	{ $sql.=" AND CentreCode='".$_REQUEST['CentreCode']."'"; }

	$sql.=" ORDER BY RollNo ASC limit {$first_number}, 100";
}

$res=mysql_query($sql, $conn1);
while($row=mysql_fetch_assoc($res))
{

$html.="";
$html.='<div style="width:100%; float:left;">
		<table width="100%" border="0" align="center" style="font-family:sans-serif; text-align:left; border-collapse:collapse; font-size:8.5pt;">
			<tr><td colspan="4" style="text-align:center; font-size:10pt; font-weight:bold;">AZAD JAMMU AND KASHMIR BOARD OF INTERMEDIATE AND SECONDARY EDUCATION MIRPUR</td></tr>
			<tr><td colspan="4" style="text-align:center; font-size:9pt;">SSC-II '.strtoupper($ExamFullName).'</td></tr>
			<tr><td colspan="4" style="text-align:center; font-size:10pt; font-weight:bold;">( ONLINE PRACTICAL SLIP )</td></tr>
			<tr>
				<td style="width:15%;"></td><td style="width:15%;"></td><td style="width:15%;"></td><td style="width:55%;"></td>
			</tr>
			<tr>
				<td>ROLL NO :</td>
				<td style="font-weight:bold; padding-top:5px;">'.$row['RollNo'].'</td>
				<td>NAME :</td>
				<td style="font-weight:bold; padding-top:5px;">'.$row['Name'].'</td>
			</tr>
		</table>
		</div>';

$DateArray = array($row['Date26'], $row['Date27'], $row['Date28']);
$SubNameArray = array($row['Sub26'], $row['Sub27'], $row['Sub28']);
$SubTimeArray = array($row['Time26'], $row['Time27'], $row['Time28']);
$LabCodeArray = array($row['LabCode26'], $row['LabCode27'], $row['LabCode28']);
$LabNameArray = array($row['LabName26'], $row['LabName27'], $row['LabName28']);

//Filtering Null Value From Array
$DateArray = array_values(array_filter($DateArray));
$SubNameArray = array_values(array_filter($SubNameArray));
$SubTimeArray = array_values(array_filter($SubTimeArray));
$LabCodeArray = array_values(array_filter($LabCodeArray));
$LabNameArray = array_values(array_filter($LabNameArray));

$DateArraySize = count($DateArray);
$RestArraySize = 3-$DateArraySize;

for($i = 0; $i < $DateArraySize; $i++)
{
	for($j = 0; $j < $DateArraySize; $j++)
	{
		if($DateArray[$i] < $DateArray[$j])
		{
			$Temp1 = $DateArray[$i]; $DateArray[$i] = $DateArray[$j]; $DateArray[$j] = $Temp1;
			
			$Temp2 = $SubNameArray[$i]; $SubNameArray[$i] = $SubNameArray[$j]; $SubNameArray[$j] = $Temp2;
			
			$Temp3 = $SubTimeArray[$i]; $SubTimeArray[$i] = $SubTimeArray[$j]; $SubTimeArray[$j] = $Temp3;
			
			$Temp4 = $LabCodeArray[$i]; $LabCodeArray[$i] = $LabCodeArray[$j]; $LabCodeArray[$j] = $Temp4;
			
			$Temp5 = $LabNameArray[$i]; $LabNameArray[$i] = $LabNameArray[$j]; $LabNameArray[$j] = $Temp5;
		}
	}
}

$SrNo=1;
$html.='<div style="width:100%; float:left;">
		<table width="95%" border="1" style="font-family:sans-serif; text-align:center; border-collapse:collapse; font-size:8.5pt; margin-top:1px; margin-bottom:5px; margin-left:15px;">
			<tr>
				<td style="width:5%; font-weight:bold;">SNO</td>
				<td style="width:22%; font-weight:bold;">SUBJECT NAME</td>
				<td style="width:10%; font-weight:bold;">DATE</td>
				<td style="width:18%; font-weight:bold;">TIME</td>
				<td colspan="2" style="font-weight:bold;">LAB CODE/NAME</td>
			</tr>';

	//$DateArraySize
	for($i = 0; $i < $DateArraySize; $i++)
	{
	$html.='<tr>
				<td>'.$SrNo.'</td>
				<td style="text-align:left; padding-left:5px;">'.strtoupper($SubNameArray[$i]).'</td>
				<td>'.date('d-m-Y',strtotime($DateArray[$i])).'</td>
				<td>'.$SubTimeArray[$i].'</td>
				<td style="width:05%; text-align:center;">'.$LabCodeArray[$i].'</td>
				<td style="width:40%; text-align:left; padding-left:5px;">'.$LabNameArray[$i].'</td>
			</tr>';
			$SrNo++;
	}
	//$RestArraySize
	for($i = 0; $i < $RestArraySize; $i++)
	{
	$html.='<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
	}
	
	$html.='<!--<tr>
				<td colspan="6" style="text-align: left; font-weight: bold;">SSC-I Result : '.$row['Remarks'].'</td>
			</tr>-->
		</table>
		</div>
		<div style="width:100%; float:right;">
			<div align="right" style="padding-right:30px;"><img src="images/controller.jpg" style="height:40px; width:90px;"/></div>
		</div>';

$html.='<div style="width:100%; float:left;">
		<table width="100%" border="0" align="center" style="font-family:sans-serif; text-align:left; border-collapse:collapse; font-size:8.5pt; margin-top:1px;">
			<tr>
				<td style="padding-top:5px; text-align:right;"><b>CONTROLLER OF EXAMINATIONS</b></td>
			</tr>
			<tr>
				<td style="padding-top:5px; text-align:right;"><span style="font-size:8pt;">Note: Errors / Omissions excepted</span></td>
			</tr>
		</table>
		</div><hr/>';
		
		if($Counter % 3 == 0){ $html.='<pagebreak />'; }
		$Counter++;
}

$mpdf->WriteHTML($html);
$mpdf->Output();
?>