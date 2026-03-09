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
						<h6>All Subjects</h6>
					</div>

					<div class="widget_content">
						<p class="dataTables_length" style="float: left; margin: 0px;"><br></p>
						
                    	<div class="invoice_action_bar" style="float: right;">
                        	<div class="btn_30_blue">
                        		<a href="subjects_add.php"><span class="icon add_co"></span><span class="btn_link">Add Subject</span></a>
                        	</div>
                        </div>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>ID</th>
							<th>Name</th>
							<th>SmallName</th>
							<th>Code</th>
							<th>Class</th>
							<th>IsPractical</th>
							<th>IsDoubleShift</th>
							<th>IsCompulsory</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$SrNo=1;
						$sql="SELECT * FROM subjects ORDER BY Id ASC";
						$res=mysql_query($sql, $conn1);
						while($row=mysql_fetch_array($res))
						{
							if($row['IsPractical']==1){ $IsPractical_status='Yes'; }
							else if($row['IsPractical']==0){ $IsPractical_status='No'; }
							
							if($row['IsDoubleShift']==1){ $IsDoubleShift_status='Yes'; }
							else if($row['IsDoubleShift']==0){ $IsDoubleShift_status='No'; }
							
							if($row['IsCompulsory']==1){ $IsCompulsory_status='Yes'; }
							else if($row['IsCompulsory']==0){ $IsCompulsory_status='No'; }
						?>
						<tr>
							<td class="center"><?php echo $SrNo;?></td>
							<td class="center"><?php echo $row['Id'];?></td>
							<td class="center"><?php echo $row['Name'];?></td>
							<td class="center"><?php echo $row['SmallName'];?></td>
							<td class="center"><?php echo $row['Code'];?></td>
							<td class="center"><?php echo $row['Class'];?></td>
							<td class="center"><?php echo $IsPractical_status;?></td>
							<td class="center"><?php echo $IsDoubleShift_status;?></td>
							<td class="center"><?php echo $IsCompulsory_status;?></td>
							<td class="center">
								<span><a class="action-icons c-edit" href="subjects_edit.php?Id=<?php echo $row['Id'];?>" title="Edit">Edit</a></span><span><a class="action-icons c-delete" onClick="return confirm('Are you sure you want to delete this?');" href="subjects_delete.php?Id=<?php echo $row['Id'];?>" title="Delete">Delete</a></span>
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
							<th>SmallName</th>
							<th>Code</th>
							<th>Class</th>
							<th>IsPractical</th>
							<th>IsDoubleShift</th>
							<th>IsCompulsory</th>
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