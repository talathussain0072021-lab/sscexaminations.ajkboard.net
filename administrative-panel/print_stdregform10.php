<?php
ob_start();
include('includes/config.php');
error_reporting(0);
ini_set('display_errors', 0);
ob_clean();
require_once("TCPDF/tcpdf.php");

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('AJK BISE');
$pdf->SetAuthor('AJK BISE');
$pdf->SetTitle('SSC Regular Admission Form');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(10, 8, 10);
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetFont('helvetica', '', 9);
$pdf->SetProtection(array('print'), '', null, 0, null);
$pdf->SetDisplayMode('fullpage');

function su($val) { return strtoupper((string)($val ?? '')); }

$h = "5"; $hm = $h * 60; $ms = $hm * 60;
$Dated = gmdate("d-m-Y g:i:s A", time()+($ms));

$EID    = isset($_REQUEST['EID'])     ? mysqli_real_escape_string($conn1, $_REQUEST['EID'])     : '';
$BatchId= isset($_REQUEST['BatchId']) ? intval($_REQUEST['BatchId']) : 0;
$INST   = isset($_REQUEST['INST'])    ? intval($_REQUEST['INST'])    : 0;

if($EID == 'All' || $EID == '') {
    $ExamName = 'SSC ADMISSIONS ALL YEARS';
    $ExamYear = '';
} else {
    $ExamName = 'SSC ADMISSIONS FOR THE YEAR ' . $EID;
    $ExamYear = $EID;
}
$ExamFullName = $ExamName;

// Build query with correct filters
$sql="SELECT * FROM tbladm_10 WHERE 1=1";

if($ExamYear != '') {
    $sql .= " AND ExamYear='" . $ExamYear . "'";
}
if($BatchId > 0) {
    $sql .= " AND BatchId=" . $BatchId;
}
if($INST > 0) {
    $sql .= " AND InstituteId=" . $INST;
}
$sql .= " ORDER BY Id ASC";

$res = mysqli_query($conn1, $sql);
if(!$res) { die("SQL Error: " . mysqli_error($conn1)); }

$html = "";
while($row = mysqli_fetch_assoc($res))
{

$P1Year=str_pad($row['P1Year'],2,'0',STR_PAD_LEFT);

if($row['P1Session'] == 1){ $P1Session='1st Annual'; }
else if($row['P1Session'] == 2){ $P1Session='2nd Annual'; }
else { $P1Session=''; }

$sql_p1boards="SELECT Name FROM boards WHERE Id=".intval($row['P1Board'])."";
$res_p1boards=mysqli_query($conn2, $sql_p1boards);
$row_p1boards=mysqli_fetch_assoc($res_p1boards);
$P1Board = $row_p1boards ? $row_p1boards['Name'] : '';

if($row['Gender'] == 1){ $Gender='Male'; }
else if($row['Gender'] == 2){ $Gender='Female'; }
else { $Gender=''; }

if($row['Religion'] == 1){ $Religion='Muslim'; }
else if($row['Religion'] == 2){ $Religion='Non Muslim'; }
else { $Religion=''; }

$sql_domiciles="SELECT Name FROM districts WHERE Id=".intval($row['Domicile'])."";
$res_domiciles=mysqli_query($conn2, $sql_domiciles);
$row_domiciles=mysqli_fetch_assoc($res_domiciles);
$Domicile = $row_domiciles ? $row_domiciles['Name'] : '';

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
			<tr><td colspan="6" style="text-align:center; font-size:11pt;"><span style="border:1px solid #000;"><b>&nbsp; FOR REGULAR CANDIDATES &nbsp;</b></span></td></tr>
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
				<td colspan="2" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; font-weight:bold;">&nbsp; REG NO: '.$row['P1RegNo'].'</td>
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
				<td colspan="6" style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;"><b>INSTITUTE: '.strtoupper($row['InstituteCode']).'</b> &nbsp; &nbsp; '.strtoupper($row['InstituteName']).'</td>
			</tr>
			<tr>
				<td colspan="6" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;"><b>CENTRE: '.strtoupper($row['ACentreCode']).'</b> &nbsp; &nbsp; <b>'.strtoupper($row['ACentreName']).'</b></td>
			</tr>';

	$html.='<tr>
				<td colspan="6" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>SSC (PART-I) REFERENCE</strong></td>
			</tr>
			<tr>
				<td style="border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000; text-align:center;">YEAR</td>
				<td style="border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000; text-align:center;">ROLL NO</td>
				<td style="border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000; text-align:center;">SESSION</td>
				<td colspan="2" style="border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000; text-align:center;">BOARD</td>
				<td style="border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000; text-align:center;">RESULT</td>
			</tr>
			<tr>
				<td style="border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; text-align:center;">'.$P1Year.'</td>
				<td style="border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; text-align:center;">'.$row['P1RollNo'].'</td>
				<td style="border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; text-align:center;">'.strtoupper($P1Session).'</td>
				<td colspan="2" style="border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; text-align:center;">'.strtoupper($P1Board).'</td>
				<td style="border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; text-align:center;">'.strtoupper($row['P1Result']).'</td>
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
				<td rowspan="6" style="padding-top:10px; text-align:center;"><img src="'.$row['PicURL'].'" style="height:140px; width:135px;"/></td>
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
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">INTERNAL GRADE:</td>
				<td colspan="3" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.strtoupper($row['InternalGrade']).'</td>
			</tr>
			<tr><td colspan="5">&nbsp;</td></tr>';

	$html.='<tr>
				<td colspan="5" style="padding-top:3px; padding-bottom:3px; border:1px solid #000; text-align:center; font-size:10pt;"><strong>CONTACT DETAILS</strong></td>
			</tr>
			<tr>
				<td style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">DOMICILE DISTRICT:</td>
				<td colspan="4" style="padding-top:10px; padding-bottom:3px; border-bottom:1px solid #000;">'.strtoupper($Domicile).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">POSTAL ADDRESS:</td>
				<td colspan="4" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.strtoupper($row['PostalAddress']).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">PERMANENT ADDRESS:</td>
				<td colspan="4" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.strtoupper($row['PermanentAddress']).'</td>
			</tr>
			<tr>
				<td style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">PHONE NO:</td>
				<td colspan="4" style="padding-top:3px; padding-bottom:3px; border-bottom:1px solid #000;">'.$row['Phone'].'</td>
			</tr>
			<tr><td colspan="5">&nbsp;</td></tr>
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
			<tr><td colspan="7">&nbsp;</td></tr>
		</table>';

$html.='<div style="width:100%; font-family:sans-serif; font-size:9pt; margin-top:10px;">
<div style="width:49%; float:left; text-align:left; padding-bottom:5px;">SIGNATURE OF CANDIDATE(<span style="font-weight:bold;">ENGLISH</span>) _______________</div>
<div style="width:49%; float:right; text-align:right; padding-bottom:5px;">SIGNATURE OF CANDIDATE(<span style="font-weight:bold;">URDU</span>) _______________</div>
<div style="clear:both;"></div>
<div style="border:1px dashed #000; padding-top:10px; padding-bottom:5px; padding-left:10px; padding-right:10px; margin-top:5px;">
	<div style="width:100%; float:left; text-align:left;">PRINCIPAL NAME <span style="border-bottom:1px solid #000;">'.su($row['InstitutePrincipal']).'</span></div>
	<div style="width:50%; float:left; text-align:left; padding-top:40px;">SIGNATURE _____________________________</div>
	<div style="width:50%; float:right; text-align:right; padding-top:40px;">STAMP ____________________________________</div>
	<div style="clear:both;"></div>
</div>
</div>';

    // Write this student to PDF
    $pdf->AddPage();
    $pdf->writeHTML($html, true, false, true, false, '');
    $html = '';
}

if($pdf->getNumPages() == 0) {
    $pdf->AddPage();
    $pdf->writeHTML('<p style="font-family:sans-serif;">No records found for the selected criteria.</p>', true, false, true, false, '');
}

ob_end_clean();
$pdf->Output('regular_admission_forms.pdf', 'I');
?>