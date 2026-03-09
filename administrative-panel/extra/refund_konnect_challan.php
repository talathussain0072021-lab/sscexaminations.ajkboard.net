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
						<h6>Search Konnect Challan</h6>
					</div>

					<div class="widget_content">
						
						<form method="post">
						<table class="search">
						<tr>
							<td><strong>Challan No:</strong></td>
							<td><input name="ChallanNo" id="ChallanNo" type="text" value="<?php echo $_REQUEST['ChallanNo'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="12" tabindex="1"/></td>
							<td><strong>Student Name:</strong></td>
							<td><input name="Name" id="Name" type="text" value="<?php echo $_REQUEST['Name'];?>" class="admin-select limiter" tabindex="2"/></td>
							<td><strong>Agent ID:</strong></td>
							<td>
								<input name="AgentID" id="AgentID" type="text" value="<?php echo $_REQUEST['AgentID'];?>" class="admin-select" onkeypress="return isNumber()" maxlength="10" tabindex="3"/>
							</td>
							
						</tr>	
						<tr>
							<td colspan="6"><input type="submit" name="search" id="search" value="Search" tabindex="4"/></td>
						</tr>
						</table>
						</form>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>Dated</th>
							<th>Challan No</th>
							<th>Name</th>
							<th>Amount</th>
							<th>Channel</th>
							<th>AgentID</th>
							<th>Transaction Date</th>
							<th>Transaction Time</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_REQUEST['search']))
						{
							$SrNo=1;
							$sql="SELECT CH.`Dated`, CH.`ChallanCategory`, CH.`ChallanAmount`, CH.`DueDate`, CH.`InstituteId`, CH.`FeeStatus` as FeeStatus, CH.`KonnectPaymentID`, HBL.`AgentID`, HBL.`TranID`, HBL.`ChallanNo`, HBL.`Name`, HBL.`Amount`, HBL.`Channel`, HBL.`Tran_Date`, HBL.`Tran_Time`
FROM challans as CH
INNER JOIN konnect_log as HBL ON CH.`ChallanNo`=HBL.`ChallanNo`";
							//filter for ChallanNo
							if(isset($_REQUEST['ChallanNo']) && $_REQUEST['ChallanNo']!='')
							{ $sql.=" AND HBL.ChallanNo=".$_REQUEST['ChallanNo'].""; }
							
							//filter for Name
							if(isset($_REQUEST['Name']) && $_REQUEST['Name']!='')
							{ $sql.=" AND HBL.Name LIKE '".$_REQUEST['Name']."%'"; }
							
							//filter for AgentID
							if(isset($_REQUEST['AgentID']) && $_REQUEST['AgentID']!='')
							{ $sql.=" AND HBL.AgentID=".$_REQUEST['AgentID'].""; }
							
							$sql.=" ORDER BY HBL.ID ASC";
							$res=mysql_query($sql, $conn1);
							while($row=mysql_fetch_array($res))
							{
							?>
							<tr>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['Dated'];?></td>
								<td class="center"><?php echo $row['ChallanNo'];?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td class="center"><?php echo $row['Amount'];?></td>
								<td class="center"><?php echo $row['Channel'];?></td>
								<td class="center"><?php echo $row['AgentID'];?></td>
								<td class="center"><?php echo $row['Tran_Date'];?></td>
								<td class="center"><?php echo $row['Tran_Time'];?></td>
								<td class="center">
								<?php if($row['FeeStatus'] == 1){?><span class="badge_style b_done">PAID</span>
								<?php }	else{?><span class="badge_style b_pending">UNPAIN</span><?php }?>
								</td>
								<td class="center"></td>
							</tr>
							<?php
							$SrNo++;
							}
						}//if(isset($_REQUEST['search']))
						?>
						</tbody>
						<tfoot>
						<tr>
							<th>SrNo</th>
							<th>Dated</th>
							<th>Challan No</th>
							<th>Name</th>
							<th>Amount</th>
							<th>Channel</th>
							<th>AgentID</th>
							<th>Transaction Date</th>
							<th>Transaction Time</th>
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