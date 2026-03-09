<?php include('includes/config.php');
include("MPDF57/mpdf.php");
ob_start();
ob_clean();
$mpdf=new mPDF('','A4','','',05,05,05,0,0,0);
$mpdf->useOnlyCoreFonts = true; // false is default
$mpdf->SetProtection(array('print'));
$mpdf->SetDisplayMode('fullpage');
$mpdf->zoom = 100;

$h = "5"; $hm = $h * 60; $ms = $hm * 60;
$Dated = gmdate("d-m-Y g:i:s A", time()+($ms));

$sql="SELECT Id, RegSessionName, RegInstName, RegNo, Name, FatherName, DOB, CNIC, Gender, GroupId, GroupName, CombinationId, CombinationName FROM tbl_sscregistration WHERE RegNo='".$_REQUEST['RegNo']."' AND RegNo is Not NULL";
$res=mysql_query($sql, $conn_sscreg);
$row=mysql_fetch_assoc($res);

$sql_1="SELECT Id, Sub6Name, Sub7Name, Sub8Name FROM vwsubcombinations09 WHERE Id=".$row['CombinationId']."";
$res_1=mysql_query($sql_1, $conn1);
$row_1=mysql_fetch_assoc($res_1);

if($row['Gender'] == 1){ $Gender='MALE'; } else if($row['Gender'] == 2){ $Gender='FEMALE'; }

$SubjectsList=$row_1['Sub6Name'].', '.$row_1['Sub7Name'].', '.$row_1['Sub8Name'];
//$SubjectsList=$row['CombinationName'];

$transparentPlaceholder = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=';

$imagePath = $_SERVER['DOCUMENT_ROOT'] . $row['PicURL']; // Adjust path logic as needed
$imageExists = !empty($row['PicURL']) && file_exists($imagePath);

$src = $imageExists ? $row['PicURL'] : $transparentPlaceholder;

$html.="<style>
p { direction: rtl; font-family: 'XB Zar'; font-size: 8pt; }
</style>";
$html.='<table width="90%" border="0" align="center" style="font-family:sans-serif; border:1px solid #000; text-align:center; border-collapse:collapse; font-size:8pt;">
			<tr><td colspan="5" style="text-align:center; font-size:9pt;"><b>AZAD JAMMU AND KASHMIR BOARD OF INTERMEDIATE AND SECONDARY EDUCATION MIRPUR</b></td></tr>
			<tr><td colspan="5" style="text-align:center; font-size:9pt;"><span style="border:1px solid #000;"><b>&nbsp; SSC REGISTRATION CARD SESSION: '.$row['RegSessionName'].'&nbsp;</b></span></td></tr>
			<tr>
				<td style="width:17%;"></td><td style="width:18%;"></td><td style="width:19%;"></td><td style="width:18%;"></td><td style="width:28%;"></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="3"><img src="images/logo.jpg"/></td>
				<td rowspan="4"><img src="'. $src .'" style="height:130px; width:130px; border:1px solid #000;"/></td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; padding-left:5px; text-align:left;">STUDENT'."'".'S NAME:</td>
				<td colspan="3" style="padding-top:3px; padding-bottom:3px; text-align:left; font-weight:bold;"><span style="border-bottom:1px solid #000;">'.$row['Name'].'</span></td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; padding-left:5px; text-align:left;">FATHER'."'".'S NAME:</td>
				<td colspan="3" style="padding-top:3px; padding-bottom:3px; text-align:left; font-weight:bold;"><span style="border-bottom:1px solid #000;">'.$row['FatherName'].'</span></td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; padding-left:5px; text-align:left;">REG NO:</td>
				<td colspan="3" style="padding-top:3px; padding-bottom:3px; text-align:left; font-weight:bold;"><span style="border-bottom:1px solid #000;">'.$row['RegNo'].'</span></td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; padding-left:5px; text-align:left;">GENDER:</td>
				<td style="padding-top:3px; padding-bottom:3px; text-align:left;"><span style="border-bottom:1px solid #000;">'.$Gender.'</span></td>
				<td style="padding-top:3px; padding-bottom:3px; padding-left:5px; text-align:left;">DATE OF BIRTH:</td>
				<td style="padding-top:3px; padding-bottom:3px; text-align:left;"><span style="border-bottom:1px solid #000;">'.date('d-m-Y',strtotime($row['DOB'])).'</span></td>
				<td style="padding-top:3px; padding-bottom:3px; text-align:center; font-weight:bold;"><span style="border-bottom:1px solid #000;">CNIC: '.$row['CNIC'].'</span></td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; padding-left:5px; text-align:left;">INSTITUTION / DISTRICT:</td>
				<td colspan="3" style="padding-top:3px; padding-bottom:3px; text-align:left;"><span style="border-bottom:1px solid #000;">'.$row['RegInstName'].'</span></td>
				<td rowspan="3"><img src="images/secretary.jpg" style="height:50px; width:170px;"/></td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; padding-left:5px; text-align:left;">GROUP:</td>
				<td colspan="3" style="padding-top:3px; padding-bottom:3px; text-align:left;"><span style="border-bottom:1px solid #000;">'.strtoupper($row['GroupName']).'</span></td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; padding-left:5px; text-align:left;">ELECTIVE SUBJECTS:</td>
				<td colspan="3" style="padding-top:3px; padding-bottom:3px; text-align:left;"><span style="border-bottom:1px solid #000;">'.strtoupper($SubjectsList).'</span></td>
			</tr>
			<tr>
				<td colspan="4" style="padding-top:3px; padding-bottom:3px; padding-left:5px; text-align:left; font-weight:bold;">DATED: <span style="border-bottom:1px solid #000;">'.$Dated.'</span></td>
				<td style="padding-top:0px; padding-bottom:3px; text-align:center; font-weight:bold;">SECRETARY</span></td>
			</tr>
			<tr>
				<td colspan="5" style="padding-top:3px; padding-bottom:3px; text-align:center;">
					<p style="font-family: \'XB Zar\';">
			نوٹ : رجسٹریشن کارڈ پر درج کوائف فارم ب کے مطابق نہ ہونے کی صورت میں اندر ایک ماہ تحت ضابطہ فیس جمع کروا کر زیردستخطی کو درستی کی تحریک کی جائے
					</p>
				</td>
			</tr>
		</table><hr/>';

$mpdf->WriteHTML($html);
$mpdf->Output();
?>