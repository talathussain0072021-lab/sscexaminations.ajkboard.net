<?php
// ob_start MUST be first — before config.php (which calls session_start)
// so any accidental output is buffered and won't break PDF headers
ob_start();

include('includes/config.php');

// Suppress all error display — warnings to output will corrupt PDF
error_reporting(0);
ini_set('display_errors', 0);

ob_clean(); // discard anything config.php may have output

require_once("TCPDF/tcpdf.php");

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('AJK BISE');
$pdf->SetAuthor('AJK BISE');
$pdf->SetTitle('SSC Admission Form');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(10, 5, 10);
$pdf->SetAutoPageBreak(false, 0);
$pdf->SetFont('helvetica', '', 9);
$pdf->SetProtection(array('print'), '', null, 0, null);
$pdf->SetDisplayMode('fullpage');
$pdf->setCellPadding(0);
// NOTE: AddPage() moved to AFTER data is fetched

$h = "5"; $hm = $h * 60; $ms = $hm * 60;
$Dated = gmdate("d-m-Y g:i:s A", time()+($ms));

// Normalise param names — accept both ?eid= and ?EID= (case-insensitive)
$_rEid     = isset($_REQUEST['eid'])     ? $_REQUEST['eid']     : (isset($_REQUEST['EID'])     ? $_REQUEST['EID']     : '');
$_rId      = isset($_REQUEST['Id'])      ? $_REQUEST['Id']      : '';
$_rBatchId = isset($_REQUEST['BatchId']) ? $_REQUEST['BatchId'] : '';
$_rInst    = isset($_REQUEST['INST'])    ? $_REQUEST['INST']    : (isset($_REQUEST['InstituteId']) ? $_REQUEST['InstituteId'] : '');

$ExamFullName = 'SSC 20' . intval($_rEid);

// Absolute path for student pictures (TCPDF requires absolute paths for images)
$picBasePath = dirname(__DIR__) . '/SSCPicsBackup/';
$imgPath = __DIR__ . '/images/';

// Null-safe strtoupper helper for PHP 8.2+
function su($val) { return strtoupper((string)($val ?? '')); }

$html="";
$sql="SELECT * FROM tbladm_10 WHERE isRegular='0'";
if(!empty($_rId) && !empty($_rEid)) {
	$sql .= " AND InstituteId=" . intval($_rInst) . " AND ExamYear=" . intval($_rEid);
}
else if(!empty($_rBatchId) && !empty($_rEid) && !empty($_rInst)) {
	$sql .= " AND BatchId=" . intval($_rBatchId) . " AND ExamYear=" . intval($_rEid) . " AND InstituteId=" . intval($_rInst);
}
else if(!empty($_rBatchId) && !empty($_rEid) && empty($_rInst)) {
	$sql .= " AND BatchId=" . intval($_rBatchId) . " AND ExamYear=" . intval($_rEid);
}
else {
	ob_end_clean();
	die("Error: Missing required parameters (need Id+eid or BatchId+EID).");
}

$res=mysqli_query($conn1,$sql);

// Check for SQL errors
if(!$res) {
    die("SQL Error: " . mysqli_error($conn1) . "<br>Query: " . $sql);
}

$row=mysqli_fetch_assoc($res);

// Check if record exists
if(!$row) {
    ob_end_clean();
    die("No record found for Id: " . intval($_rId) . " ExamYear: " . intval($_rEid) . " | Query: " . $sql);
}

// Data is ready — now start the PDF pages
$pdf->AddPage();
$pdf->SetY(5);



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

// Get P1YEAR
$P1Year=$row['P1Year']+$row['PYear'];
$P1RollNo=$row['P1RollNo']+$row['PRollNo'];
$P1RegNo=$row['P1RegNo']+$row['PRegNo'];
$P1Result=$row['P1Result'].$row['PResult'];

// Get P1SESSION
if($row['P1Session'] == 1 || $row['PSession'] == 1){ $P1Session='1st Annual'; }
else if($row['P1Session'] == 2 || $row['PSession'] == 2){ $P1Session='2nd Annual'; }
else { $P1Session=''; }

// Get P1Board name
$PBOARDS=$row['P1Board'].$row['PBoard'];
if(!empty($PBOARDS) && $PBOARDS > 0){
	$sql_p1board="SELECT Name FROM boards WHERE Id=".intval($PBOARDS)."";
	$res_p1board=mysqli_query($conn2,$sql_p1board);
	$row_p1board=mysqli_fetch_assoc($res_p1board);
	$P1Board=$row_p1board['Name'];
} else {
	$P1Board='';
}

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


// Calculate challan fee details
$TotalFee = floatval($row['AdmissionFee']);
$Category = array('', '', ''); // Default empty category

// ===========================
// PAGE 1: STUDENT COPY
// ===========================
$html.='<table width="100%" border="0" align="center" style="font-family:sans-serif; text-align:left; margin:10px; border-collapse:collapse; font-size:9pt;">
			<tr><td colspan="6" style="text-align:center; font-size:11pt;"><b>AZAD JAMMU AND KASHMIR BOARD OF INTERMEDIATE AND SECONDARY EDUCATION MIRPUR</b></td></tr>
			<tr><td colspan="6" style="text-align:center; font-size:11pt;">ADMISSION FORM FOR MATRIC '.su($ExamFullName).' PART-II(10TH)</td></tr>
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
				<td colspan="3">&nbsp; '.su($AdmCategory).'</td>
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
				<td colspan="6" style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;"><b>CENTRE: '.su($row['ACentreCode']).'</b> &nbsp; &nbsp; <b>'.su($row['ACentreName']).'</b></td>
			</tr>
		</table>';

// Personal Details + Contact Details table
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
				<td colspan="3" style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">'.su($row['Name']).'</td>
				<td rowspan="6" style="padding-top:10px; text-align:center;"><img src="'.$picBasePath.$row['ExamYear'].'/'.$row['ExamSession'].'/'.$row['PicURL'].'" style="height:140px; width:135px;"/></td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">FATHER'."'".'S NAME:</td>
				<td colspan="3" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.su($row['FatherName']).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">CNIC/FORM B NO:</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.$row['CNIC'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">DOB:</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.date('d-m-Y',strtotime($row['DOB'])).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">GENDER:</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.su($Gender).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">RELIGION:</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.su($Religion).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">MARK OF IDENTIFICATION:</td>
				<td colspan="3" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.su($row['IdentityMarks']).'</td>
			</tr>
			<tr><td colspan="4">&nbsp;</td></tr>';

	$html.='<tr>
				<td colspan="5" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>CONTACT DETAILS</strong></td>
			</tr>
			<tr>
				<td style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">POSTAL ADDRESS:</td>
				<td colspan="4" style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">'.su($row['PostalAddress']).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">PERMANENT ADDRESS:</td>
				<td colspan="4" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.su($row['PermanentAddress']).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">HOME PHONE NO:</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.$row['Phone'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">MOBILE NO:</td>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.$row['Mobile'].'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">POSTAL DISTRICT:</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.su($PostalDistrict).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">POSTAL TEHSIL:</td>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.su($PostalTehsil).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">DOMICILE DISTRICT:</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.su($Domicile).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">POST OFFICE:</td>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.su($row['PostOffice']).'</td>
			</tr>
		</table>';

// GROUP/SUBJECTS DETAILS table
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
				<td colspan="7" style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">GROUP: '.su($row['GroupName']).' &nbsp; &nbsp; COMBINATION: '.su($row['CombinationName']).' &nbsp; &nbsp; GROUP CHANGE: '.su($IsGroupChange).'  &nbsp; &nbsp; COMBINATION CHANGE: '.su($IsCombChange).'('.$row['SubChangeType'].')'.'</td>
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
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.su($row['Sub1Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub1Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;"></td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.su($row['Sub21Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub21Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;"></td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;"></td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.su($row['Sub2Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub2Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;"></td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.su($row['Sub22Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub22Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;"></td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;"></td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.su($row['Sub3Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub3Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.su($Medium3).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.su($row['Sub23Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub23Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.su($Medium23).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;"></td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.su($row['Sub4Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub4Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.su($Medium4).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.su($row['Sub24Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub24Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.su($Medium24).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;"></td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.su($row['Sub5Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub5Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.su($Medium5).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.su($row['Sub25Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub25Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.su($Medium25).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;"></td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.su($row['Sub6Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub6Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.su($Medium6).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.su($row['Sub26Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub26Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.su($Medium26).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">'.su($row['Sub26PName']).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.su($row['Sub7Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub7Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.su($Medium7).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.su($row['Sub27Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub27Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.su($Medium27).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">'.su($row['Sub27PName']).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.su($row['Sub8Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub8Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.su($Medium8).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.su($row['Sub28Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub28Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.su($Medium28).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">'.su($row['Sub28PName']).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.su($row['Sub9Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub9Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.su($Medium9).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;">&nbsp;'.su($row['Sub29Name']).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.$row['Sub29Code'].'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center;">'.su($Medium29).'</td>
				<td style="padding-top:3px; padding-bottom:3px; border:1px solid #000;"></td>
			</tr>
			<tr><td colspan="7"><img src="'.$imgPath.'pic.jpg"/></td></tr>
		</table>';

// Write the main content
$pdf->writeHTML($html, true, false, true, false, '');

// Signature and attestation at bottom of page (fixed position like reference)
$pdf->SetY(255);
$sigHtml='<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:sans-serif; font-size:9pt;">
<tr>
	<td width="50%" style="text-align:left; padding-bottom:5px;">SIGNATURE OF CANDIDATE(<span style="font-weight:bold;">ENGLISH</span>) _______________</td>
	<td width="50%" style="text-align:right; padding-bottom:5px;">SIGNATURE OF CANDIDATE(<span style="font-weight:bold;">URDU</span>) _______________</td>
</tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="0" style="font-family:sans-serif; font-size:9pt; border:1px dashed #000;">
<tr>
	<td width="50%" style="text-align:left; padding-top:10px;">ATTESTATION OFFICER NAME ________________ </td>
	<td width="50%" style="text-align:right; padding-top:10px;">DESIGNATION ______________________</td>
</tr>
<tr>
	<td width="50%" style="text-align:left; padding-top:40px;">SIGNATURE ______________________</td>
	<td width="50%" style="text-align:right; padding-top:40px;">STAMP ______________________</td>
</tr>
<tr>
	<td colspan="2" style="text-align:right;"><img src="'.$imgPath.'pic.jpg" style="height:25px;"/></td>
</tr>
</table>';
$pdf->writeHTML($sigHtml, true, false, true, false, '');

// ===========================
// PAGE 2: BOARD COPY
// ===========================
$pdf->AddPage();
$pdf->SetMargins(10, 5, 10);
$pdf->SetY(5);

$html2pg='<table width="100%" border="0" align="center" style="font-family:sans-serif; text-align:left; margin:10px; border-collapse:collapse; font-size:9pt;">
			<tr><td colspan="6" style="text-align:center; font-size:11pt;"><b>AZAD JAMMU AND KASHMIR BOARD OF INTERMEDIATE AND SECONDARY EDUCATION MIRPUR</b></td></tr>
			<tr><td colspan="6" style="text-align:center; font-size:11pt;">ADMISSION FORM FOR MATRIC '.su($ExamFullName).' PART-II(10TH)</td></tr>
			<tr><td colspan="6" style="text-align:center; font-size:11pt;"><span style="border:1px solid #000; background-color:#666666; color:#FFFFFF;"><b>&nbsp; FOR PRIVATE CANDIDATES &nbsp;</b></span></td></tr>
			<tr>
				<td style="width:18%;"></td><td style="width:17%;"></td>
				<td style="width:17%;"></td><td style="width:18%;"></td>
				<td style="width:15%;"></td><td style="width:15%;"></td>
			</tr>
			<tr>
				<td>APPEARING TYPE:</td>
				<td colspan="3">&nbsp; '.su($AdmCategory).'</td>
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

$html2pg.='<table width="100%" border="0" align="center" style="font-family:sans-serif; text-align:left; margin:10px; border-collapse:collapse; font-size:9pt;">
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
				<td style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">'.su($row['Name']).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">FATHER'."'".'S NAME:</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.su($row['FatherName']).'</td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>';

	$html2pg.='<tr>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>CONTACT DETAILS</strong></td>
			</tr>
			<tr>
				<td style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">DOMICILE DISTRICT:</td>
				<td style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">'.su($Domicile).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">POSTAL ADDRESS:</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.su($row['PostalAddress']).'</td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>';

	$html2pg.='<tr>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>EXAM CENTRE</strong></td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">CENTRE: <b>'.su($row['ACentreCode']).'</b> &nbsp; &nbsp; '.su($row['ACentreName']).'</td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>';

	$html2pg.='<tr>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>GROUP/SUBJECTS DETAILS</strong></td>
			</tr>
			<tr>
				<td style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">GROUP:</td>
				<td style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">'.su($row['GroupName']).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">COMBINATION:</td>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.su($row['CombinationName']).'</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;"> 1) '.su($row['Sub1Name']).' &nbsp;&nbsp;&nbsp; 2) '.su($row['Sub2Name']).' &nbsp;&nbsp;&nbsp; 3) '.su($row['Sub3Name']).' &nbsp;&nbsp;&nbsp; 4) '.su($row['Sub4Name']).'</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;"> 5) '.su($row['Sub5Name']).' &nbsp;&nbsp;&nbsp; 6) '.su($row['Sub6Name']).' &nbsp;&nbsp;&nbsp; 7) '.su($row['Sub7Name']).' &nbsp;&nbsp;&nbsp; 8) '.su($row['Sub8Name']).' &nbsp;&nbsp;&nbsp; 9) '.su($row['Sub9Name']).'</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;"> 1) '.su($row['Sub21Name']).' &nbsp;&nbsp;&nbsp; 2) '.su($row['Sub22Name']).' &nbsp;&nbsp;&nbsp; 3) '.su($row['Sub23Name']).' &nbsp;&nbsp;&nbsp; 4) '.su($row['Sub24Name']).'</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;"> 5) '.su($row['Sub25Name']).' &nbsp;&nbsp;&nbsp; 6) '.su($row['Sub26Name']).' &nbsp;&nbsp;&nbsp; 7) '.su($row['Sub27Name']).' &nbsp;&nbsp;&nbsp; 8) '.su($row['Sub28Name']).' &nbsp;&nbsp;&nbsp; 9) '.su($row['Sub29Name']).'</td>
			</tr>';

	$html2pg.='<tr>
				<td colspan="2" style="padding-top:3px; padding-bottom:3px;">I HEREBY DECLARE THAT THE DETAILS FURNISHED ABOVE ARE TRUE AND CORRECT TO THE BEST OF MY KNOWLEDGE AND BELIEF.</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:30px; padding-bottom:3px;">SIGNATURE OF CANDIDATE(<span style="font-weight:bold;">ENGLISH</span>) _______________</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-top:30px; padding-bottom:3px;">SIGNATURE OF CANDIDATE(<span style="font-weight:bold;">URDU</span>) _______________</td>
			</tr>
		</table>';

// Write Board Copy main content
$pdf->writeHTML($html2pg, true, false, true, false, '');

// Board Copy attestation at bottom
$pdf->SetY(255);
$sigHtml2='<table width="100%" border="0" cellpadding="3" cellspacing="0" style="font-family:sans-serif; font-size:9pt; border:1px dashed #000;">
<tr>
	<td width="50%" style="text-align:left; padding-top:10px;">ATTESTATION OFFICER NAME ________________ </td>
	<td width="50%" style="text-align:right; padding-top:10px;">DESIGNATION ______________________</td>
</tr>
<tr>
	<td width="50%" style="text-align:left; padding-top:40px;">SIGNATURE ______________________</td>
	<td width="50%" style="text-align:right; padding-top:40px;">STAMP ______________________</td>
</tr>
<tr>
	<td colspan="2" style="text-align:right;"><img src="'.$imgPath.'pic.jpg" style="height:25px;"/></td>
</tr>
</table>';
$pdf->writeHTML($sigHtml2, true, false, true, false, '');

// ===========================
// PAGE 3: CHALLAN - Landscape with 4 columns
// ===========================
$pdf->AddPage('L', 'A4');
$pdf->SetMargins(5, 6, 5);
$pdf->SetY(6);

$html1='<table width="100%" style="font-family:sans-serif; border-collapse:collapse; margin-bottom:7px; font-size:12pt;"><tr><td align="center">Bank Copy</td></tr></table>';

$html2='<table width="100%" style="font-family:sans-serif; border-collapse:collapse; margin-bottom:7px; font-size:12pt;"><tr><td align="center">Bank Copy (Along with Scroll)</td></tr></table>';

$html3='<table width="100%" style="font-family:sans-serif; border-collapse:collapse; margin-bottom:7px; font-size:12pt;"><tr><td align="center">Board Copy</td></tr></table>';

$html4='<table width="100%" style="font-family:sans-serif; border-collapse:collapse; margin-bottom:7px; font-size:12pt;"><tr><td align="center">Depositor Copy</td></tr></table>';

$html5='<table width="100%"><tr><td align="center"><img src="'.$imgPath.'logo-challan.png"/></td></tr></table>';

		   $htmll='<table width="100%" style="font-family:sans-serif; float:left; text-align:left; margin-left:10px; margin-right:10px; margin-top:5px; border-collapse:collapse; font-size:10pt;">
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
								<td>'.$AdmCategory.'</td>
								<td style="text-align:center;">'.floatval(($row['AdmissionFee']-10)).'/-</td>
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
					<tr><td colspan="2" align="center"><img src="'.$imgPath.'note2.png"/></td></tr>
					</table>';

// Render 4-column challan layout using a single HTML table
$challan_html = '<table width="100%" cellpadding="3" cellspacing="0" border="0"><tr>';
$challan_html .= '<td width="25%" valign="top" style="border-right:1px dashed #999;">'.$html1.$html5.$htmll.'</td>';
$challan_html .= '<td width="25%" valign="top" style="border-right:1px dashed #999;">'.$html2.$html5.$htmll.'</td>';
$challan_html .= '<td width="25%" valign="top" style="border-right:1px dashed #999;">'.$html3.$html5.$htmll.'</td>';
$challan_html .= '<td width="25%" valign="top">'.$html4.$html5.$htmll.'</td>';
$challan_html .= '</tr></table>';

$pdf->writeHTML($challan_html, true, false, true, false, '');

ob_end_clean();
$pdf->Output('AdmissionForm.pdf', 'I');
?>