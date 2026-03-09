<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['action']) && $_REQUEST['action']=='update-record')
	{
		// Start transaction
		mysql_query("START TRANSACTION", $conn1);
		
		$StudentsArray=explode(',', $_REQUEST['StudentsArray']);
		
		$sql1="UPDATE regbatchstudents SET
		NOCReceived			=		".$_REQUEST['NNOCRecStatus']."
		WHERE StudentId		IN		(".$_REQUEST['StudentsArray'].")";
		$res1=mysql_query($sql1, $conn1);
		
		$ins="INSERT INTO tbl_pilog (ActivityType, ActivityDescription, ActivityRefNo, StudentId, EmployeeId)
			SELECT 'NOCRecStatusUpdation-I', 'RecStatus Updated To ".$_REQUEST['NNOCRecStatus']."', '".$_REQUEST['ActivityRefNo']."', StudentId, ".$_SESSION['emp_id']." FROM regbatchstudents WHERE StudentId IN (".$_REQUEST['StudentsArray'].")";
		$res3=mysql_query($ins, $conn1);
		
		if ($res1 && $res3) {
			mysql_query("COMMIT", $conn1);
			echo "<script>alert('Request Processed Successfully.'); location.replace('".$_SERVER['PHP_SELF']."');</script>"; exit;
		}
		else {
			mysql_query("ROLLBACK", $conn1);
			echo "<script>alert('Error in Query. Try Again'); location.replace('".$_SERVER['PHP_SELF']."');</script>"; exit;		
		}
	}
	?>

	<div id="content">
		<div class="grid_container">
			<span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Students <?php echo $SessionName;?></h6>
					</div>

					<div class="widget_content">
						
						<form method="post">
						<table class="search">
						<tr><td colspan="7" style="color:#FF0000; font-size:14px; font-weight:bold;">Search Students</td></tr>
						<tr>
							<td><strong>Institute Code:</strong></td>
							<td>
								<select name="InstituteId" id="InstituteId" data-placeholder="Select Institute Code" class="chzn-select admin-select" tabindex="1"/>
								<option value="All">All</option>
								<?php
								$sql_inst="SELECT Id, Code FROM institutes ORDER BY Code ASC";
								$res_inst=mysql_query($sql_inst, $conn1);
								while($row_inst=mysql_fetch_array($res_inst))
								{
									echo '<option value='.$row_inst['Id'].' '.(($_REQUEST['InstituteId']==$row_inst['Id'])?'selected':'').'>'.$row_inst['Code'].'</option>';
								}
								?>
								</select>
							</td>
							<td><strong>NOC RcvStatus:</strong></td>
							<td>
								<select name="ONOCRecStatus" id="ONOCRecStatus" data-placeholder="Select NOCRecStatus" class="chzn-select admin-select" tabindex="2"/>
								<option value="0" <?php echo (($_REQUEST['ONOCRecStatus']==0)?'selected':'')?>>Pending</option>
								<option value="1" <?php echo (($_REQUEST['ONOCRecStatus']==1)?'selected':'')?>>Ok</option>
								<option value="2" <?php echo (($_REQUEST['ONOCRecStatus']==2)?'selected':'')?>>Not Ok</option>
								</select>
							</td>
							<td><input type="submit" name="search" value="Search" tabindex="3"/></td>
						</tr>
						<tr>
							<td><strong>NOC RcvStatus:</strong></td>
							<td>
								<select name="NNOCRecStatus" id="NNOCRecStatus" data-placeholder="Select NOCRecStatus" class="chzn-select admin-select" tabindex="4"/>
								<option value="0">Pending</option>
								<option value="1">Ok</option>
								<option value="2">Not Ok</option>
								</select>
							</td>
							<td><strong>Letter No:</strong></td>
							<td>
								<input name="ActivityRefNo" id="ActivityRefNo" type="text" class="admin-select" maxlength="50" tabindex="5"/>
							</td>
							<td><input type="button" name="update" id="update" value="Update" onclick="update_studentstatus('form1');" tabindex="6"/></td>
						</tr>
						</table>
						</form>
						
						<form name="form1" id="form1" action="" method="post">
						<table class="display data_tbl">
						<thead>
						<tr>
							<th><input type="checkbox" name="checkbox" id="checkbox" value="" onclick="check('form1');"/></th>
							<th>SrNo</th>
							<th>BatchSr</th>
							<th>AppNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Fee</th>
							<th>Institute Code</th>
							<th>Institute Name</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_REQUEST['search']))
						{
							$SrNo=1; $P=0;
							$sql="SELECT Id, Name, FatherName, Gender, AdmissionType, GroupName, BatchNo, RegistrationFee, BatchSr, RegInstituteCode, RegInstituteName FROM vwregstudents WHERE AdmissionType=4 AND NOCReceived=".$_REQUEST['ONOCRecStatus']." AND SessionId=".$SessionId."";
							
							if(isset($_REQUEST['InstituteId']) && $_REQUEST['InstituteId']!='All')
							{ $sql.=" AND RegInstituteId=".$_REQUEST['InstituteId'].""; }
							
							$sql.=" AND BatchId is Not NULL ORDER BY RegInstituteDistrict, RegInstituteCode, BatchNo, BatchSr ASC";
							$res=mysql_query($sql, $conn1);
							while($row=mysql_fetch_array($res))
							{
								if($row['Gender'] == 1){ $Gender='Male'; }
								else if($row['Gender'] == 2){ $Gender='Female'; }
								else { $Gender=''; }
							?>
							<tr>
								<td class="center"><input type="checkbox" name="Id[]" id="<?php echo ++$P;?>" value="<?php echo $row['Id'];?>"/></td>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['BatchNo'].'/'.$row['BatchSr'];?></td>
								<td class="center"><?php echo $row['Id'];?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td class="center"><?php echo $row['FatherName'];?></td>
								<td class="center"><?php echo $Gender;?></td>
								<td class="center"><?php echo $row['GroupName'];?></td>
								<td class="center"><?php echo floatval($row['RegistrationFee']);?></td>
								<td class="center"><?php echo $row['RegInstituteCode'];?></td>
								<td class="center"><?php echo $row['RegInstituteName'];?></td>
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
							<th>BatchSr</th>
							<th>AppNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Fee</th>
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
	var NNOCRecStatus=document.getElementById('NNOCRecStatus').value;
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
			location.replace('nocreceiving_regstudents.php?StudentsArray='+StudentsArray+'&NNOCRecStatus='+NNOCRecStatus+'&ActivityRefNo='+ActivityRefNo+'&action=update-record');
		}
		//parent.location.reload();
		return false;
	}//else
}
</script>