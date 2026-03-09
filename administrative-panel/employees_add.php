<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql1="SELECT * FROM employees WHERE emp_user_name='".$_REQUEST['emp_user_name']."'";
		$res1=mysql_query($sql1, $conn1);
		$no_row1=mysql_num_rows($res1);
		if($no_row1 > 0)
		{
			echo "<script>"; echo "alert('User Name already exists.')"; echo "</script>";
		}
		else
		{
			if($_REQUEST['emp_dob']==''){ $emp_dob=""; }
			else { $emp_dob=date('Y-m-d',strtotime($_REQUEST['emp_dob'])); }
			
			$emp_age='';
			if($emp_dob!='')
			{
				$birthday = new DateTime($_REQUEST['emp_dob']);
				$interval = $birthday->diff(new DateTime);
				$emp_age=$interval->y;
			}
			
			$sql="INSERT INTO employees SET
			emp_user_name				=	'".$_REQUEST['emp_user_name']."',
			EnUserName					=	'".md5($_REQUEST['emp_user_name'])."',
			emp_password				=	'".md5($_REQUEST['emp_password'])."',
			emp_full_name				=	'".$_REQUEST['emp_full_name']."',
			emp_email					=	'".$_REQUEST['emp_email']."',
			emp_city					=	".$_REQUEST['emp_city'].",
			emp_address					=	'".addslashes($_REQUEST['emp_address'])."',
			emp_mobile					=	'".$_REQUEST['emp_mobile']."',
			emp_dob						=	'".$emp_dob."',
			emp_age						=	'".$emp_age."',
			emp_gender					=	".$_REQUEST['emp_gender'].",
			emp_department				=	".$_REQUEST['emp_department'].",
			emp_type					=	".$_REQUEST['emp_type'].",
			emp_user_rights				=	'".implode(',',$_REQUEST['rights'])."'";
			
			if(mysql_query($sql, $conn1))
			{
				?><script>alert('Information Inserted Successfully.');location.replace('employees.php');</script><?php
			}
			else
			{
				?><script>alert('Error in Query.');location.replace('employees_add.php');</script><?php
			}
		}
	}
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Add User</h6>
					</div>
					
					<div class="widget_content">
						<form id="myform" action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();" enctype="multipart/form-data">
						<!--	<div class="elem_extend">	-->
								<ul>
									<li>
									<fieldset>
										<legend>User Information</legend>
										<ul>
											<li>
											<div class="form_grid_12 multiline">
												<label class="field_title">General Detail</label>
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">Full Name<label style="color:#FF0000"> *</label></span>
														<input name="emp_full_name" id="emp_full_name" type="text" class="large limiter" maxlength="30" tabindex="1"/>
													</div>
													<div class="form_grid_6 ">
														<span class=" label_intro">Date of Birth</span>
															<input name="emp_dob" id="emp_dob" type="date" class="large limiter" tabindex="2"/>
													</div>
													<span class="clear"></span>
												</div>
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">Email Address</span>
														<input name="emp_email" type="text" class="large limiter" maxlength="100" tabindex="3"/>
													</div>
													<div class="form_grid_4 ">
														 <fieldset>
															<legend>Gender</legend>
															<span class="column_input">
															<div class="radio" id="uniform-undefined"><span><input name="emp_gender" type="radio" value="1" class="radio" style="opacity: 0;" checked="checked" tabindex="4"></span></div>
															<label class="choice">Male</label>
															</span><span class="column_input">
															<div class="radio" id="uniform-undefined"><span><input name="emp_gender" type="radio" value="2" class="radio" style="opacity: 0;" tabindex="4"></span></div>
															<label class="choice">Female</label>
															</span>
														</fieldset>
													</div>
													<span class="clear"></span>
												</div>
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">User Type</span>
														<select name="emp_type" data-placeholder="Select Type" class="chzn-select custom-select" tabindex="5"><option value="0"></option>
														<?php
														$sql_type="SELECT id, title FROM employee_type ORDER BY title ASC";
														$res_type=mysql_query($sql_type, $conn1);
														while($row_type=mysql_fetch_assoc($res_type))
														{
															echo '<option value="'.$row_type['id'].'">'.$row_type['title'].'</option>';
														}
														?>
														</select>
													</div>
													<div class="form_grid_6">
														<span class=" label_intro">Department</span>
														<select name="emp_department" data-placeholder="Select Department" class="chzn-select custom-select" tabindex="6"><option value="0"></option>
														<?php
														$sql_department="SELECT id, title FROM departments ORDER BY title ASC";
														$res_department=mysql_query($sql_department, $conn1);
														while($row_department=mysql_fetch_assoc($res_department))
														{
															echo '<option value="'.$row_department['id'].'">'.$row_department['title'].'</option>';
														}
														?>
														</select>
													</div>
													<span class="clear"></span>
												</div>
											</div>
											</li>
											
											<li>
											<div class="form_grid_12 multiline">
												<label class="field_title">Address Detail</label>
												<div class="form_input">
													<div class="form_grid_6 alpha">
															<span class=" label_intro">Contact No.</span>
															<input name="emp_mobile" type="text" class="large limiter" maxlength="11" onKeyPress="return isNumber(event)" tabindex="7"/>
													</div>
													<div class="form_grid_6 ">
															<span class=" label_intro">City</span>
															<select name="emp_city" data-placeholder="Select City" class="chzn-select custom-select" tabindex="8"><option value="0"></option>
															<?php
															$sql_city="SELECT id, title FROM cities ORDER BY title ASC";
															$res_city=mysql_query($sql_city, $conn1);
															while($row_city=mysql_fetch_assoc($res_city))
															{
																echo '<option value="'.$row_city['id'].'">'.$row_city['title'].'</option>';
															}
															?>
															</select>
													</div>
													<span class="clear"></span>
												</div>
												<div class="form_input">
													<div class="form_grid_6 alpha">
															<span class=" label_intro">Home Address</span>
															<textarea name="emp_address" class="input_grow" cols="40" rows="5" tabindex="9"></textarea>
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
									<fieldset>
										<legend>Account Information</legend>
										<ul>
											<li>
											<div class="form_grid_12 multiline">
												<label class="field_title">Account Detail</label>
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">User Name<label style="color:#FF0000"> *</label></span>
														<input name="emp_user_name" id="emp_user_name" type="text" class="large limiter" maxlength="30" tabindex="10"/>
													</div>
													<div class="form_grid_6 ">
													</div>
													<span class="clear"></span>
												</div>
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">Password<label style="color:#FF0000"> *</label></span>
														<input name="emp_password" id="emp_password" type="password" class="large limiter" maxlength="30" tabindex="11"/>
													</div>
													<div class="form_grid_6 ">
														<span class=" label_intro">Confirm Password<label style="color:#FF0000"> *</label></span>
														<input name="emp_cpassword" id="emp_cpassword" type="password" class="large limiter" onBlur="if(document.getElementById('emp_password').value!=this.value){alert('Enter Same Passwords');document.getElementById('emp_password').value='';this.value='';document.getElementById('emp_password').focus();}" maxlength="30" tabindex="12"/>
													</div>
													<span class="clear"></span>
												</div>
											</div>
											</li>
											
											<li>
											<div class="form_grid_12">
												<label class="field_title">User Rights</label>
												<div class="form_input">
													<table width="100%" height="600px">
													<tr>
														<td>
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="5" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Notifications</label>
															</span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="100" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Change Password</label>
															</span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="200" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">HR Module (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="201" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">User Types (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="202" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Departments (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="203" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Cities (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="204" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Users (menu)</label>
															</span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="300" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Settings (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="301" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Sessions (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="302" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Exams (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="303" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Subjects (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="304" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Subject Groups (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="305" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Subject Combinations (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="306" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Schedule (menu)</label>
															</span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="400" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Manage Misc. Record (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="401" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">SSC(Part-I) Records (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="402" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">SSC(Part-II) Records (menu)</label>
															</span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="500" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">SSC Registration Records (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="501" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Records (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="50101" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Add RegRecord</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="50102" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Edit/Delete RegRecord</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="50102" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Print RegRecord</label>
															</span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="700" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Manage Academics (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="701" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Institutes (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="702" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Centres (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="703" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Institutes Rights(Reg) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="704" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Institutes Rights(Adm) (Part-I) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="705" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Institutes Rights(Adm) (Part-II) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="706" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Students(Institute Panel) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="707" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Students(Other Panel) (menu)</label>
															</span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="800" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Manage Registration (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="801" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Batches (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="802" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Students (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="80201" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Delete Student</label>
															</span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="900" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Manage Registration Batches (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="901" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Check Batches for Edit/Delete Req. (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="902" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Active/Delete Batches (menu)</label>
															</span>
														</td>
													</tr>
													<!--
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="903" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Check Batches for Reg. (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="904" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Check Batches for Rev. (menu)</label>
															</span>
														</td>
													</tr>
													-->
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="903" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Check Batches for Reg/Rev (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="904" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Check Students for Reg/Rev (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="905" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Check Students for NOC Receiving (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="906" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Check Students for NOC Verification (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="907" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">ChallanNo Updation (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="908" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">ChallanFee Updation (menu)</label>
															</span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1000" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Manage Admission (Part-I) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1001" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Regular Batches (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1002" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Regular Students (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="100201" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Delete Student</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1003" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Private Batches (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1004" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Private Students (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="100401" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Delete Student</label>
															</span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1100" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Manage Admission Batches (Part-I) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1101" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Check Reg. Batches for Delete Req. (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1102" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Delete Reg. Batches (menu)</label>
															</span>
														</td>
													</tr>
													<!--
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1103" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Check Reg. Batches for Adm. (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1104" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Check Reg. Batches for Rev. (menu)</label>
															</span>
														</td>
													</tr>
													-->
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1105" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Check Reg. Batches for Adm/Rev (menu)</label>
															</span>
														</td>
													</tr>
													<!--
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1106" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Check Priv. Batches for Adm. (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1107" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Check Priv. Batches for Rev. (menu)</label>
															</span>
														</td>
													</tr>
													-->
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1108" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Check Students for Adm/Rev (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1109" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">ChallanNo Updation (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1110" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">ChallanFee Updation (menu)</label>
															</span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1200" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Conduct of Exam (Part-I) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1201" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Regular Students (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1202" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Private Students (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1203" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Change Centre(Institute Wise) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1204" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Change Centre(Centre Wise) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1205" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Change Shift(Institute Wise) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1206" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Change Shift(Centre Wise) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1207" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Generate RollNos (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1208" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">RollNo Slips(Regular Students) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="120801" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Delete RollNo Slip</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1209" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">RollNo Slips(Private Students) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="120901" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Delete RollNo Slip</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1210" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Centre Slips(All Students) (menu)</label>
															</span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1300" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">General Edit/Delete (Part-I) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1301" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Edit Student (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="130101" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Migrate Student</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="130102" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Update Picture</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="130103" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Update Group/Combination</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="130104" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Update Medium</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="130105" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Update BasicInfo</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="130106" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Update PersonalInfo</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="130107" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Update ContactInfo</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="130108" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Update CentreInfo</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="130109" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Update ShiftInfo</label>
															</span>
														</td>
													</tr>
													<!--<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="130110" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Update Challan/FeeInfo</label>
															</span>
														</td>
													</tr>-->
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1302" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Delete Student (menu)</label>
															</span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1400" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Manage Admission (Part-II) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1401" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Regular Batches (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1402" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Regular Students (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="140201" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Delete Student</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1403" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Private Batches (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1404" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Private Students (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="140401" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Delete Student</label>
															</span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1500" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Manage Admission Batches (Part-II) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1501" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Check Reg. Batches for Delete Req. (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1502" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Delete Reg. Batches (menu)</label>
															</span>
														</td>
													</tr>
													<!--
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1503" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Check Reg. Batches for Adm. (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1504" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Check Reg. Batches for Rev. (menu)</label>
															</span>
														</td>
													</tr>
													-->
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1505" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Check Reg. Batches for Adm/Rev (menu)</label>
															</span>
														</td>
													</tr>
													<!--
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1506" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Check Priv. Batches for Adm. (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1507" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Check Priv. Batches for Rev. (menu)</label>
															</span>
														</td>
													</tr>
													-->
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1508" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Check Students for Adm/Rev (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1509" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">ChallanNo Updation (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1510" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">ChallanFee Updation (menu)</label>
															</span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1600" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Conduct of Exam (Part-II) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1601" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Regular Students (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1602" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">All Private Students (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1603" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Change Centre(Institute Wise) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1604" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Change Centre(Centre Wise) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1605" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Change Shift(Institute Wise) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1606" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Change Shift(Centre Wise) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1607" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Generate RollNos (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1608" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">RollNo Slips(Regular Students) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="160801" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Delete RollNo Slip</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1609" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">RollNo Slips(Private Students) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="160901" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Delete RollNo Slip</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1610" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Centre Slips(All Students) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1611" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Practical RollNo Slips(All Students) (menu)</label>
															</span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1700" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">General Edit/Delete (Part-II) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1701" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Edit Student (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="170101" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Update Picture</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="170102" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Update Group/Combination</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="170103" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Update Medium</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="170104" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Update BasicInfo</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="170105" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Update PersonalInfo</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="170106" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Update ContactInfo</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="170107" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Update CentreInfo</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="170108" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Update ShiftInfo</label>
															</span>
														</td>
													</tr>
													<!--<tr>
														<td style="padding-left:60px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="170109" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Update Challan/FeeInfo</label>
															</span>
														</td>
													</tr>-->
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="1702" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Delete Student (menu)</label>
															</span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="2100" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">DateSheet (I & II) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="2101" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Date Sheet (menu)</label>
															</span>
														</td>
													</tr>
													
													<tr>
														<td>
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="2300" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Manage Migrations (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="2301" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Students (SSC Part-I) (menu)</label>
															</span>
														</td>
													</tr>
													<tr>
														<td style="padding-left:30px;">
															<span>
															<div class="checker" id="uniform-undefined"><span class="checked">
															<input type="checkbox" value="2302" class="checkbox" name="rights[]" style="opacity: 0;">
															</span></div>
															<label class="choice">Students (SSC Part-II) (menu)</label>
															</span>
														</td>
													</tr>
													
													</table>
													<span class="clear"></span>
												</div>
											</div>
											</li>
										</ul>
									</fieldset>
									</li>
								</ul>
								
								<ul>
									<li>
									<div class="form_grid_12">
										<div class="form_input">
											<button type="submit" name="submit" value="submit" class="btn_small btn_blue"><span>Submit</span></button>
											<button type="reset" class="btn_small btn_blue"><span>Reset</span></button>
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
	var emp_full_name=document.getElementById('emp_full_name').value;
	var emp_dob=document.getElementById('emp_dob').value;
	var emp_user_name=document.getElementById('emp_user_name').value;
	var emp_password=document.getElementById('emp_password').value;
	var emp_cpassword=document.getElementById('emp_cpassword').value;
	
	if(emp_full_name==''){ alert('Enter Full Name'); document.getElementById('emp_full_name').focus(); return false; }
	if(emp_dob==''){ alert('Choose DOB'); document.getElementById('emp_dob').focus(); return false; }
	if(emp_user_name==''){ alert('Enter User Name'); document.getElementById('emp_user_name').focus(); return false; }
	if(emp_password==''){ alert('Enter Password'); document.getElementById('emp_password').focus(); return false; }
	if(emp_cpassword==''){ alert('Confirm Password'); document.getElementById('emp_cpassword').focus(); return false; }
}//check_submit_form()
</script>