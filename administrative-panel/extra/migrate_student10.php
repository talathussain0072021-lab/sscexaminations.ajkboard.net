<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql="UPDATE tbl_studentspi SET
		InstituteId		=	".$_REQUEST['NInstituteId']."
		WHERE Id		=	".$_REQUEST['Id']."";
		
		if(mysql_query($sql, $conn_sscreslt))
		{
			$sql_q1="UPDATE migratestudents10 SET
			IsMigrated		=	1
			WHERE StudentId	=	".$_REQUEST['Id']."";
			$res_q1=mysql_query($sql_q1, $conn1);
			
			$sql1="SELECT Code FROM institutes WHERE Id=".$_REQUEST['NInstituteId']."";
			$res1=mysql_query($sql1, $conn1);
			$row1=mysql_fetch_array($res1);
			
			$sql2="SELECT Code FROM institutes WHERE Id=".$_REQUEST['OInstituteId']."";
			$res2=mysql_query($sql2, $conn1);
			$row2=mysql_fetch_array($res2);
			
			$ins="INSERT INTO tbl_resultlog SET
			ActivityType			=		'Migration-II',
			ActivityDescription		=		'Migrated from ".$row2['Code']." to ".$row1['Code']."',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			RegNo					=		'".$_REQUEST['RegistrationNo']."',
			StudentId				=		".$_REQUEST['Id'].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn_sscreslt);
			
			?><script>alert('Information Processed Successfully.');location.replace('sscrecords09.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('migrate_student10.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
		}
	}
	?>
	<?php
	$sql="SELECT Id, Name, FatherName, InstituteId, RegistrationNo FROM vwstudentspi WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn_sscreslt);
	$row=mysql_fetch_array($res);
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Migrate Student</h6>
					</div>

					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();">
						<input name="RegistrationNo" id="RegistrationNo" type="hidden" value="<?php echo $row['RegistrationNo'];?>"/>
						<input name="OInstituteId" id="OInstituteId" type="hidden" value="<?php echo $_REQUEST['InstituteId'];?>"/>
							<ul>
								<li>
								<fieldset>
									<legend>Migration Info</legend>
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
											<label class="field_title">Migrate To (Institute Code)<span class="req">*</span></label>
											<div class="form_input">
												<select name="NInstituteId" id="NInstituteId" data-required="required" data-message="Choose Institute" class="chzn-select custom-select" tabindex="1"/>
												<?php
												$sql_inst="SELECT Id, Name, Code FROM institutes WHERE Id!=".$_REQUEST['InstituteId']." AND IsActive=1 ORDER BY Code ASC";
												$res_inst=mysql_query($sql_inst, $conn1);
												while($row_inst=mysql_fetch_array($res_inst))
												{
													echo '<option value='.$row_inst['Id'].'>'.$row_inst['Code'].' ( '.$row_inst['Name'].' ) '.'</option>';
												}
												?>
												</select>
											</div>
										</div>
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
												<button type="button" name="reset" class="btn_small btn_blue" onclick="location.replace('migrate_student10.php?Id=<?php echo $_REQUEST['Id'];?>&InstituteId=<?php echo $_REQUEST['InstituteId'];?>')" tabindex="4"><span>Reset</span></button>
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