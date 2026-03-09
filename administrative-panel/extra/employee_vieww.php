<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
    <?php
	
	$sql="SELECT * FROM employee WHERE emp_id='".$_REQUEST['emp_id']."'";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	
		if($row['emp_dob']=='0000-00-00')
		{ $emp_dob=''; }
		else
		{ $emp_dob=date('Y-m-d',strtotime($row['emp_dob'])); }
		
		if($row['emp_nic_expiry']=='0000-00-00')
		{ $emp_nic_expiry=''; }
		else
		{ $emp_nic_expiry=date('Y-m-d',strtotime($row['emp_nic_expiry'])); }
		
		if($row['emp_passport_expiry']=='0000-00-00')
		{ $emp_passport_expiry=''; }
		else
		{ $emp_passport_expiry=date('Y-m-d',strtotime($row['emp_passport_expiry'])); }
		
		if($row['emp_hire_date']=='0000-00-00')
		{ $emp_hire_date=''; }
		else
		{ $emp_hire_date=date('Y-m-d',strtotime($row['emp_hire_date'])); }
		
		if($row['emp_contract_date']=='0000-00-00')
		{ $emp_contract_date=''; }
		else
		{ $emp_contract_date=date('Y-m-d',strtotime($row['emp_contract_date'])); }
		
	?>
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						<h6>View Employee</h6>
					</div>
					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" enctype="multipart/form-data">
						  <ul>                          		
								<li>
								<div class="form_grid_12">
									<label class="field_title">Picture</label>
									<div class="form_input">
										
										<img id="output" style="height:150px; width:130px;" src="<?php echo $row['emp_picture']; ?>"/>
										<?php /*if($row['emp_picture']!=''){	?>
										<a class="p_edit" href="<?php echo $row['emp_picture'];?>" target="_blank" original-title="Download">Download</a>
										<?php } */?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Full Name</label>
									<div class="form_input">
										<input name="emp_full_name" type="text" value="<?php echo $row['emp_full_name'];?>" tabindex="2" class="limiter" readonly/>
										<span class="input_instruction green">Enter Complete Name.</span>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Email Address</label>
									<div class="form_input">
										<input name="emp_email" type="text" value="<?php echo $row['emp_email'];?>" tabindex="3" class="limiter" readonly/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Mobile Number</label>
									<div class="form_input">
										<input name="emp_mobile" type="text" value="<?php echo $row['emp_mobile'];?>" tabindex="4" class="limiter" readonly/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Phone Number (Home)</label>
									<div class="form_input">
										<input name="emp_home_phone" type="text" value="<?php echo $row['emp_home_phone'];?>" tabindex="5" class="limiter" readonly/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Employee City</label>
									<div class="form_input">
										<?php
											$sql_city="SELECT * FROM cities WHERE id='".$row['emp_city']."'";
											$res_city=mysql_query($sql_city, $conn1);
											$row_city=mysql_fetch_array($res_city);										
										?>
										<input name="emp_type" type="text" value="<?php echo $row_city['title'];?>" tabindex="6" class="limiter" readonly/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Home Address <!--<span class="label_intro">Address with City and Country.</span>--></label>
									<div class="form_input">
										<textarea name="emp_address" class="input_grow" cols="50" rows="5" tabindex="7" readonly><?php echo stripslashes($row['emp_address']);?></textarea>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Date of Birth</label>
									<div class="form_input">
										<div class=" form_grid_4 alpha">
											<input name="emp_dob" value="<?php echo $emp_dob;?>" type="date" style="width:300px; height:22px;" tabindex="8" readonly/>
										</div>
										<span class="clear"></span>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">CNIC</label>
									<div class="form_input">										
										<div class="form_grid_4 alpha">
											<input name="emp_nic" type="text" placeholder="<?php echo $row['emp_nic'];?>" value="<?php echo $row['emp_nic'];?>" id="cnic" tabindex="9" readonly/>
											<span class=" label_intro">CNIC</span>
										</div>
										<span class="clear"></span>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">CNIC Expiry</label>
									<div class="form_input">
										<div class=" form_grid_4 alpha">
											<input name="emp_nic_expiry" value="<?php echo $emp_nic_expiry;?>" type="date" style="width:300px; height:22px;" tabindex="10" readonly/>
										</div>
										<span class="clear"></span>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Passport Number</label>
									<div class="form_input">
										<input name="emp_passport" type="text" value="<?php echo $row['emp_passport'];?>" tabindex="11" class="limiter" readonly/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Passport Expiry</label>
									<div class="form_input">
										<div class=" form_grid_4 alpha">
											<input name="emp_passport_expiry" value="<?php echo $emp_passport_expiry;?>" type="date" style="width:300px; height:22px;" tabindex="12" readonly/>
										</div>
										<span class="clear"></span>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Hiring Date</label>
									<div class="form_input">
										<div class=" form_grid_4 alpha">
											<input name="emp_hire_date" value="<?php echo $emp_hire_date;?>" type="date" style="width:300px; height:22px;" tabindex="13" readonly/>
										</div>
										<span class="clear"></span>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Contract Date</label>
									<div class="form_input">
										<div class=" form_grid_4 alpha">
											<input name="emp_contract_date" value="<?php echo $emp_contract_date;?>" type="date" style="width:300px; height:22px;" tabindex="14" readonly/>
										</div>
										<span class="clear"></span>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Renewal Period <span class="label_intro">Contract Renewal Period.</span></label>
									<div class="form_input">
										<input name="emp_type" type="text" value="<?php echo $row['emp_contract_renewal_time'];?>" tabindex="15" class="limiter" readonly/>
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
												<div class="radio" id="uniform-undefined"><span><input name="emp_gender" type="radio" tabindex="16" value="Male" class="radio" <?php echo ($row['emp_gender']=='Male')?'checked="checked"':'';?> style="opacity: 0;" disabled="disabled"></span></div>
												<label class="choice">Male</label>
												</span><span class="column_input">
												<div class="radio" id="uniform-undefined"><span><input name="emp_gender" type="radio" tabindex="16" value="Female" class="radio" <?php echo ($row['emp_gender']=='Female')?'checked="checked"':'';?> style="opacity: 0;" disabled="disabled"></span></div>
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
									<label class="field_title">Employee Post</label>
									<div class="form_input">
										<?php
											$sql_type="SELECT * FROM employee_type WHERE id='".$row['emp_type']."'";
											$res_type=mysql_query($sql_type, $conn1);
											$row_type=mysql_fetch_array($res_type);										
										?>
										<input name="emp_type" type="text" value="<?php echo $row_type['title'];?>" tabindex="17" class="limiter" readonly/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Basic Pay</label>
									<div class="form_input">
										<input name="emp_pay_scale" type="text" value="<?php echo $row['emp_pay_scale'];?>" onKeyPress="return isNumberKey(event)" tabindex="18" class="limiter" readonly/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Father Name</label>
									<div class="form_input">
										<input name="emp_father_name" type="text" value="<?php echo $row['emp_father_name'];?>" tabindex="19" class="limiter" readonly/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Mother Name</label>
									<div class="form_input">
										<input name="emp_mother_name" type="text" value="<?php echo $row['emp_mother_name'];?>" tabindex="20" class="limiter" readonly/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Department</label>
									<div class="form_input">
										<?php
											$sql_department="SELECT * FROM departments WHERE id='".$row['emp_department']."'";
											$res_department=mysql_query($sql_department, $conn1);
											$row_department=mysql_fetch_array($res_department);
										?>
										<input name="emp_department" type="text" value="<?php echo $row_department['title'];?>" tabindex="21" class="limiter" readonly/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Account Number</label>
									<div class="form_input">
										<input name="emp_account_number" type="text" value="<?php echo $row['emp_account_number'];?>" tabindex="22" class="limiter" readonly/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Bank Info</label>
									<div class="form_input">
										<input name="emp_bank_name" type="text" value="<?php echo $row['emp_bank_name'];?>" tabindex="23" class="limiter" readonly/>
										<span class="input_instruction green">Bank Name, City and Branch Code.</span>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Tax Number</label>
									<div class="form_input">
										<input name="emp_tax_number" type="text" value="<?php echo $row['emp_tax_number'];?>" tabindex="24" class="limiter" readonly/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Emergency Contact Person</label>
									<div class="form_input">
										<input name="emp_ice_name" type="text" value="<?php echo $row['emp_ice_name'];?>" tabindex="25" class="limiter" readonly/>
										<span class="input_instruction green">Relative to contact in case of Emergency.</span>
									</div>
								</div>
								</li>                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Emergency Contact Number</label>
									<div class="form_input">
										<input name="emp_ice_number" type="text" value="<?php echo $row['emp_ice_number'];?>" tabindex="26" class="limiter" readonly/>
										<span class="input_instruction green">Contact Number of relative in case of Emergency.</span>
									</div>
								</div>
								</li>                             
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Next To Kin</label>
									<div class="form_input">
										<input name="emp_next_to_kin" type="text" value="<?php echo $row['emp_next_to_kin'];?>" tabindex="27" class="limiter" readonly/>
										<span class="input_instruction green">Next To Kin Name.</span>
									</div>
								</div>
								</li> 
                                	
                                <li>
								<div class="form_grid_12">
									<label class="field_title">System Access</label>
									<div class="form_input">
                                    <div class="form_grid_4 alpha">
											<fieldset>
												<legend>System Access</legend>
												<span class="column_input">
												<div class="radio" id="uniform-undefined"><span><input name="emp_system_user" type="radio" tabindex="28" value="1" class="radio" <?php echo ($row['emp_system_user']=='1')?'checked="checked"':'';?> style="opacity: 0;" disabled="disabled"></span></div>
												<label class="choice">Yes</label>
												</span><span class="column_input">
												<div class="radio" id="uniform-undefined"><span><input name="emp_system_user" type="radio" tabindex="28" value="0" class="radio" <?php echo ($row['emp_system_user']=='0')?'checked="checked"':'';?> style="opacity: 0;" disabled="disabled"></span></div>
												<label class="choice">No</label>
												</span>
											</fieldset>
										</div>
																				
										<span class="clear"></span>
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