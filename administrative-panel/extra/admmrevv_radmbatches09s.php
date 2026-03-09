<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['action']) && $_REQUEST['action']=='update-record')
	{
		$BatchesArray=explode(',', $_REQUEST['BatchesArray']);
		
		if($_REQUEST['NBatchStatus'] == 1){ $BatchStatus=6; }
		else { $BatchStatus=1; }
		
		for($i=0; $i < sizeof($BatchesArray); $i++)
		{
			/*?><script>alert('<?php echo $BatchesArray[$i];?>');</script><?php*/
			$sql1="UPDATE admbatches09s SET
			AdmStatus			=		".$_REQUEST['NBatchStatus'].",
			RevStatus			=		".$_REQUEST['NBatchStatus'].",
			BatchStatus			=		".$BatchStatus."
			WHERE Id			=		".$BatchesArray[$i]."";
			$res1=mysql_query($sql1, $conn1);
			
			$sql2="UPDATE admbatchstudents09s SET
			AdmStatus			=		".$_REQUEST['NBatchStatus'].",
			RevStatus			=		".$_REQUEST['NBatchStatus']."
			WHERE BatchId		=		".$BatchesArray[$i]."";
			$res2=mysql_query($sql2, $conn1);
			
			$ins="INSERT INTO tbl_pislog 
						(ActivityType, ActivityDescription, ActivityRefNo, StudentId, EmployeeId)
				SELECT 'AdmRevStatusUpdation-I', 'AdmRevStatus Updated To ".$_REQUEST['NBatchStatus']."', '".$_REQUEST['ActivityRefNo']."', StudentId, ".$_SESSION['emp_id']." 
				FROM admbatchstudents09s WHERE BatchId=".$BatchesArray[$i]."";
			$res=mysql_query($ins, $conn1);
		}//for($i=0; $i < sizeof($BatchesArray); $i++)
		
		?><script>alert('Batch Updated Successfully.');location.replace('admmrevv_radmbatches09s.php');</script><?php
	}
	?>

	<div id="content">
		<div class="grid_container">
			<span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Batches <?php echo $ExamName;?></h6>
					</div>

					<div class="widget_content">
						
						<form method="post">
						<table class="search">
						<tr><td colspan="5" style="color:#FF0000; font-size:14px; font-weight:bold;">Search Batches</td></tr>
						<tr>
							<td><strong>Centre Code:</strong></td>
							<td>
								<select name="CentreId" id="CentreId" data-placeholder="Select Centre" class="chzn-select admin-select" tabindex="1"/>
								<option value="All">All</option>
								<?php
								$sql_centres="SELECT Id, Name, Code FROM centres WHERE IsActive=1 ORDER BY Code ASC";
								$res_centres=mysql_query($sql_centres, $conn1);
								while($row_centres=mysql_fetch_array($res_centres))
								{
									echo '<option value='.$row_centres['Id'].' '.(($_REQUEST['CentreId']==$row_centres['Id'])?'selected':'').'>'.$row_centres['Code'].'</option>';
								}
								?>
								</select>
							</td>
							<td><strong>Institute Code:</strong></td>
							<td>
								<select name="InstituteId" id="InstituteId" data-placeholder="Select Institute Code" class="chzn-select admin-select" tabindex="2"/>
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
							<td><strong>Adm/Rev Status:</strong></td>
							<td>
								<select name="OBatchStatus" id="OBatchStatus" data-placeholder="Select Batch Status" class="chzn-select admin-select" tabindex="3"/>
								<option value="0" <?php echo (($_REQUEST['OBatchStatus']==0)?'selected':'')?>>Pending</option>
								<option value="1" <?php echo (($_REQUEST['OBatchStatus']==1)?'selected':'')?>>Ok</option>
								<option value="2" <?php echo (($_REQUEST['OBatchStatus']==2)?'selected':'')?>>Not Ok</option>
								</select>
							</td>
							<td><input type="submit" name="search" id="search" value="Search" tabindex="4"/></td>
						</tr>
						<tr>
							<td><strong>Adm/Rev Status:</strong></td>
							<td>
								<select name="NBatchStatus" id="NBatchStatus" data-placeholder="Select Batch Status" class="chzn-select admin-select" tabindex="5"/>
								<option value="0" <?php echo (($_REQUEST['NBatchStatus']==0)?'selected':'')?>>Pending</option>
								<option value="1" <?php echo (($_REQUEST['NBatchStatus']==1)?'selected':'')?>>Ok</option>
								<option value="2" <?php echo (($_REQUEST['NBatchStatus']==2)?'selected':'')?>>Not Ok</option>
								</select>
							</td>
							<td><strong>Letter No:</strong></td>
							<td>
								<input name="ActivityRefNo" id="ActivityRefNo" type="text" class="large" maxlength="50" tabindex="6"/>
							</td>
							<td><input type="button" name="update" id="update" value="Update" onclick="update_batchstatus('form1');" tabindex="7"/></td>
						</tr>
						</table>
						</form>
						
						<form name="form1" id="form1" action="" method="post">
						<table class="display data_tbl">
						<thead>
						<tr>
							<th><input type="checkbox" name="checkbox" id="checkbox" value="" onclick="check('form1');" /></th>
							<th>SrNo</th>
							<th>Dated</th>
							<th>BatchNo</th>
							<th>StdCount</th>
							<th>ChallanNo</th>
							<th>BatchFee</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_REQUEST['search']))
						{
							$SrNo=1; $P=0; $StdCountSum=0; $BatchFeeSum=0;
							$sql="SELECT Id, Dated, BatchNo, BatchStatus, StdCount, BatchFee, ChallanNo FROM vwadmbatches09s WHERE BatchStatus IN (1, 6) AND BatchType=1 AND AdmStatus=".$_REQUEST['OBatchStatus']." AND RevStatus=".$_REQUEST['OBatchStatus']." AND ExamId=".$ExamId."";
							
							if(isset($_REQUEST['CentreId']) && $_REQUEST['CentreId']!='All')
							{ $sql.=" AND PCentreId =".$_REQUEST['CentreId'].""; }
							
							if(isset($_REQUEST['InstituteId']) && $_REQUEST['InstituteId']!='All')
							{ $sql.=" AND InstituteId=".$_REQUEST['InstituteId'].""; }
							
							$sql.=" ORDER BY InstituteCode, BatchNo ASC";
							$res=mysql_query($sql, $conn1);
							while($row=mysql_fetch_array($res))
							{?>
							<tr>
								<td class="center"><input type="checkbox" name="Id[]" id="<?php echo ++$P;?>" value="<?php echo $row['Id'];?>"/></td>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo date('d-m-Y', strtotime($row['Dated']));?></td>
								<td class="center"><?php echo $row['BatchNo'];?></td>
								<td class="center"><?php echo $row['StdCount'];?></td>
								<td class="center"><?php echo $row['ChallanNo'];?></td>
								<td class="center"><?php echo floatval($row['BatchFee']);?></td>
							</tr>
							<?php
							$SrNo++; $StdCountSum+=$row['StdCount']; $BatchFeeSum+=$row['BatchFee'];
							}//while($row=mysql_fetch_array($res))
						}//if(isset($_REQUEST['search']))
						?>
						</tbody>
						<tfoot>
						<tr>
							<th></th>
							<th>SrNo</th>
							<th>Dated</th>
							<th>BatchNo</th>
							<th>StdCount</th>
							<th>ChallanNo</th>
							<th>BatchFee</th>
						</tr>
						</tfoot>
						</table>
						</form>
						
						<div style="float: right; font-size: 16px; width: auto; color:#FF0000;">Total Students:&nbsp;<?php echo $StdCountSum;?>&nbsp;Total Fee:&nbsp;<?php echo $BatchFeeSum;?></div>
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

function update_batchstatus(form)
{
	var BatchesArray=[]; var BatchCount=0; var Counter=0;
	var OBatchStatus=document.getElementById('OBatchStatus').value;
	var NBatchStatus=document.getElementById('NBatchStatus').value;
	var ActivityRefNo=document.getElementById('ActivityRefNo').value;
	form = document.getElementById(form);
	
	for(var i = 0; i < form.elements.length; i++)
	{
		if(form.elements[i].type === "checkbox" && form.elements[i].checked == true && form.elements[i].value != '')
		{ Counter++; }
	}
	if(Counter == 0)
	{ alert('Please select batches then click "Update" button'); return false; }
	else
	{
		if(OBatchStatus != NBatchStatus)
		{
			for(var i = 0; i < form.elements.length; i++)
			{
				if(form.elements[i].type === "checkbox" && form.elements[i].checked == true && form.elements[i].value != '')
				{
					var Id=form.elements[i].value;
					BatchesArray.push(Id); BatchCount++;
				}//if(form.elements[i].type === "checkbox" && form.elements[i].checked == true && form.elements[i].value != '')
			}//for(var i = 0; i < form.elements.length; i++)
			
			if(BatchCount > 0)
			{
				location.replace('admmrevv_radmbatches09s.php?BatchesArray='+BatchesArray+'&NBatchStatus='+NBatchStatus+'&ActivityRefNo='+ActivityRefNo+'&action=update-record');
			}
			return false;
		}//if(OBatchStatus != NBatchStatus)
		else
		{
			alert('Choose Other Status'); return false;
		}
	}//else
}
</script>