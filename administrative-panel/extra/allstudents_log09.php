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
						
						<form method="post">
						<table class="search">
						<tr>
							<td><strong>Application No:</strong></td>
							<td><input name="StudentId" id="StdudentId" type="text" value="<?php echo $_REQUEST['StudentId'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="8" tabindex="1"/></td>
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
						if(isset($_REQUEST['search']))
						{
							$SrNo=1;
							$sql="SELECT Id, Name FROM vwadmstudents09 WHERE Id=".$_REQUEST['StudentId']." AND SessionId=".$SessionId."";
							$res=mysql_query($sql, $conn1);
							$row=mysql_fetch_array($res);
							$StudentName=$row['Name'];
							
							$sql_history="SELECT emp.emp_full_name, emplh.ActivityType, emplh.ActivityTime, emplh.ActivityDescription, emplh.ActivityRefNo FROM tbl_pilog emplh INNER JOIN employees emp ON emplh.EmployeeId=emp.emp_id WHERE StudentId=".$_REQUEST['StudentId']." ORDER BY emplh.Id DESC";
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
								<td class="center"><?php echo $StudentName;?></td>
								<td class="center"><?php echo $row_history['emp_full_name'];?></td>
							</tr>
							<?php
							$SrNo++;
							}
						}//if(isset($_REQUEST['search']))
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