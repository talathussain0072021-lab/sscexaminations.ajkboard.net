<?php include('includes/config.php');
include("MPDF57/mpdf.php");
ob_start();
ob_clean();
$mpdf=new mPDF('','A4','','',10,10,04,-02,05,10); 
$mpdf->useOnlyCoreFonts = true; // false is default
//$mpdf->SetProtection(array('print'));
$mpdf->SetDisplayMode('fullpage');
$mpdf->zoom = 100;

$h = "5";
$hm = $h * 60; $ms = $hm * 60;
$gmdate = gmdate("d-m-Y", time()+($ms));

$sql="SELECT * FROM tbladmissmdtechapii18 WHERE RollNo='".$_REQUEST['RollNo']."'";
$res=mysql_query($sql, $conn1);
$row=mysql_fetch_array($res);
												
$html.="";
$html.='<div style="width:100%; float:left;">
		<table width="100%" border="0" align="center" style="font-family:sans-serif; text-align:center; border-collapse:collapse; font-size:8.5pt;">
			<tr><td colspan="4" style="text-align:center; font-size:10pt; font-weight:bold;">AZAD JAMMU AND KASHMIR BOARD OF INTERMEDIATE AND SECONDARY EDUCATION MIRPUR</td></tr>			
			<tr><td colspan="4" style="text-align:center; font-size:9pt;">HSSC-II ANNUAL EXAMINATION 2018</td></tr>
			<tr><td colspan="4" style="text-align:center; font-size:10pt; font-weight:bold;">( ONLINE PRACTICAL SLIP )</td></tr><tr>
			<td style="width:17%;"></td><td style="width:30%;"></td><td style="width:33%;"></td><td style="width:20%;"></td>
			</tr>
			<tr>
				<td style="text-align:left;">ROLL NO :</td>	
				<td colspan="3" style="text-align:left; font-weight:bold;">'.$row['RollNo'].'</td>				
			</tr>	
			<tr>
				<td style="text-align:left;">STUDENT'."'".'S NAME :</td>
				<td colspan="3" style="text-align:left;">'.$row['Name'].'</td>
			</tr>
			<tr>
				<td style="text-align:left;">POSTAL ADDRESS :</td>
				<td colspan="3" style="text-align:left;"><b>'.strtoupper($row['PostalAddress']).'</b></td>
			</tr>				
		</table>
		</div>';
		
$DateArray = array($row['Sub4Date'], $row['Sub5Date'], $row['Sub6Date'],$row['Sub11Date'], $row['Sub12Date'], $row['Sub13Date']);
$SubNameArray = array($row['Sub4Name'], $row['Sub5Name'], $row['Sub6Name'], $row['Sub11Name'], $row['Sub12Name'], $row['Sub13Name']);
$SubDayArray = array($row['Sub4Day'], $row['Sub5Day'], $row['Sub6Day'], $row['Sub11Day'], $row['Sub12Day'], $row['Sub13Day']);
$SubTimeArray = array($row['Sub4Time'], $row['Sub5Time'], $row['Sub6Time'], $row['Sub11Time'], $row['Sub12Time'], $row['Sub13Time']);
$LabNameArray = array($row['Lab4Name'], $row['Lab5Name'], $row['Lab6Name'], $row['Lab11Name'], $row['Lab12Name'], $row['Lab13Name']);
	
//Filtering Null Value From Array
$DateArray = array_values(array_filter($DateArray));
$SubNameArray = array_values(array_filter($SubNameArray));
$SubDayArray = array_values(array_filter($SubDayArray));
$SubTimeArray = array_values(array_filter($SubTimeArray));
$LabNameArray = array_values(array_filter($LabNameArray));

$DateArraySize = count($DateArray);
$RestArraySize = 6-$DateArraySize;

for($i = 0; $i < $DateArraySize; $i++ )
{
   for($j = 0; $j < $DateArraySize; $j++ )
   {
      if($DateArray[$i] < $DateArray[$j])
      {
         $Temp1 = $DateArray[$i]; $DateArray[$i] = $DateArray[$j]; $DateArray[$j] = $Temp1;
		 
		 $Temp2 = $SubNameArray[$i]; $SubNameArray[$i] = $SubNameArray[$j]; $SubNameArray[$j] = $Temp2;
		 
		 $Temp3 = $SubDayArray[$i]; $SubDayArray[$i] = $SubDayArray[$j]; $SubDayArray[$j] = $Temp3;
		 
		 $Temp4 = $SubTimeArray[$i]; $SubTimeArray[$i] = $SubTimeArray[$j]; $SubTimeArray[$j] = $Temp4;
		 
		 $Temp5 = $LabNameArray[$i]; $LabNameArray[$i] = $LabNameArray[$j]; $LabNameArray[$j] = $Temp5;
      }
   }
}
	
$SrNo=1;
$html.='<div style="width:100%; float:left;">
		<table width="95%" border="1" style="font-family:sans-serif; text-align:center; border-collapse:collapse; font-size:8.5pt; margin-top:1px; margin-bottom:1px; margin-left:15x;">
			<tr>
				<td style="width:5%; font-weight:bold;">SNO</td>
				<td style="width:30%; font-weight:bold;">SUBJECT NAME</td>
				<td style="width:10%; font-weight:bold;">DATE</td>
				<td style="width:10%; font-weight:bold;">DAY</td>
				<td style="width:10%; font-weight:bold;">TIME</td>
				<td style="width:35%; font-weight:bold;">LABORATORY</td>				
			</tr>';
							
	//$DateArraySize		
	for ($i = 0; $i < $DateArraySize; $i++)
	{				
	$html.='<tr>
				<td>'.$SrNo.'</td>
				<td style="text-align:left; padding-left:5px;">'.strtoupper($SubNameArray[$i]).'</td>
				<td>'.date('d-m-Y', strtotime($DateArray[$i])).'</td>				
				<td>'.$SubDayArray[$i].'</td>
				<td>'.$SubTimeArray[$i].'</td>
				<td style="text-align:left; padding-left:5px;">'.$LabNameArray[$i].'</td>
			</tr>';
			$SrNo++;
	}
	//$RestArraySize
	for ($i = 0; $i < $RestArraySize; $i++)
	{				
	$html.='<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
	}		
$html.='</table>
		</div>
		<div style="width:100%; float:right;">
			<div align="right" style="padding-right:30px;"><img src="images/controller.jpg" style="height:50px; width:100px;"/></div>
		</div>';

$html.='<div style="width:100%; float:left;">
		<table width="100%" border="0" align="center" style="font-family:sans-serif; text-align:center; border-collapse:collapse; font-size:8.5pt; margin-top:1px;">
			<tr>
				<td style="width:10%;"></td><td style="width:30%;"></td><td style="width:30%;"></td><td style="width:30%;"></td>
			</tr>
			<tr>
				<td rowspan="2" style="text-align:left;">'.$row['BatchNo'].'/'.$row['BatchSr'].'</td>
				<td rowspan="2" colspan="2" style="font-weight:bold; text-align:left;">('.$row['ACentreCode'].') '.strtoupper($row['ACentreName']).'</td>
				<td style="padding-top:5px; text-align:right;"><b>CONTROLLER OF EXAMINATIONS</b></td>
			</tr>
			<tr>
				<td style="padding-top:5px; text-align:right;"><span style="font-size:8pt;">Note: Errors / Omissions excepted</span></td>
			</tr>				
		</table>
		</div><hr/>';

$mpdf->WriteHTML($html);
//$mpdf->Output('reports/Registration-From_'.$row['app_no'].$information['id'].'.pdf','F');
$mpdf->Output();
?>