<?php include('includes/config.php');
include("MPDF57/mpdf.php");
ob_start();
ob_clean();
$mpdf=new mPDF('c','A4','','',15,05,15,10,0,0); 
$mpdf->useOnlyCoreFonts = true; // false is default
//$mpdf->SetProtection(array('print'));
$mpdf->SetDisplayMode('fullpage');
$mpdf->zoom = 100;

$h = "5"; $hm = $h * 60; $ms = $hm * 60;
$dated = gmdate("d-m-Y g:i:s A", time()+($ms));

$first_number=$_REQUEST['first_number']-1;

$html="";
$mpdf->SetHTMLHeader('<div style="font-family:sans-serif;"><table width="100%" style="font-family:sans-serif; background-color:#FFF; align:center; float:left; color:#000;">
<tr><td width="100%"></td></tr>
<tr><td style="text-align:center; background-color:#CCC; padding-top:8px; font-size:13pt;"><b>ALL PICTURES REPORT HSSC PII(OFFICIAL)</b></td></tr>
</table></div>','O');

//<div style="background-color:#CCC; text-align:center; padding-top:8px;" height="30px" ><span style="font-size:20px"><b>General Sale Report</b></span><div style="font-size:12px; text-align:right; margin-right:15px; margin-top:-10px;"><strong>Sale Period=</strong>'.date('d-m-Y',strtotime($_REQUEST['start_date'])).' to ' .date('d-m-Y',strtotime($_REQUEST['end_date'])).'</div></div>';

		$html.='<table width="100%" border="1" style="font-family:sans-serif; align:center; float:left; text-align:center; margin-left:10px; margin-right:10px; border-collapse:collapse; font-size:10pt;">';
		$html.='<tr>';
		
		$i=0;
		$sql="SELECT Id, PicURL FROM vwadmstudents12 WHERE Id >0";

		if(isset($_REQUEST['InstituteId']) && $_REQUEST['InstituteId']!='All')
		{ $sql.=" AND InstituteId=".$_REQUEST['InstituteId'].""; }

		$sql.=" ORDER BY InstituteCode, Id ASC limit {$first_number}, 300";
		$res=mysql_query($sql, $conn1);
		while($row=mysql_fetch_array($res))
		{
			$html.='<td><img src='.'../institution-panel/'.$row['PicURL'].' height="80" width="90" /><br>'.$row['Id'].'</td>';
			$i++;
			
			if($i%7 == 0){ $html.='</tr><tr>'; $i=0; }
		}
		
		$html.='</table>';

$mpdf->SetHTMLFooter('<div align="justify" style="font-size:12px; padding:20px; font-family:calibri">
<div style="float:left">
</div>
<br>
<div style="width:100%; float:left; text-align:left; font-size:10px;"></div>

</div>','O',true);
$mpdf->WriteHTML($html);
$mpdf->Output();
?>