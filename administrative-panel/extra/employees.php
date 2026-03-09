<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	
	if(isset($_REQUEST['action'])&&$_REQUEST['action']=='update')
	{
		if($_REQUEST['emp_status']==0)
		{ $emp_status=1; }
		else if($_REQUEST['emp_status']==1)
		{ $emp_status=0; }
			
		$sql_q="UPDATE employees SET
		emp_status			=		'".$emp_status."'
		WHERE emp_id		=		'".$_REQUEST['emp_id']."'";
		$res_q=mysql_query($sql_q, $conn1);
		
		?><script>location.replace('employees.php?message=Data Updated Successfully.');</script><?php
	}
	?>

	<div id="content">
		<div class="grid_container">
			<span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Users</h6>
					</div>

					<div class="widget_content">
						<p class="dataTables_length" style="float: left; margin: 0px;">
						<br>List of All Users.
						</p>
						<div class="invoice_action_bar" style="float: right;">
							<div class="btn_30_blue">
								<a href="employees_add.php"><span class="icon add_co"></span><span class="btn_link">Add User</span></a>
							</div>
						</div>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>User Name</th>
							<th>Full Name</th>
							<th>Mobile #</th>
							<th>City</th>
							<th>Type</th>
							<th>Department</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						$srno=1;
						if(isset($_REQUEST['department']))
						{
							$sql="SELECT * FROM employees WHERE emp_id<>'1' AND emp_full_name!='' AND emp_department='".$_REQUEST['department']."' ORDER BY emp_id ASC";
						}
						else if(isset($_REQUEST['emp_post']))
						{
							$sql="SELECT * FROM employees WHERE emp_id<>'1' AND emp_full_name!='' AND emp_type='".$_REQUEST['emp_post']."' ORDER BY emp_id ASC";
						}
						else if(isset($_REQUEST['city']))
						{
							$sql="SELECT * FROM employees WHERE emp_id<>'1' AND emp_full_name!='' AND emp_city='".$_REQUEST['city']."' ORDER BY emp_id ASC";
						}
						else
						{
							$sql="SELECT * FROM employees WHERE emp_id<>'1' AND emp_full_name!='' ORDER BY emp_id ASC";
						}
						$res=mysql_query($sql, $conn1);
						while($row=mysql_fetch_array($res))
						{
							$sql_city="SELECT title FROM cities WHERE id='".$row['emp_city']."'";
							$res_city=mysql_query($sql_city, $conn1);
							$row_city=mysql_fetch_array($res_city);
							
							$sql_post="SELECT title FROM employee_type WHERE id='".$row['emp_type']."'";
							$res_post=mysql_query($sql_post, $conn1);
							$row_post=mysql_fetch_array($res_post);
							
							$sql_department="SELECT title FROM departments WHERE id='".$row['emp_department']."'";
							$res_department=mysql_query($sql_department, $conn1);
							$row_department=mysql_fetch_array($res_department);
							
						?>
						<tr>
							<td class="center"><?php echo $srno;?></td>
							<!--<td><a href="employee_view.php?emp_id=<?php echo $row['emp_id'];?>"><?php echo $row['emp_full_name'];?></a></td>-->
                            <td class="center"><?php echo $row['emp_user_name'];?></td>
							<td align="center"><?php echo $row['emp_full_name'];?></td>
							<td class="center"><?php echo $row['emp_mobile'];?></td>
							<td class="center"><?php echo $row_city['title'];?></td>
							<td class="center"><?php echo $row_post['title'];?></td>
							<td class="center"><?php echo $row_department['title'];?></td>
							<td class="center">
                        	<?php if($row['emp_status']=='1'){ ?><a href="javascript:;" onClick="if (confirm('Are you sure you want to Deactive this?')){update_status('<?php echo $row['emp_id'];?>','<?php echo $row['emp_status'];?>');}"><span class="badge_style b_done">Active</span></a><?php } else { ?><a href="javascript:;" onClick="if (confirm('Are you sure you want to Active this?')){update_status('<?php echo $row['emp_id'];?>','<?php echo $row['emp_status'];?>');}"><span class="badge_style b_pending">Deactivated</span></a><?php }?>                            	
                        	</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="employees_edit.php?emp_id=<?php echo $row['emp_id'];?>" title="Edit">Edit</a></span><span><a class="action-icons c-delete" onClick="return confirm('Are you sure you want to delete this?');" href="employees_delete.php?emp_id=<?php echo $row['emp_id'];?>" title="Delete">Delete</a></span><span><a class="action-icons c-approve" href="employees_view.php?emp_id=<?php echo $row['emp_id'];?>" title="View">View</a></span>
							</td>
						</tr>
						<?php
						$srno++;
						}?>						
						</tbody>
						<tfoot>
						<tr>
							<th>SrNo</th>
							<th>User Name</th>
							<th>Full Name</th>
							<th>Mobile #</th>
							<th>City</th>
							<th>Type</th>
							<th>Department</th>
							<th>Status</th>
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
<script>
function update_status(emp_id,emp_status)
{
	location.replace('employees.php?emp_id='+emp_id+'&emp_status='+emp_status+'&action=update');
}
</script>