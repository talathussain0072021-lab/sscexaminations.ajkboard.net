<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	$sql1="SELECT Id FROM vwadmstudents09s WHERE IsRegular=0 AND ExamId=".$ExamId."";
	$res1=mysql_query($sql1, $conn1);
	$num_rows1=mysql_num_rows($res1);
	
	$sql2="SELECT Id FROM vwadmstudents09s WHERE IsRegular=0 AND ExamId=".$ExamId." AND BatchId is Not NULL";
	$res2=mysql_query($sql2, $conn1);
	$num_rows2=mysql_num_rows($res2);
	
	$sql3="SELECT Id FROM vwadmstudents09s WHERE IsRegular=0 AND ExamId=".$ExamId." AND BatchId is NULL";
	$res3=mysql_query($sql3, $conn1);
	$num_rows3=mysql_num_rows($res3);
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
						<tr><td colspan="6" style="color:#FF0000; font-size:14px; font-weight:bold;">Total Students: <?php echo $num_rows1;?> With Batch: <?php echo $num_rows2;?> W/O Batch: <?php echo $num_rows3;?></td></tr>
						<form method="post">
						<tr>
							<td><strong>AdmCategory:</strong></td>
							<td>
								<select name="AdmSubCategory" id="AdmSubCategory" data-placeholder="Select AdmSubCategory" class="chzn-select admin-select" tabindex="1"/>
								<option value="All">All</option>
								<option value="11" <?php echo (($_REQUEST['AdmSubCategory']==11)?'selected':'')?>>Fresh AJK</option>
								<option value="13" <?php echo (($_REQUEST['AdmSubCategory']==13)?'selected':'')?>>Fresh Other</option>
								</select>
							</td>
							<td><strong>BatchNo:</strong></td>
							<td>
								<select name="BatchId" id="BatchId" data-placeholder="Select BatchNo" class="chzn-select admin-select" tabindex="2"/>
								<option value="All">All</option>
								<?php
								$sql_batch="SELECT Id, BatchNo FROM vwadmbatches09s WHERE BatchType=2 AND ExamId=".$ExamId." ORDER BY BatchNo ASC";
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
								<input name="BatchSr" id="BatchSr" type="text" value="<?php echo $_REQUEST['BatchSr'];?>" class="admin-select" maxlength="10" tabindex="3"/>
							</td>
						</tr>
						<tr>
							<td><strong>BatchSr From:</strong></td>
							<td>
								<input name="SrFrom" id="SrFrom" type="text" value="<?php echo $_REQUEST['SrFrom'];?>" class="small" onkeypress="return isNumber()" maxlength="2" tabindex="4"/>
							</td>
							<td><strong>BatchSr To:</strong></td>
							<td>
								<input name="SrTo" id="SrTo" type="text" value="<?php echo $_REQUEST['SrTo'];?>" class="small" onkeypress="return isNumber()" maxlength="2" tabindex="5"/>
							</td>
							<td><strong>Admission Status:</strong></td>
							<td>
								<select name="StdAdmStatus" id="StdAdmStatus" data-placeholder="Select Admission Status" class="chzn-select admin-select" tabindex="6"/>
								<option value="All">All</option>
								<option value="3" <?php echo (($_REQUEST['StdAdmStatus']==3)?'selected':'')?>>Pending</option>
								<option value="1" <?php echo (($_REQUEST['StdAdmStatus']==1)?'selected':'')?>>Ok</option>
								<option value="2" <?php echo (($_REQUEST['StdAdmStatus']==2)?'selected':'')?>>Not Ok</option>
								</select>
							</td>
						</tr>
						<tr>
							<td><strong>Date From:</strong></td>
							<td>
								<input name="StartDate" id="StartDate" type="date" value="<?php echo $_REQUEST['StartDate'];?>" tabindex="7"/>
							</td>
							<td><strong>Date To:</strong></td>
							<td>
								<input name="EndDate" id="EndDate" type="date" value="<?php echo $_REQUEST['EndDate'];?>" tabindex="8"/>
							</td>
						</tr>
						<tr>
							<td colspan="6">
								<input type="submit" name="search" id="search" value="Search" tabindex="9"/>
							</td>
						</tr>
						</form>
						</table>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>AppNo</th>
							<th>P1 Year</th>
							<th>P1 RollNo</th>
							<th>P1 Session</th>
							<th>P1 RegNo</th>
							<th>P1 Board</th>
							<th>Dated</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>DOB</th>
							<th>Gender</th>
							<th>Category</th>
							<th>Group</th>
							<th>Combination</th>
							<th>BatchNo</th>
							<th>BatchSr</th>
							<th>Fee</th>
							<th>ChallanNo</th>
							<th>Exam Centre</th>
							<th>AdmStatus</th>
							<th>RevStatus</th>
							<th>Domicile</th>
							<th>Adm Category</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_REQUEST['search']))
						{
							$SrNo=1;
							$sql="SELECT Id, P1Year, P1RollNo, P1Session, P1RegNo, P1Board, Dated, Name, FatherName, DOB, Gender, IsSpecial, Domicile, AdmCategory, SubCategory, InstituteId, GroupName, CombinationName, BatchNo, BatchSr, StdAdmStatus, StdRevStatus, AdmissionFee, ChallanNo, ACentreCode FROM vwadmstudents09s WHERE IsRegular=0 AND ExamId=".$ExamId."";
							
							if(isset($_REQUEST['AdmSubCategory']) && $_REQUEST['AdmSubCategory']!='All')
							{
								if($_REQUEST['AdmSubCategory']==11){ $sql.=" AND AdmCategory=1 AND SubCategory=1"; }
								
								else if($_REQUEST['AdmSubCategory']==13){ $sql.=" AND AdmCategory=1 AND SubCategory=3"; }
							}
							
							if(isset($_REQUEST['BatchId']) && $_REQUEST['BatchId']!='All')
							{ $sql.=" AND BatchId=".$_REQUEST['BatchId'].""; }
							
							if(isset($_REQUEST['BatchSr']) && $_REQUEST['BatchSr']!='')
							{ $sql.=" AND BatchSr IN (".$_REQUEST['BatchSr'].")"; }
							
							if(isset($_REQUEST['SrFrom']) && $_REQUEST['SrFrom']!='' && isset($_REQUEST['SrTo']) && $_REQUEST['SrTo']!='')
							{ $sql.=" AND BatchSr BETWEEN ".$_REQUEST['SrFrom']." AND ".$_REQUEST['SrTo'].""; }
							
							if(isset($_REQUEST['StdAdmStatus']) && $_REQUEST['StdAdmStatus']!='All')
							{
								if($_REQUEST['StdAdmStatus'] == 3){ $sql.=" AND StdAdmStatus=0"; }
								else { $sql.=" AND StdAdmStatus=".$_REQUEST['StdAdmStatus'].""; }
							}
							
							if(isset($_REQUEST['StartDate']) && $_REQUEST['StartDate']!='' && isset($_REQUEST['EndDate']) && $_REQUEST['EndDate']!='')
							{ $sql.=" AND Dated >= '".$_REQUEST['StartDate']."' AND Dated <= '".$_REQUEST['EndDate']."'"; }
							
							$sql.=" AND BatchId is Not NULL ORDER BY Id ASC";
							$res=mysql_query($sql, $conn1);
							while($row=mysql_fetch_array($res))
							{
								if($row['P1Session'] == 1){ $P1Session='1st Annual'; }
								else if($row['P1Session'] == 2){ $P1Session='2nd Annual'; }
								else { $P1Session=''; }
								
								if($row['P1Board'] == 0){ $P1Board=''; }
								else if($row['P1Board'] == 1){ $P1Board='AJK'; }
								else { $P1Board='Other'; }
								
								if($row['Gender'] == 1){ $Gender='Male'; }
								else if($row['Gender'] == 2){ $Gender='Female'; }
								else { $Gender=''; }
								
								if($row['IsSpecial'] == 1){ $IsSpecial='Board Employee'."'".' Child'; }
								else if($row['IsSpecial'] == 2){ $IsSpecial='Refugee '."'".' Child'; }
								else if($row['IsSpecial'] == 3){ $IsSpecial='Normal Case'; }
								else if($row['IsSpecial'] == 4){ $IsSpecial='Special Student'; }
								else if($row['IsSpecial'] == 5){ $IsSpecial='Orphan Student'; }
								
								if($row['AdmCategory'] == 1 && $row['SubCategory'] == 1){ $AdmSubCategory='Fresh AJK'; }
								else if($row['AdmCategory'] == 1 && $row['SubCategory'] == 3){ $AdmSubCategory='Fresh Other'; }
								else { $AdmSubCategory=''; }
								
								if($row['StdAdmStatus'] == 0){ $StdAdmStatus='Pending'; }
								else if($row['StdAdmStatus'] == 1){ $StdAdmStatus='Ok'; }
								else if($row['StdAdmStatus'] == 2){ $StdAdmStatus='Not Ok'; }
								
								if($row['StdRevStatus'] == 0){ $StdRevStatus='Pending'; }
								else if($row['StdRevStatus'] == 1){ $StdRevStatus='Ok'; }
								else if($row['StdRevStatus'] == 2){ $StdRevStatus='Not Ok'; }
								
								$sql_districts="SELECT Name FROM districts WHERE Id=".$row['Domicile']." ORDER BY Name ASC";
								$res_districts=mysql_query($sql_districts, $conn1);
								$row_districts=mysql_fetch_array($res_districts);
							?>
							<tr>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['Id'];?></td>
								<td class="center"><?php echo $row['P1Year'];?></td>
								<td class="center"><?php echo $row['P1RollNo'];?></td>
								<td class="center"><?php echo $P1Session;?></td>
								<td class="center"><?php echo $row['P1RegNo'];?></td>
								<td class="center"><?php echo $P1Board;?></td>
								<td class="center"><?php echo date('d-m-Y', strtotime($row['Dated']));?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td class="center"><?php echo $row['FatherName'];?></td>
								<td class="center"><?php echo date('d-m-Y', strtotime($row['DOB']));?></td>
								<td class="center"><?php echo $Gender;?></td>
								<td class="center"><?php echo $IsSpecial;?></td>
								<td class="center"><?php echo $row['GroupName'];?></td>
								<td class="center"><?php echo $row['CombinationName'];?></td>
								<td class="center"><?php echo $row['BatchNo'];?></td>
								<td class="center"><?php echo $row['BatchSr'];?></td>
								<td class="center"><?php echo floatval($row['AdmissionFee']);?></td>
								<td class="center"><?php echo $row['ChallanNo'];?></td>
								<td class="center"><?php echo $row['ACentreCode'];?></td>
								<td class="center"><?php echo $StdAdmStatus;?></td>
								<td class="center"><?php echo $StdRevStatus;?></td>
								<td class="center"><?php echo $row_districts['Name'];?></td>
								<td class="center"><?php echo $AdmSubCategory;?></td>
								<td class="center">
								<?php
								/*if(in_array('100401',$_SESSION['emp_user_rights'])){?>
									<span><a class="action-icons c-Delete" onClick="return confirm('Are you sure you want to delete this?');" href="deleteallstudents_padm09s.php?Id=<?php echo $row['Id'];?>" title="Delete">Delete</a></span>
								<?php }*/?>
								</td>
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
							<th>P1 Year</th>
							<th>P1 RollNo</th>
							<th>P1 Session</th>
							<th>P1 RegNo</th>
							<th>P1 Board</th>
							<th>Dated</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>DOB</th>
							<th>Gender</th>
							<th>Category</th>
							<th>Group</th>
							<th>Combination</th>
							<th>BatchNo</th>
							<th>BatchSr</th>
							<th>Fee</th>
							<th>ChallanNo</th>
							<th>Exam Centre</th>
							<th>AdmStatus</th>
							<th>RevStatus</th>
							<th>Domicile</th>
							<th>Adm Category</th>
							<th>Action</th>
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