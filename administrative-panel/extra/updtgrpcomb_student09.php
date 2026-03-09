<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql="UPDATE students SET
		GroupId					=		".$_REQUEST['GroupId'].",
		CombinationId			=		".$_REQUEST['CombinationId']."
		WHERE Id				=		".$_REQUEST['Id']."";
		
		if(mysql_query($sql, $conn1))
		{
			$updt1="UPDATE regbatchstudents SET
			GroupId					=		".$_REQUEST['GroupId'].",
			CombinationId			=		".$_REQUEST['CombinationId']."
			WHERE StudentId			=		".$_REQUEST['Id']."";
			$resupdt1=mysql_query($updt1, $conn1);
			
			$updt2="UPDATE students SET
			IsGroupChange		=		0,
			IsCombChange		=		0,
			SubChangeType		=		0
			WHERE Id			=		".$_REQUEST['Id']."";
			$resupdt2=mysql_query($updt2, $conn1);
			
			$ins="INSERT INTO tbl_pilog SET
			ActivityType			=		'GrpSubjUpdation-I',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			StudentId				=		".$_REQUEST['Id'].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn1);
			
			?><script>alert('Student Updated Successfully.');location.replace('allstudents_edit09.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('updtgrpcomb_student09.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
		}
	}
	?>
	<?php
	$sql="SELECT Id, Name, FatherName, GroupId, CombinationId FROM vwregstudents WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
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
										
										<li>
										<fieldset>
											<legend>All Subjects</legend>
											<ul>
												<li>
												<div class="form_grid_6">
													<label class="field_title">Subject 5</label>
													<div class="form_input">
														<input name="Subject5" id="Subject5" type="text" class="x_large" disabled/>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 6</label>
													<div class="form_input">
														<input name="Subject6" id="Subject6" type="text" class="x_large" disabled/>
													</div>
												</div>
												<br /><br /><br />
												</li>
												
												<li>
												<div class="form_grid_6">
													<label class="field_title">Subject 7</label>
													<div class="form_input">
														<input name="Subject7" id="Subject7" type="text" class="x_large" disabled/>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 8</label>
													<div class="form_input">
														<input name="Subject8" id="Subject8" type="text" class="x_large" disabled/>
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
												<button type="button" name="reset" class="btn_small btn_blue" onclick="location.replace('updtgrpcomb_student09.php?Id=<?php echo $_REQUEST['Id'];?>')" tabindex="5"><span>Reset</span></button>
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