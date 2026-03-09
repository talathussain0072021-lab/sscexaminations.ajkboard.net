<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql="DELETE FROM tbl_sscregistration 
		WHERE RegNo			=		'".$_REQUEST['RegNo']."'";
		
		if(mysql_query($sql, $conn_sscreg))
		{
			$ins="INSERT INTO tbl_sscreglog SET
			ActivityType			=		'RegRecordDeletion',
			ActivityDescription		=		'Record Deleted for ".$_REQUEST['RegNo']."',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			RegNo					=		'".$_REQUEST['RegNo']."',
			StudentId				=		".$_REQUEST['Id'].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn_sscreg);
			
			$sql_q1="SELECT Id FROM tbl_studentspi WHERE RegistrationNo='".$_REQUEST['RegNo']."'";
			$res_q1=mysql_query($sql_q1, $conn_sscreslt);
			$row_q1=mysql_fetch_assoc($res_q1);
			$num_rows_q1=mysql_num_rows($res_q1);
			if($num_rows_q1 > 0)
			{
				$sql="DELETE FROM tbl_studentspi
				WHERE Id				=		".$row_q1['Id']."";
				$res=mysql_query($sql, $conn_sscreslt);
				
				$ins="INSERT INTO tbl_resultlog SET
				ActivityType			=		'RecordDeletion-I',
				ActivityDescription		=		'SSC-I Record Deleted for ".$_REQUEST['RegNo']."',
				ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
				RegNo					=		'".$_REQUEST['RegNo']."',
				StudentId				=		".$row_q1['Id'].",
				EmployeeId				=		".$_SESSION['emp_id']."";
				$res=mysql_query($ins, $conn_sscreslt);
			}
			
			$sql_q2="SELECT ID FROM tbl_resultpii WHERE REGNO='".$_REQUEST['RegNo']."'";
			$res_q2=mysql_query($sql_q2, $conn_sscreslt);
			$row_q2=mysql_fetch_assoc($res_q2);
			$num_rows_q2=mysql_num_rows($res_q2);
			if($num_rows_q2 > 0)
			{
				$sql="DELETE FROM tbl_resultpii
				WHERE ID				=		".$row_q2['ID']."";
				$res=mysql_query($sql, $conn_sscreslt);
				
				$ins="INSERT INTO tbl_resultlog SET
				ActivityType			=		'RecordDeletion-II',
				ActivityDescription		=		'SSC-II Record Deleted for ".$_REQUEST['RegNo']."',
				ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
				RegNo					=		'".$_REQUEST['RegNo']."',
				StudentId				=		".$row_q2['ID'].",
				EmployeeId				=		".$_SESSION['emp_id']."";
				$res=mysql_query($ins, $conn_sscreslt);
			}
			
			$sql_q3="SELECT Id FROM students WHERE SSCRegNo='".$_REQUEST['RegNo']."' AND SSCBoard=1";
			$res_q3=mysql_query($sql_q3, $conn1);
			$row_q3=mysql_fetch_assoc($res_q3);
			$num_rows_q3=mysql_num_rows($res_q3);
			if($num_rows_q3 > 0)
			{
				$sql="DELETE FROM students
				WHERE Id				=		".$row_q3['Id']."";
				$res=mysql_query($sql, $conn1);
				
				$ins="INSERT INTO tbl_pilog SET
				ActivityType			=		'RecordDeletion-I',
				ActivityDescription		=		'SSC-I Record Deleted for ".$_REQUEST['RegNo']."',
				ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
				StudentId				=		".$row_q3['Id'].",
				EmployeeId				=		".$_SESSION['emp_id']."";
				$res=mysql_query($ins, $conn1);
			}
			
			$sql_q4="SELECT Id FROM students10 WHERE RegNo='".$_REQUEST['RegNo']."'";
			$res_q4=mysql_query($sql_q4, $conn1);
			$row_q4=mysql_fetch_assoc($res_q4);
			$num_rows_q4=mysql_num_rows($res_q4);
			if($num_rows_q4 > 0)
			{
				$sql="DELETE FROM students10
				WHERE Id				=		".$row_q4['Id']."";
				$res=mysql_query($sql, $conn1);
				
				$ins="INSERT INTO tbl_piilog SET
				ActivityType			=		'RecordDeletion-II',
				ActivityDescription		=		'SSC-II Record Deleted for ".$_REQUEST['RegNo']."',
				ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
				StudentId				=		".$row_q4['Id'].",
				EmployeeId				=		".$_SESSION['emp_id']."";
				$res=mysql_query($ins, $conn1);
			}
			
			$sql_q5="SELECT Id FROM students09 WHERE RegNo='".$_REQUEST['RegNo']."'";
			$res_q5=mysql_query($sql_q5, $conn1);
			$row_q5=mysql_fetch_assoc($res_q5);
			$num_rows_q5=mysql_num_rows($res_q5);
			if($num_rows_q5 > 0)
			{
				$sql="DELETE FROM students09
				WHERE Id				=		".$row_q5['Id']."";
				$res=mysql_query($sql, $conn1);
				
				$ins="INSERT INTO tbl_pislog SET
				ActivityType			=		'RecordDeletion-Is',
				ActivityDescription		=		'SSC-Is Record Deleted for ".$_REQUEST['RegNo']."',
				ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
				StudentId				=		".$row_q5['Id'].",
				EmployeeId				=		".$_SESSION['emp_id']."";
				$res=mysql_query($ins, $conn1);
			}
			
			?><script>alert('Student Deleted Successfully.');location.replace('regrecords_all.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('regrecords_delete.php?RegNo=<?php echo $_REQUEST['RegNo'];?>');</script><?php
		}
	}
	?>
	<?php
	$sql="SELECT * FROM tbl_sscregistration WHERE RegNo='".$_REQUEST['RegNo']."'";
	$res=mysql_query($sql, $conn_sscreg);
	$row=mysql_fetch_assoc($res);
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Delete Record</h6>
					</div>
					
					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();" enctype="multipart/form-data">
						<input name="Id" id="Id" type="hidden" value="<?php echo $row['Id'];?>">
							<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title">SSC RegNo<span class="req">*</span></label>
									<div class="form_input">
										<input name="RegNo" id="RegNo" type="text" value="<?php echo $row['RegNo'];?>" class="limiter" readonly/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Student Name<span class="req">*</span></label>
									<div class="form_input">
										<input name="Name" id="Name" type="text" value="<?php echo $row['Name'];?>" class="limiter" style="text-transform:uppercase;" maxlength="50" tabindex="1" readonly/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Father's Name<span class="req">*</span></label>
									<div class="form_input">
										<input name="FatherName" id="FatherName" type="text" value="<?php echo $row['FatherName'];?>" class="limiter" style="text-transform:uppercase;" maxlength="50" tabindex="2" readonly/>
									</div>
								</div>
								</li>
								
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Letter No<span class="req">*</span></label>
									<div class="form_input">
										<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Enter Letter No" class="limiter" maxlength="50" tabindex="3"/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="4"><span>Delete</span></button>
										<button type="reset" class="btn_small btn_blue" tabindex="5"><span>Reset</span></button>
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
</div>
<?php include('includes/footer.php');?>
<script>
function check_submit_form()
{
	if(!Validate($(".form_container"))){ return false; }
}//check_submit_form()
</script>