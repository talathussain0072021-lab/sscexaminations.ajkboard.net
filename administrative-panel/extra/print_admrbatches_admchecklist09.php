<?php include('includes/config.php');
include("MPDF57/mpdf.php");
ob_start();
ob_clean();
$mpdf=new mPDF('c','A4','','',5,5,30,10,15,05); 
$mpdf->useOnlyCoreFonts = true;    // false is default
$mpdf->SetDisplayMode('fullpage');
$mpdf->zoom = 100;

$h = "5"; $hm = $h * 60; $ms = $hm * 60;
$dated = gmdate("d-m-Y", time()+($ms));

$first_number=$_REQUEST['first_number']-1;

$sql_sessions="SELECT * FROM sessions WHERE IsCurrent=1 ORDER BY Id DESC limit 1;";
$res_sessions=mysql_query($sql_sessions, $conn1);
$row_sessions=mysql_fetch_array($res_sessions);
$SessionId=$row_sessions['Id'];
$SessionName=$row_sessions['Name'];
		
$html="";
$mpdf->SetHTMLHeader('<div style="font-family:sans-serif;"><table width="100%" style="font-family:sans-serif; background-color:#CCC; align:center; float:left; color:#000;">
<tr>
	<td style="font-size:9pt; text-align:right; width:5%; vertical-align:bottom;"></td>
	<td style="font-size:14pt; text-align:center; width:80%; vertical-align:middle;"><b>PI ADM. BATCHES(REG) ADM. CHECK LIST '.$SessionName.'</b></td>
	<td style="font-size:9pt; text-align:right; width:15%; vertical-align:bottom;">Dated: '.$dated.'</td>
</tr>
</table></div>
<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin:10px; border-collapse:collapse; font-size:10pt;">
<tr>
    <td style="background-color:#D1E2F2; width:15%;"><strong>Sr. No.</strong></td>
	<td style="background-color:#D1E2F2; width:20%;"><strong>Inst. Code</strong></td>
	<td style="background-color:#D1E2F2; width:20%;"><strong>Batch No.</strong></td>
	<td style="background-color:#D1E2F2; width:20%;"><strong>Student Count</strong></td>	
	<td style="background-color:#D1E2F2; width:25%;"><strong>Remarks</strong></td>          	
</tr></table>','O');

		$html.='<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin-left:10px; margin-right:10px; border-collapse:collapse; font-size:10pt;">';
		$SrNo=$first_number+1; $TotalSum=0;
		
		$sql="SELECT Id, BatchNo, AdmStatus, RevStatus, StdCount, BatchFee, ChallanNo, InstituteCode FROM vwadmbatches11 WHERE BatchStatus=".$_REQUEST['BatchStatus']." AND BatchType=1 AND SessionId=".$SessionId." AND AdmStatus=".$_REQUEST['AdmRevStatus']." ORDER BY InstituteCode, Id ASC limit {$first_number}, 1000";
		$res=mysql_query($sql, $conn1);
		while($row=mysql_fetch_array($res))
		{							
			if($row['AdmStatus'] == 0){ $Status=''; }
			else if($row['AdmStatus'] == 1){ $Status='Ok'; }
			else if($row['AdmStatus'] == 2){ $Status='Not Ok'; }
									
			$html.='<tr>
						<td style="width:15%;">'.$SrNo.'</td>
						<td style="width:20%;">'.$row['InstituteCode'].'</td>
						<td style="width:20%;">'.$row['BatchNo'].'</td>
						<td style="width:20%;">'.$row['StdCount'].'</td>
						<td style="width:25%;">'.$Status.'</td>	
					</tr>';
					$SrNo++; $TotalSum+=$row['StdCount'];
		}
		
		$html.='<tr>
          			<td colspan="3" style="text-align:right; font-weight:bold;">Total Count: &nbsp; </td>
					<td style="text-align:center; font-weight:bold;">'.$TotalSum.'</td>
					<td></td>
				</tr>';
				
		$html.='</table>';							 

$mpdf->SetHTMLFooter('<div align="justify" style="font-size:12pt; padding:20px; font-family:calibri">
<div style="float:left">
</div>

<br><br><br><br><br><br>

</div>', 'O',true);
$mpdf->WriteHTML($html);
//$mpdf->Output('reports/expense_report'.$information['id'].'.pdf','F');
$mpdf->Output();
?>