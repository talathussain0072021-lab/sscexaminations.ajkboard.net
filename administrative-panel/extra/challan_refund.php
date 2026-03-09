<?php include('includes/top.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql="SELECT Id FROM challan_refund WHERE ChallanNo=".$_REQUEST['ChallanNo']."";
		$res=mysql_query($sql, $conn2);
		$num_rows=mysql_num_rows($res);
		if($num_rows > 0){
			
			$insc="UPDATE challan_refund SET
			IsRefunded			=	".$_REQUEST['IsRefunded'].",
			DepartmentId		=	".$_REQUEST['DepartmentId']."
			WHERE ChallanNo		=	".$_REQUEST['ChallanNo']."";
			$resc=mysql_query($insc, $conn2);
			
			if($resc){
				$insc1="INSERT INTO log_challanrefund SET
				ChallanNo			=	".$_REQUEST['ChallanNo'].",
				ActivityType		=	'UPDATE',
				ActivityRefNo		=	'".$_REQUEST['ActivityRefNo']."',
				EmployeeId 			=	".$_SESSION['emp_id']."";
				$resc1=mysql_query($insc1, $conn2);
				echo '<script>parent.jQuery.colorbox.close();parent.location.reload();</script>';
			}
			else
			{ ?><script>alert('Error in Query.');</script><?php }
		}
		else
		{
			$insc="INSERT INTO challan_refund SET
			ChallanNo			=	".$_REQUEST['ChallanNo'].",
			IsRefunded			=	".$_REQUEST['IsRefunded'].",
			DepartmentId		=	".$_REQUEST['DepartmentId']."";
			$resc=mysql_query($insc, $conn2);
			
			if($resc)
			{ 
				$insc2="INSERT INTO log_challanrefund SET
				ChallanNo			=	".$_REQUEST['ChallanNo'].",
				ActivityType		=	'INSERT',
				ActivityRefNo		=	'".$_REQUEST['ActivityRefNo']."',
				EmployeeId 			=	".$_SESSION['emp_id']."";
				
				$resc2=mysql_query($insc2, $conn2);
				echo '<script>parent.jQuery.colorbox.close();parent.location.reload();</script>';
			}
			else
			{ ?><script>alert('Error in Query.');</script><?php }
		}//else
	}
	?>
	<?php
	$sql="SELECT * FROM challan_refund WHERE ChallanNo=".$_REQUEST['ChallanNo']."";
	$res=mysql_query($sql, $conn2);
	$row=mysql_fetch_assoc($res);
	?>

	<div id="iframe_content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
            	
                <!--<a href="voucher_print.php?id=<?php //echo $_REQUEST['id'];?>">
                	<img src="images/table-tools/print_hover.png" height="45" style="float:right"/>
                </a>-->
					<div class="widget_top">
						<span class="h_icon list_image"></span>
                     	<h6 style="float:center; font-size:16px;">Challan Refund</h6>
					</div>
					<div class="widget_content">

						<form action="" method="post" class="form_container left_label" onSubmit="return check_form();">
							<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Challan No<span class="req">*</span></label>
										<div class="form_input">
											<input name="ChallanNo" id="ChallanNo" value="<?php echo $_REQUEST['ChallanNo'];?>" class="limiter" readonly>
										</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Department<span class="req">*</span></label>
										<div class="form_input">
											<select name="DepartmentId" id="DepartmentId" data-required="required" data-message="Choose Department" class="chzn-select custom-select" tabindex="1">
											<option value="">Select</option>
											<?php
											$sql_departments="SELECT id, title FROM departments ORDER BY title ASC";
											$res_departments=mysql_query($sql_departments, $conn2);
											while($row_departments=mysql_fetch_assoc($res_departments))
											{ echo '<option value="'.$row_departments['id'].'" '.(($row_departments['id']==$row['DepartmentId'])?'selected':'').'>'.$row_departments['title'].'</option>'; }
											?>
											</select>
										</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Challan Refund<span class="req">*</span></label>
										<div class="form_input">
											<select name="IsRefunded" id="IsRefunded" data-required="required" data-message="Choose IsRefunded Status" class="chzn-select custom-select" tabindex="2">
											<option value="">Select</option>
											<option value="0" <?php echo ($row['IsRefunded']==0)?'selected':'';?>>Normal</option>
											<option value="1" <?php echo ($row['IsRefunded']==1)?'selected':'';?>>Refunded</option>
											</select>
										</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">App/ Ref No<span class="req">*</span></label>
										<div class="form_input">
											<input name="ActivityRefNo" id="ActivityRefNo" class="limiter" tabindex="3">
										</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
									</div>
									<span class="clear"></span>
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
	<script>
	function check_form()
	{
		if(!Validate($(".form_container"))){ return false; }
	}
	</script>
	<script type="text/javascript" src="js/migration-updation.js"></script>