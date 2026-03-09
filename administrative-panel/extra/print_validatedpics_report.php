<?php include('includes/config.php');
include("MPDF57/mpdf.php");
ob_start();
ob_clean();
$mpdf=new mPDF('c','A4','','',7,7,17,10,5,5); 
$mpdf->useOnlyCoreFonts = true;    // false is default
//$mpdf->SetProtection(array('print'));
$mpdf->SetDisplayMode('fullpage');
$mpdf->zoom = 100;

$h = "5"; $hm = $h * 60; $ms = $hm * 60;
$dated = gmdate("d-m-Y g:i:s A", time()+($ms));

$first_number=$_REQUEST['first_number']-1;
		
$html="";
$mpdf->SetHTMLHeader('<div style="font-family:sans-serif;"><table width="100%" style="font-family:sans-serif; background-color:#FFF; align:center; float:left; color:#000;">
<tr><td width="100%"></td></tr>
<tr><td style="text-align:center; background-color:#CCC; padding-top:8px; font-size:14pt;"><b>HSSC PICTURES VALIDATION REPORT '.$_REQUEST['session_title'].'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-size:10pt; text-align:right; margin-right:15px;"></span></td></tr>
</table></div> ','O');

//<div style="background-color:#CCC; text-align:center; padding-top:8px;" height="30px" ><span style="font-size:20px"><b>General Sale Report</b></span><div style="font-size:12px; text-align:right; margin-right:15px; margin-top:-10px;"><strong>Sale Period=</strong>'.date('d-m-Y',strtotime($_REQUEST['start_date'])).' to ' .date('d-m-Y',strtotime($_REQUEST['end_date'])).'</div></div>';
					
		$srno=1; $counter=1; $previous_code='0'; $new_code='0';
		
		$sql="SELECT * FROM hssc_registration, institute_login, institutes WHERE hssc_registration.reg_session='".$_REQUEST['session_code']."' AND hssc_registration.batch_id!='0' AND hssc_registration.pic_validate='1' AND hssc_registration.inst_id=institute_login.inst_id AND institutes.inst_id=institute_login.inst_id ORDER BY institute_login.login_code, hssc_registration.batch_id, hssc_registration.std_id ASC limit {$first_number}, 500";
		$res=mysql_query($sql, $conn1);
		while($row=mysql_fetch_array($res))
		{	
				$previous_code=$row['login_code'];
				
				if($counter == 1)
				{ $new_code=$row['login_code']; 
				
				$html.='<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin-left:5px; margin-right:5px; border-collapse:collapse; font-size:10pt;">
						<tr>
							<td colspan="3" style="text-align:left;"><strong>Inst. Code: '.$row['login_code'].'</strong></td>
							<td colspan="3" style="text-align:left;"><strong>Inst. Name: '.$row['inst_name'].'</strong></td>
						</tr>
						<tr>
							<td style="background-color:#D1E2F2; width:3%;"><strong>Sr. No.</strong></td>
							<td style="background-color:#D1E2F2; width:7%;"><strong>Batch #</strong></td>
							<td style="background-color:#D1E2F2; width:10%;"><strong>Student ID</strong></td>							
							<td style="background-color:#D1E2F2; width:35%;"><strong>Student Name</strong></td>
							<td style="background-color:#D1E2F2; width:35%;"><strong>Father Name</strong></td>
							<td style="background-color:#D1E2F2; width:10%;"><strong>Photo ID</strong></td>       	
						</tr>';
				}
				
					if($row['ssc_session']=='1'){ $ssc_session='A'; } else if($row['ssc_session']=='2'){ $ssc_session='S'; } else { $ssc_session=''; }
								
					if($row['ssc_board']=='0'){ $ssc_board=''; } else if($row['ssc_board']=='1'){ $ssc_board='AJK'; } else if($row['ssc_board']=='2'){ $ssc_board='FEDERAL'; }
					else if($row['ssc_board']=='3'){ $ssc_board='LAHORE'; } else if($row['ssc_board']=='4'){ $ssc_board='GUJRANWALA'; } else if($row['ssc_board']=='5'){ $ssc_board='RAWALPINDI'; }
					else if($row['ssc_board']=='6'){ $ssc_board='SARGODA'; } else if($row['ssc_board']=='7'){ $ssc_board='FAISALABAD'; } else if($row['ssc_board']=='8'){ $ssc_board='MULTAN'; }
					else if($row['ssc_board']=='9'){ $ssc_board='BHAWALPUR'; } else if($row['ssc_board']=='10'){ $ssc_board='DERA GAZI KHAN'; } else if($row['ssc_board']=='11'){ $ssc_board='ABBOTTABAD'; }
					else if($row['ssc_board']=='12'){ $ssc_board='PESHAWAR'; } else if($row['ssc_board']=='13'){ $ssc_board='BANNU'; } else if($row['ssc_board']=='14'){ $ssc_board='SAWAT'; }
					else if($row['ssc_board']=='15'){ $ssc_board='QUETTA'; } else if($row['ssc_board']=='16'){ $ssc_board='KARACHI SSC'; } else if($row['ssc_board']=='17'){ $ssc_board='KARACHI HSSC'; }
					else if($row['ssc_board']=='18'){ $ssc_board='HAYDERABAD'; } else if($row['ssc_board']=='19'){ $ssc_board='LARKANA'; } else if($row['ssc_board']=='20'){ $ssc_board='SAKHAR'; }
					else if($row['ssc_board']=='21'){ $ssc_board='KHAIRPUR'; } else if($row['ssc_board']=='22'){ $ssc_board='LAHORE TECHNICAL'; } else if($row['ssc_board']=='23'){ $ssc_board='PESHAWAR TECHNICAL'; }
					else if($row['ssc_board']=='24'){ $ssc_board='SINDH TECHNICAL'; } else if($row['ssc_board']=='25'){ $ssc_board='SIRINAGAR'; } else if($row['ssc_board']=='26'){ $ssc_board='JAMMU'; }
					else if($row['ssc_board']=='27'){ $ssc_board='KOHAT'; } else if($row['ssc_board']=='30'){ $ssc_board='ARMED SERVICES BOARD'; } else if($row['ssc_board']=='31'){ $ssc_board='AIOU'; }
					else if($row['ssc_board']=='32'){ $ssc_board='MARDAN'; } else if($row['ssc_board']=='33'){ $ssc_board='BALUCHISTAN'; } else if($row['ssc_board']=='34'){ $ssc_board='KARAKURUM UNIVERSITY'; }
					else if($row['ssc_board']=='35'){ $ssc_board='WAFAQ-UL-MADDARS'; } else if($row['ssc_board']=='36'){ $ssc_board='OTHERS'; } else if($row['ssc_board']=='34'){ $ssc_board='KARAKURUM UNIVERSITY'; }
				
					$sql1="SELECT batch_no FROM hssc_batches WHERE batch_id='".$row['batch_id']."'";
					$res1=mysql_query($sql1, $conn1);
					$row1=mysql_fetch_array($res1);
								
					if($new_code!=$previous_code)
					{
						$srno=1;
						$new_code=$previous_code;
						$html.='</table>
						<pagebreak />
						<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin-left:5px; margin-right:5px; border-collapse:collapse; font-size:10pt;">
						<tr>
							<td colspan="3" style="text-align:left;"><strong>Inst. Code: '.$row['login_code'].'</strong></td>
							<td colspan="3" style="text-align:left;"><strong>Inst. Name: '.$row['inst_name'].'</strong></td>
						</tr>
						<tr>
							<td style="background-color:#D1E2F2; width:3%;"><strong>Sr. No.</strong></td>
							<td style="background-color:#D1E2F2; width:7%;"><strong>Batch #</strong></td>
							<td style="background-color:#D1E2F2; width:10%;"><strong>Student ID</strong></td>							
							<td style="background-color:#D1E2F2; width:35%;"><strong>Student Name</strong></td>
							<td style="background-color:#D1E2F2; width:35%;"><strong>Father Name</strong></td>
							<td style="background-color:#D1E2F2; width:10%;"><strong>Photo ID</strong></td>      	
						</tr>';
					}
					
					$serial_part=substr($row['std_pic'],10,8);		
					$html.='<tr>
							<td style="width:3%;">'.$srno.'</td>
							<td style="width:7%;">'.$row1['batch_no'].'</td>
							<td style="width:10%;">'.$row['std_id'].'</td>		
							<td style="width:35%; text-align:left;">'.$row['std_name'].'</td>
							<td style="width:35%; text-align:left;">'.$row['std_father_name'].'</td>
							<td style="width:10%;">'.$serial_part.'</td>						
						</tr>';
						$srno++; $counter++;
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