<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$Medium3 = !empty($_REQUEST['Medium3']) ? "".$_REQUEST['Medium3']."" : "0";
		$Medium4 = !empty($_REQUEST['Medium4']) ? "".$_REQUEST['Medium4']."" : "0";
		$Medium5 = !empty($_REQUEST['Medium5']) ? "".$_REQUEST['Medium5']."" : "0";
		$Medium6 = !empty($_REQUEST['Medium6']) ? "".$_REQUEST['Medium6']."" : "0";
		$Medium7 = !empty($_REQUEST['Medium7']) ? "".$_REQUEST['Medium7']."" : "0";
		$Medium8 = !empty($_REQUEST['Medium8']) ? "".$_REQUEST['Medium8']."" : "0";
		$Medium23 = !empty($_REQUEST['Medium23']) ? "".$_REQUEST['Medium23']."" : "0";
		$Medium24 = !empty($_REQUEST['Medium24']) ? "".$_REQUEST['Medium24']."" : "0";
		$Medium25 = !empty($_REQUEST['Medium25']) ? "".$_REQUEST['Medium25']."" : "0";
		$Medium26 = !empty($_REQUEST['Medium26']) ? "".$_REQUEST['Medium26']."" : "0";
		$Medium27 = !empty($_REQUEST['Medium27']) ? "".$_REQUEST['Medium27']."" : "0";
		$Medium28 = !empty($_REQUEST['Medium28']) ? "".$_REQUEST['Medium28']."" : "0";
		
		$sql="UPDATE students10 SET
		Medium3				=		".$Medium3.",
		Medium4				=		".$Medium4.",
		Medium5				=		".$Medium5.",
		Medium6				=		".$Medium6.",
		Medium7				=		".$Medium7.",
		Medium8				=		".$Medium8.",
		Medium23			=		".$Medium23.",
		Medium24			=		".$Medium24.",
		Medium25			=		".$Medium25.",
		Medium26			=		".$Medium26.",
		Medium27			=		".$Medium27.",
		Medium28			=		".$Medium28."
		WHERE Id			=		".$_REQUEST['Id']."";
		
		if(mysql_query($sql, $conn1))
		{
			$ins="INSERT INTO tbl_piilog SET
			ActivityType			=		'MediumUpdation-II',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			StudentId				=		".$_REQUEST['Id'].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn1);
			
			?><script>alert('Student Updated Successfully.');location.replace('allstudents_edit10.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('updtmedium_student10.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
		}
	}
	?>
	<?php
	$sql="SELECT Id, Name, FatherName, Medium3, Medium4, Medium5, Medium6, Medium7, Medium8, Medium23, Medium24, Medium25, Medium26, Medium27, Medium28, GroupName, CombinationName, Sub3Code, Sub4Code, Sub5Code, Sub6Code, Sub7Code, Sub8Code, Sub23Code, Sub24Code, Sub25Code, Sub26Code, Sub27Code, Sub28Code FROM vwadmstudents10 WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	
	$sql_sub3="SELECT Name FROM subjects WHERE Code=".$row['Sub3Code']."";
	$res_sub3=mysql_query($sql_sub3, $conn1);
	$row_sub3=mysql_fetch_array($res_sub3);
	
	$sql_sub4="SELECT Name FROM subjects WHERE Code=".$row['Sub4Code']."";
	$res_sub4=mysql_query($sql_sub4, $conn1);
	$row_sub4=mysql_fetch_array($res_sub4);
	
	$sql_sub5="SELECT Name FROM subjects WHERE Code=".$row['Sub5Code']."";
	$res_sub5=mysql_query($sql_sub5, $conn1);
	$row_sub5=mysql_fetch_array($res_sub5);
	
	$sql_sub6="SELECT Name FROM subjects WHERE Code=".$row['Sub6Code']."";
	$res_sub6=mysql_query($sql_sub6, $conn1);
	$row_sub6=mysql_fetch_array($res_sub6);
	
	$sql_sub7="SELECT Name FROM subjects WHERE Code=".$row['Sub7Code']."";
	$res_sub7=mysql_query($sql_sub7, $conn1);
	$row_sub7=mysql_fetch_array($res_sub7);
	
	$sql_sub8="SELECT Name FROM subjects WHERE Code=".$row['Sub8Code']."";
	$res_sub8=mysql_query($sql_sub8, $conn1);
	$row_sub8=mysql_fetch_array($res_sub8);
	
	$sql_sub23="SELECT Name FROM subjects WHERE Code=".$row['Sub23Code']."";
	$res_sub23=mysql_query($sql_sub23, $conn1);
	$row_sub23=mysql_fetch_array($res_sub23);
	
	$sql_sub24="SELECT Name FROM subjects WHERE Code=".$row['Sub24Code']."";
	$res_sub24=mysql_query($sql_sub24, $conn1);
	$row_sub24=mysql_fetch_array($res_sub24);
	
	$sql_sub25="SELECT Name FROM subjects WHERE Code=".$row['Sub25Code']."";
	$res_sub25=mysql_query($sql_sub25, $conn1);
	$row_sub25=mysql_fetch_array($res_sub25);
	
	$sql_sub26="SELECT Name FROM subjects WHERE Code=".$row['Sub26Code']."";
	$res_sub26=mysql_query($sql_sub26, $conn1);
	$row_sub26=mysql_fetch_array($res_sub26);
	
	$sql_sub27="SELECT Name FROM subjects WHERE Code=".$row['Sub27Code']."";
	$res_sub27=mysql_query($sql_sub27, $conn1);
	$row_sub27=mysql_fetch_array($res_sub27);
	
	$sql_sub28="SELECT Name FROM subjects WHERE Code=".$row['Sub28Code']."";
	$res_sub28=mysql_query($sql_sub28, $conn1);
	$row_sub28=mysql_fetch_array($res_sub28);
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Update Medium</h6>
					</div>

					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();" enctype="multipart/form-data">
							<ul>
								<li>
								<fieldset>
									<legend>Medium Info</legend>
									<ul>
										<li>
										<div class="form_grid_6">
											<label class="field_title">Student Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="Name" id="Name" type="text" value="<?php echo $row['Name'];?>" class="x_large" disabled/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Father's Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="FatherName" id="FatherName" type="text" value="<?php echo $row['FatherName'];?>" class="x_large" disabled/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Group<span class="req">*</span></label>
											<div class="form_input">
												<input name="GroupName" id="GroupName" type="text" value="<?php echo $row['GroupName'];?>" class="x_large" disabled/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Combination<span class="req">*</span></label>
											<div class="form_input">
												<input name="CombinationName" id="CombinationName" type="text" value="<?php echo $row['CombinationName'];?>" class="x_large" disabled/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<fieldset>
											<legend>All Subjects</legend>
											<ul>
												<li>
												<div class="form_grid_6">
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<span class="input_instruction green">Subject Name</span>
														</div>
														<div class="form_grid_6">
															<span class="input_instruction green">Choose Medium</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<span class="input_instruction green">Subject Name</span>
														</div>
														<div class="form_grid_6">
															<span class="input_instruction green">Choose Medium</span>
														</div>
													</div>
												</div>
												<br />
												</li>
												
												<li>
												<div class="form_grid_6">
													<label class="field_title">Subject 3</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject3" id="Subject3" type="text" value="<?php echo $row_sub3['Name'];?>" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Medium3" id="Medium3" class="radio" type="radio" value="1" tabindex="1" <?php echo (($row['Medium3']==1)?'checked':'');?>/>
															<label class="choice">Urdu</label>
															</span>
															<span>
															<input name="Medium3" id="Medium3" class="radio" type="radio" value="2" tabindex="2" <?php echo (($row['Medium3']==2)?'checked':'');?>/>
															<label class="choice">English</label>
															</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 3</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject23" id="Subject23" type="text" value="<?php echo $row_sub23['Name'];?>" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Medium23" id="Medium23" class="radio" type="radio" value="1" tabindex="3" <?php echo (($row['Medium23']==1)?'checked':'');?>/>
															<label class="choice">Urdu</label>
															</span>
															<span>
															<input name="Medium23" id="Medium23" class="radio" type="radio" value="2" tabindex="4" <?php echo (($row['Medium23']==2)?'checked':'');?>/>
															<label class="choice">English</label>
															</span>
														</div>
													</div>
												</div>
												<br /><br /><br />
												</li>
												
												<li>
												<div class="form_grid_6">
													<label class="field_title">Subject 4</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject4" id="Subject4" type="text" value="<?php echo $row_sub4['Name'];?>" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Medium4" id="Medium4" class="radio" type="radio" value="1" tabindex="5" <?php echo (($row['Medium4']==1)?'checked':'');?>/>
															<label class="choice">Urdu</label>
															</span>
															<span>
															<input name="Medium4" id="Medium4" class="radio" type="radio" value="2" tabindex="6" <?php echo (($row['Medium4']==2)?'checked':'');?>/>
															<label class="choice">English</label>
															</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 4</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject24" id="Subject24" type="text" value="<?php echo $row_sub24['Name'];?>" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Medium24" id="Medium24" class="radio" type="radio" value="1" tabindex="7" <?php echo (($row['Medium24']==1)?'checked':'');?>/>
															<label class="choice">Urdu</label>
															</span>
															<span>
															<input name="Medium24" id="Medium24" class="radio" type="radio" value="2" tabindex="8" <?php echo (($row['Medium24']==2)?'checked':'');?>/>
															<label class="choice">English</label>
															</span>
														</div>
													</div>
												</div>
												<br /><br /><br />
												</li>
												
												<li>
												<div class="form_grid_6">
													<label class="field_title">Subject 5</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject5" id="Subject5" type="text" value="<?php echo $row_sub5['Name'];?>" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Medium5" id="Medium5" class="radio" type="radio" value="1" tabindex="9" <?php echo (($row['Medium5']==1)?'checked':'');?>/>
															<label class="choice">Urdu</label>
															</span>
															<span>
															<input name="Medium5" id="Medium5" class="radio" type="radio" value="2" tabindex="10" <?php echo (($row['Medium5']==2)?'checked':'');?>/>
															<label class="choice">English</label>
															</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 5</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject25" id="Subject25" type="text" value="<?php echo $row_sub25['Name'];?>" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Medium25" id="Medium25" class="radio" type="radio" value="1" tabindex="11" <?php echo (($row['Medium25']==1)?'checked':'');?>/>
															<label class="choice">Urdu</label>
															</span>
															<span>
															<input name="Medium25" id="Medium25" class="radio" type="radio" value="2" tabindex="12" <?php echo (($row['Medium25']==2)?'checked':'');?>/>
															<label class="choice">English</label>
															</span>
														</div>
													</div>
												</div>
												<br /><br /><br />
												</li>
												
												<li>
												<div class="form_grid_6">
													<label class="field_title">Subject 6</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject6" id="Subject6" type="text" value="<?php echo $row_sub6['Name'];?>" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Medium6" id="Medium6" class="radio" type="radio" value="1" tabindex="13" <?php echo (($row['Medium6']==1)?'checked':'');?>/>
															<label class="choice">Urdu</label>
															</span>
															<span>
															<input name="Medium6" id="Medium6" class="radio" type="radio" value="2" tabindex="14" <?php echo (($row['Medium6']==2)?'checked':'');?>/>
															<label class="choice">English</label>
															</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 6</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject26" id="Subject26" type="text" value="<?php echo $row_sub26['Name'];?>" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Medium26" id="Medium26" class="radio" type="radio" value="1" tabindex="15" <?php echo (($row['Medium26']==1)?'checked':'');?>/>
															<label class="choice">Urdu</label>
															</span>
															<span>
															<input name="Medium26" id="Medium26" class="radio" type="radio" value="2" tabindex="16" <?php echo (($row['Medium26']==2)?'checked':'');?>/>
															<label class="choice">English</label>
															</span>
														</div>
													</div>
												</div>
												<br /><br /><br />
												</li>
												
												<li>
												<div class="form_grid_6">
													<label class="field_title">Subject 7</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject7" id="Subject7" type="text" value="<?php echo $row_sub7['Name'];?>" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Medium7" id="Medium7" class="radio" type="radio" value="1" tabindex="17" <?php echo (($row['Medium7']==1)?'checked':'');?>/>
															<label class="choice">Urdu</label>
															</span>
															<span>
															<input name="Medium7" id="Medium7" class="radio" type="radio" value="2" tabindex="18" <?php echo (($row['Medium7']==2)?'checked':'');?>/>
															<label class="choice">English</label>
															</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 7</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject27" id="Subject27" type="text" value="<?php echo $row_sub27['Name'];?>" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Medium27" id="Medium27" class="radio" type="radio" value="1" tabindex="19" <?php echo (($row['Medium27']==1)?'checked':'');?>/>
															<label class="choice">Urdu</label>
															</span>
															<span>
															<input name="Medium27" id="Medium27" class="radio" type="radio" value="2" tabindex="20" <?php echo (($row['Medium27']==2)?'checked':'');?>/>
															<label class="choice">English</label>
															</span>
														</div>
													</div>
												</div>
												<br /><br /><br />
												</li>
												
												<li>
												<div class="form_grid_6">
													<label class="field_title">Subject 8</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject8" id="Subject8" type="text" value="<?php echo $row_sub8['Name'];?>" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Medium8" id="Medium8" class="radio" type="radio" value="1" tabindex="21" <?php echo (($row['Medium8']==1)?'checked':'');?>/>
															<label class="choice">Urdu</label>
															</span>
															<span>
															<input name="Medium8" id="Medium8" class="radio" type="radio" value="2" tabindex="22" <?php echo (($row['Medium8']==2)?'checked':'');?>/>
															<label class="choice">English</label>
															</span>
														</div>
													</div>
												</div>
												<div class="form_grid_6">
													<label class="field_title">Subject 8</label>
													<div class="form_input">
														<div class="form_grid_6 alpha">
															<input name="Subject28" id="Subject28" type="text" value="<?php echo $row_sub28['Name'];?>" class="full" disabled/>
														</div>
														<div class="form_grid_6">
															<span>
															<input name="Medium28" id="Medium28" class="radio" type="radio" value="1" tabindex="23" <?php echo (($row['Medium28']==1)?'checked':'');?>/>
															<label class="choice">Urdu</label>
															</span>
															<span>
															<input name="Medium28" id="Medium28" class="radio" type="radio" value="2" tabindex="24" <?php echo (($row['Medium28']==2)?'checked':'');?>/>
															<label class="choice">English</label>
															</span>
														</div>
													</div>
												</div>
												<br /><br /><br />
												</li>
											</ul>
										</fieldset>
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Letter No<span class="req">*</span></label>
											<div class="form_input">
												<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Letter No" class="x_large" maxlength="50" tabindex="25"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_12">
											<div class="form_input">
												<input type="hidden" name="Id" id="Id" value="<?php echo $_REQUEST['Id'];?>"/>
												<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="26"><span>Update</span></button>
												<button type="button" name="reset" class="btn_small btn_blue" onclick="location.replace('updtmedium_student10.php?Id=<?php echo $_REQUEST['Id'];?>')" tabindex="27"><span>Reset</span></button>
											</div>
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
}//check_submit_form()
</script>