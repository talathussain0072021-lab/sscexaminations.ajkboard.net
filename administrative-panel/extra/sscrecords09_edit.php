<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	
	$sql_comb="SELECT GroupName FROM vwsubcombinations10 WHERE Id=".$_REQUEST['CombinationId']."";
	$res_comb=mysql_query($sql_comb, $conn1);
	$row_comb=mysql_fetch_array($res_comb);
	
	if(isset($_REQUEST['update']))
	{
		if($_REQUEST['Sub4_Pass'] == '')
		{
			$Sub4_Code=''; $Sub4_Name=''; $Sub4_Pass='';
		}
		else
		{
			$Sub4_Code=$_REQUEST['Sub4_Code']; $Sub4_Name=$_REQUEST['Sub4_Name']; $Sub4_Pass=$_REQUEST['Sub4_Pass'];
		}
		
		$sql2="UPDATE tbl_resultpi SET
		GROUPID			=	".$_REQUEST['GroupId'].",
		GROUPNAME		=	'".$row_comb['GroupName']."',
		COMBINATIONID	=	".$_REQUEST['CombinationId'].",
		S1_CODE			=	'".$_REQUEST['Sub1_Code']."',
		S1_NAME			=	'".$_REQUEST['Sub1_Name']."',
		S1_PASS			=	'".$_REQUEST['Sub1_Pass']."',
		S2_CODE			=	'".$_REQUEST['Sub2_Code']."',
		S2_NAME			=	'".$_REQUEST['Sub2_Name']."',
		S2_PASS			=	'".$_REQUEST['Sub2_Pass']."',
		S3_CODE			=	'".$_REQUEST['Sub3_Code']."',
		S3_NAME			=	'".$_REQUEST['Sub3_Name']."',
		S3_PASS			=	'".$_REQUEST['Sub3_Pass']."',
		S4_CODE			=	'".$Sub4_Code."',
		S4_NAME			=	'".$Sub4_Name."',
		S4_PASS			=	'".$Sub4_Pass."',
		S5_CODE			=	'".$_REQUEST['Sub5_Code']."',
		S5_NAME			=	'".$_REQUEST['Sub5_Name']."',
		S5_PASS			=	'".$_REQUEST['Sub5_Pass']."',
		S6_CODE			=	'".$_REQUEST['Sub6_Code']."',
		S6_NAME			=	'".$_REQUEST['Sub6_Name']."',
		S6_PASS			=	'".$_REQUEST['Sub6_Pass']."',
		S7_CODE			=	'".$_REQUEST['Sub7_Code']."',
		S7_NAME			=	'".$_REQUEST['Sub7_Name']."',
		S7_PASS			=	'".$_REQUEST['Sub7_Pass']."',
		S8_CODE			=	'".$_REQUEST['Sub8_Code']."',
		S8_NAME			=	'".$_REQUEST['Sub8_Name']."',
		S8_PASS			=	'".$_REQUEST['Sub8_Pass']."',
		S9_CODE			=	'".$_REQUEST['Sub9_Code']."',
		S9_NAME			=	'".$_REQUEST['Sub9_Name']."',
		S9_PASS			=	'".$_REQUEST['Sub9_Pass']."',
		RESULT			=	'".$_REQUEST['Result']."'
		WHERE REGNO		=	'".$_REQUEST['RegistrationNo']."'
		AND ID			=	".$_REQUEST['RID']."";
		$res2=mysql_query($sql2, $conn_sscreslt)or die(mysql_error());
		
		if($res2==1)
		{
			$ins="INSERT INTO tbl_resultlog SET
			ActivityType		=		'ResultUpdation-I',
			ActivityRefNo		=		'".$_REQUEST['ActivityRefNo']."',
			RegNo				=		'".$_REQUEST['RegistrationNo']."',
			StudentId			=		".$_REQUEST['Id'].",
			EmployeeId			=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn_sscreslt);
			
			?><script>alert('Information Processed Successfully.');location.replace('sscrecords09.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('sscrecords09_edit.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
		}
	}//if(isset($_REQUEST['update']))
	else if(isset($_REQUEST['insert']))
	{
		if($_REQUEST['Sub4_Pass'] == '')
		{
			$Sub4_Code=''; $Sub4_Name=''; $Sub4_Pass='';
		}
		else
		{
			$Sub4_Code=$_REQUEST['Sub4_Code']; $Sub4_Name=$_REQUEST['Sub4_Name']; $Sub4_Pass=$_REQUEST['Sub4_Pass'];
		}
		
		if(!empty($_REQUEST['Year']) && !empty($_REQUEST['Year']) && !empty($_REQUEST['Session'])){
		$sql2="INSERT INTO tbl_resultpi SET
		YEAR			=	'".$_REQUEST['Year']."',
		ROLLNO			=	'".$_REQUEST['RollNo']."',
		SESSION			=	'".$_REQUEST['Session']."',
		REGNO			=	'".$_REQUEST['RegistrationNo']."',
		NAME			=	'".strtoupper($_REQUEST['Name'])."',
		FNAME			=	'".strtoupper($_REQUEST['FatherName'])."',
		STATUS			=	'".$_REQUEST['Status']."',
		GROUPID			=	".$_REQUEST['GroupId'].",
		GROUPNAME		=	'".$row_comb['GroupName']."',
		COMBINATIONID	=	".$_REQUEST['CombinationId'].",
		S1_CODE			=	'".$_REQUEST['Sub1_Code']."',
		S1_PASS			=	'".$_REQUEST['Sub1_Pass']."',
		S2_CODE			=	'".$_REQUEST['Sub2_Code']."',
		S2_PASS			=	'".$_REQUEST['Sub2_Pass']."',
		S3_CODE			=	'".$_REQUEST['Sub3_Code']."',
		S3_PASS			=	'".$_REQUEST['Sub3_Pass']."',
		S4_CODE			=	'".$Sub4_Code."',
		S4_NAME			=	'".$Sub4_Name."',
		S4_PASS			=	'".$Sub4_Pass."',
		S5_NAME			=	'".$_REQUEST['Sub5_Name']."',
		S5_PASS			=	'".$_REQUEST['Sub5_Pass']."',
		S6_CODE			=	'".$_REQUEST['Sub6_Code']."',
		S6_NAME			=	'".$_REQUEST['Sub6_Name']."',
		S6_PASS			=	'".$_REQUEST['Sub6_Pass']."',
		S7_CODE			=	'".$_REQUEST['Sub7_Code']."',
		S7_NAME			=	'".$_REQUEST['Sub7_Name']."',
		S7_PASS			=	'".$_REQUEST['Sub7_Pass']."',
		S8_CODE			=	'".$_REQUEST['Sub8_Code']."',
		S8_NAME			=	'".$_REQUEST['Sub8_Name']."',
		S8_PASS			=	'".$_REQUEST['Sub8_Pass']."',
		S9_CODE			=	'".$_REQUEST['Sub9_Code']."',
		S9_NAME			=	'".$_REQUEST['Sub9_Name']."',
		S9_PASS			=	'".$_REQUEST['Sub9_Pass']."',
		RESULT			=	'".$_REQUEST['Result']."'";
		$res2=mysql_query($sql2, $conn_sscreslt);}
		
		if($res2==1)
		{
			$ins="INSERT INTO tbl_resultlog SET
			ActivityType		=		'ResultInsertion-I',
			ActivityRefNo		=		'".$_REQUEST['ActivityRefNo']."',
			RegNo				=		'".$_REQUEST['RegistrationNo']."',
			StudentId			=		".$_REQUEST['Id'].",
			EmployeeId			=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn_sscreslt);
			
			?><script>alert('Information Processed Successfully.');location.replace('sscrecords09.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('sscrecords09_edit.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
		}
	}//else if(isset($_REQUEST['insert']))
	?>
	<?php
	$sql="SELECT Id, Name, FatherName, RegistrationNo, RESULT, RID FROM vwstudentspi WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn_sscreslt);
	$row=mysql_fetch_array($res);
	
	$sql1="SELECT ID FROM tbl_resultpi WHERE REGNO=".$row['RegistrationNo']." AND ID=".$row['RID']."";
	$res1=mysql_query($sql1, $conn_sscreslt);
	$num_rows=mysql_num_rows($res1);
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Update Result</h6>
					</div>
					
					<div class="widget_content">
						<?php if($num_rows > 0){?>
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();">
						<input name="RegistrationNo" id="RegistrationNo" type="hidden" value="<?php echo $row['RegistrationNo'];?>"/>
						<input name="RID" id="RID" type="hidden" value="<?php echo $row['RID'];?>"/>
							<ul>
								<li>
								<fieldset>
									<legend>Result Info</legend>
									<ul>
										<li>
										<div class="form_grid_6">
											<label class="field_title">Student Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="Name" id="Name" type="text" value="<?php echo $row['Name'];?>" class="x_large" readonly/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Father's Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="FatherName" id="FatherName" type="text" value="<?php echo $row['FatherName'];?>" class="x_large" readonly/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Group<span class="req">*</span></label>
											<div class="form_input">
												<select name="GroupId" id="GroupId" data-required="required" data-message="Choose Group" class="chzn-select custom-select" tabindex="1">
												<option value="">Select</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Combination<span class="req">*</span></label>
											<div class="form_input">
												<select name="CombinationId" id="CombinationId" data-required="required" data-message="Choose Combination" class="chzn-select custom-select" tabindex="2">
												<option value="">Select</option>
												</select>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<fieldset>
											<legend>All Subjects</legend>
											<ul>
												<li>
												<table id="tbl-subjects" class="search">
												<tr>
													<td align="center"></td>
													<td align="center"><label style="font-weight:bold;">P1 Subjects</label></td>
													<td align="center"><label style="font-weight:bold;">P1 Pass/Fail</label></td>
													<td align="center"></td>
													<td align="center"><label style="font-weight:bold;">P2 Subjects</label></td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB1.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub1_Name" id="Sub1_Name" type="text" class="x_large" readonly/>
														<input name="Sub1_Code" id="Sub1_Code" type="hidden"/>
														<input name="Sub1_Id" id="Sub1_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub1_Pass" id="Sub1_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="3">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB21.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub21_Name" id="Sub21_Name" type="text" class="x_large" readonly/>
														<input name="Sub21_Code" id="Sub21_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB2.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub2_Name" id="Sub2_Name" type="text" class="x_large" readonly/>
														<input name="Sub2_Code" id="Sub2_Code" type="hidden"/>
														<input name="Sub2_Id" id="Sub2_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub2_Pass" id="Sub2_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="4">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB22.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub22_Name" id="Sub22_Name" type="text" class="x_large" readonly/>
														<input name="Sub22_Code" id="Sub22_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB3.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub3_Name" id="Sub3_Name" type="text" class="x_large" readonly/>
														<input name="Sub3_Code" id="Sub3_Code" type="hidden"/>
														<input name="Sub3_Id" id="Sub3_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub3_Pass" id="Sub3_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="5">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB23.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub23_Name" id="Sub23_Name" type="text" class="x_large" readonly/>
														<input name="Sub23_Code" id="Sub23_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB4.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub4_Name" id="Sub4_Name" type="text" class="x_large" readonly/>
														<input name="Sub4_Code" id="Sub4_Code" type="hidden"/>
														<input name="Sub4_Id" id="Sub4_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub4_Pass" id="Sub4_Pass" data-message="Choose Status" class="chzn-select small-select" tabindex="6">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB24.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub24_Name" id="Sub24_Name" type="text" class="x_large" readonly/>
														<input name="Sub24_Code" id="Sub24_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB5.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub5_Name" id="Sub5_Name" type="text" class="x_large" readonly/>
														<input name="Sub5_Code" id="Sub5_Code" type="hidden"/>
														<input name="Sub5_Id" id="Sub5_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub5_Pass" id="Sub5_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="7">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB25.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub25_Name" id="Sub25_Name" type="text" class="x_large" readonly/>
														<input name="Sub25_Code" id="Sub25_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB6.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub6_Name" id="Sub6_Name" type="text" class="x_large" readonly/>
														<input name="Sub6_Code" id="Sub6_Code" type="hidden"/>
														<input name="Sub6_Id" id="Sub6_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub6_Pass" id="Sub6_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="8">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB26.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub26_Name" id="Sub26_Name" type="text" class="x_large" readonly/>
														<input name="Sub26_Code" id="Sub26_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB7.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub7_Name" id="Sub7_Name" type="text" class="x_large" readonly/>
														<input name="Sub7_Code" id="Sub7_Code" type="hidden"/>
														<input name="Sub7_Id" id="Sub7_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub7_Pass" id="Sub7_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="9">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB27.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub27_Name" id="Sub27_Name" type="text" class="x_large" readonly/>
														<input name="Sub27_Code" id="Sub27_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB8.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub8_Name" id="Sub8_Name" type="text" class="x_large" readonly/>
														<input name="Sub8_Code" id="Sub8_Code" type="hidden"/>
														<input name="Sub8_Id" id="Sub8_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub8_Pass" id="Sub8_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="10">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB28.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub28_Name" id="Sub28_Name" type="text" class="x_large" readonly/>
														<input name="Sub28_Code" id="Sub28_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB9.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub9_Name" id="Sub9_Name" type="text" class="x_large" readonly/>
														<input name="Sub9_Code" id="Sub9_Code" type="hidden"/>
														<input name="Sub9_Id" id="Sub9_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub9_Pass" id="Sub9_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="11">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB29.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub29_Name" id="Sub29_Name" type="text" class="x_large" readonly/>
														<input name="Sub29_Code" id="Sub29_Code" type="hidden"/>
													</td>
												</tr>
												</table>
												</li>
											</ul>
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Result<span class="req">*</span></label>
											<div class="form_input">
												<select name="Result" id="Result" data-required="required" data-message="Choose Result" class="chzn-select small-select" tabindex="12">
												<option value="">Select</option>
												<option value="PASS" <?php echo ((trim($row['RESULT'])=='PASS')?'selected':'');?>>PASS</option>
												<option value="SUPPLY" <?php echo ((trim($row['RESULT'])=='SUPPLY')?'selected':'');?>>SUPPLY</option>
												<option value="ABSENT" <?php echo ((trim($row['RESULT'])=='ABSENT')?'selected':'');?>>ABSENT</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Letter No<span class="req">*</span></label>
											<div class="form_input">
												<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Letter No" class="x_large" maxlength="50" tabindex="13"/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_12">
											<div class="form_input">
												<input type="hidden" name="Id" id="Id" value="<?php echo $_REQUEST['Id'];?>"/>
												<button type="submit" name="update" value="submit" class="btn_small btn_blue" tabindex="14"><span>Update</span></button>
												<button type="reset" class="btn_small btn_blue" onclick="location.replace('sscrecords09_edit.php?Id=<?php echo $_REQUEST['Id'];?>')" tabindex="15"><span>Reset</span></button>
											</div>
											<span class="clear"></span>
										</div>
										</li>
									</ul>
								</fieldset>
								</li>
							</ul>
						</form>
						<?php }//if($num_rows > 0)
						else{?>
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();">
						<input name="RegistrationNo" id="RegistrationNo" type="hidden" value="<?php echo $row['RegistrationNo'];?>"/>
							<ul>
								<li>
								<fieldset>
									<legend>Result Info</legend>
									<ul>
										<li>
										<div class="form_grid_6">
											<label class="field_title">Year<span class="req">*</span></label>
											<div class="form_input">
												<input name="Year" id="Year" type="text" data-required="required" data-message="Enter Year" class="x_large" onkeypress="return isNumber()" maxlength="2" tabindex="1"/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">RollNo<span class="req">*</span></label>
											<div class="form_input">
												<input name="RollNo" id="RollNo" type="text" data-required="required" data-message="Enter RollNo" class="x_large" onkeypress="return isNumber()" maxlength="6" tabindex="2"/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Session<span class="req">*</span></label>
											<div class="form_input">
												<select name="Session" id="Session" data-required="required" data-message="Choose Session" class="chzn-select custom-select" tabindex="3">
												<option value="">Select</option>
												<option value="1">1st Annual</option>
												<option value="2">2nd Annual</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Status<span class="req">*</span></label>
											<div class="form_input">
												<select name="Status" id="Status" data-required="required" data-message="Choose Status" class="chzn-select custom-select" tabindex="4">
												<option value="">Select</option>
												<option value="1">Regular</option>
												<option value="2">Private</option>
												</select>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Student Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="Name" id="Name" type="text" value="<?php echo $row['Name'];?>" class="x_large" readonly/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Father's Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="FatherName" id="FatherName" type="text" value="<?php echo $row['FatherName'];?>" class="x_large" readonly/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Group<span class="req">*</span></label>
											<div class="form_input">
												<select name="GroupId" id="GroupId" data-required="required" data-message="Choose Group" class="chzn-select custom-select" tabindex="5">
												<option value="">Select</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Combination<span class="req">*</span></label>
											<div class="form_input">
												<select name="CombinationId" id="CombinationId" data-required="required" data-message="Choose Combination" class="chzn-select custom-select" tabindex="6">
												<option value="">Select</option>
												</select>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<fieldset>
											<legend>All Subjects</legend>
											<ul>
												<li>
												<table id="tbl-subjects" class="search">
												<tr>
													<td align="center"></td>
													<td align="center"><label style="font-weight:bold;">P1 Subjects</label></td>
													<td align="center"><label style="font-weight:bold;">P1 Pass/Fail</label></td>
													<td align="center"></td>
													<td align="center"><label style="font-weight:bold;">P2 Subjects</label></td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB1.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub1_Name" id="Sub1_Name" type="text" class="x_large" readonly/>
														<input name="Sub1_Code" id="Sub1_Code" type="hidden"/>
														<input name="Sub1_Id" id="Sub1_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub1_Pass" id="Sub1_Pass" class="chzn-select small-select" tabindex="7">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB21.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub21_Name" id="Sub21_Name" type="text" class="x_large" readonly/>
														<input name="Sub21_Code" id="Sub21_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB2.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub2_Name" id="Sub2_Name" type="text" class="x_large" readonly/>
														<input name="Sub2_Code" id="Sub2_Code" type="hidden"/>
														<input name="Sub2_Id" id="Sub2_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub2_Pass" id="Sub2_Pass" class="chzn-select small-select" tabindex="8">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB22.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub22_Name" id="Sub22_Name" type="text" class="x_large" readonly/>
														<input name="Sub22_Code" id="Sub22_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB3.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub3_Name" id="Sub3_Name" type="text" class="x_large" readonly/>
														<input name="Sub3_Code" id="Sub3_Code" type="hidden"/>
														<input name="Sub3_Id" id="Sub3_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub3_Pass" id="Sub3_Pass" class="chzn-select small-select" tabindex="9">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB23.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub23_Name" id="Sub23_Name" type="text" class="x_large" readonly/>
														<input name="Sub23_Code" id="Sub23_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB4.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub4_Name" id="Sub4_Name" type="text" class="x_large" readonly/>
														<input name="Sub4_Code" id="Sub4_Code" type="hidden"/>
														<input name="Sub4_Id" id="Sub4_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub4_Pass" id="Sub4_Pass" class="chzn-select small-select" tabindex="10">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB24.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub24_Name" id="Sub24_Name" type="text" class="x_large" readonly/>
														<input name="Sub24_Code" id="Sub24_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB5.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub5_Name" id="Sub5_Name" type="text" class="x_large" readonly/>
														<input name="Sub5_Code" id="Sub5_Code" type="hidden"/>
														<input name="Sub5_Id" id="Sub5_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub5_Pass" id="Sub5_Pass" class="chzn-select small-select" tabindex="11">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB25.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub25_Name" id="Sub25_Name" type="text" class="x_large" readonly/>
														<input name="Sub25_Code" id="Sub25_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB6.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub6_Name" id="Sub6_Name" type="text" class="x_large" readonly/>
														<input name="Sub6_Code" id="Sub6_Code" type="hidden"/>
														<input name="Sub6_Id" id="Sub6_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub6_Pass" id="Sub6_Pass" class="chzn-select small-select" tabindex="12">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB26.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub26_Name" id="Sub26_Name" type="text" class="x_large" readonly/>
														<input name="Sub26_Code" id="Sub26_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB7.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub7_Name" id="Sub7_Name" type="text" class="x_large" readonly/>
														<input name="Sub7_Code" id="Sub7_Code" type="hidden"/>
														<input name="Sub7_Id" id="Sub7_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub7_Pass" id="Sub7_Pass" class="chzn-select small-select" tabindex="13">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB27.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub27_Name" id="Sub27_Name" type="text" class="x_large" readonly/>
														<input name="Sub27_Code" id="Sub27_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB8.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub8_Name" id="Sub8_Name" type="text" class="x_large" readonly/>
														<input name="Sub8_Code" id="Sub8_Code" type="hidden"/>
														<input name="Sub8_Id" id="Sub8_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub8_Pass" id="Sub8_Pass" class="chzn-select small-select" tabindex="14">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB28.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub28_Name" id="Sub28_Name" type="text" class="x_large" readonly/>
														<input name="Sub28_Code" id="Sub28_Code" type="hidden"/>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB9.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub9_Name" id="Sub9_Name" type="text" class="x_large" readonly/>
														<input name="Sub9_Code" id="Sub9_Code" type="hidden"/>
														<input name="Sub9_Id" id="Sub9_Id" type="hidden"/>
													</td>
													<td>
														<select name="Sub9_Pass" id="Sub9_Pass" class="chzn-select small-select" tabindex="15">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB29.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub29_Name" id="Sub29_Name" type="text" class="x_large" readonly/>
														<input name="Sub29_Code" id="Sub29_Code" type="hidden"/>
													</td>
												</tr>
												</table>
												</li>
											</ul>
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Result<span class="req">*</span></label>
											<div class="form_input">
												<select name="Result" id="Result" class="chzn-select small-select" tabindex="16">
												<option value="">Select</option>
												<option value="PASS" <?php echo ((trim($row['RESULT'])=='PASS')?'selected':'');?>>PASS</option>
												<option value="SUPPLY" <?php echo ((trim($row['RESULT'])=='SUPPLY')?'selected':'');?>>SUPPLY</option>
												<option value="ABSENT" <?php echo ((trim($row['RESULT'])=='ABSENT')?'selected':'');?>>ABSENT</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Letter No<span class="req">*</span></label>
											<div class="form_input">
												<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Letter No" class="x_large" maxlength="50" tabindex="17"/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_12">
											<div class="form_input">
												<input type="hidden" name="Id" id="Id" value="<?php echo $_REQUEST['Id'];?>"/>
												<button type="submit" name="insert" value="submit" class="btn_small btn_blue" tabindex="18"><span>Update</span></button>
												<button type="reset" class="btn_small btn_blue" onclick="location.replace('sscrecords09_edit.php?Id=<?php echo $_REQUEST['Id'];?>')" tabindex="19"><span>Reset</span></button>
											</div>
											<span class="clear"></span>
										</div>
										</li>
									</ul>
								</fieldset>
								</li>
							</ul>
						</form>
						<?php }//else ($num_rows > 0)?>
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
}//check_submit_form
</script>
<script type="text/javascript" src="js/precord-updation09.js"></script>