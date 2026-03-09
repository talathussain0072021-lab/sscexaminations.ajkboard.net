<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<div id="content">
		<div class="grid_container">
			<span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Batch <?php echo $_REQUEST['BatchNo'];?> Details</h6>
					</div>

					<div class="widget_content">
                		    							
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>Sr.No.</th>
							<th>App. No.</th>
							<th>SSC Year</th>
							<th>SSC Roll No.</th>
							<th>SSC Session</th>
							<th>SSC Board</th>
							<th>Dated</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>							
							<th>Admission Type</th>
							<th>Fee</th>
							<th>Picture</th>					
						</tr>
						</thead>
						<tbody>
                        <?php
						$SrNo=1;
						$sql="SELECT Id, SSCYear, SSCRollNo, SSCSession, SSCBoard, HSSCRegNo, HSSCBoard, Dated, Name, FatherName, PicURL, CNIC, Gender, GroupName, AdmissionType, Sub4Name, Sub5Name, Sub6Name, Sub7Name, RegistrationFee FROM vwregstudents WHERE RegInstituteId=".$_REQUEST['InstituteId']." AND SessionId=".$SessionId." AND BatchId=".$_REQUEST['BatchId']." ORDER BY Id ASC";
						$res=mysql_query($sql, $conn1);
						while($row=mysql_fetch_array($res))
						{	
							if($row['SSCSession'] == 1){ $SSCSession='Annual'; }
							else if($row['SSCSession'] == 2){ $SSCSession='Supply'; }
							else { $SSCSession=''; }
							
							if($row['SSCBoard'] == 0){ $SSCBoard=''; }
							else if($row['SSCBoard'] == 1){ $SSCBoard='AJK'; }
							else { $SSCBoard='Other'; }
								
							if($row['Gender'] == 1){ $Gender='Male'; }
							else if($row['Gender'] == 2){ $Gender='Female'; }
							else { $Gender=''; }
				
							if($row['AdmissionType'] == 1){ $AdmissionType='Fresh (Ajk)'; }
							else if($row['AdmissionType'] == 2){ $AdmissionType='Fresh (Other)'; }
							else if($row['AdmissionType'] == 3){ $AdmissionType='Cond. (AJK)'; }
							else if($row['AdmissionType'] == 4){ $AdmissionType='Cond. (Other)'; }
							else if($row['AdmissionType'] == 5){ $AdmissionType='ReAdm. (AJK)'; }
							else if($row['AdmissionType'] == 6){ $AdmissionType='ReAdm. (Other)'; }		
						?>
							<tr>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['Id'];?></td>
								<td class="center"><?php echo $row['SSCYear'];?></td>
								<td class="center"><?php echo $row['SSCRollNo'];?></td>
								<td class="center"><?php echo $SSCSession;?></td>
								<td class="center"><?php echo $SSCBoard;?></td>
								<td class="center"><?php echo date('d-m-Y', strtotime($row['Dated']));?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td align="center"><?php echo $row['FatherName'];?></td>
								<td class="center"><?php echo $Gender;?></td>
								<td class="center"><?php echo $row['GroupName'];?></td>
								<td class="center"><?php echo $AdmissionType;?></td>
								<td class="center"><?php echo floatval($row['RegistrationFee']);?></td>
								<td class="center"><img id="output" style="height:80px; width:80px;" src="<?php echo '../institution-panel/'.$row['PicURL']; ?>"/></td>
							</tr>
						<?php
						$SrNo++;
						}			
						?>						
						</tbody>
						<tfoot>
						<tr>
							<th>Sr.No.</th>
							<th>App. No.</th>
							<th>SSC Year</th>
							<th>SSC Roll No.</th>
							<th>SSC Session</th>
							<th>SSC Board</th>
							<th>Dated</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>							
							<th>Admission Type</th>
							<th>Fee</th>
							<th>Picture</th>
						</tr>
						</tfoot>
						</table>
					</div>
				</div>
			</div>
			<span class="clear"></span>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php include('includes/footer.php');?>