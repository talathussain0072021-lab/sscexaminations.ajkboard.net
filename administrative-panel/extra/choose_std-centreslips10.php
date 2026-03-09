<?php include('includes/top.php');?>
<?php
$sql="SELECT count(Id) as tstd_count FROM vwrollnoslip10 WHERE RollNo!=0";

if(isset($_REQUEST['StdudentId']) && $_REQUEST['StdudentId']!='')
{ $sql.=" AND Id IN (".$_REQUEST['StdudentId'].")"; }

if(isset($_REQUEST['RegNo']) && $_REQUEST['RegNo']!='')
{ $sql.=" AND RegNo='".$_REQUEST['RegNo']."'"; }

if(isset($_REQUEST['RollNo']) && $_REQUEST['RollNo']!='')
{ $sql.=" AND RollNo IN (".$_REQUEST['RollNo'].")"; }

if(isset($_REQUEST['BatchSr']) && $_REQUEST['BatchSr']!='')
{ $sql.=" AND BATCH_ID LIKE '".$_REQUEST['BatchSr']."%'"; }

if(isset($_REQUEST['Name']) && $_REQUEST['Name']!='')
{ $sql.=" AND Name LIKE '".$_REQUEST['Name']."%'"; }

if(isset($_REQUEST['CentreCode']) && $_REQUEST['CentreCode']!='')
{ $sql.=" AND ACentreCode='".$_REQUEST['CentreCode']."'"; }

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
							if(($first_number+499) > $max_number)
							{ $last_number= $last_number+($max_number-$last_number); }
							else
							//{ $last_number=$first_number+149; }
							{ $last_number=$first_number+499; }
						?>
						<tr height="40px">
							<td>-> <a href="print_student_allcentreslips10.php?StdudentId=<?php echo $_REQUEST['StdudentId'];?>&&RegNo=<?php echo $_REQUEST['RegNo'];?>&&RollNo=<?php echo $_REQUEST['RollNo'];?>&&BatchSr=<?php echo $_REQUEST['BatchSr'];?>&&Name=<?php echo $_REQUEST['Name'];?>&&CentreCode=<?php echo $_REQUEST['CentreCode'];?>&&first_number=<?php echo $first_number;?>&&last_number=<?php echo $last_number;?>" target="_blank">PRINT CENTRE SLIP FROM <?php echo $first_number.'-'.$last_number;?></a></td>
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