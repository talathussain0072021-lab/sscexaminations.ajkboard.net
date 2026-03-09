<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql1="SELECT * FROM subjects WHERE Name='".$_REQUEST['Name']."' AND Id!=".$_REQUEST['Id']."";
		$res1=mysql_query($sql1, $conn1);
		$no_row1=mysql_num_rows($res1);
		
		if($no_row1 > 0)
		{ echo "<script>"; echo "alert('Name already exists.')"; echo "</script>"; }
		else
		{
			$sql="UPDATE subjects SET
			Name			=		'".$_REQUEST['Name']."',
			SmallName		=		'".$_REQUEST['SmallName']."',
			Code			=		'".$_REQUEST['Code']."',
			Class			=		".$_REQUEST['Class'].",
			IsPractical		=		".$_REQUEST['IsPractical'].",
			IsDoubleShift	=		".$_REQUEST['IsDoubleShift'].",
			IsCompulsory	=		".$_REQUEST['IsCompulsory']."
			WHERE Id		=		".$_REQUEST['Id']."";
			
			if(mysql_query($sql, $conn1))
			{
				?><script>location.replace('subjects.php?message=Data Updated Succesfully.');</script><?php
			}
			else
			{
				?><script>alert('Error in Query.');location.replace('subjects_edit.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
			}
		}
	}
	?>
	<?php
	$sql="SELECT * FROM subjects WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Update Subject</h6>
					</div>
					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();">
							<ul>
								<li>
								<div class="form_grid_6">
									<label class="field_title">Name<span class="req">*</span></label>
									<div class="form_input">
										<input name="Name" id="Name" type="text" value="<?php echo $row['Name'];?>" data-required="required" data-message="Enter Name" class="x_large" maxlength="40" tabindex="1"/>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Small Name<span class="req">*</span></label>
									<div class="form_input">
										<input name="SmallName" id="SmallName" type="text" value="<?php echo $row['SmallName'];?>" data-required="required" data-message="Enter Small Name" class="x_large" maxlength="10" tabindex="2"/>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">Code<span class="req">*</span></label>
									<div class="form_input">
										<input name="Code" id="Code" type="text" value="<?php echo $row['Code'];?>" data-required="required" data-message="Enter Code" class="x_large" onkeypress="return isNumber()" maxlength="3" tabindex="3"/>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Class<span class="req">*</span></label>
									<div class="form_input">
										<select name="Class" id="Class" data-required="required" data-message="Choose Class" class="chzn-select custom-select" tabindex="4">
										<option value="">Select</option>
										<option value="9" <?php echo ($row['Class']==9)?'selected':''?>>9</option>
										<option value="10" <?php echo ($row['Class']==10)?'selected':''?>>10</option>
										</select>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">IsPractical<span class="req">*</span></label>
									<div class="form_input">
										<select name="IsPractical" id="IsPractical" data-required="required" data-message="Choose IsPractical Status" class="chzn-select custom-select" tabindex="5">
										<option value="">Select</option>
										<option value="1" <?php echo ($row['IsPractical']==1)?'selected':'';?>>Yes</option>
										<option value="0" <?php echo ($row['IsPractical']==0)?'selected':'';?>>No</option>
										</select>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">IsDoubleShift<span class="req">*</span></label>
									<div class="form_input">
										<select name="IsDoubleShift" id="IsDoubleShift" data-required="required" data-message="Choose IsDoubleShift Status" class="chzn-select custom-select" tabindex="6">
										<option value="">Select</option>
										<option value="1" <?php echo ($row['IsDoubleShift']==1)?'selected':'';?>>Yes</option>
										<option value="0" <?php echo ($row['IsDoubleShift']==0)?'selected':'';?>>No</option>
										</select>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">IsCompulsory<span class="req">*</span></label>
									<div class="form_input">
										<select name="IsCompulsory" id="IsCompulsory" data-required="required" data-message="Choose IsCompulsory Status" class="chzn-select custom-select" tabindex="7">
										<option value="">Select</option>
										<option value="1" <?php echo ($row['IsCompulsory']==1)?'selected':'';?>>Yes</option>
										<option value="0" <?php echo ($row['IsCompulsory']==0)?'selected':'';?>>No</option>
										</select>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
                                <li>
								<div class="form_grid_12">
									<div class="form_input">
                         				<input type="hidden" name="Id" value="<?php echo $_REQUEST['Id'];?>"/>
										<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="8"><span>Update</span></button>
										<button type="reset" class="btn_small btn_blue" tabindex="9"><span>Reset</span></button>
									</div>
								</div>
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