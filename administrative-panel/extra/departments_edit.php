<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql1="SELECT * FROM departments WHERE title='".$_REQUEST['title']."'";
		$res1=mysql_query($sql1, $conn1);
		$no_row1=mysql_num_rows($res1);
		if($no_row1 > 0)
		{
			echo "<script>"; echo "alert('Department already exists.')"; echo "</script>";
		}
		else
		{
			$sql="UPDATE departments SET 
			title			=	'".$_REQUEST['title']."',
			parent			=	'".$_REQUEST['parent']."'
			WHERE id		=	'".$_REQUEST['id']."'";
			$res=mysql_query($sql, $conn1);
			
			?><script>location.replace('departments.php?message=Data Updated Succesfully.');</script><?php
		}
	}
	?>
	<?php
	$sql="SELECT * FROM departments WHERE id='".$_REQUEST['id']."'";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	?>
<script>	
function check_submit_form()
{
	var department=document.getElementById('title').value;	
		
	if(department==''){ alert('Enter Department Name'); return false; }		
}//check_submit_form()
</script>	
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						<h6>Update Department</h6>
					</div>
					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();">
						  <ul>
                          		<li>
								<div class="form_grid_12">
									<label class="field_title">Department<span class="req">*</span></label>
									<div class="form_input">
										<input name="title" id="title" type="text" value="<?php echo $row['title'];?>" class="limiter" maxlength="30" tabindex="1"/>
									</div>
								</div>
								</li>
								
								<!--
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Description</label>
									<div class="form_input">
										<textarea name="descp" class="input_grow" cols="50" rows="5" tabindex="2"><?php echo $row['descp'];?></textarea>
									</div>
								</div>
								</li> 
								-->
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
                                    	<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
                                    	<input type="hidden" name="parent" value="<?php echo $_REQUEST['parent'];?>" />
										<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="2"><span>Update</span></button>
										<button type="reset" class="btn_small btn_blue" tabindex="3"><span>Reset</span></button>
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