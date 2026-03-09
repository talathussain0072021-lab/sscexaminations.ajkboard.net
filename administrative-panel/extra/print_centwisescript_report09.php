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

$sql = mysql_query('CALL center_wise_candidates', $conn1);
		
$html="";
$mpdf->SetHTMLHeader('<div style="font-family:sans-serif;"><table width="100%" style="font-family:sans-serif; background-color:#FFF; align:center; float:left; color:#000;">
<tr><td width="100%"></td></tr>
<tr><td style="text-align:right; background-color:#CCC; padding-top:8px; font-size:14pt;"><b>SPECIAL CENTRE WISE CANDIDATES COUNTING STATEMENT HSSC-I(FRESH) ANNUAL 2017</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-size:10pt; text-align:right; margin-right:15px;">Dated: '.$dated.'</span></td></tr>
</table></div>
<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin:10px; border-collapse:collapse; font-size:10pt;">
<tr>
    <td style="background-color:#D1E2F2; width:5%;"><strong>Sr. No.</strong></td>
	<td style="background-color:#D1E2F2; width:5%;"><strong>C.Code</strong></td>
	<td style="background-color:#D1E2F2; width:60%;"><strong>Centre Name</strong></td>
	<td style="background-color:#D1E2F2; width:10%;"><strong>Req. Copies</strong></td>
	<td colspan="2" style="background-color:#D1E2F2;"><strong>No. of Ans. Copies</strong></td>        	
</tr></table> ','O');

		$html.='<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin-left:10px; margin-right:10px; border-collapse:collapse; font-size:10pt;">';
		
		$srno=1; $total_papers=0;
		$sql="SELECT * FROM vw_centerwisescript";
		$res=mysql_query($sql, $conn1);
		while($row=mysql_fetch_array($res))
		{
			$html.='<tr>
						<td style="width:5%;">'.$srno.'</td>
						<td style="width:5%;">'.$row['C-CODE'].'</td>
						<td style="width:60%; text-align:left;">'.$row['CENTRE NAME'].'</td>
						<td style="width:10%;">'.$row['TotalPapers'].'</td>
						<td style="width:10%;"></td>
						<td style="width:10%;"></td>
					</tr>';		
			$srno++; $total_papers+=$row['TotalPapers'];
		}
		
		$html.='<tr>
						<td colspan="3" style="font-weight:bold; text-align:right;">Total: </td>
						<td>'.$total_papers.'</td>
						<td colspan="2"></td>
					</tr>';
				
		$html.='</table>';							 

$mpdf->SetHTMLFooter('<div align="justify" style="font-size:12pt; padding:20px; font-family:calibri">
<div style="float:left"></div>
</div>', 'O',true);
$mpdf->WriteHTML($html);
//$mpdf->Output('reports/expense_report'.$information['id'].'.pdf','F');
$mpdf->Output();
?>