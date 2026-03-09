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
                        <h6>Digital Banking Log - Status Check</h6>
                    </div>

                    <div class="widget_content">
                        <?php
                        // Get latest record date from database
                        $latestDate = "No records found";
                        $dateQuery = "SELECT Tran_Date FROM digital_banking_log 
                                      WHERE ID = (SELECT MAX(ID) FROM digital_banking_log)";
                        $dateResult = mysql_query($dateQuery, $conn2);
                        if($dateResult && mysql_num_rows($dateResult) > 0) {
                            $dateRow = mysql_fetch_assoc($dateResult);
                            $latestDate = date('d-M-Y', strtotime($dateRow['Tran_Date']));
                        }
                        ?>
                        
                        <div class="info_box1">
                            <strong>Latest Record in Database:</strong> <?php echo $latestDate; ?>
                        </div>
                        
                        <form method="post">
                            <table class="search">
                                <tr>
                                    <td><strong>Challan No:</strong></td>
                                    <td><input name="ChallanNo" id="ChallanNo" type="text" value="<?php echo $_REQUEST['ChallanNo'];?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="12" tabindex="1"/></td>
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
                                    <th>Challan No</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Channel</th>
                                    <th>Status</th>
                                    <th>Trans. Date</th>
                                    <th>Trans. Time</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(isset($_REQUEST['search']) && !empty($_REQUEST['ChallanNo']))
                            {
                                $SrNo = 1;
                                $challanNo = mysql_real_escape_string($_REQUEST['ChallanNo']);
                                
                                // Query to fetch paid challans from digital_banking_log
                                $sql = "SELECT * FROM digital_banking_log 
                                        WHERE ChallanNo = '$challanNo'";
                                
                                $res = mysql_query($sql, $conn2);
                                while($row = mysql_fetch_array($res))
                                {
                                ?>
                                <tr>
                                    <td class="center"><?php echo $SrNo;?></td>
                                    <td class="center"><?php echo $row['ChallanNo'];?></td>
                                    <td><?php echo $row['Name'];?></td>
                                    <td class="center"><?php echo number_format($row['Amount']);?></td>
                                    <td class="center"><?php echo $row['Channel'];?></td>
                                    <td class="center">
                                        <span class="badge_style b_done">PAID</span>
                                    </td>
                                    <td class="center"><?php echo $row['Tran_Date'];?></td>
                                    <td class="center"><?php echo $row['Tran_Time'];?></td>
                                </tr>
                                <?php
                                $SrNo++;
                                }
                                
                                // Show message if no records found
                                if(mysql_num_rows($res) == 0) {
                                    echo '<tr><td colspan="8" class="center">No records found for Challan No: '.htmlspecialchars($_REQUEST['ChallanNo']).'</td></tr>';
                                }
                            }
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>SrNo</th>
                                    <th>Challan No</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Channel</th>
                                    <th>Status</th>
                                    <th>Trans. Date</th>
                                    <th>Trans. Time</th>
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