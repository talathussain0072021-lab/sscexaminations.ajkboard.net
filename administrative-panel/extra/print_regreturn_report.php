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

$first_number=$_REQUEST['first_number']-1;

$sql_sessions="SELECT * FROM sessions WHERE IsCurrent=1 ORDER BY Id DESC limit 1;";
$res_sessions=mysql_query($sql_sessions, $conn1);
$row_sessions=mysql_fetch_array($res_sessions);
$SessionId=$row_sessions['Id'];
$SessionName=$row_sessions['Name'];
		
$html="";
$mpdf->SetHTMLHeader('<div style="font-family:sans-serif;"><table width="100%" style="font-family:sans-serif; background-color:#FFF; align:center; float:left; color:#000;">
<tr><td width="100%"></td></tr>
<tr><td style="text-align:right; background-color:#CCC; padding-top:8px; font-size:14pt;"><b>AJKBISE - REGISTRATION RETURN '.$SessionName.' (OFFICIAL)</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-size:10pt; text-align:right; margin-right:15px;"><strong>Dated: </strong>'.$dated.'&nbsp;&nbsp;</span></td></tr>
</table></div> ','O');

//<div style="background-color:#CCC; text-align:center; padding-top:8px;" height="30px" ><span style="font-size:20px"><b>General Sale Report</b></span><div style="font-size:12px; text-align:right; margin-right:15px; margin-top:-10px;"><strong>Sale Period=</strong>'.date('d-m-Y',strtotime($_REQUEST['start_date'])).' to ' .date('d-m-Y',strtotime($_REQUEST['end_date'])).'</div></div>';

		$html.='<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin-left:10px; margin-right:10px; border-collapse:collapse; font-size:9pt;">
				<tr>
					<td style="border:1px solid #000; background-color:#D1E2F2; width:3%;"><strong>Sr. No.</strong></td>
					<td style="border:1px solid #000; background-color:#D1E2F2; width:5%;"><strong>District/ <br> Special</strong></td>
					<td style="border:1px solid #000; background-color:#D1E2F2; width:5%;"><strong>Inst. Code</strong></td>
					<td style="border:1px solid #000; background-color:#D1E2F2; width:5%;"><strong>SSC Record</strong></td>
					<td style="border:1px solid #000; background-color:#D1E2F2; width:7%;"><strong>HSSC Record</strong></td>
					<td style="border:1px solid #000; background-color:#D1E2F2; width:5%;"><strong>Adm. Type</strong></td>
					<td style="border:1px solid #000; background-color:#D1E2F2; width:10%;"><strong>Student Name</strong></td>
					<td style="border:1px solid #000; background-color:#D1E2F2; width:10%;"><strong>Father Name</strong></td>					
					<td style="border:1px solid #000; background-color:#D1E2F2; width:5%;"><strong>Gender</strong></td>
					<td style="border:1px solid #000; background-color:#D1E2F2; width:10%;"><strong>Group</strong></td>	
					<td style="border:1px solid #000; background-color:#D1E2F2; width:20%;"><strong>Subjects</strong></td>
					<td style="border:1px solid #000; background-color:#D1E2F2; width:10%;"><strong>Picture</strong></td>
					<td style="border:1px solid #000; background-color:#D1E2F2; width:5%;"><strong>Fee</strong></td>          	
				</tr>';
					
			$SrNo=$first_number+1;
			$sql="SELECT Id, SSCYear, SSCRollNo, SSCSession, SSCBoard, HSSCRegNo, HSSCBoard, Name, FatherName, PicURL, CNIC, Gender, IsSpecial, GroupName, AdmissionType, Sub4Name, Sub5Name, Sub6Name, Sub7Name, BatchNo, RegistrationFee, RegInstituteCode, RegInstituteDistrict FROM vwregstudents WHERE SessionId=".$SessionId."";
							
				if(isset($_REQUEST['InstituteId']) && $_REQUEST['InstituteId']!='All')
				{ $sql.=" AND RegInstituteId=".$_REQUEST['InstituteId'].""; }
						
				if(isset($_REQUEST['IsSpecial']) && $_REQUEST['IsSpecial']!='All')
				{ $sql.=" AND IsSpecial=".$_REQUEST['IsSpecial'].""; }	
								
				if(isset($_REQUEST['AdmissionType']) && $_REQUEST['AdmissionType']!='All')
				{ 
					$sql.=" AND AdmissionType=".$_REQUEST['AdmissionType']."";						
				}
								
				$sql.=" AND BatchId is Not NULL ORDER BY RegInstituteDistrict, RegInstituteCode ASC limit {$first_number}, 250";
							
			$res=mysql_query($sql, $conn1);
			while($row=mysql_fetch_array($res))
			{	
				if($row['SSCSession'] == 1){ $SSCSession='A'; }
				else if($row['SSCSession'] == 2){ $SSCSession='S'; }
				else { $SSCSession=''; }
				
				$SSCYear=str_pad($row['SSCYear'],2,'0',STR_PAD_LEFT); 
				
				if($row['SSCBoard'] == 0){ $SSCBoard=''; } else if($row['SSCBoard'] == 1){ $SSCBoard='AJK'; }
				else if($row['SSCBoard'] == 2){ $SSCBoard='Federal'; } else if($row['SSCBoard'] == 3){ $SSCBoard='Lahore'; }
				else if($row['SSCBoard'] == 4){ $SSCBoard='Gujranwala'; } else if($row['SSCBoard'] == 5){ $SSCBoard='Rawalpindi'; }
				else if($row['SSCBoard'] == 6){ $SSCBoard='Sargoda'; } else if($row['SSCBoard'] == 7){ $SSCBoard='Faisalabad'; }
				else if($row['SSCBoard'] == 8){ $SSCBoard='Multan'; } else if($row['SSCBoard'] == 9){ $SSCBoard='Bhawalpur'; }
				else if($row['SSCBoard'] == 10){ $SSCBoard='Dera Gazi Khan'; } else if($row['SSCBoard'] == 11){ $SSCBoard='Abbottabad'; }
				else if($row['SSCBoard'] == 12){ $SSCBoard='Peshawar'; } else if($row['SSCBoard'] == 13){ $SSCBoard='Bannu'; }
				else if($row['SSCBoard'] == 14){ $SSCBoard='Sawat'; } else if($row['SSCBoard'] == 15){ $SSCBoard='Quetta'; }
				else if($row['SSCBoard'] == 16){ $SSCBoard='Karachi SSC'; } else if($row['SSCBoard'] == 17){ $SSCBoard='Karachi HSSC'; }
				else if($row['SSCBoard'] == 18){ $SSCBoard='Hayderabad'; } else if($row['SSCBoard'] == 19){ $SSCBoard='Larkana'; }
				else if($row['SSCBoard'] == 20){ $SSCBoard='Sakhar'; } else if($row['SSCBoard'] == 21){ $SSCBoard='Khairpur'; }
				else if($row['SSCBoard'] == 22){ $SSCBoard='Lahore Technical'; } else if($row['SSCBoard'] == 23){ $SSCBoard='Peshawar Technical'; }
				else if($row['SSCBoard'] == 24){ $SSCBoard='Sindh Technical'; } else if($row['SSCBoard'] == 25){ $SSCBoard='Sirinagar'; }
				else if($row['SSCBoard'] == 26){ $SSCBoard='Jammu'; } else if($row['SSCBoard'] == 27){ $SSCBoard='Kohat'; }
				else if($row['SSCBoard'] == 30){ $SSCBoard='Armed Services Board'; } else if($row['SSCBoard'] == 31){ $SSCBoard='AIOU'; }
				else if($row['SSCBoard'] == 32){ $SSCBoard='Mardan'; } else if($row['SSCBoard'] == 33){ $SSCBoard='Baluchistan'; }
				else if($row['SSCBoard'] == 34){ $SSCBoard='Karakurum University'; } else if($row['SSCBoard'] == 35){ $SSCBoard='Wafaq-Ul-Maddars'; }
				else if($row['SSCBoard'] == 36){ $SSCBoard='Others'; }
				
				if($row['HSSCBoard'] == 0){ $HSSCBoard=''; } else if($row['HSSCBoard'] == 1){ $HSSCBoard='AJK'; }
				else if($row['HSSCBoard'] == 2){ $HSSCBoard='Federal'; } else if($row['HSSCBoard'] == 3){ $HSSCBoard='Lahore'; }
				else if($row['HSSCBoard'] == 4){ $HSSCBoard='Gujranwala'; } else if($row['HSSCBoard'] == 5){ $HSSCBoard='Rawalpindi'; }
				else if($row['HSSCBoard'] == 6){ $HSSCBoard='Sargoda'; } else if($row['HSSCBoard'] == 7){ $HSSCBoard='Faisalabad'; }
				else if($row['HSSCBoard'] == 8){ $HSSCBoard='Multan'; } else if($row['HSSCBoard'] == 9){ $HSSCBoard='Bhawalpur'; }
				else if($row['HSSCBoard'] == 10){ $HSSCBoard='Dera Gazi Khan'; } else if($row['HSSCBoard'] == 11){ $HSSCBoard='Abbottabad'; }
				else if($row['HSSCBoard'] == 12){ $HSSCBoard='Peshawar'; } else if($row['HSSCBoard'] == 13){ $HSSCBoard='Bannu'; }
				else if($row['HSSCBoard'] == 14){ $HSSCBoard='Sawat'; } else if($row['HSSCBoard'] == 15){ $HSSCBoard='Quetta'; }
				else if($row['HSSCBoard'] == 16){ $HSSCBoard='Karachi SSC'; } else if($row['HSSCBoard'] == 17){ $HSSCBoard='Karachi HSSC'; }
				else if($row['HSSCBoard'] == 18){ $HSSCBoard='Hayderabad'; } else if($row['HSSCBoard'] == 19){ $HSSCBoard='Larkana'; }
				else if($row['HSSCBoard'] == 20){ $HSSCBoard='Sakhar'; } else if($row['HSSCBoard'] == 21){ $HSSCBoard='Khairpur'; }
				else if($row['HSSCBoard'] == 22){ $HSSCBoard='Lahore Technical'; } else if($row['HSSCBoard'] == 23){ $HSSCBoard='Peshawar Technical'; }
				else if($row['HSSCBoard'] == 24){ $HSSCBoard='Sindh Technical'; } else if($row['HSSCBoard'] == 25){ $HSSCBoard='Sirinagar'; }
				else if($row['HSSCBoard'] == 26){ $HSSCBoard='Jammu'; } else if($row['HSSCBoard'] == 27){ $HSSCBoard='Kohat'; }
				else if($row['HSSCBoard'] == 30){ $HSSCBoard='Armed Services Board'; } else if($row['HSSCBoard'] == 31){ $HSSCBoard='AIOU'; }
				else if($row['HSSCBoard'] == 32){ $HSSCBoard='Mardan'; } else if($row['HSSCBoard'] == 33){ $HSSCBoard='Baluchistan'; }
				else if($row['HSSCBoard'] == 34){ $HSSCBoard='Karakurum University'; } else if($row['HSSCBoard'] == 35){ $HSSCBoard='Wafaq-Ul-Maddars'; }
				else if($row['HSSCBoard'] == 36){ $HSSCBoard='Others'; }
				
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
				
				if($row['IsSpecial'] == 1){ $IsSpecial='Board'; }
				else if($row['IsSpecial'] == 2){ $IsSpecial='Refugee'; }
				else if($row['IsSpecial'] == 3){ $IsSpecial='Normal'; }
													
				$html.='<tr>
						<td rowspan="3" style="width:3%;">'.$SrNo.'</td>
						<td style="width:5%;">'.$row['RegInstituteDistrict'].'</td>
						<td style="width:5%;">'.$row['RegInstituteCode'].'</td>
						<td style="width:5%;">'.$SSCSession.'-'.$SSCYear.'</td>
						<td style="width:7%;">'.$row['HSSCRegNo'].'</td>
						<td rowspan="3" style="width:5%;">'.$AdmissionType.'</td>
						<td rowspan="3" style="width:10%;">'.$row['Name'].'</td>
						<td rowspan="3" style="width:10%;">'.$row['FatherName'].'</td>
						<td rowspan="3" style="width:5%;">'.$Gender.'</td>
						<td rowspan="3" style="width:10%;">'.$row['GroupName'].'</td>
						<td rowspan="3" style="width:20%;">'.$SubjectsList.'</td>
						<td rowspan="3" style="width:10%;"><img src='.'../institution-panel/'.$row['PicURL'].' height="70" width="90" /></td>
						<td rowspan="3" style="width:5%;">'.floatval($row['RegistrationFee']).'</td>	
					</tr>
					<tr>          			
						<td style="">'.$IsSpecial.'</td>
						<td style="">'.$row['BatchNo'].'</td>
						<td style="">'.$row['SSCRollNo'].'</td>
						<td style="">'.$HSSCBoard.'</td>					
					</tr>
					<tr>          			
						<td style=""></td>						
						<td style=""></td>
						<td style="">'.$SSCBoard.'</td>
						<td style=""></td>										
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