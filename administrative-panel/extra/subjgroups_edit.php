<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql1="SELECT * FROM subjectgroups WHERE Name='".$_REQUEST['Name']."' AND Id!=".$_REQUEST['Id']."";
		$res1=mysql_query($sql1, $conn1);
		$no_row1=mysql_num_rows($res1);
		
		if($no_row1 > 0)
		{ echo "<script>"; echo "alert('Name already exists.')"; echo "</script>"; }
		else
		{
			$sql="UPDATE subjectgroups SET
			Name			=		'".$_REQUEST['Name']."',
			Code			=		".$_REQUEST['Code'].",
			GroupType		=		".$_REQUEST['GroupType']."
			WHERE Id		=		".$_REQUEST['Id']."";
			
			if(mysql_query($sql, $conn1))
			{
				?><script>location.replace('subjgroups.php?message=Data Updated Successfully.');</script><?php
			}
			else
			{
				?><script>alert('Error in Query.');location.replace('subjgroups_edit.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
			}
		}
	}
	?>
	<?php
	$sql="SELECT * FROM subjectgroups WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						<h6>Update Subject Group</h6>
					</div>
					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();">
							<ul>
                          		<li>
								<div class="form_grid_6">
									<label class="field_title">Name<span class="req">*</span></label>
									<div class="form_input">
										<input name="Name" id="Name" type="text" value="<?php echo $row['Name'];?>" data-required="required" data-message="Enter Name" class="x_large" maxlength="20" tabindex="1"/>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Code<span class="req">*</span></label>
									<div class="form_input">
										<input name="Code" id="Code" type="text" value="<?php echo $row['Code'];?>" data-required="required" data-message="Enter Code" class="x_large" maxlength="1" onkeypress="return isNumber(event)" tabindex="2"/>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">Group Type<span class="req">*</span></label>
									<div class="form_input">
										<select name="GroupType" id="GroupType" data-required="required" data-message="Choose Group Type" class="chzn-select custom-select" tabindex="3">
										<option value="">Select</option>
										<option value="1" <?php echo ($row['GroupType']==1)?'selected':''?>>Reg. Comb.</option>
										<option value="2" <?php echo ($row['GroupType']==2)?'selected':''?>>Priv. Comb.</option>
										</select>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
                                    	<input type="hidden" name="Id" value="<?php echo $_REQUEST['Id'];?>"/>
										<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
										<button type="reset" class="btn_small btn_blue" tabindex="5"><span>Reset</span></button>
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