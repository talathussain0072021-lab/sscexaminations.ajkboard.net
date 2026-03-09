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
						<h6>SSC(Part-II) Records</h6>
					</div>

					<div class="widget_content">
						<div class="invoice_action_bar" style="float: right;">
							<div class="btn_30_blue"><a href="sscrecords10_add.php"><span class="icon add_co"></span><span class="btn_link">Add Record</span></a></div>
						</div>
						<div class="invoice_action_bar" style="float: left;">
							<form method="post">
							<table class="search">
							<tr>
								<td><strong>PYear:</strong></td>
								<td><input name="PYear" id="PYear" type="text" value="<?php echo $_REQUEST['PYear'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="2" tabindex="1"/></td>
								<td><strong>PRollNo:</strong></td>
								<td><input name="PRollNo" id="PRollNo" type="text" value="<?php echo $_REQUEST['PRollNo'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="6" tabindex="2"/></td>
								<td><strong>PSession:</strong></td>
								<td>
									<select name="PSession" id="PSession" data-placeholder="Select Session" class="chzn-select admin-select" tabindex="3"/>
									<option value="">Select</option>
									<option value="1" <?php echo (($_REQUEST['PSession']==1)?'selected':'');?>>1st Annual</option>
									<option value="2" <?php echo (($_REQUEST['PSession']==2)?'selected':'');?>>2nd Annual</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><strong>PRegNo:</strong></td>
								<td><input name="PRegNo" id="PRegNo" type="text" value="<?php echo $_REQUEST['PRegNo'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="11" tabindex="4"/></td>
								<td><strong>Student Name:</strong></td>
								<td><input name="Name" id="Name" type="text" value="<?php echo $_REQUEST['Name'];?>" class="admin-select limiter" tabindex="5"/></td>
							</tr>
							<tr>
								<td><input type="submit" name="search" id="search" value="Search" tabindex="6"/></td>
								<td colspan="5" align="right"></td>
							</tr>
							</table>
							</form>
						</div>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>ID</th>
							<th>PYear</th>
							<th>PRollNo</th>
							<th>PSession</th>
							<th>PRegNo</th>
							<th>Appear Code</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>PResult</th>
							<th>Attempt Limit</th>
							<th>Remarks</th>
							<th>Edit-All</th>
							<th>Edit-Remarks</th>
						</tr>	
						</thead>
						<tbody>
						<?php
						if(isset($_REQUEST['search']))
						{
							$SrNo=1;
							$sql="SELECT ID, EXAM_YEAR, ROLL_NO, EXAM_SESSION, GROUP_NAME, GENDER, NAME, FNAME, REG_NO, APPEAR_CODE, RESULT, ATTEMPT_LIMIT, REMARKS FROM vw_resultpii WHERE REG_NO is Not NULL";
							
							//filter for PYear
							if(isset($_REQUEST['PYear']) && $_REQUEST['PYear']!='')
							{ $sql.=" AND EXAM_YEAR='".$_REQUEST['PYear']."'"; }
							
							//filter for PRollNo
							if(isset($_REQUEST['PRollNo']) && $_REQUEST['PRollNo']!='')
							{ $sql.=" AND ROLL_NO='".$_REQUEST['PRollNo']."'"; }
							
							//filter for PSession
							if(isset($_REQUEST['PSession']) && $_REQUEST['PSession']!='')
							{ $sql.=" AND EXAM_SESSION='".$_REQUEST['PSession']."'"; }
							
							//filter for PRegNo
							if(isset($_REQUEST['PRegNo']) && $_REQUEST['PRegNo']!='')
							{ $sql.=" AND REG_NO='".$_REQUEST['PRegNo']."'"; }
							
							//filter for Name
							if(isset($_REQUEST['Name']) && $_REQUEST['Name']!='')
							{ $sql.=" AND NAME LIKE '".$_REQUEST['Name']."%'"; }
							
							$sql.=" ORDER BY ROLL_NO ASC";
							$res=mysql_query($sql, $conn_sscreslt);
							while($row=mysql_fetch_array($res))
							{
								if($row['EXAM_SESSION'] == 1){ $PSession='1st Annual'; }
								else if($row['EXAM_SESSION'] == 2){ $PSession='2nd Annual'; }
								else { $PSession=''; }
								
								if($row['GENDER'] == 1){ $Gender='Male'; }
								else if($row['GENDER'] == 2){ $Gender='Female'; }
								else { $Gender=''; }
							?>
							<tr>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['ID'];?></td>
								<td class="center"><?php echo $row['EXAM_YEAR'];?></td>
								<td class="center"><?php echo $row['ROLL_NO'];?></td>
								<td class="center"><?php echo $PSession;?></td>
								<td class="center"><?php echo $row['REG_NO'];?></td>
								<td class="center"><?php echo $row['APPEAR_CODE'];?></td>
								<td class="center"><?php echo $row['NAME'];?></td>
								<td class="center"><?php echo $row['FNAME'];?></td>
								<td class="center"><?php echo $Gender;?></td>
								<td class="center"><?php echo $row['GROUP_NAME'];?></td>
								<td class="center"><?php echo $row['RESULT'];?></td>
								<td class="center"><?php echo $row['ATTEMPT_LIMIT'];?></td>
								<td class="center"><?php echo $row['REMARKS'];?></td>
								<td class="center">
									<span><a class="action-icons c-edit" href="sscrecords10_edit1.php?Id=<?php echo $row['ID'];?>" title="Edit Result">Edit-All</a></span>
								</td>
								<td class="center">
									<span><a class="action-icons c-edit" href="sscrecords10_edit2.php?Id=<?php echo $row['ID'];?>" title="Edit Result">Edit-Remarks</a></span>
								</td>
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
							<th>PYear</th>
							<th>PRollNo</th>
							<th>PSession</th>
							<th>PRegNo</th>
							<th>Appear Code</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>PResult</th>
							<th>Attempt Limit</th>
							<th>Remarks</th>
							<th>Edit-All</th>
							<th>Edit-Remarks</th>
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