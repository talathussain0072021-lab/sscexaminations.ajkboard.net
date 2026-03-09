<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql1="UPDATE employees SET
		emp_password			=	'".md5($_REQUEST['emp_password'])."'
		WHERE emp_id			=	".$_SESSION['emp_id']."";
		$res1=mysql_query($sql1, $conn1);
		
		?><script>alert('Information Updated Successfully');location.replace('index.php');</script><?php
	}
	
	$sql="SELECT * FROM employees WHERE emp_id=".$_SESSION['emp_id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	$rights=explode(',',$row['emp_user_rights']);
	?>

	<style>
		.left_label ul li label.field_title {
		  float: left !important;
		  margin-right: 4%;
		  padding-top: 6px;
		  width: 15%;
		}
		.left_label ul li .form_input {
		  margin-left: 20%;
		  position: relative;
		  width: 80%;
		}
	</style>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Update Admin Password</h6>
					</div>
					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_form();" enctype="multipart/form-data">
							<ul>
                          		<li>
								<div class="form_grid_12">
									<label class="field_title">User Name</label>
									<div class="form_input">
										<input name="emp_user_name" id="emp_user_name" type="text" class="limiter" value="<?php echo $row['emp_user_name'];?>" maxlength="30" tabindex="1" disabled="disabled"/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Full Name</label>
									<div class="form_input">
										<input name="emp_full_name" id="emp_full_name" type="text" class="limiter" value="<?php echo $row['emp_full_name'];?>" maxlength="30" tabindex="2" disabled="disabled"/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Password<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<input name="emp_password" id="emp_password" type="password" data-required="required" data-message="Enter Password" maxlength="30" tabindex="3"/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Confirm Password<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<input name="emp_cpassword" id="emp_cpassword" type="password" data-required="required" data-message="Confirm Password" onBlur="if(document.getElementById('emp_password').value!=this.value){alert('Enter Same Passwords');document.getElementById('emp_password').value='';this.value='';document.getElementById('emp_password').focus();}" maxlength="30" tabindex="4"/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="5"><span>Update</span></button>
										<button type="reset" class="btn_small btn_blue" tabindex="6"><span>Reset</span></button>
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
function check_form()
{
	if(!Validate($(".form_container"))){ return false; }
}
</script>