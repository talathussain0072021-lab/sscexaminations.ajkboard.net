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
						<h6>Batches <?php echo $ExamName;?></h6>
					</div>

					<div class="widget_content">
               			
						<div class="invoice_action_bar" style="float: right;">
							<div class="btn_30_blue">
								<a href="adm_padmbatches_add09.php"><span class="icon add_co"></span>
									<span class="btn_link">Add</span>
								</a>
							</div>
                        </div>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>BatchNo</th>
							<th>StdCount</th>
							<th>AdmStatus</th>
						</tr>
						</thead>
						<tbody>
                        <?php
						$SrNo=1; $StdCountSum=0;
						$sql="SELECT Id, BatchNo, BatchStatus, AdmStatus, RevStatus, BatchCounter, InstituteId, StdCount, ChallanNo FROM vwadmbatches09 WHERE BatchStatus=1 AND BatchType=2 AND AdmStatus=0 AND ExamId=".$ExamId." ORDER BY Id ASC";
						$res=mysql_query($sql, $conn1);
						while($row=mysql_fetch_array($res))
						{
						?>
						<tr>
							<td class="center"><?php echo $SrNo;?></td>
                            <td class="center"><?php echo $row['BatchNo'];?></td>
							<td class="center"><?php echo $row['StdCount'];?></td>
							<td class="center"><span class="badge_style b_pending">Pending</span></td>
						</tr>
                        <?php
						$SrNo++; $StdCountSum+=$row['StdCount'];
						}?>
						</tbody>
						<tfoot>
						<tr>
							<th>SrNo</th>
							<th>BatchNo</th>
							<th>StdCount</th>
							<th>AdmStatus</th>
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