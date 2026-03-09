<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['action']) && $_REQUEST['action']=='update-record')
	{
		$StudentsArray=explode(',', $_REQUEST['StudentsArray']);
		
		for($i=0; $i < sizeof($StudentsArray); $i++)
		{
			$sql_q="UPDATE admbatchstudents09 SET
			ExamShift			=		".$_REQUEST['ShiftTo']."
			WHERE StudentId		=		".$StudentsArray[$i]."";
			$res_q=mysql_query($sql_q, $conn1);
			
			$ins="INSERT INTO tbl_pilog SET
			ActivityType			=		'ShiftUpdation-I',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			ActivityDescription		=		'Shift Updated To ".$_REQUEST['ShiftTo']."',
			StudentId				=		".$StudentsArray[$i].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn1);
		}

		?><script>alert('Exam Shift Updated Successfully.');location.replace('updtshift_instwise09.php');</script><?php
	}
	?>

	<div id="content">
		<div class="grid_container">
			<span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Change Shift(Institute Wise)</h6>
					</div>

					<div class="widget_content">
						
						<table class="search">
						<form method="post">
						<tr>
							<td><strong>AdmCategory:</strong></td>
							<td>
								<select name="AdmCategory" id="AdmCategory" data-placeholder="Select AdmCategory" class="chzn-select admin-select" tabindex="1"/>
								<option value="All">All</option>
								<option value="1" <?php echo (($_REQUEST['AdmCategory']==1)?'selected':'');?>>Fresh AJK</option>
								<option value="3" <?php echo (($_REQUEST['AdmCategory']==3)?'selected':'');?>>ReAdm. AJK</option>
								<option value="4" <?php echo (($_REQUEST['AdmCategory']==4)?'selected':'');?>>ReAdm. Other</option>
								</select>
							</td>
							<td><strong>Institute Code:</strong></td>
							<td>
								<select name="InstituteId" id="InstituteId" data-placeholder="Select Institute" class="chzn-select admin-select" tabindex="2"/>
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
							<td><strong>From Centre:</strong></td>
							<td>
								<select name="CentreFromId" id="CentreFromId" data-placeholder="Select Centre" class="chzn-select admin-select" tabindex="3"/>
								<option value="All">All</option>
								<?php
								$sql_centres="SELECT Id, Name, Code FROM centres WHERE IsActive=1 ORDER BY Code ASC";
								$res_centres=mysql_query($sql_centres, $conn1);
								while($row_centres=mysql_fetch_array($res_centres))
								{
									echo '<option value='.$row_centres['Id'].' '.(($_REQUEST['CentreFromId']==$row_centres['Id'])?'selected':'').'>'.$row_centres['Code'].' '.ucwords(strtolower($row_centres['Name'])).'</option>';
								}
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td><strong>Gender:</strong></td>
							<td>
								<select name="Gender" id="Gender" data-placeholder="Select Gender" class="chzn-select admin-select" tabindex="4"/>
								<option value="All">All</option>
								<option value="1" <?php echo (($_REQUEST['Gender']==1)?'selected':'');?>>Male</option>
								<option value="2" <?php echo (($_REQUEST['Gender']==2)?'selected':'');?>>Female</option>
								</select>
							</td>
							<td><strong>From Shift:</strong></td>
							<td>
								<select name="ShiftFrom" id="ShiftFrom" data-placeholder="Select Shift" class="chzn-select admin-select" tabindex="5"/>
								<option value="1" <?php echo (($_REQUEST['ShiftFrom']==1)?'selected':'');?>>1st Shift</option>
								<option value="2" <?php echo (($_REQUEST['ShiftFrom']==2)?'selected':'');?>>2nd Shift</option>
								</select>
							</td>
							<td><strong>Group:</strong></td>
							<td>
								<select name="GroupId" id="GroupId" data-placeholder="Select Group" class="chzn-select admin-select" tabindex="6"/>
								<option value="All">All</option>
								<?php
								$sql_subjgroups="SELECT Id, Name, Code FROM subjectgroups WHERE Id NOT IN (3) ORDER BY Code ASC";
								$res_subjgroups=mysql_query($sql_subjgroups, $conn1);
								while($row_subjgroups=mysql_fetch_array($res_subjgroups))
								{
									echo '<option value='.$row_subjgroups['Id'].' '.(($_REQUEST['GroupId']==$row_subjgroups['Id'])?'selected':'').'>'.ucwords(strtolower($row_subjgroups['Name'])).'</option>';
								}
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td><strong>Subject:</strong></td>
							<td>
								<select name="SubjectId" id="SubjectId" data-placeholder="Select Subject" class="chzn-select admin-select" tabindex="7"/>
								<option value="All">All</option>
								<?php
								$sql_subjects="SELECT Id, Name, Code FROM subjects WHERE Class=9 AND IsGeneral=1 ORDER BY Code ASC";
								$res_subjects=mysql_query($sql_subjects, $conn1);
								while($row_subjects=mysql_fetch_array($res_subjects))
								{
									echo '<option value='.$row_subjects['Id'].' '.(($_REQUEST['SubjectId']==$row_subjects['Id'])?'selected':'').'>'.$row_subjects['Code'].' '.$row_subjects['Name'].'</option>';
								}
								?>
								</select>
							</td>
							<td><strong>Medium:</strong></td>
							<td>
								<select name="Medium" id="Medium" data-placeholder="Select Medium" class="chzn-select admin-select" tabindex="8"/>
								<option value="1,2">All</option>
								<option value="1" <?php echo (($_REQUEST['Medium']=='1')?'selected':'');?>>Urdu</option>
								<option value="2" <?php echo (($_REQUEST['Medium']=='2')?'selected':'');?>>English</option>
								</select>
							</td>
							<td><strong>Limit:</strong></td>
							<td>
								<input name="ShiftLimit" id="ShiftLimit" type="text" value="<?php echo $_REQUEST['ShiftLimit'];?>" class="large" onkeypress="return isNumber()" maxlength="3" tabindex="9"/>
							</td>
						</tr>
						<tr>
							<td colspan="6"><input type="submit" name="search" id="search" value="Search" tabindex="10"/></td>
						</tr>
						</form>
						<form method="post">
						<tr>
							<td><strong>To Shift:</strong></td>
							<td>
								<select name="ShiftTo" id="ShiftTo" data-placeholder="Select Shift" class="chzn-select admin-select" tabindex="11"/>
								<option value="1" <?php echo (($_REQUEST['ShiftTo']==1)?'selected':'');?>>1st Shift</option>
								<option value="2" <?php echo (($_REQUEST['ShiftTo']==2)?'selected':'');?>>2nd Shift</option>
								</select>
							</td>
							<td><strong>Letter No:</strong></td>
							<td>
								<input name="ActivityRefNo" id="ActivityRefNo" type="text" class="large" maxlength="50" tabindex="12"/>
							</td>
						</tr>
						<tr>
							<td colspan="6"><input type="button" name="update" id="update" value="Update" onclick="update_shift('form1');" tabindex="13"/></td>
						</tr>
						</form>
						</table>
						
						<form name="form1" id="form1" action="" method="post">
						<table class="display data_tbl">
						<thead>
						<tr>
							<th><input type="checkbox" name="checkbox" id="checkbox" value="" onclick="check('form1');" /></th>
							<th>SrNo</th>
							<th>AppNo</th>
							<th>RegNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Combination</th>
							<th>Adm Category</th>
							<th>BatchNo</th>
							<th>BatchSr</th>
							<th>Centre Code</th>
							<th>Centre Name</th>
							<th>Exam Shift</th>
							<th>Institute Code</th>
							<th>Institute Name</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_REQUEST['search']))
						{
							$SrNo=1; $P=0;
							$sql="SELECT Id, Name, FatherName, Gender, AdmissionType, CombinationName, GroupName, BatchNo, BatchSr, ACentreName, ACentreCode, ExamShift, RegistrationNo, InstituteCode, InstituteName FROM vwadmstudents09 WHERE IsRegular=1 AND StdAdmStatus IN (0,1) AND InstituteId=".$_REQUEST['InstituteId']." AND ExamShift=".$_REQUEST['ShiftFrom']." AND SessionId=".$SessionId."";
							
							if(isset($_REQUEST['AdmCategory']) && $_REQUEST['AdmCategory']!='All')
							{ $sql.=" AND AdmissionType=".$_REQUEST['AdmCategory'].""; }
							
							if(isset($_REQUEST['CentreFromId']) && $_REQUEST['CentreFromId']!='All')
							{ $sql.=" AND ACentreId=".$_REQUEST['CentreFromId'].""; }
							
							if(isset($_REQUEST['Gender']) && $_REQUEST['Gender']!='All')
							{ $sql.=" AND Gender=".$_REQUEST['Gender'].""; }
							
							if(isset($_REQUEST['GroupId']) && $_REQUEST['GroupId']!='All')
							{ $sql.=" AND GroupId=".$_REQUEST['GroupId'].""; }
							
							if(isset($_REQUEST['SubjectId']) && $_REQUEST['SubjectId']!='All')
							{ $sql.=" AND ((Subject1Id=".$_REQUEST['SubjectId'].") OR (Subject2Id=".$_REQUEST['SubjectId'].") OR (Subject3Id=".$_REQUEST['SubjectId']." AND Medium3 IN (".$_REQUEST['Medium'].")) OR (Subject4Id=".$_REQUEST['SubjectId']." AND Medium4 IN (".$_REQUEST['Medium'].")) OR (Subject5Id=".$_REQUEST['SubjectId']." AND Medium5 IN (".$_REQUEST['Medium'].")) OR (Subject6Id=".$_REQUEST['SubjectId']." AND Medium6 IN (".$_REQUEST['Medium'].")) OR (Subject7Id=".$_REQUEST['SubjectId']." AND Medium7 IN (".$_REQUEST['Medium'].")) OR (Subject8Id=".$_REQUEST['SubjectId']." AND Medium8 IN (".$_REQUEST['Medium'].")) OR (Subject9Id=".$_REQUEST['SubjectId']."))"; }
							
							$sql.=" AND BatchId is Not NULL ORDER BY Id ASC";
							
							if(isset($_REQUEST['ShiftLimit']) && $_REQUEST['ShiftLimit']!='')
							{ $sql.=" limit ".$_REQUEST['ShiftLimit'].""; }
							
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
								<td class="center"><input type="checkbox" name="Id[]" id="<?php echo ++$P;?>" value="<?php echo $row['Id'];?>"/></td>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['Id'];?></td>
								<td class="center"><?php echo $row['RegistrationNo'];?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td class="center"><?php echo $row['FatherName'];?></td>
								<td class="center"><?php echo $Gender;?></td>
								<td class="center"><?php echo $row['GroupName'];?></td>
								<td class="center"><?php echo $row['CombinationName'];?></td>
								<td class="center"><?php echo $AdmCategory;?></td>
								<td class="center"><?php echo $row['BatchNo'];?></td>
								<td class="center"><?php echo $row['BatchSr'];?></td>
								<td class="center"><?php echo $row['ACentreCode'];?></td>
								<td class="center"><?php echo $row['ACentreName'];?></td>
								<td class="center"><?php echo $row['ExamShift'];?></td>
								<td class="center"><?php echo $row['InstituteCode'];?></td>
								<td class="center"><?php echo $row['InstituteName'];?></td>
							</tr>
							<?php
							$SrNo++;
							}
						}//if(isset($_REQUEST['search']))
						?>
						</tbody>
						<tfoot>
						<tr>
							<th></th>
							<th>SrNo</th>
							<th>AppNo</th>
							<th>RegNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Combination</th>
							<th>Adm Category</th>
							<th>BatchNo</th>
							<th>BatchSr</th>
							<th>Centre Code</th>
							<th>Centre Name</th>
							<th>Exam Shift</th>
							<th>Institute Code</th>
							<th>Institute Name</th>
						</tr>
						</tfoot>
						</table>
						</form>
					</div>
				</div>
			</div>
			<span class="clear"></span>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php include('includes/footer.php');?>
<script>
function check(form)
{
	form = document.getElementById(form);
	
	if(document.getElementById('checkbox').checked)
	{
		for(var i = 0; i < form.elements.length; i++)
		{ eval("form.elements[" + i + "].checked = true"); }
	}
	else
	{
		for(var i = 0; i < form.elements.length; i++)
		{ eval("form.elements[" + i + "].checked = false"); }
	}
}

function update_shift(form)
{
	var StudentsArray=[]; var Count=0;
	var ShiftFrom=document.getElementById('ShiftFrom').value;
	var ShiftTo=document.getElementById('ShiftTo').value;
	var ActivityRefNo=document.getElementById('ActivityRefNo').value;
	
	if(ShiftFrom != ShiftTo)
	{
		form = document.getElementById(form);
		
		for(var i = 0; i < form.elements.length; i++)
		{
			if(form.elements[i].type === "checkbox" && form.elements[i].checked == true && form.elements[i].value != '')
			{
				var Id=form.elements[i].value;
				StudentsArray.push(Id); Count++;
			}//if(form.elements[i].type === "checkbox" && form.elements[i].checked == true && form.elements[i].value != '')
		}//for(var i = 0; i < form.elements.length; i++)
		
		if(Count > 0)
		{
			location.replace('updtshift_instwise09.php?StudentsArray='+StudentsArray+'&ShiftTo='+ShiftTo+'&ActivityRefNo='+ActivityRefNo+'&action=update-record');
		}
		return false;
	}//if(ShiftFrom != ShiftTo)
	else
	{
		alert('Choose Other Shift'); return false;
	}
}
</script>