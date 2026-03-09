<?php include('includes/config.php');
include("MPDF57/mpdf.php");
ob_start();
ob_clean();
$mpdf=new mPDF('c','A4','','',5,5,45,10,15,05); 
$mpdf->useOnlyCoreFonts = true;    // false is default
//$mpdf->SetProtection(array('print'));
$mpdf->SetDisplayMode('fullpage');
$mpdf->zoom = 100;

$h = "5"; $hm = $h * 60; $ms = $hm * 60;
$dated = gmdate("d-m-Y", time()+($ms));

$sql_sessions="SELECT * FROM sessions WHERE IsCurrent=1 ORDER BY Id DESC limit 1;";
$res_sessions=mysql_query($sql_sessions, $conn1);
$row_sessions=mysql_fetch_array($res_sessions);
$SessionId=$row_sessions['Id'];
$SessionName=$row_sessions['Name'];

$sql_institutes="SELECT Name, Code FROM institutes WHERE Id=".$_REQUEST['InstituteId']."";
$res_institutes=mysql_query($sql_institutes, $conn1);
$row_institutes=mysql_fetch_array($res_institutes);
$InstName=$row_institutes['Name'];
$InstCode=$row_institutes['Code'];
		
$html="";
$mpdf->SetHTMLHeader('<div style="font-family:sans-serif;"><table width="100%" style="font-family:sans-serif; background-color:#FFF; align:center; float:left; color:#000; font-size:9pt;">
<tr style="background-color:#CCC;">
	<td colspan="3" style="font-size:14pt; text-align:center; width:100%; vertical-align:middle;"><b>REG. BATCHES REPORT '.$SessionName.'</b></td>
</tr>
<tr><td colspan="3"><b>Institute Code: '.$InstCode.' &nbsp; &nbsp; &nbsp; Institute Name: '.$InstName.'</b></td></tr>
<tr><td colspan="3"><b>NB/Computer: _________________________ &nbsp; &nbsp; &nbsp; Dated: '.$dated.'</b></td></tr>
</table></div>
<table width="100%" style="font-family:sans-serif; border:2px solid #000;align:center; float:left; text-align:center; margin:10px; border-collapse:collapse; font-size:9pt;">
<tr>
    <td style="border:1px solid #000; background-color:#D1E2F2; width:10%;"><strong>Sr. No.</strong></td>
	<td style="border:1px solid #000; background-color:#D1E2F2; width:20%;"><strong>Challan No.</strong></td>
	<td style="border:1px solid #000; background-color:#D1E2F2; width:20%;"><strong>Batch No.</strong></td>
	<td style="border:1px solid #000; background-color:#D1E2F2; width:20%;"><strong>Amount</strong></td>
	<td style="border:1px solid #000; background-color:#D1E2F2; width:30%;"><strong>Remarks</strong></td>           	
</tr></table>','O');

//<div style="background-color:#CCC; text-align:center; padding-top:8px;" height="30px" ><span style="font-size:20px"><b>General Sale Report</b></span><div style="font-size:12px; text-align:right; margin-right:15px; margin-top:-10px;"><strong>Sale Period=</strong>'.date('d-m-Y',strtotime($_REQUEST['start_date'])).' to ' .date('d-m-Y',strtotime($_REQUEST['end_date'])).'</div></div>';

		$html.='<table width="100%" style="font-family:sans-serif; align:center; float:left; text-align:center; margin-left:10px; margin-right:10px; border-collapse:collapse; font-size:9pt;">';
		$SrNo=1; $TotalSum=0;
		
		$sql="SELECT Id, BatchNo, BatchStatus, RegStatus, RevStatus, BatchCounter, InstituteId, StdCount, BatchFee, ChallanNo FROM vwregbatches WHERE BatchStatus=1 AND SessionId=".$SessionId." And InstituteId=".$_REQUEST['InstituteId']." ORDER BY Id ASC";
		$res=mysql_query($sql, $conn1);
		while($row=mysql_fetch_array($res))
		{
			if($row['RevStatus'] == 0){ $Status=''; }
			else if($row['RevStatus'] == 1){ $Status='Ok'; } 
			else if($row['RevStatus'] == 2){ $Status='Not Ok'; }
											
			$html.='<tr>
						<td style="border:1px solid #000; width:10%;">'.$SrNo.'</td>
						<td style="border:1px solid #000; width:20%;">'.$row['ChallanNo'].'</td>
						<td style="border:1px solid #000; width:20%;">'.$row['BatchNo'].'</td>
						<td style="border:1px solid #000; width:20%;">'.floatval($row['BatchFee']).'</td>
						<td style="border:1px solid #000; width:30%;">'.$Status.'</td>	
					</tr>';
					$SrNo++; $TotalSum+=$row['BatchFee'];
		}
		
		$html.='<tr>
          			<td colspan="3" style="border:1px solid #000; text-align:right; font-weight:bold;">Total Amount: &nbsp; </td>
					<td style="border:1px solid #000; text-align:center; font-weight:bold;">'.$TotalSum.'</td>
					<td style="border:1px solid #000; text-align:center; font-weight:bold;"></td>
				</tr>';
				
		$html.='</table>';
							 

$mpdf->SetHTMLFooter('<div align="justify" style="font-size:12pt; padding:20px; font-family:calibri">
<div style="float:left">
</div>

<br><br><br><br><br><br>
<div style="width:32%; float:left; text-align:center; border-top:1px solid #000;">Report Prepared By </div>
<div style="width:32%; float:left; margin-left:10px; text-align:center; border-top:1px solid #000;">Revenue Operator </div>
<div style="width:32%; float:left; margin-left:10px; text-align:center; border-top:1px solid #000;">Online Reg. Operator </div>

</div>', 'O',true);
$mpdf->WriteHTML($html);
//$mpdf->Output('reports/expense_report'.$information['id'].'.pdf','F');
$mpdf->Output();
?>