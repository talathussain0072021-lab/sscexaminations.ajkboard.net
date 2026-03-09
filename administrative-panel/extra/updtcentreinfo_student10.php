<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql="UPDATE admbatchstudents10 SET
		ACentreId				=		".$_REQUEST['ACentreId']."
		WHERE StudentId			=		".$_REQUEST['Id']."";
		
		if(mysql_query($sql, $conn1))
		{
			$ins="INSERT INTO tbl_piilog SET
			ActivityType			=		'CentreInfoUpdation-II',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			StudentId				=		".$_REQUEST['Id'].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn1);
			
			?><script>alert('Student Updated Successfully.');location.replace('allstudents_edit10.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('updtcentreinfo_student10.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
		}
	}
	?>
	<?php
	$sql="SELECT Id, Name, FatherName, ACentreId, ACentreName, ACentreCode FROM vwadmstudents10 WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Update Centre Info</h6>
					</div>

					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();" enctype="multipart/form-data">
							<ul>
								<li>
								<fieldset>
									<legend>Centre Info</legend>
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
											<label class="field_title">Centre Code<span class="req">*</span></label>
											<div class="form_input">
												<select name="ACentreId" id="ACentreId" data-required="required" data-message="Choose Centre" class="chzn-select custom-select" tabindex="1">
												<option value="">Select</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Centre Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="ACentreName" id="ACentreName" type="text" class="x_large" readonly/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Letter No<span class="req">*</span></label>
											<div class="form_input">
												<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Letter No" class="x_large" maxlength="50" tabindex="2"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_12">
											<div class="form_input">
												<input type="hidden" name="Id" id="Id" value="<?php echo $_REQUEST['Id'];?>"/>
												<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="3"><span>Update</span></button>
												<button type="button" name="reset" class="btn_small btn_blue" onclick="location.replace('updtcentreinfo_student10.php?Id=<?php echo $_REQUEST['Id'];?>')" tabindex="4"><span>Reset</span></button>
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
<script type="text/javascript" src="js/centre-updation10.js"></script>