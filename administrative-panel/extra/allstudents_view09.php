<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>View Student Record</h6>
					</div>
					<div class="widget_content">
					<form action="" method="post" class="form_container left_label" enctype="multipart/form-data">
					<table class="tablarge_property">
					<tbody>
					<?php
					$sql1="SELECT Id, SSCRegNo, SSCBoard, Dated, Name, FatherName, DOB, PicURL, CNIC, Gender, Religion, IdentityMarks, IsSpecial, Domicile, OtherDomicile, PrvExamDistrict, PrvDistrictSr, PostalAddress, PermanentAddress, Phone, Mobile, SchoolRollNo, AdmissionDate, IsGroupChange, IsCombChange, SubChangeType, Medium1, Medium2, Medium3, Medium4, Medium5, Medium6, Medium7, Medium8, Medium9, IsRegular, AdmissionType, SubjectChange, IsRegistered, IsEntered, InstituteId, GroupName, CombinationName, Sub1Name, Sub2Name, Sub3Name, Sub4Name, Sub5Name, Sub6Name, Sub7Name, Sub8Name, Sub9Name, InstituteCode, InstituteName FROM vwregstudents WHERE Id=".$_REQUEST['Id']." AND SessionId=".$SessionId."";
					$res1=mysql_query($sql1, $conn1);
					$row1=mysql_fetch_array($res1);
					?>
					<tr>
						<td colspan="4">
							<table class="searchview">
							<tr>
								<td align="center"><img id="output" style="height:125px; width:100px;" src="<?php echo '../institution-panel/'.$row1['PicURL']."?".rand(00000,999999);?>"/></td>
							</tr>
							</table>
						</td>
					</tr>
					
					<!--	General Information    -->
					
					<tr style="color:#0033CC;"><td colspan="4" align="center"><h3><strong>General Information</strong></h3></td></tr>
					<tr>
						<td colspan="4">
							<table class="searchview">
							<tr>
								<td><label for="Name" class="property">Application No:</label></td>
								<td><input type="text" value="<?php echo $row1['Id'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">SSC RegNo:</label></td>
								<td><input type="text" value="<?php echo $row1['SSCRegNo'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">SSC Board:</label></td>
									<?php
									$sql_sscboards="SELECT Name FROM boards WHERE Id=".$row1['SSCBoard']."";
									$res_sscboards=mysql_query($sql_sscboards, $conn1);
									$row_sscboards=mysql_fetch_array($res_sscboards);
									$SSCBoard=$row_sscboards['Name'];
									?>
								<td><input type="text" value="<?php echo $SSCBoard;?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">Dated:</label></td>
								<td><input type="text" value="<?php echo date('d-m-Y', strtotime($row1['Dated']));?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Name:</label></td>
								<td><input type="text" value="<?php echo $row1['Name'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">Father Name:</label></td>
								<td><input type="text" value="<?php echo $row1['FatherName'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">DOB:</label></td>
								<td><input type="text" value="<?php echo date('d-m-Y', strtotime($row1['DOB']));?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">CNIC:</label></td>
								<td><input type="text" value="<?php echo $row1['CNIC'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Gender:</label></td>
									<?php
									if($row1['Gender'] == 1){ $Gender='Male'; }
									else if($row1['Gender'] == 2){ $Gender='Female'; }
									else { $Gender=''; }
									?>
								<td><input type="text" value="<?php echo $Gender;?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">Religion:</label></td>
									<?php
									if($row1['Religion'] == 1){ $Religion='Muslim'; }
									else if($row1['Religion'] == 2){ $Religion='Non Muslim'; }
									else { $Religion=''; }
									?>
								<td><input type="text" value="<?php echo $Religion;?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Identity Marks:</label></td>
								<td><input type="text" value="<?php echo $row1['IdentityMarks'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">Category:</label></td>
									<?php
									if($row1['IsSpecial'] == 1){ $IsSpecial='Board Employee'."'".'s Child'; }
									else if($row1['IsSpecial'] == 2){ $IsSpecial='Refugee'."'".'s Child'; }
									else if($row1['IsSpecial'] == 3){ $IsSpecial='Normal Case'; }
									else if($row1['IsSpecial'] == 4){ $IsSpecial='Special Student'; }
									else if($row1['IsSpecial'] == 5){ $IsSpecial='Orphan Student'; }
									?>
								<td><input type="text" value="<?php echo $IsSpecial;?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Domicile:</label></td>
									<?php
									$sql_districts="SELECT Name FROM districts WHERE Id=".$row1['Domicile']." ORDER BY Name ASC";
									$res_districts=mysql_query($sql_districts, $conn1);
									$row_districts=mysql_fetch_array($res_districts);
									?>
								<td><input type="text" value="<?php echo $row_districts['Name'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">Other Domicile:</label></td>
								<td><input type="text" value="<?php echo $row1['OtherDomicile'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Exam District:</label></td>
									<?php
									$sql_districts="SELECT Name FROM districts WHERE Id=".$row1['PrvExamDistrict']." ORDER BY Name ASC";
									$res_districts=mysql_query($sql_districts, $conn1);
									$row_districts=mysql_fetch_array($res_districts);
									?>
								<td><input type="text" value="<?php echo $row_districts['Name'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Postal Address:</label></td>
								<td><textarea class="input_grow" cols="40" rows="4" readonly><?php echo $row1['PostalAddress'];?></textarea></td>
								<td><label for="Name" class="property">Permanent Address:</label></td>
								<td><textarea class="input_grow" cols="40" rows="4" readonly><?php echo $row1['PermanentAddress'];?></textarea></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Phone:</label></td>
								<td><input type="text" value="<?php echo $row1['Phone'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">Mobile:</label></td>
								<td><input type="text" value="<?php echo $row1['Mobile'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">School RollNo:</label></td>
								<td><input type="text" value="<?php echo $row1['SchoolRollNo'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">Admission Date:</label></td>
								<td><input type="text" value="<?php echo $row1['AdmissionDate'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">IsGroupChange:</label></td>
									<?php
									if($row1['IsGroupChange'] == 1){ $IsGroupChange='Yes'; }
									else if($row1['IsGroupChange'] == 0){ $IsGroupChange='No'; }
									?>
								<td><input type="text" value="<?php echo $IsGroupChange;?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">IsCombChange:</label></td>
									<?php
									if($row1['IsCombChange'] == 1){ $IsCombChange='Yes'; }
									else if($row1['IsCombChange'] == 0){ $IsCombChange='No'; }
									?>
								<td><input type="text" value="<?php echo $IsCombChange;?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">SubChangeType:</label></td>
								<td><input type="text" value="<?php echo $row1['SubChangeType'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">IsRegular:</label></td>
									<?php
									if($row1['IsRegular'] == 1){ $IsRegular='Yes'; }
									else if($row1['IsRegular'] == 0){ $IsRegular='No'; }
									?>
								<td><input type="text" value="<?php echo $IsRegular;?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Admission Type:</label></td>
									<?php
									if($row1['AdmissionType'] == 1){ $AdmissionType='Fresh (Ajk)'; }
									else if($row1['AdmissionType'] == 3){ $AdmissionType='ReAdm. (AJK)'; }
									else if($row1['AdmissionType'] == 4){ $AdmissionType='ReAdm. (Other)'; }
									?>
								<td><input type="text" value="<?php echo $AdmissionType;?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">Subject Change:</label></td>
									<?php
									if($row1['SubjectChange'] == 0){ $SubjectChange='Without Any Change'; }
									else if($row1['SubjectChange'] == 1){ $SubjectChange='With 1 Subject Change'; }
									else if($row1['SubjectChange'] == 2){ $SubjectChange='With 2 Subjects Change'; }
									else if($row1['SubjectChange'] == 3){ $SubjectChange='With 3 Subjects Change'; }
									else if($row1['SubjectChange'] == 4){ $SubjectChange='With Group Change'; }
									?>
								<td><input type="text" value="<?php echo $SubjectChange;?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">IsRegistered:</label></td>
									<?php
									if($row1['IsRegistered'] == 1){ $IsRegistered='Yes'; }
									else if($row1['IsRegistered'] == 0){ $IsRegistered='No'; }
									?>
								<td><input type="text" value="<?php echo $IsRegistered;?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">IsEntered:</label></td>
									<?php
									if($row1['IsEntered'] == 1){ $IsEntered='Yes'; }
									else if($row1['IsEntered'] == 0){ $IsEntered='No'; }
									?>
								<td><input type="text" value="<?php echo $IsEntered;?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Group:</label></td>
								<td><input type="text" value="<?php echo $row1['GroupName'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">Combination:</label></td>
								<td><input type="text" value="<?php echo $row1['CombinationName'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Sub1Name:</label></td>
								<td><input type="text" value="<?php echo $row1['Sub1Name'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">Sub2Name:</label></td>
								<td><input type="text" value="<?php echo $row1['Sub2Name'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Sub3Name:</label></td>
								<td>
									<input type="text" value="<?php echo $row1['Sub3Name'];?>" class="limiter large" readonly/>
									<?php
									if($row1['Medium3'] == 1){ $Medium3='Urdu'; }
									else if($row1['Medium3'] == 2){ $Medium3='English'; }
									?>
									<input type="text" value="<?php echo $Medium3;?>" class="limiter small" readonly/>
								</td>
								<td><label for="Name" class="property">Sub4Name:</label></td>
								<td>
									<input type="text" value="<?php echo $row1['Sub4Name'];?>" class="limiter large" readonly/>
									<?php
									if($row1['Medium4'] == 1){ $Medium4='Urdu'; }
									else if($row1['Medium4'] == 2){ $Medium4='English'; }
									?>
									<input type="text" value="<?php echo $Medium4;?>" class="limiter small" readonly/>
								</td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Sub5Name:</label></td>
								<td>
									<input type="text" value="<?php echo $row1['Sub5Name'];?>" class="limiter large" readonly/>
									<?php
									if($row1['Medium5'] == 1){ $Medium5='Urdu'; }
									else if($row1['Medium5'] == 2){ $Medium5='English'; }
									?>
									<input type="text" value="<?php echo $Medium5;?>" class="limiter small" readonly/>
								</td>
								<td><label for="Name" class="property">Sub6Name:</label></td>
								<td>
									<input type="text" value="<?php echo $row1['Sub6Name'];?>" class="limiter large" readonly/>
									<?php
									if($row1['Medium6'] == 1){ $Medium6='Urdu'; }
									else if($row1['Medium6'] == 2){ $Medium6='English'; }
									?>
									<input type="text" value="<?php echo $Medium6;?>" class="limiter small" readonly/>
								</td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Sub7Name:</label></td>
								<td>
									<input type="text" value="<?php echo $row1['Sub7Name'];?>" class="limiter large" readonly/>
									<?php
									if($row1['Medium7'] == 1){ $Medium7='Urdu'; }
									else if($row1['Medium7'] == 2){ $Medium7='English'; }
									?>
									<input type="text" value="<?php echo $Medium7;?>" class="limiter small" readonly/>
								</td>
								<td><label for="Name" class="property">Sub8Name:</label></td>
								<td>
									<input type="text" value="<?php echo $row1['Sub8Name'];?>" class="limiter large" readonly/>
									<?php
									if($row1['Medium8'] == 1){ $Medium8='Urdu'; }
									else if($row1['Medium8'] == 2){ $Medium8='English'; }
									?>
									<input type="text" value="<?php echo $Medium8;?>" class="limiter small" readonly/>
								</td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Sub9Name:</label></td>
								<td>
									<input type="text" value="<?php echo $row1['Sub9Name'];?>" class="limiter x_large" readonly/>
								</td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Institute Code:</label></td>
								<td><input type="text" value="<?php echo $row1['InstituteCode'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Institute Name:</label></td>
								<td colspan="3"><input type="text" value="<?php echo $row1['InstituteName'];?>" class="limiter x_large" readonly/></td>
							</tr>
							</table>
						</td>
					</tr>
					
					<!--	Registration Information	-->
					
					<?php
					$sql2="SELECT BatchNo, BatchRegStatus, BatchRevStatus, StdRegStatus, StdRevStatus, RegistrationFee, InstituteSr, RegistrationNo, BatchSr, ChallanNo, RegInstituteCode, RegInstituteName FROM vwregstudents WHERE Id=".$_REQUEST['Id']." AND SessionId=".$SessionId."";
					$res2=mysql_query($sql2, $conn1);
					$row2=mysql_fetch_array($res2);
					?>
					<tr style="color:#0033CC;"><td colspan="4" align="center"><h3><strong>Registration Information</strong></h3></td></tr>
					<tr>
						<td colspan="4">
							<table class="searchview">
							<tr>
								<td><label class="property">BatchNo:</label></td>
								<td><input type="text" value="<?php echo $row2['BatchNo'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">Batch RegStatus:</label></td>
									<?php
									if($row2['BatchRegStatus'] == 0){ $BatchRegStatus='Pending'; }
									else if($row2['BatchRegStatus'] == 1){ $BatchRegStatus='Ok'; }
									else if($row2['BatchRegStatus'] == 2){ $BatchRegStatus='Not Ok'; }
									?>
								<td><input type="text" value="<?php echo $BatchRegStatus;?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Batch RevStatus:</label></td>
									<?php
									if($row2['BatchRevStatus'] == 0){ $BatchRevStatus='Pending'; }
									else if($row2['BatchRevStatus'] == 1){ $BatchRevStatus='Ok'; }
									else if($row2['BatchRevStatus'] == 2){ $BatchRevStatus='Not Ok'; }
									?>
								<td><input type="text" value="<?php echo $BatchRevStatus;?>" class="limiter x_large" readonly/></td>
								<td><label class="property">Stdudent RegStatus:</label></td>
									<?php
									if($row2['StdRegStatus'] == 0){ $StdRegStatus='Pending'; }
									else if($row2['StdRegStatus'] == 1){ $StdRegStatus='Ok'; }
									else if($row2['StdRegStatus'] == 2){ $StdRegStatus='Not Ok'; }
									?>
								<td><input type="text" value="<?php echo $StdRegStatus;?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Stdudent RevStatus:</label></td>
									<?php
									if($row2['StdRevStatus'] == 0){ $StdRevStatus='Pending'; }
									else if($row2['StdRevStatus'] == 1){ $StdRevStatus='Ok'; }
									else if($row2['StdRevStatus'] == 2){ $StdRevStatus='Not Ok'; }
									?>
								<td><input type="text" value="<?php echo $StdRevStatus;?>" class="limiter x_large" readonly/></td>
								<td><label class="property">Registration Fee:</label></td>
								<td><input type="text" value="<?php echo $row2['RegistrationFee'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">InstituteSr:</label></td>
								<td><input type="text" value="<?php echo $row2['InstituteSr'];?>" class="limiter x_large" readonly/></td>
								<td><label class="property">BatchSr:</label></td>
								<td><input type="text" value="<?php echo $row2['BatchSr'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Registration No:</label></td>
								<td><input type="text" value="<?php echo $row2['RegistrationNo'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">ChallanNo:</label></td>
								<td><input type="text" value="<?php echo $row2['ChallanNo'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Institute Code:</label></td>
								<td><input type="text" value="<?php echo $row2['RegInstituteCode'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Institute Name:</label></td>
								<td colspan="3"><input type="text" value="<?php echo $row2['RegInstituteName'];?>" class="limiter x_large" readonly/></td>
							</tr>
							</table>
						</td>
					</tr>
					
					<!--	Admission(Part-I) Information	-->
					
					<?php
					$sql3="SELECT BatchNo, BatchAdmStatus, BatchRevStatus, StdAdmStatus, StdRevStatus, AdmissionFee, RollNo, BatchSr, ChallanNo, ACentreName, ACentreCode, ExamShift, InstituteCode, InstituteName FROM vwadmstudents09 WHERE Id=".$_REQUEST['Id']." AND SessionId=".$SessionId."";
					$res3=mysql_query($sql3, $conn1);
					$row3=mysql_fetch_array($res3);
					?>
					<tr style="color:#0033CC;"><td colspan="4" align="center"><h3><strong>Admission(Part-I) Information</strong></h3></td></tr>
					<tr>
						<td colspan="4">
							<table class="searchview">
							<tr>
								<td><label class="property">BatchNo:</label></td>
								<td><input type="text" value="<?php echo $row3['BatchNo'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">Batch AdmStatus:</label></td>
									<?php
									if($row3['BatchAdmStatus'] == 0){ $BatchAdmStatus='Pending'; }
									else if($row3['BatchAdmStatus'] == 1){ $BatchAdmStatus='Ok'; }
									else if($row3['BatchAdmStatus'] == 2){ $BatchAdmStatus='Not Ok'; }
									?>
								<td><input type="text" value="<?php echo $BatchAdmStatus;?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Batch RevStatus:</label></td>
									<?php
									if($row3['BatchRevStatus'] == 0){ $BatchRevStatus='Pending'; }
									else if($row3['BatchRevStatus'] == 1){ $BatchRevStatus='Ok'; }
									else if($row3['BatchRevStatus'] == 2){ $BatchRevStatus='Not Ok'; }
									?>
								<td><input type="text" value="<?php echo $BatchRevStatus;?>" class="limiter x_large" readonly/></td>
								<td><label class="property">Stdudent AdmStatus:</label></td>
									<?php
									if($row3['StdAdmStatus'] == 0){ $StdAdmStatus='Pending'; }
									else if($row3['StdAdmStatus'] == 1){ $StdAdmStatus='Ok'; }
									else if($row3['StdAdmStatus'] == 2){ $StdAdmStatus='Not Ok'; }
									?>
								<td><input type="text" value="<?php echo $StdAdmStatus;?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Stdudent RevStatus:</label></td>
									<?php
									if($row3['StdRevStatus'] == 0){ $StdRevStatus='Pending'; }
									else if($row3['StdRevStatus'] == 1){ $StdRevStatus='Ok'; }
									else if($row3['StdRevStatus'] == 2){ $StdRevStatus='Not Ok'; }
									?>
								<td><input type="text" value="<?php echo $StdRevStatus;?>" class="limiter x_large" readonly/></td>
								<td><label class="property">Admission Fee:</label></td>
								<td><input type="text" value="<?php echo $row3['AdmissionFee'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">RollNo:</label></td>
								<td><input type="text" value="<?php echo $row3['RollNo'];?>" class="limiter x_large" readonly/></td>
								<td><label class="property">BatchSr:</label></td>
								<td><input type="text" value="<?php echo $row3['BatchSr'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Centre Code:</label></td>
								<td><input type="text" value="<?php echo $row3['ACentreCode'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Centre Name:</label></td>
								<td colspan="3"><input type="text" value="<?php echo $row3['ACentreName'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Exam Shift:</label></td>
								<td><input type="text" value="<?php echo $row3['ExamShift'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">ChallanNo:</label></td>
								<td><input type="text" value="<?php echo $row3['ChallanNo'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Institute Code:</label></td>
								<td><input type="text" value="<?php echo $row3['InstituteCode'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Institute Name:</label></td>
								<td colspan="3"><input type="text" value="<?php echo $row3['InstituteName'];?>" class="limiter x_large" readonly/></td>
							</tr>
							</table>
						</td>
					</tr>
					</tbody>
					</table>
					</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php include('includes/footer.php');?>
<style>
	.property {color:#000000; font-size:12px; font-weight:bold;}
	.tablarge_property{width:99%;}
</style>