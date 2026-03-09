<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['action'])&&$_REQUEST['action']=='update-status')
	{
		$sql="UPDATE students SET
		InstituteId		=	".$_REQUEST['ToInstituteId']."
		WHERE Id		=	".$_REQUEST['Id']."";
		
		if(mysql_query($sql, $conn1))
		{
			$sql_q1="UPDATE migratestudents09 SET
			IsMigrated		=	1
			WHERE StudentId	=	".$_REQUEST['Id']."";
			$res_q1=mysql_query($sql_q1, $conn1);
			
			$ins="INSERT INTO tbl_pilog SET
			ActivityType			=		'Migration-I',
			ActivityDescription		=		'Migrated from ".$_REQUEST['FromInstituteCode']." to ".$_REQUEST['ToInstituteCode']."',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			StudentId				=		".$_REQUEST['Id'].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn1);
			
			?><script>location.replace('students_migration09.php?message=Data Updated Successfully.');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('students_migration09.php');</script><?php
		}
	}
	
	if(isset($_REQUEST['action'])&&$_REQUEST['action']=='cancel-status')
	{
		$sql="Delete FROM migratestudents09 WHERE StudentId=".$_REQUEST['Id']."";
		
		if(mysql_query($sql, $conn1))
		{
			$ins="INSERT INTO tbl_pilog SET
			ActivityType			=		'DeletionMigReq-I',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			StudentId				=		".$_REQUEST['Id'].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn1);
			
			?><script>location.replace('students_migration09.php?message=Data Updated Successfully.');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('students_migration09.php');</script><?php
		}
	}
	
	if(isset($_REQUEST['action']) && $_REQUEST['action']=='update-record')
	{
		$sql="UPDATE students stds JOIN migratestudents09 mig09 ON stds.Id=mig09.StudentId
		SET stds.InstituteId=mig09.ToInstituteId
		WHERE stds.Id IN (".$_REQUEST['StudentsArray'].")";
		
		if(mysql_query($sql, $conn1))
		{
			$sql_q1="UPDATE migratestudents09 SET
			IsMigrated		=	1
			WHERE StudentId	IN (".$_REQUEST['StudentsArray'].")";
			$res_q1=mysql_query($sql_q1, $conn1);
			
			$ins="INSERT INTO tbl_pilog (ActivityType, ActivityDescription, ActivityRefNo, StudentId, EmployeeId)
				SELECT 'Migration-I', CONCAT('Migrated from ', FromInstituteCode,' to ',ToInstituteCode), '".$_REQUEST['ActivityRefNo']."', Id, ".$_SESSION['emp_id']." FROM vwmigstudents09 WHERE Id IN (".$_REQUEST['StudentsArray'].")";
			$res=mysql_query($ins, $conn1);
			
			?><script>location.replace('students_migration09.php?message=Data Updated Successfully.');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('students_migration09.php');</script><?php
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
						<h6>Students (SSC Part-I)</h6>
					</div>

					<div class="widget_content">
						
						<form method="get">
						<table class="search">
						<tr><td colspan="5" style="color:#FF0000; font-size:14px; font-weight:bold;">Search Students</td></tr>
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
							<td><strong>AppNo:</strong></td>
							<td><input name="StudentId" id="StdudentId" type="text" value="<?php echo $_REQUEST['StudentId'];?>" class="large" onkeypress="return isNumber()" maxlength="8" tabindex="2"/></td>
							<td><input type="submit" name="search" id="search" value="Search" tabindex="3"/></td>
						</tr>
						<tr>
							<td><strong>Letter No:</strong></td>
							<td>
								<input name="ActivityRefNo" id="ActivityRefNo" type="text" class="large" maxlength="50" tabindex="4"/>
							</td>
							<td><input type="button" name="update" id="update" value="Update" onclick="update_migstatus('form1');" tabindex="5"/></td>
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
							<th>Student Name</th>
							<th>Father Name</th>
							<th>From Institute</th>
							<th>To Institute</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_REQUEST['search']))
						{
							$SrNo=1; $P=0;
							$sql="SELECT Id, Name, FatherName, Gender, RegistrationNo, FromInstituteId, FromInstituteCode, ToInstituteId, ToInstituteCode, ChallanNo, IsMigrated FROM vwmigstudents09 WHERE MigStudentsId Is Not NULL AND IsMigrated=0";
							
							if(isset($_REQUEST['InstituteId']) && $_REQUEST['InstituteId']!='All')
							{ $sql.=" AND FromInstituteId=".$_REQUEST['InstituteId'].""; }
							
							if(isset($_REQUEST['StudentId']) && $_REQUEST['StudentId']!='')
							{ $sql.=" AND Id=".$_REQUEST['StudentId'].""; }
							
							$sql.=" ORDER BY Id ASC";
							$res=mysql_query($sql, $conn1);
							while($row=mysql_fetch_array($res))
							{?>
							<tr>
								<td class="center"><input type="checkbox" name="Id[]" id="<?php echo ++$P;?>" value="<?php echo $row['Id'].'_'.$row['RegistrationNo'];?>"/></td>
							<!--<td class="center"><?php echo $SrNo;?></td>-->
								<td class="center"><?php echo $row['Id'];?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td class="center"><?php echo $row['FatherName'];?></td>
								<td class="center"><?php echo $row['FromInstituteCode'];?></td>
								<td class="center"><?php echo $row['ToInstituteCode'];?></td>
								<td class="center">
								<!--<a href="javascript:;" onClick="if(confirm('Are you sure you want to Grant Migrate Request?')){update_status('<?php echo $row['Id'];?>','<?php echo $row['FromInstituteId'];?>','<?php echo $row['FromInstituteCode'];?>','<?php echo $row['ToInstituteId'];?>','<?php echo $row['ToInstituteCode'];?>');}"><span class="badge_style b_pending">Migration Request ( <?php echo $row['ChallanNo'];?> )</span></a>-->
								<span class="badge_style b_pending">Migration Request ( <?php echo $row['ChallanNo'];?> )</span>
								<span><a class="action-icons c-Delete" style="vertical-align:bottom;" href="javascript:;" onClick="if(confirm('Are you sure you want to Cancel Request?')){cancel_status('<?php echo $row['Id'];?>');}"></a></span>
								</td>
							</tr>
							<?php
							$SrNo++;
							}//while($row=mysql_fetch_array($res))
						}?>
						</tbody>
						<tfoot>
						<tr>
							<th></th>
						<!--<th>SrNo</th>-->
							<th>AppNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>From Institute</th>
							<th>To Institute</th>
							<th>Action</th>
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

function update_status(Id,FromInstituteId,FromInstituteCode,ToInstituteId,ToInstituteCode)
{
	location.replace('students_migration09.php?Id='+Id+'&FromInstituteId='+FromInstituteId+'&FromInstituteCode='+FromInstituteCode+'&ToInstituteId='+ToInstituteId+'&ToInstituteCode='+ToInstituteCode+'&action=update-status');
}

function cancel_status(Id)
{
	location.replace('students_migration09.php?Id='+Id+'&action=cancel-status');
}

function update_migstatus(form)
{
	var StudentsArray=[]; var StdCount=0; var Counter=0; var Id; var SpArray;
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
				Id=form.elements[i].value;
				SpArray=Id.split('_');
				//alert(SpArray[0]); alert(SpArray[1]);
				if(SpArray[1]!='')
				{ StudentsArray.push(SpArray[0]); StdCount++; }
			}//if(form.elements[i].type === "checkbox" && form.elements[i].checked == true && form.elements[i].value != '')
		}//for(var i = 0; i < form.elements.length; i++)
		
		if(StdCount > 0)
		{
			location.replace('students_migration09.php?StudentsArray='+StudentsArray+'&ActivityRefNo='+ActivityRefNo+'&action=update-record');
		}
		return false;
	}//else
}
</script>