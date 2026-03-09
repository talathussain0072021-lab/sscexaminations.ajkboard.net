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
						<h6>All Sessions</h6>
					</div>

					<div class="widget_content">
						<p class="dataTables_length" style="float: left; margin: 0px;"><br></p>
						
                        <div class="invoice_action_bar" style="float: right;">
							<div class="btn_30_blue">
                            	<a href="sessions_add.php"><span class="icon add_co"></span><span class="btn_link">Add Session</span></a>
							</div>
						</div>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>ID</th>
							<th>Name</th>
							<th>From Date</th>
							<th>To Date</th>
							<th>DOB-I Threshold</th>
							<th>DOB-II Threshold</th>
							<th>IsCurrent</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$SrNo=1;
						$sql="SELECT * FROM sessions ORDER BY Id DESC";
						$res=mysql_query($sql, $conn1);
						while($row=mysql_fetch_array($res))
						{?>
						<tr>
							<td class="center"><?php echo $SrNo;?></td>
							<td class="center"><?php echo $row['Id'];?></td>
							<td class="center"><?php echo $row['Name'];?></td>
							<td class="center"><?php echo date('d-m-Y', strtotime($row['FromDate']));?></td>
							<td class="center"><?php echo date('d-m-Y', strtotime($row['ToDate']));?></td>
							<td class="center"><?php echo date('d-m-Y', strtotime($row['P1DOBThreshold']));?></td>
							<td class="center"><?php echo date('d-m-Y', strtotime($row['P2DOBThreshold']));?></td>
							<td class="center">
                        	<?php if($row['IsCurrent']=='1'){?><span class="badge_style b_done">Yes</span></a><?php } else {?><span class="badge_style b_pending">No</span><?php }?>
                        	</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="sessions_edit.php?Id=<?php echo $row['Id'];?>" title="Edit">Edit</a></span><span><a class="action-icons c-delete" onClick="return confirm('Are you sure you want to delete this?');" href="sessions_delete.php?Id=<?php echo $row['Id'];?>" title="Delete">Delete</a></span>
							</td>
						</tr>
						<?php
						$SrNo++;
						}?>
						</tbody>
						<tfoot>
						<tr>
							<th>SrNo</th>
							<th>ID</th>
							<th>Name</th>
							<th>From Date</th>
							<th>To Date</th>
							<th>DOB-I Threshold</th>
							<th>DOB-II Threshold</th>
							<th>IsCurrent</th>
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