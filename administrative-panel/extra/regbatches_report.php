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
						<h6>Reg. Batches Report <?php echo $SessionName;?></h6>
					</div>

					<div class="widget_content">
                    	<div style="width:100%; padding:10px;">
							
                        	<form method="get">
                            <table>
							<tr><td colspan="3" style="color:#FF0000; font-size:14px; vertical-align:middle; font-weight:bold;">Search Locked Batches</td></tr>
							<tr><td colspan="3">&nbsp;</td></tr>
							<tr>	
                                <td style="vertical-align:middle;"><strong>Institute Code: &nbsp;</strong></td>
                                <td style="vertical-align:middle;"> &nbsp;
									<select name="InstituteId" data-placeholder="Select Institute" class="chzn-select admin-select" tabindex="1"/>
									<option value="Select">Select</option>
									<?php
									$sql_inst="SELECT Id, Code FROM institutes ORDER BY Code ASC";
									$res_inst=mysql_query($sql_inst, $conn1);
									while($row_inst=mysql_fetch_array($res_inst))								
									{
										echo '<option value='.$row_inst['Id'].' '.(($_REQUEST['InstituteId']==$row_inst['Id'])?'selected':'').'>'.$row_inst['Code'].'</option>';
									}
									?>
									</select>
								</td>
								<td style="vertical-align:middle;"> &nbsp;<input type="submit" name="search" value="Search" tabindex="2"/></td>
							</tr>
							<tr><td colspan="3"><br /></td></tr>							
							<tr>
								<td colspan="3" style="vertical-align:middle;"> 
								<a href="print_regbatches_report.php?&InstituteId=<?php echo $_REQUEST['InstituteId'];?>"><span class="badge_style b_done">Print Report</span></a></td>
							</tr> 
                            <tr><td colspan="3"><br></td></tr>
							</table>
                            </form>
                        </div>

						<table class="display data_tbl">
						<thead>
						<tr>
							<th>Sr.No.</th>
							<th>Batch No.</th>
							<th>Student Count</th>
							<th>Challan No.</th>
							<th>Challan Amount</th>
							<th>Rev. Remarks</th>							
						</tr>
						</thead>
						<tbody>
                        <?php 
						$SrNo=1;
						$sql="SELECT Id, BatchNo, BatchStatus, RegStatus, RevStatus, BatchCounter, InstituteId, StdCount, BatchFee, ChallanNo FROM vwregbatches WHERE BatchStatus=1 AND SessionId=".$SessionId." AND InstituteId=".$_REQUEST['InstituteId']." ORDER BY Id ASC";
						$res=mysql_query($sql, $conn1);
						while($row=mysql_fetch_array($res))
						{		
						?>
						<tr>
							<td class="center"><?php echo $SrNo;?></td>
							<td class="center"><?php echo $row['BatchNo'];?></td>
							<td align="center"><?php echo $row['StdCount'];?></td>
							<td align="center"><?php echo $row['ChallanNo'];?></td>
							<td align="center"><?php echo $row['BatchFee'];?></td>
							<td class="center">
							<?php if($row['RevStatus'] == 0){?> Pending <?php } 
							else if($row['RevStatus'] == 1){?> Ok <?php } 
							else if($row['RevStatus'] == 2){?> Not Ok <?php } ?>
							</td>
						</tr>
                        <?php
						$SrNo++;
						}?>						
						</tbody>
						<tfoot>
						<tr>
							<th>Sr.No.</th>
							<th>Batch No.</th>
							<th>Student Count</th>
							<th>Challan No.</th>
							<th>Challan Amount</th>
							<th>Rev. Remarks</th>		
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