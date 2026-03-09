<?php include('includes/top.php');?>
<?php
$sql="SELECT count(Id) as tstd_count FROM vwadmstudents09 WHERE Id >0";

if(isset($_REQUEST['InstituteId']) && $_REQUEST['InstituteId']!='All')
{ $sql.=" AND InstituteId=".$_REQUEST['InstituteId'].""; }

$sql.=" ORDER BY InstituteCode, Id ASC";
$res=mysql_query($sql, $conn1);
$row=mysql_fetch_array($res);
?>

	<div id="iframe_content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
                
                <!--<a href="voucher_print.php?id=<?php //echo $_REQUEST['id'];?>">
                	<img src="images/table-tools/print_hover.png" height="45" style="float:right" />
                </a>-->
					<div class="widget_top">
						<span class="h_icon list_image"></span>
                     	<h6 style="float:center; font-size:16px;">Choose Option For Printing Report</h6>
					</div>
					<div class="widget_content">
						<table style="margin-left:20px; font-weight:bold; font-family:Verdana, Arial, Helvetica, sans-serif;" class="tablarge_property">
						<tr height="40px">
							<td>&nbsp;</td>
						</tr>
						<?php
						$max_number=$row['tstd_count'];
						$first_number=0; $last_number=0;
						while($last_number < $max_number)
						{
							$first_number=$last_number+1;
							//if(($first_number+149) > $max_number)
							if(($first_number+699) > $max_number)
							{ $last_number= $last_number+($max_number-$last_number); }
							else
							//{ $last_number=$first_number+149; }
							{ $last_number=$first_number+699; }
						?>
						<tr height="50px">
							<td>-> <a href="print_allpics_report09.php?InstituteId=<?php echo $_REQUEST['InstituteId'];?>&first_number=<?php echo $first_number;?>&&last_number=<?php echo $last_number;?>" target="_blank">PRINT RECORD FROM <?php echo $first_number.'-'.$last_number;?></a></td>
						</tr>
						<?php
						}
						?>
						</table>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>