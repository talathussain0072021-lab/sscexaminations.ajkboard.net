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
						<h6>All Exams</h6>
					</div>

					<div class="widget_content">
						<p class="dataTables_length" style="float: left; margin: 0px;"><br></p>
						
                        <div class="invoice_action_bar" style="float: right;">
							<div class="btn_30_blue">
                            	<a href="exams_add.php"><span class="icon add_co"></span><span class="btn_link">Add Exams</span></a>
							</div>
						</div>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>ID</th>
							<th>Name</th>
							<th>Full Name</th>
							<th>Year</th>
							<th>Date</th>
							<th>Type</th>
							<th>IsCurrent</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$SrNo=1;
						$sql="SELECT * FROM exams ORDER BY Id DESC";
						$res=mysql_query($sql, $conn1);
						while($row=mysql_fetch_array($res))
						{
							if($row['Type']=='1'){ $Type='Annual'; }
							else if($row['Type']=='2'){ $Type='Supply'; }
							else { $Type=''; }
						?>
						<tr>
							<td class="center"><?php echo $SrNo;?></td>
							<td class="center"><?php echo $row['Id'];?></td>
							<td class="center"><?php echo $row['Name'];?></td>
							<td class="center"><?php echo $row['FullName'];?></td>
							<td class="center"><?php echo $row['Year'];?></td>
							<td class="center"><?php echo date('d-m-Y', strtotime($row['Dated']));?></td>
							<td class="center"><?php echo $Type;?></td>
							<td class="center">
                        	<?php if($row['IsCurrent']=='1'){?><span class="badge_style b_done">Yes</span></a><?php } else {?><span class="badge_style b_pending">No</span><?php }?>
                        	</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="exams_edit.php?Id=<?php echo $row['Id'];?>" title="Edit">Edit</a></span><span><a class="action-icons c-delete" onClick="return confirm('Are you sure you want to delete this?');" href="exams_delete.php?Id=<?php echo $row['Id'];?>" title="Delete">Delete</a></span>
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
							<th>Full Name</th>
							<th>Year</th>
							<th>Date</th>
							<th>Type</th>
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