<?php include('includes/config.php');
include("MPDF57/mpdf.php");
ob_start();
ob_clean();
$mpdf=new mPDF('c','A4','','',10,10,05,0,0,0);
$mpdf->useOnlyCoreFonts = true; // false is default
$mpdf->SetProtection(array('print'));
$mpdf->SetDisplayMode('fullpage');
$mpdf->zoom = 100;

$h = "5"; $hm = $h * 60; $ms = $hm * 60;
$Dated = gmdate("d-m-Y g:i:s A", time()+($ms));

$sql_exams="SELECT * FROM exams WHERE IsCurrent=1 ORDER BY Id DESC limit 1;";
$res_exams=mysql_query($sql_exams, $conn1);
$row_exams=mysql_fetch_assoc($res_exams);
$ExamId=$row_exams['Id'];
$ExamName=$row_exams['Name'];
$ExamFullName=$row_exams['FullName'];

$html="";
$mpdf->SetHTMLHeader('<div style="font-family:sans-serif; font-size:9pt;"><div style="width:100%; float:left; text-align:right;">Page {PAGENO}</div></div>','O');

$sql="SELECT Id, Name, FatherName, DOB, PicURL, CNIC, Gender, Religion, IdentityMarks, Domicile, PostalAddress, PermanentAddress, PostalDistrict, PostalTehsil, PostOffice, Phone, Mobile, IsGroupChange, IsCombChange, SubChangeType, AdmCategory, GroupName, CombinationName, Sub1Name, Sub1Code, Sub2Name, Sub2Code, Sub3Name, Sub3Code, Sub4Name, Sub4Code, Sub5Name, Sub5Code, Sub6Name, Sub6Code, Sub7Name, Sub7Code, Sub8Name, Sub8Code, Sub9Name, Sub9Code, Sub21Name, Sub21Code, Sub22Name, Sub22Code, Sub23Name, Sub23Code, Sub24Name, Sub24Code, Sub25Name, Sub25Code, Sub26Name, Sub26Code, Sub27Name, Sub27Code, Sub28Name, Sub28Code, Sub29Name, Sub29Code, Sub26PName, Sub26PCode, Sub27PName, Sub27PCode, Sub28PName, Sub28PCode, Medium3, Medium4, Medium5, Medium6, Medium7, Medium8, Medium9, Medium23, Medium24, Medium25, Medium26, Medium27, Medium28, Medium29, BatchNo, AdmissionFee, BatchSr, ChallanNo, ACentreName, ACentreCode FROM vwadmstudents10 WHERE Id=".$_REQUEST['Id']."";
$res=mysql_query($sql, $conn1);
$row=mysql_fetch_assoc($res);

$sql1="SELECT ChallanCategory, ChallanAmount, DueDate FROM tblchallans WHERE ChallanNo=".$row['ChallanNo']."";
$res1=mysql_query($sql1, $conn2);
$row1=mysql_fetch_assoc($res1);
$Category=explode('@',$row1['ChallanCategory']);
$TotalFee=$row1['ChallanAmount'];

if($row['Gender'] == 1){ $Gender='Male'; }
else if($row['Gender'] == 2){ $Gender='Female'; }
else { $Gender=''; }

if($row['Religion'] == 1){ $Religion='Muslim'; }
else if($row['Religion'] == 2){ $Religion='Non Muslim'; }
else { $Religion=''; }

$sql_domiciles="SELECT Name FROM districts WHERE Id=".$row['Domicile']."";
$res_domiciles=mysql_query($sql_domiciles, $conn1);
$row_domiciles=mysql_fetch_assoc($res_domiciles);
$Domicile=$row_domiciles['Name'];

$sql_districts="SELECT Name FROM districts WHERE Id=".$row['PostalDistrict']."";
$res_districts=mysql_query($sql_districts, $conn1);
$row_districts=mysql_fetch_assoc($res_districts);
$PostalDistrict=$row_districts['Name'];

$sql_tehsils="SELECT Name FROM tehsils WHERE Id=".$row['PostalTehsil']."";
$res_tehsils=mysql_query($sql_tehsils, $conn1);
$row_tehsils=mysql_fetch_assoc($res_tehsils);
$PostalTehsil=$row_tehsils['Name'];

if($row['IsGroupChange'] == 1){ $IsGroupChange='Yes'; }
else { $IsGroupChange='No'; }

if($row['IsCombChange'] == 1){ $IsCombChange='Yes'; }
else { $IsCombChange='No'; }

if($row['Medium3'] == 1 && !empty($row['Sub3Code'])){ $Medium3='U'; }
else if($row['Medium3'] == 2 && !empty($row['Sub3Code'])){ $Medium3='E'; }

if($row['Medium4'] == 1 && !empty($row['Sub4Code'])){ $Medium4='U'; }
else if($row['Medium4'] == 2 && !empty($row['Sub4Code'])){ $Medium4='E'; }

if($row['Medium5'] == 1 && !empty($row['Sub5Code'])){ $Medium5='U'; }
else if($row['Medium5'] == 2 && !empty($row['Sub5Code'])){ $Medium5='E'; }

if($row['Medium6'] == 1 && !empty($row['Sub6Code'])){ $Medium6='U'; }
else if($row['Medium6'] == 2 && !empty($row['Sub6Code'])){ $Medium6='E'; }

if($row['Medium7'] == 1 && !empty($row['Sub7Code'])){ $Medium7='U'; }
else if($row['Medium7'] == 2 && !empty($row['Sub7Code'])){ $Medium7='E'; }

if($row['Medium8'] == 1 && !empty($row['Sub8Code'])){ $Medium8='U'; }
else if($row['Medium8'] == 2 && !empty($row['Sub8Code'])){ $Medium8='E'; }

if($row['Medium9'] == 1 && !empty($row['Sub9Code'])){ $Medium9='U'; }
else if($row['Medium9'] == 2 && !empty($row['Sub9Code'])){ $Medium9='E'; }

if($row['Medium23'] == 1 && !empty($row['Sub23Code'])){ $Medium23='U'; }
else if($row['Medium23'] == 2 && !empty($row['Sub23Code'])){ $Medium23='E'; }

if($row['Medium24'] == 1 && !empty($row['Sub24Code'])){ $Medium24='U'; }
else if($row['Medium24'] == 2 && !empty($row['Sub24Code'])){ $Medium24='E'; }

if($row['Medium25'] == 1 && !empty($row['Sub25Code'])){ $Medium25='U'; }
else if($row['Medium25'] == 2 && !empty($row['Sub25Code'])){ $Medium25='E'; }

if($row['Medium26'] == 1 && !empty($row['Sub26Code'])){ $Medium26='U'; }
else if($row['Medium26'] == 2 && !empty($row['Sub26Code'])){ $Medium26='E'; }

if($row['Medium27'] == 1 && !empty($row['Sub27Code'])){ $Medium27='U'; }
else if($row['Medium27'] == 2 && !empty($row['Sub27Code'])){ $Medium27='E'; }

if($row['Medium28'] == 1 && !empty($row['Sub28Code'])){ $Medium28='U'; }
else if($row['Medium28'] == 2 && !empty($row['Sub28Code'])){ $Medium28='E'; }

if($row['Medium29'] == 1 && !empty($row['Sub29Code'])){ $Medium29='U'; }
else if($row['Medium29'] == 2 && !empty($row['Sub29Code'])){ $Medium29='E'; }

if($row['AdmCategory'] == 1){ $AdmCategory='First Time'; }
else if($row['AdmCategory'] == 3){ $AdmCategory='For Improving Result'; }
else if($row['AdmCategory'] == 4){ $AdmCategory='In Additional Subject(s)'; }
else if($row['AdmCategory'] == 5){ $AdmCategory='After Complete Failure'; }
else if($row['AdmCategory'] == 6){ $AdmCategory='As A Compartment Case'; }
else if($row['AdmCategory'] == 7){ $AdmCategory='After Passing Adib Alam/Shahadat Sanvia/Aama/Khasa'; }
else if($row['AdmCategory'] == 9){ $AdmCategory='In Subject(s) Passed With Grace Marks'; }
else { $AdmCategory=''; }

$html.='<table width="100%" border="0" align="center" style="font-family:sans-serif; text-align:left; margin:10px; border-collapse:collapse; font-size:9pt;">
			<tr><td colspan="6" style="text-align:center; font-size:11pt;"><b>AZAD JAMMU AND KASHMIR BOARD OF INTERMEDIATE AND SECONDARY EDUCATION MIRPUR</b></td></tr>
			<tr><td colspan="6" style="text-align:center; font-size:11pt;">ADMISSION FORM FOR MATRIC '.strtoupper($ExamFullName).' PART-II(10TH)</td></tr>
			<tr>
				<td colspan="4" style="text-align:left; font-size:11pt;"><span style="border:1px solid #000; background-color:#666666; color:#FFFFFF;"><b>&nbsp; FOR PRIVATE CANDIDATES &nbsp;</b></span></td>
				<td colspan="2" style="text-align:right; font-size:11pt;"><span style="border:1px solid #000; background-color:#666666; color:#FFFFFF;"><b>&nbsp; 10th CLASS &nbsp;</b></span></td>
			</tr>
			<tr>
				<td style="width:18%;"></td><td style="width:17%;"></td>
				<td style="width:17%;"></td><td style="width:18%;"></td>
				<td style="width:15%;"></td><td style="width:15%;"></td>
			</tr>
			<tr>
				<td>APPEARING TYPE:</td>
				<td colspan="3">&nbsp; '.strtoupper($AdmCategory).'</td>
				<td colspan="2" style="text-align:right;">DATED: '.$Dated.'</td>
			</tr>
			<tr>
               	<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; font-weight:bold;">&nbsp; APP NO: PII-'.$row['Id'].'</td>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; font-weight:bold;">&nbsp; BATCH NO: '.$row['BatchNo'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; font-weight:bold;">&nbsp; BATCH SR: '.$row['BatchSr'].'</td>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; font-weight:bold;">&nbsp; REG NO: </td>
			</tr>
			<tr>
               	<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; font-weight:bold;">&nbsp; AMOUNT: '.floatval($row['AdmissionFee']).'</td>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; font-weight:bold;">&nbsp; CHALLAN NO: '.$row['ChallanNo'].'</td>
				<td colspan="3" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; font-weight:bold;">&nbsp; CHALLAN DATED:</td>
			</tr>
			<tr><td colspan="6">&nbsp;</td></tr>';

	$html.='<tr>
               	<td colspan="6" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>EXAM CENTRE</strong></td>
			</tr>
			<tr>
               	<td colspan="6" style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;"><b>CENTRE: '.strtoupper($row['ACentreCode']).'</b> &nbsp; &nbsp; <b>'.strtoupper($row['ACentreName']).'</b></td>
			</tr>
		</table>';

$html.='<table width="100%" border="0" align="center" style="font-family:sans-serif; text-align:left; margin:10px; border-collapse:collapse; font-size:9pt;">
			<tr>
				<td style="width:23%;"></td><td style="width:18%;"></td><td style="width:18%;"></td>
				<td style="width:18%;"></td><td style="width:23%;"></td>
			</tr>
			<tr>
               	<td colspan="5" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>PERSONAL DETAILS</strong></td>
			</tr>
			<tr>
				<td style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">STUDENT'."'".'S NAME:</td>
				<td colspan="3" style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">'.strtoupper($row['Name']).'</td>
				<td rowspan="6" style="padding-top:10px; text-align:center;"><img src="../institution-panel/'.$row['PicURL'].'" style="height:140px; width:135px;"/></td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">FATHER'."'".'S NAME:</td>
				<td colspan="3" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.strtoupper($row['FatherName']).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">CNIC/FORM B NO:</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.$row['CNIC'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">DOB:</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.date('d-m-Y',strtotime($row['DOB'])).'</td>
			</tr>
			<tr>
               	<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">GENDER:</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.strtoupper($Gender).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">RELIGION:</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.strtoupper($Religion).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">MARK OF IDENTIFICATION:</td>
				<td colspan="3" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.strtoupper($row['IdentityMarks']).'</td>
			</tr>
			<tr><td colspan="4">&nbsp;</td></tr>';

	$html.='<tr>
               	<td colspan="5" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>CONTACT DETAILS</strong></td>
			</tr>
			<tr>
               	<td style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">POSTAL ADDRESS:</td>
				<td colspan="4" style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">'.strtoupper($row['PostalAddress']).'</td>
			</tr>
			<tr>
               	<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">PERMANENT ADDRESS:</td>
				<td colspan="4" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.strtoupper($row['PermanentAddress']).'</td>
			</tr>
			<tr>
               	<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">HOME PHONE NO:</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.$row['Phone'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">MOBILE NO:</td>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.$row['Mobile'].'</td>
			</tr>
			<tr>
               	<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">POSTAL DISTRICT:</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.strtoupper($PostalDistrict).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">POSTAL TEHSIL:</td>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.strtoupper($PostalTehsil).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">DOMICILE DISTRICT:</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.strtoupper($Domicile).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">POST OFFICE:</td>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.strtoupper($row['PostOffice']).'</td>
			</tr>
		</table>';

$html.='<table width="100%" border="0" align="center" style="font-family:sans-serif; text-align:left; margin:10px; border-collapse:collapse; font-size:8pt;">
			<tr>
				<td style="width:30%;"></td><td style="width:5%;"></td><td style="width:3%;"></td>
				<td style="width:30%;"></td><td style="width:5%;"></td><td style="width:3%;"></td>
				<td style="width:24%;"></td>
			</tr>
			<tr>
               	<td colspan="7" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:9pt;"><strong>GROUP/SUBJECTS DETAILS</strong></td>
			</tr>
			<tr>
               	<td colspan="7" style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">GROUP: '.strtoupper($row['GroupName']).' &nbsp; &nbsp; COMBINATION: '.strtoupper($row['CombinationName']).' &nbsp; &nbsp; GROUP CHANGE: '.strtoupper($IsGroupChange).'  &nbsp; &nbsp; COMBINATION CHANGE: '.strtoupper($IsCombChange).'('.$row['SubChangeType'].')'.'</td>
			</tr>
			<tr>
               	<td colspan="3" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:8pt;"><strong>PART-I SUBJECTS</strong></td>
				<td colspan="4" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:8pt;"><strong>PART-II SUBJECTS</strong></td>
			</tr>
			<tr>
               	<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:8pt;"><strong>SUBJECT</strong></td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:8pt;"><strong>CODE</strong></td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:8pt;"><strong>M</strong></td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:8pt;"><strong>SUBJECT</strong></td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:8pt;"><strong>CODE</strong></td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:8pt;"><strong>M</strong></td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:8pt;"><strong>Practical</strong></td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.strtoupper($row['Sub1Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub1Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;"></td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.strtoupper($row['Sub21Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub21Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;"></td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;"></td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.strtoupper($row['Sub2Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub2Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;"></td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.strtoupper($row['Sub22Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub22Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;"></td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;"></td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.strtoupper($row['Sub3Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub3Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.strtoupper($Medium3).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.strtoupper($row['Sub23Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub23Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.strtoupper($Medium23).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;"></td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.strtoupper($row['Sub4Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub4Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.strtoupper($Medium4).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.strtoupper($row['Sub24Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub24Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.strtoupper($Medium24).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;"></td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.strtoupper($row['Sub5Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub5Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.strtoupper($Medium5).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.strtoupper($row['Sub25Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub25Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.strtoupper($Medium25).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;"></td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.strtoupper($row['Sub6Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub6Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.strtoupper($Medium6).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.strtoupper($row['Sub26Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub26Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.strtoupper($Medium26).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">'.strtoupper($row['Sub26PName']).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.strtoupper($row['Sub7Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub7Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.strtoupper($Medium7).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.strtoupper($row['Sub27Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub27Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.strtoupper($Medium27).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">'.strtoupper($row['Sub27PName']).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.strtoupper($row['Sub8Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub8Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.strtoupper($Medium8).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.strtoupper($row['Sub28Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub28Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.strtoupper($Medium28).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">'.strtoupper($row['Sub28PName']).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.strtoupper($row['Sub9Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub9Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.strtoupper($Medium9).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.strtoupper($row['Sub29Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub29Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.strtoupper($Medium29).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;"></td>
			</tr>
			<tr><td colspan="7"><img src="images/pic.jpg"/></td></tr>
		</table>';

$html.='<div style="width:69%; font-family:sans-serif; font-size:9pt; position:fixed; bottom:15px;">
<div style="width:49%; float:left; text-align:left; padding-bottom:5px;">SIGNATURE OF CANDIDATE(<span style="font-weight:bold;">ENGLISH</span>) _______________</div>
<div style="width:49%; float:right; text-align:right; padding-bottom:5px;">SIGNATURE OF CANDIDATE(<span style="font-weight:bold;">URDU</span>) _______________</div>

<div style="border:1px dashed #000; padding-top:10px; padding-bottom:5px; padding-left:10px; padding-right:10px;">
	<div style="width:49%; float:left; text-align:left;">ATTESTATION OFFICER NAME ________________ </div>
	<div style="width:49%; float:right; text-align:right;">DESIGNATION ______________________</div>
	<div style="width:49%; float:left; text-align:left; padding-top:40px;">SIGNATURE ______________________</div>
	<div style="width:49%; float:right; text-align:right; padding-top:40px;">STAMP ______________________</div>
	<div style="width:60%; float:right;"><img src="images/pic1.jpg" style="height:25px;"/></div>
</div>
</div>';

$html.='<pagebreak />';
$html.='<img src="images/piip_instructions.jpg" style="border:1px solid #000;"/>';
$html.='<pagebreak />';

$html.='<table width="100%" border="0" align="center" style="font-family:sans-serif; text-align:left; margin:10px; border-collapse:collapse; font-size:9pt;">
			<tr><td colspan="6" style="text-align:center; font-size:11pt;"><b>AZAD JAMMU AND KASHMIR BOARD OF INTERMEDIATE AND SECONDARY EDUCATION MIRPUR</b></td></tr>
			<tr><td colspan="6" style="text-align:center; font-size:11pt;">ADMISSION FORM FOR MATRIC '.strtoupper($ExamFullName).' PART-II(10TH)</td></tr>
			<tr><td colspan="6" style="text-align:center; font-size:11pt;"><span style="border:1px solid #000; background-color:#666666; color:#FFFFFF;"><b>&nbsp; FOR PRIVATE CANDIDATES &nbsp;</b></span></td></tr>
			<tr>
				<td style="width:18%;"></td><td style="width:17%;"></td>
				<td style="width:17%;"></td><td style="width:18%;"></td>
				<td style="width:15%;"></td><td style="width:15%;"></td>
			</tr>
			<tr>
				<td>APPEARING TYPE:</td>
				<td colspan="3">&nbsp; '.strtoupper($AdmCategory).'</td>
				<td colspan="2" style="text-align:right;">DATED: '.$Dated.'</td>
			</tr>
			<tr>
               	<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; font-weight:bold;">&nbsp; APP NO: PII-'.$row['Id'].'</td>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; font-weight:bold;">&nbsp; BATCH NO: '.$row['BatchNo'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; font-weight:bold;">&nbsp; BATCH SR: '.$row['BatchSr'].'</td>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; font-weight:bold;">&nbsp; REG NO: </td>
			</tr>
			<tr>
               	<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; font-weight:bold;">&nbsp; AMOUNT: '.floatval($row['AdmissionFee']).'</td>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; font-weight:bold;">&nbsp; CHALLAN NO: '.$row['ChallanNo'].'</td>
				<td colspan="3" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; font-weight:bold;">&nbsp; CHALLAN DATED:</td>
			</tr>
			<tr>
               	<td colspan="6" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; font-weight:bold;">&nbsp; BANK BRANCH: &nbsp;</td>
			</tr>
			<tr><td colspan="6">&nbsp;</td></tr>
		</table>';

$html.='<table width="100%" border="0" align="center" style="font-family:sans-serif; text-align:left; margin:10px; border-collapse:collapse; font-size:9pt;">
			<tr>
				<td style="width:20%;"></td><td style="width:40%;"></td>
				<td style="width:20%;"></td><td style="width:20%;"></td>
			</tr>
			<tr>
               	<td colspan="2" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>PERSONAL DETAILS</strong></td>
				<td colspan="2" rowspan="19" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:10pt;">Paste Payment Proof, Screenshot of 1Bill or Konnect App or Mobile Banking App Payment here</td>
			</tr>
			<tr>
				<td style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">STUDENT'."'".'S NAME:</td>
				<td style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">'.strtoupper($row['Name']).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">FATHER'."'".'S NAME:</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.strtoupper($row['FatherName']).'</td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>';

	$html.='<tr>
               	<td colspan="2" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>CONTACT DETAILS</strong></td>
			</tr>
			<tr>
               	<td style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">DOMICILE DISTRICT:</td>
				<td style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">'.strtoupper($Domicile).'</td>
			</tr>
			<tr>
               	<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">POSTAL ADDRESS:</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.strtoupper($row['PostalAddress']).'</td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>';

	$html.='<tr>
               	<td colspan="2" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>EXAM CENTRE</strong></td>
			</tr>
			<tr>
               	<td colspan="2" style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">CENTRE: <b>'.strtoupper($row['ACentreCode']).'</b> &nbsp; &nbsp; '.strtoupper($row['ACentreName']).'</td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>';

	$html.='<tr>
               	<td colspan="2" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>GROUP/SUBJECTS DETAILS</strong></td>
			</tr>
			<tr>
               	<td style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">GROUP:</td>
				<td style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">'.strtoupper($row['GroupName']).'</td>
			</tr>
			<tr>
               	<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">COMBINATION:</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.strtoupper($row['CombinationName']).'</td>
			</tr>
			<tr>
               	<td colspan="2" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;"> 1) '.strtoupper($row['Sub1Name']).' &nbsp;&nbsp;&nbsp; 2) '.strtoupper($row['Sub2Name']).' &nbsp;&nbsp;&nbsp; 3) '.strtoupper($row['Sub3Name']).' &nbsp;&nbsp;&nbsp; 4) '.strtoupper($row['Sub4Name']).'</td>
			</tr>
			<tr>
               	<td colspan="2" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;"> 5) '.strtoupper($row['Sub5Name']).' &nbsp;&nbsp;&nbsp; 6) '.strtoupper($row['Sub6Name']).' &nbsp;&nbsp;&nbsp; 7) '.strtoupper($row['Sub7Name']).' &nbsp;&nbsp;&nbsp; 8) '.strtoupper($row['Sub8Name']).' &nbsp;&nbsp;&nbsp; 9) '.strtoupper($row['Sub9Name']).'</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;"> 1) '.strtoupper($row['Sub21Name']).' &nbsp;&nbsp;&nbsp; 2) '.strtoupper($row['Sub22Name']).' &nbsp;&nbsp;&nbsp; 3) '.strtoupper($row['Sub23Name']).' &nbsp;&nbsp;&nbsp; 4) '.strtoupper($row['Sub24Name']).'</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;"> 5) '.strtoupper($row['Sub25Name']).' &nbsp;&nbsp;&nbsp; 6) '.strtoupper($row['Sub26Name']).' &nbsp;&nbsp;&nbsp; 7) '.strtoupper($row['Sub27Name']).' &nbsp;&nbsp;&nbsp; 8) '.strtoupper($row['Sub28Name']).' &nbsp;&nbsp;&nbsp; 9) '.strtoupper($row['Sub29Name']).'</td>
			</tr>';

	$html.='<tr>
               	<td colspan="2" style="padding-top:3px; padding-bottom:3px;">I HEREBY DECLARE THAT THE DETAILS FURNISHED ABOVE ARE TRUE AND CORRECT TO THE BEST OF MY KNOWLEDGE AND BELIEF.</td>
			</tr>
			<tr>
               	<td colspan="2" style="padding-top:30px; padding-bottom:3px;">SIGNATURE OF CANDIDATE(<span style="font-weight:bold;">ENGLISH</span>) _______________</td>
			</tr>
			<tr>
               	<td colspan="2" style="padding-top:30px; padding-bottom:3px;">SIGNATURE OF CANDIDATE(<span style="font-weight:bold;">URDU</span>) _______________</td>
			</tr>
		</table>';

$html.='<div style="width:69%; font-family:sans-serif; font-size:9pt; position:fixed; bottom:15px;">
<div style="border:1px dashed #000; padding-top:10px; padding-bottom:5px; padding-left:10px; padding-right:10px;">
	<div style="width:49%; float:left; text-align:left;">ATTESTATION OFFICER NAME ________________ </div>
	<div style="width:49%; float:right; text-align:right;">DESIGNATION ______________________</div>
	<div style="width:49%; float:left; text-align:left; padding-top:40px;">SIGNATURE ______________________</div>
	<div style="width:49%; float:right; text-align:right; padding-top:40px;">STAMP ______________________</div>
	<div style="width:60%; float:right;"><img src="images/pic1.jpg" style="height:25px;"/></div>
</div>
</div>';

$html.='<pagebreak ... sheet-size="A4-L" ... />';
$mpdf->WriteHTML($html);

$html1.='<table width="100%" style="font-family:sans-serif; border-collapse:collapse; margin-bottom:7px; font-size:12pt;"><tr><td align="center">Bank Copy</td></tr></table>';

$html2.='<table width="100%" style="font-family:sans-serif; border-collapse:collapse; margin-bottom:7px; font-size:12pt;"><tr><td align="center">Bank Copy (Along with Scroll)</td></tr></table>';

$html3.='<table width="100%" style="font-family:sans-serif; border-collapse:collapse; margin-bottom:7px; font-size:12pt;"><tr><td align="center">Board Copy</td></tr></table>';

$html4.='<table width="100%" style="font-family:sans-serif; border-collapse:collapse; margin-bottom:7px; font-size:12pt;"><tr><td align="center">Depositor Copy</td></tr></table>';

$html5.='<table width="100%"><tr><td align=center><img src="images/logo-challan.png"/></td></tr></table>';

//$htmll.='<div style="font-family:sans-serif; background-color:#CCC; text-align:center; padding-top:5px; margin-top:5px;" height="25px"><span style="font-size:10pt;"><b>AJK BISE Acc # 00427991668003</b></span></div>';

		   $htmll.='<table width="100%" style="font-family:sans-serif; float:left; text-align:left; margin-left:10px; margin-right:10px; margin-top:5px; border-collapse:collapse; font-size:10pt;">
					<tr>
						<td colspan="2" style="font-weight:bold; height:30px;">Branch Code: _______ &nbsp;Date: _______ </td>
					</tr>
					<tr style="border:1px solid #000;">
						<td style="height:25px; width:35%; font-weight:bold;">&nbsp; 1-Bill #: </td>
						<td style="width:65%; border-bottom:1px solid #000; font-weight:bold;">1001145177'.$row['ChallanNo'].'</td>
					</tr>
					<tr style="border:1px solid #000;">
						<td style="height:25px; width:35%; font-weight:bold;">&nbsp; Challan #: </td>
						<td style="width:65%; border-bottom:1px solid #000; font-weight:bold;">'.$row['ChallanNo'].'</td>
					</tr>
					<tr><td colspan="2">&nbsp;</td></tr>
					<tr>
						<td style="height:25px;">App No: </td>
						<td style="border-bottom:1px solid #000;">PII-'.$row['Id'].'</td>
					</tr>
					<tr>
						<td style="height:25px;">Student Name: </td>
						<td style="border-bottom:1px solid #000;">'.$row['Name'].'</td>
					</tr>
					<tr>
						<td style="height:25px;">Depositor'."'".'s CNIC: </td>
						<td style="border-bottom:1px solid #000;"></td>
					</tr>
					<tr>
						<td style="height:25px;">Phone No: </td>
						<td style="border-bottom:1px solid #000;">'.$row['Phone'].'</td>
					</tr>
					<tr>
						<td style="height:25px;">Address: </td>
						<td style="border-bottom:1px solid #000; font-size:9pt;">'.$row['PostalAddress'].'</td>
					</tr>
					<tr>
						<td colspan="2">
						<table width="100%" border="1" style="font-size:9pt; margin-top:10px;">
							<tr>
								<td width="70%" style="text-align:center; font-weight:bold;">Category</td>
								<td width="30%" style="text-align:center; font-weight:bold;">Amount</td>
							</tr>
							<tr>
								<td>'.$Category['0'].' '.$Category['1'].'('.$Category['2'].')</td>
								<td style="text-align:center;">'.floatval(($row1['ChallanAmount']-10)).'/-</td>
							</tr>
							<tr>
								<td>GENERAL(1100-9999)</td>
								<td style="text-align:center;">10/-</td>
							</tr>
							<tr>
								<td style="text-align:center; font-weight:bold;">Total</td>
								<td style="text-align:center; font-weight:bold;">'.$TotalFee.'/-</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr><td colspan="2" style="height:50px;">&nbsp;</td></tr>
					<tr><td colspan="2" style="border-bottom:1pt solid black;"></td></tr>
					<tr>
						<td>Student'."'".'s <br> Signature </td>
						<td style="text-align:right;">Bank Officer'."'".'s <br> Signature </td>
					</tr>
					<tr><td colspan="2" align=center><img src="images/note2.png"/></td></tr>
					</table>';

$mpdf->WriteHTML('<columns column-count="4" vAlign="J" column-gap="6" />');
$mpdf->WriteHTML($html1.$html5.$htmll);
$mpdf->WriteHTML('<columnbreak />');
$mpdf->WriteHTML($html2.$html5.$htmll);
$mpdf->WriteHTML('<columnbreak />');
$mpdf->WriteHTML($html3.$html5.$htmll);
$mpdf->WriteHTML('<columnbreak />');
$mpdf->WriteHTML($html4.$html5.$htmll);

$mpdf->Output();
?>