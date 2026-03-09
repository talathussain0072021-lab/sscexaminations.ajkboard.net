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
			$sql_q="UPDATE admbatchstudents09s SET
			ACentreId			=		".$_REQUEST['CentreToId']."
			WHERE StudentId		=		".$StudentsArray[$i]."";
			$res_q=mysql_query($sql_q, $conn1);
			
			$ins="INSERT INTO tbl_pislog SET
			ActivityType			=		'CentreUpdation-Is',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			ActivityDescription		=		'Centre Updated To ".$_REQUEST['CentreToId']."',
			StudentId				=		".$StudentsArray[$i].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn1);
		}
		
		?><script>alert('Exam Centre Updated Successfully.');location.replace('updtcent_centwise09s.php');</script><?php
	}
	?>

	<div id="content">
		<div class="grid_container">
			<span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Change Centre(Centre Wise)</h6>
					</div>

					<div class="widget_content">
						
						<table class="search">
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
							<td><strong>From Centre:</strong></td>
							<td>
								<select name="CentreFromId" id="CentreFromId" data-placeholder="Select Centre" class="chzn-select admin-select" tabindex="2"/>
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
							<td><strong>Gender:</strong></td>
							<td>
								<select name="Gender" id="Gender" data-placeholder="Select Gender" class="chzn-select admin-select" tabindex="3"/>
								<option value="All">All</option>
								<option value="1" <?php echo (($_REQUEST['Gender']==1)?'selected':'');?>>Male</option>
								<option value="2" <?php echo (($_REQUEST['Gender']==2)?'selected':'');?>>Female</option>
								</select>
							</td>
						</tr>
						<tr>
							<td><strong>From Shift:</strong></td>
							<td>
								<select name="ShiftFrom" id="ShiftFrom" data-placeholder="Select Shift" class="chzn-select admin-select" tabindex="4"/>
								<option value="All">All</option>
								<option value="1" <?php echo (($_REQUEST['ShiftFrom']==1)?'selected':'');?>>1st Shift</option>
								<option value="2" <?php echo (($_REQUEST['ShiftFrom']==2)?'selected':'');?>>2nd Shift</option>
								</select>
							</td>
							<td><strong>IsRegular Status:</strong></td>
							<td>
								<select name="IsRegular" id="IsRegular" data-placeholder="Select IsRegular Status" class="chzn-select admin-select" tabindex="5"/>
								<option value="All">All</option>
								<option value="1" <?php echo (($_REQUEST['IsRegular']=='1')?'selected':'');?>>Yes</option>
								<option value="0" <?php echo (($_REQUEST['IsRegular']=='0')?'selected':'');?>>No</option>
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
								<select name="SubjectCode" id="SubjectCode" data-placeholder="Select Subject" class="chzn-select admin-select" tabindex="7"/>
								<option value="All">All</option>
								<?php
								$sql_subjects="SELECT Id, Name, Code FROM subjects WHERE IsGeneral=1 ORDER BY Code ASC";
								$res_subjects=mysql_query($sql_subjects, $conn1);
								while($row_subjects=mysql_fetch_array($res_subjects))
								{
									echo '<option value='.$row_subjects['Code'].' '.(($_REQUEST['SubjectCode']==$row_subjects['Code'])?'selected':'').'>'.$row_subjects['Code'].' '.$row_subjects['Name'].'</option>';
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
							<td><strong>To Centre:</strong></td>
							<td>
								<select name="CentreToId" id="CentreToId" data-placeholder="Select Centre" class="chzn-select admin-select" tabindex="11"/>
								<?php
								$sql_centres="SELECT Id, Name, Code FROM centres WHERE IsActive=1 ORDER BY Code ASC";
								$res_centres=mysql_query($sql_centres, $conn1);
								while($row_centres=mysql_fetch_array($res_centres))
								{
									echo '<option value='.$row_centres['Id'].' '.(($_REQUEST['CentreToId']==$row_centres['Id'])?'selected':'').'>'.$row_centres['Code'].' '.ucwords(strtolower($row_centres['Name'])).'</option>';
								}
								?>
								</select>
							</td>
							<td><strong>Letter No:</strong></td>
							<td>
								<input name="ActivityRefNo" id="ActivityRefNo" type="text" class="large" maxlength="50" tabindex="12"/>
							</td>
						</tr>
						<tr>
							<td colspan="6"><input type="button" name="update" id="update" value="Update" onclick="update_centre('form1');" tabindex="13"/></td>
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
							<th>P1 RegNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Combination</th>
							<th>IsRegular Status</th>
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
							$sql="SELECT Id, P1RegNo, Name, FatherName, Gender, IsRegular, AdmCategory, SubCategory, CombinationName, GroupName, BatchNo, BatchSr, ACentreName, ACentreCode, ExamShift, InstituteCode, InstituteName FROM vwadmstudents09s WHERE StdAdmStatus IN (0,1) AND ACentreId=".$_REQUEST['CentreFromId']." AND ExamId=".$ExamId."";
							
							if(isset($_REQUEST['AdmSubCategory']) && $_REQUEST['AdmSubCategory']!='All')
							{
								if($_REQUEST['AdmSubCategory']==11){ $sql.=" AND AdmCategory=1 AND SubCategory=1"; }
								
								else if($_REQUEST['AdmSubCategory']==13){ $sql.=" AND AdmCategory=1 AND SubCategory=3"; }
							}
							
							if(isset($_REQUEST['Gender']) && $_REQUEST['Gender']!='All')
							{ $sql.=" AND Gender=".$_REQUEST['Gender'].""; }
							
							if(isset($_REQUEST['ShiftFrom']) && $_REQUEST['ShiftFrom']!='All')
							{ $sql.=" AND ExamShift=".$_REQUEST['ShiftFrom'].""; }
							
							if(isset($_REQUEST['IsRegular']) && $_REQUEST['IsRegular']!='All')
							{ $sql.=" AND IsRegular=".$_REQUEST['IsRegular'].""; }
							
							if(isset($_REQUEST['GroupId']) && $_REQUEST['GroupId']!='All')
							{ $sql.=" AND GroupId=".$_REQUEST['GroupId'].""; }
							
							if(isset($_REQUEST['SubjectCode']) && $_REQUEST['SubjectCode']!='All')
							{ $sql.=" AND ((Sub1Code=".$_REQUEST['SubjectCode'].") OR (Sub2Code=".$_REQUEST['SubjectCode'].") OR (Sub3Code=".$_REQUEST['SubjectCode']." AND Medium3 IN (".$_REQUEST['Medium'].")) OR (Sub4Code=".$_REQUEST['SubjectCode']." AND Medium4 IN (".$_REQUEST['Medium'].")) OR (Sub5Code=".$_REQUEST['SubjectCode']." AND Medium5 IN (".$_REQUEST['Medium'].")) OR (Sub6Code=".$_REQUEST['SubjectCode']." AND Medium6 IN (".$_REQUEST['Medium'].")) OR (Sub7Code=".$_REQUEST['SubjectCode']." AND Medium7 IN (".$_REQUEST['Medium'].")) OR (Sub8Code=".$_REQUEST['SubjectCode']." AND Medium8 IN (".$_REQUEST['Medium'].")) OR (Sub9Code=".$_REQUEST['SubjectCode']."))"; }
							
							$sql.=" AND BatchId is Not NULL ORDER BY Id ASC";
							
							if(isset($_REQUEST['ShiftLimit']) && $_REQUEST['ShiftLimit']!='')
							{ $sql.=" limit ".$_REQUEST['ShiftLimit'].""; }
							
							$res=mysql_query($sql, $conn1);
							while($row=mysql_fetch_array($res))
							{
								if($row['Gender'] == 1){ $Gender='Male'; }
								else if($row['Gender'] == 2){ $Gender='Female'; }
								else { $Gender=''; }
								
								if($row['AdmCategory'] == 1 && $row['SubCategory'] == 1){ $AdmSubCategory='Fresh AJK'; }
								else if($row['AdmCategory'] == 1 && $row['SubCategory'] == 3){ $AdmSubCategory='Fresh Other'; }
								else { $AdmSubCategory=''; }
							?>
							<tr>
								<td class="center"><input type="checkbox" name="Id[]" id="<?php echo ++$P;?>" value="<?php echo $row['Id'];?>"/></td>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['Id'];?></td>
								<td class="center"><?php echo $row['P1RegNo'];?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td class="center"><?php echo $row['FatherName'];?></td>
								<td class="center"><?php echo $Gender;?></td>
								<td class="center"><?php echo $row['GroupName'];?></td>
								<td class="center"><?php echo $row['CombinationName'];?></td>
								<td class="center">
								<?php if($row['IsRegular']==1){?><span class="badge_style b_done">Yes</span><?php } else{?><span class="badge_style b_pending">No</span><?php }?>
								</td>
								<td class="center"><?php echo $AdmSubCategory;?></td>
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
							<th>P1 RegNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Combination</th>
							<th>IsRegular Status</th>
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

function update_centre(form)
{
	var StudentsArray=[]; var Count=0;
	var CentreFromId=document.getElementById('CentreFromId').value;
	var CentreToId=document.getElementById('CentreToId').value;
	var ActivityRefNo=document.getElementById('ActivityRefNo').value;
	
	if(CentreFromId != CentreToId)
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
			location.replace('updtcent_centwise09s.php?StudentsArray='+StudentsArray+'&CentreToId='+CentreToId+'&ActivityRefNo='+ActivityRefNo+'&action=update-record');
		}
		return false;
	}//if(CentreFromId != CentreToId)
	else
	{
		alert('Choose Other Centre'); return false;
	}
}
</script>