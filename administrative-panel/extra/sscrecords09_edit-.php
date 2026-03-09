<?php 
	// AJAX handler for dynamic group and combination detection - MUST BE FIRST
	if(isset($_REQUEST['ajax_get_combinations'])) {
		include('includes/config.php');
		include('includes/connection1.php');
		include('includes/connection_sscreslt.php');
		
		$s1_code = isset($_REQUEST['s1_code']) ? mysql_real_escape_string(trim($_REQUEST['s1_code'])) : '';
		$s2_code = isset($_REQUEST['s2_code']) ? mysql_real_escape_string(trim($_REQUEST['s2_code'])) : '';
		$s3_code = isset($_REQUEST['s3_code']) ? mysql_real_escape_string(trim($_REQUEST['s3_code'])) : '';
		$s4_code = isset($_REQUEST['s4_code']) ? mysql_real_escape_string(trim($_REQUEST['s4_code'])) : '';
		$s5_code = isset($_REQUEST['s5_code']) ? mysql_real_escape_string(trim($_REQUEST['s5_code'])) : '';
		$s6_code = isset($_REQUEST['s6_code']) ? mysql_real_escape_string(trim($_REQUEST['s6_code'])) : '';
		$s7_code = isset($_REQUEST['s7_code']) ? mysql_real_escape_string(trim($_REQUEST['s7_code'])) : '';
		$s8_code = isset($_REQUEST['s8_code']) ? mysql_real_escape_string(trim($_REQUEST['s8_code'])) : '';
		$s9_code = isset($_REQUEST['s9_code']) ? mysql_real_escape_string(trim($_REQUEST['s9_code'])) : '';
		
		$response = array(
			'success' => false,
			'debug' => array(
				'subjects_received' => array(
					's1' => $s1_code, 's2' => $s2_code, 's3' => $s3_code, 's4' => $s4_code,
					's5' => $s5_code, 's6' => $s6_code, 's7' => $s7_code, 's8' => $s8_code, 's9' => $s9_code
				),
				'required_subjects_check' => ($s2_code && $s3_code) ? 'PASSED' : 'FAILED'
			)
		);
		
		if($s2_code && $s3_code) {
			// Build base conditions
			$base_conditions = "Sub2Code='$s2_code' AND Sub3Code='$s3_code'";
			if($s1_code) {
				$base_conditions .= " AND Sub1Code='$s1_code'";
			}
			
			// Get possible groups based on subjects
			$groups_sql = "SELECT DISTINCT SubjectGroupId, GroupName FROM vwsubcombinations09 
						   WHERE $base_conditions AND IsActive=1 
						   ORDER BY GroupName";
			$groups_result = mysql_query($groups_sql, $conn1);
			
			$groups = array();
			while($group_row = mysql_fetch_array($groups_result)) {
				$groups[] = array(
					'SubjectGroupId' => $group_row['SubjectGroupId'],
					'GroupName' => $group_row['GroupName']
				);
			}
			
			// Get possible combinations based on all selected subjects
			$combinations_sql = "SELECT Id, Name, SubjectGroupId FROM vwsubcombinations09 
								WHERE $base_conditions";
			
			// Add elective subject conditions if any are selected
			if($s4_code || $s5_code || $s6_code || $s7_code || $s8_code || $s9_code) {
				$elective_conditions = array();
				if($s4_code) $elective_conditions[] = "(Sub4Code='$s4_code' OR Sub5Code='$s4_code' OR Sub6Code='$s4_code' OR Sub7Code='$s4_code' OR Sub8Code='$s4_code' OR Sub9Code='$s4_code')";
				if($s5_code) $elective_conditions[] = "(Sub4Code='$s5_code' OR Sub5Code='$s5_code' OR Sub6Code='$s5_code' OR Sub7Code='$s5_code' OR Sub8Code='$s5_code' OR Sub9Code='$s5_code')";
				if($s6_code) $elective_conditions[] = "(Sub4Code='$s6_code' OR Sub5Code='$s6_code' OR Sub6Code='$s6_code' OR Sub7Code='$s6_code' OR Sub8Code='$s6_code' OR Sub9Code='$s6_code')";
				if($s7_code) $elective_conditions[] = "(Sub4Code='$s7_code' OR Sub5Code='$s7_code' OR Sub6Code='$s7_code' OR Sub7Code='$s7_code' OR Sub8Code='$s7_code' OR Sub9Code='$s7_code')";
				if($s8_code) $elective_conditions[] = "(Sub4Code='$s8_code' OR Sub5Code='$s8_code' OR Sub6Code='$s8_code' OR Sub7Code='$s8_code' OR Sub8Code='$s8_code' OR Sub9Code='$s8_code')";
				if($s9_code) $elective_conditions[] = "(Sub4Code='$s9_code' OR Sub5Code='$s9_code' OR Sub6Code='$s9_code' OR Sub7Code='$s9_code' OR Sub8Code='$s9_code' OR Sub9Code='$s9_code')";
				
				$combinations_sql .= " AND " . implode(" AND ", $elective_conditions);
			}
			
			$combinations_sql .= " AND IsActive=1 ORDER BY Name";
			$combinations_result = mysql_query($combinations_sql, $conn1);
			
			$combinations = array();
			$detected_combination = '';
			$detected_group = '';
			
			while($comb_row = mysql_fetch_array($combinations_result)) {
				$combinations[] = array(
					'Id' => $comb_row['Id'],
					'Name' => $comb_row['Name'],
					'SubjectGroupId' => $comb_row['SubjectGroupId']
				);
				
				// Set the first match as detected
				if(!$detected_combination) {
					$detected_combination = $comb_row['Id'];
					$detected_group = $comb_row['SubjectGroupId'];
				}
			}
			
			$response = array(
				'success' => true,
				'groups' => $groups,
				'combinations' => $combinations,
				'detected_group' => $detected_group,
				'detected_combination' => $detected_combination,
				'message' => count($combinations) > 0 ? 
					'Found ' . count($combinations) . ' matching combination(s)' : 
					'No combinations found for selected subjects',
				'debug' => array(
					'groups_query' => $groups_sql,
					'combinations_query' => $combinations_sql,
					'groups_found' => count($groups),
					'combinations_found' => count($combinations)
				)
			);
		}
		
		header('Content-Type: application/json');
		echo json_encode($response);
		exit;
	}
?>

<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	
	// Helper function to handle field values
	function getFieldValue($fieldName, $isNumeric = false) {
		$value = isset($_REQUEST[$fieldName]) ? trim($_REQUEST[$fieldName]) : '';
		
		if ($value === '' || $value === null) {
			return $isNumeric ? '0' : 'NULL';
		}
		
		if ($isNumeric) {
			return is_numeric($value) ? $value : '0';
		} else {
			return "'" . mysql_real_escape_string($value) . "'";
		}
	}
	
	// Helper function for string fields that should be NULL when empty
	function getStringFieldValue($fieldName, $allowNull = true) {
		$value = isset($_REQUEST[$fieldName]) ? trim($_REQUEST[$fieldName]) : '';
		
		if ($value === '' || $value === null) {
			return $allowNull ? 'NULL' : "''";
		}
		
		return "'" . mysql_real_escape_string($value) . "'";
	}
	
	$sql_comb="SELECT GroupName FROM vwsubcombinations10 WHERE Id=".$_REQUEST['CombinationId']."";
	$res_comb=mysql_query($sql_comb, $conn1);
	$row_comb=mysql_fetch_array($res_comb);
	
	// Function to auto-detect combination and group based on subject selection
	function autoDetectCombination($s1_code, $s2_code, $s3_code, $s4_code, $s5_code, $s6_code, $s7_code, $s8_code, $s9_code, $conn1) {
		$base_condition = "(vc.Sub2Code='" . mysql_real_escape_string($s2_code) . "' AND vc.Sub3Code='" . mysql_real_escape_string($s3_code) . "')";
		
		if($s1_code) {
			$base_condition .= " AND vc.Sub1Code='" . mysql_real_escape_string($s1_code) . "'";
		}
		
		// Build elective conditions for S4-S9
		$elective_conditions = array();
		$subjects = array($s4_code, $s5_code, $s6_code, $s7_code, $s8_code, $s9_code);
		
		foreach($subjects as $subject) {
			if($subject && $subject != '') {
				$elective_conditions[] = "(vc.Sub4Code='" . mysql_real_escape_string($subject) . "' OR vc.Sub5Code='" . mysql_real_escape_string($subject) . "' OR vc.Sub6Code='" . mysql_real_escape_string($subject) . "' OR vc.Sub7Code='" . mysql_real_escape_string($subject) . "' OR vc.Sub8Code='" . mysql_real_escape_string($subject) . "' OR vc.Sub9Code='" . mysql_real_escape_string($subject) . "')";
			}
		}
		
		$sql = "SELECT vc.Id, vc.SubjectGroupId, vc.GroupName FROM vwsubcombinations09 vc WHERE $base_condition";
		
		if(!empty($elective_conditions)) {
			$sql .= " AND " . implode(" AND ", $elective_conditions);
		}
		
		$sql .= " AND vc.IsActive=1 LIMIT 1";
		
		$result = mysql_query($sql, $conn1);
		if($result && mysql_num_rows($result) > 0) {
			return mysql_fetch_array($result);
		}
		return false;
	}

	// Bulk update function to fix all records with wrong combinations
	if(isset($_REQUEST['bulk_update_combinations'])) {
		// First reset all combinations to 0
		$reset_sql = "UPDATE tbl_resultpi SET COMBINATIONID=0, GROUPID=0";
		mysql_query($reset_sql, $conn_sscreslt);
		
		// Then update with correct combinations based on subject selection
		$bulk_update_sql = "UPDATE tbl_resultpi hr
				JOIN vwsubcombinations09 vc ON
				(hr.S1_CODE=vc.Sub1Code AND hr.S2_CODE=vc.Sub2Code AND hr.S3_CODE=vc.Sub3Code)
				AND
				(hr.S5_CODE=vc.Sub5Code OR hr.S5_CODE=vc.Sub6Code OR hr.S5_CODE=vc.Sub7Code OR hr.S5_CODE=vc.Sub8Code)
				AND
				(hr.S6_CODE=vc.Sub5Code OR hr.S6_CODE=vc.Sub6Code OR hr.S6_CODE=vc.Sub7Code OR hr.S6_CODE=vc.Sub8Code)
				AND
				(hr.S7_CODE=vc.Sub5Code OR hr.S7_CODE=vc.Sub6Code OR hr.S7_CODE=vc.Sub7Code OR hr.S7_CODE=vc.Sub8Code)
				AND
				(hr.S8_CODE=vc.Sub5Code OR hr.S8_CODE=vc.Sub6Code OR hr.S8_CODE=vc.Sub7Code OR hr.S8_CODE=vc.Sub8Code)
				SET hr.COMBINATIONID=vc.Id, hr.GROUPNAME=vc.GroupName, hr.GROUPID=vc.SubjectGroupId
				WHERE (hr.COMBINATIONID=0 OR hr.GROUPID=0) AND vc.IsActive=1";
		
		$result = mysql_query($bulk_update_sql, $conn_sscreslt);
		
		if($result) {
			$affected_rows = mysql_affected_rows();
			echo "<script>alert('Bulk update completed successfully! Updated $affected_rows records.');window.location.reload();</script>";
		} else {
			echo "<script>alert('Error in bulk update: " . mysql_error() . "');</script>";
		}
	}



	if(isset($_REQUEST['update']))
	{
		// Handle Subject 4 fields with proper trimming and NULL handling
		$Sub4_Pass = getStringFieldValue('Sub4_Pass');
		if($Sub4_Pass == 'NULL' || trim($_REQUEST['Sub4_Pass']) == '')
		{
			$Sub4_Code = 'NULL'; $Sub4_Name = 'NULL'; $Sub4_Obt = '0'; $Sub4_Total = '0'; $Sub4_Pass = 'NULL'; $Sub4_Remarks = 'NULL';
		}
		else
		{
			$Sub4_Code = getStringFieldValue('Sub4_Code');
			$Sub4_Name = getStringFieldValue('Sub4_Name');
			$Sub4_Obt = getFieldValue('Sub4_Obt', true);
			$Sub4_Total = getFieldValue('Sub4_Total', true);
			$Sub4_Pass = getStringFieldValue('Sub4_Pass');
			$Sub4_Remarks = getStringFieldValue('Sub4_Remarks');
		}
		
		// Auto-detect combination and group based on selected subjects
		$auto_combination = autoDetectCombination(
			trim($_REQUEST['Sub1_Code']), 
			trim($_REQUEST['Sub2_Code']), 
			trim($_REQUEST['Sub3_Code']), 
			$Sub4_Code == 'NULL' ? '' : trim($_REQUEST['Sub4_Code']),
			trim($_REQUEST['Sub5_Code']), 
			trim($_REQUEST['Sub6_Code']), 
			trim($_REQUEST['Sub7_Code']), 
			trim($_REQUEST['Sub8_Code']), 
			trim($_REQUEST['Sub9_Code']),
			$conn1
		);
		
		if($auto_combination) {
			$_REQUEST['CombinationId'] = $auto_combination['Id'];
			$_REQUEST['GroupId'] = $auto_combination['SubjectGroupId'];
			$row_comb['GroupName'] = $auto_combination['GroupName'];
			// Debug: Log successful auto-detection for UPDATE
			error_log("UPDATE - Auto-detection successful - GroupId: " . $auto_combination['SubjectGroupId'] . ", CombinationId: " . $auto_combination['Id'] . ", GroupName: " . $auto_combination['GroupName']);
		} else {
			// Debug: Log failed auto-detection for UPDATE
			error_log("UPDATE - Auto-detection failed for subjects - S1: " . trim($_REQUEST['Sub1_Code']) . ", S2: " . trim($_REQUEST['Sub2_Code']) . ", S3: " . trim($_REQUEST['Sub3_Code']));
		}
		
		// Final validation: Ensure GroupId and CombinationId are set before UPDATE
		// Force override if auto-detection worked but form fields are empty/NULL
		if($auto_combination && (empty($_REQUEST['GroupId']) || empty($_REQUEST['CombinationId']))) {
			$_REQUEST['GroupId'] = $auto_combination['SubjectGroupId'];
			$_REQUEST['CombinationId'] = $auto_combination['Id'];
			error_log("UPDATE - Forced override of empty form fields with auto-detected values");
		}
		
		$final_group_id = getFieldValue('GroupId', true);
		$final_combination_id = getFieldValue('CombinationId', true);
		error_log("UPDATE - Final values before SQL - GroupId: " . $final_group_id . ", CombinationId: " . $final_combination_id . ", GroupName: " . (isset($row_comb['GroupName']) ? $row_comb['GroupName'] : 'NOT SET'));
		
		$sql2="UPDATE tbl_resultpi SET
		GROUPID			=	".$final_group_id.",
		GROUPNAME		=	'".mysql_real_escape_string(isset($row_comb['GroupName']) ? $row_comb['GroupName'] : '')."',
		COMBINATIONID	=	".$final_combination_id.",
		S1_CODE			=	".getStringFieldValue('Sub1_Code').",
		S1_NAME			=	".getStringFieldValue('Sub1_Name').",
		S1_OBT			=	".getFieldValue('Sub1_Obt', true).",
		S1_TOTAL		=	".getFieldValue('Sub1_Total', true).",
		S1_PASS			=	".getStringFieldValue('Sub1_Pass').",
		S1_REMARKS		=	".getStringFieldValue('Sub1_Remarks').",
		S2_CODE			=	".getStringFieldValue('Sub2_Code').",
		S2_NAME			=	".getStringFieldValue('Sub2_Name').",
		S2_OBT			=	".getFieldValue('Sub2_Obt', true).",
		S2_TOTAL		=	".getFieldValue('Sub2_Total', true).",
		S2_PASS			=	".getStringFieldValue('Sub2_Pass').",
		S2_REMARKS		=	".getStringFieldValue('Sub2_Remarks').",
		S3_CODE			=	".getStringFieldValue('Sub3_Code').",
		S3_NAME			=	".getStringFieldValue('Sub3_Name').",
		S3_OBT			=	".getFieldValue('Sub3_Obt', true).",
		S3_TOTAL		=	".getFieldValue('Sub3_Total', true).",
		S3_PASS			=	".getStringFieldValue('Sub3_Pass').",
		S3_REMARKS		=	".getStringFieldValue('Sub3_Remarks').",
		S4_CODE			=	".$Sub4_Code.",
		S4_NAME			=	".$Sub4_Name.",
		S4_OBT			=	".$Sub4_Obt.",
		S4_TOTAL		=	".$Sub4_Total.",
		S4_PASS			=	".$Sub4_Pass.",
		S4_REMARKS		=	".$Sub4_Remarks.",
		S5_CODE			=	".getStringFieldValue('Sub5_Code').",
		S5_NAME			=	".getStringFieldValue('Sub5_Name').",
		S5_OBT			=	".getFieldValue('Sub5_Obt', true).",
		S5_TOTAL		=	".getFieldValue('Sub5_Total', true).",
		S5_PASS			=	".getStringFieldValue('Sub5_Pass').",
		S5_REMARKS		=	".getStringFieldValue('Sub5_Remarks').",
		S6_CODE			=	".getStringFieldValue('Sub6_Code').",
		S6_NAME			=	".getStringFieldValue('Sub6_Name').",
		S6_OBT			=	".getFieldValue('Sub6_Obt', true).",
		S6_TOTAL		=	".getFieldValue('Sub6_Total', true).",
		S6_PASS			=	".getStringFieldValue('Sub6_Pass').",
		S6_REMARKS		=	".getStringFieldValue('Sub6_Remarks').",
		S7_CODE			=	".getStringFieldValue('Sub7_Code').",
		S7_NAME			=	".getStringFieldValue('Sub7_Name').",
		S7_OBT			=	".getFieldValue('Sub7_Obt', true).",
		S7_TOTAL		=	".getFieldValue('Sub7_Total', true).",
		S7_PASS			=	".getStringFieldValue('Sub7_Pass').",
		S7_REMARKS		=	".getStringFieldValue('Sub7_Remarks').",
		S8_CODE			=	".getStringFieldValue('Sub8_Code').",
		S8_NAME			=	".getStringFieldValue('Sub8_Name').",
		S8_OBT			=	".getFieldValue('Sub8_Obt', true).",
		S8_TOTAL		=	".getFieldValue('Sub8_Total', true).",
		S8_PASS			=	".getStringFieldValue('Sub8_Pass').",
		S8_REMARKS		=	".getStringFieldValue('Sub8_Remarks').",
		S9_CODE			=	".getStringFieldValue('Sub9_Code').",
		S9_NAME			=	".getStringFieldValue('Sub9_Name').",
		S9_OBT			=	".getFieldValue('Sub9_Obt', true).",
		S9_TOTAL		=	".getFieldValue('Sub9_Total', true).",
		S9_PASS			=	".getStringFieldValue('Sub9_Pass').",
		S9_REMARKS		=	".getStringFieldValue('Sub9_Remarks').",
		TOTAL_OBT		=	".getFieldValue('Total_Obt', true).",
		TOTAL_MARKS		=	".getFieldValue('Total_Marks', true).",
		RESULT			=	".getStringFieldValue('Result')."
		WHERE REGNO		=	".getStringFieldValue('RegistrationNo')."
		AND ID			=	".getFieldValue('RID', true)."";
		$res2=mysql_query($sql2, $conn_sscreslt)or die(mysql_error());
		
		if($res2==1)
		{
			$ins="INSERT INTO tbl_resultlog SET
			ActivityType		=		'ResultUpdation-I',
			ActivityRefNo		=		".getStringFieldValue('ActivityRefNo').",
			RegNo				=		".getStringFieldValue('RegistrationNo').",
			StudentId			=		".getFieldValue('Id', true).",
			EmployeeId			=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn_sscreslt);
			
			?><script>alert('Information Processed Successfully.');location.replace('sscrecords09.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('sscrecords09_edit-.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
		}
	}//if(isset($_REQUEST['update']))
	else if(isset($_REQUEST['insert']))
	{
		// Handle Subject 4 fields with proper trimming and NULL handling for INSERT
		$Sub4_Pass = getStringFieldValue('Sub4_Pass');
		if($Sub4_Pass == 'NULL' || trim($_REQUEST['Sub4_Pass']) == '')
		{
			$Sub4_Code = 'NULL'; $Sub4_Name = 'NULL'; $Sub4_Obt = '0'; $Sub4_Total = '0'; $Sub4_Pass = 'NULL'; $Sub4_Remarks = 'NULL';
		}
		else
		{
			$Sub4_Code = getStringFieldValue('Sub4_Code');
			$Sub4_Name = getStringFieldValue('Sub4_Name');
			$Sub4_Obt = getFieldValue('Sub4_Obt', true);
			$Sub4_Total = getFieldValue('Sub4_Total', true);
			$Sub4_Pass = getStringFieldValue('Sub4_Pass');
			$Sub4_Remarks = getStringFieldValue('Sub4_Remarks');
		}
		
		// Auto-detect combination and group based on selected subjects for INSERT
		$auto_combination = autoDetectCombination(
			trim($_REQUEST['Sub1_Code']), 
			trim($_REQUEST['Sub2_Code']), 
			trim($_REQUEST['Sub3_Code']), 
			$Sub4_Code == 'NULL' ? '' : trim($_REQUEST['Sub4_Code']),
			trim($_REQUEST['Sub5_Code']), 
			trim($_REQUEST['Sub6_Code']), 
			trim($_REQUEST['Sub7_Code']), 
			trim($_REQUEST['Sub8_Code']), 
			trim($_REQUEST['Sub9_Code']),
			$conn1
		);
		
		if($auto_combination) {
			$_REQUEST['CombinationId'] = $auto_combination['Id'];
			$_REQUEST['GroupId'] = $auto_combination['SubjectGroupId'];
			$row_comb['GroupName'] = $auto_combination['GroupName'];
			// Debug: Log successful auto-detection for INSERT
			error_log("INSERT - Auto-detection successful - GroupId: " . $auto_combination['SubjectGroupId'] . ", CombinationId: " . $auto_combination['Id'] . ", GroupName: " . $auto_combination['GroupName']);
		} else {
			// Debug: Log failed auto-detection for INSERT
			error_log("INSERT - Auto-detection failed for subjects - S1: " . trim($_REQUEST['Sub1_Code']) . ", S2: " . trim($_REQUEST['Sub2_Code']) . ", S3: " . trim($_REQUEST['Sub3_Code']));
		}
		
		if(!empty($_REQUEST['Year']) && !empty($_REQUEST['Year']) && !empty($_REQUEST['Session'])){
		
		// Final validation: Ensure GroupId and CombinationId are set before INSERT
		// Force override if auto-detection worked but form fields are empty/NULL
		if($auto_combination && (empty($_REQUEST['GroupId']) || empty($_REQUEST['CombinationId']))) {
			$_REQUEST['GroupId'] = $auto_combination['SubjectGroupId'];
			$_REQUEST['CombinationId'] = $auto_combination['Id'];
			error_log("INSERT - Forced override of empty form fields with auto-detected values");
		}
		
		$final_group_id = getFieldValue('GroupId', true);
		$final_combination_id = getFieldValue('CombinationId', true);
		error_log("INSERT - Final values before SQL - GroupId: " . $final_group_id . ", CombinationId: " . $final_combination_id . ", GroupName: " . (isset($row_comb['GroupName']) ? $row_comb['GroupName'] : 'NOT SET'));
		
		$sql2="INSERT INTO tbl_resultpi SET
		YEAR			=	".getStringFieldValue('Year', false).",
		ROLLNO			=	".getStringFieldValue('RollNo', false).",
		SESSION			=	".getFieldValue('Session', true).",
		REGNO			=	".getStringFieldValue('RegistrationNo', false).",
		NAME			=	'".strtoupper(mysql_real_escape_string(trim($_REQUEST['Name'])))."',
		FNAME			=	'".strtoupper(mysql_real_escape_string(trim($_REQUEST['FatherName'])))."',
		STATUS			=	".getFieldValue('Status', true).",
		GROUPID			=	".$final_group_id.",
		GROUPNAME		=	'".mysql_real_escape_string(isset($row_comb['GroupName']) ? $row_comb['GroupName'] : '')."',
		COMBINATIONID	=	".$final_combination_id.",
		S1_CODE			=	".getStringFieldValue('Sub1_Code').",
		S1_NAME			=	".getStringFieldValue('Sub1_Name').",
		S1_OBT			=	".getFieldValue('Sub1_Obt', true).",
		S1_TOTAL		=	".getFieldValue('Sub1_Total', true).",
		S1_PASS			=	".getStringFieldValue('Sub1_Pass').",
		S1_REMARKS		=	".getStringFieldValue('Sub1_Remarks').",
		S2_CODE			=	".getStringFieldValue('Sub2_Code').",
		S2_NAME			=	".getStringFieldValue('Sub2_Name').",
		S2_OBT			=	".getFieldValue('Sub2_Obt', true).",
		S2_TOTAL		=	".getFieldValue('Sub2_Total', true).",
		S2_PASS			=	".getStringFieldValue('Sub2_Pass').",
		S2_REMARKS		=	".getStringFieldValue('Sub2_Remarks').",
		S3_CODE			=	".getStringFieldValue('Sub3_Code').",
		S3_NAME			=	".getStringFieldValue('Sub3_Name').",
		S3_OBT			=	".getFieldValue('Sub3_Obt', true).",
		S3_TOTAL		=	".getFieldValue('Sub3_Total', true).",
		S3_PASS			=	".getStringFieldValue('Sub3_Pass').",
		S3_REMARKS		=	".getStringFieldValue('Sub3_Remarks').",
		S4_CODE			=	".$Sub4_Code.",
		S4_NAME			=	".$Sub4_Name.",
		S4_OBT			=	".$Sub4_Obt.",
		S4_TOTAL		=	".$Sub4_Total.",
		S4_PASS			=	".$Sub4_Pass.",
		S4_REMARKS		=	".$Sub4_Remarks.",
		S5_CODE			=	".getStringFieldValue('Sub5_Code').",
		S5_NAME			=	".getStringFieldValue('Sub5_Name').",
		S5_OBT			=	".getFieldValue('Sub5_Obt', true).",
		S5_TOTAL		=	".getFieldValue('Sub5_Total', true).",
		S5_PASS			=	".getStringFieldValue('Sub5_Pass').",
		S5_REMARKS		=	".getStringFieldValue('Sub5_Remarks').",
		S6_CODE			=	".getStringFieldValue('Sub6_Code').",
		S6_NAME			=	".getStringFieldValue('Sub6_Name').",
		S6_OBT			=	".getFieldValue('Sub6_Obt', true).",
		S6_TOTAL		=	".getFieldValue('Sub6_Total', true).",
		S6_PASS			=	".getStringFieldValue('Sub6_Pass').",
		S6_REMARKS		=	".getStringFieldValue('Sub6_Remarks').",
		S7_CODE			=	".getStringFieldValue('Sub7_Code').",
		S7_NAME			=	".getStringFieldValue('Sub7_Name').",
		S7_OBT			=	".getFieldValue('Sub7_Obt', true).",
		S7_TOTAL		=	".getFieldValue('Sub7_Total', true).",
		S7_PASS			=	".getStringFieldValue('Sub7_Pass').",
		S7_REMARKS		=	".getStringFieldValue('Sub7_Remarks').",
		S8_CODE			=	".getStringFieldValue('Sub8_Code').",
		S8_NAME			=	".getStringFieldValue('Sub8_Name').",
		S8_OBT			=	".getFieldValue('Sub8_Obt', true).",
		S8_TOTAL		=	".getFieldValue('Sub8_Total', true).",
		S8_PASS			=	".getStringFieldValue('Sub8_Pass').",
		S8_REMARKS		=	".getStringFieldValue('Sub8_Remarks').",
		S9_CODE			=	".getStringFieldValue('Sub9_Code').",
		S9_NAME			=	".getStringFieldValue('Sub9_Name').",
		S9_OBT			=	".getFieldValue('Sub9_Obt', true).",
		S9_TOTAL		=	".getFieldValue('Sub9_Total', true).",
		S9_PASS			=	".getStringFieldValue('Sub9_Pass').",
		S9_REMARKS		=	".getStringFieldValue('Sub9_Remarks').",
		TOTAL_OBT		=	".getFieldValue('Total_Obt', true).",
		TOTAL_MARKS		=	".getFieldValue('Total_Marks', true).",
		RESULT			=	".getStringFieldValue('Result')."";
		$res2=mysql_query($sql2, $conn_sscreslt);}
		
		if($res2==1)
		{
			$ins="INSERT INTO tbl_resultlog SET
			ActivityType		=		'ResultInsertion-I',
			ActivityRefNo		=		".getStringFieldValue('ActivityRefNo').",
			RegNo				=		".getStringFieldValue('RegistrationNo').",
			StudentId			=		".getFieldValue('Id', true).",
			EmployeeId			=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn_sscreslt);
			
			?><script>alert('Information Processed Successfully.');location.replace('sscrecords09.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('sscrecords09_edit-.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
		}
	}//else if(isset($_REQUEST['insert']))
	?>
	<?php
	$sql="SELECT Id, Name, FatherName, RegistrationNo, RESULT, RID FROM vwstudentspi WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn_sscreslt);
	$row=mysql_fetch_array($res);
	
	$sql1="SELECT * FROM tbl_resultpi WHERE REGNO=".$row['RegistrationNo']." AND ID=".$row['RID']."";
	$res1=mysql_query($sql1, $conn_sscreslt);
	$num_rows=mysql_num_rows($res1);
	$row1=mysql_fetch_array($res1); // Fetch the result data for populating form
	
	// Fetch all subjects for dropdown
	$Subjects = array();
	$sql = "SELECT Id, Name, Code, Class, IsPractical, IsCompulsory FROM subjects WHERE IsGeneral=1 AND class=9 ORDER BY Code ASC";
	$res = mysql_query($sql, $conn1);
	while($row_subj = mysql_fetch_assoc($res))
	{
		array_push($Subjects, array("Id"=>$row_subj['Id'], "Name"=>$row_subj['Name'], "Code"=>$row_subj['Code'], "Class"=>$row_subj['Class'], "IsPractical"=>$row_subj['IsPractical'], "IsCompulsory"=>$row_subj['IsCompulsory']));
	}
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Update Result</h6>
					</div>
					
					<div class="widget_content">
						<?php if($num_rows > 0){?>
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();">
						<input name="RegistrationNo" id="RegistrationNo" type="hidden" value="<?php echo $row['RegistrationNo'];?>"/>
						<input name="RID" id="RID" type="hidden" value="<?php echo $row['RID'];?>"/>
							<ul>
								<li>
								<fieldset>
									<legend>Result Info</legend>
									<ul>
										<li>
										<div class="form_grid_6">
											<label class="field_title">Student Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="Name" id="Name" type="text" value="<?php echo $row['Name'];?>" class="x_large" readonly/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Father's Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="FatherName" id="FatherName" type="text" value="<?php echo $row['FatherName'];?>" class="x_large" readonly/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Group<span class="req">*</span></label>
											<div class="form_input">
												<input type="text" name="GroupDisplay" id="GroupDisplay" readonly class="text_input readonly-input" tabindex="1" 
													   placeholder="Group will be auto-detected based on selected subjects" 
													   title="Group is automatically detected based on your subject selection"
													   value="<?php 
													   if(!empty($row1['GROUPID'])) {
														   $sql_group_name="SELECT GroupName FROM vwsubcombinations09 WHERE SubjectGroupId=".$row1['GROUPID']." LIMIT 1";
														   $res_group_name=mysql_query($sql_group_name, $conn1);
														   if($row_group_name=mysql_fetch_array($res_group_name)) {
															   echo htmlspecialchars($row_group_name['GroupName']);
														   }
													   }
													   ?>" />
												<input type="hidden" name="GroupId" id="GroupId" value="<?php echo $row1['GROUPID']; ?>" />
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Combination<span class="req">*</span></label>
											<div class="form_input">
												<input type="text" name="CombinationDisplay" id="CombinationDisplay" readonly class="text_input readonly-input" tabindex="2" 
													   placeholder="Combination will be auto-detected based on selected subjects" 
													   title="Combination is automatically detected based on your subject selection"
													   value="<?php 
													   if(!empty($row1['COMBINATIONID'])) {
														   $sql_comb_name="SELECT Name FROM vwsubcombinations09 WHERE Id=".$row1['COMBINATIONID']." LIMIT 1";
														   $res_comb_name=mysql_query($sql_comb_name, $conn1);
														   if($row_comb_name=mysql_fetch_array($res_comb_name)) {
															   echo htmlspecialchars($row_comb_name['Name']);
														   }
													   }
													   ?>" />
												<input type="hidden" name="CombinationId" id="CombinationId" value="<?php echo $row1['COMBINATIONID']; ?>" />
												<button type="button" onclick="refreshCombinations()" class="auto-detect-btn" title="Manually trigger auto-detection">
													🔄 Auto-Detect
												</button>
												<div class="combination-help">
													Combinations update automatically when you select subjects
												</div>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<fieldset>
											<legend>All Subjects</legend>
											<ul>
												<li>
												<table id="tbl-subjects" class="search">
												<tr>
													<td align="center"></td>
													<td align="left"><label style="font-weight:bold;">P1 Subject</label></td>
													<td align="left"><label style="font-weight:bold;">P1 Obt Marks</label></td>
													<td align="left"><label style="font-weight:bold;">P1 Total Marks</label></td>
													<td align="left"><label style="font-weight:bold;">P1 Pass/Fail</label></td>
													<td align="left"><label style="font-weight:bold;">P1 Remarks</label></td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB1.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<select name="Sub1_Code" id="Sub1_Code" data-required="required" data-message="Choose Subject" class="chzn-select x_large" tabindex="3" onchange="updateSubjectName(1, this.value); autoDetectCombinationJS();" title="Select Subject 1">
														<option value="">Select Subject</option>
														<?php
														foreach($Subjects as $subject) {
															$selected = ($row1['S1_CODE'] == $subject['Code']) ? 'selected' : '';
															echo "<option value='".$subject['Code']."' $selected>".$subject['Name']."</option>";
														}
														?>
														</select>
														<input name="Sub1_Name" id="Sub1_Name" type="hidden" value="<?php echo $row1['S1_NAME'];?>"/>
													</td>
													<td><input name="Sub1_Obt" id="Sub1_Obt" type="text" value="<?php echo $row1['S1_OBT'];?>" class="large" tabindex="4"/></td>
													<td><input name="Sub1_Total" id="Sub1_Total" type="text" value="<?php echo $row1['S1_TOTAL'];?>" class="large" tabindex="5"/></td>
													<td>
														<select name="Sub1_Pass" id="Sub1_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="6">
														<option value="">Select</option>
														<option value="PASS" <?php echo ($row1['S1_PASS']=='PASS')?'selected':'';?>>PASS</option>
														<option value="FAIL" <?php echo ($row1['S1_PASS']=='FAIL')?'selected':'';?>>FAIL</option>
														</select>
													</td>
													<td><input name="Sub1_Remarks" id="Sub1_Remarks" type="text" value="<?php echo $row1['S1_REMARKS'];?>" class="large" tabindex="7"/></td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB2.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<select name="Sub2_Code" id="Sub2_Code" data-required="required" data-message="Choose Subject" class="chzn-select x_large" tabindex="8" onchange="updateSubjectName(2, this.value); autoDetectCombinationJS();" title="Select Subject 2 (Required for combination detection)">
														<option value="">Select Subject</option>
														<?php
														foreach($Subjects as $subject) {
															$selected = ($row1['S2_CODE'] == $subject['Code']) ? 'selected' : '';
															echo "<option value='".$subject['Code']."' $selected>".$subject['Name']."</option>";
														}
														?>
														</select>
														<input name="Sub2_Name" id="Sub2_Name" type="hidden" value="<?php echo $row1['S2_NAME'];?>"/>
													</td>
													<td><input name="Sub2_Obt" id="Sub2_Obt" type="text" value="<?php echo $row1['S2_OBT'];?>" class="large" tabindex="9"/></td>
													<td><input name="Sub2_Total" id="Sub2_Total" type="text" value="<?php echo $row1['S2_TOTAL'];?>" class="large" tabindex="10"/></td>
													<td>
														<select name="Sub2_Pass" id="Sub2_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="11">
														<option value="">Select</option>
														<option value="PASS" <?php echo ($row1['S2_PASS']=='PASS')?'selected':'';?>>PASS</option>
														<option value="FAIL" <?php echo ($row1['S2_PASS']=='FAIL')?'selected':'';?>>FAIL</option>
														</select>
													</td>
													<td><input name="Sub2_Remarks" id="Sub2_Remarks" type="text" value="<?php echo $row1['S2_REMARKS'];?>" class="large" tabindex="12"/></td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB3.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<select name="Sub3_Code" id="Sub3_Code" data-required="required" data-message="Choose Subject" class="chzn-select x_large" tabindex="13" onchange="updateSubjectName(3, this.value); autoDetectCombinationJS();" title="Select Subject 3 (Required for combination detection)">
														<option value="">Select Subject</option>
														<?php
														foreach($Subjects as $subject) {
															$selected = ($row1['S3_CODE'] == $subject['Code']) ? 'selected' : '';
															echo "<option value='".$subject['Code']."' $selected>".$subject['Name']."</option>";
														}
														?>
														</select>
														<input name="Sub3_Name" id="Sub3_Name" type="hidden" value="<?php echo $row1['S3_NAME'];?>"/>
													</td>
													<td><input name="Sub3_Obt" id="Sub3_Obt" type="text" value="<?php echo $row1['S3_OBT'];?>" class="large" tabindex="14"/></td>
													<td><input name="Sub3_Total" id="Sub3_Total" type="text" value="<?php echo $row1['S3_TOTAL'];?>" class="large" tabindex="15"/></td>
													<td>
														<select name="Sub3_Pass" id="Sub3_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="16">
														<option value="">Select</option>
														<option value="PASS" <?php echo ($row1['S3_PASS']=='PASS')?'selected':'';?>>PASS</option>
														<option value="FAIL" <?php echo ($row1['S3_PASS']=='FAIL')?'selected':'';?>>FAIL</option>
														</select>
													</td>
													<td><input name="Sub3_Remarks" id="Sub3_Remarks" type="text" value="<?php echo $row1['S3_REMARKS'];?>" class="large" tabindex="17"/></td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB4.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<select name="Sub4_Code" id="Sub4_Code" data-message="Choose Subject" class="chzn-select x_large" tabindex="18" onchange="updateSubjectName(4, this.value); autoDetectCombinationJS();">
														<option value="">Select Subject</option>
														<?php
														foreach($Subjects as $subject) {
															$selected = ($row1['S4_CODE'] == $subject['Code']) ? 'selected' : '';
															echo "<option value='".$subject['Code']."' $selected>".$subject['Name']."</option>";
														}
														?>
														</select>
														<input name="Sub4_Name" id="Sub4_Name" type="hidden" value="<?php echo $row1['S4_NAME'];?>"/>
													</td>
													<td><input name="Sub4_Obt" id="Sub4_Obt" type="text" value="<?php echo $row1['S4_OBT'];?>" class="large" tabindex="19"/></td>
													<td><input name="Sub4_Total" id="Sub4_Total" type="text" value="<?php echo $row1['S4_TOTAL'];?>" class="large" tabindex="20"/></td>
													<td>
														<select name="Sub4_Pass" id="Sub4_Pass" data-message="Choose Status" class="chzn-select small-select" tabindex="21">
														<option value="">Select</option>
														<option value="PASS" <?php echo ($row1['S4_PASS']=='PASS')?'selected':'';?>>PASS</option>
														<option value="FAIL" <?php echo ($row1['S4_PASS']=='FAIL')?'selected':'';?>>FAIL</option>
														</select>
													</td>
													<td><input name="Sub4_Remarks" id="Sub4_Remarks" type="text" value="<?php echo $row1['S4_REMARKS'];?>" class="large" tabindex="22"/></td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB5.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<select name="Sub5_Code" id="Sub5_Code" data-required="required" data-message="Choose Subject" class="chzn-select x_large" tabindex="23" onchange="updateSubjectName(5, this.value); autoDetectCombinationJS();">
														<option value="">Select Subject</option>
														<?php
														foreach($Subjects as $subject) {
															$selected = ($row1['S5_CODE'] == $subject['Code']) ? 'selected' : '';
															echo "<option value='".$subject['Code']."' $selected>".$subject['Name']."</option>";
														}
														?>
														</select>
														<input name="Sub5_Name" id="Sub5_Name" type="hidden" value="<?php echo $row1['S5_NAME'];?>"/>
													</td>
													<td><input name="Sub5_Obt" id="Sub5_Obt" type="text" value="<?php echo $row1['S5_OBT'];?>" class="large" tabindex="24"/></td>
													<td><input name="Sub5_Total" id="Sub5_Total" type="text" value="<?php echo $row1['S5_TOTAL'];?>" class="large" tabindex="25"/></td>
													<td>
														<select name="Sub5_Pass" id="Sub5_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="26">
														<option value="">Select</option>
														<option value="PASS" <?php echo ($row1['S5_PASS']=='PASS')?'selected':'';?>>PASS</option>
														<option value="FAIL" <?php echo ($row1['S5_PASS']=='FAIL')?'selected':'';?>>FAIL</option>
														</select>
													</td>
													<td><input name="Sub5_Remarks" id="Sub5_Remarks" type="text" value="<?php echo $row1['S5_REMARKS'];?>" class="large" tabindex="27"/></td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB6.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<select name="Sub6_Code" id="Sub6_Code" data-required="required" data-message="Choose Subject" class="chzn-select x_large" tabindex="28" onchange="updateSubjectName(6, this.value); autoDetectCombinationJS();">
														<option value="">Select Subject</option>
														<?php
														foreach($Subjects as $subject) {
															$selected = ($row1['S6_CODE'] == $subject['Code']) ? 'selected' : '';
															echo "<option value='".$subject['Code']."' $selected>".$subject['Name']."</option>";
														}
														?>
														</select>
														<input name="Sub6_Name" id="Sub6_Name" type="hidden" value="<?php echo $row1['S6_NAME'];?>"/>
													</td>
													<td><input name="Sub6_Obt" id="Sub6_Obt" type="text" value="<?php echo $row1['S6_OBT'];?>" class="large" tabindex="29"/></td>
													<td><input name="Sub6_Total" id="Sub6_Total" type="text" value="<?php echo $row1['S6_TOTAL'];?>" class="large" tabindex="30"/></td>
													<td>
														<select name="Sub6_Pass" id="Sub6_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="31">
														<option value="">Select</option>
														<option value="PASS" <?php echo ($row1['S6_PASS']=='PASS')?'selected':'';?>>PASS</option>
														<option value="FAIL" <?php echo ($row1['S6_PASS']=='FAIL')?'selected':'';?>>FAIL</option>
														</select>
													</td>
													<td><input name="Sub6_Remarks" id="Sub6_Remarks" type="text" value="<?php echo $row1['S6_REMARKS'];?>" class="large" tabindex="32"/></td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB7.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<select name="Sub7_Code" id="Sub7_Code" data-required="required" data-message="Choose Subject" class="chzn-select x_large" tabindex="33" onchange="updateSubjectName(7, this.value); autoDetectCombinationJS();">
														<option value="">Select Subject</option>
														<?php
														foreach($Subjects as $subject) {
															$selected = ($row1['S7_CODE'] == $subject['Code']) ? 'selected' : '';
															echo "<option value='".$subject['Code']."' $selected>".$subject['Name']."</option>";
														}
														?>
														</select>
														<input name="Sub7_Name" id="Sub7_Name" type="hidden" value="<?php echo $row1['S7_NAME'];?>"/>
													</td>
													<td><input name="Sub7_Obt" id="Sub7_Obt" type="text" value="<?php echo $row1['S7_OBT'];?>" class="large" tabindex="34"/></td>
													<td><input name="Sub7_Total" id="Sub7_Total" type="text" value="<?php echo $row1['S7_TOTAL'];?>" class="large" tabindex="35"/></td>
													<td>
														<select name="Sub7_Pass" id="Sub7_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="36">
														<option value="">Select</option>
														<option value="PASS" <?php echo ($row1['S7_PASS']=='PASS')?'selected':'';?>>PASS</option>
														<option value="FAIL" <?php echo ($row1['S7_PASS']=='FAIL')?'selected':'';?>>FAIL</option>
														</select>
													</td>
													<td><input name="Sub7_Remarks" id="Sub7_Remarks" type="text" value="<?php echo $row1['S7_REMARKS'];?>" class="large" tabindex="37"/></td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB8.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<select name="Sub8_Code" id="Sub8_Code" data-required="required" data-message="Choose Subject" class="chzn-select x_large" tabindex="38" onchange="updateSubjectName(8, this.value); autoDetectCombinationJS();">
														<option value="">Select Subject</option>
														<?php
														foreach($Subjects as $subject) {
															$selected = ($row1['S8_CODE'] == $subject['Code']) ? 'selected' : '';
															echo "<option value='".$subject['Code']."' $selected>".$subject['Name']."</option>";
														}
														?>
														</select>
														<input name="Sub8_Name" id="Sub8_Name" type="hidden" value="<?php echo $row1['S8_NAME'];?>"/>
													</td>
													<td><input name="Sub8_Obt" id="Sub8_Obt" type="text" value="<?php echo $row1['S8_OBT'];?>" class="large" tabindex="39"/></td>
													<td><input name="Sub8_Total" id="Sub8_Total" type="text" value="<?php echo $row1['S8_TOTAL'];?>" class="large" tabindex="40"/></td>
													<td>
														<select name="Sub8_Pass" id="Sub8_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="41">
														<option value="">Select</option>
														<option value="PASS" <?php echo ($row1['S8_PASS']=='PASS')?'selected':'';?>>PASS</option>
														<option value="FAIL" <?php echo ($row1['S8_PASS']=='FAIL')?'selected':'';?>>FAIL</option>
														</select>
													</td>
													<td><input name="Sub8_Remarks" id="Sub8_Remarks" type="text" value="<?php echo $row1['S8_REMARKS'];?>" class="large" tabindex="42"/></td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB9.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<select name="Sub9_Code" id="Sub9_Code" data-required="required" data-message="Choose Subject" class="chzn-select x_large" tabindex="43" onchange="updateSubjectName(9, this.value); autoDetectCombinationJS();">
														<option value="">Select Subject</option>
														<?php
														foreach($Subjects as $subject) {
															$selected = ($row1['S9_CODE'] == $subject['Code']) ? 'selected' : '';
															echo "<option value='".$subject['Code']."' $selected>".$subject['Name']."</option>";
														}
														?>
														</select>
														<input name="Sub9_Name" id="Sub9_Name" type="hidden" value="<?php echo $row1['S9_NAME'];?>"/>
													</td>
													<td><input name="Sub9_Obt" id="Sub9_Obt" type="text" value="<?php echo $row1['S9_OBT'];?>" class="large" tabindex="44"/></td>
													<td><input name="Sub9_Total" id="Sub9_Total" type="text" value="<?php echo $row1['S9_TOTAL'];?>" class="large" tabindex="45"/></td>
													<td>
														<select name="Sub9_Pass" id="Sub9_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="46">
														<option value="">Select</option>
														<option value="PASS" <?php echo ($row1['S9_PASS']=='PASS')?'selected':'';?>>PASS</option>
														<option value="FAIL" <?php echo ($row1['S9_PASS']=='FAIL')?'selected':'';?>>FAIL</option>
														</select>
													</td>
													<td><input name="Sub9_Remarks" id="Sub9_Remarks" type="text" value="<?php echo $row1['S9_REMARKS'];?>" class="large" tabindex="47"/></td>
												</tr>
												</table>
												</li>
											</ul>
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Obtained Marks<span class="req">*</span></label>
											<div class="form_input">
												<input name="Total_Obt" id="Total_Obt" type="text" value="<?php echo $row1['TOTAL_OBT'];?>" class="large" tabindex="48"/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Total Marks<span class="req">*</span></label>
											<div class="form_input">
												<input name="Total_Marks" id="Total_Marks" type="text" value="<?php echo $row1['TOTAL_MARKS'];?>" class="large" tabindex="49"/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Result<span class="req">*</span></label>
											<div class="form_input">
												<select name="Result" id="Result" data-required="required" data-message="Choose Result" class="chzn-select small-select" tabindex="50">
												<option value="">Select</option>
												<option value="PASS" <?php echo ((trim($row1['RESULT'])=='PASS')?'selected':'');?>>PASS</option>
												<option value="SUPPLY" <?php echo ((trim($row1['RESULT'])=='SUPPLY')?'selected':'');?>>SUPPLY</option>
												<option value="ABSENT" <?php echo ((trim($row1['RESULT'])=='ABSENT')?'selected':'');?>>ABSENT</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Letter No<span class="req">*</span></label>
											<div class="form_input">
												<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Letter No" class="x_large" maxlength="50" tabindex="51"/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_12">
											<div class="form_input">
												<input type="hidden" name="Id" id="Id" value="<?php echo $_REQUEST['Id'];?>"/>
												<button type="submit" name="update" value="submit" class="btn_small btn_blue" tabindex="52"><span>Update</span></button>
												<button type="reset" class="btn_small btn_blue" onclick="location.replace('sscrecords09_edit-.php?Id=<?php echo $_REQUEST['Id'];?>')" tabindex="53"><span>Reset</span></button>
											</div>
											<span class="clear"></span>
										</div>
										</li>
									</ul>
								</fieldset>
								</li>
							</ul>
						</form>
						<?php }//if($num_rows > 0)
						else{?>
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();">
						<input name="RegistrationNo" id="RegistrationNo" type="hidden" value="<?php echo $row['RegistrationNo'];?>"/>
							<ul>
								<li>
								<fieldset>
									<legend>Result Info</legend>
									<ul>
										<li>
										<div class="form_grid_6">
											<label class="field_title">Year<span class="req">*</span></label>
											<div class="form_input">
												<input name="Year" id="Year" type="text" data-required="required" data-message="Enter Year" class="x_large" onkeypress="return isNumber()" maxlength="2" tabindex="1"/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">RollNo<span class="req">*</span></label>
											<div class="form_input">
												<input name="RollNo" id="RollNo" type="text" data-required="required" data-message="Enter RollNo" class="x_large" onkeypress="return isNumber()" maxlength="6" tabindex="2"/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Session<span class="req">*</span></label>
											<div class="form_input">
												<select name="Session" id="Session" data-required="required" data-message="Choose Session" class="chzn-select custom-select" tabindex="3">
												<option value="">Select</option>
												<option value="1">1st Annual</option>
												<option value="2">2nd Annual</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Status<span class="req">*</span></label>
											<div class="form_input">
												<select name="Status" id="Status" data-required="required" data-message="Choose Status" class="chzn-select custom-select" tabindex="4">
												<option value="">Select</option>
												<option value="1">Regular</option>
												<option value="2">Private</option>
												</select>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Student Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="Name" id="Name" type="text" value="<?php echo $row['Name'];?>" class="x_large" readonly/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Father's Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="FatherName" id="FatherName" type="text" value="<?php echo $row['FatherName'];?>" class="x_large" readonly/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Group<span class="req">*</span></label>
											<div class="form_input">
												<select name="GroupId" id="GroupId" data-required="required" data-message="Choose Group" class="chzn-select custom-select" tabindex="5">
												<option value="">Select</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Combination<span class="req">*</span></label>
											<div class="form_input">
												<select name="CombinationId" id="CombinationId" data-required="required" data-message="Choose Combination" class="chzn-select custom-select" tabindex="6">
												<option value="">Select</option>
												</select>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<fieldset>
											<legend>All Subjects</legend>
											<ul>
												<li>
												<table id="tbl-subjects" class="search">
												<tr>
													<td align="center"></td>
													<td align="center"><label style="font-weight:bold;">P1 Subjects</label></td>
													<td align="center"><label style="font-weight:bold;">P1 Pass/Fail</label></td>
													<td align="center"></td>
													<td align="center"><label style="font-weight:bold;">P2 Subjects</label></td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB1.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub1_Name" id="Sub1_Name" type="text" class="x_large" readonly/>
														<input name="Sub1_Code" id="Sub1_Code" type="hidden"/>
														<input name="Sub1_Id" id="Sub1_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub1_Pass" id="Sub1_Pass" class="chzn-select small-select" tabindex="7">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB21.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub21_Name" id="Sub21_Name" type="text" class="x_large" readonly/>
														<input name="Sub21_Code" id="Sub21_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB2.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub2_Name" id="Sub2_Name" type="text" class="x_large" readonly/>
														<input name="Sub2_Code" id="Sub2_Code" type="hidden"/>
														<input name="Sub2_Id" id="Sub2_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub2_Pass" id="Sub2_Pass" class="chzn-select small-select" tabindex="8">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB22.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub22_Name" id="Sub22_Name" type="text" class="x_large" readonly/>
														<input name="Sub22_Code" id="Sub22_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB3.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub3_Name" id="Sub3_Name" type="text" class="x_large" readonly/>
														<input name="Sub3_Code" id="Sub3_Code" type="hidden"/>
														<input name="Sub3_Id" id="Sub3_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub3_Pass" id="Sub3_Pass" class="chzn-select small-select" tabindex="9">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB23.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub23_Name" id="Sub23_Name" type="text" class="x_large" readonly/>
														<input name="Sub23_Code" id="Sub23_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB4.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub4_Name" id="Sub4_Name" type="text" class="x_large" readonly/>
														<input name="Sub4_Code" id="Sub4_Code" type="hidden"/>
														<input name="Sub4_Id" id="Sub4_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub4_Pass" id="Sub4_Pass" class="chzn-select small-select" tabindex="10">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB24.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub24_Name" id="Sub24_Name" type="text" class="x_large" readonly/>
														<input name="Sub24_Code" id="Sub24_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB5.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub5_Name" id="Sub5_Name" type="text" class="x_large" readonly/>
														<input name="Sub5_Code" id="Sub5_Code" type="hidden"/>
														<input name="Sub5_Id" id="Sub5_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub5_Pass" id="Sub5_Pass" class="chzn-select small-select" tabindex="11">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB25.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub25_Name" id="Sub25_Name" type="text" class="x_large" readonly/>
														<input name="Sub25_Code" id="Sub25_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB6.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub6_Name" id="Sub6_Name" type="text" class="x_large" readonly/>
														<input name="Sub6_Code" id="Sub6_Code" type="hidden"/>
														<input name="Sub6_Id" id="Sub6_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub6_Pass" id="Sub6_Pass" class="chzn-select small-select" tabindex="12">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB26.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub26_Name" id="Sub26_Name" type="text" class="x_large" readonly/>
														<input name="Sub26_Code" id="Sub26_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB7.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub7_Name" id="Sub7_Name" type="text" class="x_large" readonly/>
														<input name="Sub7_Code" id="Sub7_Code" type="hidden"/>
														<input name="Sub7_Id" id="Sub7_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub7_Pass" id="Sub7_Pass" class="chzn-select small-select" tabindex="13">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB27.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub27_Name" id="Sub27_Name" type="text" class="x_large" readonly/>
														<input name="Sub27_Code" id="Sub27_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB8.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub8_Name" id="Sub8_Name" type="text" class="x_large" readonly/>
														<input name="Sub8_Code" id="Sub8_Code" type="hidden"/>
														<input name="Sub8_Id" id="Sub8_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub8_Pass" id="Sub8_Pass" class="chzn-select small-select" tabindex="14">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB28.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub28_Name" id="Sub28_Name" type="text" class="x_large" readonly/>
														<input name="Sub28_Code" id="Sub28_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB9.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub9_Name" id="Sub9_Name" type="text" class="x_large" readonly/>
														<input name="Sub9_Code" id="Sub9_Code" type="hidden"/>
														<input name="Sub9_Id" id="Sub9_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub9_Pass" id="Sub9_Pass" class="chzn-select small-select" tabindex="15">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB29.<span style="color:#FF0000;"> *</span></label></td>
												</tr>
												<td>
													<input name="Sub29_Name" id="Sub29_Name" type="text" class="x_large" readonly/>
													<input name="Sub29_Code" id="Sub29_Code" type="hidden"/>
												</td>
												</table>
												</li>
											</ul>
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Result<span class="req">*</span></label>
											<div class="form_input">
												<select name="Result" id="Result" class="chzn-select small-select" tabindex="16">
												<option value="">Select</option>
												<option value="PASS" <?php echo ((trim($row['RESULT'])=='PASS')?'selected':'');?>>PASS</option>
												<option value="SUPPLY" <?php echo ((trim($row['RESULT'])=='SUPPLY')?'selected':'');?>>SUPPLY</option>
												<option value="ABSENT" <?php echo ((trim($row['RESULT'])=='ABSENT')?'selected':'');?>>ABSENT</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Letter No<span class="req">*</span></label>
											<div class="form_input">
												<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Letter No" class="x_large" maxlength="50" tabindex="17"/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_12">
											<div class="form_input">
												<input type="hidden" name="Id" id="Id" value="<?php echo $_REQUEST['Id'];?>"/>
												<button type="submit" name="insert" value="submit" class="btn_small btn_blue" tabindex="18"><span>Update</span></button>
												<button type="reset" class="btn_small btn_blue" onclick="location.replace('sscrecords09_edit.php?Id=<?php echo $_REQUEST['Id'];?>')" tabindex="19"><span>Reset</span></button>
											</div>
											<span class="clear"></span>
										</div>
										</li>
									</ul>
								</fieldset>
								</li>
							</ul>
						</form>
						<?php }//else ($num_rows > 0)?>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php include('includes/footer.php');?>
<script>
// Subject data array from PHP
var subjects = [
	<?php 
	foreach($Subjects as $index => $subject) {
		echo ($index > 0 ? ',' : '') . '{code:"'.$subject['Code'].'", name:"'.$subject['Name'].'"}';
	}
	?>
];

function updateSubjectName(subNumber, selectedCode) {
	var subjectName = '';
	for(var i = 0; i < subjects.length; i++) {
		if(subjects[i].code == selectedCode) {
			subjectName = subjects[i].name;
			break;
		}
	}
	// Update both subject code (in the dropdown) and subject name (in hidden field)
	document.getElementById('Sub' + subNumber + '_Code').value = selectedCode;
	document.getElementById('Sub' + subNumber + '_Name').value = subjectName;
	
	// Show loading indicator
	showLoadingIndicator();
	
	// Auto-detect combination after subject selection with small delay to allow UI updates
	setTimeout(function() {
		autoDetectCombinationJS();
	}, 100);
}

function showLoadingIndicator() {
	var combSelect = document.getElementById('CombinationId');
	var groupSelect = document.getElementById('GroupId');
	
	// Show loading in combination dropdown
	combSelect.innerHTML = '<option value="">Loading combinations...</option>';
	groupSelect.innerHTML = '<option value="">Loading groups...</option>';
}

function autoDetectCombinationJS() {
	console.log('=== AUTO-DETECT COMBINATION TRIGGERED ===');
	
	var s1_code = document.getElementById('Sub1_Code') ? document.getElementById('Sub1_Code').value : '';
	var s2_code = document.getElementById('Sub2_Code') ? document.getElementById('Sub2_Code').value : '';
	var s3_code = document.getElementById('Sub3_Code') ? document.getElementById('Sub3_Code').value : '';
	var s4_code = document.getElementById('Sub4_Code') ? document.getElementById('Sub4_Code').value : '';
	var s5_code = document.getElementById('Sub5_Code') ? document.getElementById('Sub5_Code').value : '';
	var s6_code = document.getElementById('Sub6_Code') ? document.getElementById('Sub6_Code').value : '';
	var s7_code = document.getElementById('Sub7_Code') ? document.getElementById('Sub7_Code').value : '';
	var s8_code = document.getElementById('Sub8_Code') ? document.getElementById('Sub8_Code').value : '';
	var s9_code = document.getElementById('Sub9_Code') ? document.getElementById('Sub9_Code').value : '';
	
	console.log('Subject codes:', {s1: s1_code, s2: s2_code, s3: s3_code, s4: s4_code, s5: s5_code, s6: s6_code, s7: s7_code, s8: s8_code, s9: s9_code});
	
	// Clear previous selections if main subjects are not selected
	if(!s2_code || !s3_code) {
		console.log('Missing required subjects S2 or S3');
		resetDropdowns();
		return;
	}
	
	console.log('Proceeding with combination detection...');
	// Proceed with combination detection
	updateGroupsAndCombinations(s1_code, s2_code, s3_code, s4_code, s5_code, s6_code, s7_code, s8_code, s9_code);
}

// Individual subject change handlers for more granular control
function onSubjectChange(subjectNumber) {
	var subjectElement = document.getElementById('Sub' + subjectNumber + '_Code');
	if(subjectElement) {
		var selectedCode = subjectElement.value;
		updateSubjectName(subjectNumber, selectedCode);
		
		// Provide immediate feedback for key subjects
		if(subjectNumber == 2 || subjectNumber == 3) {
			var s2 = document.getElementById('Sub2_Code').value;
			var s3 = document.getElementById('Sub3_Code').value;
			
			if(s2 && s3) {
				showLoadingIndicator();
			} else {
				resetDropdowns();
			}
		}
	}
}

// Enhanced function to trigger combination update manually
function refreshCombinations() {
	console.log('Manual refresh triggered');
	showLoadingIndicator();
	
	// Show immediate feedback
	var helpDiv = document.querySelector('.combination-help');
	if(helpDiv) {
		helpDiv.textContent = '🔄 Detecting combinations based on selected subjects...';
		helpDiv.style.color = '#007bff';
	}
	
	setTimeout(autoDetectCombinationJS, 100);
}

function updateGroupsAndCombinations(s1_code, s2_code, s3_code, s4_code, s5_code, s6_code, s7_code, s8_code, s9_code) {
	// Create form data for AJAX request
	var params = 'ajax_get_combinations=1' +
		'&s1_code=' + encodeURIComponent(s1_code || '') +
		'&s2_code=' + encodeURIComponent(s2_code || '') +
		'&s3_code=' + encodeURIComponent(s3_code || '') +
		'&s4_code=' + encodeURIComponent(s4_code || '') +
		'&s5_code=' + encodeURIComponent(s5_code || '') +
		'&s6_code=' + encodeURIComponent(s6_code || '') +
		'&s7_code=' + encodeURIComponent(s7_code || '') +
		'&s8_code=' + encodeURIComponent(s8_code || '') +
		'&s9_code=' + encodeURIComponent(s9_code || '');
	
	// AJAX request with better error handling
	var xhr = new XMLHttpRequest();
	xhr.open('POST', window.location.href, true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.timeout = 10000; // 10 second timeout
	
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4) {
			if(xhr.status == 200) {
				console.log('AJAX Response received:', xhr.responseText);
				try {
					var response = JSON.parse(xhr.responseText);
					console.log('Parsed response:', response);
					if(response.success) {
						console.log('Groups found:', response.groups);
						console.log('Combinations found:', response.combinations);
						updateDropdowns(response);
						showSuccessMessage(response.message || 'Combinations updated successfully');
					} else {
						console.log('No success in response:', response);
						showErrorMessage('No matching combinations found');
						resetDropdowns();
					}
				} catch(e) {
					console.error('Error parsing AJAX response:', e);
					console.log('Raw response:', xhr.responseText);
					showErrorMessage('Error processing response');
					resetDropdowns();
				}
			} else {
				showErrorMessage('Server error: ' + xhr.status);
				resetDropdowns();
			}
		}
	};
	
	xhr.ontimeout = function() {
		showErrorMessage('Request timeout');
		resetDropdowns();
	};
	
	xhr.onerror = function() {
		showErrorMessage('Network error');
		resetDropdowns();
	};
	
	console.log('Sending AJAX request with params:', params);
	xhr.send(params);
}

function updateDropdowns(response) {
	// Update group input box
	var groupDisplay = document.getElementById('GroupDisplay');
	var groupHidden = document.getElementById('GroupId');
	
	if(response.groups && response.groups.length > 0 && response.detected_group) {
		// Find the detected group
		for(var i = 0; i < response.groups.length; i++) {
			if(response.detected_group == response.groups[i].SubjectGroupId) {
				groupDisplay.value = response.groups[i].GroupName;
				groupHidden.value = response.groups[i].SubjectGroupId;
				groupDisplay.style.backgroundColor = '#e8f5e8'; // Light green background
				break;
			}
		}
	} else {
		groupDisplay.value = 'No group detected';
		groupHidden.value = '';
		groupDisplay.style.backgroundColor = '#fff2cc'; // Light yellow background
	}
	
	// Update combination input box
	var combDisplay = document.getElementById('CombinationDisplay');
	var combHidden = document.getElementById('CombinationId');
	
	if(response.combinations && response.combinations.length > 0 && response.detected_combination) {
		// Find the detected combination
		for(var i = 0; i < response.combinations.length; i++) {
			if(response.detected_combination == response.combinations[i].Id) {
				combDisplay.value = response.combinations[i].Name;
				combHidden.value = response.combinations[i].Id;
				combDisplay.style.backgroundColor = '#e8f5e8'; // Light green background
				break;
			}
		}
		
		// Show success message if combination was auto-detected
		showSuccessMessage('Combination automatically detected: ' + combDisplay.value);
	} else {
		combDisplay.value = 'No combination detected';
		combHidden.value = '';
		combDisplay.style.backgroundColor = '#fff2cc'; // Light yellow background
	}
}

function resetDropdowns() {
	var groupDisplay = document.getElementById('GroupDisplay');
	var groupHidden = document.getElementById('GroupId');
	var combDisplay = document.getElementById('CombinationDisplay');
	var combHidden = document.getElementById('CombinationId');
	
	// Clear input values
	groupDisplay.value = '';
	groupHidden.value = '';
	combDisplay.value = '';
	combHidden.value = '';
	
	// Reset background colors
	groupDisplay.style.backgroundColor = '';
	combDisplay.style.backgroundColor = '';
}

function showSuccessMessage(message) {
	console.log('Success: ' + message);
	
	// Show success indicator on combination input box
	var combDisplay = document.getElementById('CombinationDisplay');
	if(combDisplay && combDisplay.value && combDisplay.value !== 'No combination detected') {
		combDisplay.style.borderColor = '#28a745';
		setTimeout(function() {
			combDisplay.style.borderColor = '';
		}, 3000);
		
		// Show success message in help text
		var helpDiv = document.querySelector('.combination-help');
		if(helpDiv) {
			var originalText = helpDiv.textContent;
			helpDiv.textContent = '✓ ' + message;
			helpDiv.style.color = '#28a745';
			setTimeout(function() {
				helpDiv.textContent = originalText;
				helpDiv.style.color = '#6c757d';
			}, 5000);
		}
	}
}

function showErrorMessage(message) {
	console.warn('Error: ' + message);
	
	// Show error indicator on combination dropdown
	var combSelect = document.getElementById('CombinationId');
	if(combSelect) {
		combSelect.style.borderColor = '#dc3545';
		combSelect.style.backgroundColor = '#fff5f5';
		setTimeout(function() {
			combSelect.style.borderColor = '';
			combSelect.style.backgroundColor = '';
		}, 3000);
		
		// Show error message in help text
		var helpDiv = document.querySelector('.combination-help');
		if(helpDiv) {
			var originalText = helpDiv.textContent;
			helpDiv.textContent = '⚠ ' + message;
			helpDiv.style.color = '#dc3545';
			setTimeout(function() {
				helpDiv.textContent = originalText;
				helpDiv.style.color = '#6c757d';
			}, 5000);
		}
	}
}

function check_submit_form()
{
	if(!Validate($(".form_container"))){ return false; }
}//check_submit_form

// Add some CSS for better visual feedback and keyboard shortcuts
document.addEventListener('DOMContentLoaded', function() {
	var style = document.createElement('style');
	style.textContent = `
		.loading-indicator {
			color: #007bff;
			font-style: italic;
		}
		.success-indicator {
			border-color: #28a745 !important;
			box-shadow: 0 0 5px rgba(40, 167, 69, 0.3);
		}
		.error-indicator {
			border-color: #dc3545 !important;
			box-shadow: 0 0 5px rgba(220, 53, 69, 0.3);
		}
		.auto-detect-btn {
			padding: 2px 8px;
			font-size: 11px;
			border-radius: 3px;
			border: 1px solid #ccc;
			background: #f8f9fa;
			cursor: pointer;
			vertical-align: top;
		}
		.auto-detect-btn:hover {
			background: #e9ecef;
		}
		.combination-help {
			font-size: 10px;
			color: #6c757d;
			margin-top: 2px;
		}
		.readonly-input {
			background-color: #f8f9fa !important;
			cursor: not-allowed;
			border: 1px solid #dee2e6;
			font-weight: 500;
		}
		.readonly-input:focus {
			outline: none;
			box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
		}
		.readonly-input[value*="detected"]:not([value*="No"]) {
			background-color: #e8f5e8 !important;
			border-color: #28a745;
		}
		.readonly-input[value*="No"][value*="detected"] {
			background-color: #fff2cc !important;
			border-color: #ffc107;
		}
	`;
	document.head.appendChild(style);
	
	// Add Chosen-compatible event listeners for auto-detection
	function setupChosenEventListeners() {
		// Wait a bit for Chosen to initialize
		setTimeout(function() {
			var subjectIds = ['Sub1_Code', 'Sub2_Code', 'Sub3_Code', 'Sub4_Code', 'Sub5_Code', 'Sub6_Code', 'Sub7_Code', 'Sub8_Code', 'Sub9_Code'];
			
			subjectIds.forEach(function(subjectId) {
				// Add jQuery event listener for Chosen change events
				if (typeof $ !== 'undefined') {
					$('#' + subjectId).on('change', function() {
						console.log(subjectId + ' changed via Chosen to:', this.value);
						autoDetectCombinationJS();
					});
				}
				
				// Also add native DOM event listener as fallback
				var element = document.getElementById(subjectId);
				if (element) {
					element.addEventListener('change', function() {
						console.log(subjectId + ' changed via native event to:', this.value);
						autoDetectCombinationJS();
					});
				}
			});
			
			// Run initial auto-detection if subjects are already selected on page load
			console.log('Running initial auto-detection...');
			setTimeout(function() {
				autoDetectCombinationJS();
			}, 500);
		}, 1000);
	}
	
	// Setup event listeners
	setupChosenEventListeners();
	
	// Add keyboard shortcut Ctrl+R to refresh combinations
	document.addEventListener('keydown', function(e) {
		if(e.ctrlKey && e.key === 'r') {
			e.preventDefault();
			refreshCombinations();
		}
	});
});
</script>
<!-- <script type="text/javascript" src="js/precord-updation09-.js"></script> -->