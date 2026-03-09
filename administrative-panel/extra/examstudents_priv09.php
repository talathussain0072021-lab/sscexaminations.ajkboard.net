<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	$sql1="SELECT Id FROM vwadmstudents09 WHERE IsRegular=0 AND StdAdmStatus=1 AND SessionId=".$SessionId." AND BatchId is Not NULL";
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
						<h6>All Private Students <?php echo $ExamName;?></h6>
					</div>

					<div class="widget_content">
						
						<table class="search">
						<tr><td colspan="6" style="color:#FF0000; font-size:14px; font-weight:bold;">Total Students: <?php echo $num_rows1;?></td></tr>
						<form method="post">
						<tr>
							<td><strong>BatchNo:</strong></td>
							<td>
								<select name="BatchId" id="BatchId" data-placeholder="Select BatchNo" class="chzn-select admin-select" tabindex="1"/>
								<option value="All">All</option>
								<?php
								$sql_batch="SELECT Id, BatchNo FROM vwadmbatches09 WHERE BatchType=2 AND ExamId=".$ExamId." ORDER BY BatchNo ASC";
								$res_batch=mysql_query($sql_batch, $conn1);
								while($row_batch=mysql_fetch_array($res_batch))
								{
									echo '<option value='.$row_batch['Id'].' '.(($_REQUEST['BatchId']==$row_batch['Id'])?'selected':'').'>'.$row_batch['BatchNo'].'</option>';
								}
								?>
								</select>
							</td>
							<td><strong>BatchSr:</strong></td>
							<td>
								<input name="BatchSr" id="BatchSr" type="text" value="<?php echo $_REQUEST['BatchSr'];?>" class="admin-select" maxlength="10" tabindex="2"/>
							</td>
						</tr>
						<tr>
							<td><strong>Date From:</strong></td>
							<td>
								<input name="StartDate" id="StartDate" type="date" value="<?php echo $_REQUEST['StartDate'];?>" tabindex="3"/>
							</td>
							<td><strong>Date To:</strong></td>
							<td>
								<input name="EndDate" id="EndDate" type="date" value="<?php echo $_REQUEST['EndDate'];?>" tabindex="4"/>
							</td>
						</tr>
						<tr>
							<td colspan="6">
								<input type="submit" name="search" id="search" value="Search" tabindex="5"/>
							</td>
						</tr>
						</form>
						</table>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>AppNo</th>
							<th>Dated</th>
							<th>RegNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Combination</th>
							<th>BatchNo</th>
							<th>BatchSr</th>
							<th>Exam Centre</th>
							<th>Domicile</th>
							<th>Picture</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_REQUEST['search']))
						{
							$SrNo=1;
							$sql="SELECT Id, Dated, Name, FatherName, PicURL, Gender, Domicile, CombinationName, GroupName, BatchNo, BatchSr, ACentreCode, RegistrationNo FROM vwadmstudents09 WHERE IsRegular=0 AND StdAdmStatus=1 AND SessionId=".$SessionId."";
							
							if(isset($_REQUEST['BatchId']) && $_REQUEST['BatchId']!='All')
							{ $sql.=" AND BatchId=".$_REQUEST['BatchId'].""; }
							
							if(isset($_REQUEST['BatchSr']) && $_REQUEST['BatchSr']!='')
							{ $sql.=" AND BatchSr IN (".$_REQUEST['BatchSr'].")"; }
							
							if(isset($_REQUEST['StartDate']) && $_REQUEST['StartDate']!='' && isset($_REQUEST['EndDate']) && $_REQUEST['EndDate']!='')
							{ $sql.=" AND Dated >= '".$_REQUEST['StartDate']."' AND Dated <= '".$_REQUEST['EndDate']."'"; }
							
							$sql.=" AND BatchId is Not NULL ORDER BY Id ASC";
							$res=mysql_query($sql, $conn1);
							while($row=mysql_fetch_array($res))
							{
								if($row['Gender'] == 1){ $Gender='Male'; }
								else if($row['Gender'] == 2){ $Gender='Female'; }
								else { $Gender=''; }
								
								$sql_districts="SELECT Name FROM districts WHERE Id=".$row['Domicile']." ORDER BY Name ASC";
								$res_districts=mysql_query($sql_districts, $conn1);
								$row_districts=mysql_fetch_array($res_districts);
							?>
							<tr>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['Id'];?></td>
								<td class="center"><?php echo date('d-m-Y', strtotime($row['Dated']));?></td>
								<td class="center"><?php echo $row['RegistrationNo'];?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td class="center"><?php echo $row['FatherName'];?></td>
								<td class="center"><?php echo $Gender;?></td>
								<td class="center"><?php echo $row['GroupName'];?></td>
								<td class="center"><?php echo $row['CombinationName'];?></td>
								<td class="center"><?php echo $row['BatchNo'];?></td>
								<td class="center"><?php echo $row['BatchSr'];?></td>
								<td class="center"><?php echo $row['ACentreCode'];?></td>
								<td class="center"><?php echo $row_districts['Name'];?></td>
								<td class="center"><img id="output" style="height:80px; width:80px;" src="<?php echo '../institution-panel/'.$row['PicURL']."?".rand(00000,999999);?>"/></td>
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
							<th>Dated</th>
							<th>RegNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Combination</th>
							<th>BatchNo</th>
							<th>BatchSr</th>
							<th>Exam Centre</th>
							<th>Domicile</th>
							<th>Picture</th>
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