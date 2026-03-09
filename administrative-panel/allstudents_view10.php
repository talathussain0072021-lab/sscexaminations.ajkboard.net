<?php
// Turn on error reporting at the VERY TOP
error_reporting(1);
ini_set('display_errors', 1);
include('includes/config.php');
include('includes/top.php');
include('includes/header.php');
include('includes/left_column.php');
    $ExamId = 3;
    $ExamName = 'SSC ADMISSIONS';
?>
<div id="container">
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
					$sql1="SELECT `Id`, `AppId`, `ExamYear`, `ExamSession`, `P1StudentId`, `P1Year`, `P1RollNo`, `P1Session`, `P1RegNo`, `P1Board`, `P1Result`, `PYear`, `PRollNo`, `PSession`, `PRegNo`, `PBoard`, `PResult`, `NOCNo`, `Dated`, `Name`, `FatherName`, `DOB`, `PicURL`, `CNIC`, `Gender`, `Religion`, `IdentityMarks`, `IsSpecial`, `District`, `Domicile`, `OtherDomicile`, `PostalAddress`, `PermanentAddress`, `PostalDistrict`, `PostalTehsil`, `PostOffice`, `Phone`, `Mobile`, `PrvExamDistrict`, `InternalGrade`, `GroupId`, `GrpPriority`, `CombinationId`, `IsGroupChange`, `IsCombChange`, `SubChangeType`, `Medium1`, `Medium2`, `Medium3`, `Medium4`, `Medium5`, `Medium6`, `Medium7`, `Medium8`, `Medium9`, `Medium21`, `Medium22`, `Medium23`, `Medium24`, `Medium25`, `Medium26`, `Medium27`, `Medium28`, `Medium29`, `IsRegular`, `IsEntered`, `AdmCategory`, `SubCategory`, `InstituteId`, `ExamId`, `CombinationName`, `RegFee`, `PrvFee`, `CombType`, `SubjectGroupId`, `GroupName`, `Sub1Code`, `Sub1Id`, `Sub1Name`, `Sub2Code`, `Sub2Id`, `Sub2Name`, `Sub3Code`, `Sub3Id`, `Sub3Name`, `Sub4Code`, `Sub4Id`, `Sub4Name`, `Sub5Code`, `Sub5Id`, `Sub5Name`, `Sub6Code`, `Sub6Id`, `Sub6Name`, `Sub7Code`, `Sub7Id`, `Sub7Name`, `Sub8Code`, `Sub8Id`, `Sub8Name`, `Sub9Code`, `Sub9Id`, `Sub9Name`, `Sub21Code`, `Sub21Id`, `Sub21Name`, `Sub22Code`, `Sub22Id`, `Sub22Name`, `Sub23Code`, `Sub23Id`, `Sub23Name`, `Sub24Code`, `Sub24Id`, `Sub24Name`, `Sub25Code`, `Sub25Id`, `Sub25Name`, `Sub26Code`, `Sub26Id`, `Sub26Name`, `Sub27Code`, `Sub27Id`, `Sub27Name`, `Sub28Code`, `Sub28Id`, `Sub28Name`, `Sub29Code`, `Sub29Id`, `Sub29Name`, `Sub26PCode`, `Sub26PName`, `Sub27PCode`, `Sub27PName`, `Sub28PCode`, `Sub28PName`, `BatchId`, `BatchNo`, `BatchStatus`, `BatchType`, `BatchAdmStatus`, `BatchRevStatus`, `BatchStudentsId`, `StdAdmStatus`, `StdRevStatus`, `AdmissionFee`, `RollNo`, `BatchSr`, `ChallanNo`, `PCentreId`, `PCentreName`, `PCentreCode`, `ACentreId`, `ACentreName`, `ACentreCode`, `ACentreDistrict`, `ACentreType`, `ExamShift`, `InstituteCode`, `InstituteName`, `InstitutePrincipal`, `InstituteContactNo`, `StdInstituteCode`, `StdInstituteName`, `IsGovt`, `IsNewRegNo`, `RegSrNo`, `RegNo`, `ExamScheme` FROM `tbladm_10` WHERE `Id`=".intval($_REQUEST['Id']);
					$res1=mysqli_query($conn1, $sql1);
					$row1=mysqli_fetch_array($res1);
					$sql_sub1=$row1['Sub1Code'];
					$sql_sub2=$row1['Sub2Code'];
					$sql_sub3=$row1['Sub3Code'];
					$sql_sub4=$row1['Sub4Code'];
					$sql_sub5=$row1['Sub5Code'];
					$sql_sub6=$row1['Sub6Code'];
					$sql_sub7=$row1['Sub7Code'];
					$sql_sub8=$row1['Sub8Code'];
					$sql_sub9=$row1['Sub9Code'];

					$sql_sub21=$row1['Sub21Code'];
					$sql_sub22=$row1['Sub22Code'];
					$sql_sub23=$row1['Sub23Code'];
					$sql_sub24=$row1['Sub24Code'];
					$sql_sub25=$row1['Sub25Code'];
					$sql_sub26=$row1['Sub26Code'];
					$sql_sub27=$row1['Sub27Code'];
					$sql_sub28=$row1['Sub28Code'];
					$sql_sub29=$row1['Sub29Code'];
					$sql_sub261=$row1['Sub26PCode'];
					$sql_sub271=$row1['Sub27PCode'];
					$sql_sub281=$row1['Sub28PCode'];
					?>
					<tr>
						<td colspan="4">
							<table class="searchview">
							<tr>
								<td align="center"><img id="output" style="height:120px; width:100px;" src="<?php echo '../SSCPicsBackup/'.$row1['ExamYear'].'/'.$row1['ExamSession'].'/'.$row1['PicURL']."?".rand(00000,999999);?>"/></td>
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
									$P1Board = '';
									if(!empty($row1['P1Board']) && $row1['P1Board'] > 0) {
										$sql_p1boards="SELECT Name FROM boards WHERE Id=".intval($row1['P1Board']);
										$res_p1boards=mysqli_query($conn2, $sql_p1boards);
										if($res_p1boards && mysqli_num_rows($res_p1boards) > 0) {
											$row_p1boards=mysqli_fetch_array($res_p1boards);
											$P1Board=$row_p1boards['Name'];
										}
									}
									?>
								<td><input type="text" value="<?php echo $P1Board;?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">P1 Result:</label></td>
								<td><input type="text" value="<?php echo $row1['P1Result'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">P Year:</label></td>
								<td><input type="text" value="<?php echo $row1['PYear'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">P RollNo:</label></td>
								<td><input type="text" value="<?php echo $row1['PRollNo'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">P Session:</label></td>
									<?php
									if($row1['PSession'] == 1){ $PSession='1st Annual'; }
									else if($row1['PSession'] == 2){ $PSession='2nd Annual'; }
									else { $PSession=''; }
									?>
								<td><input type="text" value="<?php echo $PSession;?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">P RegNo:</label></td>
								<td><input type="text" value="<?php echo $row1['PRegNo'];?>" class="limiter x_large" readonly></td>
								<td><label for="Name" class="property">P Board:</label></td>
									<?php
									$PBoard = '';
									if(!empty($row1['PBoard']) && $row1['PBoard'] > 0) {
										$sql_pboards="SELECT Name FROM boards WHERE Id=".intval($row1['PBoard']);
										$res_pboards=mysqli_query($conn2, $sql_pboards);
										if($res_pboards && mysqli_num_rows($res_pboards) > 0) {
											$row_pboards=mysqli_fetch_array($res_pboards);
											$PBoard=$row_pboards['Name'];
										}
									}
									?>
								<td><input type="text" value="<?php echo $PBoard;?>" class="limiter x_large" readonly></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">P Result:</label></td>
								<td><input type="text" value="<?php echo $row1['PResult'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">RegNo:</label></td>
								<td><input type="text" value="<?php echo $row1['RegNo'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
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
									$DomicileName = '';
									if(!empty($row1['Domicile']) && $row1['Domicile'] > 0) {
										$sql_districts="SELECT Name FROM districts WHERE Id=".intval($row1['Domicile'])." ORDER BY Name ASC";
										$res_districts=mysqli_query($conn2, $sql_districts);
										if($res_districts && mysqli_num_rows($res_districts) > 0) {
											$row_districts=mysqli_fetch_array($res_districts);
											$DomicileName = $row_districts['Name'];
										}
									}
									?>
								<td><input type="text" value="<?php echo $DomicileName;?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">Other Domicile:</label></td>
								<td><input type="text" value="<?php echo $row1['OtherDomicile'];?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Exam District:</label></td>
									<?php
									$ExamDistrictName = '';
									if(!empty($row1['PrvExamDistrict']) && $row1['PrvExamDistrict'] > 0) {
										$sql_districts="SELECT Name FROM districts WHERE Id=".intval($row1['PrvExamDistrict'])." ORDER BY Name ASC";
										$res_districts=mysqli_query($conn2, $sql_districts);
										if($res_districts && mysqli_num_rows($res_districts) > 0) {
											$row_districts=mysqli_fetch_array($res_districts);
											$ExamDistrictName = $row_districts['Name'];
										}
									}
									?>
								<td><input type="text" value="<?php echo $ExamDistrictName;?>" class="limiter x_large" readonly/></td>
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
								<td><label for="Name" class="property">Internal Grade:</label></td>
								<td><input type="text" value="<?php echo $row1['InternalGrade'];?>" class="limiter x_large" readonly/></td>
								<td><label for="Name" class="property">IsGroupChange:</label></td>
									<?php
									if($row1['IsGroupChange'] == 1){ $IsGroupChange='Yes'; }
									else if($row1['IsGroupChange'] == 0){ $IsGroupChange='No'; }
									?>
								<td><input type="text" value="<?php echo $IsGroupChange;?>" class="limiter x_large" readonly/></td>
							</tr>
							<tr>
								<td><label for="Name" class="property">IsCombChange:</label></td>
									<?php
									if($row1['IsCombChange'] == 1){ $IsCombChange='Yes'; }
									else if($row1['IsCombChange'] == 0){ $IsCombChange='No'; }
									?>
								<td><input type="text" value="<?php echo $IsCombChange;?>" class="limiter x_large" readonly/></td>
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
									else if($row1['AdmCategory'] == 1 && $row1['SubCategory'] == 2){ $AdmSubCategory='Composite AJK'; }
									else if($row1['AdmCategory'] == 1 && $row1['SubCategory'] == 3){ $AdmSubCategory='Fresh Other'; }
									else if($row1['AdmCategory'] == 3 && $row1['SubCategory'] == 1){ $AdmSubCategory='Improvement AJK'; }
									else if($row1['AdmCategory'] == 4 && $row1['SubCategory'] == 1){ $AdmSubCategory='Additional AJK'; }
									else if($row1['AdmCategory'] == 5 && $row1['SubCategory'] == 1){ $AdmSubCategory='Comp.Failure AJK'; }
									else if($row1['AdmCategory'] == 5 && $row1['SubCategory'] == 2){ $AdmSubCategory='Comp.Failure Other'; }
									else if($row1['AdmCategory'] == 6 && $row1['SubCategory'] == 1){ $AdmSubCategory='Compartment AJK'; }
									else if($row1['AdmCategory'] == 6 && $row1['SubCategory'] == 2){ $AdmSubCategory='Compartment Other'; }
									else if($row1['AdmCategory'] == 7 && $row1['SubCategory'] == 1){ $AdmSubCategory='Fresh After Passing Adeeb/Alam/Fazal'; }
									else if($row1['AdmCategory'] == 7 && $row1['SubCategory'] == 5){ $AdmSubCategory='Failure After Passing Adeeb/Alam/Fazal'; }
									else if($row1['AdmCategory'] == 9 && $row1['SubCategory'] == 1){ $AdmSubCategory='Fresh After Passing Shahadat Sanvia/Aama/Khasa'; }
									else if($row1['AdmCategory'] == 9 && $row1['SubCategory'] == 5){ $AdmSubCategory='Failure After Passing Shahadat Sanvia/Aama/Khasa'; }
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
									<input type="text" value="<?php echo $row1['Sub9Name'];?>" class="limiter large" readonly/>
								</td>
								<td><label for="Name" class="property">Sub21Name:</label></td>
								<td>
									<input type="text" value="<?php echo $row1['Sub21Name'];?>" class="limiter x_large" readonly/>
								</td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Sub22Name:</label></td>
								<td>
									<input type="text" value="<?php echo $row1['Sub22Name'];?>" class="limiter x_large" readonly/>
								</td>
								<td><label for="Name" class="property">Sub23Name:</label></td>
								<td>
									<input type="text" value="<?php echo $row1['Sub23Name'];?>" class="limiter large" readonly/>
									<?php
									if($row1['Medium23'] == 1){ $Medium23='Urdu'; }
									else if($row1['Medium23'] == 2){ $Medium23='English'; }
									?>
									<input type="text" value="<?php echo $Medium23;?>" class="limiter small" readonly/>
								</td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Sub24Name:</label></td>
								<td>
									<input type="text" value="<?php echo $row1['Sub24Name'];?>" class="limiter large" readonly/>
									<?php
									if($row1['Medium24'] == 1){ $Medium24='Urdu'; }
									else if($row1['Medium24'] == 2){ $Medium24='English'; }
									?>
									<input type="text" value="<?php echo $Medium24;?>" class="limiter small" readonly/>
								</td>
								<td><label for="Name" class="property">Sub25Name:</label></td>
								<td>
									<input type="text" value="<?php echo $row1['Sub25Name'];?>" class="limiter large" readonly/>
									<?php
									if($row1['Medium25'] == 1){ $Medium25='Urdu'; }
									else if($row1['Medium25'] == 2){ $Medium25='English'; }
									?>
									<input type="text" value="<?php echo $Medium25;?>" class="limiter small" readonly/>
								</td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Sub26Name:</label></td>
								<td>
									<input type="text" value="<?php echo $row1['Sub26Name'];?>" class="limiter large" readonly/>
									<?php
									if($row1['Medium26'] == 1){ $Medium26='Urdu'; }
									else if($row1['Medium26'] == 2){ $Medium26='English'; }
									?>
									<input type="text" value="<?php echo $Medium26;?>" class="limiter small" readonly/>
								</td>
								<td><label for="Name" class="property">Sub27Name:</label></td>
								<td>
									<input type="text" value="<?php echo $row1['Sub27Name'];?>" class="limiter large" readonly/>
									<?php
									if($row1['Medium27'] == 1){ $Medium27='Urdu'; }
									else if($row1['Medium27'] == 2){ $Medium27='English'; }
									?>
									<input type="text" value="<?php echo $Medium27;?>" class="limiter small" readonly/>
								</td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Sub28Name:</label></td>
								<td>
									<input type="text" value="<?php echo $row1['Sub28Name'];?>" class="limiter large" readonly/>
									<?php
									if($row1['Medium28'] == 1){ $Medium28='Urdu'; }
									else if($row1['Medium28'] == 2){ $Medium28='English'; }
									?>
									<input type="text" value="<?php echo $Medium28;?>" class="limiter small" readonly/>
								</td>
								<td><label for="Name" class="property">Sub29Name:</label></td>
								<td>
									<input type="text" value="<?php echo $row1['Sub29Name'];?>" class="limiter x_large" readonly/>
								</td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Sub26PName:</label></td>
								<td>
									<input type="text" value="<?php echo $row1['Sub26PName'];?>" class="limiter x_large" readonly/>
								</td>
								<td><label for="Name" class="property">Sub27PName:</label></td>
								<td>
									<input type="text" value="<?php echo $row1['Sub27PName'];?>" class="limiter x_large" readonly/>
								</td>
							</tr>
							<tr>
								<td><label for="Name" class="property">Sub28PName:</label></td>
								<td>
									<input type="text" value="<?php echo $row1['Sub28PName'];?>" class="limiter x_large" readonly/>
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
					
					<tr style="color:#0033CC;"><td colspan="4" align="center"><h3><strong>Admission(Part-II) Information</strong></h3></td></tr>
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