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
						<h6>Validated Pictures Report</h6>
					</div>

					<div class="widget_content">
                		<div style="width:100%; padding:10px;">
							
                        	<form method="get">
                            <table width="50%">
							<tr><td colspan="4" style="color:#FF0000; font-size:14px; vertical-align:middle; font-weight:bold;"><br />Search Students</td></tr>
							<tr><td colspan="4">&nbsp;</td></tr>
							<tr>	
                                <td width="20%"><strong>Institute Code:</strong></td>
                                <td width="20%">
									<select name="institute_code" data-placeholder="Select Institute" class="chzn-select" style="width:135px;" tabindex="1"/>
									<option value="All">All</option>
									<!-- <?php 
									$sql_inst="SELECT * FROM institute_login ORDER BY login_code ASC";
									$res_inst=mysql_query($sql_inst, $conn1);
									while($row_inst=mysql_fetch_array($res_inst))								
									{
										echo '<option value='.$row_inst['login_code'].' '.(($_REQUEST['institute_code']==$row_inst['login_code'])?'selected':'').'>'.$row_inst['login_code'].'</option>';
									}
									?> -->
									</select>
								</td>
								<td colspan="2">&nbsp;</td>					
							</tr>							
							<tr><td colspan="4"><br /></td></tr>							
							<tr>
								<td colspan="2" align="center">
								<input type="submit" name="submit" value="Search" tabindex="4"/> 
								<a class="iframe" href="choose_print4.php?session_code=<?php echo $session_code;?>&session_title=<?php echo $session_title;?>"><span class="badge_style b_done">Print Report</span></a>
								</td>
							</tr> 
                            <tr><td colspan="4"><br></td></tr>
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