<?php
// --- SQL Server connection for HSSC Part-I result data (from HSSCPI.php) ------
include_once('includes/config.php'); // provides $server, $database, $username, $password

function getSqlSrvConn($server, $database, $username, $password) {
    $connInfo = ["Database" => $database, "UID" => $username, "PWD" => $password];
    $conn = @sqlsrv_connect($server, $connInfo);
    return $conn ?: null;
}

function fetchSspiRow($ssConn, $rollNo) {
    if (!$ssConn || !$rollNo) return null;
    $sql  = "SELECT * FROM [dbo].[TBLAIEMSRESULTPIS25] WHERE ROLL_NO = ?";
    $stmt = sqlsrv_query($ssConn, $sql, [(string)$rollNo]);
    if ($stmt === false) return null;
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    sqlsrv_free_stmt($stmt);
    return $row ?: null;
}

function getSubjectsSspi($row) {
    $map = [
        ['01','SUB1_NAME','SUB1_TOTAL','SUB1_OBT','',          'SUB1_PER','SUB1_GRADE','SUB1_PASS','SUB1_REMARKS'],
        ['02','SUB2_NAME','SUB2_TOTAL','SUB2_OBT','',          'SUB2_PER','SUB2_GRADE','SUB2_PASS','SUB2_REMARKS'],
        ['03','SUB3_NAME','SUB3_TOTAL','SUB3_OBT','',          'SUB3_PER','SUB3_GRADE','SUB3_PASS','SUB3_REMARKS'],
        ['04','SUB8_NAME','SUB8_TOTAL','SUB8_OBT','',          'SUB8_PER','SUB8_GRADE','SUB8_PASS','SUB8_REMARKS'],
        ['05','SUB4_NAME','SUB4_TOTAL','SUB4_OBT','SUB41_OBT', 'SUB4_PER','SUB4_GRADE','SUB4_PASS','SUB4_REMARKS'],
        ['06','SUB5_NAME','SUB5_TOTAL','SUB5_OBT','SUB51_OBT', 'SUB5_PER','SUB5_GRADE','SUB5_PASS','SUB5_REMARKS'],
        ['07','SUB6_NAME','SUB6_TOTAL','SUB6_OBT','SUB61_OBT', 'SUB6_PER','SUB6_GRADE','SUB6_PASS','SUB6_REMARKS'],
        ['08','SUB7_NAME','SUB7_TOTAL','SUB7_OBT','SUB71_OBT', 'SUB7_PER','SUB7_GRADE','SUB7_PASS','SUB7_REMARKS'],
    ];
    $subjects = [];
    foreach ($map as $m) {
        list($sr,$nameCol,$totCol,$obtCol,$pracCol,$perCol,$gradeCol,$passCol,$remCol) = $m;
        $name = trim($row[$nameCol] ?? '');
        if ($name === '') continue;
        $subjects[] = [
            'sr'    => $sr,
            'name'  => $name,
            'total' => ($totCol  !=='' && isset($row[$totCol])  && $row[$totCol]  !==null) ? trim($row[$totCol])  : '',
            'obt'   => ($obtCol  !=='' && isset($row[$obtCol])  && $row[$obtCol]  !==null) ? trim($row[$obtCol])  : '',
            'prac'  => ($pracCol !=='' && isset($row[$pracCol]) && $row[$pracCol] !==null) ? trim($row[$pracCol]) : '',
            'per'   => ($perCol  !=='' && isset($row[$perCol])  && $row[$perCol]  !==null) ? round((float)$row[$perCol],2) : '',
            'grade' => ($gradeCol!=='' && isset($row[$gradeCol])&& $row[$gradeCol]!==null) ? trim($row[$gradeCol]): '',
            'pass'  => ($passCol !=='' && isset($row[$passCol]) && $row[$passCol] !==null) ? trim($row[$passCol]) : '',
            'rem'   => ($remCol  !=='' && isset($row[$remCol])  && $row[$remCol]  !==null) ? trim($row[$remCol])  : '',
        ];
    }
    return $subjects;
}

$ssConn = getSqlSrvConn($server, $database, $username, $password);
?>
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
<h6>SSC(Part-I) Records</h6>
</div>
<div class="widget_content">
<form method="post">
<table class="search">
<tr>
<td><strong>Application No:</strong></td>
<td><input name="StdudentId" id="StdudentId" type="text" value="<?php echo htmlspecialchars($_REQUEST['StdudentId']??'');?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="8" tabindex="1"/></td>
<td><strong>P1Year:</strong></td>
<td><input name="P1Year" id="P1Year" type="text" value="<?php echo htmlspecialchars($_REQUEST['P1Year']??'');?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="2" tabindex="2"/></td>
<td><strong>P1RollNo:</strong></td>
<td><input name="P1RollNo" id="P1RollNo" type="text" value="<?php echo htmlspecialchars($_REQUEST['P1RollNo']??'');?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="6" tabindex="3"/></td>
</tr>
<tr>
<td><strong>P1Session:</strong></td>
<td>
<select name="P1Session" id="P1Session" data-placeholder="Select Session" class="chzn-select admin-select" tabindex="4">
<option value="">Select</option>
<option value="1" <?php echo (($_REQUEST['P1Session']??'')==1)?'selected':'';?>>1st Annual</option>
<option value="2" <?php echo (($_REQUEST['P1Session']??'')==2)?'selected':'';?>>2nd Annual</option>
</select>
</td>
<td><strong>P1RegNo:</strong></td>
<td><input name="P1RegNo" id="P1RegNo" type="text" value="<?php echo htmlspecialchars($_REQUEST['P1RegNo']??'');?>" class="admin-select limiter" onkeypress="return isNumber()" maxlength="11" tabindex="5"/></td>
<td><strong>Student Name:</strong></td>
<td><input name="Name" id="Name" type="text" value="<?php echo htmlspecialchars($_REQUEST['Name']??'');?>" class="admin-select limiter" tabindex="6"/></td>
</tr>
<tr>
<td><strong>Institute Code:</strong></td>
<td>
<select name="OInstituteId" Id="OInstituteId" data-placeholder="Select Institute" class="chzn-select admin-select" tabindex="7">
<option value="">Select</option>
<?php
$sql_inst="SELECT Id, Code FROM institutes ORDER BY Code ASC";
$res_inst=mysqli_query($conn2,$sql_inst);
while($row_inst=mysqli_fetch_array($res_inst)){
echo '<option value='.$row_inst['Id'].' '.(($_REQUEST['OInstituteId']??'')==$row_inst['Id']?'selected':'').'>'.$row_inst['Code'].'</option>';
}
?>
</select>
</td>
<td colspan="4"><input type="submit" name="search" id="search" value="Search" tabindex="8"/></td>
</tr>
</table>
</form>
<table class="display data_tbl">
<thead>
<tr>
<th>SrNo</th><th>AppNo</th><th>P1Year</th><th>P1RollNo</th><th>P1Session</th>
<th>P1RegNo</th><th>P1Result</th><th>Student Name</th><th>Father Name</th>
<th>CNIC</th><th>Gender</th><th>Group</th><th>Combination</th><th>IsRegular</th>
<th>Admission Type</th><th>Reg Session</th><th>Institute Code</th><th>Institute Name</th>
<th>IsEntered</th><th>IsIntact</th><th>IsReAdmitted</th><th>Remarks</th>
<th>SS Result</th><th>Total Obt / Marks</th><th>Subjects Detail</th>
<th>Migration</th><th>Updation</th><th>Action</th>
</tr>
</thead>
<tbody>
<?php
if(isset($_REQUEST['search'])){
$SrNo=1;
$sql="SELECT vw.Id, vw.Name, vw.FatherName, vw.CNIC, vw.Gender, vw.Domicile, vw.IsRegular, vw.AdmissionType, vw.IsEntered, vw.IsIntact, vw.IsReAdmitted, vw.InstituteId, vw.SessionId, vw.GroupName, vw.CombinationName, vw.RegistrationNo, vw.YEAR, vw.ROLLNO, vw.SESSION, vw.STATUS, vw.RESULT, vw.REMARKS, inst.Code, inst.Name as InstName, sess.Name as SessionName FROM matric_results.vwstudentspi vw LEFT JOIN matric_examination.sessions sess ON vw.SessionId=sess.Id LEFT JOIN matric_examination.institutes inst ON vw.InstituteId=inst.Id WHERE vw.RegistrationNo!=0";
if(isset($_REQUEST['StdudentId'])&&$_REQUEST['StdudentId']!=''){$sql.=" AND vw.Id=".$_REQUEST['StdudentId'];}
if(isset($_REQUEST['P1Year'])&&$_REQUEST['P1Year']!=''){$sql.=" AND vw.YEAR=".$_REQUEST['P1Year'];}
if(isset($_REQUEST['P1RollNo'])&&$_REQUEST['P1RollNo']!=''){$sql.=" AND vw.ROLLNO=".$_REQUEST['P1RollNo'];}
if(isset($_REQUEST['P1Session'])&&$_REQUEST['P1Session']!=''){$sql.=" AND vw.SESSION=".$_REQUEST['P1Session'];}
if(isset($_REQUEST['P1RegNo'])&&$_REQUEST['P1RegNo']!=''){$sql.=" AND vw.RegistrationNo='".$_REQUEST['P1RegNo']."'";}
if(isset($_REQUEST['Name'])&&$_REQUEST['Name']!=''){$sql.=" AND vw.Name LIKE '".$_REQUEST['Name']."%'";}
if(isset($_REQUEST['OInstituteId'])&&$_REQUEST['OInstituteId']!=''){$sql.=" AND vw.InstituteId=".$_REQUEST['OInstituteId'];}
$sql.=" ORDER BY vw.Id ASC";
$res=mysqli_query($conn2,$sql);
while($row=mysqli_fetch_array($res)){
if($row['SESSION']==1){$P1Session='1st Annual';}
elseif($row['SESSION']==2){$P1Session='2nd Annual';}
else{$P1Session='';}
if($row['Gender']==1){$Gender='Male';}
elseif($row['Gender']==2){$Gender='Female';}
else{$Gender='';}
if($row['AdmissionType']==1){$AdmCategory='Fresh AJK';}
elseif($row['AdmissionType']==3){$AdmCategory='ReAdm. AJK';}
elseif($row['AdmissionType']==4){$AdmCategory='ReAdm. Other';}
else{$AdmCategory='';}

// Fetch SQL Server data
$ssRow      = fetchSspiRow($ssConn,$row['ROLLNO']);
$ssResult   = $ssRow ? strtoupper(trim($ssRow['RESULT']??'')) : '';
$ssTotalObt = $ssRow ? trim($ssRow['TOTAL_OBT']??'')   : '';
$ssTotalMrk = $ssRow ? trim($ssRow['TOTAL_MARKS']??'') : '';
$ssSubjects = $ssRow ? getSubjectsSspi($ssRow) : [];
?>
<tr>
<td class="center"><?php echo $SrNo;?></td>
<td class="center"><?php echo $row['Id'];?></td>
<td class="center"><?php echo $row['YEAR'];?></td>
<td class="center"><?php echo $row['ROLLNO'];?></td>
<td class="center"><?php echo $P1Session;?></td>
<td class="center"><?php echo $row['RegistrationNo'];?></td>
<td class="center"><?php echo $row['RESULT'];?></td>
<td class="center"><?php echo $row['Name'];?></td>
<td class="center"><?php echo $row['FatherName'];?></td>
<td class="center"><?php echo $row['CNIC'];?></td>
<td class="center"><?php echo $Gender;?></td>
<td class="center"><?php echo $row['GroupName'];?></td>
<td class="center"><?php echo $row['CombinationName'];?></td>
<td class="center">
<?php if($row['IsRegular']==1){?><span class="badge_style b_done">Yes</span>
<?php }else{?><span class="badge_style b_pending">No</span><?php }?>
</td>
<td class="center"><?php echo $AdmCategory;?></td>
<td class="center"><?php echo $row['SessionName'];?></td>
<?php if($row['STATUS']==1||$row['STATUS']==NULL){?>
<td class="center"><?php echo $row['Code'];?></td>
<td class="center"><?php echo $row['InstName'];?></td>
<?php }else{?>
<td class="center"></td>
<td class="center"></td>
<?php }?>
<td class="center">
<?php if($row['IsEntered']==1){?><span class="badge_style b_done">Yes</span>
<?php }else{?><span class="badge_style b_pending">No</span><?php }?>
</td>
<td class="center">
<?php if($row['IsIntact']==1){?><span class="badge_style b_done">Yes</span>
<?php }else{?><span class="badge_style b_pending">No</span><?php }?>
</td>
<td class="center">
<?php if($row['IsReAdmitted']==1){?><span class="badge_style b_done">Yes</span>
<?php }else{?><span class="badge_style b_pending">No</span><?php }?>
</td>
<td class="center"><?php echo $row['REMARKS'];?></td>

<!-- SQL Server columns -->
<td class="center">
<?php if($ssRow):?>
<?php if(stripos($ssResult,'PASS')!==false):?>
<span class="badge_style b_done">PASS</span>
<?php elseif(stripos($ssResult,'FAIL')!==false):?>
<span class="badge_style b_pending">FAIL</span>
<?php elseif($ssResult!==''):?>
<span class="badge_style b_high"><?php echo htmlspecialchars($ssResult);?></span>
<?php else:?><span>-</span><?php endif;?>
<?php else:?><span style="color:#999;">N/A</span><?php endif;?>
</td>
<td class="center">
<?php
if($ssTotalObt!==''&&$ssTotalMrk!==''){echo htmlspecialchars($ssTotalObt).' / '.htmlspecialchars($ssTotalMrk);}
elseif($ssTotalObt!==''){echo htmlspecialchars($ssTotalObt);}
else{echo '-';}
?>
</td>
<td style="font-size:.8rem;min-width:280px;padding:4px;">
<?php if(!empty($ssSubjects)):?>
<table style="width:100%;border-collapse:collapse;font-size:.78rem;">
<tr style="background:#f0f0f0;">
<th style="border:1px solid #ccc;padding:2px 4px;">Sr</th>
<th style="border:1px solid #ccc;padding:2px 4px;text-align:left;">Subject</th>
<th style="border:1px solid #ccc;padding:2px 4px;">Total</th>
<th style="border:1px solid #ccc;padding:2px 4px;">Obt</th>
<th style="border:1px solid #ccc;padding:2px 4px;">Prac</th>
<th style="border:1px solid #ccc;padding:2px 4px;">%</th>
<th style="border:1px solid #ccc;padding:2px 4px;">Grade</th>
<th style="border:1px solid #ccc;padding:2px 4px;">Pass/Fail</th>
<th style="border:1px solid #ccc;padding:2px 4px;">Rem</th>
</tr>
<?php foreach($ssSubjects as $s):?>
<tr>
<td style="border:1px solid #ccc;padding:2px 4px;text-align:center;"><?php echo $s['sr'];?></td>
<td style="border:1px solid #ccc;padding:2px 4px;"><?php echo htmlspecialchars($s['name']);?></td>
<td style="border:1px solid #ccc;padding:2px 4px;text-align:center;"><?php echo htmlspecialchars($s['total']);?></td>
<td style="border:1px solid #ccc;padding:2px 4px;text-align:center;"><?php echo($s['obt']!=''&&$s['obt']!='0')?htmlspecialchars($s['obt']):'';?></td>
<td style="border:1px solid #ccc;padding:2px 4px;text-align:center;"><?php echo($s['prac']!=''&&$s['prac']!='0')?htmlspecialchars($s['prac']):'';?></td>
<td style="border:1px solid #ccc;padding:2px 4px;text-align:center;"><?php echo htmlspecialchars($s['per']);?></td>
<td style="border:1px solid #ccc;padding:2px 4px;text-align:center;"><?php echo htmlspecialchars($s['grade']);?></td>
<td style="border:1px solid #ccc;padding:2px 4px;text-align:center;<?php echo(strtoupper($s['pass'])==='PASS')?'color:#166534;font-weight:700;':((strtoupper($s['pass'])==='FAIL')?'color:#991b1b;font-weight:700;':'');?>"><?php echo htmlspecialchars($s['pass']);?></td>
<td style="border:1px solid #ccc;padding:2px 4px;text-align:center;"><?php echo htmlspecialchars($s['rem']);?></td>
</tr>
<?php endforeach;?>
</table>
<?php else:?><span style="color:#999;">No SS data</span><?php endif;?>
</td>
<!-- end SQL Server columns -->

<td class="center">
<?php if($row['IsEntered']==0&&$row['IsReAdmitted']==0&&$row['InstituteId']!=0&&($row['STATUS']==1||$row['STATUS']==NULL)){?><a href="migrate_student10.php?Id=<?php echo $row['Id'];?>&InstituteId=<?php echo $row['InstituteId'];?>" target="_blank"><span class="badge_style b_high">Migrate</span></a><?php }?>
</td>
<td class="center">
<a href="infoupdate_student09.php?Id=<?php echo $row['Id'];?>" target="_blank"><span class="badge_style b_high">Update</span></a>
</td>
<td class="center">
<a class="action-icons c-edit" href="sscrecords09_edit.php?Id=<?php echo $row['Id'];?>" title="Edit Result" target="_blank">Edit</a>
</td>
</tr>
<?php $SrNo++; }
}?>
</tbody>
<tfoot>
<tr>
<th>SrNo</th><th>AppNo</th><th>P1Year</th><th>P1RollNo</th><th>P1Session</th>
<th>P1RegNo</th><th>P1Result</th><th>Student Name</th><th>Father Name</th>
<th>CNIC</th><th>Gender</th><th>Group</th><th>Combination</th><th>IsRegular</th>
<th>Admission Type</th><th>Reg Session</th><th>Institute Code</th><th>Institute Name</th>
<th>IsEntered</th><th>IsIntact</th><th>IsReAdmitted</th><th>Remarks</th>
<th>SS Result</th><th>Total Obt / Marks</th><th>Subjects Detail</th>
<th>Migration</th><th>Updation</th><th>Action</th>
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
<?php
if($ssConn){sqlsrv_close($ssConn);}
include('includes/footer.php');
?>