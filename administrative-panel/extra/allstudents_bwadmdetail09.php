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
						<h6><?php echo $_REQUEST['BatchNo'];?> Batch Detail <?php echo $SessionName;?></h6>
					</div>

					<div class="widget_content">
                		
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>Sr.No.</th>
							<th>App. No.</th>
							<th>SSC Exam Year</th>
							<th>SSC Roll No.</th>
							<th>SSC Session</th>
							<th>SSC Board</th>
							<th>Dated</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Domicile</th>
							<th>Group</th>
							<th>Batch Sr.</th>
							<th>Fee</th>
							<th>Challan No.</th>
							<th>Exam Centre</th>						
						</tr>
						</thead>
						<tbody>
                        <?php
						$srno=1;
						$sql="SELECT * FROM hssc_registration WHERE adm_batchno='".$_REQUEST['adm_batchno']."' AND adm_status='1' AND reg_session='".$session_code."' ORDER BY adm_srno ASC";
						$res=mysql_query($sql, $conn1);
						while($row=mysql_fetch_array($res))
						{	
							if($row['ssc_session']=='1'){ $ssc_session='Annual'; } else if($row['ssc_session']=='2'){ $ssc_session='Supply'; } else { $ssc_session=''; }
							if($row['std_gender']=='1'){ $gender='Male'; } else if($row['std_gender']=='2'){ $gender='Female'; }
							if($row['ssc_board']=='1'){ $ssc_board='AJK Board'; } else if($row['ssc_board']=='0'){ $ssc_board=''; } else { $ssc_board='Other Board'; }
							if($row['std_admission_type']=='3'){ $admission_type='Readmission(AJK)'; } else if($row['std_admission_type']=='5'){ $admission_type='Readmission(Other)'; } 
							else if($row['std_admission_type']=='4'){ $admission_type='Conditional'; } else { $admission_type='Fresh'; } 
								
							if($row['std_district']=='1'){ $std_district='MUZAFFARABAD'; }
							else if($row['std_district']=='2'){ $std_district='MIRPUR'; }
							else if($row['std_district']=='3'){ $std_district='BHIMBER'; }
							else if($row['std_district']=='4'){ $std_district='KOTLI'; }
							else if($row['std_district']=='5'){ $std_district='BAGH'; }
							else if($row['std_district']=='6'){ $std_district='POONCH'; }
							else if($row['std_district']=='7'){ $std_district='SUDHNOTI'; }
							else if($row['std_district']=='9'){ $std_district='NEELUM'; }
							else if($row['std_district']=='10'){ $std_district='HATTIAN BALA'; }
							else if($row['std_district']=='11'){ $std_district='HAVALI'; }
							else { $std_district=''; }	
								
							$sql_centers="SELECT cent_name FROM centers WHERE cent_id='".$row['aexam_center']."'";
							$res_centers=mysql_query($sql_centers, $conn1);
							$row_centers=mysql_fetch_array($res_centers);
						?>
						<tr>
							<td class="center"><?php echo $srno;?></td>
							<td class="center"><?php echo $row['std_id'];?></td>
							<td class="center"><?php echo $row['ssc_examyear'];?></td>
							<td class="center"><?php echo $row['ssc_rollno'];?></td>
							<td class="center"><?php echo $ssc_session;?></td>
							<td class="center"><?php echo $ssc_board;?></td>
							<td class="center"><?php echo date('d-m-Y', strtotime($row['std_dated']));?></td>
							<td class="center"><?php echo $row['std_name'];?></td>
							<td align="center"><?php echo $row['std_father_name'];?></td>
							<td class="center"><?php echo $gender;?></td>
							<td class="center"><?php echo $std_district;?></td>
							<td class="center"><?php echo $row['groups'];?></td>
							<!--<td class="center"><img id="output" style="height:80px; width:80px;" src="<?php echo '../institution-panel/'.$row['std_pic']; ?>"/></td>-->
							<td class="center"><?php echo $admission_type;?></td>
							<td class="center"><?php echo $row['adm_batchno'];?></td>
							<td class="center"><?php echo $row['adm_srno'];?></td>
							<td class="center"><?php echo $row['adm_fee'];?></td>
							<td class="center"><?php echo $row['challan_no'];?></td>
							<td class="center"><?php echo $row_centers['cent_name'];?></td>
						</tr>
						<?php
						$srno++;
						}
						?>						
						</tbody>
						<tfoot>
						<tr>
							<th>Sr.No.</th>
							<th>App. No.</th>
							<th>SSC Exam Year</th>
							<th>SSC Roll No.</th>
							<th>SSC Session</th>
							<th>SSC Board</th>
							<th>Reg. Date</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>District</th>
							<th>Group</th>
						<!--<th>Picture</th>-->
							<th>Admission Type</th>
							<th>Batch No.</th>
							<th>Sr. No.</th>
							<th>Fee</th>
							<th>Challan #</th>
							<th>Exam Centre</th>
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