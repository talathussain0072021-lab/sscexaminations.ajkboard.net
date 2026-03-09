<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Search SSC Admission Form</h6>
					</div>
					
					<div class="widget_content">
						<form action="ssc_adm_formsearched.php" method="post" class="form_container left_label" onSubmit="return check_submit_form();" enctype="multipart/form-data">
								<ul>
									<li>
									<fieldset>
										<legend>Batch Serial Info</legend>
										<ul>
											<li>
											<div class="form_grid_12">
												<label class="field_title">SSC Year<span class="req">*</span></label>
												<div class="form_input">
													<input name="SSCYear" id="SSCYear" type="text" value="" class="limiter" onkeypress="return isNumber()" maxlength="4" tabindex="1"/>
												</div>
											</div>
											</li>
											
											<li>
											<div class="form_grid_12">
												<label class="field_title">SSC Session<span class="req">*</span></label>
												<div class="form_input">
													<select name="SSCSession" id="SSCSession" data-placeholder="Select Session" class="chzn-select custom-select" tabindex="2"/>
													<option value="">Select</option>
													<option value="ANNUAL">Annual</option>
													<option value="SUPPLY">Supply</option>
													</select>
												</div>
											</div>
											</li>
											
											<li>
											<div class="form_grid_12">
												<label class="field_title">SSC Batch No<span class="req">*</span></label>
												<div class="form_input">
													<input name="SSCBatchNo" id="SSCBatchNo" type="text" value="" class="limiter" onkeypress="return isNumber()" maxlength="4" tabindex="3"/>
												</div>
											</div>
											</li>
											
											<li>
											<div class="form_grid_12">
												<label class="field_title">SSC Serial No<span class="req">*</span></label>
												<div class="form_input">
													<input name="SSCSerialNo" id="SSCSerialNo" type="text" value="" class="limiter" onkeypress="return isNumber()" maxlength="4" tabindex="4"/>
												</div>
											</div>
											</li>
											
											
											<li>
											<div class="form_grid_12">
												<div class="form_input">
													<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="5"><span>Search</span></button>
													<button type="button" name="reset" class="btn_small btn_blue" onclick="location.replace('ssc_adm_search_form.php)" tabindex="6"><span>Reset</span></button>
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
	var SSCYear=document.getElementById('SSCYear').value;
	var SSCSession=document.getElementById('SSCSession').value;
	var SSCBatchNo=document.getElementById('SSCBatchNo').value;
	var SSCSerialNo=document.getElementById('SSCSerialNo').value;
	
	
	if(SSCYear==''){ alert('Enter SSC Exam Year'); document.getElementById('SSCYear').focus(); return false; }
	if(SSCSession=''){ alert('Enter SSC Session'); document.getElementById('SSCSession').focus(); return false; }
	if(SSCBatchNo==''){ alert('Enter SSC BatchNo'); document.getElementById('SSCBatchNo').focus(); return false; }
	if(SSCSerialNo==''){ alert('Enter SSC SerialNo'); document.getElementById('SSCSerialNo').focus(); return false; }
	
}//check_submit_form()
</script>