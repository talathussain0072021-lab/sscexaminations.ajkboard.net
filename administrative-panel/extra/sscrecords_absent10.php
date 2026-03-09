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
						<h6>HSSC(Part-II) Absent</h6>
					</div>

					<div class="widget_content">
                    	
						<form method="get">
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
								<option value="1" <?php echo (($_REQUEST['PSession']==1)?'selected':'');?>>Annual</option>
								<option value="2" <?php echo (($_REQUEST['PSession']==2)?'selected':'');?>>Supply</option>
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
							<td><input type="submit" name="search" value="Search" tabindex="6"/></td>
							<td colspan="5" align="right"></td>
						</tr>							
						</table>
						</form>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>PYear</th>
							<th>PRollNo</th>
							<th>PSession</th>
							<th>PRegNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>PResult</th>
							<th>Attempt Limit</th>				
						</tr>
						</thead>
						<tbody>
                        <?php
						if(isset($_REQUEST['search']))
						{
							$SrNo=1;
							$sql="SELECT EXAM_SESSION, EXAM_YEAR, RNO, NAME, FNAME, REGNO, GROUPNAME, GENDER, RESULT, ATTEMPT_LIMIT FROM tblprvintact2 WHERE REGNO is Not NULL";
							
							//filter for PYear	
							if(isset($_REQUEST['PYear']) && $_REQUEST['PYear']!='')
							{ $sql.=" AND EXAM_YEAR='".$_REQUEST['PYear']."'"; }
							
							//filter for PRollNo	
							if(isset($_REQUEST['PRollNo']) && $_REQUEST['PRollNo']!='')
							{ $sql.=" AND RNO='".$_REQUEST['PRollNo']."'"; }
						
							//filter for PSession	
							if(isset($_REQUEST['PSession']) && $_REQUEST['PSession']!='')
							{ $sql.=" AND EXAM_SESSION='".$_REQUEST['PSession']."'"; }					
							
							//filter for PRegNo	
							if(isset($_REQUEST['PRegNo']) && $_REQUEST['PRegNo']!='')
							{ $sql.=" AND REGNO='".$_REQUEST['PRegNo']."'"; }
							
							//filter for Name
							if(isset($_REQUEST['Name']) && $_REQUEST['Name']!='')
							{ $sql.=" AND NAME LIKE '".$_REQUEST['Name']."%'"; }
								
							$sql.=" ORDER BY RNO ASC";
							$res=mysql_query($sql, $conn1);
							while($row=mysql_fetch_array($res))
							{	
								if($row['EXAM_SESSION'] == 1){ $PSession='Annual'; }
								else if($row['EXAM_SESSION'] == 2){ $PSession='Supply'; }
								else { $PSession=''; }
								
								if($row['GENDER'] == 1 || $row['GENDER'] == 3){ $Gender='Male'; }
								else if($row['GENDER'] == 2 || $row['GENDER'] == 4){ $Gender='Female'; }
								else { $Gender=''; }
							?>
							<tr>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['EXAM_YEAR'];?></td>
								<td class="center"><?php echo $row['RNO'];?></td>
								<td class="center"><?php echo $PSession;?></td>
								<td class="center"><?php echo $row['REGNO'];?></td>
								<td class="center"><?php echo $row['NAME'];?></td>
								<td align="center"><?php echo $row['FNAME'];?></td>
								<td class="center"><?php echo $Gender;?></td>
								<td class="center"><?php echo $row['GROUPNAME'];?></td>
								<td class="center"><?php echo $row['RESULT'];?></td>
								<td class="center"><?php echo $row['ATTEMPT_LIMIT'];?></td>
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
							<th>PYear</th>
							<th>PRollNo</th>
							<th>PSession</th>
							<th>PRegNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>Gender</th>
							<th>Group</th>
							<th>PResult</th>
							<th>Attempt Limit</th>	
						</tr>
						</tfoot>
						</table>
				
				</div>
			</div>
			<span class="clear"></span>
		</div>
		<span class="clear"></span>
	</div>
</div>