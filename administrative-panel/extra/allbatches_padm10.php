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
						<h6>All Private Batches <?php echo $ExamName;?></h6>
					</div>

					<div class="widget_content">
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>BatchId</th>
							<th>Dated</th>
							<th>BatchNo</th>
							<th>StdCount</th>
							<th>ChallanNo</th>
							<th>BatchFee</th>
							<th>BatchStatus</th>
							<th>AdmStatus</th>
							<th>RevStatus</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$SrNo=1; $StdCountSum=0; $BatchFeeSum=0;
						$sql="SELECT Id, Dated, BatchNo, BatchStatus, AdmStatus, RevStatus, BatchCounter, InstituteId, StdCount, BatchFee, ChallanNo FROM vwadmbatches10 WHERE BatchType=2 AND ExamId=".$ExamId." ORDER BY Id ASC";
						$res=mysql_query($sql, $conn1);
						while($row=mysql_fetch_array($res))
						{
						?>
						<tr>
							<td class="center"><?php echo $SrNo;?></td>
							<td class="center"><?php echo $row['Id'];?></td>
							<td class="center"><?php echo date('d-m-Y', strtotime($row['Dated']));?></td>
							<td class="center"><?php echo $row['BatchNo'];?></td>
							<td class="center"><?php echo $row['StdCount'];?></td>
							<td class="center"></td>
							<td class="center"><?php echo floatval($row['BatchFee']);?></td>
							<td class="center">
							<?php if($row['BatchStatus'] == 1){?><span class="badge_style b_suspend">Locked</span><?php }
							else if($row['BatchStatus'] == 5){?><span class="badge_style b_low">Deleted</span><?php }
							else if($row['BatchStatus'] == 6){?><span class="badge_style b_confirmed">Processed</span><?php }?>
							</td>
							<td class="center">
							<?php if($row['BatchStatus'] == 1){
							if($row['AdmStatus'] == 0){?><span class="badge_style b_pending">Pending</span><?php }
							else if($row['AdmStatus'] == 1){?><span class="badge_style b_done">Ok</span><?php }
							else if($row['AdmStatus'] == 2){?><span class="badge_style b_notDone">Not Ok</span><?php }
							}
							?>
							</td>
							<td class="center">
							<?php if($row['BatchStatus'] == 1){
							if($row['RevStatus'] == 0){?><span class="badge_style b_pending">Pending</span><?php }
							else if($row['RevStatus'] == 1){?><span class="badge_style b_done">Ok</span><?php }
							else if($row['RevStatus'] == 2){?><span class="badge_style b_notDone">Not Ok</span><?php }
							}
							?>
							</td>
						</tr>
						<?php
						$SrNo++; $StdCountSum+=$row['StdCount']; $BatchFeeSum+=$row['BatchFee'];
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<th>SrNo</th>
							<th>BatchId</th>
							<th>Dated</th>
							<th>BatchNo</th>
							<th>StdCount</th>
							<th>ChallanNo</th>
							<th>BatchFee</th>
							<th>BatchStatus</th>
							<th>AdmStatus</th>
							<th>RevStatus</th>
						</tr>
						</tfoot>
						</table>
						
						<div style="float: right; font-size: 16px; width: auto; color:#FF0000;">Total Students:&nbsp;<?php echo $StdCountSum;?>&nbsp;Total Fee:&nbsp;<?php echo $BatchFeeSum;?></div>
					</div>
				</div>
			</div>
			<span class="clear"></span>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php include('includes/footer.php');?>