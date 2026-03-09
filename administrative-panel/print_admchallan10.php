<?php
ob_start();
include('includes/config.php');
error_reporting(0);
ini_set('display_errors', 0);
ob_clean();
require_once("TCPDF/tcpdf.php");

// Parameters from URL: BatchId, INST (InstituteId), EID (ExamYear)
$BatchId  = isset($_REQUEST['BatchId']) ? intval($_REQUEST['BatchId']) : 0;
$InstId   = isset($_REQUEST['INST'])    ? intval($_REQUEST['INST'])    : 0;
$ExamYear = isset($_REQUEST['EID'])     ? mysqli_real_escape_string($conn1, $_REQUEST['EID']) : '';

// Fetch ALL students for this batch
$sql = "SELECT * FROM tbladm_10 WHERE BatchId=" . $BatchId;
if($InstId > 0)     { $sql .= " AND InstituteId=" . $InstId; }
if($ExamYear != '') { $sql .= " AND ExamYear='" . $ExamYear . "'"; }
$sql .= " ORDER BY BatchSr ASC";

$res = mysqli_query($conn1, $sql);
if(!$res) { ob_end_clean(); die("SQL Error: " . mysqli_error($conn1)); }
if(mysqli_num_rows($res) == 0) {
    ob_end_clean();
    die("<p style='font-family:sans-serif;padding:20px;'>No students found for BatchId=$BatchId, InstituteId=$InstId, Year=" . htmlspecialchars($ExamYear) . "</p>");
}

// Load all rows into array
$students = [];
while($row = mysqli_fetch_assoc($res)) {
    $students[] = $row;
}

$h = "5"; $hm = $h * 60; $ms = $hm * 60;
$Dated = gmdate("d-m-Y", time()+($ms));

$imgPath  = __DIR__ . '/images/';
$logoPath = $imgPath . 'logo-challan.png';
$notePath = $imgPath . 'note2.png';

// Helper: build ONE challan copy for a single student (same design as print_stdprvform10.php page 3)
function buildStudentChallan($copyTitle, $std, $imgPath) {
    $ChallanNo   = $std['ChallanNo']      ?? '';
    $TotalFee    = floatval($std['AdmissionFee'] ?? 0);

    // Admission category label
    $cat = (int)($std['AdmCategory'] ?? 0);
    if($cat == 1)      { $AdmCategory = 'First Time'; }
    elseif($cat == 3)  { $AdmCategory = 'For Improving Result'; }
    elseif($cat == 4)  { $AdmCategory = 'In Additional Subject(s)'; }
    elseif($cat == 5)  { $AdmCategory = 'After Complete Failure'; }
    elseif($cat == 6)  { $AdmCategory = 'As A Compartment Case'; }
    elseif($cat == 7)  { $AdmCategory = 'After Passing Adib Alam/Shahadat'; }
    elseif($cat == 9)  { $AdmCategory = 'In Subject(s) With Grace Marks'; }
    else               { $AdmCategory = 'First Time'; }

    // Copy title header
    $html1 = '<table width="100%" style="font-family:sans-serif; border-collapse:collapse; margin-bottom:7px; font-size:12pt;"><tr><td align="center">' . $copyTitle . '</td></tr></table>';
    // BISE logo
    $html5 = '<table width="100%"><tr><td align="center"><img src="' . $imgPath . 'logo-challan.png"/></td></tr></table>';
    // Main challan body — exact same structure as print_stdprvform10.php
    $htmll = '<table width="100%" style="font-family:sans-serif; float:left; text-align:left; margin-left:10px; margin-right:10px; margin-top:5px; border-collapse:collapse; font-size:10pt;">
                <tr>
                    <td colspan="2" style="font-weight:bold; height:30px;">Branch Code: _______ &nbsp;Date: _______ </td>
                </tr>
                <tr style="border:1px solid #000;">
                    <td style="height:25px; width:35%; font-weight:bold;">&nbsp; 1-Bill #: </td>
                    <td style="width:65%; border-bottom:1px solid #000; font-weight:bold;">1001145177' . $ChallanNo . '</td>
                </tr>
                <tr style="border:1px solid #000;">
                    <td style="height:25px; width:35%; font-weight:bold;">&nbsp; Challan #: </td>
                    <td style="width:65%; border-bottom:1px solid #000; font-weight:bold;">' . $ChallanNo . '</td>
                </tr>
                <tr><td colspan="2">&nbsp;</td></tr>
                <tr>
                    <td style="height:25px;">App No: </td>
                    <td style="border-bottom:1px solid #000;">PII-' . $std['Id'] . '</td>
                </tr>
                <tr>
                    <td style="height:25px;">Student Name: </td>
                    <td style="border-bottom:1px solid #000;">' . $std['Name'] . '</td>
                </tr>
                <tr>
                    <td style="height:25px;">Depositor\'s CNIC: </td>
                    <td style="border-bottom:1px solid #000;"></td>
                </tr>
                <tr>
                    <td style="height:25px;">Phone No: </td>
                    <td style="border-bottom:1px solid #000;">' . $std['Phone'] . '</td>
                </tr>
                <tr>
                    <td style="height:25px;">Address: </td>
                    <td style="border-bottom:1px solid #000; font-size:9pt;">' . $std['PostalAddress'] . '</td>
                </tr>
                <tr>
                    <td colspan="2">
                    <table width="100%" border="1" style="font-size:9pt; margin-top:10px;">
                        <tr>
                            <td width="70%" style="text-align:center; font-weight:bold;">Category</td>
                            <td width="30%" style="text-align:center; font-weight:bold;">Amount</td>
                        </tr>
                        <tr>
                            <td>' . $AdmCategory . '</td>
                            <td style="text-align:center;">' . floatval($TotalFee - 10) . '/-</td>
                        </tr>
                        <tr>
                            <td>GENERAL(1100-9999)</td>
                            <td style="text-align:center;">10/-</td>
                        </tr>
                        <tr>
                            <td style="text-align:center; font-weight:bold;">Total</td>
                            <td style="text-align:center; font-weight:bold;">' . $TotalFee . '/-</td>
                        </tr>
                    </table>
                    </td>
                </tr>
                <tr><td colspan="2" style="height:50px;">&nbsp;</td></tr>
                <tr><td colspan="2" style="border-bottom:1pt solid black;"></td></tr>
                <tr>
                    <td>Student\'s <br/> Signature </td>
                    <td style="text-align:right;">Bank Officer\'s <br/> Signature </td>
                </tr>
                <tr><td colspan="2" align="center"><img src="' . $imgPath . 'note2.png"/></td></tr>
            </table>';

    return $html1 . $html5 . $htmll;
}

$copies = ['Bank Copy', 'Bank Copy (Along with Scroll)', 'Board Copy', 'Depositor Copy'];

// Create PDF — Landscape A4, one page per student with 4 copies
$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('AJK BISE');
$pdf->SetAuthor('AJK BISE');
$pdf->SetTitle('SSC Admission Challans');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(5, 6, 5);
$pdf->SetAutoPageBreak(false, 0);
$pdf->SetFont('helvetica', '', 10);
$pdf->SetProtection(array('print'), '', null, 0, null);
$pdf->SetDisplayMode('fullpage');

foreach($students as $std) {
    $pdf->AddPage();
    $pdf->SetY(6);

    $challanHTML  = '<table width="100%" cellpadding="3" cellspacing="0" border="0"><tr>';
    $challanHTML .= '<td width="25%" valign="top" style="border-right:1px dashed #999;">'
                  . buildStudentChallan($copies[0], $std, $imgPath) . '</td>';
    $challanHTML .= '<td width="25%" valign="top" style="border-right:1px dashed #999;">'
                  . buildStudentChallan($copies[1], $std, $imgPath) . '</td>';
    $challanHTML .= '<td width="25%" valign="top" style="border-right:1px dashed #999;">'
                  . buildStudentChallan($copies[2], $std, $imgPath) . '</td>';
    $challanHTML .= '<td width="25%" valign="top">'
                  . buildStudentChallan($copies[3], $std, $imgPath) . '</td>';
    $challanHTML .= '</tr></table>';

    $pdf->writeHTML($challanHTML, true, false, true, false, '');
}

ob_end_clean();
$pdf->Output('challans_batch' . $BatchId . '.pdf', 'I');
?>