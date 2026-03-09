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
						<h6>Reg. Batches Summary <?php echo $SessionName;?></h6>
					</div>

					<div class="widget_content">
                    							
                            <p class="dataTables_length" style="float: left; margin: 0px;"><br></p>

						<table class="display data_tbl">
						<thead>
						<tr>
							<th>Sr.No.</th>
							<th>ID</th>
							<th>Code</th>
							<th>Name</th>
							<th>Total Students</th>							
							<th>With Batch</th>
							<th>W/O Batch</th>
							<th>Total Batches</th>							
							<th>Batches Detail</th>
						</tr>
						</thead>
						<tbody>
                        <?php 
						$SrNo=1; 
						$sql="SELECT Id, Name, Code FROM institutes WHERE Name is Not NULL ORDER BY Code ASC";
						$res=mysql_query($sql, $conn1);
						while($row=mysql_fetch_array($res))
						{							
							$sql1="SELECT Id FROM vwregstudents WHERE InstituteId=".$row['Id']." AND SessionId=".$SessionId."";
							$res1=mysql_query($sql1, $conn1);
							$num_rows1=mysql_num_rows($res1);
	
							$sql2="SELECT Id FROM vwregstudents WHERE InstituteId=".$row['Id']." AND SessionId=".$SessionId." AND BatchId is Not NULL";
							$res2=mysql_query($sql2, $conn1);
							$num_rows2=mysql_num_rows($res2);
							
							$sql3="SELECT Id FROM vwregstudents WHERE InstituteId=".$row['Id']." AND SessionId=".$SessionId." AND BatchId is NULL";
							$res3=mysql_query($sql3, $conn1);
							$num_rows3=mysql_num_rows($res3);
	
							$Batches=''; $BatchStudents=0;							
							$sql4="SELECT Id, BatchNo, StdCount FROM vwregbatches WHERE InstituteId=".$row['Id']." AND SessionId=".$SessionId." ORDER BY Id ASC";
							$res4=mysql_query($sql4, $conn1);
							$BatchCount=mysql_num_rows($res4);
							while($row4=mysql_fetch_array($res4))
							{								
								$Batches.=$row4['BatchNo'].'('.$row4['StdCount'].')'.' ';
							}							
						?>
						<tr>
							<td class="center"><?php echo $SrNo;?></td>
							<td class="center"><?php echo $row['Id'];?></td>
							<td class="center"><?php echo $row['Code'];?></td>
							<td align="center"><?php echo $row['Name'];?></td>
							<td class="center"><?php echo $num_rows1;?></td>	
							<td class="center"><?php echo $num_rows2;?></td>							
							<td class="center"><?php echo $num_rows3;?></td>
							<td class="center"><?php echo $BatchCount;?></td>
							<td class="center"><?php echo $Batches;?></td>
						</tr>
                        <?php
						$SrNo++;
						}?>						
						</tbody>
						<tfoot>
						<tr>
							<th>Sr.No.</th>
							<th>ID</th>
							<th>Code</th>
							<th>Name</th>
							<th>Total Students</th>							
							<th>With Batch</th>
							<th>W/O Batch</th>
							<th>Total Batches</th>							
							<th>Batches Detail</th>
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