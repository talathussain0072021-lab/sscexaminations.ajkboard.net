<?php include('includes/config.php');
include("MPDF57/mpdf.php");
ob_start();
ob_clean();
$mpdf=new mPDF('c','A4-L','','',5,5,55,15,0,-5); 
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

$sql_institutes="SELECT Name, Code FROM institutes WHERE Id=".$_REQUEST['InstituteId']."";
$res_institutes=mysql_query($sql_institutes, $conn1);
$row_institutes=mysql_fetch_array($res_institutes);
$InstName=$row_institutes['Name'];
$InstCode=$row_institutes['Code'];

$sql1="SELECT Id, BatchNo, BatchFee, ChallanNo FROM vwregbatches WHERE Id=".$_REQUEST['BatchId']." AND InstituteId=".$_REQUEST['InstituteId']." AND SessionId=".$SessionId."";
$res1=mysql_query($sql1, $conn1);
$row1=mysql_fetch_array($res1);
		
$html="";
$mpdf->SetHTMLHeader('<div style="font-family:sans-serif;"><table width="100%" style="font-family:sans-serif; background-color:#FFF; align:center; float:left; color:#000; font-size:9pt;">
<tr><td width="100%"></td></tr>
<tr><td align="center"><img src="images/logo-report.png" style="height:80px;" /></td></tr>
<tr><td style="text-align:right; background-color:#CCC; padding-top:8px; font-size:14pt;"><b>REGISTRATION RETURN '.$SessionName.' (OFFICIAL)</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-size:10pt; text-align:right; margin-right:15px;"><strong>Dated: </strong>'.$dated.'&nbsp;&nbsp;</span></td></tr>

<tr><td><b>Institute Code: '.$InstCode.' &nbsp; &nbsp; &nbsp; Institute Name: '.$InstName.'</b></td></tr>
<tr><td><b>Batch No.: '.$row1['BatchNo'].' &nbsp; &nbsp; &nbsp;Challan No.: '.$row1['ChallanNo'].'</b></td></tr>
</table></div>
<table width="100%" style="font-family:sans-serif; border:2px solid #000; align:center; float:left; text-align:center; margin:10px; border-collapse:collapse; font-size:9pt;">
<tr>
    <td style="border:1px solid #000; background-color:#D1E2F2; width:3%;"><strong>Sr. No.</strong></td>
	<td style="border:1px solid #000; background-color:#D1E2F2; width:5%;"><strong>SSC Record</strong></td>
	<td style="border:1px solid #000; background-color:#D1E2F2; width:7%;"><strong>HSSC Record</strong></td>
	<td style="border:1px solid #000; background-color:#D1E2F2; width:5%;"><strong>Adm. Type</strong></td>
	<td style="border:1px solid #000; background-color:#D1E2F2; width:10%;"><strong>Student Name</strong></td>
	<td style="border:1px solid #000; background-color:#D1E2F2; width:10%;"><strong>Father Name</strong></td>
	<td style="border:1px solid #000; background-color:#D1E2F2; width:10%;"><strong>CNIC/Form B# <br> Special Case</strong></td>
	<td style="border:1px solid #000; background-color:#D1E2F2; width:5%;"><strong>Gender</strong></td>
	<td style="border:1px solid #000; background-color:#D1E2F2; width:10%;"><strong>Group</strong></td>	
	<td style="border:1px solid #000; background-color:#D1E2F2; width:20%;"><strong>Subjects</strong></td>
	<td style="border:1px solid #000; background-color:#D1E2F2; width:10%;"><strong>Picture</strong></td>
	<td style="border:1px solid #000; background-color:#D1E2F2; width:5%;"><strong>Fee</strong></td>	             	
</tr></table> ','O');

//<div style="background-color:#CCC; text-align:center; padding-top:8px;" height="30px" ><span style="font-size:20px"><b>General Sale Report</b></span><div style="font-size:12px; text-align:right; margin-right:15px; margin-top:-10px;"><strong>Sale Period=</strong>'.date('d-m-Y',strtotime($_REQUEST['start_date'])).' to ' .date('d-m-Y',strtotime($_REQUEST['end_date'])).'</div></div>';

		$html.='<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin-left:10px; margin-right:10px; border-collapse:collapse; font-size:9pt;">';
		$SrNo=1;
		$sql="SELECT Id, SSCYear, SSCRollNo, SSCSession, SSCBoard, HSSCRegNo, HSSCBoard, Name, FatherName, PicURL, CNIC, Gender, IsSpecial, GroupName, AdmissionType, Sub4Name, Sub5Name, Sub6Name, Sub7Name, RegistrationFee FROM vwregstudents WHERE RegInstituteId=".$_REQUEST['InstituteId']." AND SessionId=".$SessionId." AND BatchId=".$_REQUEST['BatchId']." ORDER BY Id ASC";
		$res=mysql_query($sql, $conn1);
		while($row=mysql_fetch_array($res))
		{
			if($row['SSCSession'] == 1){ $SSCSession='A'; }
			else if($row['SSCSession'] == 2){ $SSCSession='S'; }
			else { $SSCSession=''; }
			
			$SSCYear=str_pad($row['SSCYear'],2,'0',STR_PAD_LEFT); 
			
			if($row['SSCBoard'] == 0){ $SSCBoard=''; }
			else if($row['SSCBoard'] == 1){ $SSCBoard='AJK'; }
			else { $SSCBoard='Other'; }
			
			if($row['HSSCBoard'] == 0){ $HSSCBoard=''; }
			else if($row['HSSCBoard'] == 1){ $HSSCBoard='AJK'; }
			else { $HSSCBoard='Other'; }
			
			if($row['Gender'] == 1){ $Gender='Male'; }
			else if($row['Gender'] == 2){ $Gender='Female'; }
			else { $Gender=''; }
			
			if($row['AdmissionType'] == 1){$AdmissionType='Fresh (Ajk)';}
			else if($row['AdmissionType'] == 2){$AdmissionType='Fresh (Other)';}
			else if($row['AdmissionType'] == 3){$AdmissionType='Cond. (AJK)';}
			else if($row['AdmissionType'] == 4){$AdmissionType='Cond. (Other)';}
			else if($row['AdmissionType'] == 5){$AdmissionType='ReAdm. (AJK)';}
			else if($row['AdmissionType'] == 6){$AdmissionType='ReAdm. (Other)';}
						
			$SubjectsList=$row['Sub4Name'].', '.$row['Sub5Name'].', '.$row['Sub6Name']; 
			if($row['Sub7Name']!=''){ $SubjectsList.=', '.$row['Sub7Name']; }
			
			if($row['IsSpecial'] == 1){ $IsSpecial='Board Employee'."'".'s Child'; }
			else if($row['IsSpecial'] == 2){ $IsSpecial='Refugee'."'".'s Child'; }
			else if($row['IsSpecial'] == 3){ $IsSpecial='Normal Case'; }
							
			$html.='<tr>
						<td rowspan="3" style="width:3%;">'.$SrNo.'</td>
						<td style="width:5%;">'.$SSCSession.'-'.$SSCYear.'</td>
						<td style="width:7%;">'.$row['HSSCRegNo'].'</td>
						<td rowspan="3" style="width:5%;">'.$AdmissionType.'</td>
						<td rowspan="3" style="width:10%;">'.$row['Name'].'</td>
						<td rowspan="3" style="width:10%;">'.$row['FatherName'].'</td>
						<td style="width:10%;">'.$row['CNIC'].'</td>
						<td rowspan="3" style="width:5%;">'.$Gender.'</td>
						<td rowspan="3" style="width:10%;">'.$row['GroupName'].'</td>
						<td rowspan="3" style="width:20%;">'.$SubjectsList.'</td>
						<td rowspan="3" style="width:10%;"><img src=../institution-panel/'.$row['PicURL'].' height="70" width="90" /></td>
						<td rowspan="3" style="width:5%;">'.floatval($row['RegistrationFee']).'</td>	
					</tr>
					<tr>          			
						<td>'.$row['SSCRollNo'].'</td>
						<td>'.$HSSCBoard.'</td>	
						<td rowspan="2">'.$IsSpecial.'</td>					
					</tr>
					<tr>          			
						<td>'.$SSCBoard.'</td>
						<td></td>				
					</tr>';
					$SrNo++;
		}
		
		$html.='<tr>
          			<td colspan="11" style="text-align:right; font-weight:bold;">Total: &nbsp; </td>
					<td style="text-align:center; font-weight:bold;">'.floatval($row1['BatchFee']).'</td>
				</tr>';
				
		$html.='</table>';
							 

$mpdf->SetHTMLFooter('<div align="justify" style="font-size:10pt; padding:20px; font-family:calibri">

<div style="width:100%; font-size:9pt; padding-top:10px; padding-bottom:5px; padding-left:10px; padding-right:10px;">
	<div style="width:50%; float:left; text-align:left; padding-top:30px;">PRINCIPAL NAME ________________ </div>
	<div style="width:50%; float:right; text-align:right; padding-top:30px;">SIGNATURE ______________________</div>
</div>', 'O',true);
$mpdf->WriteHTML($html);
//$mpdf->Output('reports/expense_report'.$information['id'].'.pdf','F');
$mpdf->Output();
?>