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
						<h6>Search Student</h6>
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
								<option value="1" <?php echo (($_REQUEST['P1Session']==1)?'selected':'');?>>1st Annual</option>
								<option value="2" <?php echo (($_REQUEST['P1Session']==2)?'selected':'');?>>2nd Annual</option>
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
								<option value="1" <?php echo (($_REQUEST['PSession']==1)?'selected':'');?>>1st Annual</option>
								<option value="2" <?php echo (($_REQUEST['PSession']==2)?'selected':'');?>>2nd Annual</option>
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
							<th>P1 Year</th>
							<th>P1 RollNo</th>
							<th>P1 Session</th>
							<th>P1 RegNo</th>
							<th>P1 Board</th>
							<th>P Year</th>
							<th>P RollNo</th>
							<th>P Session</th>
							<th>P RegNo</th>
							<th>P Board</th>
							<th>Dated</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Category</th>
							<th>Group</th>
							<th>Combination</th>
							<th>IsRegular</th>
							<th>Adm Category</th>
							<th>Institute Code</th>
							<th>Institute Name</th>
							<th>BatchNo</th>
							<th>BatchSr</th>
							<th>Picture</th>
							<th>Action</th>
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

								if($row['P1Session'] == 1 || $row['PSession'] == 1){ $P1Session='1st Annual'; }
								else if($row['P1Session'] == 2 || $row['PSession'] == 2){ $P1Session='2nd Annual'; }
								else { $P1Session=''; }
								
								$sql_p1boards="SELECT Name FROM boards WHERE Id=".$row['P1Board']."";
								$res_p1boards=mysql_query($sql_p1boards, $conn1);
								$row_p1boards=mysql_fetch_array($res_p1boards);
								$P1Board=$row_p1boards['Name'];
								
								if($row['PSession'] == 1){ $PSession='1st Annual'; }
								else if($row['PSession'] == 2){ $PSession='2nd Annual'; }
								else { $PSession=''; }
								
								$sql_pboards="SELECT Name FROM boards WHERE Id=".$row['PBoard']."";
								$res_pboards=mysql_query($sql_pboards, $conn1);
								$row_pboards=mysql_fetch_array($res_pboards);
								$PBoard=$row_pboards['Name'];
								
								if($row['Gender'] == 1){ $Gender='Male'; }
								else if($row['Gender'] == 2){ $Gender='Female'; }
								else { $Gender=''; }
								
								if($row['IsSpecial'] == 1){ $IsSpecial='Board Employee'."'".' Child'; }
								else if($row['IsSpecial'] == 2){ $IsSpecial='Refugee '."'".' Child'; }
								else if($row['IsSpecial'] == 3){ $IsSpecial='Normal Case'; }
								else if($row['IsSpecial'] == 4){ $IsSpecial='Special Student'; }
								else if($row['IsSpecial'] == 5){ $IsSpecial='Orphan Student'; }
								
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
								<td class="center"><?php echo $row['P1Year'];?></td>
								<td class="center"><?php echo $row['P1RollNo'];?></td>
								<td class="center"><?php echo $P1Session;?></td>
								<td class="center"><?php echo $row['P1RegNo'];?></td>
								<td class="center"><?php echo $P1Board;?></td>
								<td class="center"><?php echo $row['PYear'];?></td>
								<td class="center"><?php echo $row['PRollNo'];?></td>
								<td class="center"><?php echo $PSession;?></td>
								<td class="center"><?php echo $row['PRegNo'];?></td>
								<td class="center"><?php echo $PBoard;?></td>
								<td class="center"><?php echo date('d-m-Y', strtotime($row['Dated']));?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td class="center"><?php echo $row['FatherName'];?></td>
								<td class="center"><?php echo $Gender;?></td>
								<td class="center"><?php echo $IsSpecial;?></td>
								<td class="center"><?php echo $row['GroupName'];?></td>
								<td class="center"><?php echo $row['CombinationName'];?></td>
								<td class="center">
								<?php if($row['IsRegular']==1){?><span class="badge_style b_done">Yes</span><?php }
								else{?><span class="badge_style b_pending">No</span><?php }?>
								</td>
								<td class="center"><?php echo $AdmSubCategory;?></td>
								<td class="center"><?php echo $row['StdInstituteCode'];?></td>
								<td class="center"><?php echo $row['StdInstituteName'];?></td>
								<td class="center"><?php echo $row['BatchNo'];?></td>
								<td class="center"><?php echo $row['BatchSr'];?></td>
								<td class="center"><img id="output" style="height:80px; width:80px;" src="<?php echo '../institution-panel/'.$row['PicURL']."?".rand(00000,999999);?>"/></td>
								<td class="center"><span><a class="action-icons c-approve" href="allstudents_view10.php?Id=<?php echo $row['Id'];?>" title="View">View</a></span></td>
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
							<th>P Year</th>
							<th>P RollNo</th>
							<th>P Session</th>
							<th>P RegNo</th>
							<th>P Board</th>
							<th>Dated</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Category</th>
							<th>Group</th>
							<th>Combination</th>
							<th>IsRegular</th>
							<th>Adm Category</th>
							<th>Institute Code</th>
							<th>Institute Name</th>
							<th>BatchNo</th>
							<th>BatchSr</th>
							<th>Picture</th>
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