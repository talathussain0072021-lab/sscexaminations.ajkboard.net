<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php $parent=(isset($_REQUEST['id'])?$_REQUEST['id']:0);?>
	<div id="content">
		<div class="grid_container">
			<span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Departments</h6>
					</div>
					
					<div class="widget_content">
						<p class="dataTables_length" style="float: left; margin: 0px;">
                        <br>
						</p>
						<div class="invoice_action_bar" style="float: right;">
							<div class="btn_30_blue">
								<a href="departments_add.php?parent=<?php echo $parent;?>"><span class="icon add_co"></span><span class="btn_link">Add Department</span></a>
							</div>
						</div>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>Department</th>
						<!--<th>Description</th>-->
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						$srno=1;
						$sql="SELECT * FROM departments WHERE parent='".$parent."' ORDER BY id ASC";
						$res=mysql_query($sql, $conn1);
						while($row=mysql_fetch_array($res))
						{?>
						<tr>
							<td align="center"><?php echo $srno;?></td>
							<td align="center"><a href="employees.php?department=<?php echo $row['id'];?>"><?php echo $row['title'];?></a></td>
						<!--<td><?php echo $row['descp'];?></td>-->
							<td class="center">
								<span><a class="action-icons c-edit" href="departments_edit.php?id=<?php echo $row['id'];?>&parent=<?php echo $parent;?>" title="Edit">Edit</a></span><span><a class="action-icons c-delete" onClick="return confirm('Are you sure you want to delete this?');" href="departments_delete.php?id=<?php echo $row['id'];?>&parent=<?php echo $parent;?>" title="Delete">Delete</a></span><!--<span><a class="action-icons c-approve" href="department_view.php?id=<?php echo $row['id'];?>&parent=<?php echo $parent;?>" title="View">View</a></span>-->
							</td>
						</tr>
						<?php
						$srno++;
						}?>						
						</tbody>
						<tfoot>
						<tr>
							<th>SrNo</th>
							<th>Department</th>
						<!--<th>Description</th>-->
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