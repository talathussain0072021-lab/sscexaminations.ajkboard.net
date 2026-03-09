<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['action'])&&$_REQUEST['action']=='update-status')
	{
		$sql="DELETE FROM admbatchstudents09 WHERE BatchId=".$_REQUEST['Id']."";
		$res=mysql_query($sql, $conn1);
		
		$sql_q="UPDATE admbatches09 SET
		BatchStatus			=		5,
		BatchCounter		=		BatchCounter+1
		WHERE Id			=		".$_REQUEST['Id']."
		AND InstituteId		=		".$_REQUEST['InstituteId']."
		AND ExamId			=		".$ExamId."";
		$res_q=mysql_query($sql_q, $conn1);
		
		?><script>location.replace('lock_radmbatches09.php?message=Data Updated Successfully.');</script><?php
	}
	?>

	<div id="content">
		<div class="grid_container">
			<span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Batches <?php echo $ExamName;?></h6>
					</div>

					<div class="widget_content">
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>Dated</th>
							<th>BatchNo</th>
							<th>BatchCounter</th>
							<th>StdCount</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$SrNo=1; $StdCountSum=0;
						$sql="SELECT Id, Dated, BatchNo, BatchStatus, AdmStatus, RevStatus, BatchCounter, InstituteId, StdCount, ChallanNo FROM vwadmbatches09 WHERE BatchStatus=1 AND BatchType=1 AND ExamId=".$ExamId." ORDER BY Id ASC";
						$res=mysql_query($sql, $conn1);
						while($row=mysql_fetch_array($res))
						{
						?>
						<tr>
							<td class="center"><?php echo $SrNo;?></td>
							<td class="center"><?php echo date('d-m-Y', strtotime($row['Dated']));?></td>
							<td class="center"><?php echo $row['BatchNo'];?></td>
							<td class="center"><?php echo $row['BatchCounter'];?></td>
							<td class="center"><?php echo $row['StdCount'];?></td>
							<td class="center">
								<a href="javascript:;" onClick="if(confirm('Are you sure you want to Delete Batch?')){update_status('<?php echo $row['Id'];?>','<?php echo $row['InstituteId'];?>');}"><span class="badge_style b_pending">Delete</span></a>
							</td>
						</tr>
						<?php
						$SrNo++; $StdCountSum+=$row['StdCount'];
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<th>SrNo</th>
							<th>Dated</th>
							<th>BatchNo</th>
							<th>BatchCounter</th>
							<th>StdCount</th>
							<th>Action</th>
						</tr>
						</tfoot>
						</table>
						
						<div style="float: right; font-size: 16px; width: auto; color:#FF0000;">Total Students:&nbsp;<?php echo $StdCountSum;?></div>
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
function update_status(Id,InstituteId)
{
	location.replace('lock_radmbatches09.php?Id='+Id+'&InstituteId='+InstituteId+'&action=update-status');
}
</script>