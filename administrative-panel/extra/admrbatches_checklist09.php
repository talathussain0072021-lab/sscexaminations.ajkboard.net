<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
<?php include('includes/header.php');?>	
<style type="text/css">
td { padding:0 3px 0 3px; }
</style>	
	<div id="content">
		<div class="grid_container">
			<span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Adm. Batches(Regular) Check List <?php echo $SessionName;?></h6>
					</div>

					<div class="widget_content">
						<div style="width:100%; padding:10px;">
							
                        	<form method="get">
                            <table>
							<tr><td colspan="5" style="color:#FF0000; font-size:14px; vertical-align:middle; font-weight:bold;">Search Batches</td></tr>
							<tr><td colspan="5">&nbsp;</td></tr>
							<tr>	
                                <td style="vertical-align:middle;"><strong>Batch Status:</strong></td>
                                <td>
									<select name="BatchStatus" data-placeholder="Select Batch Status" class="chzn-select admin-select" tabindex="1"/>
									<option value="1" <?php echo (($_REQUEST['BatchStatus']==1)?'selected':'')?>>Locked</option>
									<option value="6" <?php echo (($_REQUEST['BatchStatus']==6)?'selected':'')?>>Completed</option>
									</select>
								</td>
								<td style="vertical-align:middle;"><strong>Adm/Rev Status:</strong></td>
                                <td>
									<select name="AdmRevStatus" data-placeholder="Select Adm/Rev Status" class="chzn-select admin-select" tabindex="2"/>
									<option value="0" <?php echo (($_REQUEST['AdmRevStatus']==0)?'selected':'')?>>Pending</option>
									<option value="1" <?php echo (($_REQUEST['AdmRevStatus']==1)?'selected':'')?>>Ok</option>
									<option value="2" <?php echo (($_REQUEST['AdmRevStatus']==2)?'selected':'')?>>Not Ok</option>
									</select>
								</td>
								<td style="vertical-align:middle;"><input type="submit" name="submit" value="Search" tabindex="3"/></td>					
							</tr>
							<tr><td colspan="5"><br /></td></tr>							
							<tr>
								<td colspan="5" style="vertical-align:middle;">
									<a class="iframe" href="choose_admrbatches_checklist11.php?id=1&SessionId=<?php echo $SessionId;?>&BatchStatus=<?php echo $_REQUEST['BatchStatus'];?>&AdmRevStatus=<?php echo $_REQUEST['AdmRevStatus'];?>"><span class="badge_style b_done">Print Adm. Check List Report</span></a>
									<a class="iframe" href="choose_admrbatches_checklist11.php?id=2&SessionId=<?php echo $SessionId;?>&BatchStatus=<?php echo $_REQUEST['BatchStatus'];?>&AdmRevStatus=<?php echo $_REQUEST['AdmRevStatus'];?>"><span class="badge_style b_done">Print Rev. Check List Report</span></a>
									<br /><br /><a class="iframe" href="choose_admrbatches_checklist11.php?id=3&SessionId=<?php echo $SessionId;?>&BatchStatus=<?php echo $_REQUEST['BatchStatus'];?>&AdmRevStatus=<?php echo $_REQUEST['AdmRevStatus'];?>"><span class="badge_style b_done">Print Rev. Check List Report(Finance)</span></a>
								</td>
							</tr>
							<tr><td colspan="5"><br /></td></tr>
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