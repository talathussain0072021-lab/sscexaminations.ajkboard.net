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
						<h6>All Subject Combinations</h6>
					</div>

					<div class="widget_content">
                    	<p class="dataTables_length" style="float: left; margin: 0px;"><br></p>
						
						<div class="invoice_action_bar" style="float: right;">
                        	<div class="btn_30_blue">
                        		<a href="subjcombinations_add.php"><span class="icon add_co"></span><span class="btn_link">Add Subject Combination</span>
                            	</a>
                        	</div>
                        </div>
						
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>ID</th>
							<th>Name</th>
							<th>Group</th>
							<th>Reg. Fee</th>
							<th>Prv. Fee</th>
							<th>Subject1</th>
							<th>Subject2</th>
							<th>Subject3</th>
							<th>Subject4</th>
							<th>Subject5</th>
							<th>Subject6</th>
							<th>Subject7</th>
							<th>Subject8</th>
							<th>Subject9</th>
							<th>Subject21</th>
							<th>Subject22</th>
							<th>Subject23</th>
							<th>Subject24</th>
							<th>Subject25</th>
							<th>Subject26</th>
							<th>Subject27</th>
							<th>Subject28</th>
							<th>Subject29</th>
							<th>Comb.Type</th>
							<th>IsActive</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$SrNo=1;
						$sql="SELECT Id, Name, RegFee, PrvFee, CombType, IsActive, GroupName, Sub1Name, Sub2Name, Sub3Name, Sub4Name, Sub5Name, Sub6Name, Sub7Name, Sub8Name, Sub9Name, Sub21Name, Sub22Name, Sub23Name, Sub24Name, Sub25Name, Sub26Name, Sub27Name, Sub28Name, Sub29Name FROM vwsubcombinations10 ORDER BY Id ASC";
						$res=mysql_query($sql, $conn1);
						while($row=mysql_fetch_array($res))
						{
							if($row['CombType'] == 1){ $CombType='Reg.'; }
							else if($row['CombType'] == 2){ $CombType='Priv.'; }
							else { $CombType=''; }
							
							if($row['IsActive'] == 1){ $IsActive='Yes'; }
							else if($row['IsActive'] == 0){ $IsActive='No'; }
							else { $IsActive=''; }
						?>
						<tr>
							<td class="center"><?php echo $SrNo;?></td>
							<td class="center"><?php echo $row['Id'];?></td>
							<td class="center"><?php echo $row['Name'];?></td>
							<td class="center"><?php echo $row['GroupName'];?></td>
							<td class="center"><?php echo floatval($row['RegFee']);?></td>
							<td class="center"><?php echo floatval($row['PrvFee']);?></td>
							<td class="center"><?php echo $row['Sub1Name'];?></td>
							<td class="center"><?php echo $row['Sub2Name'];?></td>
							<td class="center"><?php echo $row['Sub3Name'];?></td>
							<td class="center"><?php echo $row['Sub4Name'];?></td>
							<td class="center"><?php echo $row['Sub5Name'];?></td>
							<td class="center"><?php echo $row['Sub6Name'];?></td>
							<td class="center"><?php echo $row['Sub7Name'];?></td>
							<td class="center"><?php echo $row['Sub8Name'];?></td>
							<td class="center"><?php echo $row['Sub9Name'];?></td>
							<td class="center"><?php echo $row['Sub21Name'];?></td>
							<td class="center"><?php echo $row['Sub22Name'];?></td>
							<td class="center"><?php echo $row['Sub23Name'];?></td>
							<td class="center"><?php echo $row['Sub24Name'];?></td>
							<td class="center"><?php echo $row['Sub25Name'];?></td>
							<td class="center"><?php echo $row['Sub26Name'];?></td>
							<td class="center"><?php echo $row['Sub27Name'];?></td>
							<td class="center"><?php echo $row['Sub28Name'];?></td>
							<td class="center"><?php echo $row['Sub29Name'];?></td>
							<td class="center"><?php echo $CombType;?></td>
							<td class="center"><?php echo $IsActive;?></td>
							<td class="center">
								<span><a class="action-icons c-edit" href="subjcombinations_edit.php?Id=<?php echo $row['Id'];?>" title="Edit">Edit</a></span><span><a class="action-icons c-delete" onClick="return confirm('Are you sure you want to delete this?');" href="subjcombinations_delete.php?Id=<?php echo $row['Id'];?>" title="Delete">Delete</a></span>
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
							<th>Name</th>
							<th>Group</th>
							<th>Reg. Fee</th>
							<th>Prv. Fee</th>
							<th>Subject1</th>
							<th>Subject2</th>
							<th>Subject3</th>
							<th>Subject4</th>
							<th>Subject5</th>
							<th>Subject6</th>
							<th>Subject7</th>
							<th>Subject8</th>
							<th>Subject9</th>
							<th>Subject21</th>
							<th>Subject22</th>
							<th>Subject23</th>
							<th>Subject24</th>
							<th>Subject25</th>
							<th>Subject26</th>
							<th>Subject27</th>
							<th>Subject28</th>
							<th>Subject29</th>
							<th>Comb.Type</th>
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