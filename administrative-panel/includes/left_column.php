<!-- <div id="actionsBox" class="actionsBox">
	<div id="actionsBoxMenu" class="menu">
		<span id="cntBoxMenu">0</span>
		<a class="button box_action">Archive</a>
		<a class="button box_action">Delete</a>
		<a id="toggleBoxMenu" class="open"></a>
		<a id="closeBoxMenu" class="button t_close">X</a>
	</div>
	<div class="submenu">
		<a class="first box_action">Move...</a>
		<a class="box_action">Mark as read</a>
		<a class="box_action">Mark as unread</a>
		<a class="last box_action">Spam</a>
	</div>
</div> -->
<!-- <script>alert('<?php echo $_SESSION['emp_user_rights']; ?>');</script> -->
<div id="left_bar">
	<div id="sidebar">
		<div id="secondary_nav">
			<ul id="sidenav" class="accordion_mnu collapsible">
				<li><a href="<?php echo SITE_URL;?>"><span class="nav_icon computer_imac"></span>Dashboard</a></li>
				<?php if(in_array('300',$_SESSION['emp_user_rights'])){?>
				<li><a id="settings_li" href="#"><span class="nav_icon home_2"></span>Settings<span class="alert_notify blue">6</span>
				<span class="up_down_arrow">&nbsp;</span></a>
					<ul class="acitem">
						<?php if(in_array('301',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'sessions.php')){echo 'class="active_li"';}?>><a href="sessions.php"><span class="list-icon">&nbsp;</span>All Sessions</a></li>
						<?php }?>
						<?php if(in_array('302',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'exams.php')){echo 'class="active_li"';}?>><a href="exams.php"><span class="list-icon">&nbsp;</span>All Exams</a></li>
						<?php }?>
						<?php if(in_array('303',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'subjects.php')){echo 'class="active_li"';}?>><a href="subjects.php"><span class="list-icon">&nbsp;</span>All Subjects</a></li>
						<?php }?>
						<?php if(in_array('304',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'subjgroups.php')){echo 'class="active_li"';}?>><a href="subjgroups.php"><span class="list-icon">&nbsp;</span>All Subject Groups</a></li>
						<?php }?>
						<?php if(in_array('305',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'subjcombinations.php')){echo 'class="active_li"';}?>><a href="subjcombinations.php"><span class="list-icon">&nbsp;</span>All Subject Combinations</a></li>
						<?php }?>
						<?php if(in_array('306',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'schedule.php')){echo 'class="active_li"';}?>><a href="schedule.php"><span class="list-icon">&nbsp;</span>Schedule</a></li>
						<?php }?>
					</ul>
				</li>
				<?php if(strpos($_SERVER['PHP_SELF'],'sessions.php')||strpos($_SERVER['PHP_SELF'],'exams.php')||
				strpos($_SERVER['PHP_SELF'],'subjects.php')||strpos($_SERVER['PHP_SELF'],'subjgroups.php')||
				strpos($_SERVER['PHP_SELF'],'subjcombinations.php')||strpos($_SERVER['PHP_SELF'],'schedule.php')){?>
				<script>
				$(document).ready(function(){
				$("#settings_li").trigger("click");
				});
				</script>
				<?php }?>
				<?php }?>
				
				<?php if(in_array('400',$_SESSION['emp_user_rights'])){?>
				<li><a id="misc-records_li" href="#"><span class="nav_icon computer_imac"></span>Manage Results<span class="alert_notify blue">3</span>
				<span class="up_down_arrow">&nbsp;</span></a>
					<ul class="acitem">
						<?php if(in_array('401',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'sscrecords09.php')){echo 'class="active_li"';}?>><a href="SearchResultsSSCI.php"><span class="list-icon">&nbsp;</span>SSC(Part-I)</a></li>
						<?php }?>
						<?php if(in_array('402',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'sscrecords10.php')){echo 'class="active_li"';}?>><a href="SearchResultsSSCII.php"><span class="list-icon">&nbsp;</span>SSC(Part-II)</a></li>
						<?php }?>
					</ul>
				</li>
				<?php if(strpos($_SERVER['PHP_SELF'],'sscrecords09.php')||strpos($_SERVER['PHP_SELF'],'sscrecords10.php')||
				strpos($_SERVER['PHP_SELF'],'records_log.php')){?>
				<script>
				$(document).ready(function(){
				$("#misc-records_li").trigger("click");
				});
				</script>
				<?php }?>
				<?php }?>
							
				
				<?php if(in_array('400',$_SESSION['emp_user_rights'])){?>
				<li><a id="misc-records_li" href="#"><span class="nav_icon computer_imac"></span>Manage Misc. Record<span class="alert_notify blue">3</span>
				<span class="up_down_arrow">&nbsp;</span></a>
					<ul class="acitem">
						<?php if(in_array('401',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'sscrecords09.php')){echo 'class="active_li"';}?>><a href="sscrecords09.php"><span class="list-icon">&nbsp;</span>SSC(Part-I) Records</a></li>
						<?php }?>
						<?php if(in_array('402',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'sscrecords10.php')){echo 'class="active_li"';}?>><a href="sscrecords10.php"><span class="list-icon">&nbsp;</span>SSC(Part-II) Records</a></li>
						<?php }?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'records_log.php')){echo 'class="active_li"';}?>><a href="records_log.php"><span class="list-icon">&nbsp;</span>Records Log</a></li>
					</ul>
				</li>
				<?php if(strpos($_SERVER['PHP_SELF'],'sscrecords09.php')||strpos($_SERVER['PHP_SELF'],'sscrecords10.php')||
				strpos($_SERVER['PHP_SELF'],'records_log.php')){?>
				<script>
				$(document).ready(function(){
				$("#misc-records_li").trigger("click");
				});
				</script>
				<?php }?>
				<?php }?>
				
				<?php if(in_array('500',$_SESSION['emp_user_rights'])){?>
				<li><a id="reg-records_li" href="#"><span class="nav_icon computer_imac"></span>SSC Registration Records<span class="alert_notify blue">2</span>
				<span class="up_down_arrow">&nbsp;</span></a>
					<ul class="acitem">
						<?php if(in_array('501',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'regrecords_all.php')){echo 'class="active_li"';}?>><a href="regrecords_all.php"><span class="list-icon">&nbsp;</span>All Records</a></li>
						<?php }?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'regrecords_log.php')){echo 'class="active_li"';}?>><a href="regrecords_log.php"><span class="list-icon">&nbsp;</span>Records Log</a></li>
					</ul>
				</li>
				<?php if(strpos($_SERVER['PHP_SELF'],'regrecords_all.php')||strpos($_SERVER['PHP_SELF'],'regrecords_log.php')){?>
				<script>
				$(document).ready(function(){
				$("#reg-records_li").trigger("click");
				});
				</script>
				<?php }?>
				<?php }?>
				
				<?php if(in_array('700',$_SESSION['emp_user_rights'])){?>
				<li><a id="academics_li" href="#"><span class="nav_icon computer_imac"></span>Manage Academics<span class="alert_notify blue">7</span>
                <span class="up_down_arrow">&nbsp;</span></a>
					<ul class="acitem">
						<?php if(in_array('701',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'institutes.php')){echo 'class="active_li"';}?>><a href="institutes.php"><span class="list-icon">&nbsp;</span>All Institutes</a></li>
						<?php }?>
						<?php if(in_array('702',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'centres.php')){echo 'class="active_li"';}?>><a href="centres.php"><span class="list-icon">&nbsp;</span>All Centres</a></li>
						<?php }?>
						<?php if(in_array('703',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'instreg_rights.php')){echo 'class="active_li"';}?>><a href="instreg_rights.php"><span class="list-icon">&nbsp;</span>Institutes Rights(Reg)</a></li>
						<?php }?>
						<?php if(in_array('704',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'instadm_rights09.php')){echo 'class="active_li"';}?>><a href="instadm_rights09.php"><span class="list-icon">&nbsp;</span>Institutes Rights(Adm) (Part-I)</a></li>
						<?php }?>
						<?php if(in_array('705',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'instadm_rights10.php')){echo 'class="active_li"';}?>><a href="instadm_rights10.php"><span class="list-icon">&nbsp;</span>Institutes Rights(Adm) (Part-II)</a></li>
						<?php }?>
						<?php if(in_array('706',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'allstudents_instpanel.php')){echo 'class="active_li"';}?>><a href="allstudents_instpanel.php"><span class="list-icon">&nbsp;</span>All Students(Institute Panel)</a></li>
						<?php }?>
						<?php if(in_array('707',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'allstudents_otherpanel.php')){echo 'class="active_li"';}?>><a href="allstudents_otherpanel.php"><span class="list-icon">&nbsp;</span>All Students(Other Panel)</a></li>
						<?php }?>
					</ul>
				</li>
				<?php if(strpos($_SERVER['PHP_SELF'],'institutes.php')||strpos($_SERVER['PHP_SELF'],'centres.php')||
				strpos($_SERVER['PHP_SELF'],'instreg_rights.php')||strpos($_SERVER['PHP_SELF'],'instadm_rights09.php')||
				strpos($_SERVER['PHP_SELF'],'instadm_rights10.php')||strpos($_SERVER['PHP_SELF'],'allstudents_instpanel.php')||
				strpos($_SERVER['PHP_SELF'],'allstudents_otherpanel.php')){?>
				<script>
				$(document).ready(function(){
				$("#academics_li").trigger("click");
				});
				</script>
				<?php }?>
				<?php }?>
				
				<?php if(in_array('800',$_SESSION['emp_user_rights'])){?>
				<li><a id="registration_li" href="#"><span class="nav_icon computer_imac"></span>Manage Registration<span class="alert_notify blue">2</span>
				<span class="up_down_arrow">&nbsp;</span></a>
					<ul class="acitem">
						<?php if(in_array('801',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'allbatches_reg.php')){echo 'class="active_li"';}?>><a href="allbatches_reg.php"><span class="list-icon">&nbsp;</span>All Batches</a></li>
						<?php }?>
						<?php if(in_array('802',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'allstudents_reg.php')){echo 'class="active_li"';}?>><a href="allstudents_reg.php"><span class="list-icon">&nbsp;</span>All Students</a></li>
						<?php }?>
					</ul>
				</li>
				<?php if(strpos($_SERVER['PHP_SELF'],'allbatches_reg.php')||strpos($_SERVER['PHP_SELF'],'allstudents_reg.php')){?>
				<script>
				$(document).ready(function(){
				$("#registration_li").trigger("click");
				});
				</script>
				<?php }?>
				<?php }?>
							
				<?php if(in_array('1400',$_SESSION['emp_user_rights'])){?>
				<li><a id="admission10_li" href="#"><span class="nav_icon computer_imac"></span>Manage Admission (Part-II)<span class="alert_notify blue">4</span>
				<span class="up_down_arrow">&nbsp;</span></a>
					<ul class="acitem">
						<?php if(in_array('1401',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'allbatches_radm10.php')){echo 'class="active_li"';}?>><a href="allbatches_radm10.php"><span class="list-icon">&nbsp;</span>All Regular Batches</a></li>
						<?php }?>
						<?php if(in_array('1402',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'allstudents_radm10.php')){echo 'class="active_li"';}?>><a href="allstudents_radm10.php"><span class="list-icon">&nbsp;</span>All Regular Students</a></li>
						<?php }?>
						<?php if(in_array('1403',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'allbatches_padm10.php')){echo 'class="active_li"';}?>><a href="allbatches_padm10.php"><span class="list-icon">&nbsp;</span>All Private Batches</a></li>
						<?php }?>
						<?php if(in_array('1404',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'allstudents_padm10.php')){echo 'class="active_li"';}?>><a href="allstudents_padm10.php"><span class="list-icon">&nbsp;</span>All Private Students</a></li>
						<?php }?>
					</ul>
				</li>
				<?php if(strpos($_SERVER['PHP_SELF'],'allbatches_radm10.php')||strpos($_SERVER['PHP_SELF'],'allstudents_radm10.php')||
				strpos($_SERVER['PHP_SELF'],'allbatches_padm10.php')||strpos($_SERVER['PHP_SELF'],'allstudents_padm10.php')){?>
				<script>
				$(document).ready(function(){
				$("#admission10_li").trigger("click");
				});
				</script>
				<?php }?>
				<?php }?>
				
				<?php if(in_array('1500',$_SESSION['emp_user_rights'])){?>
				<li><a id="admbatches10_li" href="#"><span class="nav_icon computer_imac"></span>Manage Admission Batches (Part-II)<span class="alert_notify blue">6</span>
				<span class="up_down_arrow">&nbsp;</span></a>
					<ul class="acitem">
						<?php if(in_array('1501',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'ed_radmbatches10.php')){echo 'class="active_li"';}?>><a href="ed_radmbatches10.php"><span class="list-icon">&nbsp;</span>Check Reg. Batches for Delete Req.</a></li>
						<?php }?>
						<?php if(in_array('1502',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'lock_radmbatches10.php')){echo 'class="active_li"';}?>><a href="lock_radmbatches10.php"><span class="list-icon">&nbsp;</span>Delete Reg. Batches</a></li>
						<?php }?>
						<!--<?php if(in_array('1503',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'adm_radmbatches10.php')){echo 'class="active_li"';}?>><a href="adm_radmbatches10.php"><span class="list-icon">&nbsp;</span>Check Reg. Batches for Adm.</a></li>
						<?php }?>
						<?php if(in_array('1504',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'rev_radmbatches10.php')){echo 'class="active_li"';}?>><a href="rev_radmbatches10.php"><span class="list-icon">&nbsp;</span>Check Reg. Batches for Rev.</a></li>
						<?php }?>-->
						<?php if(in_array('1505',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'admmrevv_radmbatches10.php')){echo 'class="active_li"';}?>><a href="admmrevv_radmbatches10.php"><span class="list-icon">&nbsp;</span>Check Reg. Batches for Adm/Rev</a></li>
						<?php }?>
						<!--<?php if(in_array('1506',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'adm_padmbatches10.php')){echo 'class="active_li"';}?>><a href="adm_padmbatches10.php"><span class="list-icon">&nbsp;</span>Check Priv. Batches for Adm.</a></li>
						<?php }?>
						<?php if(in_array('1507',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'rev_padmbatches10.php')){echo 'class="active_li"';}?>><a href="rev_padmbatches10.php"><span class="list-icon">&nbsp;</span>Check Priv. Batches for Rev.</a></li>
						<?php }?>-->
						<?php if(in_array('1508',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'admrev_admstudents10.php')){echo 'class="active_li"';}?>><a href="admrev_admstudents10.php"><span class="list-icon">&nbsp;</span>Check Students for Adm/Rev</a></li>
						<?php }?>
						<?php if(in_array('1509',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'updtchlnno_admstudents10.php')){echo 'class="active_li"';}?>><a href="updtchlnno_admstudents10.php"><span class="list-icon">&nbsp;</span>ChallanNo Updation</a></li>
						<?php }?>
						<?php if(in_array('1510',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'updtchlnfee_admstudents10.php')){echo 'class="active_li"';}?>><a href="updtchlnfee_admstudents10.php"><span class="list-icon">&nbsp;</span>ChallanFee Updation</a></li>
						<?php }?>
					</ul>
				</li>
				<?php if(strpos($_SERVER['PHP_SELF'],'ed_radmbatches10.php')||strpos($_SERVER['PHP_SELF'],'lock_radmbatches10.php')||
				strpos($_SERVER['PHP_SELF'],'adm_radmbatches10.php')||strpos($_SERVER['PHP_SELF'],'rev_radmbatches10.php')||
				strpos($_SERVER['PHP_SELF'],'admmrevv_radmbatches10.php')||strpos($_SERVER['PHP_SELF'],'adm_padmbatches10.php')||
				strpos($_SERVER['PHP_SELF'],'rev_padmbatches10.php')||strpos($_SERVER['PHP_SELF'],'admrev_admstudents10.php')||
				strpos($_SERVER['PHP_SELF'],'updtchlnno_admstudents10.php')||strpos($_SERVER['PHP_SELF'],'updtchlnfee_admstudents10.php')){?>
				<script>
				$(document).ready(function(){
				$("#admbatches10_li").trigger("click");
				});
				</script>
				<?php }?>
				<?php }?>
				
				<?php if(in_array('1600',$_SESSION['emp_user_rights'])){?>
				<li><a id="exam10_li" href="#"><span class="nav_icon computer_imac"></span>Conduct of Exam (Part-II)<span class="alert_notify blue">11</span>
				<span class="up_down_arrow">&nbsp;</span></a>
					<ul class="acitem">
						<?php if(in_array('1601',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'examstudents_reg10.php')){echo 'class="active_li"';}?>><a href="examstudents_reg10.php"><span class="list-icon">&nbsp;</span>All Regular Students</a></li>
						<?php }?>
						<?php if(in_array('1602',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'examstudents_priv10.php')){echo 'class="active_li"';}?>><a href="examstudents_priv10.php"><span class="list-icon">&nbsp;</span>All Private Students</a></li>
						<?php }?>
						<?php if(in_array('1603',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'updtcent_instwise10.php')){echo 'class="active_li"';}?>><a href="updtcent_instwise10.php"><span class="list-icon">&nbsp;</span>Change Centre(Institute Wise)</a></li>
						<?php }?>
						<?php if(in_array('1604',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'updtcent_centwise10.php')){echo 'class="active_li"';}?>><a href="updtcent_centwise10.php"><span class="list-icon">&nbsp;</span>Change Centre(Centre Wise)</a></li>
						<?php }?>
						<?php if(in_array('1605',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'updtshift_instwise10.php')){echo 'class="active_li"';}?>><a href="updtshift_instwise10.php"><span class="list-icon">&nbsp;</span>Change Shift(Institute Wise)</a></li>
						<?php }?>
						<?php if(in_array('1606',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'updtshift_centwise10.php')){echo 'class="active_li"';}?>><a href="updtshift_centwise10.php"><span class="list-icon">&nbsp;</span>Change Shift(Centre Wise)</a></li>
						<?php }?>
						<?php if(in_array('1607',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'gen_rollno10.php')){echo 'class="active_li"';}?>><a href="gen_rollno10.php"><span class="list-icon">&nbsp;</span>Generate RollNos</a></li>
						<?php }?>
						<?php if(in_array('1608',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'regstudents-rollnoslips10.php')){echo 'class="active_li"';}?>><a href="regstudents-rollnoslips10.php"><span class="list-icon">&nbsp;</span>RollNo Slips(Regular Students)</a></li>
						<?php }?>
						<?php if(in_array('1609',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'privstudents-rollnoslips10.php')){echo 'class="active_li"';}?>><a href="privstudents-rollnoslips10.php"><span class="list-icon">&nbsp;</span>RollNo Slips(Private Students)</a></li>
						<?php }?>
						<?php if(in_array('1610',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'allstudents-centreslips10.php')){echo 'class="active_li"';}?>><a href="allstudents-centreslips10.php"><span class="list-icon">&nbsp;</span>Centre Slips(All Students)</a></li>
						<?php }?>
						<?php if(in_array('1611',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'allstudents-practrollnoslip10.php')){echo 'class="active_li"';}?>><a href="allstudents-practrollnoslip10.php"><span class="list-icon">&nbsp;</span>Practical RollNo Slips(All Students)</a></li>
						<?php }?>
					</ul>
				</li>
				<?php if(strpos($_SERVER['PHP_SELF'],'examstudents_reg10.php')||strpos($_SERVER['PHP_SELF'],'examstudents_priv10.php')||
				strpos($_SERVER['PHP_SELF'],'updtcent_instwise10.php')||strpos($_SERVER['PHP_SELF'],'updtcent_centwise10.php')||
				strpos($_SERVER['PHP_SELF'],'updtshift_instwise10.php')||strpos($_SERVER['PHP_SELF'],'updtshift_centwise10.php')||
				strpos($_SERVER['PHP_SELF'],'gen_rollno10.php')||strpos($_SERVER['PHP_SELF'],'regstudents-rollnoslips10.php')||
				strpos($_SERVER['PHP_SELF'],'privstudents-rollnoslips10.php')||strpos($_SERVER['PHP_SELF'],'allstudents-centreslips10.php')||
				strpos($_SERVER['PHP_SELF'],'allstudents-practrollnoslip10.php')){?>
				<script>
				$(document).ready(function(){
				$("#exam10_li").trigger("click");
				});
				</script>
				<?php }?>
				<?php }?>
				
				<?php if(in_array('1700',$_SESSION['emp_user_rights'])){?>
				<li><a id="gen-ed10_li" href="#"><span class="nav_icon computer_imac"></span>General Edit/Delete (Part-II)<span class="alert_notify blue">2</span>
				<span class="up_down_arrow">&nbsp;</span></a>
					<ul class="acitem">
						<?php if(in_array('1701',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'allstudents_edit10.php')){echo 'class="active_li"';}?>><a href="allstudents_edit10.php"><span class="list-icon">&nbsp;</span>Edit Student</a></li>
						<?php }?>
						<?php if(in_array('1702',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'allstudents_delete10.php')){echo 'class="active_li"';}?>><a href="allstudents_delete10.php"><span class="list-icon">&nbsp;</span>Delete Student</a></li>
						<?php }?>
					</ul>
				</li>
				<?php if(strpos($_SERVER['PHP_SELF'],'allstudents_edit10.php')||strpos($_SERVER['PHP_SELF'],'allstudents_delete10.php')){?>
				<script>
				$(document).ready(function(){
				$("#gen-ed10_li").trigger("click");
				});
				</script>
				<?php }?>
				<?php }?>
				
				<li><a id="gen-search10_li" href="#"><span class="nav_icon computer_imac"></span>General Search (Part-II)<span class="alert_notify blue">2</span>
				<span class="up_down_arrow">&nbsp;</span></a>
					<ul class="acitem">
						<li <?php if(strpos($_SERVER['PHP_SELF'],'allstudents_search10.php')){echo 'class="active_li"';}?>><a href="allstudents_search10.php"><span class="list-icon">&nbsp;</span>Seacrh Student</a></li>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'allstudents_log10.php')){echo 'class="active_li"';}?>><a href="allstudents_log10.php"><span class="list-icon">&nbsp;</span>Seacrh Student Log</a></li>
					</ul>
				</li>
				<?php if(strpos($_SERVER['PHP_SELF'],'allstudents_search10.php')||strpos($_SERVER['PHP_SELF'],'allstudents_log10.php')){?>
				<script>
				$(document).ready(function(){
				$("#gen-search10_li").trigger("click");
				});
				</script>
				<?php }?>
				
				<?php if(in_array('2100',$_SESSION['emp_user_rights'])){?>
				<li><a id="datesheet_li" href="#"><span class="nav_icon computer_imac"></span>DateSheet (I & II)<span class="alert_notify blue">1</span>
				<span class="up_down_arrow">&nbsp;</span></a>
					<ul class="acitem">
						<?php if(in_array('2101',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'datesheet.php')){echo 'class="active_li"';}?>><a href="datesheet.php"><span class="list-icon">&nbsp;</span>Date Sheet</a></li>
						<?php }?>
					</ul>
				</li>
				<?php if(strpos($_SERVER['PHP_SELF'],'datesheet.php')){?>
				<script>
				$(document).ready(function(){
				$("#datesheet_li").trigger("click");
				});
				</script>
				<?php }?>
				<?php }?>
				
				<?php if(in_array('2300',$_SESSION['emp_user_rights'])){?>
				<li><a id="migration_li" href="#"><span class="nav_icon computer_imac"></span>Manage Migrations<span class="alert_notify blue">2</span>
				<span class="up_down_arrow">&nbsp;</span></a>
					<ul class="acitem">
						<?php if(in_array('2301',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'students_migration09.php')){echo 'class="active_li"';}?>><a href="students_migration09.php"><span class="list-icon">&nbsp;</span>Students (SSC Part-I)</a></li>
						<?php }?>
						<?php if(in_array('2302',$_SESSION['emp_user_rights'])){?>
						<li <?php if(strpos($_SERVER['PHP_SELF'],'students_migration10.php')){echo 'class="active_li"';}?>><a href="students_migration10.php"><span class="list-icon">&nbsp;</span>Students (SSC Part-II)</a></li>
						<?php }?>
					</ul>
				</li>
				<?php if(strpos($_SERVER['PHP_SELF'],'students_migration09.php')||strpos($_SERVER['PHP_SELF'],'students_migration10.php')){?>
				<script>
				$(document).ready(function(){
				$("#migration_li").trigger("click");
				});
				</script>
				<?php }?>
				<?php }?>
			</ul>
		</div>
	</div>
</div>