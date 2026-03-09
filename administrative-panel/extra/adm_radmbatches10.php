<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['action']) && $_REQUEST['action']=='update-record')
	{
		$BatchesArray=explode(',', $_REQUEST['BatchesArray']);
		if($_REQUEST['BatchStatus'] == 1)
		{
			for($i=0; $i < sizeof($BatchesArray); $i++)
			{
				$sql1="SELECT Id, BatchStatus, AdmStatus, RevStatus FROM vwadmbatches10 WHERE Id=".$BatchesArray[$i]."";
				$res1=mysql_query($sql1, $conn1);
				$row1=mysql_fetch_array($res1);
				
				$BatchStatus=$row1['BatchStatus'];
				if($row1['RevStatus'] == 1)
				{ $BatchStatus=6; }//if($row1['RevStatus'] == 1)
				
				$sql2="UPDATE admbatches10 SET
				AdmStatus			=		1,
				BatchStatus			=		".$BatchStatus."
				WHERE Id			=		".$row1['Id']."";
				$res2=mysql_query($sql2, $conn1);
				
				$sql3="UPDATE admbatchstudents10 SET
				AdmStatus			=		1
				WHERE BatchId		=		".$row1['Id']."";
				$res3=mysql_query($sql3, $conn1);
			}//for($i=0; $i < sizeof($BatchesArray); $i++)
		
		?><script>alert('Batch Updated Successfully.');location.replace('adm_radmbatches10.php');</script><?php
		}//if($_REQUEST['BatchStatus'] == 1)
		else if($_REQUEST['BatchStatus'] == 2)
		{
			for($i=0; $i < sizeof($BatchesArray); $i++)
			{
				$sql1="SELECT Id FROM vwadmbatches10 WHERE Id=".$BatchesArray[$i]."";
				$res1=mysql_query($sql1, $conn1);
				$row1=mysql_fetch_array($res1);
				
				$sql2="UPDATE admbatches10 SET
				AdmStatus			=		2,
				BatchStatus			=		1
				WHERE Id			=		".$row1['Id']."";
				$res2=mysql_query($sql2, $conn1);
				
				$sql3="UPDATE admbatchstudents10 SET
				AdmStatus			=		2
				WHERE BatchId		=		".$row1['Id']."";
				$res3=mysql_query($sql3, $conn1);
			
			}//for($i=0; $i < sizeof($BatchesArray); $i++)
		
		?><script>alert('Batch Updated Successfully.');location.replace('adm_radmbatches10.php');</script><?php
		}//else if($_REQUEST['BatchStatus'] == 2)
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
               			
						<div class="invoice_action_bar" style="float: right;">
							<div class="btn_30_blue">
								<a href="adm_radmbatches_add10.php"><span class="icon add_co"></span>
									<span class="btn_link">Add</span>
								</a>
							</div>
                        </div>
						<div class="invoice_action_bar" style="float: left;">
                        	<form method="post">
                            <table class="search">
							<tr><td colspan="3" style="color:#FF0000; font-size:14px; font-weight:bold;">Search Locked Batches</td></tr>
							<tr>
                                <td><strong>Institute Code:</strong></td>
                                <td>
									<select name="InstituteId" id="InstituteId" data-placeholder="Select Institute Code" class="chzn-select admin-select" tabindex="1"/>
									<option value="Select">Select</option>
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
								<td><input type="submit" name="search" id="search" value="Search" tabindex="2"/></td>
							</tr>
							<tr>
                                <td><strong>Batch Status:</strong></td>
                                <td>
									<select name="BatchStatus" id="BatchStatus" data-placeholder="Select Batch Status" class="chzn-select admin-select" tabindex="3"/>
									<option value="1" <?php echo (($_REQUEST['BatchStatus']==1)?'selected':'')?>>Ok</option>
									<option value="2" <?php echo (($_REQUEST['BatchStatus']==2)?'selected':'')?>>Not Ok</option>
									</select>
								</td>
								<td><input type="button" name="update" id="update" value="Update" onclick="update_batchstatus('form1');" tabindex="4"/></td>
							</tr>
							</table>
                            </form>
                        </div>
						
						<form name="form1" id="form1" action="" method="post">
						<table class="display data_tbl">
						<thead>
						<tr>
							<th><input type="checkbox" name="checkbox" id="checkbox" value="" onclick="check('form1');" /></th>
							<th>SrNo</th>
							<th>BatchNo</th>
							<th>StdCount</th>
							<th>AdmStatus</th>
						</tr>
						</thead>
						<tbody>
                        <?php
						if(isset($_REQUEST['search']))
						{
							$SrNo=1; $P=0; $StdCountSum=0;
							$sql="SELECT Id, BatchNo, BatchStatus, AdmStatus, RevStatus, BatchCounter, InstituteId, StdCount, ChallanNo FROM vwadmbatches10 WHERE BatchStatus=1 AND BatchType=1 AND AdmStatus=0 AND ExamId=".$ExamId." AND InstituteId=".$_REQUEST['InstituteId']." ORDER BY Id ASC";
							$res=mysql_query($sql, $conn1);
							while($row=mysql_fetch_array($res))
							{?>
							<tr>
								<td class="center"><input type="checkbox" name="Id[]" id="<?php echo ++$P;?>" value="<?php echo $row['Id'];?>"/></td>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['BatchNo'];?></td>
								<td class="center"><?php echo $row['StdCount'];?></td>
								<td class="center"><span class="badge_style b_pending">Pending</span></td>
							</tr>
							<?php
							$SrNo++; $StdCountSum+=$row['StdCount'];
							}//while($row=mysql_fetch_array($res))
						}//if(isset($_REQUEST['search']))
						/*else
						{
							$SrNo=1; $BatchSum=0;
							$sql="SELECT Id, BatchNo, BatchStatus, RegStatus, RevStatus, BatchCounter, InstituteId, StdCount, ChallanNo FROM vwadmbatches10 WHERE BatchStatus=1 AND BatchType=1 AND AdmStatus=0 AND SessionId=".$SessionId." ORDER BY Id ASC";
							$res=mysql_query($sql, $conn1);
							while($row=mysql_fetch_array($res))
							{?>
							<tr>
								<td class="center"></td>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['BatchNo'];?></td>
								<td class="center"><?php echo $row['StdCount'];?></td>
								<td class="center"><span class="badge_style b_pending">Pending</span></td>
							</tr>
							<?php
							$SrNo++; $BatchSum+=$row['StdCount'];
							}//while($row=mysql_fetch_array($res))
						}//else if(isset($_REQUEST['search']))*/
						?>
						</tbody>
						<tfoot>
						<tr>
							<th></th>
							<th>SrNo</th>
							<th>BatchNo</th>
							<th>StdCount</th>
							<th>AdmStatus</th>
						</tr>
						</tfoot>
						</table>
						</form>
						
						<div style="float: right; font-size: 16px; width: auto; color:#FF0000;">Total Students:&nbsp;<?php echo $StdCountSum;?></div>
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
	form= document.getElementById(form);
	
	if(document.getElementById('checkbox').checked)
	{
		for(var i = 0; i < form.elements.length; i++)
		{	eval("form.elements[" + i + "].checked = true ");	}
	}
	else
	{
		for(var i = 0; i < form.elements.length; i++)
		{	eval("form.elements[" + i + "].checked = false ");	}
	}
}

function update_batchstatus(form)
{
	var BatchesArray=[]; var BatchCount=0; var Counter=0;
	var BatchStatus=document.getElementById('BatchStatus').value;
	form= document.getElementById(form);
	
	for(var i = 0; i < form.elements.length; i++)
	{
		if(form.elements[i].type === "checkbox" && form.elements[i].checked == true && form.elements[i].value != '')
		{ Counter++; }
	}
	
	if(Counter == 0)
	{ alert('Please select batches then click "Update" button'); return false; }
	else
	{
		for(var i = 0; i < form.elements.length; i++)
		{
			if(form.elements[i].type === "checkbox" && form.elements[i].checked == true && form.elements[i].value != '')
			{
				var Id= form.elements[i].value;
				BatchesArray.push(Id); BatchCount++;
			}//if(form.elements[i].type === "checkbox" && form.elements[i].checked == true && form.elements[i].value != '')
		}//for(var i = 0; i < form.elements.length; i++)
		
		if(BatchCount > 0)
		{
			location.replace('adm_radmbatches10.php?BatchesArray='+BatchesArray+'&BatchStatus='+BatchStatus+'&action=update-record');
		}
		//parent.location.reload();
		return false;
	}//else
}
</script>