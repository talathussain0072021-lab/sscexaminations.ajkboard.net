<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql1="SELECT * FROM schedule WHERE Phase=".$_REQUEST['Phase']." AND Type=".$_REQUEST['Type']." AND Id!=".$_REQUEST['Id']."";
		$res1=mysql_query($sql1, $conn1);
		$no_row1=mysql_num_rows($res1);
		
		if($no_row1 > 0)
		{ echo "<script>"; echo "alert('Phase already exists.')"; echo "</script>"; }
		else
		{
			if($_REQUEST['IsCurrent'] == 1)
			{
				$sql="UPDATE schedule SET
				IsCurrent		=		0
				WHERE Type		=		".$_REQUEST['Type']."";
				$res=mysql_query($sql, $conn1);
			}
			
			$sql="UPDATE schedule SET
			Phase			=		".$_REQUEST['Phase'].",
			FromDate		=		'".$_REQUEST['FromDate']."',
			ToDate			=		'".$_REQUEST['ToDate']."',
			Type			=		".$_REQUEST['Type'].",
			IsCurrent		=		".$_REQUEST['IsCurrent']."
			WHERE Id		=		".$_REQUEST['Id']."";
			
			if(mysql_query($sql, $conn1))
			{
				?><script>location.replace('schedule.php?message=Data Updated Successfully.');</script><?php
			}
			else
			{
				?><script>alert('Error in Query.');location.replace('schedule_edit.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
			}
		}
	}
	?>
	<?php
	$sql="SELECT * FROM schedule WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						<h6>Update Schedule</h6>
					</div>
					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();">
							<ul>
                          		<li>
								<div class="form_grid_6">
									<label class="field_title">Phase<span class="req">*</span></label>
									<div class="form_input">
										<select name="Phase" id="Phase" data-required="required" data-message="Choose Phase" class="chzn-select custom-select" tabindex="1">
										<option value="">Select</option>
										<option value="1" <?php echo ($row['Phase']==1)?'selected':'';?>>Phase1</option>
										<option value="2" <?php echo ($row['Phase']==2)?'selected':'';?>>Phase2</option>
										<option value="3" <?php echo ($row['Phase']==3)?'selected':'';?>>Phase3</option>
										<option value="4" <?php echo ($row['Phase']==4)?'selected':'';?>>Phase4</option>
										<option value="5" <?php echo ($row['Phase']==5)?'selected':'';?>>Phase5</option>
										<option value="6" <?php echo ($row['Phase']==6)?'selected':'';?>>Phase6</option>
										<option value="7" <?php echo ($row['Phase']==7)?'selected':'';?>>Phase7</option>
										<option value="8" <?php echo ($row['Phase']==8)?'selected':'';?>>Phase8</option>
										<option value="9" <?php echo ($row['Phase']==9)?'selected':'';?>>Phase9</option>
										<option value="10" <?php echo ($row['Phase']==10)?'selected':'';?>>Phase10</option>
										<option value="11" <?php echo ($row['Phase']==11)?'selected':'';?>>Phase11</option>
										<option value="12" <?php echo ($row['Phase']==12)?'selected':'';?>>Phase12</option>
										<option value="13" <?php echo ($row['Phase']==13)?'selected':'';?>>Phase13</option>
										<option value="14" <?php echo ($row['Phase']==14)?'selected':'';?>>Phase14</option>
										<option value="15" <?php echo ($row['Phase']==15)?'selected':'';?>>Phase15</option>
										</select>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">From Date<span class="req">*</span></label>
									<div class="form_input">
										<input name="FromDate" id="FromDate" type="date" value="<?php echo $row['FromDate'];?>" data-required="required" data-message="Choose From Date" class="x_large" tabindex="2"/>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">To Date<span class="req">*</span></label>
									<div class="form_input">
										<input name="ToDate" id="ToDate" type="date" value="<?php echo $row['ToDate'];?>" data-required="required" data-message="Choose To Date" class="x_large" tabindex="3"/>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Type<span class="req">*</span></label>
									<div class="form_input">
										<select name="Type" id="Type" data-required="required" data-message="Choose Type" class="chzn-select custom-select" tabindex="4">
										<option value="">Select</option>
										<option value="0" <?php echo ($row['Type']==0)?'selected':'';?>>Registration</option>
										<option value="1" <?php echo ($row['Type']==1)?'selected':'';?>>Admission P1</option>
										<option value="2" <?php echo ($row['Type']==2)?'selected':'';?>>Admission P2</option>
										<option value="3" <?php echo ($row['Type']==3)?'selected':'';?>>Admission Supply</option>
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
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
                                    	<input type="hidden" name="Id" value="<?php echo $_REQUEST['Id'];?>"/>
										<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="6"><span>Update</span></button>
										<button type="reset" class="btn_small btn_blue" tabindex="7"><span>Reset</span></button>
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
	
	var FromDate=document.getElementById('FromDate').value;
	var ToDate=document.getElementById('ToDate').value;
	
	if(ToDate <= FromDate){ alert('Choose Dates again'); document.getElementById('ToDate').focus(); return false; }
}//check_submit_form()
</script>