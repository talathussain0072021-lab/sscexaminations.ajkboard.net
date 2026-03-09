<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql1="SELECT * FROM sessions WHERE Name='".$_REQUEST['Name']."'";
		$res1=mysql_query($sql1, $conn1);
		$no_row1=mysql_num_rows($res1);
		
		if($no_row1 > 0)
		{ echo "<script>"; echo "alert('Name already exists.')"; echo "</script>"; }
		else
		{
			if($_REQUEST['IsCurrent'] == 1)
			{
				$sql="UPDATE sessions SET IsCurrent=0";
				$res=mysql_query($sql, $conn1);
			}
			
			$sql="INSERT INTO sessions SET
			Name			=		'".$_REQUEST['Name']."',
			FromDate		=		'".$_REQUEST['FromDate']."',
			ToDate			=		'".$_REQUEST['ToDate']."',
			IsCurrent		=		".$_REQUEST['IsCurrent'].",
			ProcessingFee	=		".$_REQUEST['ProcessingFee'].",
			RegistrationFee	=		".$_REQUEST['RegistrationFee'].",
			CertificateFee	=		".$_REQUEST['CertificateFee'].",
			ScholarshipFee	=		".$_REQUEST['ScholarshipFee'].",
			MigFeeNormal	=		".$_REQUEST['MigFeeNormal'].",
			MigFeeUrgent	=		".$_REQUEST['MigFeeUrgent'].",
			NOCFee			=		".$_REQUEST['NOCFee'].",
			ReFeeConstant	=		".$_REQUEST['ReFeeConstant'].",
			P1DOBThreshold	=		'".$_REQUEST['P1DOBThreshold']."',
			P2DOBThreshold	=		'".$_REQUEST['P2DOBThreshold']."'";
			
			if(mysql_query($sql, $conn1))
			{
				?><script>location.replace('sessions.php?message=Data Inserted Successfully.');</script><?php
			}
			else
			{
				?><script>alert('Error in Query.');location.replace('sessions_add.php');</script><?php
			}
		}
	}
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						<h6>Add Session</h6>
					</div>
					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();">
							<ul>
								<li>
								<div class="form_grid_6">
									<label class="field_title">Name<span class="req">*</span></label>
									<div class="form_input">
										<input name="Name" id="Name" type="text" data-required="required" data-message="Enter Name" class="x_large" maxlength="50" tabindex="1"/>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">From Date<span class="req">*</span></label>
									<div class="form_input">
										<input name="FromDate" id="FromDate" type="date" data-required="required" data-message="Choose From Date" class="x_large" tabindex="2"/>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">To Date<span class="req">*</span></label>
									<div class="form_input">
										<input name="ToDate" id="ToDate" type="date" data-required="required" data-message="Choose To Date" class="x_large" tabindex="3"/>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">IsCurrent<span class="req">*</span></label>
									<div class="form_input">
										<select name="IsCurrent" id="IsCurrent" data-required="required" data-message="Choose IsCurrent Status" class="chzn-select custom-select" tabindex="4">
										<option value="">Select</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
										</select>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">DOB-I Threshold<span class="req">*</span></label>
									<div class="form_input">
										<input name="P1DOBThreshold" id="P1DOBThreshold" type="date" data-required="required" data-message="Choose DOB-I Threshold" class="x_large" tabindex="5"/>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">DOB-II Threshold<span class="req">*</span></label>
									<div class="form_input">
										<input name="P2DOBThreshold" id="P2DOBThreshold" type="date" data-required="required" data-message="Choose DOB-II Threshold" class="x_large" tabindex="6"/>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">Processing Fee<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<input name="ProcessingFee" id="ProcessingFee" type="text" data-required="required" data-message="Enter Processing Fee" class="x_large" maxlength="10" onkeypress="return isNumberKey(event)" tabindex="7"/>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Registration Fee<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<input name="RegistrationFee" id="RegistrationFee" type="text" data-required="required" data-message="Enter Registration Fee" class="x_large" maxlength="10" onkeypress="return isNumberKey(event)" tabindex="8"/>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">Certificate Fee<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<input name="CertificateFee" id="CertificateFee" type="text" data-required="required" data-message="Enter Certificate Fee" class="x_large" maxlength="10" onkeypress="return isNumberKey(event)" tabindex="9"/>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Scholarship Fee<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<input name="ScholarshipFee" id="ScholarshipFee" type="text" data-required="required" data-message="Enter Scholarship Fee" class="x_large" maxlength="10" onkeypress="return isNumberKey(event)" tabindex="10"/>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">Migration Fee (Normal)<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<input name="MigFeeNormal" id="MigFeeNormal" type="text" data-required="required" data-message="Enter Migration Fee (Normal)" class="x_large" maxlength="10" onkeypress="return isNumberKey(event)" tabindex="11"/>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Migration Fee (Urgent)<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<input name="MigFeeUrgent" id="MigFeeUrgent" type="text" data-required="required" data-message="Enter Migration Fee (Normal)" class="x_large" maxlength="10" onkeypress="return isNumberKey(event)" tabindex="12"/>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">NOC Fee<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<input name="NOCFee" id="NOCFee" type="text" data-required="required" data-message="Enter NOC Fee" class="x_large" maxlength="10" onkeypress="return isNumberKey(event)" tabindex="13"/>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">ReAdmFee Phase<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<select name="ReFeeConstant" id="ReFeeConstant" data-required="required" data-message="Choose ReFeeConstant" class="chzn-select custom-select" tabindex="14">
										<option value="">Select</option>
										<option value="1">Phase1</option>
										<option value="2">Phase2</option>
										<option value="3">Phase3</option>
										<option value="4">Phase4</option>
										<option value="5">Phase5</option>
										<option value="6">Phase6</option>
										<option value="7">Phase7</option>
										<option value="8">Phase8</option>
										<option value="9">Phase9</option>
										<option value="10">Phase10</option>
										<option value="11">Phase11</option>
										<option value="12">Phase12</option>
										<option value="13">Phase13</option>
										<option value="14">Phase14</option>
										<option value="15">Phase15</option>
										</select>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="15"><span>Submit</span></button>
										<button type="reset" class="btn_small btn_blue" tabindex="16"><span>Reset</span></button>
									</div>
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
	
	var FromDate=document.getElementById('FromDate').value;
	var ToDate=document.getElementById('ToDate').value;
	
	if(ToDate <= FromDate){ alert('Choose Dates again'); document.getElementById('ToDate').focus(); return false; }
}//check_submit_form()
</script>