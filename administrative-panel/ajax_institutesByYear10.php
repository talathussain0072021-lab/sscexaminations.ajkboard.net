<?php
include('includes/config.php');

$ExamId  = 10;
$ExamYear = isset($_REQUEST['ExamYear']) ? mysqli_real_escape_string($conn1, $_REQUEST['ExamYear']) : '';

$options = '<option value="All">All Institutes</option>';

$where = "InstituteCode IS NOT NULL AND InstituteCode != '' AND ExamId=" . intval($ExamId);

if($ExamYear != '' && $ExamYear != 'All') {
    $where .= " AND ExamYear='" . $ExamYear . "'";
}

$sql = "SELECT DISTINCT InstituteId, InstituteCode, InstituteName FROM tbladm_10 WHERE " . $where . " ORDER BY InstituteCode ASC";

$res = mysqli_query($conn1, $sql);
if($res && mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
        $options .= '<option value="' . intval($row['InstituteId']) . '">' . htmlspecialchars($row['InstituteCode']) . ' - ' . htmlspecialchars($row['InstituteName']) . '</option>';
    }
}

echo $options;
