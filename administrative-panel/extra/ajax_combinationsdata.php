<?php include('includes/config.php');
//if($_GET){ echo json_encode($echo_data); }

	$SubjectGroups = array();
	$sql = "SELECT Id, Name FROM subjectgroups ORDER BY Id";
	$res = mysql_query($sql, $conn1);
	while($row = mysql_fetch_array($res))
	{
		array_push($SubjectGroups, array("Id"=>$row['Id'], "Name"=>$row['Name']));
		//$echo_data.=json_encode($row['Name'].$row['Id']);
	}
	//echo json_encode($SubjectGroups);
	
	$Subjects = array();
	$sql = "SELECT Id, Name, Code, Class, IsCompulsory FROM subjects ORDER BY Id";
	$res = mysql_query($sql, $conn1);
	while($row = mysql_fetch_array($res))
	{
		array_push($Subjects, array("Id"=>$row['Id'], "Name"=>$row['Name'], "Code"=>$row['Code'], "Class"=>$row['Class'], "IsCompulsory"=>$row['IsCompulsory']));
		//$echo_data.=json_encode($row['Name'].$row['Id']);
	}
	//echo json_encode($SubjectGroups);
	
	$Combinations = array();
	$sql="SELECT * FROM subjectcombinations WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	
	$Combinations=array("Id"=>$row['Id'], "Name"=>$row['Name'], "SubjectGroupId"=>$row['SubjectGroupId'], "RegFee"=>$row['RegFee'], "PrvFee"=>$row['PrvFee'], "Subject1Id"=>$row['Subject1Id'], "Subject2Id"=>$row['Subject2Id'], "Subject3Id"=>$row['Subject3Id'], "Subject4Id"=>$row['Subject4Id'], "Subject5Id"=>$row['Subject5Id'], "Subject6Id"=>$row['Subject6Id'], "Subject7Id"=>$row['Subject7Id'], "Subject8Id"=>$row['Subject8Id'], "Subject9Id"=>$row['Subject9Id'], "Subject21Id"=>$row['Subject21Id'], "Subject22Id"=>$row['Subject22Id'], "Subject23Id"=>$row['Subject23Id'], "Subject24Id"=>$row['Subject24Id'], "Subject25Id"=>$row['Subject25Id'], "Subject26Id"=>$row['Subject26Id'], "Subject27Id"=>$row['Subject27Id'], "Subject28Id"=>$row['Subject28Id'], "Subject29Id"=>$row['Subject29Id'], "CombType"=>$row['CombType'], "IsActive"=>$row['IsActive']);
	
	$result = array('SubjectGroups' => $SubjectGroups, 'Subjects' => $Subjects, 'Combinations' => $Combinations);
	echo json_encode($result);
?>