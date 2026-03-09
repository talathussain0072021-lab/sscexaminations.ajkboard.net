<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	$sql1="SELECT COUNT(*) AS TotalStudents, COUNT(CASE WHEN IsPrinted=1 THEN 1 END) AS PrintedSlips FROM tblpractrollnoslip10 WHERE AdmStatus=1";
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
						<h6>All Students-Practical RollNo Slips <?php echo $ExamName;?></h6>
					</div>

					<div class="widget_content">
						
						<form method="post">
						<table class="search">
						<tr><td colspan="6" style="color:#FF0000; font-size:14px; font-weight:bold;">Total Students: <?php echo $row1['TotalStudents'];?>&nbsp; &nbsp; Printed Slips: <?php echo $row1['PrintedSlips'];?></td></tr>
						<tr>
							<td><strong>Application No:</strong></td>
							<td><input name="StdudentId" id="StdudentId" type="text" value="<?php echo $_REQUEST['StdudentId'];?>" class="admin-select limiter" tabindex="1"/></td>
							<td><strong>RollNo:</strong></td>
							<td><input name="RollNo" id="RollNo" type="text" value="<?php echo $_REQUEST['RollNo'];?>" class="admin-select limiter" tabindex="2"/></td>
							<td><strong>BatchSr:</strong></td>
							<td><input name="BatchSr" id="BatchSr" type="text" value="<?php echo $_REQUEST['BatchSr'];?>" class="admin-select limiter" maxlength="12" tabindex="3"/></td>
						</tr>
						<tr>
							<td><strong>Student Name:</strong></td>
							<td><input name="Name" id="Name" type="text" value="<?php echo $_REQUEST['Name'];?>" class="admin-select limiter" tabindex="4"/></td>
							<td><strong>Centre:</strong></td>
							<td>
								<select name="CentreCode" id="CentreCode" data-placeholder="Select Centre" class="chzn-select admin-select" tabindex="5"/>
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
								<input type="submit" name="search" value="Search" tabindex="6"/>
								<a class="iframe" href="choose_std-practrollnoslips10.php?StdudentId=<?php echo $_REQUEST['StdudentId'];?>&&RollNo=<?php echo $_REQUEST['RollNo'];?>&&BatchSr=<?php echo $_REQUEST['BatchSr'];?>&&Name=<?php echo $_REQUEST['Name'];?>&&CentreCode=<?php echo $_REQUEST['CentreCode'];?>"><span class="badge_style b_done">Print All Practical Slips</span></a>
							</td>
						</tr>
						</table>
						</form>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>AppNo</th>
							<th>RollNo</th>
							<th>BatchSr</th>
							<th>Student Name</th>
							<th>Centre Code</th>
							<th>Centre Name</th>
							<th>IsPrinted</th>
							<th>Print</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_REQUEST['search']))
						{
							$SrNo=1;
							$sql="SELECT Id, RollNo, Name, AdmBatchNo, AdmBatchSr, CentreCode, CentreName, IsPrinted FROM tblpractrollnoslip10 WHERE RollNo!=0 AND AdmStatus=1";
							
							//filter for StdudentId
							if(isset($_REQUEST['StdudentId']) && $_REQUEST['StdudentId']!='')
							{ $sql.=" AND Id IN (".$_REQUEST['StdudentId'].")"; }
							
							//filter for RollNo
							if(isset($_REQUEST['RollNo']) && $_REQUEST['RollNo']!='')
							{ $sql.=" AND RollNo IN (".$_REQUEST['RollNo'].")"; }
							
							//filter for BatchSr
							if(isset($_REQUEST['BatchSr']) && $_REQUEST['BatchSr']!='')
							{ $sql.=" AND AdmBatchNo LIKE '".$_REQUEST['BatchSr']."%'"; }
							
							//filter for Name
							if(isset($_REQUEST['Name']) && $_REQUEST['Name']!='')
							{ $sql.=" AND Name LIKE '".$_REQUEST['Name']."%'"; }
							
							//filter for CentreCode
							if(isset($_REQUEST['CentreCode']) && $_REQUEST['CentreCode']!='')
							{ $sql.=" AND CentreCode='".$_REQUEST['CentreCode']."'"; }
							
							$sql.=" ORDER BY RollNo ASC";
							$res=mysql_query($sql, $conn1);
							while($row=mysql_fetch_array($res))
							{
							?>
							<tr>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['Id'];?></td>
								<td class="center"><?php echo $row['RollNo'];?></td>
								<td class="center"><?php echo $row['AdmBatchNo'].'/'.$row['AdmBatchSr'];?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td class="center"><?php echo $row['CentreCode'];?></td>
								<td class="center"><?php echo $row['CentreName'];?></td>
								<td class="center">
								<?php if($row['IsPrinted'] == 1){?><span class="badge_style b_confirmed">Yes</span><?php }
								else {?><span class="badge_style b_pending">No</span><?php }?>
								</td>
								<td class="center"><a href="print_student_allpractrollnoslips10.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_medium">RollNo Slip</span></a></td>
							</tr>
							<?php
							$SrNo++;
							}
						}//if(isset($_REQUEST['search']))
						?>
						</tbody>
						<tfoot>
						<tr>
							<th>SrNo</th>
							<th>AppNo</th>
							<th>RollNo</th>
							<th>BatchSr</th>
							<th>Student Name</th>
							<th>Centre Code</th>
							<th>Centre Name</th>
							<th>IsPrinted</th>
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