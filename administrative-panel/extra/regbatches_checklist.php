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
						<h6>Reg. Batches Check List <?php echo $SessionName;?></h6>
					</div>

					<div class="widget_content">
						<div style="width:100%; padding:10px;">
							
                        	<form method="get">
                            <table>
							<tr><td colspan="3" style="color:#FF0000; font-size:14px; vertical-align:middle; font-weight:bold;">Search Locked Batches</td></tr>
							<tr><td colspan="3">&nbsp;</td></tr>
							<tr>	
                                <td style="vertical-align:middle;"><strong>Batch Status: &nbsp;</strong></td>
                                <td> &nbsp;
									<select name="BatchStatus" data-placeholder="Select Batch Status" class="chzn-select admin-select" tabindex="1"/>
									<option value="0" <?php echo (($_REQUEST['BatchStatus']=='0')?'selected':'')?>>Pending</option>
									<option value="1" <?php echo (($_REQUEST['BatchStatus']=='1')?'selected':'')?>>Ok</option>
									<option value="2" <?php echo (($_REQUEST['BatchStatus']=='2')?'selected':'')?>>Not Ok</option>
									</select>
								</td>
								<td style="vertical-align:middle;"> &nbsp;<input type="submit" name="submit" value="Search" tabindex="2"/></td>					
							</tr>
							<tr><td colspan="3"><br /></td></tr>
							<tr>	
								<td colspan="3" style="vertical-align:middle;">
									<a class="iframe" href="choose_regbatches_checklist.php?id=1&SessionId=<?php echo $SessionId;?>&SessionName=<?php echo $SessionName;?>&BatchStatus=<?php echo $_REQUEST['BatchStatus'];?>"><span class="badge_style b_done">Print Reg. Check List Report</span></a>
								</td>						
							</tr>
							<tr><td colspan="3"><br /></td></tr>
							<tr>	
								<td colspan="3" style="vertical-align:middle;">
									<a class="iframe" href="choose_regbatches_checklist.php?id=2&SessionId=<?php echo $SessionId;?>&SessionName=<?php echo $SessionName;?>&BatchStatus=<?php echo $_REQUEST['BatchStatus'];?>"><span class="badge_style b_done">Print Rev. Check List Report</span></a>
								</td>						
							</tr>
							<tr><td colspan="3"><br /></td></tr>
							</table>
                            </form>
                        </div>
					</div>
				</div>
			</div>
			<span class="clear"></span>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php include('includes/footer.php');?>