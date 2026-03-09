<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql_sub26="SELECT Code FROM subjects WHERE Code='".$_REQUEST['Subject26Code']."' AND IsPractical=1";
		$res_sub26=mysql_query($sql_sub26, $conn1);
		$row_sub26=mysql_fetch_assoc($res_sub26);
		$Sub26PCode=$row_sub26['Code'];
		
		$sql_sub27="SELECT Code FROM subjects WHERE Code='".$_REQUEST['Subject27Code']."' AND IsPractical=1";
		$res_sub27=mysql_query($sql_sub27, $conn1);
		$row_sub27=mysql_fetch_assoc($res_sub27);
		$Sub27PCode=$row_sub27['Code'];
		
		$sql_sub28="SELECT Code FROM subjects WHERE Code='".$_REQUEST['Subject28Code']."' AND IsPractical=1";
		$res_sub28=mysql_query($sql_sub28, $conn1);
		$row_sub28=mysql_fetch_assoc($res_sub28);
		$Sub28PCode=$row_sub28['Code'];
		
		$sql="UPDATE students10 SET
		Sub5Code			=		'".$_REQUEST['Subject5Code']."',
		Sub6Code			=		'".$_REQUEST['Subject6Code']."',
		Sub7Code			=		'".$_REQUEST['Subject7Code']."',
		Sub8Code			=		'".$_REQUEST['Subject8Code']."',
		Sub25Code			=		'".$_REQUEST['Subject25Code']."',
		Sub26Code			=		'".$_REQUEST['Subject26Code']."',
		Sub27Code			=		'".$_REQUEST['Subject27Code']."',
		Sub28Code			=		'".$_REQUEST['Subject28Code']."',
		Sub26PCode 			=		'".$Sub26PCode."',
		Sub27PCode 			=		'".$Sub27PCode."',
		Sub28PCode 			=		'".$Sub28PCode."'
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
			?><script>alert('Error in Query.');location.replace('updtgrpcomb_student210.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
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
										<fieldset>
											<legend>Elective Subjects</legend>
											<ul>
												<li>
												<div class="form_grid_6">
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<span class="input_instruction green">First Year Subjects</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<span class="input_instruction green">Second Year Subjects</span>
														</div>
													</div>
												</div>
												<br />
												</li>
												
												<li>
												<div class="form_grid_6">
													<label class="field_title">Subject 5</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<select name="Subject5Code" id="Subject5Code" data-placeholder="Select" class="chzn-select custom-select" tabindex="1">
															</select>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 5</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<select name="Subject25Code" id="Subject25Code" data-placeholder="Select" class="chzn-select custom-select" tabindex="2">
															</select>
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
															<select name="Subject6Code" id="Subject6Code" data-placeholder="Select" class="chzn-select custom-select" tabindex="3">
															</select>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 6</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<select name="Subject26Code" id="Subject26Code" data-placeholder="Select" class="chzn-select custom-select" tabindex="4">
															</select>
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
															<select name="Subject7Code" id="Subject7Code" data-placeholder="Select" class="chzn-select custom-select" tabindex="5">
															</select>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 7</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<select name="Subject27Code" id="Subject27Code" data-placeholder="Select" class="chzn-select custom-select" tabindex="6">
															</select>
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
															<select name="Subject8Code" id="Subject8Code" data-placeholder="Select" class="chzn-select custom-select" tabindex="7">
															</select>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 8</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<select name="Subject28Code" id="Subject28Code" data-placeholder="Select" class="chzn-select custom-select" tabindex="8">
															</select>
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
												<button type="button" name="reset" class="btn_small btn_blue" onclick="location.replace('updtgrpcomb_student210.php?Id=<?php echo $_REQUEST['Id'];?>')" tabindex="11"><span>Reset</span></button>
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
	var Subject5Code=parseInt(document.getElementById('Subject5Code').value || 0);
	var Subject6Code=parseInt(document.getElementById('Subject6Code').value || 0);
	var Subject7Code=parseInt(document.getElementById('Subject7Code').value || 0);
	var Subject8Code=parseInt(document.getElementById('Subject8Code').value || 0);
	var Subject25Code=parseInt(document.getElementById('Subject25Code').value || 0);
	var Subject26Code=parseInt(document.getElementById('Subject26Code').value || 0);
	var Subject27Code=parseInt(document.getElementById('Subject27Code').value || 0);
	var Subject28Code=parseInt(document.getElementById('Subject28Code').value || 0);
	
	if(!Validate($(".form_container"))){ return false; }
	//if(Subject5Code==0){ alert('Choose Subject'); document.getElementById('Subject5Code').focus(); return false; }
	//if(Subject25Code==0){ alert('Choose Subject'); document.getElementById('Subject25Code').focus(); return false; }
	
	if(Subject5Code!=0 || Subject25Code!=0)
	{
		if(Subject25Code!=(Subject5Code+1)){ alert('Choose Same Subjects'); return false; }
	}//if(Subject5Code!=0 || Subject25Code!=0)
	
	if(Subject6Code!=0 || Subject26Code!=0)
	{
		if(Subject26Code!=(Subject6Code+1)){ alert('Choose Same Subjects'); return false; }
	}//if(Subject6Code!=0 || Subject26Code!=0)
	
	if(Subject7Code!=0 || Subject27Code!=0)
	{
		if(Subject27Code!=(Subject7Code+1)){ alert('Choose Same Subjects'); return false; }
	}//if(Subject7Code!=0 || Subject27Code!=0)
	
	if(Subject8Code!=0 || Subject28Code!=0)
	{
		if(Subject28Code!=(Subject8Code+1)){ alert('Choose Same Subjects'); return false; }
	}//if(Subject8Code!=0 || Subject28Code!=0)
}//check_submit_form()
</script>
<script type="text/javascript" src="js/record-updation210new.js"></script>