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
						<h6>Upload Digital Banking Log</h6>
					</div>
				<div class="widget_content">
					<?php  
					
if(isset($_POST["submit"])) {
    if($_FILES['file']['name']) {
        $filename = explode(".", $_FILES['file']['name']);
        if($filename[1] == 'csv') {
            $handle = fopen($_FILES['file']['tmp_name'], "r");
            while($data = fgetcsv($handle)) { //handling csv file 
                $item1 = mysql_real_escape_string($data[0]);  
                $item2 = mysql_real_escape_string($data[1]);
                $item3 = mysql_real_escape_string($data[2]);  
                $item4 = mysql_real_escape_string($data[3]);
                $item5 = mysql_real_escape_string($data[4]);  
                $item6 = mysql_real_escape_string($data[5]);
                $item7 = mysql_real_escape_string($data[6]);  
                $item8 = mysql_real_escape_string($data[7]);

                //insert data from CSV file 
                $query = "INSERT into digital_banking_log(AgentID, TranID, ChallanNo, Name, Amount, Channel, Tran_Date, Tran_Time) 
                          values('$item1','$item2','$item3','$item4','$item5','$item6','$item7','$item8')";
                mysql_query($query, $conn2);
            }
            fclose($handle);
            echo "File successfully imported";
        }
    }
}
?>
					<form method="post" enctype="multipart/form-data">
<label>Select HBL Digital Banking CSV File:</label>
<input type="file" name="file">
<br>
<input type="submit" name="submit" value="Import">
</form>
					</div>	
					
				</div>
			</div>
			<span class="clear"></span>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php include('includes/footer.php');?>

