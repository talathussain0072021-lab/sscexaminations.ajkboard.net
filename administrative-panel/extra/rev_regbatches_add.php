<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit1']))
	{
		$sql1="SELECT Id, BatchStatus, RegStatus, RevStatus FROM vwregbatches WHERE BatchNo='".$_REQUEST['BatchNo']."' AND SessionId=".$SessionId."";
		$res1=mysql_query($sql1, $conn1);
		$row1=mysql_fetch_array($res1);
		$num_rows=mysql_num_rows($res1);
		
		if($num_rows > 0)
		{
			$BatchStatus=$row1['BatchStatus'];
			if($row1['RegStatus'] == 1)
			{
				$BatchStatus=6;
				$sql4="UPDATE vwregstudents SET
				IsRegistered		=		1
				WHERE BatchId		=		".$row1['Id']."";
				$res4=mysql_query($sql4, $conn1);
				
				$sql5="UPDATE vwregstudents SET
				RegistrationNo		=		CONCAT(".$RegNoAY.",RegInstituteCode,Gender,
											RIGHT(CONCAT('0000', CAST(InstituteSr AS CHAR(4))),4))
				WHERE AdmissionType	!=		3
				AND BatchId			=		".$row1['Id']."";
				$res5=mysql_query($sql5, $conn1);
				
				$sql6="UPDATE vwregstudents SET
				RegistrationNo		=		SSCRegNo
				WHERE AdmissionType	=		3
				AND BatchId			=		".$row1['Id']."";
				$res6=mysql_query($sql6, $conn1);
			}//if($row1['RegStatus'] == 1)
			
			$sql2="UPDATE regbatches SET
			RevStatus			=		1,
			BatchStatus			=		".$BatchStatus."
			WHERE Id			=		".$row1['Id']."";
			$res2=mysql_query($sql2, $conn1);
			
			$sql3="UPDATE regbatchstudents SET
			RevStatus			=		1
			WHERE BatchId		=		".$row1['Id']."";
			$res3=mysql_query($sql3, $conn1);
			?><script>alert('Batch Updated Successfully.');location.replace('rev_regbatches_add.php');</script><?php
		}
		else
		{ ?><script>alert('Batch not Found.');location.replace('rev_regbatches_add.php');</script><?php }
	}//if(isset($_REQUEST['submit1']))
	
	if(isset($_REQUEST['submit2']))
	{
		$sql1="SELECT Id FROM vwregbatches WHERE BatchNo='".$_REQUEST['BatchNo']."' AND SessionId=".$SessionId."";
		$res1=mysql_query($sql1, $conn1);
		$row1=mysql_fetch_array($res1);
		$num_rows=mysql_num_rows($res1);
		
		if($num_rows > 0)
		{
			$sql2="UPDATE regbatches SET
			RevStatus			=		2,
			BatchStatus			=		1
			WHERE Id			=		".$row1['Id']."";
			$res2=mysql_query($sql2, $conn1);
			
			$sql3="UPDATE regbatchstudents SET
			RevStatus			=		2,
			RegistrationNo		=		NULL
			WHERE BatchId		=		".$row1['Id']."";
			$res3=mysql_query($sql3, $conn1);
			
			$sql4="UPDATE vwregstudents SET
			IsRegistered		=		0
			WHERE BatchId		=		".$row1['Id']."";
			$res4=mysql_query($sql4, $conn1);
			
			?><script>alert('Batch Updated Successfully.');location.replace('rev_regbatches_add.php');</script><?php
		}
		else
		{ ?><script>alert('Batch not Found.');location.replace('rev_regbatches_add.php');</script><?php }
	}//if(isset($_REQUEST['submit2']))
	
	if(isset($_REQUEST['submit3']))
	{
		$sql1="SELECT Id FROM vwregbatches WHERE BatchNo='".$_REQUEST['BatchNo']."' AND SessionId=".$SessionId."";
		$res1=mysql_query($sql1, $conn1);
		$row1=mysql_fetch_array($res1);
		$num_rows=mysql_num_rows($res1);
		
		if($num_rows > 0)
		{
			$sql2="UPDATE regbatches SET
			RevStatus			=		0,
			BatchStatus			=		1
			WHERE Id			=		".$row1['Id']."";
			$res2=mysql_query($sql2, $conn1);
			
			$sql3="UPDATE regbatchstudents SET
			RevStatus			=		0,
			RegistrationNo		=		NULL
			WHERE BatchId		=		".$row1['Id']."";
			$res3=mysql_query($sql3, $conn1);
			
			$sql4="UPDATE vwregstudents SET
			IsRegistered		=		0
			WHERE BatchId		=		".$row1['Id']."";
			$res4=mysql_query($sql4, $conn1);
			
			?><script>alert('Batch Updated Successfully.');location.replace('rev_regbatches_add.php');</script><?php
		}
		else
		{ ?><script>alert('Batch not Found.');location.replace('rev_regbatches_add.php');</script><?php }
	}//if(isset($_REQUEST['submit3']))
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
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();" enctype="multipart/form-data">
							<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Batch No<span class="req">*</span></label>
									<div class="form_input">
										<input name="BatchNo" id="BatchNo" type="text" data-required="required" data-message="Enter BatchNo" class="limiter abc" onkeypress="return isNumber()" onblur="update_record();" maxlength="8" tabindex="1"/>
										<input name="SessionId" id="SessionId" type="hidden" value="<?php echo $SessionId;?>"/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Challan No</label>
									<div class="form_input">
										<input name="ChallanNo" id="ChallanNo" type="text" class="limiter" readonly/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Batch Fee</label>
									<div class="form_input">
										<input name="BatchFee" id="BatchFee" type="text" class="limiter" readonly/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Rev Status</label>
									<div class="form_input">
										<input name="RevStatus" id="RevStatus" type="text" class="limiter" readonly/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" name="submit1" value="submit" class="btn_small btn_blue" tabindex="2"><span>Ok</span></button>
										<button type="submit" name="submit2" value="submit" class="btn_small btn_blue" tabindex="3"><span>Not Ok</span></button>
										<button type="submit" name="submit3" value="submit" class="btn_small btn_blue" tabindex="4"><span>Null</span></button>
										<button type="reset" class="btn_small btn_blue" tabindex="5"><span>Reset</span></button>
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
	if(!Validate($(".form_container"))){ return false; }
}//check_submit_form()

$(document).ready(function(){
	load_data();
})
function load_data()
{
	$.ajax
	({
		type: "POST",
		url: "ajax_batchesdata.php",
		dataType: "json",
		success: function(data)
		{
			AppData.RegBatches=data.RegBatches;
		}
	});
}
function update_record()
{
	var BatchNo=document.getElementById('BatchNo').value;
	var SessionId=document.getElementById('SessionId').value;
	
	var BatchInfo = $.grep(AppData.RegBatches, function (e) { return e.BatchNo == BatchNo && e.SessionId == SessionId; })[0];
	
	if(BatchInfo.BatchStatus == 1 || BatchInfo.BatchStatus == 6)
	{
		$("#ChallanNo").val(BatchInfo.ChallanNo);
		$("#BatchFee").val(BatchInfo.BatchFee);
		if(BatchInfo.RevStatus == 1){ $("#RevStatus").val("OK"); }
		else if(BatchInfo.RevStatus == 2){ $("#RevStatus").val("NOT OK"); }
		else if(BatchInfo.RevStatus == 0){ $("#RevStatus").val("PENDING"); }
	}
	else
	{
		$("#BatchNo").val("");
		alert('Check Batch again');
		return false;
	}
}
</script>