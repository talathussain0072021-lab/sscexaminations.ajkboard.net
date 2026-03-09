<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['action'])&&$_REQUEST['action']=='update-status')
	{
		$sql="DELETE FROM admbatchstudents10 WHERE BatchId=".$_REQUEST['Id']."";
		$res=mysql_query($sql, $conn1);
		
		$sql_q="UPDATE admbatches10 SET
		BatchStatus			=		5,
		BatchCounter		=		BatchCounter+1
		WHERE Id			=		".$_REQUEST['Id']."
		AND InstituteId		=		".$_REQUEST['InstituteId']."
		AND ExamId			=		".$ExamId."";
		$res_q=mysql_query($sql_q, $conn1);
		
		?><script>location.replace('ed_radmbatches10.php?message=Data Updated Successfully.');</script><?php
	}
	
	if(isset($_REQUEST['action'])&&$_REQUEST['action']=='cancel-status')
	{
		$sql_q="UPDATE admbatches10 SET
		BatchStatus			=		1
		WHERE Id			=		".$_REQUEST['Id']."
		AND InstituteId		=		".$_REQUEST['InstituteId']."
		AND ExamId			=		".$ExamId."";
		$res_q=mysql_query($sql_q, $conn1);
		
		?><script>location.replace('ed_radmbatches10.php?message=Data Updated Successfully.');</script><?php
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
							<<th>SrNo</th>
							<th>Dated</th>
							<th>BatchNo</th>
							<th>StdCount</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$SrNo=1; $StdCountSum=0;
						$sql="SELECT Id, Dated, BatchNo, BatchStatus, AdmStatus, RevStatus, BatchCounter, EChallanNo, InstituteId, StdCount, ChallanNo FROM vwadmbatches10 WHERE BatchStatus=3 AND BatchType=1 AND ExamId=".$ExamId." ORDER BY Id ASC";
						$res=mysql_query($sql, $conn1);
						while($row=mysql_fetch_array($res))
						{
						?>
						<tr>
							<td class="center"><?php echo $SrNo;?></td>
							<td class="center"><?php echo date('d-m-Y', strtotime($row['Dated']));?></td>
							<td class="center"><?php echo $row['BatchNo'];?></td>
							<td class="center"><?php echo $row['StdCount'];?></td>
							<td class="center">
                        	<a href="javascript:;" onClick="if(confirm('Are you sure you want to Process Delete Request?')){update_status('<?php echo $row['Id'];?>','<?php echo $row['InstituteId'];?>');}"><span class="badge_style b_pending">Delete Request ( <?php echo $row['EChallanNo'];?> )</span></a>
							<span><a class="action-icons c-Delete" style="vertical-align:bottom;" href="javascript:;" onClick="if(confirm('Are you sure you want to Cancel Request?')){cancel_status('<?php echo $row['Id'];?>','<?php echo $row['InstituteId'];?>');}"></a></span>
                        	</td>
						</tr>
						<?php
						$SrNo++; $StdCountSum+=$row['StdCount'];
						}?>
						</tbody>
						<tfoot>
						<tr>
							<th>SrNo</th>
							<th>Dated</th>
							<th>BatchNo</th>
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
	location.replace('ed_radmbatches10.php?Id='+Id+'&InstituteId='+InstituteId+'&action=update-status');
}
function cancel_status(Id,InstituteId)
{
	location.replace('ed_radmbatches10.php?Id='+Id+'&InstituteId='+InstituteId+'&action=cancel-status');
}
</script>