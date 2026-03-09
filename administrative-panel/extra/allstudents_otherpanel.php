<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	$sql1="SELECT Id FROM vwregstudents WHERE InstituteId=0 AND SessionId=".$SessionId."";
	$res1=mysql_query($sql1, $conn1);
	$num_rows1=mysql_num_rows($res1);
	
	if(isset($_REQUEST['action']) && $_REQUEST['action']=='update-record')
	{
		$StudentsArray=explode(',', $_REQUEST['StudentsArray']);
		/*
		for($i=0; $i < sizeof($StudentsArray); $i++)
		{
			$sql_q="UPDATE students SET
			pic_validate		=		'".$_REQUEST['pic_value']."'
			WHERE std_id		=		'".$StudentsArray[$i]."'";
			$res_q=mysql_query($sql_q, $conn1);
		}
		*/
		?><script>alert('Pictures Status Updated Successfully.');location.replace('allstudents_otherpanel.php');</script><?php
	}
	?>

	<div id="content">
		<div class="grid_container">
			<span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>All Students <?php echo $SessionName;?></h6>
					</div>

					<div class="widget_content">
						
						<table class="search">
						<tr><td colspan="6" style="color:#FF0000; font-size:14px; font-weight:bold;">Total Students: <?php echo $num_rows1;?></td></tr>
						<form method="post">
						<tr>
							<td><strong>SSC Board:</strong></td>
							<td>
								<select name="SSCBoard" id="SSCBoard" data-placeholder="Select SSC Board" class="chzn-select admin-select" tabindex="1"/>
								<option value="All">All</option>
								<option value="1" <?php echo (($_REQUEST['SSCBoard']==1)?'selected':'')?>>AJK Board</option>
								<option value="2" <?php echo (($_REQUEST['SSCBoard']==2)?'selected':'')?>>Other Board</option>
								</select>
							</td>
							<td><strong>Admission Type:</strong></td>
							<td>
								<select name="AdmissionType" id="AdmissionType" data-placeholder="Select Admission Type" class="chzn-select admin-select" tabindex="2"/>
								<option value="All">All</option>
								<option value="1" <?php echo (($_REQUEST['AdmissionType']==1)?'selected':'')?>>Fresh (AJK)</option>
								<option value="3" <?php echo (($_REQUEST['AdmissionType']==3)?'selected':'')?>>ReAdm. (AJK)</option>
								<option value="4" <?php echo (($_REQUEST['AdmissionType']==4)?'selected':'')?>>ReAdm. (Other)</option>
								</select>
							</td>
							<td colspan="2"></td>
						</tr>
						<tr>
							<td><strong>Date From:</strong></td>
							<td>
								<input name="StartDate" id="StartDate" type="date" value="<?php echo $_REQUEST['StartDate'];?>" tabindex="3"/>
							</td>
							<td><strong>Date To:</strong></td>
							<td>
								<input name="EndDate" id="EndDate" type="date" value="<?php echo $_REQUEST['EndDate'];?>" tabindex="4"/>
							</td>
							<td colspan="2">
								<input type="submit" name="search" id="search" value="Search" tabindex="5"/>
							</td>
						</tr>
						</form>
						<!--
						<form method="get">
						<tr>
							<td><strong>Picture Status:</strong></td>
							<td>
								<select name="pic_value" id="pic_value" data-placeholder="Select" class="chzn-select" style="width:135px;" tabindex="6"/>
								<option value="0">OK</option>
								<option value="1">Not OK</option>
								</select>
							</td>
						</tr>
						<tr><td colspan="4"><br /></td></tr>
						</form>
						-->
						</table>
						
						<form name="form1" id="form1" action="" method="post">
						<table class="display data_tbl">
						<thead>
						<tr>
							<!--<th><input type="checkbox" name="checkbox" id="checkbox" value="" onclick="check('form1');"/></th>-->
							<th>SrNo</th>
							<th>AppNo</th>
							<th>SSC RegNo</th>
							<th>SSC Board</th>
							<th>Dated</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>DOB</th>
							<th>Gender</th>
							<th>Category</th>
							<th>Group</th>
							<th>IsRegular</th>
							<th>Admission Type</th>
							<th>Domicile</th>
							<th>Picture</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_REQUEST['search']))
						{
							$SrNo=1; $P=0;
							$sql="SELECT Id, SSCRegNo, SSCBoard, Dated, Name, FatherName, DOB, PicURL, Gender, IsSpecial, Domicile, IsRegular, AdmissionType, GroupName, InstituteId, InstituteCode, InstituteName FROM vwregstudents WHERE InstituteId=0 AND SessionId=".$SessionId."";
							
							if(isset($_REQUEST['SSCBoard']) && $_REQUEST['SSCBoard']!='All')
							{
								if($_REQUEST['SSCBoard'] == 1){ $sql.=" AND SSCBoard=".$_REQUEST['SSCBoard'].""; }
								else if($_REQUEST['SSCBoard'] == 2){ $sql.=" AND SSCBoard!=0 AND SSCBoard!=1"; }
							}
							
							if(isset($_REQUEST['AdmissionType']) && $_REQUEST['AdmissionType']!='All')
							{
								$sql.=" AND AdmissionType=".$_REQUEST['AdmissionType']."";
							}
							
							if(isset($_REQUEST['StartDate']) && $_REQUEST['StartDate']!='' && isset($_REQUEST['EndDate']) && $_REQUEST['EndDate']!='')
							{ $sql.=" AND Dated >= '".$_REQUEST['StartDate']."' AND Dated <= '".$_REQUEST['EndDate']."'"; }
							
							$sql.=" ORDER BY Id ASC";
							$res=mysql_query($sql, $conn1);
							while($row=mysql_fetch_array($res))
							{
								if($row['SSCBoard'] == 0){ $SSCBoard=''; }
								else if($row['SSCBoard'] == 1){ $SSCBoard='AJK'; }
								else { $SSCBoard='Other'; }
								
								if($row['Gender'] == 1){ $Gender='Male'; }
								else if($row['Gender'] == 2){ $Gender='Female'; }
								else { $Gender=''; }
								
								if($row['IsSpecial'] == 1){ $IsSpecial='Board Employee'."'".' Child'; }
								else if($row['IsSpecial'] == 2){ $IsSpecial='Refugee '."'".' Child'; }
								else if($row['IsSpecial'] == 3){ $IsSpecial='Normal Case'; }
								else if($row['IsSpecial'] == 4){ $IsSpecial='Special Student'; }
								else if($row['IsSpecial'] == 5){ $IsSpecial='Orphan Student'; }
								
								if($row['AdmissionType'] == 1){ $AdmissionType='Fresh (AJK)'; }
								else if($row['AdmissionType'] == 3){ $AdmissionType='ReAdm. (AJK)'; }
								else if($row['AdmissionType'] == 4){ $AdmissionType='ReAdm. (Other)'; }
								
								$sql_districts="SELECT Name FROM districts WHERE Id=".$row['Domicile']." ORDER BY Name ASC";
								$res_districts=mysql_query($sql_districts, $conn1);
								$row_districts=mysql_fetch_array($res_districts);
							?>
							<tr>
								<!--<td class="center"><input type="checkbox" name="Id[]" id="<?php echo ++$P;?>" value="<?php echo $row['Id'];?>"/></td>-->
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['Id'];?></td>
								<td class="center"><?php echo $row['SSCRegNo'];?></td>
								<td class="center"><?php echo $SSCBoard;?></td>
								<td class="center"><?php echo date('d-m-Y', strtotime($row['Dated']));?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td class="center"><?php echo $row['FatherName'];?></td>
								<td class="center"><?php echo date('d-m-Y', strtotime($row['DOB']));?></td>
								<td class="center"><?php echo $Gender;?></td>
								<td class="center"><?php echo $IsSpecial;?></td>
								<td class="center"><?php echo $row['GroupName'];?></td>
								<td class="center">
								<?php if($row['IsRegular'] == 1){?><span class="badge_style b_done">Yes</span></a>
								<?php }	else{?><span class="badge_style b_pending">No</span></a><?php }?>
								</td>
								<td class="center"><?php echo $AdmissionType;?></td>
								<td class="center"><?php echo $row_districts['Name'];?></td>
								<td class="center"><img id="output" style="height:80px; width:80px;" src="<?php echo '../institution-panel/'.$row['PicURL'];?><?php echo "?".rand(00000,999999);?>"/></td>
								<?php
								/* if($row['pic_validate']=='0'){?><span><a class="action-icons c-suspend"></a></span><?php } else if($row['pic_validate']=='1'){?><span><a class="action-icons c-Delete"></a></span><?php } */
								?>
							</tr>
							<?php
							$SrNo++;
							}
						}//if(isset($_REQUEST['search']))
						?>
						</tbody>
						<tfoot>
						<tr>
							<!--<th></th>-->
							<th>SrNo</th>
							<th>AppNo</th>
							<th>SSC RegNo</th>
							<th>SSC Board</th>
							<th>Dated</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>DOB</th>
							<th>Gender</th>
							<th>Category</th>
							<th>Group</th>
							<th>IsRegular</th>
							<th>Admission Type</th>
							<th>Domicile</th>
							<th>Picture</th>
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

function assign_value(form)
{
	var students_array=[]; var count=0;
	var pic_value=document.getElementById('pic_value').value;
	
	form = document.getElementById(form);
	
	for(var i = 0; i < form.elements.length; i++)
	{
		if(form.elements[i].type === "checkbox" && form.elements[i].checked == true && form.elements[i].value != '')
		{
			var std_id=form.elements[i].value;
			students_array.push(std_id); count++;
		}//if(form.elements[i].type === "checkbox" && form.elements[i].checked == true && form.elements[i].value != '')
	}//for(var i = 0; i < form.elements.length; i++)
	
	if(count > 0)
	{
		location.replace('allstudents_otherpanel.php?students_array='+students_array+'&pic_value='+pic_value+'&action=update-record');
	}
	return false;
}
</script>