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
			$sql_q="UPDATE admbatchstudents11 SET
			ExamShift			=		".$_REQUEST['ShiftTo']."
			WHERE StudentId		=		".$StudentsArray[$i]."";
			$res_q=mysql_query($sql_q, $conn1);
			
			$ins="INSERT INTO emploghistory SET
			ActivityType			=		'ShiftUpdation-I',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			ActivityDescription		=		'Shift Updated To ".$_REQUEST['ShiftTo']."',
			StudentId				=		".$StudentsArray[$i].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn1);
		}
		
		?><script>alert('Exam Shift Updated Successfully.');location.replace('updtshift_subjwise11.php');</script><?php
	}
	?>	

	<div id="content">
		<div class="grid_container">
			<span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Change Shift(Subject Wise)</h6>
					</div>

					<div class="widget_content">
							
                        <table class="search">
						<form method="get">
						<tr>	
                            <td><strong>AdmCategory:</strong></td>
                            <td>
								<select name="AdmCategory" data-placeholder="Select AdmCategory" class="chzn-select admin-select" tabindex="1"/>
								<option value="All">All</option>
								<option value="1" <?php echo (($_REQUEST['AdmCategory']==1)?'selected':'')?>>Fresh AJK</option>
								<option value="2" <?php echo (($_REQUEST['AdmCategory']==2)?'selected':'')?>>Fresh Other</option>
								<option value="3" <?php echo (($_REQUEST['AdmCategory']==3)?'selected':'')?>>Cond. AJK</option>
								<option value="4" <?php echo (($_REQUEST['AdmCategory']==4)?'selected':'')?>>Cond. Other</option>
								<option value="5" <?php echo (($_REQUEST['AdmCategory']==5)?'selected':'')?>>ReAdm. AJK</option>
								<option value="6" <?php echo (($_REQUEST['AdmCategory']==6)?'selected':'')?>>ReAdm. Other</option>
								</select>
							</td>
							<td><strong>From Centre:</strong></td>
                            <td>
								<select name="CentreFromId" id="CentreFromId" data-placeholder="Select" class="chzn-select admin-select" tabindex="2"/>
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
								<option value="3" <?php echo (($_REQUEST['Gender']==3)?'selected':'')?>>Male</option>
								<option value="4" <?php echo (($_REQUEST['Gender']==4)?'selected':'')?>>Female</option>
								</select>
							</td>                                				
						</tr>
						<tr>	
                            <td><strong>From Shift:</strong></td>
                            <td>
								<select name="ShiftFrom" id="ShiftFrom" data-placeholder="Select Shift" class="chzn-select admin-select" tabindex="4"/>
								<option value="1" <?php echo (($_REQUEST['ShiftFrom']==1)?'selected':'')?>>1st Shift</option>
								<option value="2" <?php echo (($_REQUEST['ShiftFrom']==2)?'selected':'')?>>2nd Shift</option>
								</select>
							</td>
							<td><strong>IsRegular Status:</strong></td>
                            <td>
								<select name="IsRegular" id="IsRegular" data-placeholder="Select IsRegular Status" class="chzn-select admin-select" tabindex="5"/>
								<option value="All">All</option>
								<option value="1" <?php echo (($_REQUEST['IsRegular']=='1')?'selected':'')?>>Yes</option>
								<option value="0" <?php echo (($_REQUEST['IsRegular']=='0')?'selected':'')?>>No</option>
								</select>
							</td>
                            <td><strong>Group:</strong></td>
                            <td>
								<select name="GroupId" id="GroupId" data-placeholder="Select" class="chzn-select admin-select" tabindex="6"/>									
								<option value="All">All</option>
								<?php
								$sql_subjgroups="SELECT Id, Name, Code FROM subjectgroups WHERE Id NOT IN (6,7) ORDER BY Code ASC";
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
								<select name="SubjectId" id="SubjectId" data-placeholder="Select" class="chzn-select admin-select" tabindex="7"/>									
								<option value="All">All</option>
								<?php
								$sql_subjects="SELECT Id, Name, Code FROM subjects WHERE Class=11 AND IsGeneral=1 ORDER BY Code ASC";
								$res_subjects=mysql_query($sql_subjects, $conn1);
								while($row_subjects=mysql_fetch_array($res_subjects))
								{
									echo '<option value='.$row_subjects['Id'].' '.(($_REQUEST['SubjectId']==$row_subjects['Id'])?'selected':'').'>'.$row_subjects['Code'].' '.$row_subjects['Name'].'</option>';
								}
								?>
								</select>
							</td>
							<td><strong>Limit:</strong></td>
                            <td>
								<input name="ShiftLimit" id="ShiftLimit" type="text" value="<?php echo $_REQUEST['ShiftLimit'];?>" class="large" onkeypress="return isNumber()" maxlength="3" tabindex="8"/>
							</td>
							<td colspan="2"><input type="submit" name="search" value="Search" tabindex="9"/></td>														
						</tr>
						</form>
						<form method="get">
						<tr>	
                            <td><strong>To Shift:</strong></td>
                            <td>
								<select name="ShiftTo" id="ShiftTo" data-placeholder="Select Shift" class="chzn-select admin-select" tabindex="10"/>
								<option value="1" <?php echo (($_REQUEST['ShiftTo']==1)?'selected':'')?>>1st Shift</option>
								<option value="2" <?php echo (($_REQUEST['ShiftTo']==2)?'selected':'')?>>2nd Shift</option>
								</select>
							</td>
                            <td><strong>Letter No:</strong></td>
                            <td>
								<input name="ActivityRefNo" id="ActivityRefNo" type="text" class="large" maxlength="12" tabindex="11"/>
							</td>					
						</tr>
						<tr>
							<td colspan="6"><input type="button" name="update" value="Update" onclick="update_shift('form1');" tabindex="12"/></td>
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
							$sql="SELECT Id, Name, FatherName, Gender, IsRegular, AdmissionType, GroupName, CombinationName, BatchNo, BatchSr, ACentreName, ACentreCode, ExamShift, RegistrationNo, InstituteCode, InstituteName FROM vwadmstudents11 WHERE ACentreId=".$_REQUEST['CentreFromId']." AND ExamShift=".$_REQUEST['ShiftFrom']." AND StdAdmStatus=1 AND SessionId=".$SessionId."";
							
							if(isset($_REQUEST['AdmCategory']) && $_REQUEST['AdmCategory']!='All')
							{ $sql.=" AND AdmissionType=".$_REQUEST['AdmCategory'].""; }
							
							if(isset($_REQUEST['Gender']) && $_REQUEST['Gender']!='All')
							{ $sql.=" AND Gender=".$_REQUEST['Gender'].""; }
							
							if(isset($_REQUEST['IsRegular']) && $_REQUEST['IsRegular']!='All')
							{ $sql.=" AND IsRegular=".$_REQUEST['IsRegular'].""; }
							
							if(isset($_REQUEST['GroupId']) && $_REQUEST['GroupId']!='All')
							{ $sql.=" AND GroupId=".$_REQUEST['GroupId'].""; }
							
							if(isset($_REQUEST['SubjectId']) && $_REQUEST['SubjectId']!='All')
							{ $sql.=" AND (Subject1Id=".$_REQUEST['SubjectId']." OR Subject2Id=".$_REQUEST['SubjectId']." OR Subject3Id=".$_REQUEST['SubjectId']." OR Subject4Id=".$_REQUEST['SubjectId']." OR Subject5Id=".$_REQUEST['SubjectId']." OR Subject6Id=".$_REQUEST['SubjectId']." OR Subject7Id=".$_REQUEST['SubjectId'].")"; }
						
							$sql.=" AND BatchId is Not NULL ORDER BY Id ASC";
							
							if(isset($_REQUEST['ShiftLimit']) && $_REQUEST['ShiftLimit']!='')
							{ $sql.=" limit ".$_REQUEST['ShiftLimit'].""; }
								
							$res=mysql_query($sql, $conn1);
							while($row=mysql_fetch_array($res))
							{
								if($row['Gender'] == 3){ $Gender='Male'; }
								else if($row['Gender'] == 4){ $Gender='Female'; }
								else { $Gender=''; }							
							?>
							<tr>
								<td class="center"><input type="checkbox" name="Id[]" id="<?php echo ++$P;?>" value="<?php echo $row['Id'];?>"/></td>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['Id'];?></td>
								<td class="center"><?php echo $row['RegistrationNo'];?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td align="center"><?php echo $row['FatherName'];?></td>
								<td class="center"><?php echo $Gender;?></td>
								<td class="center"><?php echo $row['GroupName'];?></td>
								<td class="center"><?php echo $row['CombinationName'];?></td>
								<td class="center">
								<?php if($row['IsRegular']==1){?><span class="badge_style b_done">Yes</span><?php } else{ ?><span class="badge_style b_pending">No</span><?php }?>
								</td>
								<td class="center"><?php echo $row['AdmissionType'];?></td>
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
			location.replace('updtshift_subjwise11.php?StudentsArray='+StudentsArray+'&ShiftTo='+ShiftTo+'&ActivityRefNo='+ActivityRefNo+'&action=update-record');
		}	
		return false;		
	}//if(ShiftFrom != ShiftTo)
	else
	{
		alert('Choose Other Shift'); return false;
	}	
}
</script>