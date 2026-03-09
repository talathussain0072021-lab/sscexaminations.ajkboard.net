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
						<h6>Reg. Return Report <?php echo $SessionName;?></h6>
					</div>

					<div class="widget_content">
                		<div style="width:100%; padding:10px;">
							
                        	<form method="get">
                            <table>
							<tr><td colspan="2" style="color:#FF0000; font-size:14px; vertical-align:middle; font-weight:bold;">Search Students</td></tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>	
                                <td style="vertical-align:middle;"><strong>Institute Code: &nbsp;</strong></td>
                                <td style="vertical-align:middle;"> &nbsp;
									<select name="InstituteId" data-placeholder="Select Institute" class="chzn-select admin-select" tabindex="1"/>
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
							</tr>
							<tr><td colspan="2"><br /></td></tr>
							<tr>	
                                <td style="vertical-align:middle;"><strong>IsSpecial Status: &nbsp;</strong></td>
                                <td style="vertical-align:middle;"> &nbsp;
									<select name="IsSpecial" data-placeholder="Select IsSpecial Status" class="chzn-select admin-select" tabindex="2"/>
									<option value="All">All</option>
									<option value="3" <?php echo (($_REQUEST['IsSpecial']==3)?'selected':'')?>>Normal Case</option>
									<option value="1" <?php echo (($_REQUEST['IsSpecial']==1)?'selected':'')?>>Board Employee's Child</option>
									<option value="2" <?php echo (($_REQUEST['IsSpecial']==2)?'selected':'')?>>Refugee's Child</option>
									</select>
								</td>				
							</tr>
							<tr><td colspan="2"><br /></td></tr>
							<tr>	
                                <td style="vertical-align:middle;"><strong>Admission Type: &nbsp;</strong></td>
                                <td style="vertical-align:middle;"> &nbsp;
									<select name="AdmissionType" data-placeholder="Select Admission Type" class="chzn-select admin-select" tabindex="3"/>
									<option value="All">All</option>
									<option value="1" <?php echo (($_REQUEST['AdmissionType']==1)?'selected':'')?>>Fresh (Ajk)</option>
									<option value="2" <?php echo (($_REQUEST['AdmissionType']==2)?'selected':'')?>>Fresh (Other)</option>
									<option value="3" <?php echo (($_REQUEST['AdmissionType']==3)?'selected':'')?>>Cond. (AJK)</option>
									<option value="4" <?php echo (($_REQUEST['AdmissionType']==4)?'selected':'')?>>Cond. (Other)</option>
									<option value="5" <?php echo (($_REQUEST['AdmissionType']==5)?'selected':'')?>>ReAdm. (AJK)</option>
									<option value="6" <?php echo (($_REQUEST['AdmissionType']==6)?'selected':'')?>>ReAdm. (Other)</option>
									</select>
								</td>				
							</tr>
							<tr><td colspan="2"><br /></td></tr>						
							<tr>
								<td colspan="2" align="center">
								<input type="submit" name="submit" value="Search" tabindex="4"/> 
								<a class="iframe" href="choose_regreturn_report.php?SessionId=<?php echo $SessionId;?>&InstituteId=<?php echo $_REQUEST['InstituteId'];?>&IsSpecial=<?php echo $_REQUEST['IsSpecial'];?>&AdmissionType=<?php echo $_REQUEST['AdmissionType'];?>"><span class="badge_style b_done">Print Report</span></a>
								</td>
							</tr> 
                            <tr><td colspan="2"><br></td></tr>
							</table>
                            </form>
                        </div>					
                            							
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
							<th>Batch No.</th>
							<th>Fee</th>
							<th>Inst. Code</th>
							<th>Inst. District</th>
							<th>Picture</th>
						</tr>
						</thead>
						<tbody>
                        <?php
						$SrNo=1;
						if(isset($_REQUEST['submit']))
						{						
							$sql="SELECT Id, SSCYear, SSCRollNo, SSCSession, SSCBoard, Dated, Name, FatherName, PicURL, Gender, AdmissionType, GroupName, BatchNo, RegistrationFee, RegInstituteCode, RegInstituteDistrict FROM vwregstudents WHERE SessionId=".$SessionId."";
							
							if(isset($_REQUEST['InstituteId']) && $_REQUEST['InstituteId']!='All')
							{ $sql.=" AND RegInstituteId=".$_REQUEST['InstituteId'].""; }
								
							if(isset($_REQUEST['IsSpecial']) && $_REQUEST['IsSpecial']!='All')
							{ $sql.=" AND IsSpecial=".$_REQUEST['IsSpecial'].""; }
								
							if(isset($_REQUEST['AdmissionType']) && $_REQUEST['AdmissionType']!='All')
							{ 
								$sql.=" AND AdmissionType=".$_REQUEST['AdmissionType']."";						
							}
								
							$sql.=" AND BatchId is Not NULL ORDER BY RegInstituteDistrict, RegInstituteCode ASC";
							$res=mysql_query($sql, $conn1);
							while($row=mysql_fetch_array($res))
							{	
								if($row['SSCSession'] == 1){ $SSCSession='Annual'; }
								else if($row['SSCSession'] == 2){ $SSCSession='Supply'; }
								else { $SSCSession=''; }
								
								if($row['SSCBoard'] == 0){ $SSCBoard=''; }	else if($row['SSCBoard'] == 1){ $SSCBoard='AJK'; }
								else if($row['SSCBoard'] == 2){ $SSCBoard='Federal'; } else if($row['SSCBoard'] == 3){ $SSCBoard='Lahore'; }
								else if($row['SSCBoard'] == 4){ $SSCBoard='Gujranwala'; } else if($row['SSCBoard'] == 5){ $SSCBoard='Rawalpindi'; }
								else if($row['SSCBoard'] == 6){ $SSCBoard='Sargoda'; } else if($row['SSCBoard'] == 7){ $SSCBoard='Faisalabad'; }
								else if($row['SSCBoard'] == 8){ $SSCBoard='Multan'; } else if($row['SSCBoard'] == 9){ $SSCBoard='Bhawalpur'; }
								else if($row['SSCBoard'] == 10){ $SSCBoard='Dera Gazi Khan'; } else if($row['SSCBoard'] == 11){ $SSCBoard='Abbottabad'; }
								else if($row['SSCBoard'] == 12){ $SSCBoard='Peshawar'; } else if($row['SSCBoard'] == 13){ $SSCBoard='Bannu'; }
								else if($row['SSCBoard'] == 14){ $SSCBoard='Sawat'; } else if($row['SSCBoard'] == 15){ $SSCBoard='Quetta'; }
								else if($row['SSCBoard'] == 16){ $SSCBoard='Karachi SSC'; } else if($row['SSCBoard'] == 17){ $SSCBoard='Karachi HSSC'; }
								else if($row['SSCBoard'] == 18){ $SSCBoard='Hayderabad'; } else if($row['SSCBoard'] == 19){ $SSCBoard='Larkana'; }
								else if($row['SSCBoard'] == 20){ $SSCBoard='Sakhar'; } else if($row['SSCBoard'] == 21){ $SSCBoard='Khairpur'; }
								else if($row['SSCBoard'] == 22){ $SSCBoard='Lahore Technical'; } else if($row['SSCBoard'] == 23){ $SSCBoard='Peshawar Technical'; }
								else if($row['SSCBoard'] == 24){ $SSCBoard='Sindh Technical'; } else if($row['SSCBoard'] == 25){ $SSCBoard='Sirinagar'; }
								else if($row['SSCBoard'] == 26){ $SSCBoard='Jammu'; } else if($row['SSCBoard'] == 27){ $SSCBoard='Kohat'; }
								else if($row['SSCBoard'] == 30){ $SSCBoard='Armed Services Board'; } else if($row['SSCBoard'] == 31){ $SSCBoard='AIOU'; }
								else if($row['SSCBoard'] == 32){ $SSCBoard='Mardan'; } else if($row['SSCBoard'] == 33){ $SSCBoard='Baluchistan'; }
								else if($row['SSCBoard'] == 34){ $SSCBoard='Karakurum University'; } else if($row['SSCBoard'] == 35){ $SSCBoard='Wafaq-Ul-Maddars'; }
								else if($row['SSCBoard'] == 36){ $SSCBoard='Others'; }
								
								if($row['Gender'] == 1){ $Gender='Male'; }
								else if($row['Gender'] == 2){ $Gender='Female'; }
								else { $Gender=''; }
				
								if($row['AdmissionType'] == 1){ $AdmissionType='Fresh (Ajk)'; }
								else if($row['AdmissionType'] == 2){ $AdmissionType='Fresh (Other)'; }
								else if($row['AdmissionType'] == 3){ $AdmissionType='Cond. (AJK)'; }
								else if($row['AdmissionType'] == 4){ $AdmissionType='Cond. (Other)'; }
								else if($row['AdmissionType'] == 5){ $AdmissionType='ReAdm. (AJK)'; }
								else if($row['AdmissionType'] == 6){ $AdmissionType='ReAdm. (Other)'; }
								
								if($row['RegInstituteDistrict'] == 1){ $RegInstituteDistrict='Muzaffarabad'; }
								else if($row['RegInstituteDistrict'] == 2){ $RegInstituteDistrict='Mirpur'; }
								else if($row['RegInstituteDistrict'] == 3){ $RegInstituteDistrict='Bhimber'; }
								else if($row['RegInstituteDistrict'] == 4){ $RegInstituteDistrict='Kotli'; }
								else if($row['RegInstituteDistrict'] == 5){ $RegInstituteDistrict='Bagh'; }
								else if($row['RegInstituteDistrict'] == 6){ $RegInstituteDistrict='Poonch'; }
								else if($row['RegInstituteDistrict'] == 7){ $RegInstituteDistrict='Sudhanoti'; }
								else if($row['RegInstituteDistrict'] == 9){ $RegInstituteDistrict='Neelam'; }
								else if($row['RegInstituteDistrict'] == 10){ $RegInstituteDistrict='Hattian Bala'; }
								else if($row['RegInstituteDistrict'] == 11){ $RegInstituteDistrict='Haveli'; }
								else { $RegInstituteDistrict=''; }
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
									<td class="center"><?php echo $row['BatchNo'];?></td>
									<td class="center"><?php echo floatval($row['RegistrationFee']);?></td>								
									<td class="center"><?php echo $row['RegInstituteCode'];?></td>
									<td class="center"><?php echo $RegInstituteDistrict;?></td>
									<td class="center"><img id="output" style="height:80px; width:80px;" src="<?php echo '../institution-panel/'.$row['PicURL']; ?>"/></td>
								</tr>
								<?php
								$SrNo++;
							}						
						}//if(isset($_REQUEST['submit']))			
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
							<th>Batch No.</th>
							<th>Fee</th>
							<th>Inst. Code</th>
							<th>Inst. District</th>
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