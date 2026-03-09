<?php include('includes/config.php');

	$SubjectGroups = array();
	$sql = "SELECT Id, Name, GroupType FROM subjectgroups ORDER BY Id ASC";
	$res = mysql_query($sql, $conn1);
	while($row = mysql_fetch_assoc($res))
	{
		array_push($SubjectGroups, array("Id"=>$row['Id'], "Name"=>$row['Name'], "GroupType"=>$row['GroupType']));
	}
	
	$SubjectCombinations = array();
	$sql = "SELECT Id, Name, CombType, SubjectGroupId, Subject3Id, Sub3Name, Subject4Id, Sub4Name, Subject5Id, Sub5Name, Subject6Id, Sub6Name, Subject7Id, Sub7Name, Subject8Id, Sub8Name FROM vwsubcombinations09 ORDER BY Id ASC";
	$res = mysql_query($sql, $conn1);
	while($row = mysql_fetch_assoc($res))
	{
		array_push($SubjectCombinations, array("Id"=>$row['Id'], "Name"=>$row['Name'], "CombType"=>$row['CombType'], "SubjectGroupId"=>$row['SubjectGroupId'], "Subject3Id"=>$row['Subject3Id'], "Sub3Name"=>$row['Sub3Name'], "Subject4Id"=>$row['Subject4Id'], "Sub4Name"=>$row['Sub4Name'], "Subject5Id"=>$row['Subject5Id'], "Sub5Name"=>$row['Sub5Name'], "Subject6Id"=>$row['Subject6Id'], "Sub6Name"=>$row['Sub6Name'], "Subject7Id"=>$row['Subject7Id'], "Sub7Name"=>$row['Sub7Name'], "Subject8Id"=>$row['Subject8Id'], "Sub8Name"=>$row['Sub8Name']));
	}
	
	$Districts = array();
	$sql = "SELECT Id, Name FROM districts ORDER BY Name ASC";
	$res = mysql_query($sql, $conn1);
	while($row = mysql_fetch_assoc($res))
	{
		array_push($Districts, array("Id"=>$row['Id'], "Name"=>$row['Name']));
	}
	
	$Tehsils = array();
	$sql = "SELECT Id, Name, DistrictId FROM tehsils ORDER BY Name ASC";
	$res = mysql_query($sql, $conn1);
	while($row = mysql_fetch_assoc($res))
	{
		array_push($Tehsils, array("Id"=>$row['Id'], "Name"=>$row['Name'], "DistrictId"=>$row['DistrictId']));
	}
	
	$ExamCentres = array();
	$sql = "SELECT Id, Name, Code, Type, District FROM centres WHERE IsActive=1 ORDER BY Code ASC";
	$res = mysql_query($sql, $conn1);
	while($row = mysql_fetch_assoc($res))
	{
		array_push($ExamCentres, array("Id"=>$row['Id'], "Name"=>$row['Name'], "Code"=>$row['Code'], "Type"=>$row['Type'], "District"=>$row['District']));
	}
	
	$Students = array();
	$sql="SELECT Id, PicURL, Domicile, OtherDomicile, PrvExamDistrict, GroupId, CombinationId, SubjectChange, Subject3Id, Subject4Id, Subject5Id, Subject6Id, Subject7Id, Subject8Id FROM vwregstudents WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_assoc($res);
	
	$Students=array("Id"=>$row['Id'], "PicURL"=>$row['PicURL'], "Domicile"=>$row['Domicile'], "OtherDomicile"=>$row['OtherDomicile'], "PrvExamDistrict"=>$row['PrvExamDistrict'], "GroupId"=>$row['GroupId'], "CombinationId"=>$row['CombinationId'], "SubjectChange"=>$row['SubjectChange'], "Subject3Id"=>$row['Subject3Id'], "Subject4Id"=>$row['Subject4Id'], "Subject5Id"=>$row['Subject5Id'], "Subject6Id"=>$row['Subject6Id'], "Subject7Id"=>$row['Subject7Id'], "Subject8Id"=>$row['Subject8Id']);
	
	$StudentsCentres = array();
	$sql="SELECT Id, ACentreId, ACentreName, ACentreCode FROM vwadmstudents09 WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_assoc($res);
	
	$StudentsCentres=array("Id"=>$row['Id'], "ACentreId"=>$row['ACentreId'], "ACentreName"=>$row['ACentreName'], "ACentreCode"=>$row['ACentreCode']);
	
	$result = array('SubjectGroups' => $SubjectGroups, 'SubjectCombinations' => $SubjectCombinations, 'Districts' => $Districts, 'Tehsils' => $Tehsils, 'ExamCentres' => $ExamCentres, 'Students' => $Students, 'StudentsCentres' => $StudentsCentres);
	echo json_encode($result);
?>