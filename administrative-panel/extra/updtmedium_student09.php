<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql="UPDATE students SET
		Medium3				=		".$_REQUEST['Medium3'].",
		Medium4				=		".$_REQUEST['Medium4'].",
		Medium5				=		".$_REQUEST['Medium5'].",
		Medium6				=		".$_REQUEST['Medium6'].",
		Medium7				=		".$_REQUEST['Medium7'].",
		Medium8				=		".$_REQUEST['Medium8']."
		WHERE Id			=		".$_REQUEST['Id']."";
		
		if(mysql_query($sql, $conn1))
		{
			$ins="INSERT INTO tbl_pilog SET
			ActivityType			=		'MediumUpdation-I',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			StudentId				=		".$_REQUEST['Id'].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn1);
			
			?><script>alert('Student Updated Successfully.');location.replace('allstudents_edit09.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('updtmedium_student09.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
		}
	}
	?>
	<?php
	$sql="SELECT Id, Name, FatherName, GroupId, CombinationId, Medium3, Medium4, Medium5, Medium6, Medium7, Medium8 FROM vwregstudents WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Update Medium</h6>
					</div>

					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();" enctype="multipart/form-data">
							<ul>
								<li>
								<fieldset>
									<legend>Medium Info</legend>
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
											<label class="field_title">Group<span class="req">*</span></label>
											<div class="form_input">
												<select name="GroupId" id="GroupId" data-placeholder="Select Group" class="chzn-select custom-select" disabled>
												<option value="">Select</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Combination<span class="req">*</span></label>
											<div class="form_input">
												<select name="CombinationId" id="CombinationId" data-placeholder="Select Combination" class="chzn-select custom-select" disabled>
												<option value="">Select</option>
												</select>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<fieldset>
											<legend>All Subjects</legend>
											<ul>
												<li>
												<div class="form_grid_6">
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<span class="input_instruction green">Subject Name</span>
														</div>
														<div class="form_grid_6">
															<span class="input_instruction green">Choose Medium</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<span class="input_instruction green">Subject Name</span>
														</div>
														<div class="form_grid_6">
															<span class="input_instruction green">Choose Medium</span>
														</div>
													</div>
												</div>
												<br />
												</li>
												
												<li>
												<div class="form_grid_6">
													<label class="field_title">Subject 3</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject3" id="Subject3" type="text" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Medium3" id="Medium3" class="radio" type="radio" value="1" tabindex="1" <?php echo (($row['Medium3']==1)?'checked':'');?>/>
															<label class="choice">Urdu</label>
															</span>
															<span>
															<input name="Medium3" id="Medium3" class="radio" type="radio" value="2" tabindex="2" <?php echo (($row['Medium3']==2)?'checked':'');?>/>
															<label class="choice">English</label>
															</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 4</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject4" id="Subject4" type="text" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Medium4" id="Medium4" class="radio" type="radio" value="1" tabindex="3" <?php echo (($row['Medium4']==1)?'checked':'');?>/>
															<label class="choice">Urdu</label>
															</span>
															<span>
															<input name="Medium4" id="Medium4" class="radio" type="radio" value="2" tabindex="4" <?php echo (($row['Medium4']==2)?'checked':'');?>/>
															<label class="choice">English</label>
															</span>
														</div>
													</div>
												</div>
												<br /><br /><br />
												</li>
												
												<li>
												<div class="form_grid_6">
													<label class="field_title">Subject 5</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject5" id="Subject5" type="text" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Medium5" id="Medium5" class="radio" type="radio" value="1" tabindex="5" <?php echo (($row['Medium5']==1)?'checked':'');?>/>
															<label class="choice">Urdu</label>
															</span>
															<span>
															<input name="Medium5" id="Medium5" class="radio" type="radio" value="2" tabindex="6" <?php echo (($row['Medium5']==2)?'checked':'');?>/>
															<label class="choice">English</label>
															</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 6</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject6" id="Subject6" type="text" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Medium6" id="Medium6" class="radio" type="radio" value="1" tabindex="7" <?php echo (($row['Medium6']==1)?'checked':'');?>/>
															<label class="choice">Urdu</label>
															</span>
															<span>
															<input name="Medium6" id="Medium6" class="radio" type="radio" value="2" tabindex="8" <?php echo (($row['Medium6']==2)?'checked':'');?>/>
															<label class="choice">English</label>
															</span>
														</div>
													</div>
												</div>
												<br /><br /><br />
												</li>
												
												<li>
												<div class="form_grid_6">
													<label class="field_title">Subject 7</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject7" id="Subject7" type="text" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Medium7" id="Medium7" class="radio" type="radio" value="1" tabindex="9" <?php echo (($row['Medium7']==1)?'checked':'');?>/>
															<label class="choice">Urdu</label>
															</span>
															<span>
															<input name="Medium7" id="Medium7" class="radio" type="radio" value="2" tabindex="10" <?php echo (($row['Medium7']==2)?'checked':'');?>/>
															<label class="choice">English</label>
															</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 8</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject8" id="Subject8" type="text" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Medium8" id="Medium8" class="radio" type="radio" value="1" tabindex="11" <?php echo (($row['Medium8']==1)?'checked':'');?>/>
															<label class="choice">Urdu</label>
															</span>
															<span>
															<input name="Medium8" id="Medium8" class="radio" type="radio" value="2" tabindex="12" <?php echo (($row['Medium8']==2)?'checked':'');?>/>
															<label class="choice">English</label>
															</span>
														</div>
													</div>
												</div>
												<br /><br /><br />
												</li>
											</ul>
										</fieldset>
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Letter No<span class="req">*</span></label>
											<div class="form_input">
												<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Letter No" class="x_large" maxlength="50" tabindex="13"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_12">
											<div class="form_input">
												<input type="hidden" name="Id" id="Id" value="<?php echo $_REQUEST['Id'];?>"/>
												<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="14"><span>Update</span></button>
												<button type="button" name="reset" class="btn_small btn_blue" onclick="location.replace('updtmedium_student09.php?Id=<?php echo $_REQUEST['Id'];?>')" tabindex="15"><span>Reset</span></button>
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
	if(!Validate($(".form_container"))){ return false; }
}//check_submit_form()
</script>
<script type="text/javascript" src="js/record-updation09n.js"></script>