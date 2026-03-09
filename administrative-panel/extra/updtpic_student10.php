<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		if($_FILES['PicURL']['name'] != "" && $_REQUEST['newcheckbox'] == 1){
		
			if($_REQUEST['IsRegular'] == 1)
			{
				//generating serial no
				$serial_code=$_REQUEST['StdInstituteCode'].$RegY;
				$sql1="SELECT MAX(substring(PicURL,8,10)) AS MaxSerial FROM students10 WHERE substring(PicURL,8,10) like '".$serial_code."%'";
				$res1=mysql_query($sql1, $conn1);
				$row1=mysql_fetch_array($res1);
				
				$serial_part=substr($row1['MaxSerial'],6);
				$serial_part=$serial_part+1;
				$serial_no=$serial_code.str_pad($serial_part,4,'0',STR_PAD_LEFT);
				$target_path_image1 = 'pics10/'.$serial_no.'.jpg';
				$target_path_image2 = '../institution-panel/'.'pics10/'.$serial_no.'.jpg';
				
				$image_type = pathinfo($_FILES["PicURL"]["name"],PATHINFO_EXTENSION);
				$tmp_image = $_FILES['PicURL']['tmp_name'];
				//move_uploaded_file($tmp_image, $target_path_image2);
				list($width,$height) = getimagesize($tmp_image);
				$newwidth = 190; $newheight = 230;
				//$newwidth = 300; $newheight = 350;
				$thumb = imagecreatetruecolor($newwidth, $newheight);
				
				if($image_type == 'jpg' || $image_type == 'JPG' || $image_type == 'jpeg' || $image_type == 'JPEG')
				{
					$source = imagecreatefromjpeg($tmp_image);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					imagejpeg($thumb, $target_path_image2, 100); // 100 Represents the quality of an image. Default quality is 75
				}
				
				else if($image_type == 'png' || $image_type == 'PNG')
				{
					$source = imagecreatefrompng($tmp_image);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					imagepng($thumb, $target_path_image2, 9); // 100 Represents the quality of an image. Default quality is 75
				}
				
				else if($image_type == 'gif' || $image_type == 'GIF')
				{
					$source = imagecreatefromgif($tmp_image);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					imagegif($thumb, $target_path_image2, 100); // 100 Represents the quality of an image. Default quality is 75
				}
				
				$out_image = addslashes(file_get_contents($target_path_image2));
			}//if($_REQUEST['IsRegular'] == 1)
			else
			{
				//generating serial no
				$serial_code='99'.str_pad($_REQUEST['Domicile'],2,'0',STR_PAD_LEFT).$RegY;
				$sql1="SELECT MAX(substring(PicURL,8,10)) AS MaxSerial FROM students10 WHERE substring(PicURL,8,10) like '".$serial_code."%'";
				$res1=mysql_query($sql1, $conn1);
				$row1=mysql_fetch_array($res1);
				
				$serial_part=substr($row1['MaxSerial'],6);
				$serial_part=$serial_part+1;
				$serial_no=$serial_code.str_pad($serial_part,4,'0',STR_PAD_LEFT);
				$target_path_image1 = 'pics10/'.$serial_no.'.jpg';
				$target_path_image2 = '../institution-panel/'.'pics10/'.$serial_no.'.jpg';
				
				$image_type = pathinfo($_FILES["PicURL"]["name"],PATHINFO_EXTENSION);
				$tmp_image = $_FILES['PicURL']['tmp_name'];
				//move_uploaded_file($tmp_image, $target_path_image2);
				list($width,$height) = getimagesize($tmp_image);
				$newwidth = 190; $newheight = 230;
				//$newwidth = 300; $newheight = 350;
				$thumb = imagecreatetruecolor($newwidth, $newheight);
				
				if($image_type == 'jpg' || $image_type == 'JPG' || $image_type == 'jpeg' || $image_type == 'JPEG')
				{
					$source = imagecreatefromjpeg($tmp_image);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					imagejpeg($thumb, $target_path_image2, 100); // 100 Represents the quality of an image. Default quality is 75
				}
				
				else if($image_type == 'png' || $image_type == 'PNG')
				{
					$source = imagecreatefrompng($tmp_image);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					imagepng($thumb, $target_path_image2, 9); // 100 Represents the quality of an image. Default quality is 75
				}
				
				else if($image_type == 'gif' || $image_type == 'GIF')
				{
					$source = imagecreatefromgif($tmp_image);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					imagegif($thumb, $target_path_image2, 100); // 100 Represents the quality of an image. Default quality is 75
				}
				
				$out_image = addslashes(file_get_contents($target_path_image2));
			}//else if($_REQUEST['IsRegular'] == 1)
		}//if($_FILES['PicURL']['name'] != "" && $_REQUEST['newcheckbox'] == 1)
		
		else if($_FILES['PicURL']['name'] != "" && $_REQUEST['newcheckbox'] == ""){
		
			if($_REQUEST['IsRegular'] == 1)
			{
				$int_length = count(array_filter(str_split($_REQUEST['PicURL1']),'is_numeric'));
				
				if((strpos($_REQUEST['PicURL1'], 'pics10/') !== false) && ($int_length == 12))
				{
					$target_path_image1 = $_REQUEST['PicURL1'];
					$target_path_image2 = '../institution-panel/'.$_REQUEST['PicURL1'];
				}
				else
				{
					//generating serial no
					$serial_code=$_REQUEST['StdInstituteCode'].$RegY;
					$sql1="SELECT MAX(substring(PicURL,8,10)) AS MaxSerial FROM students10 WHERE substring(PicURL,8,10) like '".$serial_code."%'";
					$res1=mysql_query($sql1, $conn1);
					$row1=mysql_fetch_array($res1);
					
					$serial_part=substr($row1['MaxSerial'],6);
					$serial_part=$serial_part+1;
					$serial_no=$serial_code.str_pad($serial_part,4,'0',STR_PAD_LEFT);
					$target_path_image1 = 'pics10/'.$serial_no.'.jpg';
					$target_path_image2 = '../institution-panel/'.'pics10/'.$serial_no.'.jpg';
				}
				
				$image_type = pathinfo($_FILES["PicURL"]["name"],PATHINFO_EXTENSION);
				$tmp_image = $_FILES['PicURL']['tmp_name'];
				//move_uploaded_file($tmp_image, $target_path_image2);
				list($width,$height) = getimagesize($tmp_image);
				$newwidth = 190; $newheight = 230;
				//$newwidth = 300; $newheight = 350;
				$thumb = imagecreatetruecolor($newwidth, $newheight);
				
				if($image_type == 'jpg' || $image_type == 'JPG' || $image_type == 'jpeg' || $image_type == 'JPEG')
				{
					$source = imagecreatefromjpeg($tmp_image);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					imagejpeg($thumb, $target_path_image2, 100); // 100 Represents the quality of an image. Default quality is 75
				}
				
				else if($image_type == 'png' || $image_type == 'PNG')
				{
					$source = imagecreatefrompng($tmp_image);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					imagepng($thumb, $target_path_image2, 9); // 100 Represents the quality of an image. Default quality is 75
				}
				
				else if($image_type == 'gif' || $image_type == 'GIF')
				{
					$source = imagecreatefromgif($tmp_image);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					imagegif($thumb, $target_path_image2, 100); // 100 Represents the quality of an image. Default quality is 75
				}
				
				$out_image = addslashes(file_get_contents($target_path_image2));
			}//if($_REQUEST['IsRegular'] == 1)
			else
			{
				$int_length = count(array_filter(str_split($_REQUEST['PicURL1']),'is_numeric'));
				
				if((strpos($_REQUEST['PicURL1'], 'pics10/') !== false) && ($int_length == 12))
				{
					$target_path_image1 = $_REQUEST['PicURL1'];
					$target_path_image2 = '../institution-panel/'.$_REQUEST['PicURL1'];
				}
				else
				{
					//generating serial no
					$serial_code='99'.str_pad($_REQUEST['Domicile'],2,'0',STR_PAD_LEFT).$RegY;
					$sql1="SELECT MAX(substring(PicURL,8,10)) AS MaxSerial FROM students10 WHERE substring(PicURL,8,10) like '".$serial_code."%'";
					$res1=mysql_query($sql1, $conn1);
					$row1=mysql_fetch_array($res1);
					
					$serial_part=substr($row1['MaxSerial'],6);
					$serial_part=$serial_part+1;
					$serial_no=$serial_code.str_pad($serial_part,4,'0',STR_PAD_LEFT);
					$target_path_image1 = 'pics10/'.$serial_no.'.jpg';
					$target_path_image2 = '../institution-panel/'.'pics10/'.$serial_no.'.jpg';
				}
				
				$image_type = pathinfo($_FILES["PicURL"]["name"],PATHINFO_EXTENSION);
				$tmp_image = $_FILES['PicURL']['tmp_name'];
				//move_uploaded_file($tmp_image, $target_path_image2);
				list($width,$height) = getimagesize($tmp_image);
				$newwidth = 190; $newheight = 230;
				//$newwidth = 300; $newheight = 350;
				$thumb = imagecreatetruecolor($newwidth, $newheight);
				
				if($image_type == 'jpg' || $image_type == 'JPG' || $image_type == 'jpeg' || $image_type == 'JPEG')
				{
					$source = imagecreatefromjpeg($tmp_image);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					imagejpeg($thumb, $target_path_image2, 100); // 100 Represents the quality of an image. Default quality is 75
				}
				
				else if($image_type == 'png' || $image_type == 'PNG')
				{
					$source = imagecreatefrompng($tmp_image);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					imagepng($thumb, $target_path_image2, 9); // 100 Represents the quality of an image. Default quality is 75
				}
				
				else if($image_type == 'gif' || $image_type == 'GIF')
				{
					$source = imagecreatefromgif($tmp_image);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					imagegif($thumb, $target_path_image2, 100); // 100 Represents the quality of an image. Default quality is 75
				}
				
				$out_image = addslashes(file_get_contents($target_path_image2));
			}//else if($_REQUEST['IsRegular'] == 1)
		}//else if($_FILES['PicURL']['name'] != "" && $_REQUEST['newcheckbox'] == "")
		
		$sql="UPDATE students10 SET
		PicURL				=		'".$target_path_image1."'
		WHERE Id			=		".$_REQUEST['Id']."";
		
		if(mysql_query($sql, $conn1))
		{
			$ins="INSERT INTO tbl_piilog SET
			ActivityType			=		'PicInfoUpdation-II',
			ActivityRefNo			=		'".$_REQUEST['ActivityRefNo']."',
			StudentId				=		".$_REQUEST['Id'].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn1);
			
			?><script>alert('Student Updated Successfully.');location.replace('allstudents_edit10.php');</script><?php
		}
		else
		{
			?><script>alert('Error in Query.');location.replace('updtpic_student10.php?Id=<?php echo $_REQUEST['Id'];?>');</script><?php
		}
	}
	?>
	<?php
	$sql="SELECT Id, Name, FatherName, PicURL, Domicile, IsRegular, StdInstituteCode FROM vwadmstudents10 WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Update Picture</h6>
					</div>

					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();" enctype="multipart/form-data">
						<input name="IsRegular" id="IsRegular" type="hidden" value="<?php echo $row['IsRegular'];?>"/>
						<input name="StdInstituteCode" id="StdInstituteCode" type="hidden" value="<?php echo $row['StdInstituteCode'];?>"/>
						<input name="Domicile" id="Domicile" type="hidden" value="<?php echo $row['Domicile'];?>"/>
							<ul>
								<li>
								<fieldset>
									<legend>Picture Info</legend>
									<ul>
										<li>
										<div class="form_grid_6">
											<label class="field_title">Student Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="Name" id="Name" type="text" value="<?php echo $row['Name'];?>" class="x_large" disabled/>
											</div>
										</div>
										<div class="form_grid_6">
											<label class="field_title">Father's Name<span class="req">*</span></label>
											<div class="form_input">
												<input name="FatherName" id="FatherName" type="text" value="<?php echo $row['FatherName'];?>" class="x_large" disabled/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Picture<span class="req">*</span></label>
											<div class="form_input">
												<input name="PicURL" id="PicURL" type="file" accept="image/*" onchange="loadFile(event)" tabindex="1"/>
												<input name="PicURL1" type="hidden" value="<?php echo $row['PicURL'];?>"/>
												<img id="Output" style="height:125px; width:100px;"/>
											</div>
										</div>
										<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
										</li>
										
										<?php if($_SESSION['emp_id']==1){?>
										<li>
										<div class="form_grid_6">
											<label class="field_title">New PicName</label>
											<div class="form_input">
												<input name="newcheckbox" id="newcheckbox" type="checkbox" value="1"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										<?php }?>
										
										<li>
										<div class="form_grid_6">
											<label class="field_title">Letter No<span class="req">*</span></label>
											<div class="form_input">
												<input name="ActivityRefNo" id="ActivityRefNo" type="text" data-required="required" data-message="Enter Letter No" class="x_large" maxlength="50" tabindex="2"/>
											</div>
										</div>
										<br /><br /><br />
										</li>
										
										<li>
										<div class="form_grid_12">
											<div class="form_input">
												<input type="hidden" name="Id" id="Id" value="<?php echo $_REQUEST['Id'];?>"/>
												<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="3"><span>Update</span></button>
												<button type="button" name="reset" class="btn_small btn_blue" onclick="location.replace('updtpic_student10.php?Id=<?php echo $_REQUEST['Id'];?>')" tabindex="4"><span>Reset</span></button>
											</div>
										</div>
										</li>
									</ul>
								</fieldset>
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
<script>
function check_submit_form()
{
	var PicURL=document.getElementById('PicURL').value;
	
	if(!Validate($(".form_container"))){ return false; }
	if(PicURL==''){ alert('Upload Picture'); document.getElementById('PicURL').focus(); return false; }
}//check_submit_form()
</script>
<script type="text/javascript" src="js/record-updation110new.js"></script>