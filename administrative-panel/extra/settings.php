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
						<h6>Settings</h6>
					</div>

					<div class="widget_content">                    								
                            <p class="dataTables_length" style="float: left; margin: 0px;">
                            	<br>List of All Settings.
                            </p>
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>Id</th>
							<th>Setting Name</th>
							<th>Description</th>
							<th>Update Time</th>
							<th>Value<br>(Editable)</th>
						</tr>
						</thead>
						<tbody>
                        <?php
						$sql="SELECT * FROM settings ORDER BY id ASC";
						
						$res=mysql_query($sql, $conn1);
						while($row=mysql_fetch_array($res))
						{?>
						<tr>
							<td><?php echo $row['id'];?></td>
							<td><a href="#"><?php echo $row['setting_name'];?></a></td>
							<td class="center"><?php echo $row['settings_descp'];?></td>
							<td class="center" id="username"><?php echo date(DATETIME_FORMAT,strtotime($row['dated']));?></td>
							<td class="center" id="setting_<?php echo $row['id'];?>" onClick="get_editable('setting_<?php echo $row['id'];?>','settings','id','<?php echo $row['id'];?>','setting_value','','','yes_alert');update_record('settings','id','<?php echo $row['id'];?>','dated','<?php echo date('Y-m-d H:i:s');?>','','no_alert');"><?php echo $row['setting_value'];?></td>
						</tr>
                        <?php
						}?>						
						</tbody>
						<tfoot>
						<tr>
							<th>Id</th>
							<th>Setting Name</th>
							<th>Description</th>
							<th>Update Time</th>
							<th>Value<br>(Editable)</th>
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