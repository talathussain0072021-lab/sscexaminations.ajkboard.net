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
						<h6>All Pictures Report HSSC PI</h6>
					</div>

					<div class="widget_content">
						
                    	<table class="search">
						<form method="get">
						<tr><td colspan="3" style="color:#FF0000; font-size:14px; vertical-align:middle; font-weight:bold;"><br />Search Students</td></tr>
						<tr><td colspan="3">&nbsp;</td></tr>
						<tr>
                        	<td><strong>Institute Code:</strong></td>
                        	<td>
								<select name="InstituteId" id="InstituteId" data-placeholder="Select Institute" class="chzn-select admin-select" tabindex="1"/>
								<option value="All">All</option>
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
								<td><input type="submit" name="submit" value="Search" tabindex="2"/></td>
						</tr>
						<tr>
							<td colspan="3"> 
								<a class="iframe" href="choose_pics09.php?InstituteId=<?php echo $_REQUEST['InstituteId'];?>"><span class="badge_style b_done">Print Report</span></a>
							</td>
						</tr>
						</form>
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