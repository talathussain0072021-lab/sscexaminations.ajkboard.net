<?php
// Increase limits at the top of the script
ini_set('memory_limit', '1024M');
ini_set('max_execution_time', 300);
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('includes/top.php');
include('includes/left_column.php');

// Database connection check
if (!$conn2) {
    die("<div class='error'>Database connection failed: " . mysql_error() . "</div>");
}
?>
<div id="container">
    <?php include('includes/header.php');?>
    <div id="content">
        <div class="grid_container">
            <span class="clear"></span>
            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <span class="h_icon documents"></span>
                        <h6>Upload Digital Banking Log</h6>
                    </div>
                    <div class="widget_content">
                    <?php
                    // Get latest record
                    $latestDate = "No records found";
                    $dateQuery = "SELECT Tran_Date FROM digital_banking_log 
                                ORDER BY ID DESC LIMIT 1";
                    $dateResult = mysql_query($dateQuery, $conn2);
                    if($dateResult && mysql_num_rows($dateResult) > 0) {
                        $dateRow = mysql_fetch_assoc($dateResult);
                        $latestDate = date('d-M-Y', strtotime($dateRow['Tran_Date']));
                    }

                    if(isset($_POST["submit"])) {
                        if($_FILES['file']['name'] && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
                            $filename = $_FILES['file']['name'];
                            $ext = pathinfo($filename, PATHINFO_EXTENSION);
                            
                            if($ext == 'csv') {
                                $inserted = 0;
                                $duplicate = 0;
                                $error = 0;
                                $rowsProcessed = 0;
                                
                                $handle = fopen($_FILES['file']['tmp_name'], "r");
                                if(!$handle) {
                                    echo "<div class='error'>Error opening CSV file</div>";
                                } else {
                                    // Skip initial empty/header rows
                                    $skipRows = 0;
                                    while ($skipRows < 10 && ($data = fgetcsv($handle)) !== false) {
                                        $skipRows++;
                                    }

                                    // Process CSV
                                    $batch = [];
                                    $batchSize = 100; // Insert in batches
                                    
                                    while(($data = fgetcsv($handle)) !== false) {
                                        // Skip empty rows
                                        if(empty($data[0]) || trim($data[0]) === '') continue;
                                        
                                        $rowsProcessed++;
                                        
                                        // Prepare data
                                        $agentID = trim($data[0]);
                                        $tranID = trim($data[1]);
                                        $challanNo = trim($data[2]);
                                        $name = trim($data[3]);
                                        $amount = trim($data[5]); // Skip column E
                                        $channel = trim($data[6]);
                                        $tranDate = trim($data[7]);
                                        $tranTime = trim($data[8]);

                                        // Validate required fields
                                        if(empty($tranID) || !is_numeric($tranID)) {
                                            $error++;
                                            continue;
                                        }

                                        // Add to batch
                                        $batch[] = "(
                                            '" . mysql_real_escape_string($agentID) . "',
                                            '" . mysql_real_escape_string($tranID) . "',
                                            '" . mysql_real_escape_string($challanNo) . "',
                                            '" . mysql_real_escape_string($name) . "',
                                            '" . mysql_real_escape_string($amount) . "',
                                            '" . mysql_real_escape_string($channel) . "',
                                            '" . mysql_real_escape_string($tranDate) . "',
                                            '" . mysql_real_escape_string($tranTime) . "'
                                        )";
                                        
                                        // Insert batch when full
                                        if(count($batch) >= $batchSize) {
                                            $this->insertBatch($batch, $conn2, $inserted, $duplicate, $error);
                                            $batch = [];
                                        }
                                    }
                                    
                                    // Insert remaining records
                                    if(!empty($batch)) {
                                        $this->insertBatch($batch, $conn2, $inserted, $duplicate, $error);
                                    }
                                    
                                    fclose($handle);
                                    
                                    $msg = "Successfully Imported $inserted Records";
                                    if($duplicate > 0) $msg .= ". $duplicate duplicates skipped";
                                    if($error > 0) $msg .= ". $error records had errors";
                                    if($rowsProcessed == 0) $msg = "No valid records found in file";
                                    
                                    echo "<div class='success'>$msg</div>";
                                    
                                    // Refresh latest date
                                    $dateResult = mysql_query($dateQuery, $conn2);
                                    if($dateResult && mysql_num_rows($dateResult) > 0) {
                                        $dateRow = mysql_fetch_assoc($dateResult);
                                        $latestDate = date('d-M-Y', strtotime($dateRow['Tran_Date']));
                                    }
                                }
                            } else {
                                echo "<div class='error'>Invalid file format. Please upload .csv files only</div>";
                            }
                        } else {
                            // Error handling remains same
                        }
                    }
                    
                    // Batch insert function
                    function insertBatch(&$batch, $conn, &$inserted, &$duplicate, &$error) {
                        $values = implode(',', $batch);
                        $query = "INSERT IGNORE INTO digital_banking_log 
                                  (AgentID, TranID, ChallanNo, Name, Amount, Channel, Tran_Date, Tran_Time) 
                                  VALUES $values";
                        
                        if(mysql_query($query, $conn)) {
                            $inserted += mysql_affected_rows($conn);
                        } else {
                            $error += count($batch);
                            error_log("Batch insert error: " . mysql_error($conn));
                        }
                    }
                    ?>
                        <div class="info_box">
                            <strong>Latest Record in Database:</strong> <?php echo $latestDate; ?>
                        </div>
                        
                        <form method="post" enctype="multipart/form-data">
                            <label>Select HBL Digital Banking CSV File:</label>
                            <input type="file" name="file" accept=".csv" required>
                            <input type="submit" name="submit" value="Import">
                        </form>
                        
                        <div class="instructions">
                            <label><strong>Important Notes:</strong></label>
                            <ul>
                                <li>Always upload the most recent file first</li>
                                <li>Files should be in CSV format</li>
                                <li>The system automatically skips duplicates</li>
                                <li>Verify the 'Latest Record' date after import</li>
                                <li>Large files may take several minutes to process</li>
                            </ul>
                        </div>
                    </div>    
                </div>
            </div>
            <span class="clear"></span>
        </div>
        <span class="clear"></span>
    </div>
</div>
<?php include('includes/footer.php');?>