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
						<h6>DateSheet <?php echo $ExamName;?></h6>
					</div>

					<div class="widget_content">
                    	
                        <div class="invoice_action_bar" style="float: right;">
							<div class="btn_30_blue">
								<a href="datesheet_add.php"><span class="icon add_co"></span><span class="btn_link">Add DateSheet</span></a>
							</div>
                        </div>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>Code</th>
							<th>Full Name</th>
							<th>Short Name</th>
							<th>Date</th>
							<th>Day</th>
							<th>IsDoubleShift</th>
							<th>Time1</th>
							<th>Time2</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$SrNo=1;
						$sql="SELECT * FROM vwdatesheet WHERE ExamId=".$ExamId." ORDER BY PaperDate ASC";
						$res=mysql_query($sql, $conn1);
						while($row=mysql_fetch_array($res))
						{
							if($row['IsDoubleShift']==1){ $IsDoubleShift_status='Yes'; }
							else if($row['IsDoubleShift']==0){ $IsDoubleShift_status='No'; }
						?>
						<tr>
							<td class="center"><?php echo $SrNo;?></td>
                            <td class="center"><?php echo $row['SubjectCode'];?></td>
							<td class="center"><?php echo $row['SubjectName'];?></td>
							<td class="center"><?php echo $row['SubjectSmallName'];?></td>
							<td class="center"><?php echo date('d-m-Y', strtotime($row['PaperDate']));?></td>
							<td class="center"><?php echo $row['PaperDay'];?></td>
							<td class="center"><?php echo $IsDoubleShift_status;?></td>
							<td class="center"><?php echo $row['PaperTime1'];?></td>
							<td class="center"><?php echo $row['PaperTime2'];?></td>
							<td class="center">
								<span><a class="action-icons c-delete" onClick="return confirm('Are you sure you want to delete this?');" href="datesheet_delete.php?Id=<?php echo $row['Id'];?>" title="Delete">Delete</a></span>
							</td>
						</tr>
						<?php
						$SrNo++;
						}?>
						</tbody>
						<tfoot>
						<tr>
							<th>SrNo</th>
							<th>Code</th>
							<th>Full Name</th>
							<th>Short Name</th>
							<th>Date</th>
							<th>Day</th>
							<th>IsDoubleShift</th>
							<th>Time1</th>
							<th>Time2</th>
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