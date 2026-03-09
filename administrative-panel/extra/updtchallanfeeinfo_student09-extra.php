<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$updt1="UPDATE regbatchstudents SET
		RegistrationFee		=	".$_REQUEST['RegistrationFee']."
		WHERE StudentId		=	".$_REQUEST['Id']."";
		$resupdt1=mysql_query($updt1, $conn1);
		
		$updt2="UPDATE admbatchstudents09 SET
		AdmissionFee		=	".$_REQUEST['AdmissionFee']."
		WHERE StudentId		=	".$_REQUEST['Id']."";
		$resupdt2=mysql_query($updt2, $conn1);
		
		if($resupdt1==1 || $resupdt2==1)
		{
			/*$updt3="UPDATE challans SET
			ChallanNo			=	".$_REQUEST['ChallanNo']."
			WHERE Id			=	".$_REQUEST['StdChallanId']."";
			$resupdt3=mysql_query($updt3, $conn1);*/
			
			$ins="INSERT INTO tbl_pilog SET
			ActivityType			=		'ChallanFeeInfoUpdation-I',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			StudentId				=		".$_REQUEST['Id'].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn1);
			
			?><script>alert('Student Updated Successfully.');location.replace('allstudents_edit09.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('updtchallanfeeinfo_student09.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
		}
	}
	?>
	<?php
	$sql="SELECT Id, Name, FatherName, IsRegular, BatchNo, AdmissionFee, StdChallanId FROM vwadmstudents09 WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	
	$sql1="SELECT ChallanNo FROM challans WHERE Id=".$row['StdChallanId']."";
	$res1=mysql_query($sql1, $conn1);
	$row1=mysql_fetch_array($res1);
	
	$sql2="SELECT BatchNo, RegistrationFee FROM vwregstudents WHERE Id=".$_REQUEST['Id']."";
	$res2=mysql_query($sql2, $conn1);
	$row2=mysql_fetch_array($res2);
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Update Challan/Fee Info</h6>
					</div>

					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();" enctype="multipart/form-data">
						<input name="StdChallanId" id="StdChallanId" type="hidden" value="<?php echo $row['StdChallanId'];?>"/>
							<ul>
								<li>
								<fieldset>
									<legend>Challan/Fee Info</legend>
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
											<label class="field_title">Reg BatchNo<span class="req">*</span></label>
											<div class="form_input">
												<input name="RegBatchNo" id="RegBatchNo" type="text" value="<?php echo $row2['BatchNo'];?>" class="x_large" disabled/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Reg Fee</label>
											<div class="form_input">
												<input name="RegistrationFee" id="RegistrationFee" type="text" value="<?php echo $row2['RegistrationFee'];?>" class="x_large" onkeypress="return isNumber()" maxlength="10" tabindex="1"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Adm BatchNo<span class="req">*</span></label>
											<div class="form_input">
												<input name="AdmBatchNo" id="AdmBatchNo" type="text" value="<?php echo $row['BatchNo'];?>" class="x_large" disabled/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Adm Fee</label>
											<div class="form_input">
												<input name="AdmissionFee" id="AdmissionFee" type="text" value="<?php echo $row['AdmissionFee'];?>" class="x_large" onkeypress="return isNumber()" maxlength="10" tabindex="2"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Challan No (Priv)</label>
											<div class="form_input">
												<input name="ChallanNo" id="ChallanNo" type="text" value="<?php echo $row1['ChallanNo'];?>" class="x_large" onkeypress="return isNumber()" maxlength="12" readonly/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Letter No<span class="req">*</span></label>
											<div class="form_input">
												<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Letter No" class="x_large" maxlength="50" tabindex="3"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_12">
											<div class="form_input">
												<input type="hidden" name="Id" id="Id" value="<?php echo $_REQUEST['Id'];?>"/>
												<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
												<button type="button" name="reset" class="btn_small btn_blue" onclick="location.replace('updtchallanfeeinfo_student09.php?Id=<?php echo $_REQUEST['Id'];?>')" tabindex="5"><span>Reset</span></button>
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