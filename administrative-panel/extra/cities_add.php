<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{	
		$sql1="SELECT * FROM cities WHERE title='".$_REQUEST['title']."'";
		$res1=mysql_query($sql1, $conn1);
		$no_row1=mysql_num_rows($res1);
		if($no_row1 > 0)
		{
			echo "<script>"; echo "alert('City already exists.')"; echo "</script>";
		}
		else
		{
			$sql="INSERT INTO cities SET 
			title		=		'".$_REQUEST['title']."'";
			$res=mysql_query($sql, $conn1);
			
			?><script>location.replace('cities.php?message=Data Inserted Successfully.');</script><?php
		}
	}
	?>
<script>	
function check_submit_form()
{
	var city=document.getElementById('title').value;	
	
	if(city==''){ alert('Enter City Name'); return false; }		
}//check_submit_form()
</script>	
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Add City</h6>
					</div>
					
					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();">
						  <ul>                          		
								<li>
								<div class="form_grid_12">
									<label class="field_title">City<span class="req">*</span></label>
									<div class="form_input">
										<input name="title" id="title" type="text" class="limiter" maxlength="30" tabindex="1"/>
										<span class="input_instruction green">Enter Complete City Name.</span>
									</div>
								</div>
								</li>
								                                                                						
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="2"><span>Submit</span></button>
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