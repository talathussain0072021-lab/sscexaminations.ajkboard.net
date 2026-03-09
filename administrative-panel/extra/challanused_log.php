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
						<h6>Search Log for Challan Used</h6>
					</div>

					<div class="widget_content">
						
						<form method="post">
						<table class="search">
						<tr>
							<td><strong>Challan No:</strong></td>
							<td><input name="ChallanNo" id="ChallanNo" type="text" value="<?php echo $_REQUEST['ChallanNo'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="12" tabindex="1"/></td>
							
						</tr>	
						<tr>
							<td colspan="6"><input type="submit" name="search" id="search" value="Search" tabindex="4"/></td>
						</tr>
						</table>
						</form>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>ID</th>
							<th>Challan No</th>
							<th>Activity Time</th>
							<th>Activity Type</th>
							<th>Activity Reference</th>
							<th>Employee</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_REQUEST['search']))
						{
							$SrNo=1;
							$sql="SELECT Id, ActivityTime, ActivityType, ActivityRefNo, ChallanNo, EmployeeId FROM log_challanused Where ChallanNo=".$_REQUEST['ChallanNo']."";
							//filter for ChallanNo
							if(isset($_REQUEST['ChallanNo']) && $_REQUEST['ChallanNo']!='')
							{ $sql.=" AND ChallanNo=".$_REQUEST['ChallanNo'].""; }
							
							
							$sql.=" ORDER BY Id ASC";
							$res=mysql_query($sql, $conn2);
							while($row=mysql_fetch_array($res))
							{
							?>
							<tr>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['Id'];?></td>
								<td class="center"><?php echo $row['ChallanNo'];?></td>
								<td class="center"><?php echo $row['ActivityTime'];?></td>
								<td class="center"><?php echo $row['ActivityType'];?></td>
								<td class="center"><?php echo $row['ActivityRefNo'];?></td>
								<td class="center"><?php echo $row['EmployeeId'];?></td>
								<td class="center"></td>
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
							<th>ID</th>
							<th>Challan No</th>
							<th>Activity Time</th>
							<th>Activity Type</th>
							<th>Activity Reference</th>
							<th>Employee</th>
							<th>Action</th>
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