<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql="UPDATE students09 SET
		Name					=		'".strtoupper($_REQUEST['Name'])."',
		FatherName				=		'".strtoupper($_REQUEST['FatherName'])."',
		DOB						=		'".date('Y-m-d', strtotime($_REQUEST['DOB']))."',
		CNIC					=		'".$_REQUEST['CNIC']."',
		Gender					=		".$_REQUEST['Gender'].",
		Religion				=		".$_REQUEST['Religion'].",
		IdentityMarks			=		'".$_REQUEST['IdentityMarks']."',
		IsSpecial				=		".$_REQUEST['IsSpecial']."
		WHERE Id				=		".$_REQUEST['Id']."";
		
		if(mysql_query($sql, $conn1))
		{
			$ins="INSERT INTO tbl_pislog SET
			ActivityType			=		'PersonalInfoUpdation-Is',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			StudentId				=		".$_REQUEST['Id'].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn1);
			
			?><script>alert('Student Updated Successfully.');location.replace('allstudents_edit09s.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('updtpersonalinfo_student09s.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
		}
	}
	?>
	<?php
	$sql="SELECT Id, Name, FatherName, DOB, CNIC, Gender, Religion, IdentityMarks, IsSpecial, AdmCategory, SubCategory FROM vwadmstudents09s WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	$AdmSubCategory=$row['AdmCategory'].$row['SubCategory'];
	
	if($row['Gender'] == 1){ $GenderName='Male'; }
	else if($row['Gender'] == 2){ $GenderName='Female'; }
	else { $GenderName=''; }
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Update Personal Info</h6>
					</div>

					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();" enctype="multipart/form-data">
							<ul>
								<li>
								<fieldset>
									<legend>Personal Info</legend>
									<ul>
										<?php if($AdmSubCategory == '11'){?>
										<li>
										<div class="form_grid_6">
											<label class="field_title">Student Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="Name" id="Name" type="text" value="<?php echo $row['Name'];?>" data-required="required" data-message="Enter Student Name" class="x_large" style="text-transform:uppercase;" maxlength="50" tabindex="1" readonly/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Father's Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="FatherName" id="FatherName" type="text" value="<?php echo $row['FatherName'];?>" data-required="required" data-message="Enter Father Name" class="x_large" style="text-transform:uppercase;" maxlength="50" tabindex="2" readonly/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">DOB<span class="req">*</span></label>
											<div class="form_input">
												<input name="DOB" id="DOB" type="text" value="<?php echo date('d-m-Y',strtotime($row['DOB']));?>" data-required="required" data-message="Choose DOB" class="x_large" tabindex="3" readonly/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Student CNIC/Form B No<span class="req">*</span></label>
											<div class="form_input">
												<input name="CNIC" id="CNIC" type="text" value="<?php echo $row['CNIC'];?>" data-required="required"  data-message="Enter CNIC/Form B No" class="x_large" placeholder="xxxxx-xxxxxxx-x" maxlength="15" tabindex="4" readonly/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Gender<span class="req">*</span></label>
											<div class="form_input">
												<input type="text" value="<?php echo $GenderName;?>" class="x_large" tabindex="5" readonly/>
												<input name="Gender" id="Gender" type="hidden" value="<?php echo $row['Gender'];?>"/>
											</div>
										</div>
										<?php } else {?>
										<li>
										<div class="form_grid_6">
											<label class="field_title">Student Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="Name" id="Name" type="text" value="<?php echo $row['Name'];?>" data-required="required" data-message="Enter Student Name" class="x_large" style="text-transform:uppercase;" maxlength="50" tabindex="1"/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Father's Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="FatherName" id="FatherName" type="text" value="<?php echo $row['FatherName'];?>" data-required="required" data-message="Enter Father Name" class="x_large" style="text-transform:uppercase;" maxlength="50" tabindex="2"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">DOB<span class="req">*</span></label>
											<div class="form_input">
												<input name="DOB" id="DOB" type="text" value="<?php echo date('d-m-Y',strtotime($row['DOB']));?>" data-required="required" data-message="Choose DOB" class="x_large myDateofbirth" tabindex="3"/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Student CNIC/Form B No<span class="req">*</span></label>
											<div class="form_input">
												<input name="CNIC" id="CNIC" type="text" value="<?php echo $row['CNIC'];?>" data-required="required"  data-message="Enter CNIC/Form B No" class="x_large" placeholder="xxxxx-xxxxxxx-x" maxlength="15" tabindex="4"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Gender<span class="req">*</span></label>
											<div class="form_input">
												<select name="Gender" id="Gender" data-required="required" data-message="Choose Gender" class="chzn-select custom-select" tabindex="5">
												<option value="">Select</option>
												<option value="1" <?php echo (($row['Gender']==1)?'selected':'');?>>Male</option>
												<option value="2" <?php echo (($row['Gender']==2)?'selected':'');?>>Female</option>
												</select>
											</div>
										</div>
										<?php }?>
										<div class="form_grid_6">
											<label class="field_title">Religion<span class="req">*</span></label>
											<div class="form_input">
												<select name="Religion" id="Religion" data-required="required" data-message="Choose Religion" class="chzn-select custom-select" tabindex="6">
												<option value="">Select</option>
												<option value="1" <?php echo (($row['Religion']==1)?'selected':'');?>>Muslim</option>
												<option value="2" <?php echo (($row['Religion']==2)?'selected':'');?>>Non Muslim</option>
												</select>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Mark Of Identification</label>
											<div class="form_input">
												<input name="IdentityMarks" id="IdentityMarks" type="text" value="<?php echo $row['IdentityMarks'];?>" class="x_large" maxlength="100" tabindex="7"/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Category<span class="req">*</span></label>
											<div class="form_input">
												<select name="IsSpecial" id="IsSpecial" data-required="required" data-message="Choose Category" class="chzn-select custom-select" tabindex="8">
												<option value="3" <?php echo (($row['IsSpecial']==3)?'selected':'');?>>Normal Case</option>
												<option value="1" <?php echo (($row['IsSpecial']==1)?'selected':'');?>>Board Employee's Child</option>
												<option value="2" <?php echo (($row['IsSpecial']==2)?'selected':'');?>>Refugee's Child</option>
												<option value="4" <?php echo (($row['IsSpecial']==4)?'selected':'');?>>Special Student</option>
												<option value="5" <?php echo (($row['IsSpecial']==5)?'selected':'');?>>Orphan Student</option>
												</select>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Letter No<span class="req">*</span></label>
											<div class="form_input">
												<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Letter No" class="x_large" maxlength="50" tabindex="9"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_12">
											<div class="form_input">
												<input type="hidden" name="Id" id="Id" value="<?php echo $_REQUEST['Id'];?>"/>
												<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="10"><span>Update</span></button>
												<button type="button" name="reset" class="btn_small btn_blue" onclick="location.replace('updtpersonalinfo_student09s.php?Id=<?php echo $_REQUEST['Id'];?>')" tabindex="11"><span>Reset</span></button>
											</div>
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
	var DOB=document.getElementById('DOB').value;
	var DOBDate = new Date(DOB.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3"));
	var DOBTime = DOBDate.getTime();
	var ThresholdDate = new Date("<?php echo $P2DOBThreshold;?>");
	var ThresholdTime = ThresholdDate.getTime();
	var CNIC=document.getElementById('CNIC').value;
	
	if(!Validate($(".form_container"))){ return false; }
	if(DOBTime > ThresholdTime){ alert('Choose Date of Birth Again'); document.getElementById('DOB').focus(); return false; }
	if(CNIC.length < 15){ alert('CNIC/Form B No is Incomplete'); document.getElementById('CNIC').focus(); return false; }
}//check_submit_form()
</script>