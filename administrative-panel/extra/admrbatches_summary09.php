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
						<h6>Adm. Batches(Regular) Summary <?php echo $SessionName;?></h6>
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
							<th>Regular</th>
							<th>Private</th>													
							<th>With Batch</th>
							<th>Adm. Ok</th>
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
							$sql1="SELECT Id FROM vwadmstudents11 WHERE InstituteId=".$row['Id']." AND SessionId=".$SessionId."";
							$res1=mysql_query($sql1, $conn1);
							$num_rows1=mysql_num_rows($res1);
	
							$sql_reg="SELECT Id FROM vwadmstudents11 WHERE InstituteId=".$row['Id']." AND SessionId=".$SessionId." AND IsRegular=1";
							$res_reg=mysql_query($sql_reg, $conn1);
							$num_rows_reg=mysql_num_rows($res_reg);	
							
							$sql_priv="SELECT Id FROM vwadmstudents11 WHERE InstituteId=".$row['Id']." AND SessionId=".$SessionId." AND IsRegular=0";
							$res_priv=mysql_query($sql_priv, $conn1);
							$num_rows_priv=mysql_num_rows($res_priv);	
							
							$sql2="SELECT Id FROM vwadmstudents11 WHERE IsRegular=1 AND InstituteId=".$row['Id']." AND SessionId=".$SessionId." AND BatchId is Not NULL";
							$res2=mysql_query($sql2, $conn1);
							$num_rows2=mysql_num_rows($res2);
							
							$sql3="SELECT Id FROM vwadmstudents11 WHERE IsRegular=1 AND InstituteId=".$row['Id']." AND SessionId=".$SessionId." AND BatchId is NULL";
							$res3=mysql_query($sql3, $conn1);
							$num_rows3=mysql_num_rows($res3);
	
							$Batches=''; $BatchStudents=0;							
							$sql4="SELECT Id, BatchNo, StdCount FROM vwadmbatches11 WHERE InstituteId=".$row['Id']." AND SessionId=".$SessionId." ORDER BY Id ASC";
							$res4=mysql_query($sql4, $conn1);
							$BatchCount=mysql_num_rows($res4);
							while($row4=mysql_fetch_array($res4))
							{								
								$Batches.=$row4['BatchNo'].'('.$row4['StdCount'].')'.' ';
							}
							
							$sql5="SELECT Id FROM vwadmstudents11 WHERE InstituteId=".$row['Id']." AND SessionId=".$SessionId." AND IsRegular=1 AND StdAdmStatus=1";
							$res5=mysql_query($sql5, $conn1);
							$num_rows5=mysql_num_rows($res5);							
						?>
						<tr>
							<td class="center"><?php echo $SrNo;?></td>
							<td class="center"><?php echo $row['Id'];?></td>
							<td class="center"><?php echo $row['Code'];?></td>
							<td align="center"><?php echo $row['Name'];?></td>
							<td class="center"><?php echo $num_rows1;?></td>	
							<td class="center"><?php echo $num_rows_reg;?></td>
							<td class="center"><?php echo $num_rows_priv;?></td>								
							<td class="center"><?php echo $num_rows2;?></td>							
							<td class="center"><?php echo $num_rows5;?></td>
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
							<th>Regular</th>
							<th>Private</th>													
							<th>With Batch</th>
							<th>Adm. Ok</th>
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