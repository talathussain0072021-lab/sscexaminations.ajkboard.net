<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	$sql1="SELECT Id FROM vwrollnoslip10";
	$res1=mysql_query($sql1, $conn1);
	$num_rows1=mysql_num_rows($res1);
	?>

	<div id="content">
		<div class="grid_container">
			<span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>All Students-Centre Slips <?php echo $ExamName;?></h6>
					</div>

					<div class="widget_content">
						
						<form method="post">
						<table class="search">
						<tr><td colspan="6" style="color:#FF0000; font-size:14px; font-weight:bold;">Total Students: <?php echo $num_rows1;?></td></tr>
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
							<td colspan="6" align="left">
								<input type="submit" name="search1" id="search1" value="Search" tabindex="7"/>
								<a class="iframe" href="choose_std-centreslips10.php?StdudentId=<?php echo $_REQUEST['StdudentId'];?>&&RegNo=<?php echo $_REQUEST['RegNo'];?>&&RollNo=<?php echo $_REQUEST['RollNo'];?>&&BatchSr=<?php echo $_REQUEST['BatchSr'];?>&&Name=<?php echo $_REQUEST['Name'];?>&&CentreCode=<?php echo $_REQUEST['CentreCode'];?>"><span class="badge_style b_done">Print All Centre Slips</span></a>
							</td>
						</tr>
						</table>
						</form>
						<!--
						<form method="post">
						<table class="search">
						<tr>
							<td><strong>Centre:</strong></td>
							<td>
								<select name="CentreCode" id="CentreCode" data-placeholder="Select Centre" class="chzn-select admin-select" tabindex="1"/>
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
							<td colspan="2" align="left">
								<input type="submit" name="search2" id="search2" value="Search" tabindex="2"/>
								<a class="iframe" href="choose_std-custcentreslips10.php?CentreCode=<?php echo $_REQUEST['CentreCode'];?>"><span class="badge_style b_done">Print All Centre Slips</span></a>
							</td>
						</tr>
						</table>
						</form>
						-->
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
							<th>GroupId</th>
							<th>Exam Shift</th>
							<th>Centre Code</th>
							<th>Centre Name</th>
							<th>Print</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_REQUEST['search1']))
						{
							$SrNo=1;
							$sql="SELECT Id, RegNo, RollNo, Name, FatherName, Gender, ExamShift, GroupId, BATCH_ID, ACentreCode, ACentreName FROM vwrollnoslip10 WHERE RollNo!=0";
							
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
							
							$sql.=" ORDER BY ACentreCode, ExamShift, RollNo ASC";
							$res=mysql_query($sql, $conn1);
							while($row=mysql_fetch_array($res))
							{
								if($row['Gender']==1){ $Gender='Male'; }
								else if($row['Gender']==2){ $Gender='Female'; }
								
								if($row['ExamShift']==1){ $ExamShift='First'; }
								else if($row['ExamShift']==2){ $ExamShift='Second'; }
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
								<td class="center"><?php echo $row['GroupId'];?></td>
								<td class="center"><?php echo $ExamShift;?></td>
								<td class="center"><?php echo $row['ACentreCode'];?></td>
								<td class="center"><?php echo $row['ACentreName'];?></td>
								<td class="center"><a href="print_student_allcentreslips10.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_medium">Centre Slip</span></a></td>
							</tr>
							<?php
							$SrNo++;
							}
						}//if(isset($_REQUEST['search1']))
						
						/*if(isset($_REQUEST['search2']))
						{
							$SrNo=1;
							$sql="SELECT Id, RegNo, RollNo, Name, FatherName, Gender, ExamShift, GroupId, BATCH_ID, ACentreCode, ACentreName FROM vwrollnoslip10 WHERE RollNo!=0 AND ACentreCode='".$_REQUEST['CentreCode']."' ORDER BY ExamShift, RollNo ASC";
							$res=mysql_query($sql, $conn1);
							while($row=mysql_fetch_array($res))
							{
								if($row['Gender']==1){ $Gender='Male'; }
								else if($row['Gender']==2){ $Gender='Female'; }
								
								if($row['ExamShift']==1){ $ExamShift='First'; }
								else if($row['ExamShift']==2){ $ExamShift='Second'; }
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
								<td class="center"><?php echo $row['GroupId'];?></td>
								<td class="center"><?php echo $ExamShift;?></td>
								<td class="center"><?php echo $row['ACentreCode'];?></td>
								<td class="center"><?php echo $row['ACentreName'];?></td>
								<td class="center"><a href="print_student_centreslip10.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_medium">Centre Slip</span></a></td>
							</tr>
							<?php
							$SrNo++;
							}
						}//if(isset($_REQUEST['search2']))*/
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
							<th>GroupId</th>
							<th>Exam Shift</th>
							<th>Centre Code</th>
							<th>Centre Name</th>
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