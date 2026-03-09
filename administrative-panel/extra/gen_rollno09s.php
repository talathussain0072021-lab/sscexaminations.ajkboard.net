<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit1']))
	{
		$sql = mysql_query("CALL PIsRemRollNoAllotment(".$_REQUEST['dummy1'].")", $conn1);
		
		if($sql)
		{
			?><script>alert('RollNo allotted Successfully.');location.replace('gen_rollno09s.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('gen_rollno09s.php');</script><?php
		}
	}//if(isset($_REQUEST['submit1']))
	if(isset($_REQUEST['submit2']))
	{
		$sql = mysql_query("CALL vwrollnoslip09sTableCreation(".$_REQUEST['dummy2'].")", $conn1);
		
		if($sql)
		{
			?><script>alert('RollNoSlip generated Successfully.');location.replace('gen_rollno09s.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('gen_rollno09s.php');</script><?php
		}
	}//if(isset($_REQUEST['submit2']))
	?>
	<?php
	$sql="SELECT COUNT(*) AS TotalStudents, COUNT(CASE WHEN RollNo!=0 AND StdAdmStatus=1 THEN 1 END) AS WithRollNo, COUNT(CASE WHEN RollNo=0 AND StdAdmStatus=1 THEN 1 END) AS WithOutRollNo FROM vwadmstudents09s";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	?>

	<div id="content">
		<div class="grid_container">
			<span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Generate RollNo <?php echo $ExamName;?></h6>
					</div>

					<div class="widget_content">
						
						<form method="get">
						<table class="search">
						<tr><td colspan="3" style="color:#FF0000; font-size:14px; font-weight:bold;">Total Students: <?php echo $row['TotalStudents'];?> &nbsp; &nbsp; With RollNo: <?php echo $row['WithRollNo'];?> &nbsp; &nbsp; WithOut RollNo: <?php echo $row['WithOutRollNo'];?></td></tr>
						<tr>
							<td style="color:#FF0000; font-size:14px; font-weight:bold;">Allot RollNo</td>
							<td><input name="dummy1" id="dummy1" type="text" value="<?php echo $_REQUEST['dummy1'];?>" class="large" onkeypress="return isNumber()" maxlength="5" tabindex="1"/></td>
							<td><input type="submit" name="submit1" value="Generate RollNo" tabindex="2"/></td>
						</tr>
						<tr>
							<td style="color:#FF0000; font-size:14px; font-weight:bold;">Create RollNoSlip</td>
							<td><input name="dummy2" id="dummy2" type="text" value="<?php echo $_REQUEST['dummy2'];?>" class="large" onkeypress="return isNumber()" maxlength="5" tabindex="3"/></td>
							<td><input type="submit" name="submit2" value="Generate RollNoSlip" tabindex="4"/></td>
						</tr>
						</table>
						</form>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>Duplicate RollNo</th>
							<th>Count</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$SrNo=1;
						$sql="SELECT `RollNo`, COUNT(`RollNo`) AS C FROM `admbatchstudents09s` GROUP BY `RollNo` HAVING COUNT(`RollNo`)>1";
						$res=mysql_query($sql, $conn1);
						while($row=mysql_fetch_array($res))
						{?>
						<tr>
							<td class="center"><?php echo $SrNo;?></td>
							<td class="center"><?php echo $row['RollNo'];?></td>
							<td class="center"><?php echo $row['C'];?></td>
						</tr>
						<?php
						$SrNo++;
						}?>
						</tbody>
						<tfoot>
						<tr>
							<th>SrNo</th>
							<th>Duplicate RollNo</th>
							<th>Count</th>
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