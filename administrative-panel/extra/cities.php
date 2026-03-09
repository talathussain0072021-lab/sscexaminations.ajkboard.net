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
						<span></span>
						<h6>Cities</h6>
					</div>

					<div class="widget_content">
						<div class="invoice_action_bar" style="float: right;">
							<div class="btn_30_blue">
								<a href="cities_add.php"><span class="icon add_co"></span>
									<span class="btn_link">Add City</span>
								</a>
							</div>
						</div>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>City</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						
						<?php
						$srno=1; 
						$sql="SELECT * FROM cities ORDER BY id ASC";	
						$res=mysql_query($sql, $conn1);
						while($row=mysql_fetch_array($res))
						{?>
						<tr>
							<td align="center"><?php echo $srno;?></td>
							<td align="center"><a href="employees.php?city=<?php echo $row['id'];?>"><?php echo $row['title'];?></a></td>					
							<td class="center">
								<span><a class="action-icons c-edit" href="cities_edit.php?id=<?php echo $row['id'];?>" title="Edit">Edit</a></span><span><a class="action-icons c-delete" onClick="return confirm('Are you sure you want to delete this?');" href="cities_delete.php?id=<?php echo $row['id'];?>" title="Delete">Delete</a></span>
							</td>
						</tr>
						<?php
						$srno++;
						}?>						
						</tbody>
						<tfoot>
						<tr>
							<th>SrNo</th>
							<th>City</th>
							<th>Action</th>
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