<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql1="SELECT * FROM schedule WHERE Phase=".$_REQUEST['Phase']." AND Type=".$_REQUEST['Type']."";
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
			
			$sql="INSERT INTO schedule SET
			Phase			=		".$_REQUEST['Phase'].",
			FromDate		=		'".$_REQUEST['FromDate']."',
			ToDate			=		'".$_REQUEST['ToDate']."',
			Type			=		".$_REQUEST['Type'].",
			IsCurrent		=		".$_REQUEST['IsCurrent']."";
			
			if(mysql_query($sql, $conn1))
			{
				?><script>location.replace('schedule.php?message=Data Inserted Successfully.');</script><?php
			}
			else
			{
				?><script>alert('Error in Query.');location.replace('schedule_add.php');</script><?php
			}
		}
	}
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						<h6>Add Schedule</h6>
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
										<option value="1">Phase1</option>
										<option value="2">Phase2</option>
										<option value="3">Phase3</option>
										<option value="4">Phase4</option>
										<option value="5">Phase5</option>
										<option value="6">Phase6</option>
										<option value="7">Phase7</option>
										<option value="8">Phase8</option>
										<option value="9">Phase9</option>
										<option value="10">Phase10</option>
										<option value="11">Phase11</option>
										<option value="12">Phase12</option>
										<option value="13">Phase13</option>
										<option value="14">Phase14</option>
										<option value="15">Phase15</option>
										</select>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">From Date<span class="req">*</span></label>
									<div class="form_input">
										<input name="FromDate" id="FromDate" type="date" data-required="required" data-message="Choose From Date" class="x_large" tabindex="2"/>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">To Date<span class="req">*</span></label>
									<div class="form_input">
										<input name="ToDate" id="ToDate" type="date" data-required="required" data-message="Choose To Date" class="x_large" tabindex="3"/>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Type<span class="req">*</span></label>
									<div class="form_input">
										<select name="Type" id="Type" data-required="required" data-message="Choose Type" class="chzn-select custom-select" tabindex="4">
										<option value="">Select</option>
										<option value="0">Registration</option>
										<option value="1">Admission P1</option>
										<option value="2">Admission P2</option>
										<option value="3">Admission Supply</option>
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
										<option value="1">Yes</option>
										<option value="0">No</option>
										</select>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="6"><span>Submit</span></button>
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