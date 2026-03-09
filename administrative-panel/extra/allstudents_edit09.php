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
							<td><strong>SSC RegNo:</strong></td>
							<td><input name="SSCRegNo" id="SSCRegNo" type="text" value="<?php echo $_REQUEST['SSCRegNo'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="11" tabindex="4"/></td>
							<td><strong>SSC Board:</strong></td>
							<td>
								<select name="SSCBoard" id="SSCBoard" data-placeholder="Select Board" class="chzn-select admin-select" tabindex="5"/>
								<option value="">Select</option>
								<?php
								$sql_boards="SELECT Id, Name FROM boards WHERE Id NOT IN (36)";
								$res_boards=mysql_query($sql_boards, $conn1);
								while($row_boards=mysql_fetch_array($res_boards))
								{ echo '<option value="'.$row_boards['Id'].'" '.(($_REQUEST['SSCBoard']==$row_boards['Id'])?'selected':'').'>'.$row_boards['Name'].'</option>'; }
								?>
								</select>
							</td>
							<td><strong>Student Name:</strong></td>
							<td><input name="Name" id="Name" type="text" value="<?php echo $_REQUEST['Name'];?>" class="admin-select limiter" tabindex="6"/></td>
						</tr>
						<tr>
							<td><strong>CNIC:</strong></td>
							<td><input name="CNIC" id="CNIC" type="text" value="<?php echo $_REQUEST['CNIC'];?>" class="admin-select limiter" maxlength="15" tabindex="7"/></td>
							<td><strong>Institute:</strong></td>
							<td>
								<select name="InstituteId" Id="InstituteId" data-placeholder="Select Institute" class="chzn-select admin-select" tabindex="8"/>
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
							<td><strong>Adm BatchNo:</strong></td>
							<td>
								<select name="AdmBatchId" id="AdmBatchId" data-placeholder="Select BatchNo" class="chzn-select admin-select" tabindex="9"/>
								<option value="">Select</option>
								<?php
								$sql_batch="SELECT Id, BatchNo FROM vwadmbatches09 WHERE BatchStatus!=5 AND ExamId=".$ExamId." ORDER BY BatchNo ASC";
								$res_batch=mysql_query($sql_batch, $conn1);
								while($row_batch=mysql_fetch_array($res_batch))
								{
									echo '<option value='.$row_batch['Id'].' '.(($_REQUEST['AdmBatchId']==$row_batch['Id'])?'selected':'').'>'.$row_batch['BatchNo'].'</option>';
								}
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td><strong>Adm BatchSr:</strong></td>
							<td>
								<input name="AdmBatchSr" id="AdmBatchSr" type="text" value="<?php echo $_REQUEST['AdmBatchSr'];?>" class="admin-select" maxlength="10" tabindex="10"/>
							</td>
							<td><strong>RollNo New:</strong></td>
							<td>
								<input name="RollNo" id="RollNo" type="text" value="<?php echo $_REQUEST['RollNo'];?>" class="admin-select" onkeypress="return isNumber()" maxlength="6" tabindex="11"/>
							</td>
							<td><strong>RegNo(<?php echo $SessionName;?>):</strong></td>
							<td><input name="RegistrationNo" id="RegistrationNo" type="text" value="<?php echo $_REQUEST['RegistrationNo'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="11" tabindex="12"/></td>
						</tr>
						<tr>
							<td colspan="6"><input type="submit" name="search" id="search" value="Search" tabindex="13"/></td>
						</tr>
						</table>
						</form>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>AppNo</th>
						<!--<th>SSC RegNo</th>-->
							<th>RegNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Combination</th>
							<th>IsRegular</th>
							<th>Adm Category</th>
							<th>Institute Code</th>
							<th>Institute Name</th>
							<th>Migration</th>
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
							$sql="SELECT Id, SSCRegNo, SSCBoard, Dated, Name, FatherName, DOB, PicURL, Gender, IsSpecial, IsRegular, AdmissionType, IsRegistered, InstituteId, CombinationName, GroupName, BatchNo, BatchSr, RegistrationNo, StdInstituteCode, StdInstituteName FROM vwadmstudents09 WHERE SessionId=".$SessionId."";
							
							//filter for Date
							if(isset($_REQUEST['Date1']) && $_REQUEST['Date1']!='' && isset($_REQUEST['Date2']) && $_REQUEST['Date2']!='')
							{ $sql.=" AND Dated BETWEEN '".date('Y-m-d 00:00:00:000',strtotime($_REQUEST['Date1']))."' AND '".date('Y-m-d 23:59:59:999',strtotime($_REQUEST['Date2']))."'"; }
							
							//filter for StdudentId
							if(isset($_REQUEST['StdudentId']) && $_REQUEST['StdudentId']!='')
							{ $sql.=" AND Id=".$_REQUEST['StdudentId'].""; }
							
							//filter for SSCRegNo
							if(isset($_REQUEST['SSCRegNo']) && $_REQUEST['SSCRegNo']!='')
							{ $sql.=" AND SSCRegNo='".$_REQUEST['SSCRegNo']."'"; }
							
							//filter for SSCBoard
							if(isset($_REQUEST['SSCBoard']) && $_REQUEST['SSCBoard']!='')
							{ $sql.=" AND SSCBoard=".$_REQUEST['SSCBoard'].""; }
							
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
							
							//filter for RegistrationNo
							if(isset($_REQUEST['RegistrationNo']) && $_REQUEST['RegistrationNo']!='')
							{ $sql.=" AND RegistrationNo='".$_REQUEST['RegistrationNo']."'"; }
							
							$sql.=" ORDER BY Id ASC";
							$res=mysql_query($sql, $conn1);
							while($row=mysql_fetch_array($res))
							{
								if($row['Gender'] == 1){ $Gender='Male'; }
								else if($row['Gender'] == 2){ $Gender='Female'; }
								else { $Gender=''; }
								
								if($row['AdmissionType'] == 1){ $AdmCategory='Fresh AJK'; }
								else if($row['AdmissionType'] == 3){ $AdmCategory='ReAdm. AJK'; }
								else if($row['AdmissionType'] == 4){ $AdmCategory='ReAdm. Other'; }
								else { $AdmCategory=''; }
							?>
							<tr>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['Id'];?></td>
							<!--<td class="center"><?php echo $row['SSCRegNo'];?></td>-->
								<td class="center"><?php echo $row['RegistrationNo'];?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td class="center"><?php echo $row['FatherName'];?></td>
								<td class="center"><?php echo $Gender;?></td>
								<td class="center"><?php echo $row['GroupName'];?></td>
								<td class="center"><?php echo $row['CombinationName'];?></td>
								<td class="center">
								<?php if($row['IsRegular']==1){?><span class="badge_style b_done">Yes</span><?php }
								else{?><span class="badge_style b_pending">No</span><?php }?>
								</td>
								<td class="center"><?php echo $AdmCategory;?></td>
								<td class="center"><?php echo $row['StdInstituteCode'];?></td>
								<td class="center"><?php echo $row['StdInstituteName'];?></td>
								<td class="center">
								<?php if(in_array('130101',$_SESSION['emp_user_rights'])){?>
								<?php if($row['IsRegistered']==1 && $row['InstituteId']!=0 && empty($row['BatchNo'])){?><a href="migrate_student09.php?Id=<?php echo $row['Id'];?>&InstituteId=<?php echo $row['InstituteId'];?>" target="_blank"><span class="badge_style b_high">Migrate</span></a><?php }?>
								<?php }?>
								</td>
								<td class="center">
								<?php if(in_array('130102',$_SESSION['emp_user_rights'])){?>
								<a href="updtpic_student09.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update Pic</span></a>
								<?php }?>
								</td>
								<td class="center">
								<?php if(in_array('130103',$_SESSION['emp_user_rights'])){?>
								<a href="updtgrpcomb_student09.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update Grp/Comb</span></a>
								<?php }?>
								</td>
								<td class="center">
								<?php if(in_array('130104',$_SESSION['emp_user_rights'])){?>
								<a href="updtmedium_student09.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update Medium</span></a>
								<?php }?>
								</td>
								<td class="center">
								<?php if(in_array('130105',$_SESSION['emp_user_rights'])){?>
								<a href="updtbasicinfo_student09.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update BInfo</span></a>
								<?php }?>
								</td>
								<td class="center">
								<?php if(in_array('130106',$_SESSION['emp_user_rights'])){?>
								<a href="updtpersonalinfo_student09.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update PInfo</span></a>
								<?php }?>
								</td>
								<td class="center">
								<?php if(in_array('130107',$_SESSION['emp_user_rights'])){?>
								<a href="updtcontactinfo_student09.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update ContInfo</span></a>
								<?php }?>
								</td>
								<td class="center">
								<?php if(in_array('130108',$_SESSION['emp_user_rights'])){?>
								<a href="updtcentreinfo_student09.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update CentreInfo</span></a>
								<?php }?>
								</td>
								<td class="center">
								<?php if(in_array('130109',$_SESSION['emp_user_rights'])){?>
								<a href="updtshiftinfo_student09.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update ShiftInfo</span></a>
								<?php }?>
								</td>
								<!--<td class="center">
								<?php if(in_array('130110',$_SESSION['emp_user_rights'])){?>
								<a href="updtchallanfeeinfo_student09.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update Challan/FeeInfo</span></a>
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
						<!--<th>SSC RegNo</th>-->
							<th>RegNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Combination</th>
							<th>IsRegular</th>
							<th>Adm Category</th>
							<th>Institute Code</th>
							<th>Institute Name</th>
							<th>Migration</th>
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