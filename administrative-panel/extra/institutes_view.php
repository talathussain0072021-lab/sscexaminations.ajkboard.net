<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	$sql="SELECT * FROM institutes WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>View Institute</h6>
					</div>
					<div class="widget_content">
					<form id="myform" action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();" enctype="multipart/form-data">
					<!--	<div class="elem_extend">	-->
								<ul>
									<li>
									<fieldset>
										<legend>Institute Information</legend>
										<ul>
											<li>
											<div class="form_grid_12 multiline">
												<label class="field_title">General Detail</label>
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">Name<label style="color:#FF0000"> *</label></span>
														<input name="Name" id="Name" type="text" value="<?php echo $row['Name'];?>" class="limiter" readonly/>
													</div>
													<div class="form_grid_6 ">
														<span class=" label_intro">Type<label style="color:#FF0000"> *</label></span>
														<select name="Type" id="Type" data-placeholder="Select Type" class="chzn-select custom-select">
														<option value="">Select</option>
														<option value="1" <?php echo (($row['Type']==1)?'selected':'');?>>Boys</option>
														<option value="2" <?php echo (($row['Type']==2)?'selected':'');?>>Girls</option>
														<option value="3" <?php echo (($row['Type']==3)?'selected':'');?>>Co-Edu.</option>
														</select>
													</div>
													<span class="clear"></span>
												</div>
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">IsGovt<label style="color:#FF0000"> *</label></span>
														<select name="IsGovt" id="IsGovt" data-placeholder="Select IsGovt Status" class="chzn-select custom-select">
														<option value="">Select</option>
														<option value="1" <?php echo (($row['IsGovt']==1)?'selected':'');?>>Yes</option>
														<option value="0" <?php echo (($row['IsGovt']==0)?'selected':'');?>>No</option>
														</select>
													</div>
													<div class="form_grid_6 ">
														<span class=" label_intro">IsSpecial<label style="color:#FF0000"> *</label></span>
														<select name="IsSpecial" id="IsSpecial" data-placeholder="Select IsSpecial Status" class="chzn-select custom-select">
														<option value="0" <?php echo (($row['IsSpecial']==0)?'selected':'');?>>No</option>
														<option value="1" <?php echo (($row['IsSpecial']==1)?'selected':'');?>>Yes</option>
														</select>
													</div>
													<span class="clear"></span>
												</div>
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">Principal</span>
														<input name="Principal" id="Principal" type="text" value="<?php echo $row['Principal'];?>" class="limiter" readonly/>
													</div>
													<div class="form_grid_6 ">
														<span class=" label_intro">Operator</span>
														<input name="Operator" id="Operator" type="text" value="<?php echo $row['Operator'];?>" class="limiter" readonly/>
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
														<span class=" label_intro">ContactNo</span>
														<input name="ContactNo" id="ContactNo" type="text" value="<?php echo $row['ContactNo'];?>" class="limiter" readonly/>
													</div>
													<div class="form_grid_6 ">
														<span class=" label_intro">Fax</span>
														<input name="Fax" id="Fax" type="text" value="<?php echo $row['Fax'];?>" class="limiter" readonly/>
													</div>
													<span class="clear"></span>
												</div>
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">Email</span>
														<input name="Email" id="Email" type="text" value="<?php echo $row['Email'];?>" class="limiter" readonly/>
													</div>
													<div class="form_grid_6 ">
														<span class=" label_intro">District<label style="color:#FF0000"> *</label></span>
														<select name="District" id="District" data-placeholder="Select District" class="chzn-select custom-select">
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
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">ExamDistrict<label style="color:#FF0000"> *</label></span>
														<select name="ExamDistrict" id="ExamDistrict" data-placeholder="Select ExamDistrict" class="chzn-select custom-select">
														<option value="">Select</option>
														<?php
														$sql_districts="SELECT Id, Name FROM districts WHERE Id!=8 ORDER BY Name ASC";
														$res_districts=mysql_query($sql_districts, $conn1);
														while($row_districts=mysql_fetch_array($res_districts))
														{ echo '<option value="'.$row_districts['Id'].'" '.(($row_districts['Id']==$row['ExamDistrict'])?'selected':'').'>'.$row_districts['Name'].'</option>'; }
														?>
														</select>
													</div>
													<div class="form_grid_6 ">
														<span class=" label_intro">Address</span>
														<textarea name="Address" id="Address" class="input_grow" cols="50" rows="5" readonly><?php echo $row['Address'];?></textarea>
													</div>
													<span class="clear"></span>
												</div>
											</div>
											</li>
											
											<li>
											<div class="form_grid_12 multiline">
												<label class="field_title">Other Detail</label>
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">MaleCentre</span>
														<select name="PMaleCentreId" id="PMaleCentreId" data-placeholder="Select MaleCentreId" class="chzn-select custom-select">
														<option value="0">Select</option>
														<?php
														$sql_centres="SELECT Id, Code, Name FROM centres WHERE IsActive=1 AND (Type=1 OR Type=3)";
														$res_centres=mysql_query($sql_centres, $conn1);
														while($row_centres=mysql_fetch_array($res_centres))
														{ echo '<option value="'.$row_centres['Id'].'" '.(($row_centres['Id']==$row['PMaleCentreId'])?'selected':'').'>'.$row_centres['Code'].' '.$row_centres['Name'].'</option>'; }
														?>
														</select>
													</div>
													<div class="form_grid_6 ">
														<span class=" label_intro">FemaleCentre</span>
														<select name="PFemaleCentreId" id="PFemaleCentreId" data-placeholder="Select FemaleCentreId" class="chzn-select custom-select">
														<option value="0">Select</option>
														<?php
														$sql_centres="SELECT Id, Code, Name FROM centres WHERE IsActive=1 AND (Type=2 OR Type=3)";
														$res_centres=mysql_query($sql_centres, $conn1);
														while($row_centres=mysql_fetch_array($res_centres))
														{ echo '<option value="'.$row_centres['Id'].'" '.(($row_centres['Id']==$row['PFemaleCentreId'])?'selected':'').'>'.$row_centres['Code'].' '.$row_centres['Name'].'</option>'; }
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
									<fieldset>
										<legend>Account Information</legend>
										<ul>
											<li>
											<div class="form_grid_12 multiline">
												<label class="field_title">Account Detail</label>
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">Code<label style="color:#FF0000"> *</label></span>
														<input name="Code" id="Code" type="text" value="<?php echo $row['Code'];?>" class="limiter" onkeypress="return isNumber()" maxlength="3" disabled="disabled"/>
													</div>
													<div class="form_grid_6 ">
													</div>
													<span class="clear"></span>
												</div>
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">Password</span>
														<input name="Password" id="Password" type="password" class="limiter" readonly/>
													</div>
													<div class="form_grid_6 ">
														<span class=" label_intro">Confirm Password</span>
														<input name="CPassword" id="CPassword" type="password" onBlur="if(document.getElementById('Password').value!=this.value){alert('Enter Same Passwords');document.getElementById('Password').value='';this.value='';document.getElementById('Password').focus();}" readonly/>
													</div>
													<span class="clear"></span>
												</div>
												<!--
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">Counter</span>
														<input name="inst_counter" id="inst_counter" type="text" value="<?php echo $row['login_counter'];?>" class="limiter" onkeypress="return isNumber()" maxlength="1" tabindex="14"/>
													</div>
													<span class="clear"></span>
												</div>
												-->
											</div>
											</li>
										</ul>
									</fieldset>
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