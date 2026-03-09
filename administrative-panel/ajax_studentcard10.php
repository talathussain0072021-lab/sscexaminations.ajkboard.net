<?php
include('includes/config.php');

if(!isset($_REQUEST['Id']) || !isset($_REQUEST['eid'])) {
    echo '<div style="text-align:center; padding:40px; color:#C62828;">Invalid request.</div>';
    exit;
}

$sql = "SELECT * FROM tbladm_10 WHERE Id=".intval($_REQUEST['Id'])." AND ExamYear=".intval($_REQUEST['eid']);
$res = mysqli_query($conn1, $sql);

if(!$res || mysqli_num_rows($res) == 0) {
    echo '<div style="text-align:center; padding:40px; color:#C62828;">Student record not found.</div>';
    exit;
}

$row = mysqli_fetch_assoc($res);

// Gender
if($row['Gender'] == 1){ $Gender='Male'; }
else if($row['Gender'] == 2){ $Gender='Female'; }
else { $Gender=''; }

// Religion
if($row['Religion'] == 1){ $Religion='Muslim'; }
else if($row['Religion'] == 2){ $Religion='Non Muslim'; }
else { $Religion=''; }

// Domicile
$Domicile = '';
if(!empty($row['Domicile']) && $row['Domicile'] > 0){
    $sql_d = "SELECT Name FROM districts WHERE Id=".intval($row['Domicile']);
    $res_d = mysqli_query($conn2, $sql_d);
    if($res_d && mysqli_num_rows($res_d) > 0){
        $row_d = mysqli_fetch_assoc($res_d);
        $Domicile = $row_d['Name'];
    }
}

// Postal District
$PostalDistrict = '';
if(!empty($row['PostalDistrict']) && $row['PostalDistrict'] > 0){
    $sql_pd = "SELECT Name FROM districts WHERE Id=".intval($row['PostalDistrict']);
    $res_pd = mysqli_query($conn2, $sql_pd);
    if($res_pd && mysqli_num_rows($res_pd) > 0){
        $row_pd = mysqli_fetch_assoc($res_pd);
        $PostalDistrict = $row_pd['Name'];
    }
}

// Admission Category
if($row['AdmCategory'] == 1){ $AdmCategory='First Time'; }
else if($row['AdmCategory'] == 3){ $AdmCategory='Improving Result'; }
else if($row['AdmCategory'] == 4){ $AdmCategory='Additional Subject(s)'; }
else if($row['AdmCategory'] == 5){ $AdmCategory='After Complete Failure'; }
else if($row['AdmCategory'] == 6){ $AdmCategory='Compartment Case'; }
else if($row['AdmCategory'] == 7){ $AdmCategory='After Passing Adib/Alam'; }
else if($row['AdmCategory'] == 9){ $AdmCategory='Grace Marks Subject(s)'; }
else { $AdmCategory=''; }

// Admission Status
if($row['StdAdmStatus'] == 1){ $StdAdmStatus='Ok'; $badgeClass='badge-ok'; }
else if($row['StdAdmStatus'] == 2){ $StdAdmStatus='Not Ok'; $badgeClass='badge-notok'; }
else { $StdAdmStatus='Pending'; $badgeClass='badge-pending'; }

// Photo URL
$picURL = '../SSCPicsBackup/'.$row['ExamYear'].'/'.$row['ExamSession'].'/'.$row['PicURL'];

// Check if it's a regular student with institution-panel pics
if($row['IsRegular'] == 1 && !empty($row['PicURL'])){
    // Try institution-panel path first for regular students
    $instPath = dirname(__DIR__) . '/institution-panel/' . $row['PicURL'];
    $sscPath = dirname(__DIR__) . '/SSCPicsBackup/' . $row['ExamYear'] . '/' . $row['ExamSession'] . '/' . $row['PicURL'];
    
    if(file_exists($instPath)){
        $picURL = '../institution-panel/'.$row['PicURL'];
    } else if(file_exists($sscPath)){
        $picURL = '../SSCPicsBackup/'.$row['ExamYear'].'/'.$row['ExamSession'].'/'.$row['PicURL'];
    }
}
?>

<div class="modal-photo-section">
    <img src="<?php echo $picURL.'?'.rand(10000,99999); ?>" alt="Student Photo" onerror="this.src='images/no-photo.png'"/>
    <div class="modal-student-name"><?php echo htmlspecialchars($row['Name']); ?></div>
    <div class="modal-father-name">s/o <?php echo htmlspecialchars($row['FatherName']); ?></div>
    <span class="modal-badge <?php echo $badgeClass; ?>"><?php echo $StdAdmStatus; ?></span>
</div>

<div class="modal-info-grid">
    <div class="modal-info-item">
        <div class="modal-info-label">Application No</div>
        <div class="modal-info-value"><?php echo $row['Id']; ?></div>
    </div>
    <div class="modal-info-item">
        <div class="modal-info-label">Roll No</div>
        <div class="modal-info-value"><?php echo $row['RollNo'] ?: '—'; ?></div>
    </div>
    <div class="modal-info-item">
        <div class="modal-info-label">Reg No</div>
        <div class="modal-info-value"><?php echo $row['RegNo'] ?: '—'; ?></div>
    </div>
    <div class="modal-info-item">
        <div class="modal-info-label">CNIC / Form B</div>
        <div class="modal-info-value"><?php echo $row['CNIC'] ?: '—'; ?></div>
    </div>
    <div class="modal-info-item">
        <div class="modal-info-label">Date of Birth</div>
        <div class="modal-info-value"><?php echo $row['DOB'] ? date('d-m-Y', strtotime($row['DOB'])) : '—'; ?></div>
    </div>
    <div class="modal-info-item">
        <div class="modal-info-label">Gender</div>
        <div class="modal-info-value"><?php echo $Gender; ?></div>
    </div>
    <div class="modal-info-item">
        <div class="modal-info-label">Religion</div>
        <div class="modal-info-value"><?php echo $Religion; ?></div>
    </div>
    <div class="modal-info-item">
        <div class="modal-info-label">Domicile</div>
        <div class="modal-info-value"><?php echo $Domicile ?: '—'; ?></div>
    </div>
    <div class="modal-info-item">
        <div class="modal-info-label">Phone</div>
        <div class="modal-info-value"><?php echo $row['Phone'] ?: '—'; ?></div>
    </div>
    <div class="modal-info-item">
        <div class="modal-info-label">Mobile</div>
        <div class="modal-info-value"><?php echo $row['Mobile'] ?: '—'; ?></div>
    </div>
    <div class="modal-info-full">
        <div class="modal-info-label">Postal Address</div>
        <div class="modal-info-value"><?php echo htmlspecialchars($row['PostalAddress']) ?: '—'; ?></div>
    </div>
    <div class="modal-info-item">
        <div class="modal-info-label">Postal District</div>
        <div class="modal-info-value"><?php echo $PostalDistrict ?: '—'; ?></div>
    </div>
    <div class="modal-info-item">
        <div class="modal-info-label">Category</div>
        <div class="modal-info-value"><?php echo $AdmCategory; ?></div>
    </div>
    <div class="modal-info-item">
        <div class="modal-info-label">Group</div>
        <div class="modal-info-value"><?php echo htmlspecialchars($row['GroupName']); ?></div>
    </div>
    <div class="modal-info-item">
        <div class="modal-info-label">Combination</div>
        <div class="modal-info-value"><?php echo htmlspecialchars($row['CombinationName']); ?></div>
    </div>
    <div class="modal-info-item">
        <div class="modal-info-label">Batch No</div>
        <div class="modal-info-value"><?php echo $row['BatchNo']; ?></div>
    </div>
    <div class="modal-info-item">
        <div class="modal-info-label">Batch Sr</div>
        <div class="modal-info-value"><?php echo $row['BatchSr'] ?: '—'; ?></div>
    </div>
    <div class="modal-info-item">
        <div class="modal-info-label">Exam Centre</div>
        <div class="modal-info-value"><?php echo $row['ACentreCode']; ?></div>
    </div>
    <div class="modal-info-item">
        <div class="modal-info-label">Centre Name</div>
        <div class="modal-info-value" style="font-size:11px;"><?php echo htmlspecialchars($row['ACentreName']); ?></div>
    </div>
    <div class="modal-info-item">
        <div class="modal-info-label">Challan No</div>
        <div class="modal-info-value"><?php echo $row['ChallanNo']; ?></div>
    </div>
    <div class="modal-info-item">
        <div class="modal-info-label">Fee Amount</div>
        <div class="modal-info-value">Rs. <?php echo number_format($row['AdmissionFee']); ?>/-</div>
    </div>
    <div class="modal-info-item">
        <div class="modal-info-label">Institute Code</div>
        <div class="modal-info-value"><?php echo $row['InstituteCode'] ?: '—'; ?></div>
    </div>
    <div class="modal-info-item">
        <div class="modal-info-label">Institute Name</div>
        <div class="modal-info-value" style="font-size:11px;"><?php echo htmlspecialchars($row['InstituteName']) ?: '—'; ?></div>
    </div>
</div>
