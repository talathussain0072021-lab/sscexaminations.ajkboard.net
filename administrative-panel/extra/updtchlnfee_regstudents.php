<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if (isset($_GET['action']) && $_GET['action'] == 'update-fee') {
		
		$sqlVer = "SELECT COUNT(*) AS cnt FROM tblchallans
					WHERE (ChallanNo = ".$_REQUEST['ChallanNo']." AND FeeStatus = 1)";
		$resVer = mysql_query($sqlVer, $conn2);
		$rowVer  = mysql_fetch_assoc($resVer);
		
		if ($rowVer['cnt'] >= 1) {
			echo "<script>alert('ChallanFee is already paid.');location.replace('updtchlnfee_regstudents.php');</script>"; exit;
		}
		
		$ids  = json_decode($_GET['ids'], true);
		$oldfees = json_decode($_GET['oldfees'], true);
		$newfees = json_decode($_GET['newfees'], true);
		
		//echo "<script>alert('ABC ids: " . json_encode($ids) . " oldfees: " . json_encode($oldfees) . "newfees: " . json_encode($newfees) . "')</script>";
		
		for ($i = 0; $i < count($ids); $i++) {

			//$id  = intval($ids[$i]);
			//$newfee = floatval($newfees[$i]);
			
			$sql_q="UPDATE regbatchstudents SET
			AdmissionFee		=		".$newfees[$i]."
			WHERE StudentId		=		".$ids[$i]."
			AND ChallanNo		=		".$_GET['ChallanNo']."";
			$res_q=mysql_query($sql_q, $conn1);
			
			$ins="INSERT INTO tbl_pilog SET
			ActivityType			=		'ChallanFeeUpdation-I',
			ActivityRefNo			=		'".$_GET['ActivityRefNo']."',
			ActivityDescription		=		'RegChallanFee Updated FROM ".$oldfees[$i]." To ".$newfees[$i]."',
			StudentId				=		".$ids[$i].",
			EmployeeId				=		".$_SESSION['emp_id']."";
			$res=mysql_query($ins, $conn1);
		}
		
		$updc1="UPDATE challans
		SET ChallanAmount		=		(".$_GET['FeeSum']."+10)
		WHERE ChallanNo			=		".$_GET['ChallanNo']."";
		$resupdtc1=mysql_query($updc1, $conn1);
		
		$updc2="UPDATE tblchallans
		SET ChallanAmount		=		(".$_GET['FeeSum']."+10)
		WHERE ChallanNo			=		".$_GET['ChallanNo']."";
		$resupdtc2=mysql_query($updc2, $conn2);

		?><script>location.replace('updtchlnfee_regstudents.php?message=Data Updated Successfully.');</script><?php
	}
	?>

	<div id="content">
		<div class="grid_container">
			<span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Students (SSC Part-I)</h6>
					</div>

					<div class="widget_content">
						
						<form method="post">
						<table class="search">
						<tr><td colspan="5" style="color:#FF0000; font-size:14px; font-weight:bold;">Search Students</td></tr>
						<tr>
							<td><strong>ChallanNo:</strong></td>
							<td><input name="ChallanNo" id="ChallanNo" type="text" value="<?php echo $_REQUEST['ChallanNo'];?>" class="x_large" onkeypress="return isNumber()" maxlength="12" tabindex="1"/></td>
							<td><input type="submit" name="search" id="search" value="Search" tabindex="2"/></td>
						</tr>
						<tr>
							<td><strong>Letter No:</strong></td>
							<td>
								<input name="ActivityRefNo" id="ActivityRefNo" type="text" class="large" maxlength="50" tabindex="3"/>
							</td>
							<td><input type="button" name="update" id="update" value="Update" onclick="return validateUpdate()" tabindex="4"/></td>
						</tr>
						</table>
						</form>
						
						<form name="form1" id="form1" action="" method="post">
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>AppNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>BatchNo</th>
							<th>BatchSr</th>
							<th>Adm Status</th>
							<th>Adm Fee</th>
						<!--<th>Action</th>-->
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_REQUEST['search']))
						{
							$SrNo=1; $StdCountSum=0;
							$sql="SELECT Id, Name, FatherName, BatchNo, BatchSr, StdAdmStatus, AdmissionFee FROM vwregstudents WHERE ChallanNo=".$_REQUEST['ChallanNo']." ORDER BY Id ASC";
							$res=mysql_query($sql, $conn1);
							$numrows=mysql_num_rows($res);
							while($row=mysql_fetch_array($res))
							{?>
							<tr>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['Id'];?></td>
								<td class="center"><?php echo $row['Name'];?></td>
								<td class="center"><?php echo $row['FatherName'];?></td>
								<td class="center"><?php echo $row['BatchNo'];?></td>
								<td class="center"><?php echo $row['BatchSr'];?></td>
								<td class="center"><?php echo $row['StdAdmStatus'];?></td>
								<td class="center">
								<input type="hidden" name="std_id[]" value="<?php echo $row['Id']; ?>">
								<input type="hidden" name="std_ofee[]" value="<?php echo intval($row['AdmissionFee']);?>">
								<input type="text" name="std_nfee[]" value="<?php echo intval($row['AdmissionFee']);?>">
								</td>
							</tr>
							<?php
							$SrNo++; $StdCountSum=$numrows;
							}//while($row=mysql_fetch_array($res))
						}?>
						</tbody>
						<tfoot>
						<tr>
							<th>SrNo</th>
							<th>AppNo</th>
							<th>Student Name</th>
							<th>Father Name</th>
							<th>BatchNo</th>
							<th>BatchSr</th>
							<th>Adm Status</th>
							<th>Adm Fee</th>
						<!--<th>Action</th>-->
						</tr>
						</tfoot>
						</table>
						</form>
						
						<div style="float: right; font-size: 16px; width: auto; color:#FF0000;">
							Total Students: <?php echo $StdCountSum;?>&nbsp;
							Total Fee: <span id="FeeSum"></span>
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
<script>
// Run once on page load
window.onload = updateTotalFee;

// Update total fee when user edits any fee box
document.addEventListener("input", function(e) {
    if (e.target.name === "std_nfee[]") {
        updateTotalFee();
    }
});

function updateTotalFee() {
    const fees = document.getElementsByName("std_nfee[]");
    let total = 0;

    for (let i = 0; i < fees.length; i++) {
        let v = parseFloat(fees[i].value);
        if (!isNaN(v)) {
            total += v;
        }
    }

    document.getElementById("FeeSum").textContent = total;
}
function validateUpdate(form)
{
	var ChallanNo = document.getElementById("ChallanNo").value.trim();
    var ActivityRefNo = document.getElementById("ActivityRefNo").value.trim();
	var FeeSum = document.getElementById("FeeSum").textContent;
	
	if (ChallanNo === "" || ActivityRefNo === "") {
        alert("Please enter ChallanNo and LetterNo before updating.");
        return false;
    }
	
	// Get all inputs by name (they return NodeList)
    const Ids   = document.getElementsByName("std_id[]");
    const Oldfees = document.getElementsByName("std_ofee[]");
    const Newfees = document.getElementsByName("std_nfee[]");

    // Arrays to store values
    let IdList   = [];
	let OldfeeList = [];
    let NewfeeList = [];

    // Loop through inputs (all arrays have same index order)
    for (let i = 0; i < Ids.length; i++) {

    //let id = Ids[i].value; let ofee = Oldfees[i].value; let ufee = Newfees[i].value;

		// Only push rows where fee has changed
		if (Oldfees[i].value !== Newfees[i].value) {
			IdList.push(Ids[i].value);
			OldfeeList.push(Oldfees[i].value);
			NewfeeList.push(Newfees[i].value);
		}
	}

    // Show result (for testing)
    //alert("IDs: " + IdList.join(", ")); alert("Old Fees: " + OldfeeList.join(", ")); alert("New Fees: " + NewfeeList.join(", ")); return false;
	
	//If no changes, show message and stop
    if (IdList.length === 0) {
        alert("No fee changes detected.");
        return false;
    }
	else {
		 // Convert to JSON
		let idsJSON  = encodeURIComponent(JSON.stringify(IdList));
		let oldfeesJSON = encodeURIComponent(JSON.stringify(OldfeeList));
		let newfeesJSON = encodeURIComponent(JSON.stringify(NewfeeList));
		
		location.replace(
			'updtchlnfee_regstudents.php?ids=' + idsJSON + '&oldfees=' + oldfeesJSON + '&newfees=' + newfeesJSON + '&ChallanNo='+ ChallanNo +
			'&ActivityRefNo='+ ActivityRefNo + '&FeeSum='+ FeeSum + '&action=update-fee'
		);
		return false;
	}
}
</script>