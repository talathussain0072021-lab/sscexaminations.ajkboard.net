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
			AdmStatus			=		".$_REQUEST['NAdmRevStatus'].",
			RevStatus			=		".$_REQUEST['NAdmRevStatus']."
			WHERE StudentId		=		".$StudentsArray[$i]."";
			$res_q=mysql_query($sql_q, $conn1);
			
			$ins="INSERT INTO tbl_pilog SET
			ActivityType			=		'AdmRevStatusUpdation-I',
			ActivityDescription		=		'AdmRevStatus Updated To ".$_REQUEST['NAdmRevStatus']."',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			StudentId				=		".$StudentsArray[$i].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn1);
		}//for($i=0; $i < sizeof($StudentsArray); $i++)
		
		?><script>alert('Students Updated Successfully.');location.replace('admrev_admstudents09.php');</script><?php
	}
	?>

	<div id="content">
		<div class="grid_container">
			<span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Students <?php echo $ExamName;?></h6>
					</div>

					<div class="widget_content">
						
						<form method="post">
						<table class="search">
						<tr><td colspan="7" style="color:#FF0000; font-size:14px; font-weight:bold;">Search Students</td></tr>
						<tr>
							<td><strong>BatchNo:</strong></td>
							<td>
								<select name="BatchId" id="BatchId" data-placeholder="Select BatchNo" class="chzn-select admin-select" tabindex="1"/>
								<option value="All">All</option>
								<?php
								$sql_batch="SELECT Id, BatchNo FROM vwadmbatches09 WHERE BatchStatus IN (1, 6) AND ExamId=".$ExamId." ORDER BY BatchNo ASC";
								$res_batch=mysql_query($sql_batch, $conn1);
								while($row_batch=mysql_fetch_array($res_batch))
								{
									echo '<option value='.$row_batch['Id'].' '.(($_REQUEST['BatchId']==$row_batch['Id'])?'selected':'').'>'.$row_batch['BatchNo'].'</option>';
								}
								?>
								</select>
							</td>
							<td><strong>AppNo:</strong></td>
							<td><input name="StudentId" id="StdudentId" type="text" value="<?php echo $_REQUEST['StudentId'];?>" class="large" onkeypress="return isNumber()" maxlength="8" tabindex="2"/></td>
							<td><strong>Adm/Rev Status:</strong></td>
							<td>
								<select name="OAdmRevStatus" id="OAdmRevStatus" data-placeholder="Select Student Status" class="chzn-select admin-select" tabindex="3"/>
								<option value="0" <?php echo (($_REQUEST['OAdmRevStatus']==0)?'selected':'')?>>Pending</option>
								<option value="1" <?php echo (($_REQUEST['OAdmRevStatus']==1)?'selected':'')?>>Ok</option>
								<option value="2" <?php echo (($_REQUEST['OAdmRevStatus']==2)?'selected':'')?>>Not Ok</option>
								</select>
							</td>
							<td><input type="submit" name="search" id="search" value="Search" tabindex="4"/></td>
						</tr>
						<tr>
							<td><strong>Adm/Rev Status:</strong></td>
							<td>
								<select name="NAdmRevStatus" id="NAdmRevStatus" data-placeholder="Select Student Status" class="chzn-select admin-select" tabindex="5"/>
								<option value="0" <?php echo (($_REQUEST['NAdmRevStatus']==0)?'selected':'')?>>Pending</option>
								<option value="1" <?php echo (($_REQUEST['NAdmRevStatus']==1)?'selected':'')?>>Ok</option>
								<option value="2" <?php echo (($_REQUEST['NAdmRevStatus']==2)?'selected':'')?>>Not Ok</option>
								</select>
							</td>
							<td><strong>Letter No:</strong></td>
							<td>
								<input name="ActivityRefNo" id="ActivityRefNo" type="text" class="large" maxlength="50" tabindex="6"/>
							</td>
							<td colspan="3"><input type="button" name="update" id="update" value="Update" onclick="update_studentstatus('form1');" tabindex="7"/></td>
						</tr>
						</table>
						</form>
						
						<form name="form1" id="form1" action="" method="post">
						<table class="display data_tbl">
						<thead>
						<tr>
							<th><input type="checkbox" name="checkbox" id="checkbox" value="" onclick="check('form1');" /></th>
						<!--<th>SrNo</th>-->
							<th>AppNo</th>
							<th>BatchNo</th>
							<th>BatchSr</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Combination</th>
							<th>Fee</th>
							<th>Exam Centre</th>
							<th>Domicile</th>
							<th>Institute Code</th>
							<th>Institute Name</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_REQUEST['search']))
						{
							$SrNo=1; $P=0;
							$sql="SELECT Id, Name, FatherName, Gender, Domicile, GroupName, CombinationName, BatchNo, BatchSr, AdmissionFee, ACentreCode, InstituteCode, InstituteName FROM vwadmstudents09 WHERE StdAdmStatus=".$_REQUEST['OAdmRevStatus']." AND StdRevStatus=".$_REQUEST['OAdmRevStatus']." AND SessionId=".$SessionId."";
							
							if(isset($_REQUEST['BatchId']) && $_REQUEST['BatchId']!='All')
							{ $sql.=" AND BatchId=".$_REQUEST['BatchId'].""; }
							
							if(isset($_REQUEST['StudentId']) && $_REQUEST['StudentId']!='')
							{ $sql.=" AND Id=".$_REQUEST['StudentId'].""; }
							
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
								<td class="center"><input type="checkbox" name="Id[]" id="<?php echo ++$P;?>" value="<?php echo $row['Id'];?>"/></td>
							<!--<td class="center"><?php echo $SrNo;?></td>-->
								<td class="center"><?php echo $row['Id'];?></td>
								<td class="center"><?php echo $row['BatchNo'];?></td>
								<td class="center"><?php echo $row['BatchSr'];?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td class="center"><?php echo $row['FatherName'];?></td>
								<td class="center"><?php echo $Gender;?></td>
								<td class="center"><?php echo $row['GroupName'];?></td>
								<td class="center"><?php echo $row['CombinationName'];?></td>
								<td class="center"><?php echo floatval($row['AdmissionFee']);?></td>
								<td class="center"><?php echo $row['ACentreCode'];?></td>
								<td class="center"><?php echo $row_districts['Name'];?></td>
								<td class="center"><?php echo $row['InstituteCode'];?></td>
								<td class="center"><?php echo $row['InstituteName'];?></td>
							</tr>
							<?php
							//$SrNo++;
							}//while($row=mysql_fetch_array($res))
						}//if(isset($_REQUEST['search']))
						?>
						</tbody>
						<tfoot>
						<tr>
							<th></th>
						<!--<th>SrNo</th>-->
							<th>AppNo</th>
							<th>BatchNo</th>
							<th>BatchSr</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Combination</th>
							<th>Fee</th>
							<th>Exam Centre</th>
							<th>Domicile</th>
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

function update_studentstatus(form)
{
	var StudentsArray=[]; var StdCount=0; var Counter=0;
	var OAdmRevStatus=document.getElementById('OAdmRevStatus').value;
	var NAdmRevStatus=document.getElementById('NAdmRevStatus').value;
	var ActivityRefNo=document.getElementById('ActivityRefNo').value;
	form = document.getElementById(form);
	
	for(var i = 0; i < form.elements.length; i++)
	{
		if(form.elements[i].type === "checkbox" && form.elements[i].checked == true && form.elements[i].value != '')
		{ Counter++; }
	}
	if(Counter == 0)
	{ alert('Please select students then click "Update" button'); return false; }
	else
	{
		if(OAdmRevStatus != NAdmRevStatus)
		{
			for(var i = 0; i < form.elements.length; i++)
			{
				if(form.elements[i].type === "checkbox" && form.elements[i].checked == true && form.elements[i].value != '')
				{
					var Id=form.elements[i].value;
					StudentsArray.push(Id);	StdCount++;
				}//if(form.elements[i].type === "checkbox" && form.elements[i].checked == true && form.elements[i].value != '')
			}//for(var i = 0; i < form.elements.length; i++)
			
			if(StdCount > 0)
			{
				location.replace('admrev_admstudents09.php?StudentsArray='+StudentsArray+'&NAdmRevStatus='+NAdmRevStatus+'&ActivityRefNo='+ActivityRefNo+'&action=update-record');
			}
			return false;
		}//if(OAdmRevStatus != NAdmRevStatus)
		else
		{
			alert('Choose Other Status'); return false;
		}
	}//else
}
</script>