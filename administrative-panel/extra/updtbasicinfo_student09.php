<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql="UPDATE students SET
		SSCRegNo				=		'".$_REQUEST['SSCRegNo']."',
		SSCBoard				=		".$_REQUEST['SSCBoard'].",
		IsRegular				=		".$_REQUEST['IsRegular'].",
		AdmissionType			=		".$_REQUEST['AdmissionType']."
		WHERE Id				=		".$_REQUEST['Id']."";
		
		if(mysql_query($sql, $conn1))
		{
			if($_REQUEST['AdmissionType'] == 3 && !(empty($_REQUEST['SSCRegNo'])) && $_REQUEST['SSCBoard'] == 1)
			{
				$sql="UPDATE vwregstudents SET
				RegistrationNo		=		'".$_REQUEST['SSCRegNo']."'
				WHERE Id			=		".$_REQUEST['Id']."
				AND StdRegStatus	=		1
				AND StdRevStatus	=		1";
				$resupdt=mysql_query($sql, $conn1);
			}
			
			$ins="INSERT INTO tbl_pilog SET
			ActivityType			=		'BasicInfoUpdation-I',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			StudentId				=		".$_REQUEST['Id'].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn1);
			
			?><script>alert('Student Updated Successfully.');location.replace('allstudents_edit09.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('updtbasicinfo_student09.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
		}
	}
	?>
	<?php
	$sql="SELECT Id, SSCRegNo, SSCBoard, Name, FatherName, IsRegular, AdmissionType FROM vwregstudents WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Update Basic Info</h6>
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
											<label class="field_title">SSC RegNo<span class="req">*</span></label>
											<div class="form_input">
												<input name="SSCRegNo" id="SSCRegNo" type="text" value="<?php echo $row['SSCRegNo'];?>" class="x_large" maxlength="11" tabindex="1"/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">SSC Board<span class="req">*</span></label>
											<div class="form_input">
												<select name="SSCBoard" id="SSCBoard" data-placeholder="Select Board" class="chzn-select custom-select" tabindex="2">
												<option value="0">Select</option>
												<?php
												$sql_boards="SELECT Id, Name FROM boards";
												$res_boards=mysql_query($sql_boards, $conn1);
												while($row_boards=mysql_fetch_array($res_boards))
												{ echo '<option value="'.$row_boards['Id'].'" '.(($row['SSCBoard']==$row_boards['Id'])?'selected':'').'>'.$row_boards['Name'].'</option>'; }
												?>
												</select>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">IsRegular<span class="req">*</span></label>
											<div class="form_input">
												<select name="IsRegular" id="IsRegular" data-required="required" data-message="Choose IsRegular Status" class="chzn-select custom-select" tabindex="3">
												<option value="1" <?php echo (($row['IsRegular']==1)?'selected':'');?>>Yes</option>
												<option value="0" <?php echo (($row['IsRegular']==0)?'selected':'');?>>No</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Admission Type<span class="req">*</span></label>
											<div class="form_input">
												<select name="AdmissionType" id="AdmissionType" data-required="required" data-message="Choose Admission Type" class="chzn-select custom-select" tabindex="4">
												<option value="">Select</option>
												<option value="1" <?php echo (($row['AdmissionType']==1)?'selected':'')?>>Fresh (AJK)</option>
												<option value="3" <?php echo (($row['AdmissionType']==3)?'selected':'')?>>ReAdm. (AJK)</option>
												<option value="4" <?php echo (($row['AdmissionType']==4)?'selected':'')?>>ReAdm. (Other)</option>
												</select>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Letter No<span class="req">*</span></label>
											<div class="form_input">
												<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Letter No" class="x_large" maxlength="50" tabindex="5"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_12">
											<div class="form_input">
												<input type="hidden" name="Id" id="Id" value="<?php echo $_REQUEST['Id'];?>"/>
												<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="6"><span>Update</span></button>
												<button type="button" name="reset" class="btn_small btn_blue" onclick="location.replace('updtbasicinfo_student09.php?Id=<?php echo $_REQUEST['Id'];?>')" tabindex="7"><span>Reset</span></button>
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
	var SSCRegNo=document.getElementById('SSCRegNo').value;
	var SSCBoard=document.getElementById('SSCBoard').value;
	var AdmissionType=document.getElementById('AdmissionType').value;
	
	if(!Validate($(".form_container"))){ return false; }
	if(AdmissionType==3 || AdmissionType==4)
	{
		if(SSCRegNo=='' || SSCBoard=='0'){ alert('Enter SSC RegNo AND Choose SSC Board'); return false; }
	}
}//check_submit_form()
</script>