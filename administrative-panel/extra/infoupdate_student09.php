<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$Remarks = !empty($_REQUEST['Remarks']) ? "'".$_REQUEST['Remarks']."'" : "NULL";
		
		$sql1="UPDATE tbl_studentspi SET
		IsRegular		=	".$_REQUEST['IsRegular'].",
		IsEntered		=	".$_REQUEST['IsEntered'].",
		IsIntact		=	".$_REQUEST['IsIntact'].",
		IsReAdmitted	=	".$_REQUEST['IsReAdmitted']."
		WHERE Id		=	".$_REQUEST['Id']."";
		$res1=mysql_query($sql1, $conn_sscreslt);
		
		$sql2="UPDATE tbl_resultpi SET
		REMARKS			=	".$Remarks."
		WHERE REGNO		=	'".$_REQUEST['RegistrationNo']."'
		AND ID			=	".$_REQUEST['RID']."";
		$res2=mysql_query($sql2, $conn_sscreslt);
		
		if($res1==1 && $res2==1)
		{
			$ins="INSERT INTO tbl_resultlog SET
			ActivityType		=		'InfoUpdation-II',
			ActivityRefNo		=		'".$_REQUEST['ActivityRefNo']."',
			RegNo				=		'".$_REQUEST['RegistrationNo']."',
			StudentId			=		".$_REQUEST['Id'].",
			EmployeeId			=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn_sscreslt);
			
			?><script>alert('Information Processed Successfully.');location.replace('sscrecords09.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('infoupdate_student09.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
		}
	}
	?>
	<?php
	$sql="SELECT Id, Name, FatherName, IsRegular, IsEntered, IsIntact, IsReAdmitted, STATUS, REMARKS, RegistrationNo, RID FROM vwstudentspi WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn_sscreslt);
	$row=mysql_fetch_array($res);
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Update Student</h6>
					</div>

					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();">
						<input name="RegistrationNo" id="RegistrationNo" type="hidden" value="<?php echo $row['RegistrationNo'];?>">
						<input name="RID" id="RID" type="hidden" value="<?php echo $row['RID'];?>">
							<ul>
								<li>
								<fieldset>
									<legend>Basic Info</legend>
									<ul>
										<li>
										<div class="form_grid_6">
											<label class="field_title">Student Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="Name" id="Name" type="text" value="<?php echo $row['Name'];?>" class="x_large" readonly/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Father's Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="FatherName" id="FatherName" type="text" value="<?php echo $row['FatherName'];?>" class="x_large" readonly/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">IsRegular<span class="req">*</span></label>
											<div class="form_input">
												<select name="IsRegular" id="IsRegular" data-required="required" data-message="Choose IsRegular Status" class="chzn-select custom-select" tabindex="1">
												<?php if($row['STATUS']==2){?>
												<option value="0">No</option>
												<?php } else{?>
												<option value="1" <?php echo ($row['IsRegular']==1)?'selected':'';?>>Yes</option>
												<option value="0" <?php echo ($row['IsRegular']==0)?'selected':'';?>>No</option>
												<?php }?>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">IsEntered<span class="req">*</span></label>
											<div class="form_input">
												<select name="IsEntered" id="IsEntered" data-required="required" data-message="Choose IsEntered Status" class="chzn-select custom-select" tabindex="2">
												<option value="1" <?php echo ($row['IsEntered']==1)?'selected':'';?>>Yes</option>
												<option value="0" <?php echo ($row['IsEntered']==0)?'selected':'';?>>No</option>
												</select>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">IsIntact<span class="req">*</span></label>
											<div class="form_input">
												<select name="IsIntact" id="IsIntact" data-required="required" data-message="Choose IsIntact Status"  class="chzn-select custom-select" tabindex="3">
												<option value="1" <?php echo ($row['IsIntact']==1)?'selected':'';?>>Yes</option>
												<option value="0" <?php echo ($row['IsIntact']==0)?'selected':'';?>>No</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">IsReAdmitted<span class="req">*</span></label>
											<div class="form_input">
												<select name="IsReAdmitted" id="IsReAdmitted" data-required="required" data-message="Choose IsReAdmitted Status" class="chzn-select custom-select" tabindex="4">
												<option value="1" <?php echo ($row['IsReAdmitted']==1)?'selected':'';?>>Yes</option>
												<option value="0" <?php echo ($row['IsReAdmitted']==0)?'selected':'';?>>No</option>
												</select>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Remarks</label>
											<div class="form_input">
												<input name="Remarks" id="Remarks" type="text" value="<?php echo $row['REMARKS'];?>" class="x_large" onkeypress="return isNumber()" maxlength="2" tabindex="5"/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Letter No<span class="req">*</span></label>
											<div class="form_input">
												<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Letter No" class="x_large" maxlength="50" tabindex="6"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_12">
											<div class="form_input">
												<input type="hidden" name="Id" id="Id" value="<?php echo $_REQUEST['Id'];?>"/>
												<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="7"><span>Update</span></button>
												<button type="reset" class="btn_small btn_blue" onclick="location.replace('infoupdate_student09.php?Id=<?php echo $_REQUEST['Id'];?>')" tabindex="8"><span>Reset</span></button>
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