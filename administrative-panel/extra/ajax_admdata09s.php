<?php include('includes/config.php');

	$SubjectGroups = array();
	$sql = "SELECT Id, Name, GroupType FROM subjectgroups ORDER BY Id ASC";
	$res = mysql_query($sql, $conn1);
	while($row = mysql_fetch_assoc($res))
	{
		array_push($SubjectGroups, array("Id"=>$row['Id'], "Name"=>$row['Name'], "GroupType"=>$row['GroupType']));
	}
	
	$SubjectCombinations = array();
	$sql = "SELECT Id, Name, CombType, SubjectGroupId, Subject1Id, Subject2Id, Subject3Id, Subject4Id, Subject5Id, Subject6Id, Subject7Id, Subject8Id, Subject9Id, Sub1Name, Sub2Name, Sub3Name, Sub4Name, Sub5Name, Sub6Name, Sub7Name, Sub8Name, Sub9Name, Sub1Code, Sub2Code, Sub3Code, Sub4Code, Sub5Code, Sub6Code, Sub7Code, Sub8Code, Sub9Code FROM vwsubcombinations09 ORDER BY Id ASC";
	$res = mysql_query($sql, $conn1);
	while($row = mysql_fetch_assoc($res))
	{
		array_push($SubjectCombinations, array("Id"=>$row['Id'], "Name"=>$row['Name'], "CombType"=>$row['CombType'], "SubjectGroupId"=>$row['SubjectGroupId'], "Sub1_Id"=>$row['Subject1Id'], "Sub2_Id"=>$row['Subject2Id'], "Sub3_Id"=>$row['Subject3Id'], "Sub4_Id"=>$row['Subject4Id'], "Sub5_Id"=>$row['Subject5Id'], "Sub6_Id"=>$row['Subject6Id'], "Sub7_Id"=>$row['Subject7Id'], "Sub8_Id"=>$row['Subject8Id'], "Sub9_Id"=>$row['Subject9Id'], "Sub1Name"=>$row['Sub1Name'], "Sub2Name"=>$row['Sub2Name'], "Sub3Name"=>$row['Sub3Name'], "Sub4Name"=>$row['Sub4Name'], "Sub5Name"=>$row['Sub5Name'], "Sub6Name"=>$row['Sub6Name'], "Sub7Name"=>$row['Sub7Name'], "Sub8Name"=>$row['Sub8Name'], "Sub9Name"=>$row['Sub9Name'], "Sub1Code"=>$row['Sub1Code'], "Sub2Code"=>$row['Sub2Code'], "Sub3Code"=>$row['Sub3Code'], "Sub4Code"=>$row['Sub4Code'], "Sub5Code"=>$row['Sub5Code'], "Sub6Code"=>$row['Sub6Code'], "Sub7Code"=>$row['Sub7Code'], "Sub8Code"=>$row['Sub8Code'], "Sub9Code"=>$row['Sub9Code']));
	}
	
	$Subjects = array();
	$sql = "SELECT Id, Name, Code, Class, IsPractical, IsCompulsory FROM subjects WHERE IsGeneral=1 ORDER BY Code ASC";
	$res = mysql_query($sql, $conn1);
	while($row = mysql_fetch_assoc($res))
	{
		array_push($Subjects, array("Id"=>$row['Id'], "Name"=>$row['Name'], "Code"=>$row['Code'], "Class"=>$row['Class'], "IsPractical"=>$row['IsPractical'], "IsCompulsory"=>$row['IsCompulsory']));
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
	
	$Students09 = array();
	$sql="SELECT Id, PicURL, Domicile, OtherDomicile, PostalDistrict, PostalTehsil, PrvExamDistrict, GroupId, CombinationId, Sub1Code, Sub2Code, Sub3Code, Sub4Code, Sub5Code, Sub6Code, Sub7Code, Sub8Code, Sub9Code FROM vwadmstudents09s WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_assoc($res);
	
	$Students09=array("Id"=>$row['Id'], "PicURL"=>$row['PicURL'], "Domicile"=>$row['Domicile'], "OtherDomicile"=>$row['OtherDomicile'], "PostalDistrict"=>$row['PostalDistrict'], "PostalTehsil"=>$row['PostalTehsil'], "PrvExamDistrict"=>$row['PrvExamDistrict'], "GroupId"=>$row['GroupId'], "CombinationId"=>$row['CombinationId'], "Sub1Code"=>$row['Sub1Code'], "Sub2Code"=>$row['Sub2Code'], "Sub3Code"=>$row['Sub3Code'], "Sub4Code"=>$row['Sub4Code'], "Sub5Code"=>$row['Sub5Code'], "Sub6Code"=>$row['Sub6Code'], "Sub7Code"=>$row['Sub7Code'], "Sub8Code"=>$row['Sub8Code'], "Sub9Code"=>$row['Sub9Code']);
	
	$StudentsCentres09 = array();
	$sql="SELECT Id, ACentreId, ACentreName, ACentreCode FROM vwadmstudents09s WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_assoc($res);
	
	$StudentsCentres09=array("Id"=>$row['Id'], "ACentreId"=>$row['ACentreId'], "ACentreName"=>$row['ACentreName'], "ACentreCode"=>$row['ACentreCode']);
	
	$result = array('SubjectGroups' => $SubjectGroups, 'SubjectCombinations' => $SubjectCombinations, 'Subjects' => $Subjects, 'Districts' => $Districts, 'Tehsils' => $Tehsils, 'ExamCentres' => $ExamCentres, 'Students09' => $Students09, 'StudentsCentres09' => $StudentsCentres09);
	echo json_encode($result);
?>