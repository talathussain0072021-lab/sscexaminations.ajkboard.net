<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<div id="content">
		<div class="grid_container">
			<span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Search Student Log</h6>
					</div>

					<div class="widget_content">
						
						<form method="get">
						<table class="search">
						<tr>
							<td><strong>RegNo:</strong></td>
							<td><input name="RegNo" id="RegNo" type="text" value="<?php echo $_REQUEST['RegNo'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="15" tabindex="1"/></td>
							<td><input type="submit" name="search" id="search" value="Search" tabindex="2"/></td>
						</tr>
						</table>
						</form>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>Activity Type</th>
							<th>Activity Time</th>
							<th>Activity RefNo</th>
							<th>Activity Description</th>
							<th>Student Name</th>
							<th>Employee Name</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$SrNo=1;
						$sql_history="SELECT reg.Name, emp.emp_full_name, emplh.ActivityType, emplh.ActivityTime, emplh.ActivityDescription, emplh.ActivityRefNo FROM matric_registration.tbl_sscregistration reg RIGHT JOIN matric_registration.tbl_sscreglog emplh ON reg.RegNo=emplh.RegNo INNER JOIN matric_examination.employees emp ON emplh.EmployeeId=emp.emp_id WHERE emplh.RegNo='".$_REQUEST['RegNo']."' ORDER BY emplh.Id DESC";
						$res_history=mysql_query($sql_history, $conn1);
						while($row_history=mysql_fetch_array($res_history))
						{
						?>
						<tr>
							<td class="center"><?php echo $SrNo;?></td>
							<td class="center"><?php echo $row_history['ActivityType'];?></td>
							<td class="center"><?php echo $row_history['ActivityTime'];?></td>
							<td class="center"><?php echo $row_history['ActivityRefNo'];?></td>
							<td class="center"><?php echo $row_history['ActivityDescription'];?></td>
							<td class="center"><?php echo $row_history['Name'];?></td>
							<td class="center"><?php echo $row_history['emp_full_name'];?></td>
						</tr>
						<?php
						$SrNo++;
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<th>SrNo</th>
							<th>Activity Type</th>
							<th>Activity Time</th>
							<th>Activity RefNo</th>
							<th>Activity Description</th>
							<th>Student Name</th>
							<th>Employee Name</th>
						</tr>
						</tfoot>
						</table>
					</div>
				</div>
			</div>
			<span class="clear"></span>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php include('includes/footer.php');?>