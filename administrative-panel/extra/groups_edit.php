<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
    <?php
	if(isset($_REQUEST['submit']))
	{
		$sql1="SELECT * FROM groups WHERE group_title='".$_REQUEST['title']."' || group_code='".$_REQUEST['code']."'";
		$res1=mysql_query($sql1, $conn1);
		$no_row1=mysql_num_rows($res1);
		if($no_row1 > 0 && ($_REQUEST['code']!=$_REQUEST['code1'] || $_REQUEST['title']!=$_REQUEST['title1']))
		{
		echo "<script>"; echo "alert('Group already exists.')"; echo "</script>";
		}
		else
		{
		$sql="UPDATE groups SET 
		group_code		=		'".$_REQUEST['code']."', 
		group_title		=		'".$_REQUEST['title']."',
		group_fee		=		'".$_REQUEST['fee']."'
		WHERE group_id		=	'".$_REQUEST['id']."'";
		$res=mysql_query($sql, $conn1);
		
		?><script>location.replace('groups.php?message=Data Updated Succesfully.');</script><?php
		}
	}
	?>
    <?php
	$sql="SELECT * FROM groups WHERE group_id='".$_REQUEST['id']."'";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	?>
	
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Update Group</h6>
					</div>
					<div class="widget_content">
						<form action="" method="post" class="form_container left_label" onSubmit="return check_form();">
						  <ul>                          		
								<li>
								<div class="form_grid_12">
									<label class="field_title">Group Code<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<input name="code" id="code" type="text" value="<?php echo $row['group_code'];?>" class="limiter" onkeypress="return isNumber()" maxlength="2" tabindex="1" required/>
										<input name="code1" id="code1" type="hidden" value="<?php echo $row['group_code'];?>"/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Group Title<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<input name="title" id="title" type="text" value="<?php echo $row['group_title'];?>" class="limiter" maxlength="30" tabindex="2" required/>
										<input name="title1" id="title1" type="hidden" value="<?php echo $row['group_title'];?>"/>			
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Group Fee<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<input name="fee" id="fee" type="text" value="<?php echo $row['group_fee'];?>" class="limiter" onkeypress="return isNumber()" maxlength="10" tabindex="3" required/>
									</div>
								</div>
								</li>
								
                                <li>
								<div class="form_grid_12">
									<div class="form_input">
                         				<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
										<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
										<button type="reset" class="btn_small btn_blue" tabindex="5"><span>Reset</span></button>
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