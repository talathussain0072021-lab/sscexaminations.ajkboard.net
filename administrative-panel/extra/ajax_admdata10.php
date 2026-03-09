<?php include('includes/config.php');

	$SubjectGroups = array();
	$sql = "SELECT Id, Name, GroupType FROM subjectgroups ORDER BY Id ASC";
	$res = mysql_query($sql, $conn1);
	while($row = mysql_fetch_assoc($res))
	{
		array_push($SubjectGroups, array("Id"=>$row['Id'], "Name"=>$row['Name'], "GroupType"=>$row['GroupType']));
	}
	
	$SubjectCombinations = array();
	$sql = "SELECT Id, Name, CombType, SubjectGroupId, Subject1Id, Subject2Id, Subject3Id, Subject4Id, Subject5Id, Subject6Id, Subject7Id, Subject8Id, Subject9Id, Subject21Id	, Subject22Id, Subject23Id, Subject24Id, Subject25Id, Subject26Id, Subject27Id, Subject28Id, Subject29Id, Sub1Name, Sub2Name, Sub3Name, Sub4Name, Sub5Name, Sub6Name, Sub7Name, Sub8Name, Sub9Name, Sub21Name, Sub22Name, Sub23Name, Sub24Name, Sub25Name, Sub26Name, Sub27Name, Sub28Name, Sub29Name, Sub1Code, Sub2Code, Sub3Code, Sub4Code, Sub5Code, Sub6Code, Sub7Code, Sub8Code, Sub9Code, Sub21Code, Sub22Code, Sub23Code, Sub24Code, Sub25Code, Sub26Code, Sub27Code, Sub28Code, Sub29Code, Sub26IsPrac, Sub27IsPrac, Sub28IsPrac FROM vwsubcombinations10 ORDER BY Id ASC";
	$res = mysql_query($sql, $conn1);
	while($row = mysql_fetch_assoc($res))
	{
		array_push($SubjectCombinations, array("Id"=>$row['Id'], "Name"=>$row['Name'], "CombType"=>$row['CombType'], "SubjectGroupId"=>$row['SubjectGroupId'], "Sub1_Id"=>$row['Subject1Id'], "Sub2_Id"=>$row['Subject2Id'], "Sub3_Id"=>$row['Subject3Id'], "Sub4_Id"=>$row['Subject4Id'], "Sub5_Id"=>$row['Subject5Id'], "Sub6_Id"=>$row['Subject6Id'], "Sub7_Id"=>$row['Subject7Id'], "Sub8_Id"=>$row['Subject8Id'], "Sub9_Id"=>$row['Subject9Id'], "Sub21_Id"=>$row['Subject21Id'], "Sub22_Id"=>$row['Subject22Id'], "Sub23_Id"=>$row['Subject23Id'], "Sub24_Id"=>$row['Subject24Id'], "Sub25_Id"=>$row['Subject25Id'], "Sub26_Id"=>$row['Subject26Id'], "Sub27_Id"=>$row['Subject27Id'], "Sub28_Id"=>$row['Subject28Id'], "Sub29_Id"=>$row['Subject29Id'], "Sub1Name"=>$row['Sub1Name'], "Sub2Name"=>$row['Sub2Name'], "Sub3Name"=>$row['Sub3Name'], "Sub4Name"=>$row['Sub4Name'], "Sub5Name"=>$row['Sub5Name'], "Sub6Name"=>$row['Sub6Name'], "Sub7Name"=>$row['Sub7Name'], "Sub8Name"=>$row['Sub8Name'], "Sub9Name"=>$row['Sub9Name'], "Sub21Name"=>$row['Sub21Name'], "Sub22Name"=>$row['Sub22Name'], "Sub23Name"=>$row['Sub23Name'], "Sub24Name"=>$row['Sub24Name'], "Sub25Name"=>$row['Sub25Name'], "Sub26Name"=>$row['Sub26Name'], "Sub27Name"=> $row['Sub27Name'], "Sub28Name"=> $row['Sub28Name'], "Sub29Name"=> $row['Sub29Name'], "Sub1Code"=>$row['Sub1Code'], "Sub2Code"=>$row['Sub2Code'], "Sub3Code"=>$row['Sub3Code'], "Sub4Code"=>$row['Sub4Code'], "Sub5Code"=>$row['Sub5Code'], "Sub6Code"=>$row['Sub6Code'], "Sub7Code"=>$row['Sub7Code'], "Sub8Code"=>$row['Sub8Code'], "Sub9Code"=>$row['Sub9Code'], "Sub21Code"=>$row['Sub21Code'], "Sub22Code"=>$row['Sub22Code'], "Sub23Code"=>$row['Sub23Code'], "Sub24Code"=>$row['Sub24Code'], "Sub25Code"=>$row['Sub25Code'], "Sub26Code"=>$row['Sub26Code'], "Sub27Code"=>$row['Sub27Code'], "Sub28Code"=>$row['Sub28Code'], "Sub29Code"=>$row['Sub29Code'], "Sub26IsPrac"=>$row['Sub26IsPrac'], "Sub27IsPrac"=>$row['Sub27IsPrac'], "Sub28IsPrac"=>$row['Sub28IsPrac']));
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
	
	$Students10 = array();
	$sql="SELECT Id, PicURL, Domicile, OtherDomicile, PostalDistrict, PostalTehsil, PrvExamDistrict, GroupId, CombinationId, Sub1Code, Sub2Code, Sub3Code, Sub4Code, Sub5Code, Sub6Code, Sub7Code, Sub8Code, Sub9Code, Sub21Code, Sub22Code, Sub23Code, Sub24Code, Sub25Code, Sub26Code, Sub27Code, Sub28Code, Sub29Code, Sub26PCode, Sub27PCode, Sub28PCode FROM vwadmstudents10 WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_assoc($res);
	
	$Students10=array("Id"=>$row['Id'], "PicURL"=>$row['PicURL'], "Domicile"=>$row['Domicile'], "OtherDomicile"=>$row['OtherDomicile'], "PostalDistrict"=>$row['PostalDistrict'], "PostalTehsil"=>$row['PostalTehsil'], "PrvExamDistrict"=>$row['PrvExamDistrict'], "GroupId"=>$row['GroupId'], "CombinationId"=>$row['CombinationId'], "Sub1Code"=>$row['Sub1Code'], "Sub2Code"=>$row['Sub2Code'], "Sub3Code"=>$row['Sub3Code'], "Sub4Code"=>$row['Sub4Code'], "Sub5Code"=>$row['Sub5Code'], "Sub6Code"=>$row['Sub6Code'], "Sub7Code"=>$row['Sub7Code'], "Sub8Code"=>$row['Sub8Code'], "Sub9Code"=>$row['Sub9Code'], "Sub21Code"=>$row['Sub21Code'], "Sub22Code"=>$row['Sub22Code'], "Sub23Code"=>$row['Sub23Code'], "Sub24Code"=>$row['Sub24Code'], "Sub25Code"=>$row['Sub25Code'], "Sub26Code"=>$row['Sub26Code'], "Sub27Code"=>$row['Sub27Code'], "Sub28Code"=>$row['Sub28Code'], "Sub29Code"=>$row['Sub29Code'], "Sub26PCode"=>$row['Sub26PCode'], "Sub27PCode"=>$row['Sub27PCode'], "Sub28PCode"=>$row['Sub28PCode']);
	
	$P1Students = array();
	$sql="SELECT Id, GroupId, CombinationId, Sub1Code, Sub2Code, Sub3Code, Sub4Code, Sub5Code, Sub6Code, Sub7Code, Sub8Code, Sub9Code, Sub21Code, Sub22Code, Sub23Code, Sub24Code, Sub25Code, Sub26Code, Sub27Code, Sub28Code, Sub29Code, S1_PASS, S2_PASS, S3_PASS, S4_PASS, S5_PASS, S6_PASS, S7_PASS, S8_PASS, S9_PASS FROM vwstudentspi WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn_sscreslt);
	$row=mysql_fetch_assoc($res);
	
	$P1Students=array("Id"=>$row['Id'], "GroupId"=>$row['GroupId'], "CombinationId"=>$row['CombinationId'], "Sub1Code"=>$row['Sub1Code'], "Sub2Code"=>$row['Sub2Code'], "Sub3Code"=>$row['Sub3Code'], "Sub4Code"=>$row['Sub4Code'], "Sub5Code"=>$row['Sub5Code'], "Sub6Code"=>$row['Sub6Code'], "Sub7Code"=>$row['Sub7Code'], "Sub8Code"=>$row['Sub8Code'], "Sub9Code"=>$row['Sub9Code'], "Sub21Code"=>$row['Sub21Code'], "Sub22Code"=>$row['Sub22Code'], "Sub23Code"=>$row['Sub23Code'], "Sub24Code"=>$row['Sub24Code'], "Sub25Code"=>$row['Sub25Code'], "Sub26Code"=>$row['Sub26Code'], "Sub27Code"=>$row['Sub27Code'], "Sub28Code"=>$row['Sub28Code'], "Sub29Code"=>$row['Sub29Code'], "Sub1Pass"=>$row['S1_PASS'], "Sub2Pass"=>$row['S2_PASS'], "Sub3Pass"=>$row['S3_PASS'], "Sub4Pass"=>$row['S4_PASS'], "Sub5Pass"=>$row['S5_PASS'], "Sub6Pass"=>$row['S6_PASS'], "Sub7Pass"=>$row['S7_PASS'], "Sub8Pass"=>$row['S8_PASS'], "Sub9Pass"=>$row['S9_PASS']);
	
	$PStudents = array();
	$sql="SELECT GROUPID, COMBINATIONID, SUB1_CODE, SUB1_PASS, SUB21_CODE, SUB21_PASS, S1_PASS, SUB2_CODE, SUB2_PASS, SUB22_CODE, SUB22_PASS, S2_PASS, SUB3_CODE, SUB3_PASS, SUB31_CODE, SUB31_PASS, S3_PASS, SUB231_CODE, SUB231_PASS, SUB23_CODE, SUB23_PASS, S3P_PASS, SUB4_CODE, SUB4_PASS, SUB24_CODE, SUB24_PASS, S4_PASS, SUB5_CODE, SUB5_PASS, SUB25_CODE, SUB25_PASS, SUB251_CODE, SUB251_PASS, S5_PASS, SUB6_CODE, SUB6_PASS, SUB26_CODE, SUB26_PASS, SUB261_CODE, SUB261_PASS, S6_PASS, SUB7_CODE, SUB7_PASS, SUB27_CODE, SUB27_PASS, SUB271_CODE, SUB271_PASS, S7_PASS, SUB8_CODE, SUB8_PASS, SUB28_CODE, SUB28_PASS, S8_PASS FROM vw_resultpii WHERE ID=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn_sscreslt);
	$row=mysql_fetch_assoc($res);
	
	$PStudents=array("GroupId"=>$row['GROUPID'], "CombinationId"=>$row['COMBINATIONID'], "SUB1_CODE"=>$row['SUB1_CODE'], "SUB1_PASS"=>$row['SUB1_PASS'], "SUB21_CODE"=>$row['SUB21_CODE'], "SUB21_PASS"=>$row['SUB21_PASS'], "S1_PASS"=>$row['S1_PASS'], "SUB2_CODE"=>$row['SUB2_CODE'], "SUB2_PASS"=>$row['SUB2_PASS'], "SUB22_CODE"=>$row['SUB22_CODE'], "SUB22_PASS"=>$row['SUB22_PASS'], "S2_PASS"=>$row['S2_PASS'], "SUB3_CODE"=>$row['SUB3_CODE'], "SUB3_PASS"=>$row['SUB3_PASS'], "SUB31_CODE"=>$row['SUB31_CODE'], "SUB31_PASS"=>$row['SUB31_PASS'], "S3_PASS"=>$row['S3_PASS'], "SUB231_CODE"=>$row['SUB231_CODE'], "SUB231_PASS"=>$row['SUB231_PASS'], "SUB23_CODE"=>$row['SUB23_CODE'], "SUB23_PASS"=>$row['SUB23_PASS'], "S3P_PASS"=>$row['S3P_PASS'], "SUB4_CODE"=>$row['SUB4_CODE'], "SUB4_PASS"=>$row['SUB4_PASS'], "SUB24_CODE"=>$row['SUB24_CODE'], "SUB24_PASS"=>$row['SUB24_PASS'], "S4_PASS"=>$row['S4_PASS'], "SUB5_CODE"=>$row['SUB5_CODE'], "SUB5_PASS"=>$row['SUB5_PASS'], "SUB25_CODE"=>$row['SUB25_CODE'], "SUB25_PASS"=>$row['SUB25_PASS'], "SUB251_CODE"=>$row['SUB251_CODE'], "SUB251_PASS"=>$row['SUB251_PASS'], "S5_PASS"=>$row['S5_PASS'], "SUB6_CODE"=>$row['SUB6_CODE'], "SUB6_PASS"=>$row['SUB6_PASS'], "SUB26_CODE"=>$row['SUB26_CODE'], "SUB26_PASS"=>$row['SUB26_PASS'], "SUB261_CODE"=>$row['SUB261_CODE'], "SUB261_PASS"=>$row['SUB261_PASS'], "S6_PASS"=>$row['S6_PASS'], "SUB7_CODE"=>$row['SUB7_CODE'], "SUB7_PASS"=>$row['SUB7_PASS'], "SUB27_CODE"=>$row['SUB27_CODE'], "SUB27_PASS"=>$row['SUB27_PASS'], "SUB271_CODE"=>$row['SUB271_CODE'], "SUB271_PASS"=>$row['SUB271_PASS'], "S7_PASS"=>$row['S7_PASS'], "SUB8_CODE"=>$row['SUB8_CODE'], "SUB8_PASS"=>$row['SUB8_PASS'], "SUB28_CODE"=>$row['SUB28_CODE'], "SUB28_PASS"=>$row['SUB28_PASS'], "S8_PASS"=>$row['S8_PASS']);
	
	$StudentsCentres10 = array();
	$sql="SELECT Id, ACentreId, ACentreName, ACentreCode FROM vwadmstudents10 WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_assoc($res);
	
	$StudentsCentres10=array("Id"=>$row['Id'], "ACentreId"=>$row['ACentreId'], "ACentreName"=>$row['ACentreName'], "ACentreCode"=>$row['ACentreCode']);
	
	$result = array('SubjectGroups' => $SubjectGroups, 'SubjectCombinations' => $SubjectCombinations, 'Subjects' => $Subjects, 'Districts' => $Districts, 'Tehsils' => $Tehsils, 'ExamCentres' => $ExamCentres, 'Students10' => $Students10, 'P1Students' => $P1Students, 'PStudents' => $PStudents, 'StudentsCentres10' => $StudentsCentres10);
	echo json_encode($result);
?>