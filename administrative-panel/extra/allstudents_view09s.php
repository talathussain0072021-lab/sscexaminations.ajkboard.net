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
					$sql1="SELECT Id, P1Year, P1RollNo, P1Session, P1RegNo, P1Board, P1Result, Dated, Name, FatherName, DOB, PicURL, CNIC, Gender, Religion, IdentityMarks, IsSpecial, Domicile, OtherDomicile, PrvExamDistrict, PostalAddress, PermanentAddress, Phone, Mobile, IsGroupChange, IsCombChange, SubChangeType, Medium1, Medium2, Medium3, Medium4, Medium5, Medium6, Medium7, Medium8, Medium9, IsRegular, AdmCategory, SubCategory, InstituteId, GroupName, CombinationName, Sub1Code, Sub2Code, Sub3Code, Sub4Code, Sub5Code, Sub6Code, Sub7Code, Sub8Code, Sub9Code, BatchNo, BatchAdmStatus, BatchRevStatus, StdAdmStatus, StdRevStatus, AdmissionFee, RollNo, BatchSr, ChallanNo, ACentreName, ACentreCode, ExamShift, InstituteCode, InstituteName, StdInstituteCode, StdInstituteName, RegNo FROM vwadmstudents09s WHERE Id=".$_REQUEST['Id']." AND ExamId=".$ExamId."";
					$res1=mysql_query($sql1, $conn1);
					$row1=mysql_fetch_array($res1);
					
					$sql_sub1="SELECT Name FROM subjects WHERE Code=".$row1['Sub1Code']."";
					$res_sub1=mysql_query($sql_sub1, $conn1);
					$row_sub1=mysql_fetch_array($res_sub1);
					
					$sql_sub2="SELECT Name FROM subjects WHERE Code=".$row1['Sub2Code']."";
					$res_sub2=mysql_query($sql_sub2, $conn1);
					$row_sub2=mysql_fetch_array($res_sub2);
					
					$sql_sub3="SELECT Name FROM subjects WHERE Code=".$row1['Sub3Code']."";
					$res_sub3=mysql_query($sql_sub3, $conn1);
					$row_sub3=mysql_fetch_array($res_sub3);
					
					$sql_sub4="SELECT Name FROM subjects WHERE Code=".$row1['Sub4Code']."";
					$res_sub4=mysql_query($sql_sub4, $conn1);
					$row_sub4=mysql_fetch_array($res_sub4);

					$sql_sub5="SELECT Name FROM subjects WHERE Code=".$row1['Sub5Code']."";
					$res_sub5=mysql_query($sql_sub5, $conn1);
					$row_sub5=mysql_fetch_array($res_sub5);
					
					$sql_sub6="SELECT Name FROM subjects WHERE Code=".$row1['Sub6Code']."";
					$res_sub6=mysql_query($sql_sub6, $conn1);
					$row_sub6=mysql_fetch_array($res_sub6);
					
					$sql_sub7="SELECT Name FROM subjects WHERE Code=".$row1['Sub7Code']."";
					$res_sub7=mysql_query($sql_sub7, $conn1);
					$row_sub7=mysql_fetch_array($res_sub7);
					
					$sql_sub8="SELECT Name FROM subjects WHERE Code=".$row1['Sub8Code']."";
					$res_sub8=mysql_query($sql_sub8, $conn1);
					$row_sub8=mysql_fetch_array($res_sub8);
					
					$sql_sub9="SELECT Name FROM subjects WHERE Code=".$row1['Sub9Code']."";
					$res_sub9=mysql_query($sql_sub9, $conn1);
					$row_sub9=mysql_fetch_array($res_sub9);
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
								<td><label for="Name" class="property">P1 Year:</label></td>
								<td><input type="text" value="<?php echo $row1['P1Year'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">P1 RollNo:</label></td>
								<td><input type="text" value="<?php echo $row1['P1RollNo'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">P1 Session:</label></td>
									<?php
									if($row1['P1Session'] == 1){ $P1Session='1st Annual'; }
									else if($row1['P1Session'] == 2){ $P1Session='2nd Annual'; }
									else { $P1Session=''; }
									?>
								<td><input type="text" value="<?php echo $P1Session;?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">P1 RegNo:</label></td>
								<td><input type="text" value="<?php echo $row1['P1RegNo'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">P1 Board:</label></td>
									<?php
									$sql_p1boards="SELECT Name FROM boards WHERE Id=".$row1['P1Board']."";
									$res_p1boards=mysql_query($sql_p1boards, $conn1);
									$row_p1boards=mysql_fetch_array($res_p1boards);
									$P1Board=$row_p1boards['Name'];
									?>
								<td><input type="text" value="<?php echo $P1Board;?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">P1 Result:</label></td>
								<td><input type="text" value="<?php echo $row1['P1Result'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">P1 Board:</label></td>
									<?php
									$sql_p1boards="SELECT Name FROM boards WHERE Id=".$row1['P1Board']."";
									$res_p1boards=mysql_query($sql_p1boards, $conn1);
									$row_p1boards=mysql_fetch_array($res_p1boards);
									$P1Board=$row_p1boards['Name'];
									?>
								<td><input type="text" value="<?php echo $P1Board;?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">RegNo:</label></td>
								<td><input type="text" value="<?php echo $row1['RegNo'];?>" class="limiter x_large" readonly/></td>
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
							</tr>
							<tr>
								<td><label for="Name" class="property">IsRegular:</label></td>
									<?php
									if($row1['IsRegular'] == 1){ $IsRegular='Yes'; }
									else if($row1['IsRegular'] == 0){ $IsRegular='No'; }
									?>
								<td><input type="text" value="<?php echo $IsRegular;?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">Adm Category:</label></td>
									<?php
									if($row1['AdmCategory'] == 1 && $row1['SubCategory'] == 1){ $AdmSubCategory='Fresh AJK'; }
									else if($row1['AdmCategory'] == 1 && $row1['SubCategory'] == 3){ $AdmSubCategory='Fresh Other'; }
									else { $AdmSubCategory=''; }
									?>
								<td><input type="text" value="<?php echo $AdmSubCategory;?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Group:</label></td>
								<td><input type="text" value="<?php echo $row1['GroupName'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">Combination:</label></td>
								<td><input type="text" value="<?php echo $row1['CombinationName'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Sub1Name:</label></td>
								<td><input type="text" value="<?php echo $row_sub1['Name'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">Sub2Name:</label></td>
								<td><input type="text" value="<?php echo $row_sub2['Name'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Sub3Name:</label></td>
								<td>
									<input type="text" value="<?php echo $row_sub3['Name'];?>" class="limiter large" readonly/>
									<?php
									if($row1['Medium3'] == 1){ $Medium3='Urdu'; }
									else if($row1['Medium3'] == 2){ $Medium3='English'; }
									?>
									<input type="text" value="<?php echo $Medium3;?>" class="limiter small" readonly/>
								</td>
								<td><label for="Name" class="property">Sub4Name:</label></td>
								<td>
									<input type="text" value="<?php echo $row_sub4['Name'];?>" class="limiter large" readonly/>
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
									<input type="text" value="<?php echo $row_sub5['Name'];?>" class="limiter large" readonly/>
									<?php
									if($row1['Medium5'] == 1){ $Medium5='Urdu'; }
									else if($row1['Medium5'] == 2){ $Medium5='English'; }
									?>
									<input type="text" value="<?php echo $Medium5;?>" class="limiter small" readonly/>
								</td>
								<td><label for="Name" class="property">Sub6Name:</label></td>
								<td>
									<input type="text" value="<?php echo $row_sub6['Name'];?>" class="limiter large" readonly/>
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
									<input type="text" value="<?php echo $row_sub7['Name'];?>" class="limiter large" readonly/>
									<?php
									if($row1['Medium7'] == 1){ $Medium7='Urdu'; }
									else if($row1['Medium7'] == 2){ $Medium7='English'; }
									?>
									<input type="text" value="<?php echo $Medium7;?>" class="limiter small" readonly/>
								</td>
								<td><label for="Name" class="property">Sub8Name:</label></td>
								<td>
									<input type="text" value="<?php echo $row_sub8['Name'];?>" class="limiter large" readonly/>
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
									<input type="text" value="<?php echo $row_sub9['Name'];?>" class="limiter large" readonly/>
								</td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Institute Code:</label></td>
								<td><input type="text" value="<?php echo $row1['StdInstituteCode'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Institute Name:</label></td>
								<td colspan="3"><input type="text" value="<?php echo $row1['StdInstituteName'];?>" class="limiter x_large" readonly/></td>
							</tr>
							</table>
						</td>
					</tr>
					
					<!--	Admission(Part-II) Information	-->
					
					<tr style="color:#0033CC;"><td colspan="4" align="center"><h3><strong>Admission(Part-I) Information</strong></h3></td></tr>
					<tr>
						<td colspan="4">
							<table class="searchview">
							<tr>
								<td><label class="property">BatchNo:</label></td>
								<td><input type="text" value="<?php echo $row1['BatchNo'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">Batch AdmStatus:</label></td>
									<?php
									if($row1['BatchAdmStatus'] == 0){ $BatchAdmStatus='Pending'; }
									else if($row1['BatchAdmStatus'] == 1){ $BatchAdmStatus='Ok'; }
									else if($row1['BatchAdmStatus'] == 2){ $BatchAdmStatus='Not Ok'; }
									?>
								<td><input type="text" value="<?php echo $BatchAdmStatus;?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Batch RevStatus:</label></td>
									<?php
									if($row1['BatchRevStatus'] == 0){ $BatchRevStatus='Pending'; }
									else if($row1['BatchRevStatus'] == 1){ $BatchRevStatus='Ok'; }
									else if($row1['BatchRevStatus'] == 2){ $BatchRevStatus='Not Ok'; }
									?>
								<td><input type="text" value="<?php echo $BatchRevStatus;?>" class="limiter x_large" readonly/></td>
								<td><label class="property">Stdudent AdmStatus:</label></td>
									<?php
									if($row1['StdAdmStatus'] == 0){ $StdAdmStatus='Pending'; }
									else if($row1['StdAdmStatus'] == 1){ $StdAdmStatus='Ok'; }
									else if($row1['StdAdmStatus'] == 2){ $StdAdmStatus='Not Ok'; }
									?>
								<td><input type="text" value="<?php echo $StdAdmStatus;?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Stdudent RevStatus:</label></td>
									<?php
									if($row1['StdRevStatus'] == 0){ $StdRevStatus='Pending'; }
									else if($row1['StdRevStatus'] == 1){ $StdRevStatus='Ok'; }
									else if($row1['StdRevStatus'] == 2){ $StdRevStatus='Not Ok'; }
									?>
								<td><input type="text" value="<?php echo $StdRevStatus;?>" class="limiter x_large" readonly/></td>
								<td><label class="property">Admission Fee:</label></td>
								<td><input type="text" value="<?php echo $row1['AdmissionFee'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">RollNo:</label></td>
								<td><input type="text" value="<?php echo $row1['RollNo'];?>" class="limiter x_large" readonly/></td>
								<td><label class="property">BatchSr:</label></td>
								<td><input type="text" value="<?php echo $row1['BatchSr'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Centre Code:</label></td>
								<td><input type="text" value="<?php echo $row1['ACentreCode'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Centre Name:</label></td>
								<td colspan="3"><input type="text" value="<?php echo $row1['ACentreName'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Exam Shift:</label></td>
								<td><input type="text" value="<?php echo $row1['ExamShift'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">ChallanNo:</label></td>
								<td><input type="text" value="<?php echo $row1['ChallanNo'];?>" class="limiter x_large" readonly/></td>
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