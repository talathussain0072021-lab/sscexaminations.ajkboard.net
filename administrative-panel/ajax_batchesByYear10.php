<?php
include('includes/config.php');

$ExamId = 10;
$ExamYear    = isset($_REQUEST['ExamYear'])    ? mysqli_real_escape_string($conn1, $_REQUEST['ExamYear'])    : '';
$InstituteId = isset($_REQUEST['InstituteId']) ? intval($_REQUEST['InstituteId'])                            : 0;

$options = '<option value="All">All Batches</option>';

$where = "BatchId IS NOT NULL AND ExamId=" . intval($ExamId);

if($ExamYear != '' && $ExamYear != 'All') {
    $where .= " AND ExamYear='" . $ExamYear . "'";
}

if($InstituteId > 0) {
    $where .= " AND InstituteId=" . $InstituteId;
}

$sql = "SELECT DISTINCT BatchId, BatchNo FROM tbladm_10 WHERE " . $where . " ORDER BY BatchNo ASC";

$res = mysqli_query($conn1, $sql);
if($res && mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
        $options .= '<option value="'.$row['BatchId'].'">'.$row['BatchNo'].'</option>';
    }
}

echo $options;
