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
						<h6>SSC(Part-I) Records</h6>
					</div>

					<div class="widget_content">
						
						<form method="post">
						<table class="search">
						<tr>
							<td><strong>Application No:</strong></td>
							<td><input name="StdudentId" id="StdudentId" type="text" value="<?php echo $_REQUEST['StdudentId'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="8" tabindex="1"/></td>
							<td><strong>P1Year:</strong></td>
							<td><input name="P1Year" id="P1Year" type="text" value="<?php echo $_REQUEST['P1Year'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="2" tabindex="2"/></td>
							<td><strong>P1RollNo:</strong></td>
							<td><input name="P1RollNo" id="P1RollNo" type="text" value="<?php echo $_REQUEST['P1RollNo'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="6" tabindex="3"/></td>
						<tr>
						<tr>
							<td><strong>P1Session:</strong></td>
							<td>
								<select name="P1Session" id="P1Session" data-placeholder="Select Session" class="chzn-select admin-select" tabindex="4"/>
								<option value="">Select</option>
								<option value="1" <?php echo (($_REQUEST['P1Session']==1)?'selected':'');?>>1st Annual</option>
								<option value="2" <?php echo (($_REQUEST['P1Session']==2)?'selected':'');?>>2nd Annual</option>
								</select>
							</td>
							<td><strong>P1RegNo:</strong></td>
							<td><input name="P1RegNo" id="P1RegNo" type="text" value="<?php echo $_REQUEST['P1RegNo'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="11" tabindex="5"/></td>
							<td><strong>Student Name:</strong></td>
                           	<td><input name="Name" id="Name" type="text" value="<?php echo $_REQUEST['Name'];?>" class="admin-select limiter" tabindex="6"/></td>
						</tr>
						<tr>
							<td><strong>Institute Code:</strong></td>
							<td>
								<select name="OInstituteId" Id="OInstituteId" data-placeholder="Select Institute" class="chzn-select admin-select" tabindex="7"/>
								<option value="">Select</option>
								<?php
								$sql_inst="SELECT Id, Code FROM institutes ORDER BY Code ASC";
								$res_inst=mysqli_query($conn2, $sql_inst);
								while($row_inst=mysqli_fetch_array($res_inst))
								{
									echo '<option value='.$row_inst['Id'].' '.(($_REQUEST['OInstituteId']==$row_inst['Id'])?'selected':'').'>'.$row_inst['Code'].'</option>';
								}
								?>
								</select>
							</td>
							<td colspan="4"><input type="submit" name="search" id="search" value="Search" tabindex="8"/></td>
						</tr>
						</table>
						</form>
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>AppNo</th>
							<th>P1Year</th>
							<th>P1RollNo</th>
							<th>P1Session</th>
							<th>P1RegNo</th>
							<th>P1Result</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>CNIC</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Combination</th>
							<th>IsRegular</th>
							<th>Admission Type</th>
							<th>Reg Session</th>
							<th>Institute Code</th>
							<th>Institute Name</th>
							<th>IsEntered</th>
							<th>IsIntact</th>
							<th>IsReAdmitted</th>
							<th>Remarks</th>
							<th>Migration</th>
							<th>Updation</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_REQUEST['search']))
						{
							$SrNo=1; $P=0;
							$sql="SELECT vw.Id, vw.Name, vw.FatherName, vw.CNIC, vw.Gender, vw.Domicile, vw.IsRegular, vw.AdmissionType, vw.IsEntered, vw.IsIntact, vw.IsReAdmitted, vw.InstituteId, vw.SessionId, vw.GroupName, vw.CombinationName, vw.RegistrationNo, vw.YEAR, vw.ROLLNO, vw.SESSION, vw.STATUS, vw.RESULT, vw.REMARKS, inst.Code, inst.Name as InstName, sess.Name as SessionName FROM matric_results.vwstudentspi vw LEFT JOIN matric_examination.sessions sess ON vw.SessionId=sess.Id LEFT JOIN matric_examination.institutes inst ON vw.InstituteId=inst.Id WHERE vw.RegistrationNo!=0";
							
							//filter for StdudentId
							if(isset($_REQUEST['StdudentId']) && $_REQUEST['StdudentId']!='')
							{ $sql.=" AND vw.Id=".$_REQUEST['StdudentId'].""; }
							
							//filter for P1Year
							if(isset($_REQUEST['P1Year']) && $_REQUEST['P1Year']!='')
							{ $sql.=" AND vw.YEAR=".$_REQUEST['P1Year'].""; }
							
							//filter for P1RollNo
							if(isset($_REQUEST['P1RollNo']) && $_REQUEST['P1RollNo']!='')
							{ $sql.=" AND vw.ROLLNO=".$_REQUEST['P1RollNo'].""; }
							
							//filter for P1Session
							if(isset($_REQUEST['P1Session']) && $_REQUEST['P1Session']!='')
							{ $sql.=" AND vw.SESSION=".$_REQUEST['P1Session'].""; }
							
							//filter for P1RegNo
							if(isset($_REQUEST['P1RegNo']) && $_REQUEST['P1RegNo']!='')
							{ $sql.=" AND vw.RegistrationNo='".$_REQUEST['P1RegNo']."'"; }
							
							//filter for Name
							if(isset($_REQUEST['Name']) && $_REQUEST['Name']!='')
							{ $sql.=" AND vw.Name LIKE '".$_REQUEST['Name']."%'"; }
							
							//filter for InstituteId
							if(isset($_REQUEST['OInstituteId']) && $_REQUEST['OInstituteId']!='')
							{ $sql.=" AND vw.InstituteId=".$_REQUEST['OInstituteId'].""; }
							
							$sql.=" ORDER BY vw.Id ASC";
							$res=mysqli_query($conn2, $sql);
							while($row=mysqli_fetch_array($res))
							{
								if($row['SESSION'] == 1){ $P1Session='1st Annual'; }
								else if($row['SESSION'] == 2){ $P1Session='2nd Annual'; }
								else { $P1Session=''; }
								
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
								<td class="center"><?php echo $row['YEAR'];?></td>
								<td class="center"><?php echo $row['ROLLNO'];?></td>
								<td class="center"><?php echo $P1Session;?></td>
								<td class="center"><?php echo $row['RegistrationNo'];?></td>
								<td class="center"><?php echo $row['RESULT'];?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td class="center"><?php echo $row['FatherName'];?></td>
								<td class="center"><?php echo $row['CNIC'];?></td>
								<td class="center"><?php echo $Gender;?></td>
								<td class="center"><?php echo $row['GroupName'];?></td>
								<td class="center"><?php echo $row['CombinationName'];?></td>
								<td class="center">
								<?php if($row['IsRegular']==1){?><span class="badge_style b_done">Yes</span></a>
								<?php } else{?><span class="badge_style b_pending">No</span></a><?php }?>
								</td>
								<td class="center"><?php echo $AdmCategory;?></td>
								<td class="center"><?php echo $row['SessionName'];?></td>
								<?php if($row['STATUS']==1 || $row['STATUS']==NULL){?>
								<td class="center"><?php echo $row['Code'];?></td>
								<td class="center"><?php echo $row['InstName'];?></td>
								<?php } else {?>
								<td class="center"></td>
								<td class="center"></td>
								<?php }?>
								<td class="center">
								<?php if($row['IsEntered']==1){?><span class="badge_style b_done">Yes</span>
								<?php } else{?><span class="badge_style b_pending">No</span><?php }?>
								</td>
								<td class="center">
								<?php if($row['IsIntact']==1){?><span class="badge_style b_done">Yes</span></a>
								<?php } else{?><span class="badge_style b_pending">No</span></a><?php }?>
								</td>
								<td class="center">
								<?php if($row['IsReAdmitted']==1){?><span class="badge_style b_done">Yes</span>
								<?php } else{?><span class="badge_style b_pending">No</span><?php }?>
								</td>
								<td class="center"><?php echo $row['REMARKS'];?></td>
								<td class="center">
								<?php if($row['IsEntered']==0 && $row['IsReAdmitted']==0 && $row['InstituteId']!=0 && ($row['STATUS']==1 || $row['STATUS']==NULL)){?><a href="migrate_student10.php?Id=<?php echo $row['Id'];?>&InstituteId=<?php echo $row['InstituteId'];?>" target="_blank"><span class="badge_style b_high">Migrate</span></a><?php }?>
								</td>
								<td class="center">
									<a href="infoupdate_student09.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update</span></a>
								</td>
								<td class="center">
								<span><a class="action-icons c-edit" href="sscrecords09_edit.php?Id=<?php echo $row['Id'];?>" title="Edit Result" target="_blank">Edit</a></span>
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
							<th>P1Year</th>
							<th>P1RollNo</th>
							<th>P1Session</th>
							<th>P1RegNo</th>
							<th>P1Result</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>CNIC</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Combination</th>
							<th>IsRegular</th>
							<th>Admission Type</th>
							<th>Reg Session</th>
							<th>Institute Code</th>
							<th>Institute Name</th>
							<th>IsEntered</th>
							<th>IsIntact</th>
							<th>IsReAdmitted</th>
							<th>Remarks</th>
							<th>Migration</th>
							<th>Updation</th>
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