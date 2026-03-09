<?php include('includes/config.php');
include("MPDF57/mpdf.php");
ob_start();
ob_clean();
$mpdf=new mPDF('c','A4','','',5,5,35,10,15,10); 
$mpdf->useOnlyCoreFonts = true;    // false is default
//$mpdf->SetProtection(array('print'));
$mpdf->SetDisplayMode('fullpage');
$mpdf->zoom = 100;

$h = "5"; $hm = $h * 60; $ms = $hm * 60;
$dated = gmdate("d-m-Y", time()+($ms));

$first_number=$_REQUEST['first_number']-1;
		
$html="";
$mpdf->SetHTMLHeader('<div style="font-family:sans-serif;"><table width="100%" style="font-family:sans-serif; background-color:#CCC; align:center; float:left; color:#000;">
<tr>
	<td style="font-size:9pt; text-align:right; width:15%; vertical-align:bottom;"></td>
	<td style="font-size:14pt; text-align:center; width:70%; vertical-align:middle;"><b>VALIDATION REPORT (CENTRE CHANGE)</b></td>
	<td style="font-size:9pt; text-align:right; width:15%; vertical-align:bottom;">Dated: '.$dated.'</td>
</tr></table></div>
<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin:10px; border-collapse:collapse; font-size:10pt;">
<tr>
	<td style="background-color:#D1E2F2; width:5%;"><strong>Sr. No.</strong></td>
	<td style="background-color:#D1E2F2; width:10%;"><strong>App. No.</strong></td>
	<td style="background-color:#D1E2F2; width:10%;"><strong>Inst. Code</strong></td>	
	<td style="background-color:#D1E2F2; width:45%;"><strong>Student Name</strong></td>
	<td style="background-color:#D1E2F2; width:10%;"><strong>Gender</strong></td>
	<td style="background-color:#D1E2F2; width:10%;"><strong>Previous Centre</strong></td> 
	<td style="background-color:#D1E2F2; width:10%;"><strong>New Centre</strong></td>          	
</tr></table>','O');

//<div style="background-color:#CCC; text-align:center; padding-top:8px;" height="30px" ><span style="font-size:20px"><b>General Sale Report</b></span><div style="font-size:12px; text-align:right; margin-right:15px; margin-top:-10px;"><strong>Sale Period=</strong>'.date('d-m-Y',strtotime($_REQUEST['start_date'])).' to ' .date('d-m-Y',strtotime($_REQUEST['end_date'])).'</div></div>';

			$html.='<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin-left:10px; margin-right:10px; border-collapse:collapse; font-size:10pt;">';
					
			$srno=$first_number+1;
			$sql="SELECT * FROM hssc_registration, centers WHERE hssc_registration.reg_session='".$_REQUEST['session_code']."' AND hssc_registration.pexam_center!=hssc_registration.aexam_center AND hssc_registration.aexam_center=centers.cent_id ORDER BY cent_code ASC limit {$first_number}, 1000";
			$res=mysql_query($sql, $conn1);
			while($row=mysql_fetch_array($res))
			{				
				if($row['std_gender']=='1'){ $gender='Male'; } else if($row['std_gender']=='2'){ $gender='Female'; }
				
				$sql1="SELECT cent_code FROM centers WHERE cent_id='".$row['pexam_center']."'";
				$res1=mysql_query($sql1, $conn1);
				$row1=mysql_fetch_array($res1);
					
				$sql2="SELECT cent_code FROM centers WHERE cent_id='".$row['aexam_center']."'";
				$res2=mysql_query($sql2, $conn1);
				$row2=mysql_fetch_array($res2);
				
				$sql_institutes="SELECT * FROM institutes, institute_login WHERE institutes.inst_id='".$row['inst_id']."' AND institute_login.inst_id=institutes.inst_id";
				$res_institutes=mysql_query($sql_institutes, $conn1);
				$row_institutes=mysql_fetch_array($res_institutes);
				$inst_code=$row_institutes['login_code'];
							
				$html.='<tr>
							<td style="width:5%;">'.$srno.'</td>
							<td style="width:10%;">'.$row['std_id'].'</td>
							<td style="width:10%;">'.$inst_code.'</td>
							<td style="width:45%; text-align:left;">'.$row['std_name'].'</td>
							<td style="width:10%;">'.$gender.'</td>
							<td style="width:10%;">'.$row1['cent_code'].'</td>
							<td style="width:10%;">'.$row2['cent_code'].'</td>	
					</tr>';
					$srno++;
		}
				
		$html.='</table>';
							 

$mpdf->SetHTMLFooter('<div align="justify" style="font-size:12px; padding:20px; font-family:calibri">
<div style="float:left">
</div>

<br><br><br><br><br><br>

</div>', 'O',true);
$mpdf->WriteHTML($html);
//$mpdf->Output('reports/expense_report'.$information['id'].'.pdf','F');
$mpdf->Output();
?>