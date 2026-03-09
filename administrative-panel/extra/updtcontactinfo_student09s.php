<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['rsubmit']))
	{
		$sql="UPDATE students09 SET
		Domicile				=		".$_REQUEST['Domicile'].",
		OtherDomicile			=		'".$_REQUEST['OtherDomicile']."',
		PermanentAddress		=		'".$_REQUEST['PermanentAddress']."'
		WHERE Id				=		".$_REQUEST['Id']."";
		
		if(mysql_query($sql, $conn1))
		{
			$ins="INSERT INTO tbl_pislog SET
			ActivityType			=		'ContactInfoUpdation-Is',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			StudentId				=		".$_REQUEST['Id'].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn1);
			
			?><script>alert('Student Updated Successfully.');location.replace('allstudents_edit09s.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('updtcontactinfo_student09s.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
		}
	}
	else if(isset($_REQUEST['psubmit']))
	{
		$sql="UPDATE students09 SET
		Domicile				=		".$_REQUEST['Domicile'].",
		OtherDomicile			=		'".$_REQUEST['OtherDomicile']."',
		PostalAddress			=		'".$_REQUEST['PostalAddress']."',
		PermanentAddress		=		'".$_REQUEST['PermanentAddress']."',
		PostalDistrict			=		".$_REQUEST['PostalDistrict'].",
		PostalTehsil			=		".$_REQUEST['PostalTehsil'].",
		PostOffice				=		'".$_REQUEST['PostOffice']."',
		Phone					=		'".$_REQUEST['Phone']."',
		Mobile					=		'".$_REQUEST['Mobile']."',
		PrvExamDistrict			=		".$_REQUEST['PrvExamDistrict']."
		WHERE Id				=		".$_REQUEST['Id']."";
		
		if(mysql_query($sql, $conn1))
		{
			$ins="INSERT INTO tbl_pislog SET
			ActivityType			=		'ContactInfoUpdation-Is',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			StudentId				=		".$_REQUEST['Id'].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn1);
			
			?><script>alert('Student Updated Successfully.');location.replace('allstudents_edit09s.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('updtcontactinfo_student09s.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
		}
	}
	?>
	<?php
	$sql="SELECT Id, Name, FatherName, PostalAddress, PermanentAddress, PostOffice, Phone, Mobile, IsRegular FROM vwadmstudents09s WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Update Contact Info</h6>
					</div>

					<div class="widget_content">
						<?php if($row['IsRegular']==1){?>
						<form action="" method="post" class="form_container left_label" onSubmit="return check_rsubmit_form();" enctype="multipart/form-data">
							<ul>
								<li>
								<fieldset>
									<legend>Contact Info</legend>
									<ul>
										<li>
										<div class="form_grid_6">
											<label class="field_title">Student Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="Name" id="Name" type="text" value="<?php echo $row['Name'];?>" class="x_large" disabled/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Father's Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="FatherName" id="FatherName" type="text" value="<?php echo $row['FatherName'];?>" class="x_large" disabled/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Domicile<span class="req">*</span></label>
											<div class="form_input">
												<select name="Domicile" id="Domicile" data-required="required" data-message="Choose Domicile" class="chzn-select custom-select" tabindex="1">
												<option value="">Select</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Domicile(Other Case)</label>
											<div class="form_input">
												<input name="OtherDomicile" id="OtherDomicile" type="text" class="x_large" maxlength="50" tabindex="2" readonly/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Home Address<span class="req">*</span></label>
											<div class="form_input">
												<textarea name="PermanentAddress" id="PermanentAddress" class="input_grow" onkeypress="return isSpecialKey()" cols="50" rows="4" maxlength="120" tabindex="3"><?php echo $row['PermanentAddress'];?></textarea>
											</div>
										</div>
										<br /><br /><br /><br /><br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Letter No<span class="req">*</span></label>
											<div class="form_input">
												<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Letter No" class="x_large" maxlength="50" tabindex="4"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_12">
											<div class="form_input">
												<input type="hidden" name="Id" id="Id" value="<?php echo $_REQUEST['Id'];?>"/>
												<button type="submit" name="rsubmit" value="submit" class="btn_small btn_blue" tabindex="5"><span>Update</span></button>
												<button type="button" name="reset" class="btn_small btn_blue" onclick="location.replace('updtcontactinfo_student09s.php?Id=<?php echo $_REQUEST['Id'];?>')" tabindex="6"><span>Reset</span></button>
											</div>
										</div>
										</li>
									</ul>
								</fieldset>
								</li>
							</ul>
						</form>
						<?php }//if($row['IsRegular']==1)
						else if($row['IsRegular']==0){?>
						<form action="" method="post" class="form_container left_label" onSubmit="return check_psubmit_form();" enctype="multipart/form-data">
							<ul>
								<li>
								<fieldset>
									<legend>Contact Info</legend>
									<ul>
										<li>
										<div class="form_grid_6">
											<label class="field_title">Student Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="Name" id="Name" type="text" value="<?php echo $row['Name'];?>" class="x_large" disabled/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Father's Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="FatherName" id="FatherName" type="text" value="<?php echo $row['FatherName'];?>" class="x_large" disabled/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Domicile<span class="req">*</span></label>
											<div class="form_input">
												<select name="Domicile" id="Domicile" data-required="required" data-message="Choose Domicile" class="chzn-select custom-select" tabindex="1">
												<option value="">Select</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Domicile(Other Case)</label>
											<div class="form_input">
												<input name="OtherDomicile" id="OtherDomicile" type="text" class="x_large" maxlength="50" tabindex="2" readonly/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Postal Address<span class="req">*</span></label>
											<div class="form_input">
												<textarea name="PostalAddress" id="PostalAddress" data-required="required" data-message="Enter Postal Address" class="input_grow" onkeypress="return isSpecialKey()" cols="50" rows="4" maxlength="120" tabindex="3"><?php echo $row['PostalAddress'];?></textarea>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Permanent Address</label>
											<div class="form_input">
												<textarea name="PermanentAddress" id="PermanentAddress" class="input_grow" onkeypress="return isSpecialKey()" cols="50" rows="4" maxlength="120" tabindex="4"><?php echo $row['PermanentAddress'];?></textarea>
												<br /><input type="checkbox" name="checkbox1" id="checkbox1" value="1"/>Same as Postal Address
											</div>
										</div>
										<br /><br /><br /><br /><br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Postal District<span class="req">*</span></label>
											<div class="form_input">
												<select name="PostalDistrict" id="PostalDistrict" data-required="required" data-message="Choose Postal District" class="chzn-select custom-select" tabindex="5">
												<option value="">Select</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Postal Tehsil<span class="req">*</span></label>
											<div class="form_input">
												<select name="PostalTehsil" id="PostalTehsil" data-required="required" data-message="Choose Postal Tehsil" class="chzn-select custom-select" tabindex="6">
												<option value="">Select</option>
												</select>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Post Office<span class="req">*</span></label>
											<div class="form_input">
												<input name="PostOffice" id="PostOffice" type="text" value="<?php echo $row['PostOffice'];?>" class="limiter" maxlength="50" tabindex="7"/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Home Phone No<span class="req">*</span></label>
											<div class="form_input">
												<input name="Phone" id="Phone" type="text" value="<?php echo $row['Phone'];?>" data-required="required" data-message="Enter Home Phone No" class="x_large" onkeypress="return isNumber()" maxlength="11" tabindex="8"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Mobile No</label>
											<div class="form_input">
												<input name="Mobile" id="Mobile" type="text" value="<?php echo $row['Mobile'];?>" class="x_large" onkeypress="return isNumber()" maxlength="11" tabindex="9"/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Exam District<span class="req">*</span></label>
											<div class="form_input">
												<select name="PrvExamDistrict" id="PrvExamDistrict" data-required="required" data-message="Choose Exam District" class="chzn-select custom-select" tabindex="10">
												<option value="">Select</option>
												</select>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Letter No<span class="req">*</span></label>
											<div class="form_input">
												<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Letter No" class="x_large" maxlength="50" tabindex="11"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_12">
											<div class="form_input">
												<input type="hidden" name="Id" id="Id" value="<?php echo $_REQUEST['Id'];?>"/>
												<button type="submit" name="psubmit" value="submit" class="btn_small btn_blue" tabindex="12"><span>Update</span></button>
												<button type="button" name="reset" class="btn_small btn_blue" onclick="location.replace('updtcontactinfo_student09s.php?Id=<?php echo $_REQUEST['Id'];?>')" tabindex="13"><span>Reset</span></button>
											</div>
										</div>
										</li>
									</ul>
								</fieldset>
								</li>
							</ul>
						</form>
						<?php }//else if($row['IsRegular']==0)?>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php include('includes/footer.php');?>
<script>
function check_rsubmit_form()
{
	if(!Validate($(".form_container"))){ return false; }
}//check_rsubmit_form()
function check_psubmit_form()
{
	if(!Validate($(".form_container"))){ return false; }
}//check_psubmit_form()
</script>
<script type="text/javascript" src="js/record-updation09s.js"></script>