<?php
// TEMPORARY DEBUG FILE - DELETE AFTER USE
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');

$BatchId  = isset($_REQUEST['BatchId']) ? intval($_REQUEST['BatchId'])  : 0;
$InstId   = isset($_REQUEST['INST'])    ? intval($_REQUEST['INST'])      : 0;
$ExamYear = isset($_REQUEST['EID'])     ? mysqli_real_escape_string($conn1, $_REQUEST['EID']) : '';

echo "<h3>Params: BatchId=$BatchId | InstId=$InstId | ExamYear=$ExamYear</h3>";

// 1. Show tbladm_10 columns
echo "<h4>tbladm_10 columns:</h4><pre>";
$res_desc = mysqli_query($conn1, "DESCRIBE tbladm_10");
if($res_desc){ while($r=mysqli_fetch_assoc($res_desc)) echo $r['Field'].' | '.$r['Type']."\n"; }
else echo "ERROR: ".mysqli_error($conn1);
echo "</pre>";

// 2. Test meta query
$sql_meta = "SELECT BatchNo, ChallanNo, InstituteCode, InstituteName FROM tbladm_10 WHERE BatchId=$BatchId";
if($InstId > 0)     $sql_meta .= " AND InstituteId=$InstId";
if($ExamYear != '') $sql_meta .= " AND ExamYear='$ExamYear'";
$sql_meta .= " LIMIT 1";
echo "<h4>Meta SQL:</h4><pre>$sql_meta</pre>";
$res_meta = mysqli_query($conn1, $sql_meta);
if(!$res_meta){ echo "META ERROR: ".mysqli_error($conn1); }
elseif(mysqli_num_rows($res_meta)==0){ echo "<b style='color:red'>META: 0 rows returned</b>"; }
else { echo "<b style='color:green'>META OK:</b><pre>"; print_r(mysqli_fetch_assoc($res_meta)); echo "</pre>"; }

// 3. Test student rows query
$sql = "SELECT RegNo, P1RegNo, Name, FatherName, Gender, IsSpecial, GroupName, CombinationName, AdmissionFee, BatchSr FROM tbladm_10 WHERE BatchId=$BatchId";
if($InstId > 0)     $sql .= " AND InstituteId=$InstId";
if($ExamYear != '') $sql .= " AND ExamYear='$ExamYear'";
$sql .= " ORDER BY BatchSr ASC LIMIT 5";
echo "<h4>Student SQL:</h4><pre>$sql</pre>";
$res = mysqli_query($conn1, $sql);
if(!$res){ echo "STUDENT ERROR: ".mysqli_error($conn1); }
elseif(mysqli_num_rows($res)==0){ echo "<b style='color:red'>STUDENTS: 0 rows returned</b>"; }
else {
    echo "<b style='color:green'>STUDENTS found: ".mysqli_num_rows($res)."</b><br/>";
    echo "<table border='1' cellpadding='4' style='font-family:monospace;font-size:12px;'><tr>";
    $first = mysqli_fetch_assoc($res);
    foreach(array_keys($first) as $k) echo "<th>$k</th>";
    echo "</tr><tr>";
    foreach($first as $v) echo "<td>".htmlspecialchars($v)."</td>";
    echo "</tr></table>";
}

// 4. Show sample row from tbladm_10 regardless of filters
echo "<h4>Sample row from tbladm_10 (no filter):</h4><pre>";
$r2 = mysqli_query($conn1, "SELECT * FROM tbladm_10 ORDER BY Id DESC LIMIT 1");
if($r2 && mysqli_num_rows($r2)>0){ print_r(mysqli_fetch_assoc($r2)); }
echo "</pre>";
?>
