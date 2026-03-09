<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql1="SELECT * FROM exams WHERE Name='".$_REQUEST['Name']."' AND Id!=".$_REQUEST['Id']."";
		$res1=mysql_query($sql1, $conn1);
		$no_row1=mysql_num_rows($res1);
		
		if($no_row1 > 0)
		{ echo "<script>"; echo "alert('Name already exists.')"; echo "</script>"; }
		else
		{
			if($_REQUEST['IsCurrent'] == 1)
			{
				$sql="UPDATE exams SET IsCurrent=0";
				$res=mysql_query($sql, $conn1);
			}
			
			$sql="UPDATE exams SET
			Name			=		'".$_REQUEST['Name']."',
			FullName		=		'".$_REQUEST['FullName']."',
			Year			=		".$_REQUEST['Year'].",
			Type			=		".$_REQUEST['Type'].",
			IsCurrent		=		".$_REQUEST['IsCurrent'].",
			ProcessingFee	=		".$_REQUEST['ProcessingFee'].",
			SubjChFee		=		".$_REQUEST['SubjChFee'].",
			GroupChFee		=		".$_REQUEST['GroupChFee']."
			WHERE Id		=		".$_REQUEST['Id']."";
			
			if(mysql_query($sql, $conn1))
			{
				?><script>location.replace('exams.php?message=Data Updated Successfully.');</script><?php
			}
			else
			{
				?><script>alert('Error in Query.');location.replace('exams_edit.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
			}
		}
	}
	?>
	<?php
	$sql="SELECT * FROM exams WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						<h6>Update Exam</h6>
					</div>
					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();">
							<ul>
                          		<li>
								<div class="form_grid_6">
									<label class="field_title">Name<span class="req">*</span></label>
									<div class="form_input">
										<input name="Name" id="Name" type="text" value="<?php echo $row['Name'];?>" data-required="required" data-message="Enter Name" class="x_large" maxlength="50" tabindex="1"/>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Full Name<span class="req">*</span></label>
									<div class="form_input">
										<input name="FullName" id="FullName" type="text" value="<?php echo $row['FullName'];?>" data-required="required" data-message="Enter Full Name" class="x_large" maxlength="50" tabindex="2"/>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">Year<span class="req">*</span></label>
									<div class="form_input">
										<input name="Year" id="Year" type="text" value="<?php echo $row['Year'];?>" data-required="required" data-message="Enter Year" class="x_large" onkeypress="return isNumber(event)" maxlength="2" tabindex="3"/>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Type<span class="req">*</span></label>
									<div class="form_input">
										<select name="Type" id="Type" data-required="required" data-message="Choose Type" class="chzn-select custom-select" tabindex="4">
										<option value="">Select</option>
										<option value="1" <?php echo ($row['Type']==1)?'selected':'';?>>Annual</option>
										<option value="2" <?php echo ($row['Type']==2)?'selected':'';?>>Supply</option>
										</select>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">IsCurrent<span class="req">*</span></label>
									<div class="form_input">
										<select name="IsCurrent" id="IsCurrent" data-required="required" data-message="Choose IsCurrent Status" class="chzn-select custom-select" tabindex="5">
										<option value="">Select</option>
										<option value="1" <?php echo ($row['IsCurrent']==1)?'selected':'';?>>Yes</option>
										<option value="0" <?php echo ($row['IsCurrent']==0)?'selected':'';?>>No</option>
										</select>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Processing Fee<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<input name="ProcessingFee" id="ProcessingFee" type="text" value="<?php echo $row['ProcessingFee'];?>" data-required="required" data-message="Enter Processing Fee" class="x_large" maxlength="10" onkeypress="return isNumberKey(event)" tabindex="6"/>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">SubjChange Fee<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<input name="SubjChFee" id="SubjChFee" type="text" value="<?php echo $row['SubjChFee'];?>" data-required="required" data-message="Enter SubjChange Fee" class="x_large" maxlength="10" onkeypress="return isNumberKey(event)" tabindex="7"/>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">GroupChange Fee<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<input name="GroupChFee" id="GroupChFee" type="text" value="<?php echo $row['GroupChFee'];?>" data-required="required" data-message="Enter GroupChange Fee" class="x_large" maxlength="10" onkeypress="return isNumberKey(event)" tabindex="8"/>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
                                    	<input type="hidden" name="Id" value="<?php echo $_REQUEST['Id'];?>"/>
										<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="9"><span>Update</span></button>
										<button type="reset" class="btn_small btn_blue" tabindex="10"><span>Reset</span></button>
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