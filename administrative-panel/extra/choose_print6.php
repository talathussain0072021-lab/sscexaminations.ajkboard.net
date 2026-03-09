<?php include('includes/top.php');?>
<?php
$sql="SELECT count(hssc_registration.std_id) as tstd_count FROM hssc_registration, centers WHERE hssc_registration.reg_session='".$_REQUEST['session_code']."' AND hssc_registration.pexam_center!=hssc_registration.aexam_center AND hssc_registration.aexam_center=centers.cent_id";						
$res=mysql_query($sql, $conn1);
$row=mysql_fetch_array($res);			
?>
	
	<div id="iframe_content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
                
               <!-- <a href="voucher_print.php?id=<?php //echo $_REQUEST['id'];?>">
                	<img src="images/table-tools/print_hover.png" height="45" style="float:right" />
                </a>-->
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						
                     <h6 style="float:center; font-size:16px;">Choose Option For Printing Report</h6>
					</div>
					<div class="widget_content">
							<table height="200px" width="70%" style="margin-left:20px;" class="tablarge_property">
								<tr height="50px">
									<td colspan="4">&nbsp; </td>
								</tr>
								<?php 
								$max_number=$row['tstd_count'];
								$first_number=0; $last_number=0;
								while($last_number < $max_number)
								{ 
									$first_number=$last_number+1;
									//if(($first_number+149) > $max_number)
									if(($first_number+999) > $max_number)
									{ $last_number= $last_number+($max_number-$last_number); }
									else
									//{ $last_number=$first_number+149; }
									{ $last_number=$first_number+999; }									
									?>
									<tr height="50px">
									<td align="left" colspan="4" style="font-weight:bolder; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">-> <a href="#" onclick="parent.jQuery.colorbox.close();window.open('print_centchange_report.php?session_code=<?php echo $_REQUEST['session_code'];?>&session_title=<?php echo $_REQUEST['session_title'];?>&first_number=<?php echo $first_number;?>&&last_number=<?php echo $last_number;?>','_parent');">PRINT RECORD FROM <?php echo $first_number.'-'.$last_number;?></a></td>
									</tr>
								<?php	
								}
								?>
								<!--
								<tr height="50px"><td colspan="4">&nbsp;</td></tr>
								-->
							</table>		
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>