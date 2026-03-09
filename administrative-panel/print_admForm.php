<?php include('includes/config.php');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start();
ob_clean();

require_once("TCPDF/tcpdf.php");

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('AJK BISE');
$pdf->SetAuthor('AJK BISE');
$pdf->SetTitle('SSC Admission Form');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(5, 5, 5);
$pdf->SetAutoPageBreak(false, 13);
$pdf->SetFont('helvetica', '', 9);
$pdf->SetProtection(array('print'), '', null, 0, null);
$pdf->SetDisplayMode('fullpage');
$pdf->setCellPadding(0);
$pdf->AddPage();

$h = "5"; $hm = $h * 60; $ms = $hm * 60;
$Dated = gmdate("d-m-Y g:i:s A", time()+($ms));

 $ExamFullName='SSC ADMISSIONS';

// Absolute path for student pictures (TCPDF requires absolute paths for images)
$picBasePath = dirname(__DIR__) . '/institution-panel/';

$html="";

$sql="SELECT * FROM tbladm_10 WHERE Id=".intval($_REQUEST['Id'])." and ExamYear=".intval($_REQUEST['eid'])."";$res=mysqli_query($conn1,$sql);

// Check for SQL errors
if(!$res) {
    die("SQL Error: " . mysqli_error($conn1) . "<br>Query: " . $sql);
}

$row=mysqli_fetch_assoc($res);

// Check if record exists
if(!$row) {
    die("No record found for Id: " . intval($_REQUEST['Id']) . " and ExamYear: " . intval($_REQUEST['eid']) . "<br>Query: " . $sql);
}

$P1Year=str_pad($row['P1Year'],2,'0',STR_PAD_LEFT);

if($row['P1Session'] == 1){ $P1Session='1st Annual'; }
else if($row['P1Session'] == 2){ $P1Session='2nd Annual'; }
else { $P1Session=''; }

if($row['Gender'] == 1){ $Gender='Male'; }
else if($row['Gender'] == 2){ $Gender='Female'; }
else { $Gender=''; }

if($row['Religion'] == 1){ $Religion='Muslim'; }
else if($row['Religion'] == 2){ $Religion='Non Muslim'; }
else { $Religion=''; }

if(!empty($row['Domicile']) && $row['Domicile'] > 0){
	$sql_domiciles="SELECT Name FROM districts WHERE Id=".intval($row['Domicile'])."";
	$res_domiciles=mysqli_query($conn2,$sql_domiciles);
	$row_domiciles=mysqli_fetch_assoc($res_domiciles);
	$Domicile=$row_domiciles['Name'];
} else {
	$Domicile='';
}

if(!empty($row['PostalDistrict']) && $row['PostalDistrict'] > 0){
	$sql_districts="SELECT Name FROM districts WHERE Id=".intval($row['PostalDistrict'])."";
	$res_districts=mysqli_query($conn2,$sql_districts);
	$row_districts=mysqli_fetch_assoc($res_districts);
	$PostalDistrict=$row_districts['Name'];
} else {
	$PostalDistrict='';
}

if(!empty($row['PostalTehsil']) && $row['PostalTehsil'] > 0){
	$sql_tehsils="SELECT Name FROM tehsils WHERE Id=".intval($row['PostalTehsil'])."";
	$res_tehsils=mysqli_query($conn2,$sql_tehsils);
	$row_tehsils=mysqli_fetch_assoc($res_tehsils);
	$PostalTehsil=$row_tehsils['Name'];
} else {
	$PostalTehsil='';
}

if($row['IsGroupChange'] == 1){ $IsGroupChange='Yes'; }
else { $IsGroupChange='No'; }

if($row['IsCombChange'] == 1){ $IsCombChange='Yes'; }
else { $IsCombChange='No'; }

// Initialize all Medium variables
$Medium3 = $Medium4 = $Medium5 = $Medium6 = $Medium7 = $Medium8 = $Medium9 = '';
$Medium23 = $Medium24 = $Medium25 = $Medium26 = $Medium27 = $Medium28 = $Medium29 = '';

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

// Get P1Board name
if(!empty($row['P1Board']) && $row['P1Board'] > 0){
	$sql_p1board="SELECT Name FROM boards WHERE Id=".intval($row['P1Board'])."";
	$res_p1board=mysqli_query($conn2,$sql_p1board);
	$row_p1board=mysqli_fetch_assoc($res_p1board);
	$P1Board=$row_p1board['Name'];
} else {
	$P1Board='';
}

// Calculate challan fee details
$TotalFee = floatval($row['AdmissionFee']);
$Category = array('', '', ''); // Default empty category

$html.='<table width="100%" border="0" cellpadding="2" cellspacing="0" align="center" style="font-family:sans-serif; text-align:left; border-collapse:collapse; font-size:10pt;">
			<tr><td colspan="6" style="text-align:center; font-size:12pt; padding-top:5px; padding-bottom:5px;"><b>AZAD JAMMU AND KASHMIR BOARD OF INTERMEDIATE AND SECONDARY EDUCATION MIRPUR</b></td></tr>
			<tr><td colspan="6" style="text-align:center; font-size:12pt; padding-bottom:5px;">ADMISSION FORM FOR MATRIC '.$ExamFullName.' PART-II(10TH)</td></tr>
			<tr>
				<td colspan="4" style="text-align:left; font-size:11pt; padding-top:3px; padding-bottom:5px;"><span style="border:1px solid #000; background-color:#666666; color:#FFFFFF;"><b>&nbsp; FOR PRIVATE CANDIDATES &nbsp;</b></span></td>
				<td colspan="2" style="text-align:right; font-size:11pt; padding-top:3px; padding-bottom:5px;"><span style="border:1px solid #000; background-color:#666666; color:#FFFFFF;"><b>&nbsp; 10th CLASS &nbsp;</b></span></td>
			</tr>
			<tr>
				<td style="width:18%;"></td><td style="width:17%;"></td>
				<td style="width:17%;"></td><td style="width:18%;"></td>
				<td style="width:15%;"></td><td style="width:15%;"></td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px;">APPEARING TYPE:</td>
				<td colspan="3" style="padding-top:5px; padding-bottom:5px;">&nbsp; '.$AdmCategory.'</td>
				<td colspan="2" style="text-align:right; padding-top:5px; padding-bottom:5px;">DATED: '.$Dated.'</td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; font-weight:bold;">&nbsp; APP NO: PII-'.$row['Id'].'</td>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; font-weight:bold;">&nbsp; BATCH NO: '.$row['BatchNo'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; font-weight:bold;">&nbsp; BATCH SR: '.$row['BatchSr'].'</td>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; font-weight:bold;">&nbsp; REG NO: '.$row['P1RegNo'].'</td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; font-weight:bold;">&nbsp; AMOUNT: '.floatval($row['AdmissionFee']).'</td>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; font-weight:bold;">&nbsp; CHALLAN NO: '.$row['ChallanNo'].'</td>
				<td colspan="3" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; font-weight:bold;">&nbsp; CHALLAN DATED:</td>
			</tr>
			<tr><td colspan="6" style="height:8px;">&nbsp;</td></tr>';

	$html.='<tr>
				<td colspan="6" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>EXAM CENTRE</strong></td>
			</tr>
			<tr>
				<td colspan="6" style="padding-top:10px; padding-bottom:5px; border-bottom:1px solid #000;"><b>CENTRE: '.$row['ACentreCode'].'</b> &nbsp; &nbsp; <b>'.$row['ACentreName'].'</b></td>
			</tr>';

	$html.='<tr>
				<td colspan="6" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>SSC (PART-I) REFERENCE</strong></td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000; text-align:center;">YEAR</td>
				<td style="padding-top:5px; padding-bottom:5px; border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000; text-align:center;">ROLL NO</td>
				<td style="padding-top:5px; padding-bottom:5px; border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000; text-align:center;">SESSION</td>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px; border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000; text-align:center;">BOARD</td>
				<td style="padding-top:5px; padding-bottom:5px; border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000; text-align:center;">RESULT</td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; text-align:center;">'.$P1Year.'</td>
				<td style="padding-top:5px; padding-bottom:5px; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; text-align:center;">'.$row['P1RollNo'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; text-align:center;">'.$P1Session.'</td>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; text-align:center;">'.$P1Board.'</td>
				<td style="padding-top:5px; padding-bottom:5px; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; text-align:center;">'.$row['P1Result'].'</td>
			</tr>
		</table>';

$html.='<table width="100%" border="0" cellpadding="2" cellspacing="0" align="center" style="font-family:sans-serif; text-align:left; border-collapse:collapse; font-size:10pt;">
			<tr>
				<td style="width:23%;"></td><td style="width:18%;"></td><td style="width:18%;"></td>
				<td style="width:18%;"></td><td style="width:23%;"></td>
			</tr>
			<tr>
				<td colspan="5" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>PERSONAL DETAILS</strong></td>
			</tr>
			<tr>
				<td style="padding-top:10px; padding-bottom:5px; border-bottom:1px solid #000;">STUDENT'."'".'S NAME:</td>
				<td colspan="3" style="padding-top:10px; padding-bottom:5px; border-bottom:1px solid #000;">'.$row['Name'].'</td>
				<td rowspan="6" style="padding-top:10px; text-align:center;"><img src="'.$picBasePath.$row['PicURL'].'" style="height:140px; width:135px;"/></td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">FATHER'."'".'S NAME:</td>
				<td colspan="3" style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">'.$row['FatherName'].'</td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">CNIC/FORM B NO:</td>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">'.$row['CNIC'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">DOB:</td>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">'.date('d-m-Y',strtotime($row['DOB'])).'</td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">GENDER:</td>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">'.$Gender.'</td>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">RELIGION:</td>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">'.$Religion.'</td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">MARK OF IDENTIFICATION:</td>
				<td colspan="3" style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">'.$row['IdentityMarks'].'</td>
			</tr>
			<tr><td colspan="4" style="height:8px;">&nbsp;</td></tr>';

	$html.='<tr>
				<td colspan="5" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>CONTACT DETAILS</strong></td>
			</tr>
			<tr>
				<td style="padding-top:10px; padding-bottom:5px; border-bottom:1px solid #000;">POSTAL ADDRESS:</td>
				<td colspan="4" style="padding-top:10px; padding-bottom:5px; border-bottom:1px solid #000;">'.$row['PostalAddress'].'</td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">PERMANENT ADDRESS:</td>
				<td colspan="4" style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">'.$row['PermanentAddress'].'</td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">HOME PHONE NO:</td>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">'.$row['Phone'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">MOBILE NO:</td>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">'.$row['Mobile'].'</td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">POSTAL DISTRICT:</td>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">'.$PostalDistrict.'</td>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">POSTAL TEHSIL:</td>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">'.$PostalTehsil.'</td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">DOMICILE DISTRICT:</td>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">'.$Domicile.'</td>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">POST OFFICE:</td>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">'.$row['PostOffice'].'</td>
			</tr>
		</table>';

$html.='<table width="100%" border="0" cellpadding="2" cellspacing="0" align="center" style="font-family:sans-serif; text-align:left; border-collapse:collapse; font-size:9pt;">
			<tr>
				<td style="width:30%;"></td><td style="width:5%;"></td><td style="width:3%;"></td>
				<td style="width:30%;"></td><td style="width:5%;"></td><td style="width:3%;"></td>
				<td style="width:24%;"></td>
			</tr>
			<tr>
				<td colspan="7" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>GROUP/SUBJECTS DETAILS</strong></td>
			</tr>
			<tr>
				<td colspan="7" style="padding-top:10px; padding-bottom:5px; border-bottom:1px solid #000;">GROUP: '.$row['GroupName'].' &nbsp; &nbsp; COMBINATION: '.$row['CombinationName'].' &nbsp; &nbsp; GROUP CHANGE: '.$IsGroupChange.'  &nbsp; &nbsp; COMBINATION CHANGE: '.$IsCombChange.'('.$row['SubChangeType'].')'.'</td>
			</tr>
			<tr>
				<td colspan="3" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center; font-size:9pt;"><strong>PART-I SUBJECTS</strong></td>
				<td colspan="4" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center; font-size:9pt;"><strong>PART-II SUBJECTS</strong></td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center; font-size:9pt;"><strong>SUBJECT</strong></td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center; font-size:9pt;"><strong>CODE</strong></td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center; font-size:9pt;"><strong>M</strong></td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center; font-size:9pt;"><strong>SUBJECT</strong></td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center; font-size:9pt;"><strong>CODE</strong></td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center; font-size:9pt;"><strong>M</strong></td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center; font-size:9pt;"><strong>Practical</strong></td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;">&nbsp;'.$row['Sub1Name'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$row['Sub1Code'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;"></td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;">&nbsp;'.$row['Sub21Name'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$row['Sub21Code'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;"></td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;"></td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;">&nbsp;'.$row['Sub2Name'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$row['Sub2Code'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;"></td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;">&nbsp;'.$row['Sub22Name'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$row['Sub22Code'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;"></td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;"></td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;">&nbsp;'.$row['Sub3Name'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$row['Sub3Code'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$Medium3.'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;">&nbsp;'.$row['Sub23Name'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$row['Sub23Code'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$Medium23.'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;"></td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;">&nbsp;'.$row['Sub4Name'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$row['Sub4Code'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$Medium4.'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;">&nbsp;'.$row['Sub24Name'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$row['Sub24Code'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$Medium24.'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;"></td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;">&nbsp;'.$row['Sub5Name'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$row['Sub5Code'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$Medium5.'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;">&nbsp;'.$row['Sub25Name'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$row['Sub25Code'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$Medium25.'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;"></td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;">&nbsp;'.$row['Sub6Name'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$row['Sub6Code'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$Medium6.'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;">&nbsp;'.$row['Sub26Name'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$row['Sub26Code'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$Medium26.'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;">'.$row['Sub26PName'].'</td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;">&nbsp;'.$row['Sub7Name'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$row['Sub7Code'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$Medium7.'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;">&nbsp;'.$row['Sub27Name'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$row['Sub27Code'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$Medium27.'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;">'.$row['Sub27PName'].'</td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;">&nbsp;'.$row['Sub8Name'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$row['Sub8Code'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$Medium8.'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;">&nbsp;'.$row['Sub28Name'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$row['Sub28Code'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$Medium28.'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;">'.$row['Sub28PName'].'</td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;">&nbsp;'.$row['Sub9Name'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$row['Sub9Code'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$Medium9.'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;">&nbsp;'.$row['Sub29Name'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$row['Sub29Code'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center;">'.$Medium29.'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000;"></td>
			</tr>
			<tr><td colspan="7"><img src="images/pic.jpg"/></td></tr>
		</table>';

$html.='<table width="100%" border="0" cellpadding="2" cellspacing="0" style="font-family:sans-serif; font-size:10pt;">
<tr>
	<td width="50%" style="text-align:left; padding-top:10px; padding-bottom:8px;">SIGNATURE OF CANDIDATE(<span style="font-weight:bold;">ENGLISH</span>) _______________</td>
	<td width="50%" style="text-align:right; padding-top:10px; padding-bottom:8px;">SIGNATURE OF CANDIDATE(<span style="font-weight:bold;">URDU</span>) _______________</td>
</tr>
</table>
<table width="100%" border="0" cellpadding="5" cellspacing="0" style="font-family:sans-serif; font-size:10pt; border:1px dashed #000;">
<tr>
	<td width="50%" style="text-align:left;">ATTESTATION OFFICER NAME ________________ </td>
	<td width="50%" style="text-align:right;">DESIGNATION ______________________</td>
</tr>
<tr><td colspan="2" style="height:25px;">&nbsp;</td></tr>
<tr>
	<td width="50%" style="text-align:left;">SIGNATURE ______________________</td>
	<td width="50%" style="text-align:right;">STAMP ______________________</td>
</tr>
<tr>
	<td colspan="2" style="text-align:right;"><img src="images/pic1.jpg" style="height:25px;"/></td>
</tr>
</table>';

// Write the full page 1 content including signature
$pdf->writeHTML($html, true, false, true, false, '');

// Page 2: Board copy form
$pdf->AddPage();

$html='<table width="100%" border="0" cellpadding="2" cellspacing="0" align="center" style="font-family:sans-serif; text-align:left; border-collapse:collapse; font-size:10pt;">
			<tr><td colspan="6" style="text-align:center; font-size:12pt;"><b>AZAD JAMMU AND KASHMIR BOARD OF INTERMEDIATE AND SECONDARY EDUCATION MIRPUR</b></td></tr>
			<tr><td colspan="6" style="text-align:center; font-size:12pt;">ADMISSION FORM FOR MATRIC '.($ExamFullName).' PART-II(10TH)</td></tr>
			<tr><td colspan="6" style="text-align:center; font-size:12pt;"><span style="border:1px solid #000; background-color:#666666; color:#FFFFFF;"><b>&nbsp; FOR PRIVATE CANDIDATES &nbsp;</b></span></td></tr>
			<tr>
				<td style="width:18%;"></td><td style="width:17%;"></td>
				<td style="width:17%;"></td><td style="width:18%;"></td>
				<td style="width:15%;"></td><td style="width:15%;"></td>
			</tr>
			<tr>
				<td>APPEARING TYPE:</td>
				<td colspan="3">&nbsp; '.$AdmCategory.'</td>
				<td colspan="2" style="text-align:right;">DATED: '.$Dated.'</td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; font-weight:bold;">&nbsp; APP NO: PII-'.$row['Id'].'</td>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; font-weight:bold;">&nbsp; BATCH NO: '.$row['BatchNo'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; font-weight:bold;">&nbsp; BATCH SR: '.$row['BatchSr'].'</td>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; font-weight:bold;">&nbsp; REG NO: '.$row['P1RegNo'].'</td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border:1px solid #000; font-weight:bold;">&nbsp; AMOUNT: '.floatval($row['AdmissionFee']).'</td>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; font-weight:bold;">&nbsp; CHALLAN NO: '.$row['ChallanNo'].'</td>
				<td colspan="3" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; font-weight:bold;">&nbsp; CHALLAN DATED:</td>
			</tr>
			<tr>
				<td colspan="6" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; font-weight:bold;">&nbsp; BANK BRANCH: &nbsp;</td>
			</tr>
			<tr><td colspan="6" style="height:8px;">&nbsp;</td></tr>';

	$html.='<tr>
				<td colspan="6" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>SSC (PART-I) REFERENCE</strong></td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000; text-align:center;">YEAR</td>
				<td style="padding-top:5px; padding-bottom:5px; border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000; text-align:center;">ROLL NO</td>
				<td style="padding-top:5px; padding-bottom:5px; border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000; text-align:center;">SESSION</td>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px; border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000; text-align:center;">BOARD</td>
				<td style="padding-top:5px; padding-bottom:5px; border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000; text-align:center;">RESULT</td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; text-align:center;">'.$P1Year.'</td>
				<td style="padding-top:5px; padding-bottom:5px; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; text-align:center;">'.$row['P1RollNo'].'</td>
				<td style="padding-top:5px; padding-bottom:5px; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; text-align:center;">'.$P1Session.'</td>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; text-align:center;">'.$P1Board.'</td>
				<td style="padding-top:5px; padding-bottom:5px; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; text-align:center;">'.$row['P1Result'].'</td>
			</tr>
		</table>';

$html.='<table width="100%" border="0" cellpadding="2" cellspacing="0" align="center" style="font-family:sans-serif; text-align:left; border-collapse:collapse; font-size:10pt;">
			<tr>
				<td style="width:20%;"></td><td style="width:40%;"></td>
				<td style="width:20%;"></td><td style="width:20%;"></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>PERSONAL DETAILS</strong></td>
				<td colspan="2" rowspan="19" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center; font-size:10pt;">Paste Payment Proof, Screenshot of 1Bill or Konnect App or Mobile Banking App Payment here</td>
			</tr>
			<tr>
				<td style="padding-top:10px; padding-bottom:5px; border-bottom:1px solid #000;">STUDENT'."'".'S NAME:</td>
				<td style="padding-top:10px; padding-bottom:5px; border-bottom:1px solid #000;">'.$row['Name'].'</td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">FATHER'."'".'S NAME:</td>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">'.$row['FatherName'].'</td>
			</tr>
			<tr><td colspan="2" style="height:8px;">&nbsp;</td></tr>';

	$html.='<tr>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>CONTACT DETAILS</strong></td>
			</tr>
			<tr>
				<td style="padding-top:10px; padding-bottom:5px; border-bottom:1px solid #000;">DOMICILE DISTRICT:</td>
				<td style="padding-top:10px; padding-bottom:5px; border-bottom:1px solid #000;">'.$Domicile.'</td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">POSTAL ADDRESS:</td>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">'.$row['PostalAddress'].'</td>
			</tr>
			<tr><td colspan="2" style="height:8px;">&nbsp;</td></tr>';

	$html.='<tr>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>EXAM CENTRE</strong></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:10px; padding-bottom:5px; border-bottom:1px solid #000;">CENTRE: <b>'.$row['ACentreCode'].'</b> &nbsp; &nbsp; '.$row['ACentreName'].'</td>
			</tr>
			<tr><td colspan="2" style="height:8px;">&nbsp;</td></tr>';

	$html.='<tr>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>GROUP/SUBJECTS DETAILS</strong></td>
			</tr>
			<tr>
				<td style="padding-top:10px; padding-bottom:5px; border-bottom:1px solid #000;">GROUP:</td>
				<td style="padding-top:10px; padding-bottom:5px; border-bottom:1px solid #000;">'.$row['GroupName'].'</td>
			</tr>
			<tr>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">COMBINATION:</td>
				<td style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;">'.$row['CombinationName'].'</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;"> 1) '.$row['Sub1Name'].' &nbsp;&nbsp;&nbsp; 2) '.$row['Sub2Name'].' &nbsp;&nbsp;&nbsp; 3) '.$row['Sub3Name'].' &nbsp;&nbsp;&nbsp; 4) '.$row['Sub4Name'].'</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;"> 5) '.$row['Sub5Name'].' &nbsp;&nbsp;&nbsp; 6) '.$row['Sub6Name'].' &nbsp;&nbsp;&nbsp; 7) '.$row['Sub7Name'].' &nbsp;&nbsp;&nbsp; 8) '.$row['Sub8Name'].' &nbsp;&nbsp;&nbsp; 9) '.$row['Sub9Name'].'</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;"> 1) '.$row['Sub21Name'].' &nbsp;&nbsp;&nbsp; 2) '.$row['Sub22Name'].' &nbsp;&nbsp;&nbsp; 3) '.$row['Sub23Name'].' &nbsp;&nbsp;&nbsp; 4) '.$row['Sub24Name'].'</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px; border-bottom:1px solid #000;"> 5) '.$row['Sub25Name'].' &nbsp;&nbsp;&nbsp; 6) '.$row['Sub26Name'].' &nbsp;&nbsp;&nbsp; 7) '.$row['Sub27Name'].' &nbsp;&nbsp;&nbsp; 8) '.$row['Sub28Name'].' &nbsp;&nbsp;&nbsp; 9) '.$row['Sub29Name'].'</td>
			</tr>';

	$html.='<tr>
				<td colspan="2" style="padding-top:5px; padding-bottom:5px;">I HEREBY DECLARE THAT THE DETAILS FURNISHED ABOVE ARE TRUE AND CORRECT TO THE BEST OF MY KNOWLEDGE AND BELIEF.</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:30px; padding-bottom:5px;">SIGNATURE OF CANDIDATE(<span style="font-weight:bold;">ENGLISH</span>) _______________</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:30px; padding-bottom:5px;">SIGNATURE OF CANDIDATE(<span style="font-weight:bold;">URDU</span>) _______________</td>
			</tr>
		</table>';

$html.='<table width="100%" border="0" cellpadding="5" cellspacing="0" style="font-family:sans-serif; font-size:10pt; border:1px dashed #000;">
<tr>
	<td width="50%" style="text-align:left;">ATTESTATION OFFICER NAME ________________ </td>
	<td width="50%" style="text-align:right;">DESIGNATION ______________________</td>
</tr>
<tr><td colspan="2" style="height:25px;">&nbsp;</td></tr>
<tr>
	<td width="50%" style="text-align:left;">SIGNATURE ______________________</td>
	<td width="50%" style="text-align:right;">STAMP ______________________</td>
</tr>
<tr>
	<td colspan="2" style="text-align:right;"><img src="images/pic1.jpg" style="height:25px;"/></td>
</tr>
</table>';

// Write the full page 2 content including attestation
$pdf->writeHTML($html, true, false, true, false, '');

// Page 3: Challan - Landscape with 4 columns
$pdf->AddPage('L', 'A4');
$pdf->SetMargins(8, 10, 8);
$pdf->SetY(10);

$html1='<table width="100%" cellpadding="2" cellspacing="0" style="font-family:sans-serif; border-collapse:collapse; font-size:12pt;"><tr><td align="center" style="font-weight:bold; padding-top:10px; padding-bottom:10px;">Bank Copy</td></tr></table>';

$html2='<table width="100%" cellpadding="2" cellspacing="0" style="font-family:sans-serif; border-collapse:collapse; font-size:12pt;"><tr><td align="center" style="font-weight:bold; padding-top:10px; padding-bottom:10px;">Bank Copy (Along with Scroll)</td></tr></table>';

$html3='<table width="100%" cellpadding="2" cellspacing="0" style="font-family:sans-serif; border-collapse:collapse; font-size:12pt;"><tr><td align="center" style="font-weight:bold; padding-top:10px; padding-bottom:10px;">Board Copy</td></tr></table>';

$html4='<table width="100%" cellpadding="2" cellspacing="0" style="font-family:sans-serif; border-collapse:collapse; font-size:12pt;"><tr><td align="center" style="font-weight:bold; padding-top:10px; padding-bottom:10px;">Depositor Copy</td></tr></table>';

$html5='<table width="100%" cellpadding="0" cellspacing="0"><tr><td align="center" style="padding-top:8px; padding-bottom:8px;"><img src="images/logo-challan.png"/></td></tr></table>';

		   $htmll='<table width="100%" cellpadding="4" cellspacing="0" style="font-family:sans-serif; text-align:left; border-collapse:collapse; font-size:9pt;">
					<tr>
						<td colspan="2" style="font-weight:bold; height:30px; padding-top:10px; padding-bottom:6px;">Branch Code: _______ &nbsp;Date: _______ </td>
					</tr>
					<tr style="border:1px solid #000;">
						<td style="height:26px; width:35%; font-weight:bold; padding-top:6px; padding-bottom:6px;">&nbsp;1-Bill #: </td>
						<td style="width:65%; border-bottom:1px solid #000; font-weight:bold; padding-top:6px; padding-bottom:6px;">1001145177'.$row['ChallanNo'].'</td>
					</tr>
					<tr style="border:1px solid #000;">
						<td style="height:26px; width:35%; font-weight:bold; padding-top:6px; padding-bottom:6px;">&nbsp;Challan #: </td>
						<td style="width:65%; border-bottom:1px solid #000; font-weight:bold; padding-top:6px; padding-bottom:6px;">'.$row['ChallanNo'].'</td>
					</tr>
					<tr><td colspan="2" style="height:10px;">&nbsp;</td></tr>
					<tr>
						<td style="height:26px; padding-top:6px; padding-bottom:6px;">App No: </td>
						<td style="border-bottom:1px solid #000; padding-top:6px; padding-bottom:6px;">PII-'.$row['Id'].'</td>
					</tr>
					<tr>
						<td style="height:26px; padding-top:6px; padding-bottom:6px;">Student Name: </td>
						<td style="border-bottom:1px solid #000; padding-top:6px; padding-bottom:6px;">'.$row['Name'].'</td>
					</tr>
					<tr>
						<td style="height:26px; padding-top:6px; padding-bottom:6px;">Depositor'."'".'s CNIC: </td>
						<td style="border-bottom:1px solid #000; padding-top:6px; padding-bottom:6px;"></td>
					</tr>
					<tr>
						<td style="height:26px; padding-top:6px; padding-bottom:6px;">Phone No: </td>
						<td style="border-bottom:1px solid #000; padding-top:6px; padding-bottom:6px;">'.$row['Phone'].'</td>
					</tr>
					<tr>
						<td style="height:26px; padding-top:6px; padding-bottom:6px;">Address: </td>
						<td style="border-bottom:1px solid #000; font-size:7pt; padding-top:6px; padding-bottom:6px;">'.$row['PostalAddress'].'</td>
					</tr>
					<tr><td colspan="2" style="height:8px;">&nbsp;</td></tr>
					<tr>
						<td colspan="2">
						<table width="100%" border="1" cellpadding="4" cellspacing="0" style="font-size:9pt; margin-top:5px;">
							<tr>
								<td width="70%" style="text-align:center; font-weight:bold; padding-top:6px; padding-bottom:6px;">Category</td>
								<td width="30%" style="text-align:center; font-weight:bold; padding-top:6px; padding-bottom:6px;">Amount</td>
							</tr>
							<tr>
								<td style="padding-top:6px; padding-bottom:6px;">'.$AdmCategory.'</td>
								<td style="text-align:center; padding-top:6px; padding-bottom:6px;">'.floatval(($row['AdmissionFee']-10)).'/-</td>
							</tr>
							<tr>
								<td style="padding-top:6px; padding-bottom:6px;">GENERAL(1100-9999)</td>
								<td style="text-align:center; padding-top:6px; padding-bottom:6px;">10/-</td>
							</tr>
							<tr>
								<td style="text-align:center; font-weight:bold; padding-top:6px; padding-bottom:6px;">Total</td>
								<td style="text-align:center; font-weight:bold; padding-top:6px; padding-bottom:6px;">'.$TotalFee.'/-</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr><td colspan="2" style="height:55px;">&nbsp;</td></tr>
					<tr><td colspan="2" style="border-bottom:1pt solid black;"></td></tr>
					<tr>
						<td style="padding-top:10px;">Student'."'".'s <br> Signature </td>
						<td style="text-align:right; padding-top:10px;">Bank Officer'."'".'s <br> Signature </td>
					</tr>
					<tr><td colspan="2" style="height:12px;">&nbsp;</td></tr>
					<tr><td colspan="2" align="center"><img src="images/note2.png"/></td></tr>
					</table>';

// Render 4-column challan layout using a single HTML table
$challan_html = '<table width="100%" cellpadding="6" cellspacing="0" border="0"><tr>';
$challan_html .= '<td width="25%" valign="top" style="border-right:1px dashed #999;">'.$html1.$html5.$htmll.'</td>';
$challan_html .= '<td width="25%" valign="top" style="border-right:1px dashed #999;">'.$html2.$html5.$htmll.'</td>';
$challan_html .= '<td width="25%" valign="top" style="border-right:1px dashed #999;">'.$html3.$html5.$htmll.'</td>';
$challan_html .= '<td width="25%" valign="top">'.$html4.$html5.$htmll.'</td>';
$challan_html .= '</tr></table>';

$pdf->writeHTML($challan_html, true, false, true, false, '');

$pdf->Output('AdmissionForm.pdf', 'I');
?>