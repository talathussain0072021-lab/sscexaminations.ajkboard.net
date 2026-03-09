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
						<h6>Registration Cards</h6>
					</div>

					<div class="widget_content">
						<form method="get">
						<table class="search">
						<tr>	
							<td><strong>Reg Year:</strong></td>
							<td><input name="RegYear" id="RegYear" type="text" value="<?php echo $_REQUEST['RegYear'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="2" tabindex="1"/></td>
							<td><strong>Reg Session:</strong></td>
							<td>
								<select name="RegSession" Id="RegSession" data-placeholder="Select Session" class="chzn-select admin-select" tabindex="2"/>
								<option value="">Select</option>
								<?php
								$sql_inst="SELECT Id, Name FROM sessions ORDER BY Id ASC";
								$res_inst=mysql_query($sql_inst, $conn1);
								while($row_inst=mysql_fetch_array($res_inst))								
								{
									echo '<option value='.$row_inst['Id'].' '.(($_REQUEST['RegSession']==$row_inst['Id'])?'selected':'').'>'.$row_inst['Name'].'</option>';
								}
								?>
								</select>
							</td>
							<td><strong>Reg Institute:</strong></td>
							<td>
								<select name="RegInst" Id="RegInst" data-placeholder="Select Institute" class="chzn-select admin-select" tabindex="3"/>
								<option value="">Select</option>
								<?php
								$sql_inst="SELECT Id, Code FROM institutes WHERE IsActive=1 ORDER BY Code ASC";
								$res_inst=mysql_query($sql_inst, $conn1);
								while($row_inst=mysql_fetch_array($res_inst))								
								{
									echo '<option value='.$row_inst['Code'].' '.(($_REQUEST['RegInst']==$row_inst['Code'])?'selected':'').'>'.$row_inst['Code'].'</option>';
								}
								?>
								</select>
							</td>
						</tr>
						<tr>							
							<td><strong>SSC RegNo:</strong></td>
							<td><input name="SSCRegNo" id="SSCRegNo" type="text" value="<?php echo $_REQUEST['SSCRegNo'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="12" tabindex="4"/></td>
							<td><strong>HSSC RegNo:</strong></td>
							<td><input name="RegNo" id="RegNo" type="text" value="<?php echo $_REQUEST['RegNo'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="12" tabindex="5"/></td>
							<td><strong>Student Name:</strong></td>
							<td><input name="Name" id="Name" type="text" value="<?php echo $_REQUEST['Name'];?>" class="admin-select limiter" tabindex="6"/></td>
						</tr>
						<tr>
							<td><input type="submit" name="search" value="Search" tabindex="7"/></td>
							<td colspan="5" align="right"></td>
						</tr>
						</table>
						</form>
                		
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>SSC RegNo</th>
							<th>HSSC RegNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Combination</th>
							<th>Institute Code</th>
							<th>Institute Name</th>
							<th>Session</th>
							<th>Print</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_REQUEST['search']))
						{
							$SrNo=1;
							$sql="SELECT reg.Id, reg.RegYear, reg.RegInst, reg.Gender, reg.RegNo, reg.Name, reg.FatherName, reg.SSCRegNo, sess.Name AS SessionName, inst.Name AS InstName, vwcomb.GroupName, vwcomb.Name AS CombinationName FROM inter_registration reg LEFT JOIN sessions sess ON reg.RegSession=sess.Id LEFT JOIN institutes inst ON RIGHT(reg.RegInst,3)=inst.Code LEFT JOIN vwsubcombinations vwcomb ON reg.CombinationId=vwcomb.Id WHERE reg.RegNo is Not NULL";
							
							if(isset($_REQUEST['RegYear']) && $_REQUEST['RegYear']!='')
							{ $sql.=" AND RegYear='".$_REQUEST['RegYear']."'"; }
							
							if(isset($_REQUEST['RegSession']) && $_REQUEST['RegSession']!='')
							{ $sql.=" AND RegSession=".$_REQUEST['RegSession'].""; }
							
							if(isset($_REQUEST['RegInst']) && $_REQUEST['RegInst']!='')
							{ $sql.=" AND RIGHT(reg.RegInst,3)='".$_REQUEST['RegInst']."'"; }
							
							if(isset($_REQUEST['SSCRegNo']) && $_REQUEST['SSCRegNo']!='')
							{ $sql.=" AND SSCRegNo='".$_REQUEST['SSCRegNo']."'"; }
							
							if(isset($_REQUEST['RegNo']) && $_REQUEST['RegNo']!='')
							{ $sql.=" AND RegNo='".$_REQUEST['RegNo']."'"; }
							
							if(isset($_REQUEST['Name']) && $_REQUEST['Name']!='')
							{ $sql.=" AND reg.Name LIKE '".$_REQUEST['Name']."%'"; }
							
							$sql.=" ORDER BY reg.Id ASC";
							$res=mysql_query($sql, $conn1);
							while($row=mysql_fetch_array($res))
							{
								if($row['Gender'] == 1 || $row['Gender'] == 3){ $Gender='Male'; }
								else if($row['Gender'] == 2 || $row['Gender'] == 4){ $Gender='Female'; }
								else { $Gender=''; }
							?>
							<tr>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['SSCRegNo'];?></td>
								<td class="center"><?php echo $row['RegNo'];?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td class="center"><?php echo $row['FatherName'];?></td>
								<td class="center"><?php echo $Gender;?></td>
								<td class="center"><?php echo $row['GroupName'];?></td>
								<td class="center"><?php echo $row['CombinationName'];?></td>
								<td class="center"><?php echo substr($row['RegInst'], -3);?></td>
								<td class="center"><?php echo $row['InstName'];?></td>
								<td class="center"><?php echo $row['SessionName'];?></td>
								<td class="center"><a href="print_stdregcard.php?RegNo=<?php echo $row['RegNo']; ?>" target="_blank"><span class="badge_style b_medium">Reg. Card</span></a></td>
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
							<th>SSC RegNo</th>
							<th>HSSC RegNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>Combination</th>
							<th>Institute Code</th>
							<th>Institute Name</th>
							<th>Session</th>
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