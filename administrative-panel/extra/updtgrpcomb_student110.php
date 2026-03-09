<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql="UPDATE students10 SET
		GroupId				=		".$_REQUEST['GroupId'].",
		CombinationId		=		".$_REQUEST['CombinationId'].",
		Sub1Code			=		'".$_REQUEST['Sub1Checkbox']."',
		Sub2Code			=		'".$_REQUEST['Sub2Checkbox']."',
		Sub3Code			=		'".$_REQUEST['Sub3Checkbox']."',
		Sub4Code			=		'".$_REQUEST['Sub4Checkbox']."',
		Sub5Code			=		'".$_REQUEST['Sub5Checkbox']."',
		Sub6Code			=		'".$_REQUEST['Sub6Checkbox']."',
		Sub7Code			=		'".$_REQUEST['Sub7Checkbox']."',
		Sub8Code			=		'".$_REQUEST['Sub8Checkbox']."',
		Sub9Code			=		'".$_REQUEST['Sub9Checkbox']."',
		Sub21Code			=		'".$_REQUEST['Sub21Checkbox']."',
		Sub22Code			=		'".$_REQUEST['Sub22Checkbox']."',
		Sub23Code			=		'".$_REQUEST['Sub23Checkbox']."',
		Sub24Code			=		'".$_REQUEST['Sub24Checkbox']."',
		Sub25Code			=		'".$_REQUEST['Sub25Checkbox']."',
		Sub26Code			=		'".$_REQUEST['Sub26Checkbox']."',
		Sub27Code			=		'".$_REQUEST['Sub27Checkbox']."',
		Sub28Code			=		'".$_REQUEST['Sub28Checkbox']."',
		Sub29Code			=		'".$_REQUEST['Sub29Checkbox']."',
		Sub26PCode 			=		'".$_REQUEST['Sub26Checkboxp']."',
		Sub27PCode 			=		'".$_REQUEST['Sub27Checkboxp']."',
		Sub28PCode 			=		'".$_REQUEST['Sub28Checkboxp']."'
		WHERE Id			=		".$_REQUEST['Id']."";
		
		if(mysql_query($sql, $conn1))
		{
			$ins="INSERT INTO tbl_piilog SET
			ActivityType			=		'GrpSubjUpdation-II',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			StudentId				=		".$_REQUEST['Id'].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn1);
			
			?><script>alert('Student Updated Successfully.');location.replace('allstudents_edit10.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('updtgrpcomb_student110.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
		}
	}
	?>
	<?php
	$sql="SELECT Id, Name, FatherName, GroupId, CombinationId, AdmCategory FROM vwadmstudents10 WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	
	if($row['AdmCategory'] == 1){ $AdmCategory='First Time'; }
	else if($row['AdmCategory'] == 3){ $AdmCategory='For Improving Result'; }
	else if($row['AdmCategory'] == 4){ $AdmCategory='In Additional Subject(s)'; }
	else if($row['AdmCategory'] == 5){ $AdmCategory='After Complete Failure'; }
	else if($row['AdmCategory'] == 6){ $AdmCategory='As A Compartment Case'; }
	else if($row['AdmCategory'] == 7){ $AdmCategory='After Passing Adeeb/Alam/Fazal'; }
	else if($row['AdmCategory'] == 9){ $AdmCategory='After Passing Shahadat Sanvia/Aama/Khasa'; }
	else { $AdmCategory=''; }
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Update Group/Combination</h6>
					</div>

					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();" enctype="multipart/form-data">
							<ul>
								<li>
								<fieldset>
									<legend>Group/Combination Info</legend>
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
											<label class="field_title">Adm Category<span class="req">*</span></label>
											<div class="form_input">
												<input name="AdmCategory" id="AdmCategory" type="text" value="<?php echo $AdmCategory;?>" class="x_large" disabled/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Group<span class="req">*</span></label>
											<div class="form_input">
												<select name="GroupId" id="GroupId" data-required="required" data-message="Choose Group" class="chzn-select custom-select" tabindex="1">
												<option value="">Select</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Combination<span class="req">*</span></label>
											<div class="form_input">
												<select name="CombinationId" id="CombinationId" data-required="required" data-message="Choose Combination" class="chzn-select custom-select" tabindex="2">
												<option value="">Select</option>
												</select>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<div id="tbl-subjects">
										<li>
										<fieldset>
											<legend>All Subjects</legend>
											<ul>
												<li>
												<div class="form_grid_6">
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<span class="input_instruction green">First Year Subjects</span>
														</div>
														<div class="form_grid_6">
															<span class="input_instruction green">Choose Subject</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<span class="input_instruction green">Second Year Subjects</span>
														</div>
														<div class="form_grid_3">
															<span class="input_instruction green">Choose Subject</span>
														</div>
														<div class="form_grid_3">
															<span class="input_instruction green">Choose Practical</span>
														</div>
													</div>
												</div>
												<br />
												</li>
												
												<li>
												<div class="form_grid_6">
													<label class="field_title">Subject 1</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject1" id="Subject1" type="text" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Sub1Checkbox" id="Sub1Checkbox" type="checkbox"/>
															</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 1</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject21" id="Subject21" type="text" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Sub21Checkbox" id="Sub21Checkbox" type="checkbox"/>
															</span>
														</div>
													</div>
												</div>
												<br /><br /><br />
												</li>
												
												<li>
												<div class="form_grid_6">
													<label class="field_title">Subject 2</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject2" id="Subject2" type="text" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Sub2Checkbox" id="Sub2Checkbox" type="checkbox"/>
															</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 2</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject22" id="Subject22" type="text" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Sub22Checkbox" id="Sub22Checkbox" type="checkbox"/>
															</span>
														</div>
													</div>
												</div>
												<br /><br /><br />
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
															<input name="Sub3Checkbox" id="Sub3Checkbox" type="checkbox"/>
															</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 3</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject23" id="Subject23" type="text" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Sub23Checkbox" id="Sub23Checkbox" type="checkbox"/>
															</span>
														</div>
													</div>
												</div>
												<br /><br /><br />
												</li>
												
												<li>
												<div class="form_grid_6">
													<label class="field_title">Subject 4</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject4" id="Subject4" type="text" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Sub4Checkbox" id="Sub4Checkbox" type="checkbox"/>
															</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 4</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject24" id="Subject24" type="text" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Sub24Checkbox" id="Sub24Checkbox" type="checkbox"/>
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
															<input name="Sub5Checkbox" id="Sub5Checkbox" type="checkbox"/>
															</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 5</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject25" id="Subject25" type="text" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Sub25Checkbox" id="Sub25Checkbox" type="checkbox"/>
															</span>
														</div>
													</div>
												</div>
												<br /><br /><br />
												</li>
												
												<li>
												<div class="form_grid_6">
													<label class="field_title">Subject 6</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject6" id="Subject6" type="text" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Sub6Checkbox" id="Sub6Checkbox" type="checkbox"/>
															</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 6</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject26" id="Subject26" type="text" class="full" disabled/>
														</div>
														<div class="form_grid_3">
															<span>
															<input name="Sub26Checkbox" id="Sub26Checkbox" type="checkbox"/>
															</span>
														</div>
														<div class="form_grid_3">
															<input name="Sub26Checkboxp" id="Sub26Checkboxp" type="checkbox"/>
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
															<input name="Sub7Checkbox" id="Sub7Checkbox" type="checkbox"/>
															</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 7</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject27" id="Subject27" type="text" class="full" disabled/>
														</div>
														<div class="form_grid_3">
															<span>
															<input name="Sub27Checkbox" id="Sub27Checkbox" type="checkbox"/>
															</span>
														</div>
														<div class="form_grid_3">
															<input name="Sub27Checkboxp" id="Sub27Checkboxp" type="checkbox"/>
														</div>
													</div>
												</div>
												<br /><br /><br />
												</li>
												
												<li>
												<div class="form_grid_6">
													<label class="field_title">Subject 8</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject8" id="Subject8" type="text" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Sub8Checkbox" id="Sub8Checkbox" type="checkbox"/>
															</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 8</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject28" id="Subject28" type="text" class="full" disabled/>
														</div>
														<div class="form_grid_3">
															<span>
															<input name="Sub28Checkbox" id="Sub28Checkbox" type="checkbox"/>
															</span>
														</div>
														<div class="form_grid_3">
															<input name="Sub28Checkboxp" id="Sub28Checkboxp" type="checkbox"/>
														</div>
													</div>
												</div>
												<br /><br /><br />
												</li>
												
												<li>
												<div class="form_grid_6">
													<label class="field_title">Subject 9</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject9" id="Subject9" type="text" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Sub9Checkbox" id="Sub9Checkbox" type="checkbox"/>
															</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 9</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject29" id="Subject29" type="text" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Sub29Checkbox" id="Sub29Checkbox" type="checkbox"/>
															</span>
														</div>
													</div>
												</div>
												<br /><br /><br />
												</li>
											</ul>
										</fieldset>
										</li>
										</div>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Letter No<span class="req">*</span></label>
											<div class="form_input">
												<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Letter No" class="x_large" maxlength="50" tabindex="3"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_12">
											<div class="form_input">
												<input type="hidden" name="Id" id="Id" value="<?php echo $_REQUEST['Id'];?>"/>
												<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
												<button type="button" name="reset" class="btn_small btn_blue" onclick="location.replace('updtgrpcomb_student110.php?Id=<?php echo $_REQUEST['Id'];?>')" tabindex="5"><span>Reset</span></button>
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
	if($("#tbl-subjects li div input:checkbox:checked").length <= 0){ alert('Choose Subject'); return false; }
}//check_submit_form()
</script>
<script type="text/javascript" src="js/record-updation110new.js"></script>