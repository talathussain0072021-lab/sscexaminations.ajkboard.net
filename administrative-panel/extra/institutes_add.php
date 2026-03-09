<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql1="SELECT Code FROM institutes WHERE Code='".$_REQUEST['Code']."'";
		$res1=mysql_query($sql1, $conn1);
		$no_row1=mysql_num_rows($res1);
		
		if($no_row1 > 0)
		{
			echo "<script>"; echo "alert('Code already exists.')"; echo "</script>";
		}
		else
		{
			$sql="INSERT INTO institutes SET
			Name			=	'".strtoupper($_REQUEST['Name'])."',
			Code			=	'".$_REQUEST['Code']."',
			EnCode			=	'".md5($_REQUEST['Code'])."',
			Password		=	'".$_REQUEST['Password']."',
			EnPassword		=	'".md5($_REQUEST['Password'])."',
			Type			=	".$_REQUEST['Type'].",
			IsGovt			=	".$_REQUEST['IsGovt'].",
			IsSpecial		=	".$_REQUEST['IsSpecial'].",
			Principal		=	'".$_REQUEST['Principal']."',
			Operator		=	'".$_REQUEST['Operator']."',
			ContactNo		=	'".$_REQUEST['ContactNo']."',
			Fax				=	'".$_REQUEST['Fax']."',
			Email			=	'".$_REQUEST['Email']."',
			Address			=	'".addslashes($_REQUEST['Address'])."',
			District		=	".$_REQUEST['District'].",
			ExamDistrict	=	".$_REQUEST['ExamDistrict'].",
			IsActive		=	1,
			PMaleCentreId	=	".$_REQUEST['PMaleCentreId'].",
			PFemaleCentreId	=	".$_REQUEST['PFemaleCentreId']."";
			
			if(mysql_query($sql, $conn1))
			{
				?><script>alert('Information Inserted Successfully.');location.replace('institutes.php');</script><?php
			}
			else
			{
				?><script>alert('Error in Query.');location.replace('institutes_add.php');</script><?php
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
						<h6>Add Institute</h6>
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
														<input name="Name" id="Name" type="text" data-required="required" data-message="Enter Name" class="limiter" style="text-transform:uppercase;" maxlength="115" tabindex="1"/>
													</div>
													<div class="form_grid_6 ">
														<span class=" label_intro">Type<label style="color:#FF0000"> *</label></span>
														<select name="Type" id="Type" data-required="required" data-message="Choose Type" class="chzn-select custom-select" tabindex="2">
														<option value="">Select</option>
														<option value="1">Boys</option>
														<option value="2">Girls</option>
														<option value="3">Co-Edu.</option>
														</select>
													</div>
													<span class="clear"></span>
												</div>
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">IsGovt<label style="color:#FF0000"> *</label></span>
														<select name="IsGovt" id="IsGovt" data-required="required" data-message="Choose IsGovt Status" class="chzn-select custom-select" tabindex="3">
														<option value="">Select</option>
														<option value="1">Yes</option>
														<option value="0">No</option>
														</select>
													</div>
													<div class="form_grid_6 ">
														<span class=" label_intro">IsSpecial<label style="color:#FF0000"> *</label></span>
														<select name="IsSpecial" id="IsSpecial" data-required="required" data-message="Choose IsSpecial Status" class="chzn-select custom-select" tabindex="4">
														<option value="0">No</option>
														<option value="1">Yes</option>
														</select>
													</div>
													<span class="clear"></span>
												</div>
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">Principal</span>
														<input name="Principal" id="Principal" type="text" class="limiter" maxlength="50" tabindex="5"/>
													</div>
													<div class="form_grid_6 ">
														<span class=" label_intro">Operator</span>
														<input name="Operator" id="Operator" type="text" class="limiter" maxlength="50" tabindex="6"/>
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
														<input name="ContactNo" id="ContactNo" type="text" class="limiter" onkeypress="return isNumber()" maxlength="15" tabindex="7"/>
													</div>
													<div class="form_grid_6 ">
														<span class=" label_intro">Fax</span>
														<input name="Fax" id="Fax" type="text" class="limiter" maxlength="15" tabindex="8"/>
													</div>
													<span class="clear"></span>
												</div>
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">Email</span>
														<input name="Email" id="Email" type="text" class="limiter" maxlength="50" tabindex="9"/>
													</div>
													<div class="form_grid_6 ">
														<span class=" label_intro">District<label style="color:#FF0000"> *</label></span>
														<select name="District" id="District" data-required="required" data-message="Choose District"  class="chzn-select custom-select" tabindex="10">
														<option value="">Select</option>
														<?php
														$sql_districts="SELECT Id, Name FROM districts WHERE Id!=8 ORDER BY Name ASC";
														$res_districts=mysql_query($sql_districts, $conn1);
														while($row_districts=mysql_fetch_array($res_districts))
														{ echo '<option value="'.$row_districts['Id'].'">'.$row_districts['Name'].'</option>'; }
														?>
														</select>
													</div>
													<span class="clear"></span>
												</div>
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">ExamDistrict<label style="color:#FF0000"> *</label></span>
														<select name="ExamDistrict" id="ExamDistrict" data-required="required" data-message="Choose ExamDistrict" class="chzn-select custom-select" tabindex="11">
														<option value="">Select</option>
														<?php
														$sql_districts="SELECT Id, Name FROM districts WHERE Id!=8 ORDER BY Name ASC";
														$res_districts=mysql_query($sql_districts, $conn1);
														while($row_districts=mysql_fetch_array($res_districts))
														{ echo '<option value="'.$row_districts['Id'].'">'.$row_districts['Name'].'</option>'; }
														?>
														</select>
													</div>
													<div class="form_grid_6 ">
														<span class=" label_intro">Address</span>
														<textarea name="Address" id="Address" class="input_grow" cols="50" rows="5" maxlength="200" tabindex="12"></textarea>
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
														<select name="PMaleCentreId" id="PMaleCentreId" data-placeholder="Choose MaleCentreId" class="chzn-select custom-select" tabindex="13">
														<option value="0">Select</option>
														<?php
														$sql_centres="SELECT Id, Code, Name FROM centres WHERE IsActive=1 AND (Type=1 OR Type=3)";
														$res_centres=mysql_query($sql_centres, $conn1);
														while($row_centres=mysql_fetch_array($res_centres))
														{ echo '<option value="'.$row_centres['Id'].'">'.$row_centres['Code'].' '.$row_centres['Name'].'</option>'; }
														?>
														</select>
													</div>
													<div class="form_grid_6 ">
														<span class=" label_intro">FemaleCentre</span>
														<select name="PFemaleCentreId" id="PFemaleCentreId" data-placeholder="Choose FemaleCentreId" class="chzn-select custom-select" tabindex="14">
														<option value="0">Select</option>
														<?php
														$sql_centres="SELECT Id, Code, Name FROM centres WHERE IsActive=1 AND (Type=2 OR Type=3)";
														$res_centres=mysql_query($sql_centres, $conn1);
														while($row_centres=mysql_fetch_array($res_centres))
														{ echo '<option value="'.$row_centres['Id'].'">'.$row_centres['Code'].' '.$row_centres['Name'].'</option>'; }
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
														<input name="Code" id="Code" type="text" data-required="required" data-message="Enter Code" class="limiter" onkeypress="return isNumber()" maxlength="4" tabindex="15"/>
													</div>
													<div class="form_grid_6 ">
													</div>
													<span class="clear"></span>
												</div>
												<div class="form_input">
													<div class="form_grid_6 alpha">
														<span class=" label_intro">Password<label style="color:#FF0000"> *</label></span>
														<input name="Password" id="Password" type="password" data-required="required" data-message="Enter Password" class="limiter" maxlength="30" tabindex="16"/>
													</div>
													<div class="form_grid_6 ">
														<span class=" label_intro">Confirm Password<label style="color:#FF0000"> *</label></span>
														<input name="CPassword" id="CPassword" type="password" data-required="required" data-message="Confirm Password" class="limiter" onBlur="if(document.getElementById('Password').value!=this.value){alert('Enter Same Passwords');document.getElementById('Password').value='';this.value='';document.getElementById('Password').focus();}" maxlength="30" tabindex="17"/>
													</div>
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
											<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="18"><span>Submit</span></button>
											<button type="reset" class="btn_small btn_blue" tabindex="19"><span>Reset</span></button>
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
	var Password=document.getElementById('Password').value;
	var CPassword=document.getElementById('CPassword').value;
	
	if(!Validate($(".form_container"))){ return false; }
	if(Password.length < 8){alert('Password must be atleast 8 characters long.'); document.getElementById('Password').focus(); return false; }
	if(CPassword==''){ alert('Confirm Password'); document.getElementById('CPassword').focus(); return false; }
}//check_submit_form()
</script>