<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$P1Year = !empty($_REQUEST['P1Year']) ? "".$_REQUEST['P1Year']."" : "0";
		$P1RollNo = !empty($_REQUEST['P1RollNo']) ? "".$_REQUEST['P1RollNo']."" : "0";
		
		$PYear = !empty($_REQUEST['PYear']) ? "".$_REQUEST['PYear']."" : "0";
		$PRollNo = !empty($_REQUEST['PRollNo']) ? "".$_REQUEST['PRollNo']."" : "0";
		
		$AdmSubCategory = str_split($_REQUEST['AdmSubCategory'], 1);
		
		$sql="UPDATE students10 SET
		P1Year					=		".$P1Year.",
		P1RollNo				=		".$P1RollNo.",
		P1Session				=		".$_REQUEST['P1Session'].",
		P1RegNo					=		'".$_REQUEST['P1RegNo']."',
		P1Board					=		".$_REQUEST['P1Board'].",
		P1Result				=		'".$_REQUEST['P1Result']."',
		PYear					=		".$PYear.",
		PRollNo					=		".$PRollNo.",
		PSession				=		".$_REQUEST['PSession'].",
		PRegNo					=		'".$_REQUEST['PRegNo']."',
		PBoard					=		".$_REQUEST['PBoard'].",
		PResult					=		'".$_REQUEST['PResult']."',
		IsRegular				=		".$_REQUEST['IsRegular'].",
		AdmCategory				=		".$AdmSubCategory[0].",
		SubCategory				=		".$AdmSubCategory[1]."
		WHERE Id				=		".$_REQUEST['Id']."";
		
		if(mysql_query($sql, $conn1))
		{
			if($_REQUEST['AdmSubCategory'] == '11')
			{
				$sql="UPDATE students10 SET
				RegNo				=		'".$_REQUEST['P1RegNo']."'
				WHERE Id			=		".$_REQUEST['Id']."";
				$resupdt=mysql_query($sql, $conn1);
			}
			else if($_REQUEST['AdmSubCategory'] == '31' || $_REQUEST['AdmSubCategory'] == '41' || $_REQUEST['AdmSubCategory'] == '51' ||
			$_REQUEST['AdmSubCategory'] == '61' || $_REQUEST['AdmSubCategory'] == '75' || $_REQUEST['AdmSubCategory'] == '95')
			{
				$sql="UPDATE students10 SET
				RegNo				=		'".$_REQUEST['PRegNo']."'
				WHERE Id			=		".$_REQUEST['Id']."";
				$resupdt=mysql_query($sql, $conn1);
			}
			
			$ins="INSERT INTO tbl_piilog SET
			ActivityType			=		'BasicInfoUpdation-II',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			StudentId				=		".$_REQUEST['Id'].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn1);
			
			?><script>alert('Student Updated Successfully.');location.replace('allstudents_edit10.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('updtbasicinfo_student10.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
		}
	}
	?>
	<?php
	$sql="SELECT Id, P1Year, P1RollNo, P1Session, P1RegNo, P1Board, P1Result, PYear, PRollNo, PSession, PRegNo, PBoard, PResult, Name, FatherName, IsRegular, AdmCategory, SubCategory FROM vwadmstudents10 WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Update Basic Info</h6>
					</div>

					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();" enctype="multipart/form-data">
							<ul>
								<li>
								<fieldset>
									<legend>Basic Info</legend>
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
											<label class="field_title">P1 Year<span class="req">*</span></label>
											<div class="form_input">
												<input name="P1Year" id="P1Year" type="text" value="<?php echo $row['P1Year'];?>" class="x_large" onkeypress="return isNumber()" maxlength="2" tabindex="1"/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">P1 RollNo<span class="req">*</span></label>
											<div class="form_input">
												<input name="P1RollNo" id="P1RollNo" type="text" value="<?php echo $row['P1RollNo'];?>" class="x_large" onkeypress="return isNumber()" maxlength="6" tabindex="2"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">P1 Session<span class="req">*</span></label>
											<div class="form_input">
												<select name="P1Session" id="P1Session" data-placeholder="Select Session" class="chzn-select custom-select" tabindex="3">
												<option value="0">Select</option>
												<option value="1" <?php echo (($row['P1Session']==1)?'selected':'');?>>1st Annual</option>
												<option value="2" <?php echo (($row['P1Session']==2)?'selected':'');?>>2nd Annual</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">P1 RegNo<span class="req">*</span></label>
											<div class="form_input">
												<input name="P1RegNo" id="P1RegNo" type="text" value="<?php echo $row['P1RegNo'];?>" class="x_large"  maxlength="11" tabindex="4"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">P1 Board<span class="req">*</span></label>
											<div class="form_input">
												<select name="P1Board" id="P1Board" data-placeholder="Select Board" class="chzn-select custom-select" tabindex="5">
												<option value="0">Select</option>
												<?php
												$sql_boards="SELECT Id, Name FROM boards";
												$res_boards=mysql_query($sql_boards, $conn1);
												while($row_boards=mysql_fetch_array($res_boards))
												{ echo '<option value="'.$row_boards['Id'].'" '.(($row['P1Board']==$row_boards['Id'])?'selected':'').'>'.$row_boards['Name'].'</option>'; }
												?>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">P1 Result<span class="req">*</span></label>
											<div class="form_input">
												<select name="P1Result" id="P1Result" data-placeholder="Select Result" class="chzn-select custom-select" tabindex="6">
												<option value="">Select</option>
												<option value="ABSENT" <?php echo (($row['P1Result']=='ABSENT')?'selected':'');?>>ABSENT</option>
												<option value="PASS" <?php echo (($row['P1Result']=='PASS')?'selected':'');?>>PASS</option>
												<option value="FAIL" <?php echo (($row['P1Result']=='FAIL')?'selected':'');?>>FAIL</option>
												<option value="SUPPLY" <?php echo (($row['P1Result']=='SUPPLY')?'selected':'');?>>SUPPLY</option>
												</select>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">P Year<span class="req">*</span></label>
											<div class="form_input">
												<input name="PYear" id="PYear" type="text" value="<?php echo $row['PYear'];?>" class="x_large" onkeypress="return isNumber()" maxlength="2" tabindex="7"/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">P RollNo<span class="req">*</span></label>
											<div class="form_input">
												<input name="PRollNo" id="PRollNo" type="text" value="<?php echo $row['PRollNo'];?>" class="x_large" onkeypress="return isNumber()" maxlength="6" tabindex="8"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">P Session<span class="req">*</span></label>
											<div class="form_input">
												<select name="PSession" id="PSession" data-placeholder="Select Session" class="chzn-select custom-select" tabindex="9">
												<option value="0">Select</option>
												<option value="1" <?php echo (($row['PSession']==1)?'selected':'');?>>1st Annual</option>
												<option value="2" <?php echo (($row['PSession']==2)?'selected':'');?>>2nd Annual</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">P RegNo<span class="req">*</span></label>
											<div class="form_input">
												<input name="PRegNo" id="PRegNo" type="text" value="<?php echo $row['PRegNo'];?>" class="x_large"  maxlength="11" tabindex="10"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">P Board<span class="req">*</span></label>
											<div class="form_input">
												<select name="PBoard" id="PBoard" data-placeholder="Select Board" class="chzn-select custom-select" tabindex="11">
												<option value="0">Select</option>
												<?php
												$sql_boards="SELECT Id, Name FROM boards";
												$res_boards=mysql_query($sql_boards, $conn1);
												while($row_boards=mysql_fetch_array($res_boards))
												{ echo '<option value="'.$row_boards['Id'].'" '.(($row['PBoard']==$row_boards['Id'])?'selected':'').'>'.$row_boards['Name'].'</option>'; }
												?>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">P Result<span class="req">*</span></label>
											<div class="form_input">
												<select name="PResult" id="PResult" data-placeholder="Select Result" class="chzn-select custom-select" tabindex="12">
												<option value="">Select</option>
												<option value="ABSENT" <?php echo (($row['PResult']=='ABSENT')?'selected':'');?>>ABSENT</option>
												<option value="PASS" <?php echo (($row['PResult']=='PASS')?'selected':'');?>>PASS</option>
												<option value="FAIL" <?php echo (($row['PResult']=='FAIL')?'selected':'');?>>FAIL</option>
												<option value="SUPPLY" <?php echo (($row['PResult']=='SUPPLY')?'selected':'');?>>SUPPLY</option>
												</select>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">IsRegular<span class="req">*</span></label>
											<div class="form_input">
												<select name="IsRegular" id="IsRegular" data-required="required" data-message="Choose IsRegular Status" class="chzn-select custom-select" tabindex="13">
												<option value="1" <?php echo (($row['IsRegular']==1)?'selected':'');?>>Yes</option>
												<option value="0" <?php echo (($row['IsRegular']==0)?'selected':'');?>>No</option>
												</select>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Adm Category<span class="req">*</span></label>
											<div class="form_input">
												<select name="AdmSubCategory" id="AdmSubCategory" data-required="required" data-message="Choose Adm Category" class="chzn-select custom-select" tabindex="14">
												<option value="">Select</option>
												<option value="11" <?php echo (($row['AdmCategory'].$row['SubCategory']==11)?'selected':'')?>>Fresh AJK</option>
												<option value="12" <?php echo (($row['AdmCategory'].$row['SubCategory']==12)?'selected':'')?>>Composite AJK</option>
												<option value="13" <?php echo (($row['AdmCategory'].$row['SubCategory']==13)?'selected':'')?>>Fresh Other</option>
												<option value="31" <?php echo (($row['AdmCategory'].$row['SubCategory']==31)?'selected':'')?>>Improvement AJK</option>
												<option value="41" <?php echo (($row['AdmCategory'].$row['SubCategory']==41)?'selected':'')?>>Additional AJK</option>
												<option value="51" <?php echo (($row['AdmCategory'].$row['SubCategory']==51)?'selected':'')?>>Comp.Failure AJK</option>
												<option value="52" <?php echo (($row['AdmCategory'].$row['SubCategory']==52)?'selected':'')?>>Comp.Failure Other</option>
												<option value="61" <?php echo (($row['AdmCategory'].$row['SubCategory']==61)?'selected':'')?>>Compartment AJK</option>
												<option value="62" <?php echo (($row['AdmCategory'].$row['SubCategory']==62)?'selected':'')?>>Compartment Other</option>
												<option value="71" <?php echo (($row['AdmCategory'].$row['SubCategory']==71)?'selected':'')?>>Fresh After Passing Adeeb/Alam/Fazal</option>
												<option value="75" <?php echo (($row['AdmCategory'].$row['SubCategory']==75)?'selected':'')?>>Failure After Passing Adeeb/Alam/Fazal</option>
												<option value="91" <?php echo (($row['AdmCategory'].$row['SubCategory']==91)?'selected':'')?>>Fresh After Passing Shahadat Sanvia/Aama/Khasa</option>
												<option value="95" <?php echo (($row['AdmCategory'].$row['SubCategory']==95)?'selected':'')?>>Failure After Passing Shahadat Sanvia/Aama/Khasa</option>
												</select>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Letter No<span class="req">*</span></label>
											<div class="form_input">
												<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Letter No" class="x_large" maxlength="50" tabindex="15"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_12">
											<div class="form_input">
												<input type="hidden" name="Id" id="Id" value="<?php echo $_REQUEST['Id'];?>"/>
												<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="16"><span>Update</span></button>
												<button type="button" name="reset" class="btn_small btn_blue" onclick="location.replace('updtbasicinfo_student10.php?Id=<?php echo $_REQUEST['Id'];?>')" tabindex="17"><span>Reset</span></button>
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
	var P1RegNo=document.getElementById('P1RegNo').value;
	var P1Board=document.getElementById('P1Board').value;
	var PYear=document.getElementById('PYear').value;
	var PRollNo=document.getElementById('PRollNo').value;
	var PSession=document.getElementById('PSession').value;
	var PRegNo=document.getElementById('PRegNo').value;
	var PBoard=document.getElementById('PBoard').value;
	var PResult=document.getElementById('PResult').value;
	var AdmSubCategory=document.getElementById('AdmSubCategory').value;
	
	if(!Validate($(".form_container"))){ return false; }
	if(AdmSubCategory=='11' || AdmSubCategory=='13')
	{
		if(P1RegNo =='' || P1Board =='0'){ alert('Enter P1 Fields'); return false; }
	}
	
	else if(AdmSubCategory=='31' || AdmSubCategory=='41' || AdmSubCategory=='51' || AdmSubCategory=='52' || AdmSubCategory=='61' || AdmSubCategory=='62')
	{
		if(PYear=='' || PYear=='0' || PRollNo=='' || PRollNo=='0' || PSession =='0' || PRegNo =='' || PBoard =='0' || PResult ==''){ alert('Enter All P Fields'); return false; }
	}
}//check_submit_form()
</script>