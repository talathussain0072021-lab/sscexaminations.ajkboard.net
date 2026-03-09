<?php include('includes/config.php');
include("MPDF57/mpdf.php");
ob_start();
ob_clean();
$mpdf=new mPDF('c','A4','','',5,5,35,10,15,05); 
$mpdf->useOnlyCoreFonts = true;    // false is default
//$mpdf->SetProtection(array('print'));
$mpdf->SetDisplayMode('fullpage');
$mpdf->zoom = 100;

$h = "5"; $hm = $h * 60; $ms = $hm * 60;
$dated = gmdate("d-m-Y", time()+($ms));
		
$html="";
$mpdf->SetHTMLHeader('<div style="font-family:sans-serif;"><table width="100%" style="font-family:sans-serif; background-color:#CCC; align:center; float:left; color:#000;">
<tr>
	<td style="font-size:9pt; text-align:right; width:15%; vertical-align:bottom;"></td>
	<td style="font-size:14pt; text-align:center; width:70%; vertical-align:middle;"><b>CENTRES REPORT</b></td>
	<td style="font-size:9pt; text-align:right; width:15%; vertical-align:bottom;">Dated: '.$dated.'</td>
</tr></table></div>
<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin:10px; border-collapse:collapse; font-size:10pt;">
<tr>
    <td style="background-color:#D1E2F2; width:5%;"><strong>Sr. No.</strong></td>
	<td style="background-color:#D1E2F2; width:10%;"><strong>Code</strong></td>
	<td style="background-color:#D1E2F2; width:60%;"><strong>Name</strong></td>
	<td style="background-color:#D1E2F2; width:10%;"><strong>Type</strong></td>
	<td style="background-color:#D1E2F2; width:15%;"><strong>District</strong></td>         	
</tr></table>','O');

//<div style="background-color:#CCC; text-align:center; padding-top:8px;" height="30px" ><span style="font-size:20px"><b>General Sale Report</b></span><div style="font-size:12px; text-align:right; margin-right:15px; margin-top:-10px;"><strong>Sale Period=</strong>'.date('d-m-Y',strtotime($_REQUEST['start_date'])).' to ' .date('d-m-Y',strtotime($_REQUEST['end_date'])).'</div></div>';

		$html.='<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin-left:10px; margin-right:10px; border-collapse:collapse; font-size:10pt;">';
		$srno=1;
		$sql="SELECT Name, Code, Type, District FROM centres WHERE Name is Not NULL AND IsActive=1 ORDER BY District ASC, Code ASC";
		$res=mysql_query($sql, $conn1);
		while($row=mysql_fetch_array($res))
		{	
			if($row['Type']=='1'){ $Type='Boys'; }
			else if($row['Type']=='2'){ $Type='Girls'; }
			else if($row['Type']=='3'){ $Type='Co-Edu.'; }
			else { $Type=''; }
							
			if($row['District']=='1'){ $District='Muzaffarabad'; }
			else if($row['District']=='2'){ $District='Mirpur'; }
			else if($row['District']=='3'){ $District='Bhimber'; }
			else if($row['District']=='4'){ $District='Kotli'; }
			else if($row['District']=='5'){ $District='Bagh'; }
			else if($row['District']=='6'){ $District='Poonch'; }
			else if($row['District']=='7'){ $District='Sudhanoti'; }
			else if($row['District']=='9'){ $District='Neelam'; }
			else if($row['District']=='10'){ $District='Hattian Bala'; }
			else if($row['District']=='11'){ $District='Haveli'; }
			else { $District=''; }
											
			$html.='<tr>
						<td style="width:5%;">'.$srno.'</td>
						<td style="width:10%;">'.$row['Code'].'</td>
						<td style="width:60%; text-align:left;">'.$row['Name'].'</td>
						<td style="width:10%;">'.strtoupper($Type).'</td>
						<td style="width:15%;">'.strtoupper($District).'</td>
					</tr>';
					$srno++;
		}
				
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