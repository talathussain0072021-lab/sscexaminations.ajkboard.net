<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql="UPDATE centres SET
		Name			=	'".strtoupper($_REQUEST['Name'])."',
		Type			=	".$_REQUEST['Type'].",
		IsGovt			=	".$_REQUEST['IsGovt'].",
		District		=	".$_REQUEST['District']."
		WHERE Id		=	'".$_REQUEST['Id']."'";
		
		if(mysql_query($sql, $conn1))
		{
			?><script>alert('Information Updated Successfully.');location.replace('centres.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('centres_edit.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
		}
	}
	?>
	<?php
	$sql="SELECT * FROM centres WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Update Centre</h6>
					</div>
					<div class="widget_content">
						<form id="myform" action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();" enctype="multipart/form-data">
					<!--	<div class="elem_extend">	-->
								<ul>
									<li>
									<fieldset>
										<legend>Centre Information</legend>
										<ul>
											<li>
											<div class="form_grid_12 multiline">
												<label class="field_title">General Detail</label>
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">Name<label style="color:#FF0000"> *</label></span>
														<input name="Name" id="Name" type="text" value="<?php echo $row['Name']?>" data-required="required" data-message="Enter Name" class="limiter" style="text-transform:uppercase;" maxlength="115" tabindex="1"/>
													</div>
													<div class="form_grid_6 ">
														<span class=" label_intro">Code<label style="color:#FF0000"> *</label></span>
														<input name="Code" id="Code" type="text" value="<?php echo $row['Code']?>" data-required="required" data-message="Enter Code" class="limiter" tabindex="2" readonly/>
													</div>
													<span class="clear"></span>
												</div>
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">Type<label style="color:#FF0000"> *</label></span>
														<select name="Type" id="Type" data-required="required" data-message="Choose Type" class="chzn-select custom-select" tabindex="3">
														<option value="">Select</option>
														<option value="1" <?php echo (($row['Type']==1)?'selected':'');?>>Boys</option>
														<option value="2" <?php echo (($row['Type']==2)?'selected':'');?>>Girls</option>
														<option value="3" <?php echo (($row['Type']==3)?'selected':'');?>>Co-Edu.</option>
														</select>
													</div>
													<div class="form_grid_6 ">
														<span class=" label_intro">IsGovt<label style="color:#FF0000"> *</label></span>
														<select name="IsGovt" id="IsGovt" data-required="required" data-message="Choose IsGovt Status" class="chzn-select custom-select" tabindex="4">
														<option value="">Select</option>
														<option value="1" <?php echo (($row['IsGovt']==1)?'selected':'');?>>Yes</option>
														<option value="0" <?php echo (($row['IsGovt']==0)?'selected':'');?>>No</option>
														</select>
													</div>
													<span class="clear"></span>
												</div>
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">District<label style="color:#FF0000"> *</label></span>
														<select name="District" id="District" data-required="required" data-message="Choose District" class="chzn-select custom-select" tabindex="5">
														<option value="">Select</option>
														<?php
														$sql_districts="SELECT Id, Name FROM districts WHERE Id!=8 ORDER BY Name ASC";
														$res_districts=mysql_query($sql_districts, $conn1);
														while($row_districts=mysql_fetch_array($res_districts))
														{ echo '<option value="'.$row_districts['Id'].'" '.(($row_districts['Id']==$row['District'])?'selected':'').'>'.$row_districts['Name'].'</option>'; }
														?>
														</select>
													</div>
													<span class="clear"></span>
												</div>
											</div>
											</li>
										</ul>
									</fieldset>
									</li>
								</ul>
					<!--	</div>	-->							
								<ul>
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
}//check_submit_form()
</script>