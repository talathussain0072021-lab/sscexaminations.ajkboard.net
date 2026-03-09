<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql1 = "SELECT * FROM subjectcombinations WHERE Name='".$_REQUEST['Name']."' AND Id!=".$_REQUEST['Id']."";
		$res1 = mysql_query($sql1, $conn1);
		$no_row1 = mysql_num_rows($res1);
		
		if($no_row1 > 0) {
			echo "<script>"; echo "alert('Name already exists.')"; echo "</script>";
		} else {
			
			// Get the values from the dropdown (assumes POST method)
			$subject1Id = $_REQUEST['Subject1Id'];
			$subject2Id = $_REQUEST['Subject2Id'];
			$subject3Id = $_REQUEST['Subject3Id'];
			$subject4Id = $_REQUEST['Subject4Id'];
			$subject5Id = $_REQUEST['Subject5Id'];
			$subject6Id = $_REQUEST['Subject6Id'];
			$subject7Id = $_REQUEST['Subject7Id'];
			$subject8Id = $_REQUEST['Subject8Id'];
			$subject9Id = $_REQUEST['Subject9Id'];

			// Prepare an array of new subject IDs
			$newCombination = [
				$subject1Id, $subject2Id, $subject3Id, $subject4Id, $subject5Id,
				$subject6Id, $subject7Id, $subject8Id, $subject9Id
			];

			// Sort the array to handle different orderings of the same subjects
			sort($newCombination);
			//echo print_r($newCombination); echo " ";

			// Prepare and execute a query to fetch all existing combinations
			$sql2 = "SELECT Subject1Id, Subject2Id, Subject3Id, Subject4Id, Subject5Id, Subject6Id, Subject7Id, Subject8Id, Subject9Id FROM subjectcombinations WHERE Id!=".$_REQUEST['Id']."";
			$res2 = mysql_query($sql2, $conn1);

			$exists = false;
			
			while ($row2 = mysql_fetch_array($res2)) {
				$existingCombination = [
					$row2['Subject1Id'], $row2['Subject2Id'], $row2['Subject3Id'], $row2['Subject4Id'], $row2['Subject5Id'],
					$row2['Subject6Id'], $row2['Subject7Id'], $row2['Subject8Id'], $row2['Subject9Id']
				];
				sort($existingCombination);
				//echo print_r($existingCombination); echo " ";

				if ($newCombination == $existingCombination) {
					$exists = true;
					break;
				}
			}
			//echo $exists;
			if (!$exists) {
				$updt="UPDATE subjectcombinations SET
				Name			=		'".$_REQUEST['Name']."',
				SubjectGroupId	=		".$_REQUEST['SubjectGroupId'].",
				RegFee			=		".$_REQUEST['RegFee'].",
				PrvFee			=		".$_REQUEST['PrvFee'].",
				Subject1Id		=		".$_REQUEST['Subject1Id'].",
				Subject2Id		=		".$_REQUEST['Subject2Id'].",
				Subject3Id		=		".$_REQUEST['Subject3Id'].",
				Subject4Id		=		".$_REQUEST['Subject4Id'].",
				Subject5Id		=		".$_REQUEST['Subject5Id'].",
				Subject6Id		=		".$_REQUEST['Subject6Id'].",
				Subject7Id		=		".$_REQUEST['Subject7Id'].",
				Subject8Id		=		".$_REQUEST['Subject8Id'].",
				Subject9Id		=		".$_REQUEST['Subject9Id'].",
				Subject21Id		=		".$_REQUEST['Subject21Id'].",
				Subject22Id		=		".$_REQUEST['Subject22Id'].",
				Subject23Id		=		".$_REQUEST['Subject23Id'].",
				Subject24Id		=		".$_REQUEST['Subject24Id'].",
				Subject25Id		=		".$_REQUEST['Subject25Id'].",
				Subject26Id		=		".$_REQUEST['Subject26Id'].",
				Subject27Id		=		".$_REQUEST['Subject27Id'].",
				Subject28Id		=		".$_REQUEST['Subject28Id'].",
				Subject29Id		=		".$_REQUEST['Subject29Id'].",
				CombType		=		".$_REQUEST['CombType'].",
				IsActive		=		".$_REQUEST['IsActive']."
				WHERE Id		=		".$_REQUEST['Id']."";
				
				if(mysql_query($updt, $conn1)) {
					$sql = mysql_query("CALL vwsubcombinations09TableCreation()", $conn1);
					$sql = mysql_query("CALL vwsubcombinations10TableCreation()", $conn1);
					?><script>location.replace('subjcombinations.php?message=Data Updated Successfully.');</script><?php
				} else {
					?><script>alert('Error in Query.');location.replace('subjcombinations_edit.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
				}
			} else {
				?><script>alert('This combination already exists.');location.replace('subjcombinations_edit.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
			}
		}//else
	}
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Update Subject Combination</h6>
					</div>
					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();">
							<ul>
								<li>
								<div class="form_grid_6">
									<label class="field_title">Name<span class="req">*</span></label>
									<div class="form_input">
										<input name="Name" id="Name" type="text" data-required="required" data-message="Enter Name" class="x_large" maxlength="40" tabindex="1"/>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Subject Group<span class="req">*</span></label>
									<div class="form_input">
										<select name="SubjectGroupId" id="SubjectGroupId" data-required="required" data-message="Choose Group" class="chzn-select custom-select" tabindex="2">
										</select>
									</div>
								</div>
								<br /><br /><br />
								</li>
								 
								<li>
								<div class="form_grid_6">
									<label class="field_title">Regular Fee<span class="req">*</span></label>
									<div class="form_input">
										<input name="RegFee" id="RegFee" type="text" data-required="required" data-message="Enter Regular Fee" class="x_large" onkeypress="return isNumberKey(event)" maxlength="15" tabindex="3"/>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Private Fee<span class="req">*</span></label>
									<div class="form_input">
										<input name="PrvFee" id="PrvFee" type="text" data-required="required" data-message="Enter Private Fee" class="x_large" onkeypress="return isNumberKey(event)" maxlength="15" tabindex="4"/>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">Subject 1<span class="req">*</span></label>
									<div class="form_input">
										<select name="Subject1Id" id="Subject1Id" data-required="required" data-message="Choose Subject 1" class="chzn-select custom-select" tabindex="5">
										</select>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Subject 21<span class="req">*</span></label>
									<div class="form_input">
										<select name="Subject21Id" id="Subject21Id" data-required="required" data-message="Choose Subject 21" class="chzn-select custom-select" tabindex="6">
										</select>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">Subject 2<span class="req">*</span></label>
									<div class="form_input">
										<select name="Subject2Id" id="Subject2Id" data-required="required" data-message="Choose Subject 2" class="chzn-select custom-select" tabindex="7">
										</select>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Subject 22<span class="req">*</span></label>
									<div class="form_input">
										<select name="Subject22Id" id="Subject22Id" data-required="required" data-message="Choose Subject 22" class="chzn-select custom-select" tabindex="8">
										</select>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">Subject 3<span class="req">*</span></label>
									<div class="form_input">
										<select name="Subject3Id" id="Subject3Id" data-required="required" data-message="Choose Subject 3" class="chzn-select custom-select" tabindex="9">
										</select>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Subject 23<span class="req">*</span></label>
									<div class="form_input">
										<select name="Subject23Id" id="Subject23Id" data-required="required" data-message="Choose Subject 23" class="chzn-select custom-select" tabindex="10">
										</select>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">Subject 4<span class="req">*</span></label>
									<div class="form_input">
										<select name="Subject4Id" id="Subject4Id" data-required="required" data-message="Choose Subject 4" class="chzn-select custom-select" tabindex="11">
										</select>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Subject 24<span class="req">*</span></label>
									<div class="form_input">
										<select name="Subject24Id" id="Subject24Id" data-required="required" data-message="Choose Subject 24" class="chzn-select custom-select" tabindex="12">
										</select>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">Subject 5<span class="req">*</span></label>
									<div class="form_input">
										<select name="Subject5Id" id="Subject5Id" data-required="required" data-message="Choose Subject 5" class="chzn-select custom-select" tabindex="13">
										</select>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Subject 25<span class="req">*</span></label>
									<div class="form_input">
										<select name="Subject25Id" id="Subject25Id" data-required="required" data-message="Choose Subject 25" class="chzn-select custom-select" tabindex="14">
										</select>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">Subject 6<span class="req">*</span></label>
									<div class="form_input">
										<select name="Subject6Id" id="Subject6Id" data-required="required" data-message="Choose Subject 6" class="chzn-select custom-select" tabindex="15">
										</select>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Subject 26<span class="req">*</span></label>
									<div class="form_input">
										<select name="Subject26Id" id="Subject26Id" data-required="required" data-message="Choose Subject 26" class="chzn-select custom-select" tabindex="16">
										</select>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">Subject 7<span class="req">*</span></label>
									<div class="form_input">
										<select name="Subject7Id" id="Subject7Id" data-required="required" data-message="Choose Subject 7" class="chzn-select custom-select" tabindex="17">
										</select>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Subject 27<span class="req">*</span></label>
									<div class="form_input">
										<select name="Subject27Id" id="Subject27Id" data-required="required" data-message="Choose Subject 27" class="chzn-select custom-select" tabindex="18">
										</select>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">Subject 8<span class="req">*</span></label>
									<div class="form_input">
										<select name="Subject8Id" id="Subject8Id" data-required="required" data-message="Choose Subject 8" class="chzn-select custom-select" tabindex="19">
										</select>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Subject 28<span class="req">*</span></label>
									<div class="form_input">
										<select name="Subject28Id" id="Subject28Id" data-required="required" data-message="Choose Subject 28" class="chzn-select custom-select" tabindex="20">
										</select>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">Subject 9<span class="req">*</span></label>
									<div class="form_input">
										<select name="Subject9Id" id="Subject9Id" data-required="required" data-message="Choose Subject 9" class="chzn-select custom-select" tabindex="21">
										</select>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">Subject 29<span class="req">*</span></label>
									<div class="form_input">
										<select name="Subject29Id" id="Subject29Id" data-required="required" data-message="Choose Subject 29" class="chzn-select custom-select" tabindex="22">
										</select>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
								<li>
								<div class="form_grid_6">
									<label class="field_title">Comb. Type<span class="req">*</span></label>
									<div class="form_input">
										<select name="CombType" id="CombType" data-required="required" data-message="Choose Comb. Type" class="chzn-select custom-select" tabindex="23">
										<option value="">Select</option>
										<option value="1">Reg. Comb.</option>
										<option value="2">Priv. Comb.</option>
										</select>
									</div>
								</div>
								<div class="form_grid_6">
									<label class="field_title">IsActive<span class="req">*</span></label>
									<div class="form_input">
										<select name="IsActive" id="IsActive" data-required="required" data-message="Choose IsActive Status" class="chzn-select custom-select" tabindex="24">
										<option value="">Select</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
										</select>
									</div>
								</div>
								<br /><br /><br />
								</li>
								
                                <li>
								<div class="form_grid_12">
									<div class="form_input">
                         				<input type="hidden" id="Id" name="Id"/>
										<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="25"><span>Update</span></button>
										<button type="reset" class="btn_small btn_blue" tabindex="26"><span>Reset</span></button>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
									</div>
								</div>
								</li>
							</ul>
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php include('includes/footer.php');?>
<script src="js/subjcombinations_edit.js"></script>