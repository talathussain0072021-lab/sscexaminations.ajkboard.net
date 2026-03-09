<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$Remarks = !empty($_REQUEST['Remarks']) ? "'".$_REQUEST['Remarks']."'" : "NULL";
		
		$sql="UPDATE tbl_resultpii SET
		REMARKS			=	".$Remarks."
		WHERE ID		=	".$_REQUEST['Id']."";
		$res=mysql_query($sql, $conn_sscreslt);
		
		if($res==1)
		{
			$ins="INSERT INTO tbl_resultlog SET
			ActivityType		=		'ResultRemarksUpdation-II',
			ActivityRefNo		=		'".$_REQUEST['ActivityRefNo']."',
			RegNo				=		'".$_REQUEST['REG_NO']."',
			StudentId			=		".$_REQUEST['Id'].",
			EmployeeId			=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn_sscreslt);
			
			?><script>alert('Information Processed Successfully.');location.replace('sscrecords10.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('sscrecords10_edit2.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
		}
	}
	?>
	<?php
	$sql="SELECT ID, NAME, FNAME, REG_NO, EXAM_YEAR, ROLL_NO, EXAM_SESSION, APPEAR_CODE, RESULT, ATTEMPT_LIMIT, REMARKS FROM vw_resultpii WHERE ID=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn_sscreslt);
	$row=mysql_fetch_array($res);
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Update Result</h6>
					</div>

					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();">
						<input name="REG_NO" id="REG_NO" type="hidden" value="<?php echo $row['REG_NO'];?>"/>
							<ul>
								<li>
								<fieldset>
									<legend>Result Info</legend>
									<ul>
										<li>
										<div class="form_grid_6">
											<label class="field_title">Student Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="Name" id="Name" type="text" value="<?php echo $row['NAME'];?>" class="x_large" readonly/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Father's Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="FatherName" id="FatherName" type="text" value="<?php echo $row['FNAME'];?>" class="x_large" readonly/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Appear Code<span class="req">*</span></label>
											<div class="form_input">
												<input name="AppearCode" id="AppearCode" type="text" value="<?php echo $row['APPEAR_CODE'];?>" class="x_large" onkeypress="return isNumber()" maxlength="1" readonly/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Roll Number<span class="req">*</span></label>
											<div class="form_input">
												<input name="RollNo" id="RollNo" type="text" value="<?php echo $row['ROLL_NO'];?>" class="x_large" onkeypress="return isNumber()" maxlength="6" readonly/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Exam Year<span class="req">*</span></label>
											<div class="form_input">
												<input name="ExamYear" id="ExamYear" type="text" value="<?php echo $row['EXAM_YEAR'];?>" class="x_large" onkeypress="return isNumber()" maxlength="2" readonly/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Session<span class="req">*</span></label>
											<div class="form_input">
												<input name="ExamSession" id="ExamSession" type="text" value="<?php echo $row['EXAM_SESSION'];?>" class="x_large" onkeypress="return isNumber()" maxlength="1" readonly/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Remarks</label>
											<div class="form_input">
												<input name="Remarks" id="Remarks" type="text" value="<?php echo $row['REMARKS'];?>" class="x_large" onkeypress="return isNumber()" maxlength="2" tabindex="1"/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Letter No<span class="req">*</span></label>
											<div class="form_input">
												<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Letter No" class="x_large" maxlength="50" tabindex="2"/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_12">
											<div class="form_input">
												<input type="hidden" name="Id" id="Id" value="<?php echo $_REQUEST['Id'];?>"/>
												<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="3"><span>Update</span></button>
												<button type="reset" class="btn_small btn_blue" onclick="location.replace('sscrecords10_edit2.php?Id=<?php echo $_REQUEST['Id'];?>')" tabindex="4"><span>Reset</span></button>
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