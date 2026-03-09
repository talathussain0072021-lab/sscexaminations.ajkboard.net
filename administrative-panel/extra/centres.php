<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['action'])&&$_REQUEST['action']=='update')
	{
		if($_REQUEST['IsActive']==0){ $IsActive=1; }
		else if($_REQUEST['IsActive']==1){ $IsActive=0; }
		
		$sql_q="UPDATE centres SET
		IsActive	 	=		".$IsActive."
		WHERE Id	 	=		".$_REQUEST['Id']."";
		$res_q=mysql_query($sql_q, $conn1);
		
		?><script>location.replace('centres.php?message=Data Updated Successfully.');</script><?php
	}
	?>

	<div id="content">
		<div class="grid_container">
			<span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>All Centres</h6>
					</div>

					<div class="widget_content">
						
						<p class="dataTables_length" style="float: left; margin: 0px;"><br>List of All Centres.</p>
						<div class="invoice_action_bar" style="float: right;">
							<div class="btn_30_blue">
								<a href="centres_add.php"><span class="icon add_co"></span><span class="btn_link">Add Centre</span></a>
							</div>
						</div>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>ID</th>
							<th>Code</th>
							<th>Name</th>
							<th>Type</th>
							<th>IsGovt</th>
							<th>District</th>
							<th>IsActive</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$SrNo=1;
						$sql="SELECT * FROM centres ORDER BY Code ASC";
						$res=mysql_query($sql, $conn1);
						while($row=mysql_fetch_array($res))
						{
							if($row['Type'] == 1){ $Type='Boys'; }
							else if($row['Type'] == 2){ $Type='Girls'; }
							else if($row['Type'] == 3){ $Type='Co-Edu.'; }
							else { $Type=''; }
							
							if($row['IsGovt'] == 1){ $IsGovt='Yes'; }
							else if($row['IsGovt']== 0){ $IsGovt='No'; }
							
							$sql_districts="SELECT Name FROM districts WHERE Id=".$row['District']." ORDER BY Name ASC";
							$res_districts=mysql_query($sql_districts, $conn1);
							$row_districts=mysql_fetch_array($res_districts);
						?>
						<tr>
							<td class="center"><?php echo $SrNo;?></td>
							<td class="center"><?php echo $row['Id'];?></td>
							<td class="center"><?php echo $row['Code'];?></td>
							<td class="left"><?php echo $row['Name'];?></td>
							<td class="center"><?php echo $Type;?></td>
							<td class="center"><?php echo $IsGovt;?></td>
							<td class="center"><?php echo $row_districts['Name'];?></td>
							<td class="center">
							<?php if($row['IsActive'] == 1){?><a href="javascript:;" onClick="if(confirm('Are you sure you want to Deactive this?')){update_status('<?php echo $row['Id'];?>','<?php echo $row['IsActive'];?>');}"><span class="badge_style b_done">Yes</span></a>
							<?php }	else{?><a href="javascript:;" onClick="if(confirm('Are you sure you want to Active this?')){update_status('<?php echo $row['Id'];?>','<?php echo $row['IsActive'];?>');}"><span class="badge_style b_pending">No</span></a><?php }?>
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="centres_edit.php?Id=<?php echo $row['Id'];?>" title="Edit">Edit</a></span><!--<span><a class="action-icons c-delete" onClick="return confirm('Are you sure you want to delete this?');" href="centres_delete.php?Id=<?php echo $row['Id'];?>" title="Delete">Delete</a></span>--><span><a class="action-icons c-approve" href="centres_view.php?Id=<?php echo $row['Id'];?>" title="View">View</a></span>
							</td>
						</tr>
						<?php
						$SrNo++;
						}?>
						</tbody>
						<tfoot>
						<tr>
							<th>SrNo</th>
							<th>ID</th>
							<th>Code</th>
							<th>Name</th>
							<th>Type</th>
							<th>IsGovt</th>
							<th>District</th>
							<th>IsActive</th>
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
function update_status(Id,IsActive)
{
	location.replace('centres.php?Id='+Id+'&IsActive='+IsActive+'&action=update');
}
</script>