<?php include('includes/config.php');

$RegBatches = array();
$sql = "SELECT Id, BatchNo, BatchStatus, RegStatus, RevStatus, SessionId, StdCount, BatchFee, ChallanNo FROM vwregbatches ORDER BY Id ASC";
$res = mysql_query($sql, $conn1);
while($row = mysql_fetch_array($res))
{
	array_push($RegBatches, array("Id"=>$row['Id'], "BatchNo"=>$row['BatchNo'], "BatchStatus"=>$row['BatchStatus'], "RegStatus"=>$row['RegStatus'], "RevStatus"=>$row['RevStatus'], "SessionId"=>$row['SessionId'], "StdCount"=>$row['StdCount'], "BatchFee"=>$row['BatchFee'], "ChallanNo"=>$row['ChallanNo']));
}

$AdmBatches09 = array();
$sql = "SELECT Id, BatchNo, BatchStatus, AdmStatus, RevStatus, ExamId, StdCount, BatchFee, ChallanNo FROM vwadmbatches09 ORDER BY Id ASC";
$res = mysql_query($sql, $conn1);
while($row = mysql_fetch_array($res))
{
	array_push($AdmBatches09, array("Id"=>$row['Id'], "BatchNo"=>$row['BatchNo'], "BatchStatus"=>$row['BatchStatus'], "AdmStatus"=>$row['AdmStatus'], "RevStatus"=>$row['RevStatus'], "ExamId"=>$row['ExamId'], "StdCount"=>$row['StdCount'], "BatchFee"=>$row['BatchFee'], "ChallanNo"=>$row['ChallanNo']));
}

$AdmBatches10 = array();
$sql = "SELECT Id, BatchNo, BatchStatus, AdmStatus, RevStatus, ExamId, StdCount, BatchFee, ChallanNo FROM vwadmbatches10 ORDER BY Id ASC";
$res = mysql_query($sql, $conn1);
while($row = mysql_fetch_array($res))
{
	array_push($AdmBatches10, array("Id"=>$row['Id'], "BatchNo"=>$row['BatchNo'], "BatchStatus"=>$row['BatchStatus'], "AdmStatus"=>$row['AdmStatus'], "RevStatus"=>$row['RevStatus'], "ExamId"=>$row['ExamId'], "StdCount"=>$row['StdCount'], "BatchFee"=>$row['BatchFee'], "ChallanNo"=>$row['ChallanNo']));
}

$result = array('RegBatches' => $RegBatches, 'AdmBatches09' => $AdmBatches09, 'AdmBatches10' => $AdmBatches10);
echo json_encode($result);

?>