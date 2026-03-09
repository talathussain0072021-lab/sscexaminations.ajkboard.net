<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql1="UPDATE admbatchstudents10 SET
		AdmStatus		=	2,
		RevStatus		=	2,
		RollNo			=	0
		WHERE StudentId	=	".$_REQUEST['Id']."";
		
		if(mysql_query($sql1, $conn1))
		{
			$sql2="DELETE FROM vwrollnoslip10 WHERE Id=".$_REQUEST['Id']."";
			$res2=mysql_query($sql2, $conn1);
			
			$ins="INSERT INTO tbl_piilog SET
			ActivityType			=		'RollNoSlipDeletion-II',
			ActivityDescription		=		'Record of RollNoSlip - SSC-II is deleted from DB',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			StudentId				=		".$_REQUEST['Id'].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn1);
			
			if($_REQUEST['Type'] == 1)
			{ ?><script>location.replace('regstudents-rollnoslips10.php?message=Data Updated Successfully.');</script><?php }
			else if($_REQUEST['Type'] == 0)
			{ ?><script>location.replace('privstudents-rollnoslips10.php?message=Data Updated Successfully.');</script><?php }
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('delete_rollnoslips10.php?Id=<?php echo $_REQUEST['Id'];?>&Type=<?php echo $_REQUEST['Type'];?>');</script><?php
		}
	}
	?>
	<?php
	$sql="SELECT Id, Name, FatherName FROM vwrollnoslip10 WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Delete RollNo Slip</h6>
					</div>

					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();" enctype="multipart/form-data">
								<ul>
									<li>
									<fieldset>
										<legend>Basic Info</legend>
										<ul>
											<li>
											<div class="form_grid_6">
												<label class="field_title">Student Name<span class="req">*</span></label>
												<div class="form_input">
													<input type="text" value="<?php echo $row['Name'];?>" class="x_large" disabled/>
												</div>
											</div>
											<div class="form_grid_6">
												<label class="field_title">Father's Name<span class="req">*</span></label>
												<div class="form_input">
													<input type="text" value="<?php echo $row['FatherName'];?>" class="x_large" disabled/>
												</div>
											</div>
											<br /><br /><br />
											</li>
											
											<li>
											<div class="form_grid_6">
												<label class="field_title">Letter No<span class="req">*</span></label>
												<div class="form_input">
													<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Letter No" class="x_large" maxlength="50" tabindex="1"/>
												</div>
											</div>
											<br /><br /><br />
											</li>
											
											<li>
											<div class="form_grid_12">
												<div class="form_input">
													<input type="hidden" name="Id" id="Id" value="<?php echo $_REQUEST['Id'];?>"/>
													<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="2"><span>Delete</span></button>
													<button type="reset" name="reset" class="btn_small btn_blue" tabindex="3"><span>Reset</span></button>
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