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
						<h6>Adm. Batches(Private) List <?php echo $SessionName;?></h6>
					</div>

					<div class="widget_content">
                		<div style="width:100%; padding:10px;">
							
                            <form method="get">
                            <table>
							<tr><td colspan="3" style="color:#FF0000; font-size:14px; vertical-align:middle; font-weight:bold;">Search Locked Batches</td></tr>
							<tr><td colspan="3">&nbsp;</td></tr>
							<tr>	
                                <td style="vertical-align:middle;"><strong>Batch Adm Status: &nbsp;</strong></td>
								<td> &nbsp;
									<select name="BatchStatus" data-placeholder="Select Batch Status" class="chzn-select admin-select" tabindex="1"/>
									<option value="0" <?php echo (($_REQUEST['BatchStatus']=='0')?'selected':'')?>>Pending</option>
									<option value="1" <?php echo (($_REQUEST['BatchStatus']=='1')?'selected':'')?>>Ok</option>
									<option value="2" <?php echo (($_REQUEST['BatchStatus']=='2')?'selected':'')?>>Not Ok</option>
									</select>
								</td>
								<td style="vertical-align:middle;"> &nbsp;<input type="submit" name="search" value="Search" tabindex="2"/></td>					
							</tr>
							<tr><td colspan="3"><br /></td></tr>							
							<tr>
								<td colspan="3" style="vertical-align:middle;">
									<a class="iframe" href="choose_admpbatches_admlist11.php?SessionId=<?php echo $SessionId;?>&SessionName=<?php echo $SessionName;?>&BatchStatus=<?php echo $_REQUEST['BatchStatus'];?>"><span class="badge_style b_done">Print Report</span></a>
								</td>
							</tr>
							<tr><td colspan="3"><br /></td></tr>
							</table>
                            </form>                            
                        </div>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>Sr.No.</th>
							<th>Batch No.</th>
							<th>Student Count</th>
							<th>Action</th>							
						</tr>
						</thead>
						<tbody>
                        <?php 
						$SrNo=1; $BatchSum=0;
						$sql="SELECT Id, BatchNo, BatchStatus, AdmStatus, RevStatus, BatchCounter, StdCount, BatchFee FROM vwadmbatches11 WHERE BatchStatus=1 AND BatchType=2 AND AdmStatus=".$_REQUEST['BatchStatus']." AND SessionId=".$SessionId." ORDER BY Id ASC";
						$res=mysql_query($sql, $conn1);
						while($row=mysql_fetch_array($res))
						{				
						?>
						<tr>
							<td class="center"><?php echo $SrNo;?></td>
							<td class="center"><?php echo $row['BatchNo'];?></td>
							<!--<td class="center"><a href="allstudents_bwadmdetail.php?Id=<?php echo $row['Id'];?>&BatchNo=<?php echo $row['BatchNo'];?>"><?php echo $row['BatchNo'];?></a></td>-->
							<td align="center"><?php echo $row['StdCount'];?></td>
							<td class="center">
							<a href="print_bwadmstudents_report11.php?BatchId=<?php echo $row['Id'];?>&BatchNo=<?php echo $row['BatchNo'];?>" target="_blank"><span class="badge_style b_done">Print Report</span></a>
							</td>
						</tr>
						<?php
						$SrNo++; $BatchSum+=$row['StdCount'];
						}?>						
						</tbody>
						<tfoot>
						<tr>
							<th>Sr.No.</th>
							<th>Batch No.</th>
							<th>Student Count</th>
							<th>Action</th>
						</tr>
						</tfoot>
						</table>
						
						<div style="float: right; font-size: 18px; width: auto;">Total Student Count:&nbsp;<div style="float: right; color:#FF0000;" /><?php echo $BatchSum;?>&nbsp;</div></div>
					</div>
				</div>
			</div>
			<span class="clear"></span>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php include('includes/footer.php');?>