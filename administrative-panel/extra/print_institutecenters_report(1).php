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
		
$html="";
$mpdf->SetHTMLHeader('<div style="font-family:sans-serif;"><table width="100%" style="font-family:sans-serif; background-color:#FFF; align:center; float:left; color:#000;">
<tr><td width="100%"></td></tr>
<tr><td style="text-align:right; background-color:#CCC; padding-top:8px; font-size:14pt;"><b>CENTERS SUMMARY REPORT (REGULAR) </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-size:10pt; text-align:right; margin-right:15px;">Dated: '.$dated.'</span></td></tr>
</table></div>
<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin:10px; border-collapse:collapse; font-size:10pt;">
<tr>
    <td style="background-color:#D1E2F2; width:10%;"><strong>Sr. No.</strong></td>
	<td style="background-color:#D1E2F2; width:15%;"><strong>Institute Code</strong></td>
	<td style="background-color:#D1E2F2; width:55%;"><strong>Institute Name</strong></td>
	<td style="background-color:#D1E2F2; width:10%;"><strong>Student Count</strong></td>
	<td style="background-color:#D1E2F2; width:10%;"><strong>New Center</strong></td>           	
</tr></table> ','O');

		$html.='<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin-left:10px; margin-right:10px; border-collapse:collapse; font-size:10pt;">';
		
		$srno=1; $total_count=0; $center_count=0; $counter=1; $previous_code='0'; $new_code='0';
		
		$sql="SELECT centers.cent_code, centers.cent_name, institutes.inst_name, institute_login.login_code, Count(hssc_registration.std_id) AS std_count FROM centers, hssc_registration, institutes, institute_login WHERE centers.cent_status='1' AND hssc_registration.adm_status='1' AND centers.cent_id=hssc_registration.aexam_center AND institutes.inst_id=hssc_registration.inst_id AND institutes.inst_id=institute_login.inst_id GROUP BY hssc_registration.aexam_center, hssc_registration.inst_id ORDER BY centers.cent_code, institute_login.login_code ASC";
		$res=mysql_query($sql, $conn1);
		while($row=mysql_fetch_array($res))
		{
				$previous_code=$row['cent_code'];
				
				if($counter == 1)
				{ $new_code=$row['cent_code']; }
				
					if($new_code==$previous_code && $counter ==1)
					{
						$html.='<tr>
									<td colspan="2" style="font-weight:bold; text-align:left;">Center Code: '.$row['cent_code'].'</td>
									<td colspan="3" style="font-weight:bold; text-align:left;">Center Name: '.$row['cent_name'].'</td>
								</tr>';		
					}
				
					if($new_code!=$previous_code)
					{
						$new_code=$previous_code;
						$html.='<tr>
									<td colspan="4" style="font-weight:bold; text-align:right;">Total &nbsp; </td>
									<td style="font-weight:bold;">'.$center_count.'</td>
								</tr>
								<tr>
									<td colspan="2" style="font-weight:bold; text-align:left;">Center Code: '.$row['cent_code'].'</td>
									<td colspan="3" style="font-weight:bold; text-align:left;">Center Name: '.$row['cent_name'].'</td>
								</tr>';
						$center_count=$row['std_count']; 
						$srno=1;		
					}
					else
					{ 
						$center_count+=$row['std_count'];
					}
																
				$html.='<tr>
							<td style="width:10%;">'.$srno.'</td>
							<td style="width:15%;">'.$row['login_code'].'</td>
							<td style="width:55%; text-align:left;">'.$row['inst_name'].'</td>
							<td style="width:10%;">'.$row['std_count'].'</td>
							<td style="width:10%;"></td>
						</tr>';					
					
					$total_count+=$row['std_count'];
					
					if($previous_code==918 && $srno==4)
					{
						
						$html.='<tr>
									<td colspan="4" style="font-weight:bold; text-align:right;">Total &nbsp; </td>
									<td style="font-weight:bold;">'.$center_count.'</td>
								</tr>';
							
					}
					
					$srno++; $counter++;
		}
			$html.='<tr>
						<td colspan="4" style="font-weight:bold; text-align:right;">Grand Total &nbsp; </td>
						<td style="font-weight:bold;">'.$total_count.'</td>
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