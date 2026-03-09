<?php include('includes/config.php');
include("MPDF57/mpdf.php");
ob_start();
ob_clean();
$mpdf=new mPDF('c','A4-L','','',5,5,28,10,15,10); 
$mpdf->useOnlyCoreFonts = true;    // false is default
//$mpdf->SetProtection(array('print'));
$mpdf->SetDisplayMode('fullpage');
$mpdf->zoom = 100;

$h = "5"; $hm = $h * 60; $ms = $hm * 60;
$dated = gmdate("d-m-Y g:i:s A", time()+($ms));

$sql_sessions="SELECT * FROM sessions WHERE IsCurrent=1 ORDER BY Id DESC limit 1;";
$res_sessions=mysql_query($sql_sessions, $conn1);
$row_sessions=mysql_fetch_array($res_sessions);
$SessionId=$row_sessions['Id'];
$SessionName=$row_sessions['Name'];
		
$html="";
$mpdf->SetHTMLHeader('<div style="font-family:sans-serif;"><table width="100%" style="font-family:sans-serif; background-color:#FFF; align:center; float:left; color:#000;">
<tr><td width="100%"></td></tr>
<tr><td style="text-align:right; background-color:#CCC; padding-top:8px; font-size:14pt;"><b>'.$_REQUEST['BatchNo'].' BATCH REPORT '.$SessionName.'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-size:10pt; text-align:right; margin-right:15px;"><strong>Dated: </strong>'.$dated.'&nbsp;&nbsp;</span></td></tr>
</table></div> ','O');

//<div style="background-color:#CCC; text-align:center; padding-top:8px;" height="30px" ><span style="font-size:20px"><b>General Sale Report</b></span><div style="font-size:12px; text-align:right; margin-right:15px; margin-top:-10px;"><strong>Sale Period=</strong>'.date('d-m-Y',strtotime($_REQUEST['start_date'])).' to ' .date('d-m-Y',strtotime($_REQUEST['end_date'])).'</div></div>';

		$html.='<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin-left:10px; margin-right:10px; border-collapse:collapse; font-size:9pt;">
				<tr>
					<td style="background-color:#D1E2F2; width:5%;"><strong>Sr. No.</strong></td>
					<td style="background-color:#D1E2F2; width:5%;"><strong>Adm. SNo.</strong></td>	
					<td style="background-color:#D1E2F2; width:5%;"><strong>App. No.</strong></td>
					<td style="background-color:#D1E2F2; width:15%;"><strong>Student Name</strong></td>
					<td style="background-color:#D1E2F2; width:15%;"><strong>Father Name</strong></td>
					<td style="background-color:#D1E2F2; width:5%;"><strong>Gender</strong></td>
					<td style="background-color:#D1E2F2; width:10%;"><strong>Group</strong></td>
					<td style="background-color:#D1E2F2; width:10%;"><strong>Combination</strong></td>	
					<td style="background-color:#D1E2F2; width:30%;"><strong>Subjects</strong></td>       	
				</tr>';
					
			$SrNo=1;
			$sql="SELECT Id, Name, FatherName, Gender, GroupName, CombinationName, Sub4Name, Sub5Name, Sub6Name, Sub7Name, BatchSr FROM vwadmstudents11 WHERE BatchId=".$_REQUEST['BatchId']." AND SessionId=".$SessionId." ORDER BY BatchSr ASC";
			$res=mysql_query($sql, $conn1);
			while($row=mysql_fetch_array($res))
			{	
				if($row['Gender'] == 1){ $Gender='Male'; }
				else if($row['Gender'] == 2){ $Gender='Female'; }
				else { $Gender=''; }
				
				$SubjectsList=$row['Sub4Name'].', '.$row['Sub5Name'].', '.$row['Sub6Name']; 
				if($row['Sub7Name']!=''){ $SubjectsList.=', '.$row['Sub7Name']; }
							
				$html.='<tr>
							<td style="width:5%;">'.$SrNo.'</td>
							<td style="width:5%;">'.$row['BatchSr'].'</td>							
							<td style="width:5%;">'.$row['Id'].'</td>
							<td style="width:15%; text-align:left;">'.$row['Name'].'</td>
							<td style="width:15%; text-align:left;">'.$row['FatherName'].'</td>
							<td style="width:5%;">'.$Gender.'</td>
							<td style="width:10%;">'.$row['GroupName'].'</td>
							<td style="width:10%;">'.$row['CombinationName'].'</td>
							<td style="width:30%;">'.$SubjectsList.'</td>
					</tr>';
					$SrNo++;
		}
				
		$html.='</table>';
							 

$mpdf->SetHTMLFooter('<div align="justify" style="font-size:12px; padding:20px; font-family:calibri">
<div style="float:left">
</div>

<br><br><br><br><br><br>
<div style="width:60%; float:left; text-align:right;"></div><div style="width:30%; float:right; text-align:right; font-size:20px"></div><br>
<br>

<div style="width:100%; float:left; text-align:left; font-size:10px;"></div>

</div>', 'O',true);
$mpdf->WriteHTML($html);
//$mpdf->Output('reports/expense_report'.$information['id'].'.pdf','F');
$mpdf->Output();
?>