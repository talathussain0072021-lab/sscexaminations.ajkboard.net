<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	$sql="SELECT * FROM users WHERE user_id='".$_REQUEST['user_id']."'";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	?>
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						<h6>View Administrator</h6>
					</div>
					<div class="widget_content">
						<form action="" method="post" class="form_container left_label">
						  <ul>
                          		<li>
								<div class="form_grid_12">
									<label class="field_title">User Name</label>
									<div class="form_input">
										<input name="user_name" type="text" value="<?php echo $row['user_name'];?>" disabled="disabled"/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">User Full Name</label>
									<div class="form_input">
										<input name="user_full_name" type="text" value="<?php echo $row['user_full_name'];?>" tabindex="1" class="limiter"/>
										<span class="input_instruction green">Enter Complete Name.</span>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Password</label>
									<div class="form_input">
										<input name="user_password" id="user_password" type="password" tabindex="2"/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Confirm Password</label>
									<div class="form_input">
										<input name="user_cpassword" type="password" tabindex="2" onBlur="if(document.getElementById('user_password').value!=this.value){alert('Enter Same Passwords');document.getElementById('user_password').value='';this.value='';document.getElementById('user_password').focus();}"/>
									</div>
								</div>
								</li>
								
                                <li>
								<div class="form_grid_12">
									<label class="field_title">User Email</label>
									<div class="form_input">
										<input name="user_email" value="<?php echo $row['user_email'];?>" type="text" tabindex="1" class="limiter"/>
										<span class="input_instruction green">Enter Valid Email ID</span>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Gender</label>
									<div class="form_input">
                                    <div class="form_grid_4 alpha">
										<fieldset>
											<legend>Gender</legend>
											<span class="column_input">
											<div class="radio" id="uniform-undefined"><span><input name="user_gender" type="radio" tabindex="17" value="Male" class="radio" <?php echo ($row['user_gender']=='male')?'checked="checked"':'';?> style="opacity: 0;"></span></div>
											<label class="choice">Male</label>
											</span><span class="column_input">
											<div class="radio" id="uniform-undefined"><span><input name="user_gender" type="radio" tabindex="18" value="Female" class="radio" <?php echo ($row['user_gender']=='female')?'checked="checked"':'';?> style="opacity: 0;"></span></div>
											<label class="choice">Female</label>
											</span>
										</fieldset>
										</div>
										<span class="clear"></span>
									</div>
								</div>
								</li>
								
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Date of Birth</label>
									<div class="form_input">
										<div class=" form_grid_4 alpha">
											<input name="user_dob" value="<?php echo date('d/m/Y',strtotime($row['user_dob']));?>" type="text" class="datepicker"/>
										</div>
										<span class="clear"></span>
									</div>
								</div>
								</li>
								
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Address <span class="label_intro">Address with City and Country.</span></label>
									<div class="form_input">
										<textarea name="user_address" class="input_grow" cols="50" rows="5" tabindex="5"><?php echo $row['user_address'];?></textarea>
									</div>
								</div>
								</li>
								
                                <li>
								<div class="form_grid_12">
									<label class="field_title">CNIC</label>
									<div class="form_input">										
										<div class="form_grid_4">
											<input name="user_nic" type="text" placeholder="<?php echo $row['user_nic'];?>" id="cnic" />
											<span class=" label_intro">CNIC</span>
										</div>
										<span class="clear"></span>
									</div>
								</div>
								</li>
								
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Picture</label>
									<div class="form_input">
										<input name="user_picture" type="file">
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="administrators.php"><button type="button" class="btn_small btn_blue"><span>Back</span></button></a>
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