<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql_q1="SELECT ID FROM tbl_resultpii WHERE REG_NO='".$_REQUEST['RegNo']."' AND EXAM_YEAR='".$_REQUEST['Year']."' AND ROLL_NO='".$_REQUEST['RollNo']."' AND EXAM_SESSION='".$_REQUEST['Session']."'";
		$res_q1=mysql_query($sql_q1, $conn_sscreslt);
		$num_rows_q1=mysql_num_rows($res_q1);
		if($num_rows_q1 == 0)
		{
			$Remarks = !empty($_REQUEST['Remarks']) ? "'".$_REQUEST['Remarks']."'" : "NULL";
			
			$sql_grp="SELECT Name FROM subjectgroups WHERE Id=".$_REQUEST['GroupId']."";
			$res_grp=mysql_query($sql_grp, $conn1);
			$row_grp=mysql_fetch_array($res_grp);
			
			if($_REQUEST['Sub8_Pass'] == '' || $_REQUEST['Sub28_Pass'] == '')
			{
				$Sub8_Code=''; $Sub8_Name=''; $Sub8_Pass='';
				$Sub28_Code=''; $Sub28_Name=''; $Sub28_Pass='';
				$S8_Pass='';
			}
			else
			{
				$Sub8_Code=$_REQUEST['Sub8_Code']; $Sub8_Name=$_REQUEST['Sub8_Name']; $Sub8_Pass=$_REQUEST['Sub8_Pass'];
				$Sub28_Code=$_REQUEST['Sub28_Code']; $Sub28_Name=$_REQUEST['Sub28_Name']; $Sub28_Pass=$_REQUEST['Sub28_Pass'];
				$S8_Pass=$_REQUEST['S8_Pass'];
				
			}
			
			$sql="INSERT INTO tbl_resultpii SET
			EXAM_YEAR		=	'".$_REQUEST['Year']."',
			ROLL_NO			=	'".$_REQUEST['RollNo']."',
			EXAM_SESSION	=	'".$_REQUEST['Session']."',
			REG_NO			=	'".$_REQUEST['RegNo']."',
			NAME			=	'".strtoupper($_REQUEST['Name'])."',
			FNAME			=	'".strtoupper($_REQUEST['FatherName'])."',
			DOB				=	'".date('Y-m-d', strtotime($_REQUEST['DOB']))."',
			GENDER			=	'".$_REQUEST['Gender']."',
			RELIGION		=	'".$_REQUEST['Religion']."',
			DIST_CODE		=	'".$_REQUEST['District']."',
			APPEAR_CODE		=	'".$_REQUEST['AppearCode']."',
			GROUPID			=	".$_REQUEST['GroupId'].",
			GROUP_NAME		=	'".$row_grp['Name']."',
			COMBINATIONID	=	".$_REQUEST['CombinationId'].",
			SUB1_PASS		=	'".$_REQUEST['Sub1_Pass']."',
			SUB21_PASS		=	'".$_REQUEST['Sub21_Pass']."',
			S1_PASS			=	'".$_REQUEST['S1_Pass']."',
			SUB2_PASS		=	'".$_REQUEST['Sub2_Pass']."',
			SUB22_PASS		=	'".$_REQUEST['Sub22_Pass']."',
			S2_PASS			=	'".$_REQUEST['S2_Pass']."',
			SUB3_PASS		=	'".$_REQUEST['Sub3_Pass']."',
			SUB31_PASS		=	'".$_REQUEST['Sub31_Pass']."',
			S3_PASS			=	'".$_REQUEST['S3_Pass']."',
			SUB231_PASS		=	'".$_REQUEST['Sub231_Pass']."',
			SUB23_PASS		=	'".$_REQUEST['Sub23_Pass']."',
			S3P_PASS		=	'".$_REQUEST['S3P_Pass']."',
			SUB4_CODE		=	'".$_REQUEST['Sub4_Code']."',
			SUB4_NAME		=	'".$_REQUEST['Sub4_Name']."',
			SUB4_PASS		=	'".$_REQUEST['Sub4_Pass']."',
			SUB24_CODE		=	'".$_REQUEST['Sub24_Code']."',
			SUB24_NAME		=	'".$_REQUEST['Sub24_Name']."',
			SUB24_PASS		=	'".$_REQUEST['Sub24_Pass']."',
			S4_PASS			=	'".$_REQUEST['S4_Pass']."',
			SUB5_CODE		=	'".$_REQUEST['Sub5_Code']."',
			SUB5_NAME		=	'".$_REQUEST['Sub5_Name']."',
			SUB5_PASS		=	'".$_REQUEST['Sub5_Pass']."',
			SUB25_CODE		=	'".$_REQUEST['Sub25_Code']."',
			SUB25_NAME		=	'".$_REQUEST['Sub25_Name']."',
			SUB25_PASS		=	'".$_REQUEST['Sub25_Pass']."',
			SUB251_CODE		=	'".$_REQUEST['Sub251_Code']."',
			SUB251_PASS		=	'".$_REQUEST['Sub251_Pass']."',
			S5_PASS			=	'".$_REQUEST['S5_Pass']."',
			SUB6_CODE		=	'".$_REQUEST['Sub6_Code']."',
			SUB6_NAME		=	'".$_REQUEST['Sub6_Name']."',
			SUB6_PASS		=	'".$_REQUEST['Sub6_Pass']."',
			SUB26_CODE		=	'".$_REQUEST['Sub26_Code']."',
			SUB26_NAME		=	'".$_REQUEST['Sub26_Name']."',
			SUB26_PASS		=	'".$_REQUEST['Sub26_Pass']."',
			SUB261_CODE		=	'".$_REQUEST['Sub261_Code']."',
			SUB261_PASS		=	'".$_REQUEST['Sub261_Pass']."',
			S6_PASS			=	'".$_REQUEST['S6_Pass']."',
			SUB7_CODE		=	'".$_REQUEST['Sub7_Code']."',
			SUB7_NAME		=	'".$_REQUEST['Sub7_Name']."',
			SUB7_PASS		=	'".$_REQUEST['Sub7_Pass']."',
			SUB27_CODE		=	'".$_REQUEST['Sub27_Code']."',
			SUB27_NAME		=	'".$_REQUEST['Sub27_Name']."',
			SUB27_PASS		=	'".$_REQUEST['Sub27_Pass']."',
			SUB271_CODE		=	'".$_REQUEST['Sub271_Code']."',
			SUB271_PASS		=	'".$_REQUEST['Sub271_Pass']."',
			S7_PASS			=	'".$_REQUEST['S7_Pass']."',
			SUB8_CODE		=	'".$Sub8_Code."',
			SUB8_NAME		=	'".$Sub8_Name."',
			SUB8_PASS		=	'".$Sub8_Pass."',
			SUB28_CODE		=	'".$Sub28_Code."',
			SUB28_NAME		=	'".$Sub28_Name."',
			SUB28_PASS		=	'".$Sub28_Pass."',
			S8_PASS			=	'".$S8_Pass."',
			RESULT			=	'".$_REQUEST['Result']."',
			ATTEMPT_LIMIT	=	'".$_REQUEST['AttemptLimit']."',
			REMARKS			=	".$Remarks."";
			$res= mysql_query($sql, $conn_sscreslt) or die(mysql_error());
			
			if($res>0)
			{
				$sql_q1="SELECT ID FROM tbl_resultpii WHERE EXAM_YEAR='".$_REQUEST['Year']."' AND ROLL_NO='".$_REQUEST['RollNo']."' AND EXAM_SESSION='".$_REQUEST['Session']."' AND REG_NO='".$_REQUEST['RegNo']."' ORDER BY ID DESC";
				$res_q1=mysql_query($sql_q1, $conn_sscreslt);
				$row_q1=mysql_fetch_array($res_q1);
				
				$ins="INSERT INTO tbl_resultlog SET
				ActivityType		=		'ResultInsertion-II',
				ActivityRefNo		=		'".$_REQUEST['ActivityRefNo']."',
				RegNo				=		'".$_REQUEST['RegNo']."',
				StudentId			=		".$row_q1['ID'].",
				EmployeeId			=		".$_SESSION['emp_id']."";
				$res=mysql_query($ins, $conn_sscreslt);
				
				?><script>alert('Student Inserted Successfully.');location.replace('sscrecords10.php');</script><?php
			}
			else
			{
				?><script>alert('Error in Query.');location.replace('sscrecords10_add.php');</script><?php
			}
		}//if($num_rows_q1 > 0)
		else
		{
			?><script>alert('RegNo Already Exists in Database.');location.replace('sscrecords10_add.php');</script><?php
		}
	}
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Add Record</h6>
					</div>

					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();">
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
											<label class="field_title">RegNo<span class="req">*</span></label>
											<div class="form_input">
												<input name="RegNo" id="RegNo" type="text" data-required="required" data-message="Enter RegNo" class="x_large"  maxlength="11" tabindex="4"/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Student Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="Name" id="Name" type="text" data-required="required" data-message="Enter Student Name" class="x_large" style="text-transform:uppercase;" maxlength="50" tabindex="5"/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Father's Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="FatherName" id="FatherName" type="text" data-required="required" data-message="Enter Father Name" class="x_large" style="text-transform:uppercase;" maxlength="50" tabindex="6"/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">DOB<span class="req">*</span></label>
											<div class="form_input">
												<input name="DOB" id="DOB" type="text" data-required="required" data-message="Choose DOB" class="x_large myDateofbirth" tabindex="7"/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Gender<span class="req">*</span></label>
											<div class="form_input">
												<select name="Gender" id="Gender" data-required="required" data-message="Choose Gender" class="chzn-select custom-select" tabindex="8">
												<option value="">Select</option>
												<option value="MALE">Male</option>
												<option value="FEMALE">Female</option>
												</select>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Religion<span class="req">*</span></label>
											<div class="form_input">
												<select name="Religion" id="Religion" data-required="required" data-message="Choose Religion" class="chzn-select custom-select" tabindex="9">
												<option value="">Select</option>
												<option value="MUSLIM">Muslim</option>
												<option value="NONMUSLIM">Non Muslim</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">District<span class="req">*</span></label>
											<div class="form_input">
												<select name="District" id="District" data-required="required" data-message="Choose District" class="chzn-select custom-select" tabindex="10">
												<option value="">Select</option>
												</select>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Appear Code<span class="req">*</span></label>
											<div class="form_input">
												<input name="AppearCode" id="AppearCode" type="text" data-required="required" data-message="Enter Appear Code" class="x_large" onkeypress="return isNumber()" maxlength="1" tabindex="11"/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Group<span class="req">*</span></label>
											<div class="form_input">
												<select name="GroupId" id="GroupId" data-required="required" data-message="Choose Group" class="chzn-select custom-select" tabindex="12">
												<option value="">Select</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Combination<span class="req">*</span></label>
											<div class="form_input">
												<select name="CombinationId" id="CombinationId" data-required="required" data-message="Choose Combination" class="chzn-select custom-select" tabindex="13">
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
													<td align="center"><label style="font-weight:bold;">P2 Pass/Fail</label></td>
													<td align="center"><label style="font-weight:bold;">Practical Pass/Fail</label></td>
													<td align="center"><label style="font-weight:bold;">Overall Pass/Fail</label></td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB1.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub1_Name" id="Sub1_Name" type="text" class="x_large" readonly/>
														<input name="Sub1_Code" id="Sub1_Code" type="hidden"/>
													</td>
													<td>
														<select name="Sub1_Pass" id="Sub1_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="14">
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
													<td>
														<select name="Sub21_Pass" id="Sub21_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="15">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td></td>
													<td>
														<select name="S1_Pass" id="S1_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="16">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB2.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub2_Name" id="Sub2_Name" type="text" class="x_large" readonly/>
														<input name="Sub2_Code" id="Sub2_Code" type="hidden"/>
													</td>
													<td>
														<select name="Sub2_Pass" id="Sub2_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="17">
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
													<td>
														<select name="Sub22_Pass" id="Sub22_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="18">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td></td>
													<td>
														<select name="S2_Pass" id="S2_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="19">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB3.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub3_Name" id="Sub3_Name" type="text" class="x_large" readonly/>
														<input name="Sub3_Code" id="Sub3_Code" type="hidden"/>
													</td>
													<td>
														<select name="Sub3_Pass" id="Sub3_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="20">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB23.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub31_Name" id="Sub31_Name" type="text" class="x_large" readonly/>
														<input name="Sub31_Code" id="Sub31_Code" type="hidden"/>
													</td>
													<td>
														<select name="Sub31_Pass" id="Sub31_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="21">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td></td>
													<td>
														<select name="S3_Pass" id="S3_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="22">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB4.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub231_Name" id="Sub231_Name" type="text" class="x_large" readonly/>
														<input name="Sub231_Code" id="Sub231_Code" type="hidden"/>
													</td>
													<td>
														<select name="Sub231_Pass" id="Sub231_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="23">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB24.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub23_Name" id="Sub23_Name" type="text" class="x_large" readonly/>
														<input name="Sub23_Code" id="Sub23_Code" type="hidden"/>
													</td>
													<td>
														<select name="Sub23_Pass" id="Sub23_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="24">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td></td>
													<td>
														<select name="S3P_Pass" id="S3P_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="25">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB5.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub4_Name" id="Sub4_Name" type="text" class="x_large" readonly/>
														<input name="Sub4_Code" id="Sub4_Code" type="hidden"/>
													</td>
													<td>
														<select name="Sub4_Pass" id="Sub4_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="26">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB25.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub24_Name" id="Sub24_Name" type="text" class="x_large" readonly/>
														<input name="Sub24_Code" id="Sub24_Code" type="hidden"/>
													</td>
													<td>
														<select name="Sub24_Pass" id="Sub24_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="27">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td></td>
													<td>
														<select name="S4_Pass" id="S4_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="28">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB6.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub5_Name" id="Sub5_Name" type="text" class="x_large" readonly/>
														<input name="Sub5_Code" id="Sub5_Code" type="hidden"/>
													</td>
													<td>
														<select name="Sub5_Pass" id="Sub5_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="29">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB26.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub25_Name" id="Sub25_Name" type="text" class="x_large" readonly/>
														<input name="Sub25_Code" id="Sub25_Code" type="hidden"/>
														<input name="Sub251_Code" id="Sub251_Code" type="hidden" />
													</td>
													<td>
														<select name="Sub25_Pass" id="Sub25_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="30">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td>
														<select name="Sub251_Pass" id="Sub251_Pass" data-message="Choose Status" class="chzn-select small-select" tabindex="31">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td>
														<select name="S5_Pass" id="S5_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="32">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB7.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub6_Name" id="Sub6_Name" type="text" class="x_large" readonly/>
														<input name="Sub6_Code" id="Sub6_Code" type="hidden"/>
													</td>
													<td>
														<select name="Sub6_Pass" id="Sub6_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="33">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB27.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub26_Name" id="Sub26_Name" type="text" class="x_large" readonly/>
														<input name="Sub26_Code" id="Sub26_Code" type="hidden"/>
														<input name="Sub261_Code" id="Sub261_Code" type="hidden" />
													</td>
													<td>
														<select name="Sub26_Pass" id="Sub26_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="34">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td>
														<select name="Sub261_Pass" id="Sub261_Pass" data-message="Choose Status" class="chzn-select small-select" tabindex="35">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td>
														<select name="S6_Pass" id="S6_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="36">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB8.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub7_Name" id="Sub7_Name" type="text" class="x_large" readonly/>
														<input name="Sub7_Code" id="Sub7_Code" type="hidden"/>
													</td>
													<td>
														<select name="Sub7_Pass" id="Sub7_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="37">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB28.<span style="color:#FF0000;"> *</span></label></td>
													<td>
														<input name="Sub27_Name" id="Sub27_Name" type="text" class="x_large" readonly/>
														<input name="Sub27_Code" id="Sub27_Code" type="hidden"/>
														<input name="Sub271_Code" id="Sub271_Code" type="hidden" />
													</td>
													<td>
														<select name="Sub27_Pass" id="Sub27_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="38">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td>
														<select name="Sub271_Pass" id="Sub271_Pass" data-message="Choose Status" class="chzn-select small-select" tabindex="39">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td>
														<select name="S7_Pass" id="S7_Pass" data-required="required" data-message="Choose Status" class="chzn-select small-select" tabindex="40">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
												</tr>
												<tr>
													<td><label style="font-weight:bold;">SUB9.</label></td>
													<td>
														<input name="Sub8_Name" id="Sub8_Name" type="text" class="x_large" readonly/>
														<input name="Sub8_Code" id="Sub8_Code" type="hidden"/>
													</td>
													<td>
														<select name="Sub8_Pass" id="Sub8_Pass" data-message="Choose Status" class="chzn-select small-select" tabindex="41">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td><label style="font-weight:bold;">SUB29.</label></td>
													<td>
														<input name="Sub28_Name" id="Sub28_Name" type="text" class="x_large" readonly/>
														<input name="Sub28_Code" id="Sub28_Code" type="hidden"/>
													</td>
													<td>
														<select name="Sub28_Pass" id="Sub28_Pass" data-message="Choose Status" class="chzn-select small-select" tabindex="42">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
													</td>
													<td></td>
													<td>
														<select name="S8_Pass" id="S8_Pass" data-message="Choose Status" class="chzn-select small-select" tabindex="43">
														<option value="">Select</option>
														<option value="PASS">PASS</option>
														<option value="FAIL">FAIL</option>
														</select>
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
												<select name="Result" id="Result" data-required="required" data-message="Choose Result" class="chzn-select custom-select" tabindex="44">
												<option value="">Select</option>
												<option value="PASS">PASS</option>
												<option value="SUPPLY">SUPPLY</option>
												<option value="FAIL">FAIL</option>
												<option value="ABSENT">ABSENT</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Attempt Limit<span class="req">*</span></label>
											<div class="form_input">
												<input name="AttemptLimit" id="AttemptLimit" type="text" data-required="required" data-message="Enter Attempt Limit" class="x_large" onkeypress="return isNumber()" maxlength="3" tabindex="45"/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Remarks</label>
											<div class="form_input">
												<input name="Remarks" id="Remarks" type="text" class="x_large" onkeypress="return isNumber()" maxlength="2" tabindex="46"/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Letter No<span class="req">*</span></label>
											<div class="form_input">
												<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Letter No" class="x_large" maxlength="50" tabindex="47"/>
											</div>
										</div>
										<br /><br />
										</li>
										
										<li>
										<div class="form_grid_12">
											<div class="form_input">
												<input type="hidden" name="Id" id="Id" value="<?php echo $_REQUEST['Id'];?>"/>
												<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="48"><span>Submit</span></button>
												<button type="reset" class="btn_small btn_blue" onclick="location.replace('sscrecords10_add.php')" tabindex="49"><span>Reset</span></button>
											</div>
											<span class="clear"></span>
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
<script>
function check_submit_form()
{
	if(!Validate($(".form_container"))){ return false; }
}//check_submit_form
</script>
<script type="text/javascript" src="js/precord-insertion10.js"></script>