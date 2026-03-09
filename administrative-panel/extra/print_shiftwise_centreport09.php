<?php include('includes/config.php');
include("MPDF57/mpdf.php");
ob_start();
ob_clean();
$mpdf=new mPDF('c','A4-L','','',5,5,35,10,15,05); 
$mpdf->useOnlyCoreFonts = true;    // false is default
$mpdf->SetDisplayMode('fullpage');
$mpdf->zoom = 100;

$h = "5"; $hm = $h * 60; $ms = $hm * 60;
$dated = gmdate("d-m-Y", time()+($ms));

$sql = mysql_query('CALL cent_cand_withshifts', $conn1);
		
$html="";
$mpdf->SetHTMLHeader('<div style="font-family:sans-serif;"><table width="100%" style="font-family:sans-serif; background-color:#CCC; align:center; float:left; color:#000;">
<tr>
	<td style="font-size:9pt; text-align:right; width:15%; vertical-align:bottom;"></td>
	<td style="font-size:14pt; text-align:center; width:70%; vertical-align:middle;"><b>CENTRES SUMMARY REPORT (WITH SHIFTS)</b></td>
	<td style="font-size:9pt; text-align:right; width:15%; vertical-align:bottom;">Dated: '.$dated.'</td>
</tr></table></div>
<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin:5px; border-collapse:collapse; font-size:9pt;">
<tr>
    <td style="background-color:#D1E2F2; width:5%;"><strong>Sr. No.</strong></td>
	<td style="background-color:#D1E2F2; width:5%;"><strong>Centre Code</strong></td>
	<td style="background-color:#D1E2F2; width:25%;"><strong>Centre Name</strong></td>
<td style="background-color:#D1E2F2; width:5%;"><strong>Group1</strong></td>
<td style="background-color:#D1E2F2; width:5%;"><strong>Group2</strong></td>
	<td style="background-color:#D1E2F2; width:5%;"><strong>Total</strong></td>
	<td style="background-color:#D1E2F2; width:5%;"><strong>Regular</strong></td> 
	<td style="background-color:#D1E2F2; width:5%;"><strong>Private</strong></td>
	<td style="background-color:#D1E2F2; width:5%;"><strong>HMN</strong></td> 
	<td style="background-color:#D1E2F2; width:5%;"><strong>P-M</strong></td> 
	<td style="background-color:#D1E2F2; width:5%;"><strong>P-E</strong></td> 
	<td style="background-color:#D1E2F2; width:5%;"><strong>G-S</strong></td>
	<td style="background-color:#D1E2F2; width:5%;"><strong>CMC</strong></td>
	<td style="background-color:#D1E2F2; width:5%;"><strong>MED-TECH</strong></td>
	<td style="background-color:#D1E2F2; width:5%;"><strong>Male</strong></td>
	<td style="background-color:#D1E2F2; width:5%;"><strong>Female</strong></td>           	
</tr></table>','O');

		$html.='<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin-left:5px; margin-right:5px; border-collapse:collapse; font-size:9pt;">';
		
		$srno=1;
		$sql="SELECT * FROM cent_withshift";
		$res=mysql_query($sql, $conn1);
		while($row=mysql_fetch_array($res))
		{
			
			$html.='<tr>
						<td style="width:5%;">'.$srno.'</td>
						<td style="width:5%;">'.$row['C-CODE'].'</td>
						<td style="width:25%; text-align:left;">'.$row['CENTRE NAME'].'</td>
<td style="width:5%;">'.$row['Group1'].'</td>
<td style="width:5%;">'.$row['Group2'].'</td>

						<td style="width:5%;">'.$row['TOTAL'].'</td>
						<td style="width:5%;">'.$row['REG'].'</td>
						<td style="width:5%;">'.$row['PRV'].'</td>
						<td style="width:5%;">'.$row['HMN'].'</td>
						<td style="width:5%;">'.$row['P-M'].'</td>
						<td style="width:5%;">'.$row['P-E'].'</td>
						<td style="width:5%;">'.$row['G-S'].'</td>
						<td style="width:5%;">'.$row['CMC'].'</td>
						<td style="width:5%;">'.$row['MED-TECH'].'</td>
						<td style="width:5%;">'.$row['MALE'].'</td>
						<td style="width:5%;">'.$row['FEMALE'].'</td>
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