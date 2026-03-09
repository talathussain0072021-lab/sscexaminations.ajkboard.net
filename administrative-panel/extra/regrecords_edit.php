<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		// Fetch existing data from the database
		$sql = "SELECT Name, FatherName, DOB, CNIC, Gender FROM tbl_sscregistration WHERE RegNo='".$_REQUEST['RegNo']."'";
		$result = mysql_query($sql, $conn_sscreg);
		$row = mysql_fetch_assoc($result);
		
		// Initialize variables for updates and log messages
		$updateFields = []; $updateFields1 = []; $updateFields2 = [];
		$logMessages = []; $logMessages1 = []; $logMessages2 = [];
		
		// Compare new input with existing values and add to update if different
		if (!empty($_REQUEST['Name']) && strtoupper(trim($_REQUEST['Name'])) !== $row['Name']) {
			$name = strtoupper(trim($_REQUEST['Name']));
			$updateFields[] = "Name = '$name'"; $updateFields1[] = "NAME = '$name'"; $updateFields2[] = "NAME = '$name'";
			$logMessages[] = "Name Updated"; $logMessages1[] = "Name Updated"; $logMessages2[] = "Name Updated";
		}
		
		if (!empty($_REQUEST['FatherName']) && strtoupper(trim($_REQUEST['FatherName'])) !== $row['FatherName']) {
			$fatherName = strtoupper(trim($_REQUEST['FatherName']));
			$updateFields[] = "FatherName = '$fatherName'"; $updateFields1[] = "FNAME = '$fatherName'"; $updateFields2[] = "FNAME = '$fatherName'";
			$logMessages[] = "Father Name Updated"; $logMessages1[] = "Father Name Updated"; $logMessages2[] = "Father Name Updated";
		}
		
		if (!empty($_REQUEST['DOB']) && $_REQUEST['DOB'] !== $row['DOB']) {
			$dob = $_REQUEST['DOB'];
			$updateFields[] = "DOB = '$dob'"; $updateFields1[] = "DOB = '$dob'"; $updateFields2[] = "DOB = '$dob'";
			$logMessages[] = "DOB Updated"; $logMessages1[] = "DOB Updated"; $logMessages2[] = "DOB Updated";
		}
		
		if (trim($_REQUEST['CNIC']) !== $row['CNIC']) {
			$cnic = trim($_REQUEST['CNIC']);
			$updateFields[] = "CNIC = '$cnic'"; $updateFields1[] = "CNIC = '$cnic'";
			$logMessages[] = "CNIC Updated"; $logMessages1[] = "CNIC Updated";
		}
		
		if (!empty($_REQUEST['Gender']) && intval($_REQUEST['Gender']) !== intval($row['Gender'])) {
			$gender = intval($_REQUEST['Gender']);
			
			// Convert to MALE/FEMALE for tbl_resultpii
			$genderText = ($gender === 1 ? 'MALE' : 'FEMALE');
			
			$updateFields[] = "Gender = $gender"; $updateFields1[] = "Gender = '$genderText'"; $updateFields2[] = "GenderCode = $gender";
			$logMessages[] = "Gender Updated"; $logMessages1[] = "Gender Updated"; $logMessages2[] = "Gender Updated";
		}
		
		// Proceed only if there are changes to update
		if (!empty($updateFields)) {
			// Build the dynamic update query
			$updateQuery = "UPDATE tbl_sscregistration SET " . implode(", ", $updateFields) . " WHERE RegNo='".$_REQUEST['RegNo']."'";
			
			// Execute the update query
			if (mysql_query($updateQuery, $conn_sscreg)) {
				// Build the log message
				$logMsg = implode(", ", $logMessages) . " for ".$_REQUEST['RegNo']."";
				$logMsg1 = implode(", ", $logMessages1) . " for ".$_REQUEST['RegNo']."";
				$logMsg2 = implode(", ", $logMessages2) . " for ".$_REQUEST['RegNo']."";
				
				// Insert log entry
				$logQuery = "INSERT INTO tbl_sscreglog (ActivityType, ActivityDescription, ActivityRefNo, RegNo, StudentId, EmployeeId) 
							 VALUES ('RegRecordUpdation', '$logMsg', '".$_REQUEST['ActivityRefNo']."', '".$_REQUEST['RegNo']."', ".$_REQUEST['Id'].", ".$_SESSION['emp_id'].")";
				mysql_query($logQuery, $conn_sscreg);
				
				
				//--------------------------------
				//tbl_studentspi
				$sql_q1="SELECT Id FROM tbl_studentspi WHERE RegistrationNo='".$_REQUEST['RegNo']."'";
				$res_q1=mysql_query($sql_q1, $conn_sscreslt);
				$row_q1=mysql_fetch_assoc($res_q1);
				$num_rows_q1=mysql_num_rows($res_q1);
				if($num_rows_q1 > 0)
				{
					$updateQuery1 = "UPDATE tbl_studentspi SET " . implode(", ", $updateFields) . " WHERE RegistrationNo='".$_REQUEST['RegNo']."'";
					if (mysql_query($updateQuery1, $conn_sscreslt)) {
						$logQuery1 = "INSERT INTO tbl_resultlog (ActivityType, ActivityDescription, ActivityRefNo, RegNo, StudentId, EmployeeId) 
								 VALUES ('RecordUpdation-I', '$logMsg', '".$_REQUEST['ActivityRefNo']."', '".$_REQUEST['RegNo']."', ".$row_q1['Id'].", ".$_SESSION['emp_id'].")";
						mysql_query($logQuery1, $conn_sscreslt);
					}
				}//if($num_rows_q1 > 0)
				
				//tbl_resultpii
				$sql_q2="SELECT ID FROM tbl_resultpii WHERE REG_NO='".$_REQUEST['RegNo']."'";
				$res_q2=mysql_query($sql_q2, $conn_sscreslt);
				$row_q2=mysql_fetch_assoc($res_q2);
				$num_rows_q2=mysql_num_rows($res_q2);
				if($num_rows_q2 > 0)
				{
					$updateQuery2 = "UPDATE tbl_resultpii SET " . implode(", ", $updateFields1) . " WHERE REG_NO='".$_REQUEST['RegNo']."'";
					if (mysql_query($updateQuery2, $conn_sscreslt)) {
						$logQuery2 = "INSERT INTO tbl_resultlog (ActivityType, ActivityDescription, ActivityRefNo, RegNo, StudentId, EmployeeId) 
								 VALUES ('RecordUpdation-II', '$logMsg1', '".$_REQUEST['ActivityRefNo']."', '".$_REQUEST['RegNo']."', ".$row_q2['ID'].", ".$_SESSION['emp_id'].")";
						mysql_query($logQuery2, $conn_sscreslt);
					}
				}
				
				//sscresults
				$sql_q22="SELECT Is FROM sscresults WHERE RegNo ='".$_REQUEST['RegNo']."'";
				$res_q22=mysql_query($sql_q22, $conn_sscreslt);
				$row_q22=mysql_fetch_assoc($res_q22);
				$num_rows_q22=mysql_num_rows($res_q22);
				if($num_rows_q22 > 0)
				{
					$updateQuery22 = "UPDATE sscresults SET " . implode(", ", $updateFields2) . " WHERE RegNo='".$_REQUEST['RegNo']."'";
					if (mysql_query($updateQuery2, $conn_sscreslt)) {
						$logQuery22 = "INSERT INTO tbl_resultlog (ActivityType, ActivityDescription, ActivityRefNo, RegNo, StudentId, EmployeeId) 
								 VALUES ('RecordUpdation-II', '$logMsg2', '".$_REQUEST['ActivityRefNo']."', '".$_REQUEST['RegNo']."', ".$row_q22['Id'].", ".$_SESSION['emp_id'].")";
						mysql_query($logQuery22, $conn_sscreslt);
					}
				}
				
				
				//--------------------------------
				//matric_examination db updates
				$sql_q3="SELECT Id FROM students WHERE SSCRegNo='".$_REQUEST['RegNo']."' AND SSCBoard=1";
				$res_q3=mysql_query($sql_q3, $conn1);
				$row_q3=mysql_fetch_assoc($res_q3);
				$num_rows_q3=mysql_num_rows($res_q3);
				if($num_rows_q3 > 0)
				{
					$updateQuery3 = "UPDATE students SET " . implode(", ", $updateFields) . " WHERE Id=".$row_q3['Id']."";
					if (mysql_query($updateQuery3, $conn1)) {
						$logQuery3 = "INSERT INTO tbl_pilog (ActivityType, ActivityDescription, ActivityRefNo, StudentId, EmployeeId) 
								 VALUES ('RecordUpdation-I', '$logMsg', '".$_REQUEST['ActivityRefNo']."', ".$row_q3['Id'].", ".$_SESSION['emp_id'].")";
						mysql_query($logQuery3, $conn1);
					}
				}//if($num_rows_q3 > 0)
				
				$sql_q4="SELECT Id FROM students10 WHERE RegNo='".$_REQUEST['RegNo']."'";
				$res_q4=mysql_query($sql_q4, $conn1);
				$row_q4=mysql_fetch_assoc($res_q4);
				$num_rows_q4=mysql_num_rows($res_q4);
				if($num_rows_q4 > 0)
				{
					$updateQuery4 = "UPDATE students10 SET " . implode(", ", $updateFields) . " WHERE Id=".$row_q4['Id']."";
					if (mysql_query($updateQuery4, $conn1)) {
						$logQuery4 = "INSERT INTO tbl_piilog (ActivityType, ActivityDescription, ActivityRefNo, StudentId, EmployeeId) 
								 VALUES ('RecordUpdation-II', '$logMsg', '".$_REQUEST['ActivityRefNo']."', ".$row_q4['Id'].", ".$_SESSION['emp_id'].")";
						mysql_query($logQuery4, $conn1);
					}
				}//if($num_rows_q4 > 0)
				
				$sql_q5="SELECT Id FROM students09 WHERE RegNo='".$_REQUEST['RegNo']."'";
				$res_q5=mysql_query($sql_q5, $conn1);
				$row_q5=mysql_fetch_assoc($res_q5);
				$num_rows_q5=mysql_num_rows($res_q5);
				if($num_rows_q5 > 0)
				{
					$updateQuery5 = "UPDATE students09 SET " . implode(", ", $updateFields) . " WHERE Id=".$row_q5['Id']."";
					if (mysql_query($updateQuery5, $conn1)) {
						$logQuery5 = "INSERT INTO tbl_pislog (ActivityType, ActivityDescription, ActivityRefNo, StudentId, EmployeeId) 
								 VALUES ('RecordUpdation-Is', '$logMsg', '".$_REQUEST['ActivityRefNo']."', ".$row_q5['Id'].", ".$_SESSION['emp_id'].")";
						mysql_query($logQuery5, $conn1);
					}
				}//if($num_rows_q5 > 0)
				
			
				//--------------------------------
				//previous_examination db updates
				$sql_q3="SELECT Id FROM students WHERE SSCRegNo='".$_REQUEST['RegNo']."' AND SSCBoard=1";
				$res_q3=mysql_query($sql_q3, $conn_mep);
				$row_q3=mysql_fetch_assoc($res_q3);
				$num_rows_q3=mysql_num_rows($res_q3);
				if($num_rows_q3 > 0)
				{
					$updateQuery3 = "UPDATE students SET " . implode(", ", $updateFields) . " WHERE Id=".$row_q3['Id']."";
					if (mysql_query($updateQuery3, $conn_mep)) {
						$logQuery3 = "INSERT INTO tbl_pilog (ActivityType, ActivityDescription, ActivityRefNo, StudentId, EmployeeId) 
								 VALUES ('RecordUpdation-I', '$logMsg', '".$_REQUEST['ActivityRefNo']."', ".$row_q3['Id'].", ".$_SESSION['emp_id'].")";
						mysql_query($logQuery3, $conn_mep);
					}
				}//if($num_rows_q3 > 0)
				
				$sql_q4="SELECT Id FROM students10 WHERE (P1RegNo='".$_REQUEST['RegNo']."' AND P1Board=1) OR (PRegNo='".$_REQUEST['RegNo']."' AND PBoard=1)";
				$res_q4=mysql_query($sql_q4, $conn_mep);
				$row_q4=mysql_fetch_assoc($res_q4);
				$num_rows_q4=mysql_num_rows($res_q4);
				if($num_rows_q4 > 0)
				{
					$updateQuery4 = "UPDATE students10 SET " . implode(", ", $updateFields) . " WHERE Id=".$row_q4['Id']."";
					if (mysql_query($updateQuery4, $conn_mep)) {
						$logQuery4 = "INSERT INTO tbl_piilog (ActivityType, ActivityDescription, ActivityRefNo, StudentId, EmployeeId) 
								 VALUES ('RecordUpdation-II', '$logMsg', '".$_REQUEST['ActivityRefNo']."', ".$row_q4['Id'].", ".$_SESSION['emp_id'].")";
						mysql_query($logQuery4, $conn_mep);
					}
				}//if($num_rows_q4 > 0)
				
				$sql_q5="SELECT Id FROM students09 WHERE (P1RegNo='".$_REQUEST['RegNo']."' AND P1Board=1)";
				$res_q5=mysql_query($sql_q5, $conn_mep);
				$row_q5=mysql_fetch_assoc($res_q5);
				$num_rows_q5=mysql_num_rows($res_q5);
				if($num_rows_q5 > 0)
				{
					$updateQuery5 = "UPDATE students09 SET " . implode(", ", $updateFields) . " WHERE Id=".$row_q5['Id']."";
					if (mysql_query($updateQuery5, $conn_mep)) {
						$logQuery5 = "INSERT INTO tbl_pislog (ActivityType, ActivityDescription, ActivityRefNo, StudentId, EmployeeId) 
								 VALUES ('RecordUpdation-Is', '$logMsg', '".$_REQUEST['ActivityRefNo']."', ".$row_q5['Id'].", ".$_SESSION['emp_id'].")";
						mysql_query($logQuery5, $conn_mep);
					}
				}//if($num_rows_q5 > 0)
				
				?><script>alert('Information Updated Successfully.');location.replace('regrecords_all.php');</script><?php
			} else {
				?><script>alert('Error Updating Record.');location.replace('regrecords_all.php');</script><?php
			}
		} else {
			?><script>alert('No Changes Detected.');location.replace('regrecords_edit.php?RegNo=<?php echo $_REQUEST['RegNo'];?>');</script><?php
		}
	}
	?>
	<?php
	$sql="SELECT * FROM tbl_sscregistration WHERE RegNo='".$_REQUEST['RegNo']."'";
	$res=mysql_query($sql, $conn_sscreg);
	$row=mysql_fetch_assoc($res);
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Update Record</h6>
					</div>
					
					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();" enctype="multipart/form-data">
						<input name="Id" id="Id" type="hidden" value="<?php echo $row['Id'];?>">
							<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title">SSC RegNo<span class="req">*</span></label>
									<div class="form_input">
										<input name="RegNo" id="RegNo" type="text" value="<?php echo $row['RegNo'];?>" class="limiter" readonly/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Student Name<span class="req">*</span></label>
									<div class="form_input">
										<input name="Name" id="Name" type="text" value="<?php echo $row['Name'];?>" data-required="required" data-message="Enter Student Name" class="limiter" style="text-transform:uppercase;" maxlength="50" tabindex="1"/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Father's Name<span class="req">*</span></label>
									<div class="form_input">
										<input name="FatherName" id="FatherName" type="text" value="<?php echo $row['FatherName'];?>" data-required="required" data-message="Enter Father Name" class="limiter" style="text-transform:uppercase;" maxlength="50" tabindex="2"/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">DOB<span class="req">*</span></label>
									<div class="form_input">
										<input name="DOB" id="DOB" type="date" value="<?php echo $row['DOB'];?>" data-required="required" data-message="Choose DOB" class="limiter" tabindex="3"/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">CNIC</label>
									<div class="form_input">
										<input name="CNIC" id="CNIC" type="text" value="<?php echo $row['CNIC'];?>" class="limiter" maxlength="15" tabindex="4"/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Gender<span class="req">*</span></label>
									<div class="form_input">
										<select name="Gender" id="Gender" data-required="required" data-message="Choose Gender" class="chzn-select custom-select" tabindex="5"/>
										<option value="">Select</option>
										<option value="1" <?php echo (($row['Gender']==1)?'selected':'');?>>Male</option>
										<option value="2" <?php echo (($row['Gender']==2)?'selected':'');?>>Female</option>
										</select>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Letter No<span class="req">*</span></label>
									<div class="form_input">
										<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Enter Letter No" class="limiter" maxlength="50" tabindex="6"/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="7"><span>Update</span></button>
										<button type="reset" class="btn_small btn_blue" tabindex="8"><span>Reset</span></button>
									</div>
									<span class="clear"></span>
								</div>
								</li>
							</ul>
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php include('includes/footer.php');?>
<script>
function check_submit_form()
{
	if(!Validate($(".form_container"))){ return false; }
}//check_submit_form()
</script>