<?php
ob_start();
include('includes/config.php');
error_reporting(0);
ini_set('display_errors', 0);
ob_clean();
require_once("TCPDF/tcpdf.php");

// ── URL Parameters ────────────────────────────────────────────────────────────
$BatchId  = isset($_REQUEST['BatchId']) ? intval($_REQUEST['BatchId'])                              : 0;
$InstId   = isset($_REQUEST['INST'])    ? intval($_REQUEST['INST'])                                  : 0;
$ExamYear = isset($_REQUEST['EID'])     ? mysqli_real_escape_string($conn1, $_REQUEST['EID'])        : '';

// ── Batch / Institute meta from tbladm_10 ────────────────────────────────────
$sql_meta = "SELECT BatchNo, ChallanNo, InstituteCode, InstituteName
             FROM tbladm_10
             WHERE BatchId=" . $BatchId;
if ($InstId > 0)     { $sql_meta .= " AND InstituteId=" . $InstId; }
if ($ExamYear != '') { $sql_meta .= " AND ExamYear='" . $ExamYear . "'"; }
$sql_meta .= " LIMIT 1";
$res_meta  = mysqli_query($conn1, $sql_meta);
if (!$res_meta || mysqli_num_rows($res_meta) == 0) {
    ob_end_clean();
    die("<p style='font-family:sans-serif;padding:20px;'>No records found for BatchId=$BatchId, InstituteId=$InstId, Year=" . htmlspecialchars($ExamYear) . "</p>");
}
$meta       = mysqli_fetch_assoc($res_meta);
$BatchNo    = $meta['BatchNo']       ?? '';
$ChallanNo  = $meta['ChallanNo']     ?? '';
$InstCode   = $meta['InstituteCode'] ?? '';
$InstName   = $meta['InstituteName'] ?? '';

// ── Principal from conn2 (institutes table) ───────────────────────────────────
$InstPrincipal = '';
if ($InstId > 0) {
    $res_inst = mysqli_query($conn2, "SELECT Principal FROM institutes WHERE Id=" . $InstId . " LIMIT 1");
    if ($res_inst && mysqli_num_rows($res_inst) > 0) {
        $row_inst      = mysqli_fetch_assoc($res_inst);
        $InstPrincipal = $row_inst['Principal'] ?? '';
    }
}

// ── Student rows from tbladm_10 ───────────────────────────────────────────────
$sql = "SELECT RegNo, P1RegNo, Name, FatherName, Gender, IsSpecial,
               GroupName, CombinationName, AdmissionFee, BatchSr
        FROM tbladm_10
        WHERE BatchId=" . $BatchId;
if ($InstId > 0)     { $sql .= " AND InstituteId=" . $InstId; }
if ($ExamYear != '') { $sql .= " AND ExamYear='" . $ExamYear . "'"; }
$sql .= " ORDER BY BatchSr ASC";

$res = mysqli_query($conn1, $sql);
if (!$res) {
    ob_end_clean();
    die("<p style='font-family:sans-serif;padding:20px;'>SQL Error: " . mysqli_error($conn1) . "</p>");
}

$students  = [];
$TotalFee  = 0;
while ($row = mysqli_fetch_assoc($res)) {
    $students[] = $row;
    $TotalFee  += floatval($row['AdmissionFee']);
}
if (count($students) == 0) {
    ob_end_clean();
    die("<p style='font-family:sans-serif;padding:20px;'>No students found.</p>");
}

// ── Date ──────────────────────────────────────────────────────────────────────
$h = 5; $Dated = gmdate("d-m-Y  g:i A", time() + ($h * 3600));
$logoPath = __DIR__ . '/images/logo-report.png';

// ── TCPDF Setup ───────────────────────────────────────────────────────────────
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('AJK BISE');
$pdf->SetAuthor('AJK BISE');
$pdf->SetTitle('SSC Revenue List');
$pdf->SetProtection(array('print'), '', null, 0, null);
$pdf->SetDisplayMode('fullpage');
$pdf->SetMargins(8, 8, 8);
$pdf->SetAutoPageBreak(true, 18);   // 18 mm bottom margin for footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetFont('helvetica', '', 9);
$pdf->AddPage();

// ══════════════════════════════════════════════════════════════════════════════
// HEADER
// ══════════════════════════════════════════════════════════════════════════════
// Logo
if (file_exists($logoPath)) {
    $pdf->Image($logoPath, 82, 8, 46, 0, '', '', '', false, 300);
    $pdf->Ln(22);
} else {
    $pdf->Ln(6);
}

// Title bar
$pdf->SetFillColor(193, 210, 230);
$pdf->SetFont('helvetica', 'B', 13);
$pdf->Cell(0, 9, 'SSC-II ADMISSIONS REVENUE LIST  ' . $ExamYear, 0, 1, 'C', true);
$pdf->SetFont('helvetica', '', 8);
$pdf->Cell(0, 5, 'Printed: ' . $Dated, 0, 1, 'R');

// Institute / Batch info row
$pdf->SetFont('helvetica', 'B', 9);
$pdf->SetFillColor(240, 240, 240);
$pdf->Cell(25, 6, 'Institute Code:', 0, 0, 'L');
$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(55, 6, $InstCode, 0, 0, 'L');
$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(28, 6, 'Institute Name:', 0, 0, 'L');
$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(0, 6, $InstName, 0, 1, 'L');

$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(25, 6, 'Batch No.:', 0, 0, 'L');
$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(55, 6, $BatchNo, 0, 0, 'L');
$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(28, 6, 'Challan No.:', 0, 0, 'L');
$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(0, 6, $ChallanNo, 0, 1, 'L');
$pdf->Ln(2);

// ══════════════════════════════════════════════════════════════════════════════
// TABLE HEADER
// ══════════════════════════════════════════════════════════════════════════════
$pdf->SetFillColor(209, 226, 242);
$pdf->SetTextColor(0);
$pdf->SetFont('helvetica', 'B', 8);
$pdf->SetLineWidth(0.3);

// Column widths (tota5 ≈ 194 mm usable on A4 portrait with 8mm margins each side)
$w = [5, 22, 5, 40, 40, 12, 20, 28, 10];  // last 0 = stretch to fill

$pdf->Cell($w[0],  7, 'Sr.',          1, 0, 'C', true);
$pdf->Cell($w[1],  7, 'Reg. No.',     1, 0, 'C', true);
$pdf->Cell($w[2],  7, 'Sr.',          1, 0, 'C', true);
$pdf->Cell($w[3],  7, 'Student Name', 1, 0, 'C', true);
$pdf->Cell($w[4],  7, 'Father Name',  1, 0, 'C', true);
$pdf->Cell($w[5],  7, 'Gender',       1, 0, 'C', true);
$pdf->Cell($w[6],  7, 'Group',        1, 0, 'C', true);
$pdf->Cell($w[7],  7, 'Combination',  1, 0, 'C', true);
$pdf->Cell(0,      7, 'Fee (Rs.)',     1, 1, 'C', true);

// ══════════════════════════════════════════════════════════════════════════════
// TABLE ROWS
// ══════════════════════════════════════════════════════════════════════════════
$pdf->SetFont('helvetica', '', 8);
$SrNo = 1;
foreach ($students as $row) {
    // Gender
    if ($row['Gender'] == 1)      { $Gender = 'Male'; }
    elseif ($row['Gender'] == 2)  { $Gender = 'Female'; }
    else                          { $Gender = ''; }

    // Category
    $sp = intval($row['IsSpecial']);
    if      ($sp == 1) { $IsSpecial = "Bd. Emp. Child"; }
    elseif  ($sp == 2) { $IsSpecial = "Refugee Child"; }
    elseif  ($sp == 3) { $IsSpecial = "Normal"; }
    elseif  ($sp == 4) { $IsSpecial = "Special"; }
    elseif  ($sp == 5) { $IsSpecial = "Orphan"; }
    else               { $IsSpecial = ''; }

    // Alternating row background
    $fill = ($SrNo % 2 == 0);
    if ($fill) { $pdf->SetFillColor(247, 251, 255); }

    $regNo = !empty($row['RegNo']) ? $row['RegNo'] : $row['P1RegNo'];
    $fee   = number_format(floatval($row['AdmissionFee']), 0);

    $pdf->Cell($w[0], 6, $SrNo,                    1, 0, 'C', $fill);
    $pdf->Cell($w[1], 6, $regNo,                   1, 0, 'C', $fill);
    $pdf->Cell($w[2], 6, $row['BatchSr'],           1, 0, 'C', $fill);
    $pdf->Cell($w[3], 6, $row['Name'],              1, 0, 'L', $fill);
    $pdf->Cell($w[4], 6, $row['FatherName'],        1, 0, 'L', $fill);
    $pdf->Cell($w[5], 6, $Gender,                   1, 0, 'C', $fill);
    $pdf->Cell($w[6], 6, $row['GroupName'],         1, 0, 'C', $fill);
    $pdf->Cell($w[7], 6, $row['CombinationName'],   1, 0, 'C', $fill);
    $pdf->Cell(0,     6, $fee,                      1, 1, 'R', $fill);

    $SrNo++;
}

// ── TOTALS ROW ────────────────────────────────────────────────────────────────
$pdf->SetFont('helvetica', 'B', 9);
$pdf->SetFillColor(193, 210, 230);
$colSumW = $w[0]+$w[1]+$w[2]+$w[3]+$w[4]+$w[5]+$w[6]+$w[7];
$pdf->Cell($colSumW, 7, 'Total Students: ' . ($SrNo - 1) . '      Total Fee:', 1, 0, 'R', true);
$pdf->Cell(0,        7, 'Rs. ' . number_format($TotalFee, 0), 1, 1, 'R', true);

// ══════════════════════════════════════════════════════════════════════════════
// FOOTER / SIGNATURE BLOCK
// ══════════════════════════════════════════════════════════════════════════════
$pdf->Ln(8);
$pdf->SetFont('helvetica', '', 9);
$pdf->SetDrawColor(0);
$pdf->SetLineWidth(0.3);

// Dashed border box using setLineStyle (SetLineDash not available in TCPDF 6.x)
$pdf->setLineStyle(array('dash' => '2,1', 'color' => array(0, 0, 0)));
$pageW = $pdf->getPageWidth() - 16;  // 8mm margins each side
$boxY  = $pdf->GetY();
$pdf->Rect(8, $boxY, $pageW, 22, 'D');
$pdf->setLineStyle(array('dash' => 0));  // reset to solid

$pdf->SetXY(12, $boxY + 4);
$pdf->Cell($pageW / 2 - 4, 5, 'Principal Name: ' . $InstPrincipal, 0, 0, 'L');
$pdf->Cell($pageW / 2 - 4, 5, 'Signature: ______________________', 0, 1, 'R');
$pdf->SetXY(12, $boxY + 12);
$pdf->Cell($pageW / 2 - 4, 5, 'Designation: _____________________', 0, 0, 'L');
$pdf->Cell($pageW / 2 - 4, 5, 'Date: ___________________________', 0, 1, 'R');

// ── Output ────────────────────────────────────────────────────────────────────
ob_end_clean();
$pdf->Output('revenue_list_batch' . $BatchId . '.pdf', 'I');
?>