<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
    <?php
	if(isset($_REQUEST['submit']))
	{
		$sql="UPDATE pages SET title='".$_REQUEST['title']."',descp='".addslashes($_REQUEST['descp'])."' WHERE id='".$_REQUEST['id']."'";
		$res=mysql_query($sql, $conn1);
		?><script>location.replace('pages.php?message=Data Updated Succesfully.');</script><?php
	}
	?>
    <?php
	$sql="SELECT * FROM pages WHERE title='".str_replace('_',' ',$_REQUEST['name'])."'";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	?>
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						<h6>Edit Department</h6>
					</div>
					<div class="widget_content">
						<form action="" method="post" class="form_container left_label">
						  <ul>
                          		<li>
								<div class="form_grid_12">
									<label class="field_title">Page Title</label>
									<div class="form_input">
										<input name="title" type="text" value="<?php echo $row['title'];?>" class="limiter"/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Description <span class="label_intro">Page Data.</span></label>
									<div class="form_input">
										<textarea name="descp" class="input_grow" cols="100" rows="15" tabindex="5"><?php echo $row['descp'];?></textarea>
									</div>
								</div>
								</li>                                						
								<li>
								<div class="form_grid_12">
									<div class="form_input">
                                    	<input type="hidden" name="name" value="<?php echo $_REQUEST['name'];?>" />
                                    	<input type="hidden" name="id" value="<?php echo $row['id'];?>" />
										<button type="submit" name="submit" value="submit" class="btn_small btn_blue"><span>Submit</span></button>
										<button type="reset" class="btn_small btn_blue"><span>Reset</span></button>
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