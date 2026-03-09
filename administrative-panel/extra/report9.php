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
						<h6>Validation Report(Centre Change)</h6>
					</div>

					<div class="widget_content">
                		<div style="width:100%; padding:10px;">
							
                        	<form method="get">
                            <table width="20%">							
							<tr>
								<td align="left">
								<a class="iframe" href="choose_print6.php?session_code=<?php echo $session_code;?>&session_title=<?php echo $session_title;?>"><span class="badge_style b_done">Print Report</span></a>
								</td>
							</tr>
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