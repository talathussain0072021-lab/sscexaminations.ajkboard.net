<?php include('includes/config.php');
include("MPDF57/mpdf.php");
ob_start();
ob_clean();
$mpdf=new mPDF('c','A4','','',15,5,15,10,5,5); 
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
<tr><td style="text-align:center; background-color:#CCC; padding-top:8px; font-size:13pt;"><b>PICTURES VALIDATION REPORT '.$_REQUEST['session_title'].' (OFFICIAL)</b></td></tr>
</table></div> ','O');

//<div style="background-color:#CCC; text-align:center; padding-top:8px;" height="30px" ><span style="font-size:20px"><b>General Sale Report</b></span><div style="font-size:12px; text-align:right; margin-right:15px; margin-top:-10px;"><strong>Sale Period=</strong>'.date('d-m-Y',strtotime($_REQUEST['start_date'])).' to ' .date('d-m-Y',strtotime($_REQUEST['end_date'])).'</div></div>';

		$html.='<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin-left:10px; margin-right:10px; border-collapse:collapse; font-size:10pt;">';
		$html.='<tr>';
					
		$i=0; $counter=1; $previous_code='0'; $new_code='0';		
		$sql="SELECT * FROM hssc_registration, institute_login, institutes WHERE hssc_registration.reg_session='".$_REQUEST['session_code']."' AND hssc_registration.batch_id!='0' AND hssc_registration.pic_validate='1' AND hssc_registration.inst_id=institute_login.inst_id AND institutes.inst_id=institute_login.inst_id ORDER BY institute_login.login_code, hssc_registration.batch_id, hssc_registration.std_id ASC limit {$first_number}, 700";
		$res=mysql_query($sql, $conn1);
		while($row=mysql_fetch_array($res))
		{							
			$new_code=$row['login_code'];
				
			if($counter == 1)
			{ $previous_code=$row['login_code']; }
				
			if($new_code!=$previous_code)
			{
				$previous_code=$new_code;
				
				$html.='</td></tr></table><pagebreak />'; $i=0;
				$html.='<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin-left:10px; margin-right:10px; border-collapse:collapse; font-size:10pt;">';
				$html.='<tr>';
			}
			
			$serial_part=substr($row['std_pic'],10,8);
			
			$html.='<td><img src='.'../institution-panel/'.$row['std_pic'].' height="80" width="90" /><br>'.$serial_part.'</td>';
			$i++;
			
			if($i%7 == 0){ $html.='</tr><tr>'; $i=0; }
			$counter++;
			
		}
				
		$html.='</table>';
							 

$mpdf->SetHTMLFooter('<div align="justify" style="font-size:12px; padding:20px; font-family:calibri">
<div style="float:left">
</div>

<br>

<div style="width:100%; float:left; text-align:left; font-size:10px;"></div>

</div>', 'O',true);
$mpdf->WriteHTML($html);
//$mpdf->Output('reports/expense_report'.$information['id'].'.pdf','F');
$mpdf->Output();
?>