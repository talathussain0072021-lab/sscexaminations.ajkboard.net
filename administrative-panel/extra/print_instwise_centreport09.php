<?php include('includes/config.php');
include("MPDF57/mpdf.php");
ob_start();
ob_clean();
$mpdf=new mPDF('c','A4','','',5,5,40,10,15,05); 
$mpdf->useOnlyCoreFonts = true;    // false is default
$mpdf->SetDisplayMode('fullpage');
$mpdf->zoom = 100;

$h = "5"; $hm = $h * 60; $ms = $hm * 60;
$dated = gmdate("d-m-Y", time()+($ms));

$sql_sessions="SELECT * FROM sessions WHERE IsCurrent=1 ORDER BY Id DESC limit 1;";
$res_sessions=mysql_query($sql_sessions, $conn1);
$row_sessions=mysql_fetch_array($res_sessions);
$SessionId=$row_sessions['Id'];
$SessionName=$row_sessions['Name'];
		
$html="";
$mpdf->SetHTMLHeader('<div style="font-family:sans-serif;"><table width="100%" style="font-family:sans-serif; background-color:#CCC; align:center; float:left; color:#000;">
<tr>
	<td style="font-size:9pt; text-align:right; width:15%; vertical-align:bottom;"></td>
	<td style="font-size:14pt; text-align:center; width:70%; vertical-align:middle;"><b>CENTRES SUMMARY REPORT (REGULAR)</b></td>
	<td style="font-size:9pt; text-align:right; width:15%; vertical-align:bottom;">Dated: '.$dated.'</td>
</tr>
</table></div>
<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin:10px; border-collapse:collapse; font-size:10pt;">
<tr>
    <td style="background-color:#D1E2F2; width:10%;"><strong>Sr. No.</strong></td>
	<td style="background-color:#D1E2F2; width:15%;"><strong>Institute Code</strong></td>
	<td style="background-color:#D1E2F2; width:55%;"><strong>Institute Name</strong></td>
	<td style="background-color:#D1E2F2; width:10%;"><strong>Student Count</strong></td>
	<td style="background-color:#D1E2F2; width:10%;"><strong>New Centre</strong></td>           	
</tr></table>','O');

		$html.='<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin-left:10px; margin-right:10px; border-collapse:collapse; font-size:9pt;">';
		
		$TotalCount=0;
		$sql1="SELECT centres.Id, centres.Name, centres.Code FROM centres WHERE centres.IsActive=1 ORDER BY centres.Code ASC";
		$res1=mysql_query($sql1, $conn1);
		while($row1=mysql_fetch_array($res1))
		{
			$SrNo=1; $CentreCount=0;
			$html.='<tr>
						<td colspan="2" style="font-weight:bold; text-align:left;">Centre Code: '.$row1['Code'].'</td>
						<td colspan="3" style="font-weight:bold; text-align:left;">Centre Name: '.$row1['Name'].'</td>
					</tr>';
				
			$sql2="SELECT InstituteName, InstituteCode, Count(Id) AS StdCount FROM vwadmstudents11 WHERE IsRegular=1 AND StdAdmStatus=1 AND ACentreId=".$row1['Id']." GROUP BY InstituteId ORDER BY InstituteCode ASC";
			$res2=mysql_query($sql2, $conn1);
			while($row2=mysql_fetch_array($res2))
			{
					$html.='<tr>
							<td style="width:10%;">'.$SrNo.'</td>
							<td style="width:15%;">'.$row2['InstituteCode'].'</td>
							<td style="width:55%; text-align:left;">'.$row2['InstituteName'].'</td>
							<td style="width:10%;">'.$row2['StdCount'].'</td>
							<td style="width:10%;"></td>
						</tr>';	
						
					$SrNo++; $CentreCount+=$row2['StdCount'];
							
			}//while($row2=mysql_fetch_array($res2))
			
			$html.='<tr>
						<td colspan="3" style="font-weight:bold; text-align:right;">Total &nbsp; </td>
						<td style="font-weight:bold;">'.$CentreCount.'</td>
						<td></td>
					</tr>';
					
			$TotalCount+=$CentreCount;
							
		}//while($row1=mysql_fetch_array($res1))
		
		$html.='<tr>
					<td colspan="4" style="font-weight:bold; text-align:right;">Grand Total &nbsp; </td>
					<td style="font-weight:bold;">'.$TotalCount.'</td>
				</tr>';		
		$html.='</table>';							 

$mpdf->SetHTMLFooter('<div align="justify" style="font-size:12pt; padding:20px; font-family:calibri">
<div style="float:left">
</div>

<br><br><br><br><br><br>

</div>', 'O',true);
$mpdf->WriteHTML($html);
$mpdf->Output();
?>