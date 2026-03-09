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
						<h6>Edit Student</h6>
					</div>

					<div class="widget_content">
						
						<form method="post">
						<table class="search">
						<tr>
							<td><strong>From Date:</strong></td>
							<td><input name="Date1" id="Date1" type="date" value="<?php echo $_REQUEST['Date1'];?>" class="admin-select limiter" tabindex="1"/></td>
							<td><strong>To Date:</strong></td>
							<td><input name="Date2" id="Date2" type="date" value="<?php echo $_REQUEST['Date2'];?>" class="admin-select limiter" tabindex="2"/></td>
							<td><strong>Application No:</strong></td>
							<td><input name="StdudentId" id="StdudentId" type="text" value="<?php echo $_REQUEST['StdudentId'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="8" tabindex="3"/></td>
						</tr>
						<tr>
							<td><strong>RegNo:</strong></td>
							<td><input name="RegNo" id="RegNo" type="text" value="<?php echo $_REQUEST['RegNo'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="11" tabindex="4"/></td>
							<td><strong>P1Year:</strong></td>
							<td><input name="P1Year" id="P1Year" type="text" value="<?php echo $_REQUEST['P1Year'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="2" tabindex="5"/></td>
							<td><strong>P1RollNo:</strong></td>
							<td><input name="P1RollNo" id="P1RollNo" type="text" value="<?php echo $_REQUEST['P1RollNo'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="6" tabindex="6"/></td>
						</tr>
						<tr>
							<td><strong>P1Session:</strong></td>
							<td>
								<select name="P1Session" id="P1Session" data-placeholder="Select Session" class="chzn-select admin-select" tabindex="7"/>
								<option value="">Select</option>
								<option value="1" <?php echo (($_REQUEST['P1Session']==1)?'selected':'');?>>Annual</option>
								<option value="2" <?php echo (($_REQUEST['P1Session']==2)?'selected':'');?>>Supply</option>
								</select>
							</td>
							<td><strong>P1Board:</strong></td>
							<td>
								<select name="P1Board" id="P1Board" data-placeholder="Select Board" class="chzn-select admin-select" tabindex="8"/>
								<option value="">Select</option>
								<?php
								$sql_boards="SELECT Id, Name FROM boards WHERE Id NOT IN (36)";
								$res_boards=mysql_query($sql_boards, $conn1);
								while($row_boards=mysql_fetch_array($res_boards))
								{ echo '<option value="'.$row_boards['Id'].'" '.(($_REQUEST['P1Board']==$row_boards['Id'])?'selected':'').'>'.$row_boards['Name'].'</option>'; }
								?>
								</select>
							</td>
							<td><strong>PYear:</strong></td>
							<td><input name="PYear" id="PYear" type="text" value="<?php echo $_REQUEST['PYear'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="2" tabindex="9"/></td>
						</tr>
						<tr>
							<td><strong>PRollNo:</strong></td>
							<td><input name="PRollNo" id="PRollNo" type="text" value="<?php echo $_REQUEST['PRollNo'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="6" tabindex="10"/></td>
							<td><strong>PSession:</strong></td>
							<td>
								<select name="PSession" id="PSession" data-placeholder="Select Session" class="chzn-select admin-select" tabindex="11"/>
								<option value="">Select</option>
								<option value="1" <?php echo (($_REQUEST['PSession']==1)?'selected':'');?>>Annual</option>
								<option value="2" <?php echo (($_REQUEST['PSession']==2)?'selected':'');?>>Supply</option>
								</select>
							</td>
							<td><strong>PBoard:</strong></td>
							<td>
								<select name="PBoard" id="PBoard" data-placeholder="Select Board" class="chzn-select admin-select" tabindex="12"/>
								<option value="">Select</option>
								<?php
								$sql_boards="SELECT Id, Name FROM boards WHERE Id NOT IN (36)";
								$res_boards=mysql_query($sql_boards, $conn1);
								while($row_boards=mysql_fetch_array($res_boards))
								{ echo '<option value="'.$row_boards['Id'].'" '.(($_REQUEST['PBoard']==$row_boards['Id'])?'selected':'').'>'.$row_boards['Name'].'</option>'; }
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td><strong>Student Name:</strong></td>
							<td><input name="Name" id="Name" type="text" value="<?php echo $_REQUEST['Name'];?>" class="admin-select limiter" tabindex="13"/></td>
							<td><strong>CNIC:</strong></td>
							<td><input name="CNIC" id="CNIC" type="text" value="<?php echo $_REQUEST['CNIC'];?>" class="admin-select limiter" maxlength="15" tabindex="14"/></td>
							<td><strong>Institute:</strong></td>
							<td>
								<select name="InstituteId" Id="InstituteId" data-placeholder="Select Institute" class="chzn-select admin-select" tabindex="15"/>
								<option value="">Select</option>
								<?php
								$sql_inst="SELECT Id, Name, Code FROM institutes ORDER BY Code ASC";
								$res_inst=mysql_query($sql_inst, $conn1);
								while($row_inst=mysql_fetch_array($res_inst))
								{
									echo '<option value='.$row_inst['Id'].' '.(($_REQUEST['InstituteId']==$row_inst['Id'])?'selected':'').'>'.$row_inst['Code'].' '.ucwords(strtolower($row_inst['Name'])).'</option>';
								}
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td><strong>Adm BatchNo:</strong></td>
							<td>
								<select name="AdmBatchId" id="AdmBatchId" data-placeholder="Select BatchNo" class="chzn-select admin-select" tabindex="16"/>
								<option value="">Select</option>
								<?php
								$sql_batch="SELECT Id, BatchNo FROM vwadmbatches10 WHERE BatchStatus!=5 AND ExamId=".$ExamId." ORDER BY BatchNo ASC";
								$res_batch=mysql_query($sql_batch, $conn1);
								while($row_batch=mysql_fetch_array($res_batch))
								{
									echo '<option value='.$row_batch['Id'].' '.(($_REQUEST['AdmBatchId']==$row_batch['Id'])?'selected':'').'>'.$row_batch['BatchNo'].'</option>';
								}
								?>
								</select>
							</td>
							<td><strong>Adm BatchSr:</strong></td>
							<td>
								<input name="AdmBatchSr" id="AdmBatchSr" type="text" value="<?php echo $_REQUEST['AdmBatchSr'];?>" class="admin-select" maxlength="10" tabindex="17"/>
							</td>
							<td><strong>RollNo New:</strong></td>
							<td>
								<input name="RollNo" id="RollNo" type="text" value="<?php echo $_REQUEST['RollNo'];?>" class="admin-select" onkeypress="return isNumber()" maxlength="6" tabindex="18"/>
							</td>
						</tr>
						<tr>
							<td colspan="6"><input type="submit" name="search" id="search" value="Search" tabindex="19"/></td>
						</tr>
						</table>
						</form>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>AppNo</th>
							<th>P1 RegNo</th>
							<th>P RegNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Combination</th>
							<th>IsRegular</th>
							<th>Adm Category</th>
							<th>Institute Code</th>
							<th>Institute Name</th>
							<th>Picture</th>
							<th>Group/Combination</th>
							<th>Medium</th>
							<th>Basic Info</th>
							<th>Personal Info</th>
							<th>Contact Info</th>
							<th>Centre Info</th>
							<th>Shift Info</th>
						<!--<th>Challan/Fee Info</th>-->
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_REQUEST['search']))
						{
							$SrNo=1;
							$sql="SELECT Id, P1Year, P1RollNo, P1Session, P1RegNo, P1Board, PYear, PRollNo, PSession, PRegNo, PBoard, Dated, Name, FatherName, PicURL, Gender, IsSpecial, IsRegular, AdmCategory, SubCategory, InstituteId, CombinationName, GroupName, BatchNo, BatchSr, StdInstituteCode, StdInstituteName FROM vwadmstudents10 WHERE ExamId=".$ExamId."";
							
							//filter for Date
							if(isset($_REQUEST['Date1']) && $_REQUEST['Date1']!='' && isset($_REQUEST['Date2']) && $_REQUEST['Date2']!='')
							{ $sql.=" AND Dated BETWEEN '".date('Y-m-d 00:00:00:000',strtotime($_REQUEST['Date1']))."' AND '".date('Y-m-d 23:59:59:999',strtotime($_REQUEST['Date2']))."'"; }
							
							//filter for StdudentId
							if(isset($_REQUEST['StdudentId']) && $_REQUEST['StdudentId']!='')
							{ $sql.=" AND Id=".$_REQUEST['StdudentId'].""; }
							
							//filter for RegNo
							if(isset($_REQUEST['RegNo']) && $_REQUEST['RegNo']!='')
							{ $sql.=" AND RegNo='".$_REQUEST['RegNo']."'"; }
							/*{ $sql.=" AND (P1RegNo='".$_REQUEST['RegNo']."' OR PRegNo='".$_REQUEST['RegNo']."')"; }*/
							
							//filter for P1Year
							if(isset($_REQUEST['P1Year']) && $_REQUEST['P1Year']!='')
							{ $sql.=" AND P1Year=".$_REQUEST['P1Year'].""; }
							
							//filter for P1RollNo
							if(isset($_REQUEST['P1RollNo']) && $_REQUEST['P1RollNo']!='')
							{ $sql.=" AND P1RollNo=".$_REQUEST['P1RollNo'].""; }
							
							//filter for P1Session
							if(isset($_REQUEST['P1Session']) && $_REQUEST['P1Session']!='')
							{ $sql.=" AND P1Session=".$_REQUEST['P1Session'].""; }
							
							//filter for P1Board
							if(isset($_REQUEST['P1Board']) && $_REQUEST['P1Board']!='')
							{ $sql.=" AND P1Board=".$_REQUEST['P1Board'].""; }
							
							//filter for PYear
							if(isset($_REQUEST['PYear']) && $_REQUEST['PYear']!='')
							{ $sql.=" AND PYear=".$_REQUEST['PYear'].""; }
							
							//filter for PRollNo
							if(isset($_REQUEST['PRollNo']) && $_REQUEST['PRollNo']!='')
							{ $sql.=" AND PRollNo=".$_REQUEST['PRollNo'].""; }
							
							//filter for PSession
							if(isset($_REQUEST['PSession']) && $_REQUEST['PSession']!='')
							{ $sql.=" AND PSession=".$_REQUEST['PSession'].""; }
							
							//filter for PBoard
							if(isset($_REQUEST['PBoard']) && $_REQUEST['PBoard']!='')
							{ $sql.=" AND PBoard=".$_REQUEST['PBoard'].""; }
							
							//filter for Name
							if(isset($_REQUEST['Name']) && $_REQUEST['Name']!='')
							{ $sql.=" AND Name LIKE '".$_REQUEST['Name']."%'"; }
							
							//filter for CNIC
							if(isset($_REQUEST['CNIC']) && $_REQUEST['CNIC']!='')
							{ $sql.=" AND CNIC='".$_REQUEST['CNIC']."'"; }
							
							//filter for InstituteId
							if(isset($_REQUEST['InstituteId']) && $_REQUEST['InstituteId']!='')
							{ $sql.=" AND InstituteId=".$_REQUEST['InstituteId'].""; }
							
							//filter for AdmBatchId
							if(isset($_REQUEST['AdmBatchId']) && $_REQUEST['AdmBatchId']!='')
							{ $sql.=" AND BatchId=".$_REQUEST['AdmBatchId'].""; }
							
							//filter for AdmBatchSr
							if(isset($_REQUEST['AdmBatchSr']) && $_REQUEST['AdmBatchSr']!='')
							{ $sql.=" AND BatchSr IN (".$_REQUEST['AdmBatchSr'].")"; }
							
							//filter for RollNo
							if(isset($_REQUEST['RollNo']) && $_REQUEST['RollNo']!='')
							{ $sql.=" AND RollNo=".$_REQUEST['RollNo'].""; }
							
							$sql.=" ORDER BY Id ASC";
							$res=mysql_query($sql, $conn1);
							while($row=mysql_fetch_array($res))
							{
								if($row['Gender'] == 1){ $Gender='Male'; }
								else if($row['Gender'] == 2){ $Gender='Female'; }
								else { $Gender=''; }
								
								if($row['AdmCategory'] == 1 && $row['SubCategory'] == 1){ $AdmSubCategory='Fresh AJK'; }
								else if($row['AdmCategory'] == 1 && $row['SubCategory'] == 2){ $AdmSubCategory='Composite AJK'; }
								else if($row['AdmCategory'] == 1 && $row['SubCategory'] == 3){ $AdmSubCategory='Fresh Other'; }
								else if($row['AdmCategory'] == 3 && $row['SubCategory'] == 1){ $AdmSubCategory='Improvement AJK'; }
								else if($row['AdmCategory'] == 4 && $row['SubCategory'] == 1){ $AdmSubCategory='Additional AJK'; }
								else if($row['AdmCategory'] == 5 && $row['SubCategory'] == 1){ $AdmSubCategory='Comp.Failure AJK'; }
								else if($row['AdmCategory'] == 5 && $row['SubCategory'] == 2){ $AdmSubCategory='Comp.Failure Other'; }
								else if($row['AdmCategory'] == 6 && $row['SubCategory'] == 1){ $AdmSubCategory='Compartment AJK'; }
								else if($row['AdmCategory'] == 6 && $row['SubCategory'] == 2){ $AdmSubCategory='Compartment Other'; }
								else if($row['AdmCategory'] == 7 && $row['SubCategory'] == 1){ $AdmSubCategory='Fresh After Passing Adeeb/Alam/Fazal'; }
								else if($row['AdmCategory'] == 7 && $row['SubCategory'] == 5){ $AdmSubCategory='Failure After Passing Adeeb/Alam/Fazal'; }
								else if($row['AdmCategory'] == 9 && $row['SubCategory'] == 1){ $AdmSubCategory='Fresh After Passing Shahadat Sanvia/Aama/Khasa'; }
								else if($row['AdmCategory'] == 9 && $row['SubCategory'] == 5){ $AdmSubCategory='Failure After Passing Shahadat Sanvia/Aama/Khasa'; }
								else { $AdmSubCategory=''; }
							?>
							<tr>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['Id'];?></td>
								<td class="center"><?php echo $row['P1RegNo'];?></td>
								<td class="center"><?php echo $row['PRegNo'];?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td class="center"><?php echo $row['FatherName'];?></td>
								<td class="center"><?php echo $Gender;?></td>
								<td class="center"><?php echo $row['GroupName'];?></td>
								<td class="center"><?php echo $row['CombinationName'];?></td>
								<td class="center">
								<?php if($row['IsRegular']==1){?><span class="badge_style b_done">Yes</span><?php }
								else{?><span class="badge_style b_pending">No</span><?php }?>
								</td>
								<td class="center"><?php echo $AdmSubCategory;?></td>
								<td class="center"><?php echo $row['StdInstituteCode'];?></td>
								<td class="center"><?php echo $row['StdInstituteName'];?></td>
								<td class="center">
								<?php if(in_array('170101',$_SESSION['emp_user_rights'])){?>
								<a href="updtpic_student10.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update Pic</span></a>
								<?php }?>
								</td>
								<td class="center">
								<?php if(in_array('170102',$_SESSION['emp_user_rights']))
								{
								if($row['AdmCategory']==4){?>
								<a href="updtgrpcomb_student210.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update Grp/Comb</span></a><?php }
								else if($row['AdmCategory']==7){?>
								<a href="updtgrpcomb_student310.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update Grp/Comb</span></a>
								<?php }	else {?>
								<a href="updtgrpcomb_student110.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update Grp/Comb</span></a><?php }
								}?>
								</td>
								<td class="center">
								<?php if(in_array('170103',$_SESSION['emp_user_rights'])){?>
								<a href="updtmedium_student10.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update Medium</span></a>
								<?php }?>
								</td>
								<td class="center">
								<?php if(in_array('170104',$_SESSION['emp_user_rights'])){?>
								<a href="updtbasicinfo_student10.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update BInfo</span></a>
								<?php }?>
								</td>
								<td class="center">
								<?php if(in_array('170105',$_SESSION['emp_user_rights'])){?>
								<a href="updtpersonalinfo_student10.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update PInfo</span></a>
								<?php }?>
								</td>
								<td class="center">
								<?php if(in_array('170106',$_SESSION['emp_user_rights'])){?>
								<a href="updtcontactinfo_student10.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update ContInfo</span></a>
								<?php }?>
								</td>
								<td class="center">
								<?php if(in_array('170107',$_SESSION['emp_user_rights'])){?>
								<a href="updtcentreinfo_student10.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update CentreInfo</span></a>
								<?php }?>
								</td>
								<td class="center">
								<?php if(in_array('170108',$_SESSION['emp_user_rights'])){?>
								<a href="updtshiftinfo_student10.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update ShiftInfo</span></a>
								<?php }?>
								</td>
								<!--<td class="center">
								<?php if(in_array('170109',$_SESSION['emp_user_rights'])){?>
								<a href="updtchallanfeeinfo_student10.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update Challan/FeeInfo</span></a>
								<?php }?>
								</td>-->
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
							<th>P1 RegNo</th>
							<th>P RegNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Combination</th>
							<th>IsRegular</th>
							<th>Adm Category</th>
							<th>Institute Code</th>
							<th>Institute Name</th>
							<th>Picture</th>
							<th>Group/Combination</th>
							<th>Medium</th>
							<th>Basic Info</th>
							<th>Personal Info</th>
							<th>Contact Info</th>
							<th>Centre Info</th>
							<th>Shift Info</th>
						<!--<th>Challan/Fee Info</th>-->
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