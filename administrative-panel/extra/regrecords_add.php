<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql_q1="SELECT Id FROM tbl_sscregistration WHERE RegNo='".$_REQUEST['RegNo']."'";
		$res_q1=mysql_query($sql_q1, $conn_sscreg);
		$num_rows_q1=mysql_num_rows($res_q1);
		if($num_rows_q1 == 0)
		{
			$RegInst=explode('@',$_REQUEST['RegInst']);
			$RegSession=explode('@',$_REQUEST['RegSession']);
			
			$sql_1="SELECT Id, Name, GroupName FROM vwsubcombinations09 WHERE Id=".$_REQUEST['CombinationId']."";
			$res_1=mysql_query($sql_1, $conn1);
			$row_1=mysql_fetch_array($res_1);
			
			$sql_2="SELECT Id, Name FROM institutes WHERE Id=".$RegInst['0']."";
			$res_2=mysql_query($sql_2, $conn1);
			$row_2=mysql_fetch_array($res_2);
			
			//echo "<script>alert('".$RegInst['1']."'); alert('".$row_2['Name']."'); alert('".$row_1['GroupName']."'); alert('".$row_1['Name']."');</script>";
			
			$sql="INSERT INTO tbl_sscregistration SET
			RegYear				=	'".$_REQUEST['RegYear']."',
			RegSessionId		=	".$RegSession['0'].",
			RegSessionName		=	'".$RegSession['1']."',
			RegInstId			=	".$RegInst['0'].",
			RegInstCode			=	'".$RegInst['1']."',
			RegInstName			=	'".$row_2['Name']."',
			RegSr				=	'".$_REQUEST['RegSr']."',
			RegNo				=	'".$_REQUEST['RegNo']."',
			Name				=	'".strtoupper($_REQUEST['Name'])."',
			FatherName			=	'".strtoupper($_REQUEST['FatherName'])."',
			DOB 				=   '".$_REQUEST['DOB']."',
			CNIC				=	'".$_REQUEST['CNIC']."',
			Gender				=	".$_REQUEST['Gender'].",
			Religion			=	".$_REQUEST['Religion'].",
			IsSpecial			=	".$_REQUEST['IsSpecial'].",
			GroupId				=	".$_REQUEST['GroupId'].",
			GroupName			=	'".$row_1['GroupName']."',
			CombinationId		=	".$_REQUEST['CombinationId'].",
			CombinationName		=	'".$row_1['Name']."'";
			
			if(mysql_query($sql, $conn_sscreg))
			{
				$sql_q1="SELECT Id FROM tbl_sscregistration WHERE RegNo='".$_REQUEST['RegNo']."'";
				$res_q1=mysql_query($sql_q1, $conn_sscreg);
				$row_q1=mysql_fetch_array($res_q1);
				
				$ins="INSERT INTO tbl_sscreglog SET
				ActivityType			=		'RegRecordInsertion',
				ActivityDescription		=		'Record Added for ".$_REQUEST['RegNo']."',
				ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
				RegNo					=		'".$_REQUEST['RegNo']."',
				StudentId				=		".$row_q1['Id'].",
				EmployeeId				=		".$_SESSION['emp_id']."";
				$res=mysql_query($ins, $conn_sscreg);
				
				?><script>alert('Student Inserted Successfully.');location.replace('regrecords_all.php');</script><?php
			}
			else
			{
				?><script>alert('Error in Query.');location.replace('regrecords_add.php');</script><?php
			}
		}//if($num_rows_q1 == 0)
		else
		{
			?><script>alert('RegNo Already Exists in Database.');location.replace('regrecords_add.php');</script><?php
		}
	}
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Add Record</h6>
					</div>

					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();">
							<ul>
								<li>
								<fieldset>
									<legend>Record Info</legend>
									<ul>
										<li>
										<div class="form_grid_6">
											<label class="field_title">Reg Year<span class="req">*</span></label>
											<div class="form_input">
												<input name="RegYear" id="RegYear" type="text" data-required="required" data-message="Enter RegYear" class="x_large" onkeypress="return isNumber()" maxlength="2" tabindex="1"/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Reg Session<span class="req">*</span></label>
											<div class="form_input">
												<select name="RegSession" id="RegSession" data-required="required" data-message="Choose RegSession" class="chzn-select custom-select" tabindex="2">
												<option value="">Select</option>
												<?php
												$sql_sess="SELECT Id, Name FROM sessions ORDER BY Id ASC";
												$res_sess=mysql_query($sql_sess, $conn1);
												while($row_sess=mysql_fetch_array($res_sess))								
												{
													echo '<option value='.$row_sess['Id'].'@'.$row_sess['Name'].'>'.$row_sess['Name'].'</option>';
												}
												?>
												</select>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Reg Institute<span class="req">*</span></label>
											<div class="form_input">
												<select name="RegInst" id="RegInst" data-required="required" data-message="Choose RegInst" class="chzn-select custom-select" tabindex="3">
												<option value="">Select</option>
												<?php
												$sql_inst="SELECT Id, Code, Name FROM institutes WHERE IsActive=1 ORDER BY Code ASC";
												$res_inst=mysql_query($sql_inst, $conn1);
												while($row_inst=mysql_fetch_array($res_inst))								
												{
													echo '<option value='.$row_inst['Id'].'@'.$row_inst['Code'].'@'.$row_inst['Name'].'>'.$row_inst['Code'].'</option>';
												}
												?>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Reg Sr<span class="req">*</span></label>
											<div class="form_input">
												<input name="RegSr" id="RegSr" type="text" data-required="required" data-message="Enter RegSr" class="x_large" onkeypress="return isNumber()" maxlength="4" tabindex="4"/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">RegNo<span class="req">*</span></label>
											<div class="form_input">
												<input name="RegNo" id="RegNo" type="text" data-required="required" data-message="Enter RegNo" class="x_large"  maxlength="11" tabindex="5"/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Student Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="Name" id="Name" type="text" data-required="required" data-message="Enter Student Name" class="x_large" style="text-transform:uppercase;" maxlength="50" tabindex="6"/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Father's Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="FatherName" id="FatherName" type="text" data-required="required" data-message="Enter Father Name" class="x_large" style="text-transform:uppercase;" maxlength="50" tabindex="7"/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">DOB<span class="req">*</span></label>
											<div class="form_input">
												<input name="DOB" id="DOB" type="date" data-required="required" data-message="Choose DOB" class="x_large" tabindex="8"/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">CNIC<span class="req">*</span></label>
											<div class="form_input">
												<input name="CNIC" id="CNIC" type="text" data-required="required" data-message="Enter CNIC/Form B No" class="x_large" placeholder="xxxxx-xxxxxxx-x" maxlength="15" tabindex="9"/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Gender<span class="req">*</span></label>
											<div class="form_input">
												<select name="Gender" id="Gender" data-required="required" data-message="Choose Gender" class="chzn-select custom-select" tabindex="10">
												<option value="">Select</option>
												<option value="1">Male</option>
												<option value="2">Female</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Religion<span class="req">*</span></label>
											<div class="form_input">
												<select name="Religion" id="Religion" data-required="required" data-message="Choose Religion" class="chzn-select custom-select" tabindex="11">
												<option value="">Select</option>
												<option value="1">Muslim</option>
												<option value="2">Non Muslim</option>
												</select>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Category<span class="req">*</span></label>
											<div class="form_input">
												<select name="IsSpecial" id="IsSpecial" data-required="required" data-message="Choose Category" class="chzn-select custom-selectxsm" tabindex="12">
												<option value="3">Normal Case</option>
												<option value="1">Board Employee's Child</option>
												<option value="2">Refugee's Child</option>
												<option value="4">Special Student</option>
												<option value="5">Orphan Student</option>
												</select>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Group<span class="req">*</span></label>
											<div class="form_input">
												<select name="GroupId" id="GroupId" data-required="required" data-message="Choose Group" class="chzn-select custom-select" tabindex="14">
												<option value="">Select</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Combination<span class="req">*</span></label>
											<div class="form_input">
												<select name="CombinationId" id="CombinationId" data-required="required" data-message="Choose Combination" class="chzn-select custom-select" tabindex="15">
												<option value="">Select</option>
												</select>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Letter No<span class="req">*</span></label>
											<div class="form_input">
												<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Letter No" class="x_large" maxlength="50" tabindex="16"/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_12">
											<div class="form_input">
												<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="17"><span>Submit</span></button>
												<button type="reset" class="btn_small btn_blue" onclick="location.replace('allrecords10_add.php')" tabindex="18"><span>Reset</span></button>
											</div>
											<span class="clear"></span>
										</div>
										</li>
									</ul>
								</fieldset>
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
}//check_submit_form
</script>
<script type="text/javascript" src="js/precord-insertion10.js"></script>