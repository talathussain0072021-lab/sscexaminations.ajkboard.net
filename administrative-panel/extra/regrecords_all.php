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
						<h6>SSC Registration Records</h6>
					</div>

					<div class="widget_content">
						<?php if(in_array('50101',$_SESSION['emp_user_rights'])){?>
						<div class="invoice_action_bar" style="float: right;">
							<div class="btn_30_blue"><a href="regrecords_add.php"><span class="icon add_co"></span><span class="btn_link">Add Record</span></a></div>
						</div>
						<?php }?>
						
						<div class="invoice_action_bar" style="float: left;">
							<form method="post">
							<table class="search">
							<tr>	
								<td><strong>Reg Year:</strong></td>
								<td><input name="RegYear" id="RegYear" type="text" value="<?php echo $_REQUEST['RegYear'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="2" tabindex="1"/></td>
								<td><strong>Reg Session:</strong></td>
								<td>
									<select name="RegSessionName" Id="RegSessionName" data-placeholder="Select Session" class="chzn-select admin-select" tabindex="2"/>
									<option value="">Select</option>
									<?php
									$sql_1="SELECT DISTINCT(RegSessionName) FROM tbl_sscregistration ORDER BY RegSessionName ASC";
									$res_1=mysql_query($sql_1, $conn_sscreg);
									while($row_1=mysql_fetch_array($res_1))								
									{
										echo '<option value='.$row_1['RegSessionName'].' '.(($_REQUEST['RegSessionName']==$row_1['RegSessionName'])?'selected':'').'>'.$row_1['RegSessionName'].'</option>';
									}
									?>
									</select>
								</td>
								<td><strong>Reg Institute:</strong></td>
								<td>
									<select name="RegInstCode" Id="RegInstCode" data-placeholder="Select Institute" class="chzn-select admin-select" tabindex="3"/>
									<option value="">Select</option>
									<?php
									$sql_2="SELECT DISTINCT(RegInstCode) FROM tbl_sscregistration ORDER BY RegInstCode ASC";
									$res_2=mysql_query($sql_2, $conn_sscreg);
									while($row_2=mysql_fetch_array($res_2))								
									{
										echo '<option value='.$row_2['RegInstCode'].' '.(($_REQUEST['RegInstCode']==$row_2['RegInstCode'])?'selected':'').'>'.$row_2['RegInstCode'].'</option>';
									}
									?>
									</select>
								</td>
							</tr>
							<tr>
								<td><strong>RegNo:</strong></td>
								<td><input name="RegNo" id="PRegNo" type="text" value="<?php echo $_REQUEST['RegNo'];?>" class="admin-select limiter" maxlength="11" tabindex="4"/></td>
								<td><strong>Student Name:</strong></td>
								<td><input name="Name" id="Name" type="text" value="<?php echo $_REQUEST['Name'];?>" class="admin-select limiter" tabindex="5"/></td>
								<td><strong>Father Name:</strong></td>
								<td><input name="FatherName" id="FatherName" type="text" value="<?php echo $_REQUEST['FatherName'];?>" class="admin-select limiter" tabindex="6"/></td>
							</tr>
							<tr>
								<td><strong>CNIC:</strong></td>
								<td><input name="CNIC" id="CNIC" type="text" value="<?php echo $_REQUEST['CNIC'];?>" class="admin-select limiter" maxlength="15" tabindex="7"/></td>
								<td><input type="submit" name="search" id="search" value="Search" tabindex="8"/></td>
								<td colspan="3"></td>
							</tr>
							</table>
							</form>
						</div>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>ID</th>
							<th>RegYear</th>
							<th>RegSession</th>
							<th>RegInst</th>
							<th>RegNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>DOB</th>
							<th>CNIC</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Combination</th>
							<th>Action</th>
							<th>Print</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_REQUEST['search']))
						{
							$SrNo=1;
							$sql="SELECT Id, RegYear, RegSessionName, RegInstCode, RegNo, Name, FatherName, DOB, CNIC, Gender, GroupName, CombinationName FROM tbl_sscregistration WHERE RegNo is Not NULL";
							
							if(isset($_REQUEST['RegYear']) && $_REQUEST['RegYear']!='')
							{ $sql.=" AND RegYear='".$_REQUEST['RegYear']."'"; }
							
							if(isset($_REQUEST['RegSessionName']) && $_REQUEST['RegSessionName']!='')
							{ $sql.=" AND RegSessionName='".$_REQUEST['RegSessionName']."'"; }
							
							if(isset($_REQUEST['RegInstCode']) && $_REQUEST['RegInstCode']!='')
							{ $sql.=" AND RegInstCode='".$_REQUEST['RegInstCode']."'"; }
							
							if(isset($_REQUEST['RegNo']) && $_REQUEST['RegNo']!='')
							{ $sql.=" AND RegNo='".$_REQUEST['RegNo']."'"; }
							
							if(isset($_REQUEST['Name']) && $_REQUEST['Name']!='')
							{ $sql.=" AND Name LIKE '".$_REQUEST['Name']."%'"; }
							
							if(isset($_REQUEST['FatherName']) && $_REQUEST['FatherName']!='')
							{ $sql.=" AND FatherName LIKE '".$_REQUEST['FatherName']."%'"; }
							
							if(isset($_REQUEST['CNIC']) && $_REQUEST['CNIC']!='')
							{ $sql.=" AND CNIC='".$_REQUEST['CNIC']."'"; }
							
							$res=mysql_query($sql, $conn_sscreg);
							while($row=mysql_fetch_array($res))
							{
								if($row['Gender'] == 1){ $Gender='Male'; }
								else if($row['Gender'] == 2){ $Gender='Female'; }
								else { $Gender=''; }
							?>
							<tr>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['Id'];?></td>
								<td class="center"><?php echo $row['RegYear'];?></td>
								<td class="center"><?php echo $row['RegSessionName'];?></td>
								<td class="center"><?php echo $row['RegInstCode'];?></td>
								<td class="center"><?php echo $row['RegNo'];?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td class="center"><?php echo $row['FatherName'];?></td>
								<td class="center"><?php echo date('d-m-Y', strtotime($row['DOB']));?></td>
								<td class="center"><?php echo $row['CNIC'];?></td>
								<td class="center"><?php echo $Gender;?></td>
								<td class="center"><?php echo $row['GroupName'];?></td>
								<td class="center"><?php echo $row['CombinationName'];?></td>
								<td class="center">
								<?php if(in_array('50102',$_SESSION['emp_user_rights'])){?>
									<span><a class="action-icons c-edit" href="regrecords_edit.php?RegNo=<?php echo $row['RegNo'];?>" title="Edit">Edit</a></span>
									<span><a class="action-icons c-delete" href="regrecords_delete.php?RegNo=<?php echo $row['RegNo'];?>" title="">Delete</a></span>
								<?php }?>
								</td>
								<td class="center">
								<?php if(in_array('50103',$_SESSION['emp_user_rights'])){?>
									<a href="print_stdregcard.php?RegNo=<?php echo $row['RegNo'];?>" target="_blank"><span class="badge_style b_medium">Reg. Card</span></a></td>
								<?php }?>
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
							<th>ID</th>
							<th>RegYear</th>
							<th>RegSession</th>
							<th>RegInst</th>
							<th>RegNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>DOB</th>
							<th>CNIC</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Combination</th>
							<th>Action</th>
							<th>Print</th>
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