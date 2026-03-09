<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['update']))
	{
		$sqlVer = "SELECT COUNT(*) AS cnt
					FROM tblchallans
					WHERE (ChallanNo = ".$_REQUEST['OChallanNo']." AND FeeStatus = 0)
					OR (ChallanNo = ".$_REQUEST['NChallanNo']." AND FeeStatus = 1)";
		$resVer = mysql_query($sqlVer, $conn2);
		$rowVer  = mysql_fetch_assoc($resVer);
		
		if ($rowVer['cnt'] != 2) {
			echo "<script>alert('No records found for New ChallanNo with paid status OR Old ChallanNo with unpaid status.');location.replace('updtchlnno_regstudents.php');</script>"; exit;
		}

		// Step 1: Get affected rows BEFORE updating
		$affectedStudents = array();

		$sqlGet = "SELECT StudentId FROM regbatchstudents 
				   WHERE ChallanNo = ".$_REQUEST['OChallanNo'];
		$resGet = mysql_query($sqlGet, $conn1);

		while($row = mysql_fetch_assoc($resGet)) {
			$affectedStudents[] = $row['StudentId'];
		}

		// If no rows found, skip update & log
		if (empty($affectedStudents)) {
			echo "<script>location.replace('updtchlnno_regstudents.php?message=No records found for the given Old ChallanNo.');</script>"; exit;
		}

		// Step 2: UPDATE in admbatchstudents09
		$sql1 = "UPDATE regbatchstudents SET
				 ChallanNo = ".$_REQUEST['NChallanNo']."
				 WHERE ChallanNo = ".$_REQUEST['OChallanNo'];

		if (mysql_query($sql1, $conn1)) {

			// Step 3: UPDATE in admbatches09
			$sql2 = "UPDATE regbatches SET
					 ChallanNo = ".$_REQUEST['NChallanNo']."
					 WHERE ChallanNo = ".$_REQUEST['OChallanNo'];

			mysql_query($sql2, $conn1);

			// Step 4: Insert log entries AFTER updates
			foreach ($affectedStudents as $sid) {
				$ins = "INSERT INTO tbl_pilog 
							(ActivityType, ActivityDescription, ActivityRefNo, StudentId, EmployeeId)
						VALUES (
							'ChallanNoUpdation-I',
							'RegChallanNo updated from ".$_REQUEST['OChallanNo']." to ".$_REQUEST['NChallanNo']."',
							'".$_REQUEST['ActivityRefNo']."',
							".$sid.",
							".$_SESSION['emp_id']."
						)";
				mysql_query($ins, $conn1);
			}
			
			?><script>location.replace('updtchlnno_regstudents.php?message=Data Updated Successfully.');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('updtchlnno_regstudents.php');</script><?php
		}
	}
	?>

	<div id="content">
		<div class="grid_container">
			<span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Students <?php echo $SessionName;?></h6>
					</div>

					<div class="widget_content">
						
						<form method="post">
						<table class="search">
						<tr><td colspan="5" style="color:#FF0000; font-size:14px; font-weight:bold;">Search Students</td></tr>
						<tr>
							<td><strong>ChallanNo:</strong></td>
							<td><input name="OChallanNo" id="OChallanNo" type="text" value="<?php echo $_REQUEST['OChallanNo'];?>" class="x_large" onkeypress="return isNumber()" maxlength="12" tabindex="1"/></td>
							<td><input type="submit" name="search" id="search" value="Search" tabindex="2"/></td>
						</tr>
						<tr>
							<td><strong>New ChallanNo:</strong></td>
							<td><input name="NChallanNo" id="NChallanNo" type="text" class="x_large" onkeypress="return isNumber()" maxlength="12" tabindex="3"/></td>
							<td><strong>Letter No:</strong></td>
							<td>
								<input name="ActivityRefNo" id="ActivityRefNo" type="text" class="large" maxlength="50" tabindex="4"/>
							</td>
							<td><input type="submit" name="update" id="update" value="Update" onclick="return validateUpdate()" tabindex="5"/></td>
						</tr>
						</table>
						</form>
						
						<form name="form1" id="form1" action="" method="post">
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>AppNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>BatchNo</th>
							<th>BatchSr</th>
							<th>Reg Status</th>
							<th>Reg Fee</th>
						<!--<th>Action</th>-->
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_REQUEST['search']))
						{
							$SrNo=1; $StdCountSum=0; $BatchFeeSum=0;
							$sql="SELECT Id, Name, FatherName, BatchNo, BatchSr, StdRegStatus, RegistrationFee FROM vwregstudents WHERE ChallanNo=".$_REQUEST['OChallanNo']." ORDER BY Id ASC";
							$res=mysql_query($sql, $conn1);
							$numrows=mysql_num_rows($res);
							while($row=mysql_fetch_array($res))
							{?>
							<tr>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['Id'];?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td class="center"><?php echo $row['FatherName'];?></td>
								<td class="center"><?php echo $row['BatchNo'];?></td>
								<td class="center"><?php echo $row['BatchSr'];?></td>
								<td class="center"><?php echo $row['StdRegStatus'];?></td>
								<td class="center"><?php echo $row['RegistrationFee'];?></td>
							</tr>
							<?php
							$SrNo++; $StdCountSum=$numrows; $FeeSum+=$row['RegistrationFee'];
							}//while($row=mysql_fetch_array($res))
						}?>
						</tbody>
						<tfoot>
						<tr>
							<th>SrNo</th>
							<th>AppNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>BatchNo</th>
							<th>BatchSr</th>
							<th>Reg Status</th>
							<th>Reg Fee</th>
						<!--<th>Action</th>-->
						</tr>
						</tfoot>
						</table>
						</form>
						
						<div style="float: right; font-size: 16px; width: auto; color:#FF0000;">Total Students:&nbsp;<?php echo $StdCountSum;?>&nbsp;Total Fee:&nbsp;<?php echo $FeeSum;?></div>
					</div>
				</div>
			</div>
			<span class="clear"></span>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php include('includes/footer.php');?>
<script>
function validateUpdate() {
    var OChallanNo = document.getElementById("OChallanNo").value.trim();
    var NChallanNo = document.getElementById("NChallanNo").value.trim();
	var ActivityRefNo = document.getElementById("ActivityRefNo").value.trim();

    if (OChallanNo === "" || NChallanNo === "" || ActivityRefNo === "") {
        alert("Please enter Old ChallanNo, New ChallanNo and LetterNo before updating.");
        return false;
    }
    return true;
}
</script>