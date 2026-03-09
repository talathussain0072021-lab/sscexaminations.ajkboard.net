<?php include('includes/config.php');
//if($_GET){ echo json_encode($echo_data); }

	$Subjects = array();
	$sql = "SELECT Id, Name, SmallName, Code, Class, IsPractical, IsDoubleShift FROM subjects WHERE IsGeneral=1 ORDER BY Code";
	$res = mysql_query($sql, $conn1);
	while($row = mysql_fetch_array($res))
	{
		array_push($Subjects, array("Id"=>$row['Id'], "Name"=>$row['Name'], "SmallName"=>$row['SmallName'], "Code"=>$row['Code'], "Class"=>$row['Class'], "IsPractical"=>$row['IsPractical'], "IsDoubleShift"=>$row['IsDoubleShift']));
	}
	
	$result = array('Subjects' => $Subjects);
	echo json_encode($result);
?>