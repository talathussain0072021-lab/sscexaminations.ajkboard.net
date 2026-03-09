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
			$sql_q="UPDATE admbatchstudents12 SET
			ExamShift			=		".$_REQUEST['ShiftTo']."
			WHERE StudentId		=		".$StudentsArray[$i]."";
			$res_q=mysql_query($sql_q, $conn1);
			
			$ins="INSERT INTO emploghistory SET
			ActivityType			=		'ShiftUpdation-II',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			ActivityDescription		=		'Shift Updated To ".$_REQUEST['ShiftTo']."',
			StudentId				=		".$StudentsArray[$i].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn1);
		}
		
		?><script>alert('Exam Shift Updated Successfully.');location.replace('updtshift_subjwise12.php');</script><?php
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
								<select name="AdmSubCategory" data-placeholder="Select AdmSubCategory" class="chzn-select admin-select" tabindex="1"/>
								<option value="All">All</option>
								<option value="11" <?php echo (($_REQUEST['AdmSubCategory']==11)?'selected':'')?>>Fresh AJK</option>
								<option value="12" <?php echo (($_REQUEST['AdmSubCategory']==12)?'selected':'')?>>Composite AJK</option>
								<option value="13" <?php echo (($_REQUEST['AdmSubCategory']==13)?'selected':'')?>>Fresh Other</option>
								<option value="14" <?php echo (($_REQUEST['AdmSubCategory']==14)?'selected':'')?>>Composite Other</option>
								<option value="21" <?php echo (($_REQUEST['AdmSubCategory']==21)?'selected':'')?>>Improvement AJK</option>
								<option value="31" <?php echo (($_REQUEST['AdmSubCategory']==31)?'selected':'')?>>Additional AJK</option>
								<option value="41" <?php echo (($_REQUEST['AdmSubCategory']==41)?'selected':'')?>>Compartment AJK</option>
								<option value="42" <?php echo (($_REQUEST['AdmSubCategory']==42)?'selected':'')?>>Compartment Other</option>
								<option value="51" <?php echo (($_REQUEST['AdmSubCategory']==51)?'selected':'')?>>Comp.Failure AJK</option>
								<option value="52" <?php echo (($_REQUEST['AdmSubCategory']==52)?'selected':'')?>>Comp.Failure Other</option>
								<option value="61" <?php echo (($_REQUEST['AdmSubCategory']==61)?'selected':'')?>>Fresh After Passing Adeeb/Alam/Fazal</option>
								<option value="62" <?php echo (($_REQUEST['AdmSubCategory']==62)?'selected':'')?>>Failure After Passing Adeeb/Alam/Fazal</option>
								<option value="81" <?php echo (($_REQUEST['AdmSubCategory']==81)?'selected':'')?>>Fresh Shadat-ul-Khasa till 2008</option>
								<option value="82" <?php echo (($_REQUEST['AdmSubCategory']==82)?'selected':'')?>>Fresh Shadat-ul-Khasa after 2008</option>
								<option value="83" <?php echo (($_REQUEST['AdmSubCategory']==83)?'selected':'')?>>Failure Shadat-ul-Khasa till 2008</option>
								<option value="84" <?php echo (($_REQUEST['AdmSubCategory']==84)?'selected':'')?>>Failure Shadat-ul-Khasa after 2008</option>
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
								$sql_subjgroups="SELECT Id, Name, Code FROM subjectgroups WHERE Id NOT IN (7) ORDER BY Code ASC";
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
								<select name="SubjectCode" id="SubjectCode" data-placeholder="Select" class="chzn-select admin-select" tabindex="7"/>									
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
							<th>SSC RegNo</th>
							<th>P1 RegNo</th>
							<th>P RegNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Combination</th>
							<th>IsRegular Status</th>
							<th>Adm Category</th>
							<th>Sub Category</th>
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
							$sql="SELECT Id, SSCRegNo, P1RegNo, PRegNo, Name, FatherName, Gender, IsRegular, AdmCategory, SubCategory, GroupName, CombinationName, BatchNo, BatchSr, ACentreName, ACentreCode, ExamShift, InstituteCode, InstituteName FROM vwadmstudents12 WHERE ACentreId=".$_REQUEST['CentreFromId']." AND ExamShift=".$_REQUEST['ShiftFrom']." AND StdAdmStatus=1 AND ExamId=".$ExamId."";
							
							if(isset($_REQUEST['AdmSubCategory']) && $_REQUEST['AdmSubCategory']!='All')
							{ 
								if($_REQUEST['AdmSubCategory']==11){ $sql.=" AND AdmCategory=1 AND SubCategory=1"; } 
								
								else if($_REQUEST['AdmSubCategory']==12){ $sql.=" AND AdmCategory=1 AND SubCategory=2"; }
								
								else if($_REQUEST['AdmSubCategory']==13){ $sql.=" AND AdmCategory=1 AND SubCategory=3"; }
								
								else if($_REQUEST['AdmSubCategory']==14){ $sql.=" AND AdmCategory=1 AND SubCategory=4"; }
								
								else if($_REQUEST['AdmSubCategory']==21){ $sql.=" AND AdmCategory=2 AND SubCategory=1"; }
								
								else if($_REQUEST['AdmSubCategory']==31){ $sql.=" AND AdmCategory=3 AND SubCategory=1"; }
								
								else if($_REQUEST['AdmSubCategory']==41){ $sql.=" AND AdmCategory=4 AND SubCategory=1"; }
								
								else if($_REQUEST['AdmSubCategory']==42){ $sql.=" AND AdmCategory=4 AND SubCategory=2"; }
								
								else if($_REQUEST['AdmSubCategory']==51){ $sql.=" AND AdmCategory=5 AND SubCategory=1"; }
								
								else if($_REQUEST['AdmSubCategory']==52){ $sql.=" AND AdmCategory=5 AND SubCategory=2"; }
								
								else if($_REQUEST['AdmSubCategory']==61){ $sql.=" AND AdmCategory=6 AND SubCategory=1"; }
								
								else if($_REQUEST['AdmSubCategory']==62){ $sql.=" AND AdmCategory=6 AND SubCategory=2"; }
								
								else if($_REQUEST['AdmSubCategory']==81){ $sql.=" AND AdmCategory=8 AND SubCategory=1"; }
								
								else if($_REQUEST['AdmSubCategory']==82){ $sql.=" AND AdmCategory=8 AND SubCategory=2"; }
								
								else if($_REQUEST['AdmSubCategory']==83){ $sql.=" AND AdmCategory=8 AND SubCategory=3"; }
								
								else if($_REQUEST['AdmSubCategory']==84){ $sql.=" AND AdmCategory=8 AND SubCategory=4"; }
							}
							
							if(isset($_REQUEST['Gender']) && $_REQUEST['Gender']!='All')
							{ $sql.=" AND Gender=".$_REQUEST['Gender'].""; }
							
							if(isset($_REQUEST['IsRegular']) && $_REQUEST['IsRegular']!='All')
							{ $sql.=" AND IsRegular=".$_REQUEST['IsRegular'].""; }	
							
							if(isset($_REQUEST['GroupId']) && $_REQUEST['GroupId']!='All')
							{ $sql.=" AND GroupId=".$_REQUEST['GroupId'].""; }
							
							if(isset($_REQUEST['SubjectCode']) && $_REQUEST['SubjectCode']!='All')
							{ $sql.=" AND (Sub1Code=".$_REQUEST['SubjectCode']." OR Sub2Code=".$_REQUEST['SubjectCode']." OR Sub3Code=".$_REQUEST['SubjectCode']." OR Sub4Code=".$_REQUEST['SubjectCode']." OR Sub5Code=".$_REQUEST['SubjectCode']." OR Sub6Code=".$_REQUEST['SubjectCode']." OR Sub7Code=".$_REQUEST['SubjectCode']." OR Sub8Code=".$_REQUEST['SubjectCode']." OR Sub9Code=".$_REQUEST['SubjectCode']." OR Sub10Code=".$_REQUEST['SubjectCode']." OR Sub11Code=".$_REQUEST['SubjectCode']." OR Sub12Code=".$_REQUEST['SubjectCode']." OR Sub13Code=".$_REQUEST['SubjectCode']." OR Sub14Code=".$_REQUEST['SubjectCode'].")"; }	
						
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
								<td class="center"><?php echo $row['SSCRegNo'];?></td>
								<td class="center"><?php echo $row['P1RegNo'];?></td>
								<td class="center"><?php echo $row['PRegNo'];?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td align="center"><?php echo $row['FatherName'];?></td>
								<td class="center"><?php echo $Gender;?></td>
								<td class="center"><?php echo $row['GroupName'];?></td>
								<td class="center"><?php echo $row['CombinationName'];?></td>
								<td class="center">
								<?php if($row['IsRegular']==1){?><span class="badge_style b_done">Yes</span><?php } else{ ?><span class="badge_style b_pending">No</span><?php }?>
								</td>
								<td class="center"><?php echo $row['AdmCategory'];?></td>
								<td class="center"><?php echo $row['SubCategory'];?></td>
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
							<th>SSC RegNo</th>
							<th>P1 RegNo</th>
							<th>P RegNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Combination</th>
							<th>IsRegular Status</th>
							<th>Adm Category</th>
							<th>Sub Category</th>
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
			location.replace('updtshift_subjwise12.php?StudentsArray='+StudentsArray+'&ShiftTo='+ShiftTo+'&ActivityRefNo='+ActivityRefNo+'&action=update-record');
		}	
		return false;		
	}//if(ShiftFrom != ShiftTo)
	else
	{
		alert('Choose Other Shift'); return false;
	}	
}
</script>