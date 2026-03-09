<?php
// Turn on error reporting at the VERY TOP
error_reporting(0);
ini_set('display_errors', 1);
include('includes/config.php');
include('includes/top.php');
include('includes/header.php');
include('includes/left_column.php');
    $ExamId = 10;
    $ExamName = 'SSC ADMISSIONS';
?>
    <style>
        .btn-action {
            display: inline-block;
            padding: 8px 24px;
            font-size: 13px;
            font-weight: 600;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
            margin: 0 5px;
            line-height: 1.4;
            vertical-align: middle;
        }
        .btn-action::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), transparent);
            transition: left 0.5s ease;
        }
        .btn-action:hover::before {
            left: 100%;
        }
        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.25);
        }
        .btn-action:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .btn-search {
            background: linear-gradient(135deg, #2196F3, #1976D2);
            color: #fff;
        }
        .btn-search:hover {
            background: linear-gradient(135deg, #42A5F5, #2196F3);
        }
        .btn-reset {
            background: linear-gradient(135deg, #78909C, #546E7A);
            color: #fff;
        }
        .btn-reset:hover {
            background: linear-gradient(135deg, #90A4AE, #607D8B);
        }
        .btn-print {
            background: linear-gradient(135deg, #FF9800, #F57C00);
            color: #fff;
        }
        .btn-print:hover {
            background: linear-gradient(135deg, #FFA726, #FF9800);
        }
        .btn-action i {
            margin-right: 6px;
        }
        .btn-row {
            display: inline-block;
            padding: 4px 12px;
            font-size: 11px;
            font-weight: 600;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 1px 4px rgba(0,0,0,0.15);
            margin: 1px 2px;
            line-height: 1.4;
            vertical-align: middle;
            white-space: nowrap;
        }
        .btn-row::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }
        .btn-row:hover::before {
            left: 100%;
        }
        .btn-row:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.25);
        }
        .btn-row:active {
            transform: translateY(0);
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }
        .btn-view {
            background: linear-gradient(135deg, #26C6DA, #00ACC1);
            color: #fff;
        }
        .btn-view:hover {
            background: linear-gradient(135deg, #4DD0E1, #26C6DA);
            color: #fff;
        }
        .btn-row-print {
            background: linear-gradient(135deg, #66BB6A, #43A047);
            color: #fff;
        }
        .btn-row-print:hover {
            background: linear-gradient(135deg, #81C784, #66BB6A);
            color: #fff;
        }
        .btn-edit {
            background: linear-gradient(135deg, #5C6BC0, #3F51B5);
            color: #fff;
        }
        .btn-edit:hover {
            background: linear-gradient(135deg, #7986CB, #5C6BC0);
            color: #fff;
        }
        .btn-card {
            background: linear-gradient(135deg, #AB47BC, #8E24AA);
            color: #fff;
        }
        .btn-card:hover {
            background: linear-gradient(135deg, #CE93D8, #AB47BC);
            color: #fff;
        }

        /* Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.55);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.25s ease;
        }
        .modal-overlay.active { display: flex; }
        @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
        @keyframes slideUp { from { transform:translateY(40px); opacity:0; } to { transform:translateY(0); opacity:1; } }

        .modal-card {
            background: #fff;
            border-radius: 16px;
            width: 900px;
            max-width: 96%;
            max-height: 92vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0,0,0,0.35);
            animation: slideUp 0.3s ease;
            position: relative;
        }
        .modal-card-header {
            background: linear-gradient(135deg, #1565C0, #0D47A1);
            color: #fff;
            padding: 20px 24px;
            border-radius: 16px 16px 0 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .modal-card-header h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .modal-close {
            background: rgba(255,255,255,0.2);
            border: none;
            color: #fff;
            font-size: 22px;
            width: 36px; height: 36px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        .modal-close:hover {
            background: rgba(255,255,255,0.4);
            transform: rotate(90deg);
        }
        .modal-card-body {
            padding: 0;
            display: flex;
            flex-direction: row;
            min-height: 420px;
        }
        .modal-photo-section {
            width: 220px;
            min-width: 220px;
            background: linear-gradient(180deg, #E3F2FD, #BBDEFB);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            border-radius: 0 0 0 16px;
        }
        .modal-photo-section img {
            width: 110px; height: 130px;
            object-fit: cover;
            border-radius: 10px;
            border: 3px solid #e0e0e0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .modal-student-name {
            font-size: 20px;
            font-weight: 700;
            color: #1565C0;
            margin: 10px 0 2px;
        }
        .modal-father-name {
            font-size: 13px;
            color: #666;
            margin-bottom: 16px;
        }
        .modal-info-grid {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            align-content: start;
            overflow-y: auto;
        }
        .modal-info-item {
            padding: 10px 14px;
            border-bottom: 1px solid #f0f0f0;
        }
        .modal-info-item:nth-child(odd) {
            border-right: 1px solid #f0f0f0;
        }
        .modal-info-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #999;
            font-weight: 600;
            margin-bottom: 3px;
        }
        .modal-info-value {
            font-size: 13px;
            color: #333;
            font-weight: 600;
        }
        .modal-info-full {
            grid-column: 1 / -1;
            padding: 10px 14px;
            border-bottom: 1px solid #f0f0f0;
        }
        .modal-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
        }
        .badge-ok { background: #E8F5E9; color: #2E7D32; }
        .badge-notok { background: #FFEBEE; color: #C62828; }
        .badge-pending { background: #FFF3E0; color: #E65100; }
    </style>
    <div id="container">
    <div id="content">
    <div class="grid_container">
            <span class="clear"></span>
            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <span class="h_icon documents"></span>
                        <h6>All Regular Students <?php echo $ExamName;?></h6>
                    </div>
                    <div class="widget_content">
                        <!-- Search Form -->
                        <table class="search" style="width:100%; border-collapse:collapse; margin-bottom:20px;">
                            <form method="post" action="">
                            <tr>
                                <td style="padding:8px;"><strong>Exam Year:</strong></td>
                                <td style="padding:8px;">
                                    <select name="ExamYear" id="ExamYear" class="chzn-select admin-select" style="width:100px;" tabindex="3">
                                    <option value="All">All Years</option>
                                    <?php
                                    $sql_year = "SELECT DISTINCT ExamYear FROM tbladm_10 
                                                 WHERE ExamYear IS NOT NULL AND ExamYear!=''  ORDER BY ExamYear DESC";
                                    $res_year = mysqli_query($conn1, $sql_year);
                                    if($res_year && mysqli_num_rows($res_year) > 0) {
                                        while($row_year = mysqli_fetch_array($res_year)) {
                                            $selected = (isset($_REQUEST['ExamYear']) && $_REQUEST['ExamYear'] == $row_year['ExamYear']) ? 'selected' : '';
                                            echo '<option value="'.$row_year['ExamYear'].'" '.$selected.'>'.$row_year['ExamYear'].'</option>';
                                        }
                                    }
                                    ?>
                                    </select>
                                </td>
                                <td style="padding:8px;"><strong>Institute:</strong></td>
                                <td style="padding:8px;">
                                    <select name="InstituteId" id="InstituteId" class="chzn-select admin-select" style="width:200px;" tabindex="1">
                                        <option value="All">All Institutes</option>
                                        <?php
                                    $sql_inst = "SELECT DISTINCT InstituteId, InstituteCode, InstituteName FROM tbladm_10 WHERE InstituteCode IS NOT NULL AND InstituteCode != '' ORDER BY InstituteCode ASC";
                                    $res_inst = mysqli_query($conn1, $sql_inst);
                                    if($res_inst && mysqli_num_rows($res_inst) > 0) {
                                        while($row_inst = mysqli_fetch_array($res_inst)) {
                                            $selected = (isset($_REQUEST['InstituteId']) && $_REQUEST['InstituteId'] == $row_inst['InstituteId']) ? 'selected' : '';
                                            echo '<option value="'.$row_inst['InstituteId'].'" '.$selected.'>'.$row_inst['InstituteCode'].' - '.$row_inst['InstituteName'].'</option>';
                                        }
                                    }
                                    ?>
                                    </select>
                                </td>
                                <td style="padding:8px;"><strong>Batch No:</strong></td>
                                <td style="padding:8px;">
                                    <select name="BatchId" id="BatchId" class="chzn-select admin-select" style="width:150px;" tabindex="2">
                                    <option value="All">All Batches</option>
                                    <?php
                                    // $sql_batch = "SELECT DISTINCT BatchId, BatchNo FROM tbladm_10 
                                    //               WHERE BatchId IS NOT NULL AND ExamId=" . intval($ExamId) . " 
                                    //               ORDER BY BatchNo ASC";
                                    // $res_batch = mysqli_query($conn1, $sql_batch);
                                    // if($res_batch && mysqli_num_rows($res_batch) > 0) {
                                    //     while($row_batch = mysqli_fetch_array($res_batch)) {
                                    //         $selected = (isset($_REQUEST['BatchId']) && $_REQUEST['BatchId'] == $row_batch['BatchId']) ? 'selected' : '';
                                    //         echo '<option value="'.$row_batch['BatchId'].'" '.$selected.'>'.$row_batch['BatchNo'].'</option>';
                                    //     }
                                    // }
                                    ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                </tr>
                                <td style="padding:8px;"><strong>P1RollNo:</strong></td>
                                <td style="padding:8px;">
                                    <input name="P1RollNo" id="P1RollNo" type="text" value="<?php echo isset($_REQUEST['P1RollNo']) ? htmlspecialchars($_REQUEST['P1RollNo']) : ''; ?>" placeholder="Search P1 Roll No" class="admin-select" style="width:100px;" maxlength="6" tabindex="4"/>
                                </td>
                            <td style="padding:8px;"><strong>Admission Status:</strong></td>
                            <td style="padding:8px;">
                                <select name="StdAdmStatus" id="StdAdmStatus" class="chzn-select admin-select" style="width:120px;" tabindex="7">
                                <option value="All">All</option>
                                <option value="3" <?php echo (isset($_REQUEST['StdAdmStatus']) && $_REQUEST['StdAdmStatus']==3) ? 'selected' : ''; ?>>Pending</option>
                                <option value="1" <?php echo (isset($_REQUEST['StdAdmStatus']) && $_REQUEST['StdAdmStatus']==1) ? 'selected' : ''; ?>>Ok</option>
                                <option value="2" <?php echo (isset($_REQUEST['StdAdmStatus']) && $_REQUEST['StdAdmStatus']==2) ? 'selected' : ''; ?>>Not Ok</option>
                                </select>
                            </td>
                            <tr>
                                
                                <td style="padding:8px;"><strong>Application No:</strong></td>
                                <td style="padding:8px;">
                                    <input name="AppNo" id="AppNo" type="text" value="<?php echo isset($_REQUEST['AppNo']) ? htmlspecialchars($_REQUEST['AppNo']) : ''; ?>" style="width:150px;" placeholder="Search Application No" tabindex="11"/>
                                </td>
                                <td style="padding:8px;"><strong>Roll No:</strong></td>
                                <td style="padding:8px;">
                                    <input name="RollNo" id="RollNo" type="text" value="<?php echo isset($_REQUEST['RollNo']) ? htmlspecialchars($_REQUEST['RollNo']) : ''; ?>" style="width:150px;" placeholder="Search Roll No" tabindex="11"/>
                                </td>
                                <td style="padding:8px;"><strong>Reg No:</strong></td>
                                <td style="padding:8px;">
                                    <input name="RegNo" id="RegNo" type="text" value="<?php echo isset($_REQUEST['RegNo']) ? htmlspecialchars($_REQUEST['RegNo']) : ''; ?>" style="width:150px;" placeholder="Search Reg No" tabindex="12"/>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:8px;"><strong>Student Name:</strong></td>
                                <td style="padding:8px;" colspan="1">
                                    <input name="StudentName" id="StudentName" type="text" value="<?php echo isset($_REQUEST['StudentName']) ? htmlspecialchars($_REQUEST['StudentName']) : ''; ?>" style="width:200px;" placeholder="Search by Student Name" tabindex="13"/>
                                </td>
                                <td style="padding:8px;"><strong>Father Name:</strong></td>
                                <td style="padding:8px;" colspan="1">
                                    <input name="FatherName" id="FatherName" type="text" value="<?php echo isset($_REQUEST['FatherName']) ? htmlspecialchars($_REQUEST['FatherName']) : ''; ?>" style="width:200px;" placeholder="Search by Father Name" tabindex="14"/>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" style="padding:12px; text-align:center;">
                                    <input type="submit" name="search" id="search" value="&#128269; Search" class="btn-action btn-search" tabindex="15"/>
                                    <input type="button" value="&#8635; Reset" class="btn-action btn-reset" onclick="window.location.href='<?php echo basename($_SERVER['PHP_SELF']); ?>'"/>
                                </td>

                            </tr>
                            <tr>
                            <td colspan="8" align="right">
							<div class="invoice_action_bar" style="float: right;">
							<div class="btn_30_blue">
								<a href="#" id="printRevenueBtn" original-title=""><span class="icon printer_co"></span><span class="btn_link">Revenue List</span></a>
							</div>
						</div>
						<div class="invoice_action_bar" style="float: right;">
							<div class="btn_30_blue">
								<a href="#" id="printChallanBtn" original-title=""><span class="icon printer_co"></span><span class="btn_link">Print Challan</span></a>
							</div>
						</div>
						<div class="invoice_action_bar" style="float: right;">
							<div class="btn_30_blue">
								<a href="#" id="printFormsBtn" original-title=""><span class="icon printer_co"></span><span class="btn_link">Private Forms</span></a>
							</div>
						</div>
						<div class="invoice_action_bar" style="float: right;">
							<div class="btn_30_blue">
								<a href="#" id="printAllFormsBtn" original-title=""><span class="icon printer_co"></span><span class="btn_link">Regular Forms</span></a>
							</div>
						</div>&nbsp;&nbsp;&nbsp;</td>
                            
                            </tr>
                            </form>
                        </table>
                        
                        <!-- Data Table -->
                        <table class="display data_tbl" id="students_table">
                            <thead>
                                <tr style="background:#f0f0f0;">
                                    <th style="padding:8px; border:1px solid #ddd;">SrNo</th>
                                    <th style="padding:8px; border:1px solid #ddd;">AppNo</th>
                                    <th style="padding:8px; border:1px solid #ddd;">Year</th>
                                    <th style="padding:8px; border:1px solid #ddd;">Sess</th>
                                    <th style="padding:8px; border:1px solid #ddd;">RollNo</th>
                                    <th style="padding:8px; border:1px solid #ddd;">RegNo</th>
                                    <th style="padding:8px; border:1px solid #ddd;">Student Name</th>
                                    <th style="padding:8px; border:1px solid #ddd;">Father Name</th>
                                    <th style="padding:8px; border:1px solid #ddd;">DOB</th>
                                    <th style="padding:8px; border:1px solid #ddd;">Gender</th>
                                    <th style="padding:8px; border:1px solid #ddd;">Category</th>
                                    <th style="padding:8px; border:1px solid #ddd;">Group</th>
                                    <th style="padding:8px; border:1px solid #ddd;">Combination</th>
                                    <th style="padding:8px; border:1px solid #ddd;">IsRegular</th>
							        <th style="padding:8px; border:1px solid #ddd;">Adm Category</th>
                                    <th style="padding:8px; border:1px solid #ddd;">Batch No</th>
                                    <th style="padding:8px; border:1px solid #ddd;">Batch Sr</th>
                                    <th style="padding:8px; border:1px solid #ddd;">Exam Centre</th>
                                    <th style="padding:8px; border:1px solid #ddd;">Adm Status</th>
                                    <th style="padding:8px; border:1px solid #ddd;">ChallanNo</th>
                                    <th style="padding:8px; border:1px solid #ddd;">Fee</th>
                                    <!-- <th style="padding:8px; border:1px solid #ddd;">Rev Status</th> -->
                                    <th style="padding:8px; border:1px solid #ddd;">ICode</th>
                                    <!-- <th style="padding:8px; border:1px solid #ddd;">Institute Name</th> -->
                                    <th style="padding:8px; border:1px solid #ddd;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            // Build search query
                            if(isset($_REQUEST['search'])) {
                                // Start with base WHERE clause
                                $where = "WHERE 1=1";
                                
                                // Institute filter
                                if(isset($_REQUEST['InstituteId']) && $_REQUEST['InstituteId'] != 'All' && $_REQUEST['InstituteId'] != '') {
                                    $where .= " AND InstituteId=" . intval($_REQUEST['InstituteId']);
                                }
                                
                                // Batch filter
                                if(isset($_REQUEST['BatchId']) && $_REQUEST['BatchId'] != 'All' && $_REQUEST['BatchId'] != '') {
                                    $where .= " AND BatchId=" . intval($_REQUEST['BatchId']);
                                }
                                
                                // Exam Year filter
                                if(isset($_REQUEST['ExamYear']) && $_REQUEST['ExamYear'] != 'All' && $_REQUEST['ExamYear'] != '') {
                                    $where .= " AND ExamYear='" . mysqli_real_escape_string($conn1, $_REQUEST['ExamYear']) . "'";
                                }
                                
                                // P1RollNo filter
                                if(isset($_REQUEST['P1RollNo']) && $_REQUEST['P1RollNo'] != '') {
                                    $where .= " AND P1RollNo LIKE '%" . mysqli_real_escape_string($conn1, $_REQUEST['P1RollNo']) . "%'";
                                }
                                
                                // Admission Status filter
                                if(isset($_REQUEST['StdAdmStatus']) && $_REQUEST['StdAdmStatus'] != 'All' && $_REQUEST['StdAdmStatus'] != '') {
                                    $where .= " AND StdAdmStatus=" . intval($_REQUEST['StdAdmStatus']);
                                }
                                
                              
                                // AppNo filter
                                if(isset($_REQUEST['AppNo']) && $_REQUEST['AppNo'] != '') {
                                    $where .= " AND AppId=" . intval($_REQUEST['AppNo']);
                                }

                                // Roll No filter 
                                if(isset($_REQUEST['RollNo']) && $_REQUEST['RollNo'] != '') {
                                    $where .= " AND RollNo LIKE '%" . mysqli_real_escape_string($conn1, $_REQUEST['RollNo']) . "%'";
                                }
                                
                                // Registration No filter (LIKE search)
                                if(isset($_REQUEST['RegNo']) && $_REQUEST['RegNo'] != '') {
                                    $where .= " AND RegNo LIKE '%" . mysqli_real_escape_string($conn1, $_REQUEST['RegNo']) . "%'";
                                }

                                // Batch No filter (LIKE search)
                                if(isset($_REQUEST['BatchNo']) && $_REQUEST['BatchNo'] != '') {
                                    $where .= " AND BatchNo LIKE '%" . mysqli_real_escape_string($conn1, $_REQUEST['BatchNo']) . "%'";
                                }
                                
                                // Student Name filter (LIKE search)
                                if(isset($_REQUEST['StudentName']) && $_REQUEST['StudentName'] != '') {
                                    $where .= " AND Name LIKE '%" . mysqli_real_escape_string($conn1, $_REQUEST['StudentName']) . "%'";
                                }
                                
                                // Father Name filter (LIKE search)
                                if(isset($_REQUEST['FatherName']) && $_REQUEST['FatherName'] != '') {
                                    $where .= " AND FatherName LIKE '%" . mysqli_real_escape_string($conn1, $_REQUEST['FatherName']) . "%'";
                                }
                                
                                $sql = "SELECT * FROM tbladm_10  " . $where . " ORDER BY Id DESC LIMIT 20";
                                $res = mysqli_query($conn1, $sql);
                                
                                if($res && mysqli_num_rows($res) > 0) {
                                    $SrNo = 1;
                                    while($row = mysqli_fetch_array($res)) {
                                        // Gender display
                                        if($row['Gender'] == 1){ $Gender='Male'; }
                                        else if($row['Gender'] == 2){ $Gender='Female'; }
                                        else { $Gender=''; }
                                        
                                        // Special category display
                                        if($row['IsSpecial'] == 1){ $IsSpecial="Board Employee's Child"; }
                                        else if($row['IsSpecial'] == 2){ $IsSpecial="Refugee's Child"; }
                                        else if($row['IsSpecial'] == 3){ $IsSpecial='Normal Case'; }
                                        else if($row['IsSpecial'] == 4){ $IsSpecial='Special Student'; }
                                        else if($row['IsSpecial'] == 5){ $IsSpecial='Orphan Student'; }
                                        else { $IsSpecial = ''; }
                                        
                                        // Admission status display
                                        if($row['StdAdmStatus'] == 0){ $StdAdmStatus='Pending'; }
                                        else if($row['StdAdmStatus'] == 1){ $StdAdmStatus='Ok'; }
                                        else if($row['StdAdmStatus'] == 2){ $StdAdmStatus='Not Ok'; }
                                        else { $StdAdmStatus = ''; }
                                        
                                        // Revision status display
                                        if($row['StdRevStatus'] == 0){ $StdRevStatus='Pending'; }
                                        else if($row['StdRevStatus'] == 1){ $StdRevStatus='Ok'; }
                                        else if($row['StdRevStatus'] == 2){ $StdRevStatus='Not Ok'; }
                                        else { $StdRevStatus = ''; }

                                        // AdmCategory status display
                                        if($row['AdmCategory'] == 1 && $row['SubCategory'] == 1){ $AdmSubCategory='Fresh AJK'; }
                                            else if($row['AdmCategory'] == 1 && $row['SubCategory'] == 2){ $AdmSubCategory='Composite AJK'; }
                                            else if($row['AdmCategory'] == 1 && $row['SubCategory'] == 3){ $AdmSubCategory='Fresh Other'; }
                                            else if($row['AdmCategory'] == 3 && $row['SubCategory'] == 1){ $AdmSubCategory='Improvement AJK'; }
                                            else if($row['AdmCategory'] == 4 && $row['SubCategory'] == 1){ $AdmSubCategory='Additional AJK'; }
                                            else if($row['AdmCategory'] == 5 && $row['SubCategory'] == 1){ $AdmSubCategory='Comp.Failure AJK'; }
                                            else if($row['AdmCategory'] == 5 && $row['SubCategory'] == 2){ $AdmSubCategory='Comp.Failure Other'; }
                                            else if($row['AdmCategory'] == 6 && $row['SubCategory'] == 1){ $AdmSubCategory='Compartment AJK'; }
                                            else if($row['AdmCategory'] == 6 && $row['SubCategory'] == 2){ $AdmSubCategory='Compartment Other'; }
                                            else if($row['AdmCategory'] == 7 && $row['SubCategory'] == 1){ $AdmSubCategory='Fresh After Passing Adeeb/Alam/Fazal'; }
                                            else if($row['AdmCategory'] == 7 && $row['SubCategory'] == 5){ $AdmSubCategory='Failure After Passing Adeeb/Alam/Fazal'; }
                                            else if($row['AdmCategory'] == 9 && $row['SubCategory'] == 1){ $AdmSubCategory='Fresh After Passing Shahadat Sanvia/Aama/Khasa'; }
                                            else if($row['AdmCategory'] == 9 && $row['SubCategory'] == 5){ $AdmSubCategory='Failure After Passing Shahadat Sanvia/Aama/Khasa'; }
                                            else { $AdmSubCategory=''; }
                                        ?>
                                        <tr>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo $SrNo;?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo $row['AppId'];?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo htmlspecialchars($row['ExamYear']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo htmlspecialchars($row['ExamSession']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo htmlspecialchars($row['RollNo']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo htmlspecialchars($row['RegNo']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd;"><?php echo htmlspecialchars($row['Name']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd;"><?php echo htmlspecialchars($row['FatherName']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo $row['DOB'] ? date('d-m-Y', strtotime($row['DOB'])) : '';?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo $Gender;?></td>
                                            <td style="padding:5px; border:1px solid #ddd;"><?php echo $IsSpecial;?></td>
                                            <td style="padding:5px; border:1px solid #ddd;"><?php echo htmlspecialchars($row['GroupName']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd;"><?php echo htmlspecialchars($row['CombinationName']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;">
                                            <?php if($row['IsRegular']==1){?><span class="badge_style b_done">Yes</span><?php }
                                            else{?><span class="badge_style b_pending">No</span><?php }?>
                                            </td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo $AdmSubCategory;?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo htmlspecialchars($row['BatchNo']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo htmlspecialchars($row['BatchSr']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo htmlspecialchars($row['ACentreCode']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo $StdAdmStatus;?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:right;"><?php echo $row['ChallanNo'];?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:right;"><?php echo round($row['AdmissionFee'], 0);?></td>
                                            <!-- <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo $StdRevStatus;?></td> -->
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo htmlspecialchars($row['InstituteCode']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd;"><?php echo htmlspecialchars($row['InstituteName']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center; white-space:nowrap;">
                                            <a href="allstudents_view10.php?Id=<?php echo $row['Id'];?>" class="btn-row btn-view">&#128065; View</a><br/>
                                                <a href="javascript:void(0);" class="btn-row btn-card" onclick="showStudentCard(<?php echo $row['Id'];?>, <?php echo $row['ExamYear'];?>)">&#127380; Card</a><br/>
                                                <a href="print_stdprvform10.php?Id=<?php echo $row['Id'];?>&eid=<?php echo $row['ExamYear'];?>" class="btn-row btn-row-print">&#128424; Print</a>
                                                <?php if(isset($_SESSION['emp_user_rights']) && is_array($_SESSION['emp_user_rights']) && in_array('140201', $_SESSION['emp_user_rights'])){?>
                                                <a href="allstudents_edit10.php?Id=<?php echo $row['Id'];?>" class="btn-row btn-edit">&#9998; Edit</a>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
                                        $SrNo++;
                                    }
                                } else {
                                    echo '<tr><td colspan="23" style="padding:20px; text-align:center; border:1px solid #ddd;">No records found matching your search criteria</td></tr>';
                                }
                            } else {
                                // Default query - show last 5 records
                                $sql = "SELECT * FROM tbladm_10 ORDER BY Id DESC LIMIT 5";
                                $res = mysqli_query($conn1, $sql);
                                
                                if($res && mysqli_num_rows($res) > 0) {
                                    $SrNo = 1;
                                    while($row = mysqli_fetch_array($res)) {
                                        // Gender display
                                        if($row['Gender'] == 1){ $Gender='Male'; }
                                        else if($row['Gender'] == 2){ $Gender='Female'; }
                                        else { $Gender=''; }
                                        
                                        // Special category display
                                        if($row['IsSpecial'] == 1){ $IsSpecial="Board Employee's Child"; }
                                        else if($row['IsSpecial'] == 2){ $IsSpecial="Refugee's Child"; }
                                        else if($row['IsSpecial'] == 3){ $IsSpecial='Normal Case'; }
                                        else if($row['IsSpecial'] == 4){ $IsSpecial='Special Student'; }
                                        else if($row['IsSpecial'] == 5){ $IsSpecial='Orphan Student'; }
                                        else { $IsSpecial = ''; }
                                        
                                        // Admission status display
                                        if($row['StdAdmStatus'] == 0){ $StdAdmStatus='Pending'; }
                                        else if($row['StdAdmStatus'] == 1){ $StdAdmStatus='Ok'; }
                                        else if($row['StdAdmStatus'] == 2){ $StdAdmStatus='Not Ok'; }
                                        else { $StdAdmStatus = ''; }
                                        
                                        // Revision status display
                                        if($row['StdRevStatus'] == 0){ $StdRevStatus='Pending'; }
                                        else if($row['StdRevStatus'] == 1){ $StdRevStatus='Ok'; }
                                        else if($row['StdRevStatus'] == 2){ $StdRevStatus='Not Ok'; }
                                        else { $StdRevStatus = ''; }

                                        // AdmCategory status display
                                        if($row['AdmCategory'] == 1 && $row['SubCategory'] == 1){ $AdmSubCategory='Fresh AJK'; }
                                            else if($row['AdmCategory'] == 1 && $row['SubCategory'] == 2){ $AdmSubCategory='Composite AJK'; }
                                            else if($row['AdmCategory'] == 1 && $row['SubCategory'] == 3){ $AdmSubCategory='Fresh Other'; }
                                            else if($row['AdmCategory'] == 3 && $row['SubCategory'] == 1){ $AdmSubCategory='Improvement AJK'; }
                                            else if($row['AdmCategory'] == 4 && $row['SubCategory'] == 1){ $AdmSubCategory='Additional AJK'; }
                                            else if($row['AdmCategory'] == 5 && $row['SubCategory'] == 1){ $AdmSubCategory='Comp.Failure AJK'; }
                                            else if($row['AdmCategory'] == 5 && $row['SubCategory'] == 2){ $AdmSubCategory='Comp.Failure Other'; }
                                            else if($row['AdmCategory'] == 6 && $row['SubCategory'] == 1){ $AdmSubCategory='Compartment AJK'; }
                                            else if($row['AdmCategory'] == 6 && $row['SubCategory'] == 2){ $AdmSubCategory='Compartment Other'; }
                                            else if($row['AdmCategory'] == 7 && $row['SubCategory'] == 1){ $AdmSubCategory='Fresh After Passing Adeeb/Alam/Fazal'; }
                                            else if($row['AdmCategory'] == 7 && $row['SubCategory'] == 5){ $AdmSubCategory='Failure After Passing Adeeb/Alam/Fazal'; }
                                            else if($row['AdmCategory'] == 9 && $row['SubCategory'] == 1){ $AdmSubCategory='Fresh After Passing Shahadat Sanvia/Aama/Khasa'; }
                                            else if($row['AdmCategory'] == 9 && $row['SubCategory'] == 5){ $AdmSubCategory='Failure After Passing Shahadat Sanvia/Aama/Khasa'; }
                                            else { $AdmSubCategory=''; }
                                        ?>
                                        <tr>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo $SrNo;?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo $row['Id'];?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo htmlspecialchars($row['ExamYear']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo htmlspecialchars($row['ExamSession']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo htmlspecialchars($row['RollNo']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo htmlspecialchars($row['RegNo']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd;"><?php echo htmlspecialchars($row['Name']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd;"><?php echo htmlspecialchars($row['FatherName']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo $row['DOB'] ? date('d-m-Y', strtotime($row['DOB'])) : '';?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo $Gender;?></td>
                                            <td style="padding:5px; border:1px solid #ddd;"><?php echo $IsSpecial;?></td>
                                            <td style="padding:5px; border:1px solid #ddd;"><?php echo htmlspecialchars($row['GroupName']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd;"><?php echo htmlspecialchars($row['CombinationName']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;">
                                            <?php if($row['IsRegular']==1){?><span class="badge_style b_done">Yes</span><?php }
                                            else{?><span class="badge_style b_pending">No</span><?php }?>
                                            </td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo htmlspecialchars($AdmSubCategory);?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo htmlspecialchars($row['BatchNo']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo htmlspecialchars($row['BatchSr']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo htmlspecialchars($row['ACentreCode']);?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo $StdAdmStatus;?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:right;"><?php echo $row['ChallanNo'];?></td>
                                            <td style="padding:5px; border:1px solid #ddd; text-align:right;"><?php echo round($row['AdmissionFee'], 0);?></td>
                                            <!-- <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo $StdRevStatus;?></td> -->
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center;"><?php echo htmlspecialchars($row['InstituteCode']);?></td>
                                            <!-- <td style="padding:5px; border:1px solid #ddd;"><?php echo htmlspecialchars($row['InstituteName']);?></td> -->
                                            <td style="padding:5px; border:1px solid #ddd; text-align:center; white-space:nowrap;">
                                                <a href="allstudents_view10.php?Id=<?php echo $row['Id'];?>" class="btn-row btn-view">&#128065; View</a><br/>
                                                <a href="javascript:void(0);" class="btn-row btn-card" onclick="showStudentCard(<?php echo $row['Id'];?>, <?php echo $row['ExamYear'];?>)">&#127380; Card</a><br/>
                                                <a href="print_stdprvform10.php?Id=<?php echo $row['Id'];?>&eid=<?php echo $row['ExamYear'];?>" class="btn-row btn-row-print">&#128424; Print</a>
                                                <?php if(isset($_SESSION['emp_user_rights']) && is_array($_SESSION['emp_user_rights']) && in_array('140201', $_SESSION['emp_user_rights'])){?>
                                                <a href="allstudents_edit10.php?Id=<?php echo $row['Id'];?>" class="btn-row btn-edit">&#9998; Edit</a>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
                                        $SrNo++;
                                    }
                                } else {
                                    echo '<tr><td colspan="23" style="padding:20px; text-align:center; border:1px solid #ddd;">No records found</td></tr>';
                                }
                            }
                            ?>
                            </tbody>
                         </table>
                        
                        <?php
                        if(!isset($_REQUEST['search']) && isset($res) && mysqli_num_rows($res) > 0) { 
                        ?>
                        <div style="margin-top:20px; text-align:right; padding:10px; background:#f5f5f5; border:1px solid #ddd;">
                            <strong>Showing last 5 records. Use search filters to see more.</strong>
                        </div>
                        <?php 
                        } 
                        ?>
                        
                        <?php 
                        if(isset($_REQUEST['search']) && isset($res) && mysqli_num_rows($res) > 0) { 
                        ?>
                        <div style="margin-top:20px; text-align:right; padding:10px; background:#f5f5f5; border:1px solid #ddd;">
                            <strong>Total Records Found: 
                            <?php 
                            echo mysqli_num_rows($res); 
                            ?></strong>
                        </div>
                        <?php 
                        } 
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Student Card Modal -->
<div class="modal-overlay" id="studentCardModal" onclick="if(event.target===this)closeModal()">
    <div class="modal-card">
        <div class="modal-card-header">
            <h3>&#127380; Student Information Card</h3>
            <button class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-card-body" id="modalCardBody">
            <div style="text-align:center; padding:40px; color:#999;">Loading...</div>
        </div>
    </div>
</div>

<script>
// Number validation function
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

// Initialize Chosen selects if the plugin exists
$(document).ready(function() {
    if(typeof jQuery !== 'undefined') {
        if($.fn.chosen) {
            $(".chzn-select").chosen({width: "100%"});
        }
    }

    // AJAX: Load batches when InstituteId changes, filtered by ExamYear + InstituteId
    $('#InstituteId').on('change', function() {
        var examYear = $('#ExamYear').val();
        var instId   = $('#InstituteId').val();
        var $batchSelect = $('#BatchId');

        $batchSelect.html('<option value="All">All Batches</option>');
        if($.fn.chosen) { $batchSelect.trigger('liszt:updated'); }

        if(instId == 'All' || instId == '') return; // nothing to filter

        $.ajax({
            url: 'ajax_batchesByYear10.php',
            type: 'GET',
            data: { ExamYear: examYear, InstituteId: instId },
            success: function(response) {
                $batchSelect.html(response);
                if($.fn.chosen) { $batchSelect.trigger('liszt:updated'); }
            },
            error: function() {
                $batchSelect.html('<option value="All">All Batches</option>');
                if($.fn.chosen) { $batchSelect.trigger('liszt:updated'); }
            }
        });
    });

    // Print buttons — build URL from current dropdown selections
    function getPrintParams() {
        return {
            batch : $('#BatchId').val()    || 'All',
            inst  : $('#InstituteId').val() || 'All',
            eid   : $('#ExamYear').val()   || 'All'
        };
    }
    function requireSelection(p) {
        if(p.batch === 'All' || p.inst === 'All' || p.eid === 'All') {
            alert('Please select Exam Year, Institute and Batch No before printing.');
            return false;
        }
        return true;
    }

    $('#printRevenueBtn').on('click', function(e) {
        e.preventDefault();
        var p = getPrintParams();
        if(!requireSelection(p)) return;
        window.open('print_admrevenuelist10.php?BatchId=' + encodeURIComponent(p.batch) + '&INST=' + encodeURIComponent(p.inst) + '&EID=' + encodeURIComponent(p.eid), '_blank');
    });

    $('#printChallanBtn').on('click', function(e) {
        e.preventDefault();
        var p = getPrintParams();
        if(!requireSelection(p)) return;
        window.open('print_admchallan10.php?BatchId=' + encodeURIComponent(p.batch) + '&INST=' + encodeURIComponent(p.inst) + '&EID=' + encodeURIComponent(p.eid), '_blank');
    });

    $('#printFormsBtn').on('click', function(e) {
        e.preventDefault();
        var p = getPrintParams();
        if(!requireSelection(p)) return;
        window.open('print_stdprvform10.php?BatchId=' + encodeURIComponent(p.batch) + '&INST=' + encodeURIComponent(p.inst) + '&EID=' + encodeURIComponent(p.eid), '_blank');
    });

    $('#printAllFormsBtn').on('click', function(e) {
        e.preventDefault();
        var p = getPrintParams();
        if(!requireSelection(p)) return;
        window.open('print_stdregform10.php?BatchId=' + encodeURIComponent(p.batch) + '&INST=' + encodeURIComponent(p.inst) + '&EID=' + encodeURIComponent(p.eid), '_blank');
    });
});

// Student Card Modal Functions
function showStudentCard(id, eid) {
    document.getElementById('studentCardModal').classList.add('active');
    document.getElementById('modalCardBody').innerHTML = '<div style="text-align:center; padding:40px; color:#999;">Loading...</div>';
    document.body.style.overflow = 'hidden';

    $.ajax({
        url: 'ajax_studentcard10.php',
        type: 'GET',
        data: { Id: id, eid: eid },
        success: function(response) {
            document.getElementById('modalCardBody').innerHTML = response;
        },
        error: function() {
            document.getElementById('modalCardBody').innerHTML = '<div style="text-align:center; padding:40px; color:#C62828;">Failed to load student data.</div>';
        }
    });
}

function closeModal() {
    document.getElementById('studentCardModal').classList.remove('active');
    document.body.style.overflow = '';
}

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if(e.key === 'Escape') closeModal();
});
</script>

<?php
$footer_file = 'includes/footer.php';
if(file_exists($footer_file)) {
    include($footer_file);
}
?>