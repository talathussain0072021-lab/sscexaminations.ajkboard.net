<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
		if(isset($_REQUEST['print2']))
		{
			$sql2="SELECT Id FROM vwadmstudents10 WHERE P1Year=".$_REQUEST['P1Year']." AND P1RollNo=".$_REQUEST['P1RollNo']." AND P1Session=".$_REQUEST['P1Session']." AND P1Board=".$_REQUEST['P1Board']." AND IsRegular=0 AND AdmCategory=1 AND ExamId=".$ExamId."";
			$res2=mysql_query($sql2, $conn1);
			$row2=mysql_fetch_assoc($res2);
			$num_rows2=mysql_num_rows($res2);
			if($num_rows2 > 0)
			{ ?><script>location.replace('print_stdprvform10.php?Id=<?php echo $row2['Id'];?>&eid=<?php echo $row2['ExamYear'];?>');</script><?php }
			else
			{ ?><script>alert('Student Record not Found.');location.replace('print_form10.php');</script><?php }
		}
	if(isset($_REQUEST['print1']))
	{
		$sql1="SELECT * FROM tbladm_10 WHERE Id=".$_REQUEST['StdudentId']."";
		$res1=mysql_query($conn1, $sql1);
		$row1=mysql_fetch_assoc($res1);
		$num_rows1=mysql_num_rows($res1);
		
		if($num_rows1 > 0)
		{
		?>
		<script>location.replace('print_stdprvform10.php?Id=<?php echo $row1['Id'];?>');</script>
		<?php
		}
		else
		{ ?><script>alert('Student Record not Found.');location.replace('print_form10.php');</script><?php }
	}
	
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Search Private Student for <?php echo $ExamName;?></h6>
					</div>
					
					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_search_form2();">
						<ul>
							<li>
							<fieldset>
								<legend>First Time Cases</legend>
								<ul>
									<li>
									<table class="search">
									<tr>
										<td><label style="font-weight:bold;">SSC-I EXAM YEAR<span style="color:#FF0000;"> *</span></label></td>
										<td><input name="P1Year" id="P1Year" type="text" value="<?php echo $_REQUEST['P1Year'];?>" style="width:30px;" onkeypress="return isNumber()" maxlength="2" tabindex="3"/></td>
										<td><label style="font-weight:bold;">SSC-I ROLLNO<span style="color:#FF0000;"> *</span></label></td>
										<td><input name="P1RollNo" id="P1RollNo" type="text" value="<?php echo $_REQUEST['P1RollNo'];?>" style="width:50px;" onkeypress="return isNumber()" maxlength="6" tabindex="4"/></td>
										<td><label style="font-weight:bold;">SSC-I SESSION<span style="color:#FF0000;"> *</span></label></td>
										<td>
											<select name="P1Session" id="P1Session" data-placeholder="Select Session" class="chzn-select reg-select" tabindex="5"/>
											<option value="">Select</option>
											<option value="1" <?php echo (($_REQUEST['P1Session']==1)?'selected':'');?>>Annual</option>
											<option value="2" <?php echo (($_REQUEST['P1Session']==2)?'selected':'');?>>Supply</option>
											</select>
										</td>
										<td><label style="font-weight:bold;">SSC-I BOARD<span style="color:#FF0000;"> *</span></label></td>
										<td>
											<select name="P1Board" id="P1Board" data-placeholder="Select Board" class="chzn-select reg-select" tabindex="6"/>
											<?php
											$sql_boards="SELECT Id, Name FROM boards WHERE Id NOT IN (36)";
											$res_boards=mysql_query($sql_boards, $conn1);
											while($row_boards=mysql_fetch_assoc($res_boards))
											{ echo '<option value="'.$row_boards['Id'].'" '.(($_REQUEST['P1Board']==$row_boards['Id'])?'selected':'').'>'.$row_boards['Name'].'</option>'; }
											?>
											</select>
										</td>
										<td><button type="submit" name="print2" class="btn_small btn_blue" tabindex="7"><span>Print</span></button></td>
									</tr>
									</table>
									</li>
								</ul>
							</fieldset>
							</li>
						</ul>
						</form>
						<form action="" method="post" class="form_container left_label" onSubmit="return check_search_form1();">
						<ul>
							<li>
							<fieldset>
								<legend>Print Student Form</legend>
								<ul>
									<li>
									<table class="search">
									<tr>
										<td><label style="font-weight:bold;">APPLICATION NO<span style="color:#FF0000;"> *</span></label></td>
										<td><input name="StdudentId" id="StdudentId" type="text" value="<?php echo $_REQUEST['StdudentId'];?>" style="width:100px;" onkeypress="return isNumber()" maxlength="10" tabindex="1"/></td>
										<td><button type="submit" name="print1" class="btn_small btn_blue" tabindex="2"><span>Print</span></button></td>
									</tr>
									</table>
									</li>
								</ul>
							</fieldset>
							</li>
						</ul>
						</form>
						<!--
						<form action="" method="post" class="form_container left_label" onSubmit="return check_search_form4();">
						<ul>
							<li>
							<fieldset>
								<legend>First Time Cases</legend>
								<ul>
									<li>
									<table class="search">
									<tr>
										<td><label style="font-weight:bold;">SSC EXAM YEAR<span style="color:#FF0000;"> *</span></label></td>
										<td><input name="SSCYear" id="SSCYear" type="text" value="<?php echo $_REQUEST['SSCYear'];?>" style="width:30px;" onkeypress="return isNumber()" maxlength="2" tabindex="8"/></td>
										<td><label style="font-weight:bold;">SSC ROLLNO<span style="color:#FF0000;"> *</span></label></td>
										<td><input name="SSCRollNo" id="SSCRollNo" type="text" value="<?php echo $_REQUEST['SSCRollNo'];?>" style="width:50px;" onkeypress="return isNumber()" maxlength="6" tabindex="9"/></td>
										<td><label style="font-weight:bold;">SSC SESSION<span style="color:#FF0000;"> *</span></label></td>
										<td>
											<select name="SSCSession" id="SSCSession" data-placeholder="Select Session" class="chzn-select reg-select" tabindex="10"/>
											<option value="">Select</option>
											<option value="1" <?php echo (($_REQUEST['SSCSession']==1)?'selected':'');?>>Annual</option>
											<option value="2" <?php echo (($_REQUEST['SSCSession']==2)?'selected':'');?>>Supply</option>
											</select>
										</td>
										<td><label style="font-weight:bold;">SSC BOARD<span style="color:#FF0000;"> *</span></label></td>
										<td>
											<select name="SSCBoard" id="SSCBoard" data-placeholder="Select Board" class="chzn-select reg-select" tabindex="11"/>
											<?php
											$sql_boards="SELECT Id, Name FROM boards WHERE Id NOT IN (36)";
											$res_boards=mysql_query($sql_boards, $conn1);
											while($row_boards=mysql_fetch_assoc($res_boards))
											{ echo '<option value="'.$row_boards['Id'].'" '.(($_REQUEST['SSCBoard']==$row_boards['Id'])?'selected':'').'>'.$row_boards['Name'].'</option>'; }
											?>
											</select>
										</td>
										<td><button type="submit" name="print4" class="btn_small btn_blue" tabindex="12"><span>Print</span></button></td>
									</tr>
									</table>
									</li>
								</ul>
							</fieldset>
							</li>
						</ul>
						</form>
						-->
						<form action="" method="post" class="form_container left_label" onSubmit="return check_search_form3();">
						<ul>
							<li>
							<fieldset>
								<legend>Improving Marks/Grade, Additional Subjects, Compartment Cases</legend>
								<ul>
									<li>
									<table class="search">
									<tr>
										<td><label style="font-weight:bold;">SSC-II EXAM YEAR<span style="color:#FF0000;"> *</span></label></td>
										<td><input name="PYear" id="PYear" type="text" value="<?php echo $_REQUEST['PYear'];?>" style="width:30px;" onkeypress="return isNumber()" maxlength="2" tabindex="13"/></td>
										<td><label style="font-weight:bold;">SSC-II ROLLNO<span style="color:#FF0000;"> *</span></label></td>
										<td><input name="PRollNo" id="PRollNo" type="text" value="<?php echo $_REQUEST['PRollNo'];?>" style="width:50px;" onkeypress="return isNumber()" maxlength="6" tabindex="14"/></td>
										<td><label style="font-weight:bold;">SSC-II SESSION<span style="color:#FF0000;"> *</span></label></td>
										<td>
											<select name="PSession" id="PSession" data-placeholder="Select Session" class="chzn-select reg-select" tabindex="15"/>
											<option value="">Select</option>
											<option value="1" <?php echo (($_REQUEST['PSession']==1)?'selected':'');?>>Annual</option>
											<option value="2" <?php echo (($_REQUEST['PSession']==2)?'selected':'');?>>Supply</option>
											</select>
										</td>
										<td><label style="font-weight:bold;">SSC-II BOARD<span style="color:#FF0000;"> *</span></label></td>
										<td>
											<select name="PBoard" id="PBoard" data-placeholder="Select Board" class="chzn-select reg-select" tabindex="16"/>
											<?php
											$sql_boards="SELECT Id, Name FROM boards WHERE Id NOT IN (36)";
											$res_boards=mysql_query($sql_boards, $conn1);
											while($row_boards=mysql_fetch_assoc($res_boards))
											{ echo '<option value="'.$row_boards['Id'].'" '.(($_REQUEST['PBoard']==$row_boards['Id'])?'selected':'').'>'.$row_boards['Name'].'</option>'; }
											?>
											</select>
										</td>
										<td><button type="submit" name="print3" class="btn_small btn_blue" tabindex="17"><span>Print</span></button></td>
									</tr>
									</table>
									</li>
								</ul>
							</fieldset>
							</li>
						</ul>
						</form>
						<form action="" method="post" class="form_container left_label" onSubmit="return check_search_form5();">
						<ul>
							<li>
							<fieldset>
								<legend>Complete Failure Cases</legend>
								<ul>
									<li>
									<table class="search">
									<tr>
										<td><label style="font-weight:bold;">SSC REGNO<span style="color:#FF0000;"> *</span></label></td>
										<td><input name="PRegNo5" id="PRegNo5" type="text" value="<?php echo $_REQUEST['PRegNo5'];?>" style="width:120px;" maxlength="11" tabindex="18"/></td>
										<td><label style="font-weight:bold;">SSC BOARD<span style="color:#FF0000;"> *</span></label></td>
										<td>
											<select name="PBoard5" id="PBoard5" data-placeholder="Select Board" class="chzn-select reg-select" tabindex="19"/>
											<?php
											$sql_boards="SELECT Id, Name FROM boards WHERE Id NOT IN (36)";
											$res_boards=mysql_query($sql_boards, $conn1);
											while($row_boards=mysql_fetch_assoc($res_boards))
											{ echo '<option value="'.$row_boards['Id'].'" '.(($_REQUEST['PBoard5']==$row_boards['Id'])?'selected':'').'>'.$row_boards['Name'].'</option>'; }
											?>
											</select>
										</td>
										<td><button type="submit" name="print5" class="btn_small btn_blue" tabindex="20"><span>Print</span></button></td>
									</tr>
									</table>
									</li>
								</ul>
							</fieldset>
							</li>
						</ul>
						</form>
						<form action="" method="post" class="form_container left_label" onSubmit="return check_search_form6();">
						<ul>
							<li>
							<fieldset>
								<legend>Adeeb/Alam/Fazal & Shahadat Sanvia/Aama/Khasa (Fresh Cases)</legend>
								<ul>
									<li>
									<table class="search">
									<tr>
										<td><label style="font-weight:bold;">NAME<span style="color:#FF0000;"> *</span></label></td>
										<td><input name="Name791" id="Name791" type="text" value="<?php echo $_REQUEST['Name791'];?>" style="width:150px;" maxlength="50" tabindex="21"/></td>
										<td><label style="font-weight:bold;">FATHER NAME<span style="color:#FF0000;"> *</span></label></td>
										<td><input name="FatherName791" id="FatherName791" type="text" value="<?php echo $_REQUEST['FatherName791'];?>" style="width:150px;" maxlength="50" tabindex="22"/></td>
										<td><label style="font-weight:bold;">CATEGORY<span style="color:#FF0000;"> *</span></label></td>
										<td>
											<select name="AdmCategory791" id="AdmCategory791" data-placeholder="Select Adm Category" class="chzn-select reg-select" tabindex="23"/>
											<option value="7" <?php echo (($_REQUEST['AdmCategory791']==7)?'selected':'');?>>Adeeb/Alam/Fazal</option>
											<option value="9" <?php echo (($_REQUEST['AdmCategory791']==9)?'selected':'');?>>Shahadat Sanvia/Aama/Khasa</option>
											</select>
										</td>
										<td><button type="submit" name="print6" class="btn_small btn_blue" tabindex="24"><span>Print</span></button></td>
									</tr>
									</table>
									</li>
								</ul>
							</fieldset>
							</li>
						</ul>
						</form>
						<form action="" method="post" class="form_container left_label" onSubmit="return check_search_form7();">
						<ul>
							<li>
							<fieldset>
								<legend>Adeeb/Alam/Fazal & Shahadat Sanvia/Aama/Khasa (Complete Failure Cases)</legend>
								<ul>
									<li>
									<table class="search">
									<tr>
										<td><label style="font-weight:bold;">SSC REGNO<span style="color:#FF0000;"> *</span></label></td>
										<td><input name="PRegNo792" id="PRegNo792" type="text" value="<?php echo $_REQUEST['PRegNo792'];?>" style="width:120px;" maxlength="11" tabindex="25"/></td>
										<td><label style="font-weight:bold;">SSC BOARD<span style="color:#FF0000;"> *</span></label></td>
										<td>
											<select name="PBoard792" id="PBoard792" data-placeholder="Select Board" class="chzn-select reg-select" tabindex="26"/>
											<?php
											$sql_boards="SELECT Id, Name FROM boards WHERE Id NOT IN (36)";
											$res_boards=mysql_query($sql_boards, $conn1);
											while($row_boards=mysql_fetch_assoc($res_boards))
											{ echo '<option value="'.$row_boards['Id'].'" '.(($_REQUEST['PBoard792']==$row_boards['Id'])?'selected':'').'>'.$row_boards['Name'].'</option>'; }
											?>
											</select>
										</td>
										<td><label style="font-weight:bold;">CATEGORY<span style="color:#FF0000;"> *</span></label></td>
										<td>
											<select name="AdmCategory792" id="AdmCategory792" data-placeholder="Select Adm Category" class="chzn-select reg-select" tabindex="27"/>
											<option value="7" <?php echo (($_REQUEST['AdmCategory792']==7)?'selected':'');?>>Adeeb/Alam/Fazal</option>
											<option value="9" <?php echo (($_REQUEST['AdmCategory792']==9)?'selected':'');?>>Shahadat Sanvia/Aama/Khasa</option>
											</select>
										</td>
										<td><button type="submit" name="print7" class="btn_small btn_blue" tabindex="28"><span>Print</span></button></td>
									</tr>
									</table>
									</li>
								</ul>
							</fieldset>
							</li>
						</ul>
						<ul>
							<li>
							<div class="form_grid_12">
								<div class="invoice_action_bar" style="float:none;">
									<center>
									<table height="70px;" style="font-weight:bolder; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#FF0000;">
									<tr><td align="left">1. Please use Chrome Browser. Chrome Browser can be downloaded from <a href="http://chrome.en.softonic.com/download" target="_blank">here</a></td></tr>
									<tr><td align="left">2. Incase of any query/problem please do let us know at PH: 05827-960070, 05827-960071, 05827-960042 EXT. 149.</td></tr>
									<tr><td align="left">3. Office Timings: 09:00 AM to 04:00 PM (Monday to Friday)</td></tr>
									</table>
									</center>
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
function check_search_form1()
{
	var StdudentId=document.getElementById('StdudentId').value;
	if(StdudentId==''){ alert('Enter Application No'); return false; }
}
function check_search_form2()
{
	var P1Year=document.getElementById('P1Year').value;
	var P1RollNo=document.getElementById('P1RollNo').value;
	var P1Session=document.getElementById('P1Session').value;
	
	if(P1Year==''){ alert('Enter SSC-I Exam Year'); document.getElementById('P1Year').focus(); return false; }
	if(P1RollNo==''){ alert('Enter SSC-I RollNo'); document.getElementById('P1RollNo').focus(); return false; }
	if(P1Session==''){ alert('Choose SSC-I Session'); document.getElementById('P1Session').focus(); return false; }
}
function check_search_form4()
{
	var SSCYear=document.getElementById('SSCYear').value;
	var SSCRollNo=document.getElementById('SSCRollNo').value;
	var SSCSession=document.getElementById('SSCSession').value;
	
	if(SSCYear==''){ alert('Enter SSC Exam Year'); document.getElementById('SSCYear').focus(); return false; }
	if(SSCRollNo==''){ alert('Enter SSC RollNo'); document.getElementById('SSCRollNo').focus(); return false; }
	if(SSCSession==''){ alert('Choose SSC Session'); document.getElementById('SSCSession').focus(); return false; }
}
function check_search_form3()
{
	var PYear=document.getElementById('PYear').value;
	var PRollNo=document.getElementById('PRollNo').value;
	var PSession=document.getElementById('PSession').value;
	
	if(PYear==''){ alert('Enter SSC-II Exam Year'); document.getElementById('PYear').focus(); return false; }
	if(PRollNo==''){ alert('Enter SSC-II RollNo'); document.getElementById('PRollNo').focus(); return false; }
	if(PSession==''){ alert('Choose SSC-II Session'); document.getElementById('PSession').focus(); return false; }
}
function check_search_form5()
{
	var PRegNo5=document.getElementById('PRegNo5').value;
	if(PRegNo5==''){ alert('Enter SSC RegNo'); document.getElementById('PRegNo5').focus(); return false; }
}
function check_search_form6()
{
	var Name791=document.getElementById('Name791').value;
	var FatherName791=document.getElementById('FatherName791').value;
	
	if(Name791==''){ alert('Enter Name'); document.getElementById('Name791').focus(); return false; }
	if(FatherName791==''){ alert('Enter Father Name'); document.getElementById('FatherName791').focus(); return false; }
}
function check_search_form7()
{
	var PRegNo792=document.getElementById('PRegNo792').value;
	if(PRegNo792==''){ alert('Enter SSC RegNo'); document.getElementById('PRegNo792').focus(); return false; }
}
</script>