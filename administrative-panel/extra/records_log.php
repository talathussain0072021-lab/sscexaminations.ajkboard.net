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
							<td><strong>Type:</strong></td>
							<td>
								<select name="Type" id="Type" data-placeholder="Select Type" class="chzn-select admin-select" tabindex="2"/>
								<option value="">Select</option>
								<option value="SSCP1Records" <?php echo (($_REQUEST['Type']=='SSCP1Records')?'selected':'');?>>SSCP1Records</option>
								<option value="SSCP2Records" <?php echo (($_REQUEST['Type']=='SSCP2Records')?'selected':'');?>>SSCP2Records</option>
								</select>
							</td>
							<td><input type="submit" name="search" id="search" value="Search" tabindex="3"/></td>
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
						if(isset($_REQUEST['search']) && $_REQUEST['Type']=='SSCP1Records')
						{
							$SrNo=1;
							$sql="SELECT Id, Name FROM vwstudentspi WHERE RegistrationNo='".$_REQUEST['RegNo']."'";
							$res=mysql_query($sql, $conn_sscreslt);
							$row=mysql_fetch_array($res);
							$StudentName=$row['Name'];
							
							$sql_history="SELECT emp.emp_full_name, emplh.ActivityType, emplh.ActivityTime, emplh.ActivityDescription, emplh.ActivityRefNo FROM matric_results.tbl_resultlog emplh INNER JOIN matric_examination.employees emp ON emplh.EmployeeId=emp.emp_id WHERE emplh.RegNo='".$_REQUEST['RegNo']."' AND (emplh.ActivityType='Migration-II' OR emplh.ActivityType='DeletionMigReq-II' OR emplh.ActivityType='InfoUpdation-II' OR emplh.ActivityType='RecordUpdation-I' OR emplh.ActivityType='ResultUpdation-I') ORDER BY emplh.Id DESC";
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
						}//if(isset($_REQUEST['search']) && $_REQUEST['Type']=='SSCP1Records')
						
						if(isset($_REQUEST['search']) && $_REQUEST['Type']=='SSCP2Records')
						{
							$SrNo=1;
							$sql="SELECT ID, Name FROM tbl_resultpii WHERE Reg_No='".$_REQUEST['RegNo']."'";
							$res=mysql_query($sql, $conn_sscreslt);
							$row=mysql_fetch_array($res);
							$StudentName=$row['Name'];
							
							$sql_history="SELECT emp.emp_full_name, emplh.ActivityType, emplh.ActivityTime, emplh.ActivityDescription, emplh.ActivityRefNo FROM matric_results.tbl_resultlog emplh INNER JOIN matric_examination.employees emp ON emplh.EmployeeId=emp.emp_id WHERE emplh.RegNo='".$_REQUEST['RegNo']."' AND (emplh.ActivityType='ResultInsertion-II' OR emplh.ActivityType='RecordUpdation-II' OR emplh.ActivityType='ResultUpdation-II' OR emplh.ActivityType='ResultRemarksUpdation-II') ORDER BY emplh.Id DESC";
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
						}//if(isset($_REQUEST['search']) && $_REQUEST['Type']=='SSCP2Records')
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