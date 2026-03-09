<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	$sql1="SELECT COUNT(*) AS TotalStudents, COUNT(CASE WHEN IsPrinted=1 THEN 1 END) AS PrintedSlips FROM vwrollnoslip10c WHERE IsRegular=1";
	$res1=mysql_query($sql1, $conn1);
	$row1=mysql_fetch_array($res1);
	?>

	<div id="content">
		<div class="grid_container">
			<span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Regular Students-RollNo Slips <?php echo $ExamName;?></h6>
					</div>

					<div class="widget_content">
						
						<form method="post">
						<table class="search">
						<tr><td colspan="6" style="color:#FF0000; font-size:14px; font-weight:bold;">Total Students: <?php echo $row1['TotalStudents'];?>&nbsp; &nbsp; Printed Slips: <?php echo $row1['PrintedSlips'];?></td></tr>
						<tr>
							<td><strong>Application No:</strong></td>
							<td><input name="StdudentId" id="StdudentId" type="text" value="<?php echo $_REQUEST['StdudentId'];?>" class="admin-select limiter" tabindex="1"/></td>
							<td><strong>SSC RegNo:</strong></td>
							<td><input name="RegNo" id="RegNo" type="text" value="<?php echo $_REQUEST['RegNo'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="12" tabindex="2"/></td>
							<td><strong>RollNo:</strong></td>
							<td><input name="RollNo" id="RollNo" type="text" value="<?php echo $_REQUEST['RollNo'];?>" class="admin-select limiter" tabindex="3"/></td>
						</tr>
						<tr>
							<td><strong>BatchSr:</strong></td>
							<td><input name="BatchSr" id="BatchSr" type="text" value="<?php echo $_REQUEST['BatchSr'];?>" class="admin-select limiter" maxlength="12" tabindex="4"/></td>
							<td><strong>Student Name:</strong></td>
							<td><input name="Name" id="Name" type="text" value="<?php echo $_REQUEST['Name'];?>" class="admin-select limiter" tabindex="5"/></td>
							<td><strong>Centre:</strong></td>
							<td>
								<select name="CentreCode" id="CentreCode" data-placeholder="Select Centre" class="chzn-select admin-select" tabindex="6"/>
								<option value="">Select</option>
								<?php
								$sql_centres="SELECT Id, Name, Code FROM centres WHERE IsActive=1 ORDER BY Code ASC";
								$res_centres=mysql_query($sql_centres, $conn1);
								while($row_centres=mysql_fetch_array($res_centres))
								{
									echo '<option value='.$row_centres['Code'].' '.(($_REQUEST['CentreCode']==$row_centres['Code'])?'selected':'').'>'.$row_centres['Code'].' '.ucwords(strtolower($row_centres['Name'])).'</option>';
								}
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td><strong>Institute:</strong></td>
							<td>
								<select name="InstituteCode" id="InstituteCode" data-placeholder="Select Institute" class="chzn-select admin-select" tabindex="7"/>
								<option value="">Select</option>
								<?php
								$sql_institutes="SELECT Id, Name, Code FROM institutes WHERE IsActive=1 ORDER BY Code ASC";
								$res_institutes=mysql_query($sql_institutes, $conn1);
								while($row_institutes=mysql_fetch_array($res_institutes))
								{
									echo '<option value='.$row_institutes['Code'].' '.(($_REQUEST['InstituteCode']==$row_institutes['Code'])?'selected':'').'>'.$row_institutes['Code'].' '.ucwords(strtolower($row_institutes['Name'])).'</option>';
								}
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="6" align="left">
								<input type="submit" name="search" id="search" value="Search" tabindex="8"/>
								<a class="iframe" href="choose_std-rollnoslips10.php?StdudentId=<?php echo $_REQUEST['StdudentId'];?>&&RegNo=<?php echo $_REQUEST['RegNo'];?>&&RollNo=<?php echo $_REQUEST['RollNo'];?>&&BatchSr=<?php echo $_REQUEST['BatchSr'];?>&&Name=<?php echo $_REQUEST['Name'];?>&&CentreCode=<?php echo $_REQUEST['CentreCode'];?>&&InstituteCode=<?php echo $_REQUEST['InstituteCode'];?>&&IsRegular=1"><span class="badge_style b_done">Print All RollNo Slips</span></a>
							</td>
						</tr>
						</table>
						</form>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>AppNo</th>
							<th>SSC RegNo</th>
							<th>RollNo</th>
							<th>BatchSr</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Combination</th>
							<th>Exam Shift</th>
							<th>Centre Code</th>
							<th>Centre Name</th>
							<th>IsPrinted</th>
							<th>Action</th>
							<th>Print</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_REQUEST['search']))
						{
							$SrNo=1;
							$sql="SELECT Id, RegNo, RollNo, Name, FatherName, Gender, ExamShift, CombinationName, BATCH_ID, IsPrinted, ACentreCode, ACentreName FROM vwrollnoslip10 WHERE IsRegular=1";
							
							//filter for StdudentId
							if(isset($_REQUEST['StdudentId']) && $_REQUEST['StdudentId']!='')
							{ $sql.=" AND Id IN (".$_REQUEST['StdudentId'].")"; }
							
							//filter for RegNo
							if(isset($_REQUEST['RegNo']) && $_REQUEST['RegNo']!='')
							{ $sql.=" AND RegNo='".$_REQUEST['RegNo']."'"; }
							
							//filter for RollNo
							if(isset($_REQUEST['RollNo']) && $_REQUEST['RollNo']!='')
							{ $sql.=" AND RollNo IN (".$_REQUEST['RollNo'].")"; }
							
							//filter for BatchSr
							if(isset($_REQUEST['BatchSr']) && $_REQUEST['BatchSr']!='')
							{ $sql.=" AND BATCH_ID LIKE '".$_REQUEST['BatchSr']."%'"; }
							
							//filter for Name
							if(isset($_REQUEST['Name']) && $_REQUEST['Name']!='')
							{ $sql.=" AND Name LIKE '".$_REQUEST['Name']."%'"; }
							
							//filter for CentreCode
							if(isset($_REQUEST['CentreCode']) && $_REQUEST['CentreCode']!='')
							{ $sql.=" AND ACentreCode='".$_REQUEST['CentreCode']."'"; }
							
							//filter for InstituteCode
							if(isset($_REQUEST['InstituteCode']) && $_REQUEST['InstituteCode']!='')
							{ $sql.=" AND InstituteCode='".$_REQUEST['InstituteCode']."'"; }
							
							$sql.=" ORDER BY RollNo ASC";
							$res=mysql_query($sql, $conn1);
							while($row=mysql_fetch_array($res))
							{
								if($row['Gender']==1){ $Gender='Male'; }
								else if($row['Gender']==2){ $Gender='Female'; }
								
								if($row['ExamShift']==1){ $ExamShift='First'; }
								else if($row['ExamShift']==2){ $ExamShift='Second'; }
								
								if($row['IsPrinted']==1){ $IsPrinted='Yes'; }
								else if($row['IsPrinted']==2){ $IsPrinted='No'; }
							?>
							<tr>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['Id'];?></td>
								<td class="center"><?php echo $row['RegNo'];?></td>
								<td class="center"><?php echo $row['RollNo'];?></td>
								<td class="center"><?php echo $row['BATCH_ID'];?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td class="center"><?php echo $row['FatherName'];?></td>
								<td class="center"><?php echo $Gender;?></td>
								<td class="center"><?php echo $row['CombinationName'];?></td>
								<td class="center"><?php echo $ExamShift;?></td>
								<td class="center"><?php echo $row['ACentreCode'];?></td>
								<td class="center"><?php echo $row['ACentreName'];?></td>
								<td class="center">
								<?php if($row['IsPrinted'] == 1){?><span class="badge_style b_confirmed">Yes</span><?php }
								else {?><span class="badge_style b_pending">No</span><?php }?>
								</td>
								<td class="center">
								<?php if(in_array('160801',$_SESSION['emp_user_rights'])){?>
								<span><a class="action-icons c-delete" href="delete_rollnoslips10.php?Id=<?php echo $row['Id'];?>&Type=1" title="Delete">Delete</a></span>
								<?php }?>
								</td>
								<td class="center"><a href="print_student_allrollnoslips10.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_medium">RollNo Slip</span></a></td>
							</tr>
							<?php
							$SrNo++;
							}
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<th>SrNo</th>
							<th>AppNo</th>
							<th>SSC RegNo</th>
							<th>RollNo</th>
							<th>BatchSr</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Combination</th>
							<th>Exam Shift</th>
							<th>Centre Code</th>
							<th>Centre Name</th>
							<th>IsPrinted</th>
							<th>Action</th>
							<th>Print</th>
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