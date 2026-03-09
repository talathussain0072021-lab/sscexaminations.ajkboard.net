<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
    <?php
	if(isset($_REQUEST['submit']))
	{		
		$RollNoArray=explode(',',$_REQUEST['RollNos']);
		
		if($_REQUEST['Class'] == 11)
		{
			for($i=0; $i < sizeof($RollNoArray); $i++)
			{
				$sql1="SELECT Sub4Code, Sub5Code, Sub6Code FROM tbladmissmdtechapii18 WHERE RollNo='".$RollNoArray[$i]."'";
				$res1=mysql_query($sql1, $conn1);
				$result1=mysql_fetch_array($res1);
				
				if($result1['Sub4Code'] == $_REQUEST['SubjectCode'])
				{
					$sql_updt="UPDATE tbladmissmdtechapii18 SET
					Sub4Date			=		'".date('Y-m-d',strtotime($_REQUEST['PracticalDate']))."',
					Sub4Day				=		'".$_REQUEST['PracticalDay']."',
					Sub4Time			=		'".$_REQUEST['PracticalTime']."',
					Lab4Name			=		'".$_REQUEST['PracticalLab']."'
					WHERE RollNo		=		'".$RollNoArray[$i]."'";
					$res_updt=mysql_query($sql_updt, $conn1);
				}
				else if($result1['Sub5Code'] == $_REQUEST['SubjectCode'])
				{
					$sql_updt="UPDATE tbladmissmdtechapii18 SET
					Sub5Date			=		'".date('Y-m-d',strtotime($_REQUEST['PracticalDate']))."',
					Sub5Day				=		'".$_REQUEST['PracticalDay']."',
					Sub5Time			=		'".$_REQUEST['PracticalTime']."',
					Lab5Name			=		'".$_REQUEST['PracticalLab']."'
					WHERE RollNo		=		'".$RollNoArray[$i]."'";
					$res_updt=mysql_query($sql_updt, $conn1);
				}
				else if($result1['Sub6Code'] == $_REQUEST['SubjectCode'])
				{
					$sql_updt="UPDATE tbladmissmdtechapii18 SET
					Sub6Date			=		'".date('Y-m-d',strtotime($_REQUEST['PracticalDate']))."',
					Sub6Day				=		'".$_REQUEST['PracticalDay']."',
					Sub6Time			=		'".$_REQUEST['PracticalTime']."',
					Lab6Name			=		'".$_REQUEST['PracticalLab']."'
					WHERE RollNo		=		'".$RollNoArray[$i]."'";
					$res_updt=mysql_query($sql_updt, $conn1);
				}
			}//for($i=0; $i < sizeof($RollNoArray); $i++)
		}//if($_REQUEST['Class'] == 11)
		else if($_REQUEST['Class'] == 12)
		{
			for($i=0; $i < sizeof($RollNoArray); $i++)
			{
				$sql1="SELECT Sub11Code, Sub12Code, Sub13Code FROM tbladmissmdtechapii18 WHERE RollNo='".$RollNoArray[$i]."'";
				$res1=mysql_query($sql1, $conn1);
				$result1=mysql_fetch_array($res1);
				
				if($result1['Sub11Code'] == $_REQUEST['SubjectCode'])
				{
					$sql_updt="UPDATE tbladmissmdtechapii18 SET
					Sub11Date			=		'".date('Y-m-d',strtotime($_REQUEST['PracticalDate']))."',
					Sub11Day			=		'".$_REQUEST['PracticalDay']."',
					Sub11Time			=		'".$_REQUEST['PracticalTime']."',
					Lab11Name			=		'".$_REQUEST['PracticalLab']."'
					WHERE RollNo		=		'".$RollNoArray[$i]."'";
					$res_updt=mysql_query($sql_updt, $conn1);
				}
				else if($result1['Sub12Code'] == $_REQUEST['SubjectCode'])
				{
					$sql_updt="UPDATE tbladmissmdtechapii18 SET
					Sub12Date			=		'".date('Y-m-d',strtotime($_REQUEST['PracticalDate']))."',
					Sub12Day			=		'".$_REQUEST['PracticalDay']."',
					Sub12Time			=		'".$_REQUEST['PracticalTime']."',
					Lab12Name			=		'".$_REQUEST['PracticalLab']."'
					WHERE RollNo		=		'".$RollNoArray[$i]."'";
					$res_updt=mysql_query($sql_updt, $conn1);
				}
				else if($result1['Sub13Code'] == $_REQUEST['SubjectCode'])
				{
					$sql_updt="UPDATE tbladmissmdtechapii18 SET
					Sub13Date			=		'".date('Y-m-d',strtotime($_REQUEST['PracticalDate']))."',
					Sub13Day			=		'".$_REQUEST['PracticalDay']."',
					Sub13Time			=		'".$_REQUEST['PracticalTime']."',
					Lab13Name			=		'".$_REQUEST['PracticalLab']."'
					WHERE RollNo		=		'".$RollNoArray[$i]."'";
					$res_updt=mysql_query($sql_updt, $conn1);
				}
			}//for($i=0; $i < sizeof($RollNoArray); $i++)
		}//if($_REQUEST['Class'] == 12)
			
		?><script>alert('Information Inserted Successfully');location.replace('mtpractslips_add12.php');</script><?php
	}
	?>
	
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Add Record</h6>
					</div>
					<div class="widget_content">
						<form id="myform" action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();" enctype="multipart/form-data">
							<ul>
                          		<li>
								<div class="form_grid_12">
									<label class="field_title">Subject Name<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<select name="SubjectCode" id="SubjectCode" data-placeholder="Select Subject" class="chzn-select custom-select" tabindex="1">
										</select>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Practical Date<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<input name="PracticalDate" id="PracticalDate" type="date" onblur="return date_info(this.value);" tabindex="2"/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Practical Day<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<input name="PracticalDay" id="PracticalDay" type="text" class="limiter" tabindex="3" readonly/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Practical Time<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<select name="PracticalTime" id="PracticalTime" data-placeholder="Select Time" class="chzn-select custom-select" tabindex="4"/>
										<option value="">Select</option>
										<option value="09:00 AM">09:00 AM</option>
										<option value="02:00 PM">02:00 PM</option>
										</select>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Practical Lab<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<select name="PracticalLab" id="PracticalLab" data-placeholder="Select Lab" class="chzn-select custom-select" tabindex="5"/>
										<option value="">Select</option>
										<option value="Lab-268-CMT Mirpur">Lab-268-CMT Mirpur</option>
										<option value="Lab-207-D/C Mirpur">Lab-207-D/C Mirpur</option>
										<option value="Lab-338-DHQ Mirpur">Lab-338-DHQ Mirpur</option>
										</select>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Class<span class="req">*</span></label>
									<div class="form_input">
										<select name="Class" id="Class" data-placeholder="Select" class="chzn-select custom-select" tabindex="6">
										<option value="">Select</option>
										<option value="11">11</option>
										<option value="12">12</option>
										</select>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">RollNos.<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<input name="RollNos" id="RollNos" type="text" class="limiter" tabindex="7"/>
									</div>
								</div>
								</li>
												
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="8"><span>Update</span></button>
										<button type="reset" class="btn_small btn_blue" tabindex="9"><span>Reset</span></button>
									</div>
								</div>
								</li>
							</ul>	
						</form>
					</div>
				</div>
			</div>	
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php include('includes/footer.php');?>
<script>
function date_info(PracticalDate)
{
	var Days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
	var d = new Date(PracticalDate);
	var DayName = Days[d.getDay()];
	document.getElementById('PracticalDay').value=DayName;
}
	
function check_submit_form()
{
	var SubjectCode=document.getElementById('SubjectCode').value;
	var PracticalDate=document.getElementById('PracticalDate').value;
	var PracticalDay=document.getElementById('PracticalDay').value;
	var PracticalTime=document.getElementById('PracticalTime').value;
	var PracticalLab=document.getElementById('PracticalLab').value;
	var Class=document.getElementById('Class').value;
	var RollNos=document.getElementById('RollNos').value;
		
	if(SubjectCode==''){ alert('Choose Subject Name'); document.getElementById('SubjectCode').focus(); return false; }
	if(PracticalDate==''){ alert('Choose Practical Date'); document.getElementById('PracticalDate').focus(); return false; }
	if(PracticalDay==''){ alert('Choose Practical Day'); document.getElementById('PracticalDay').focus(); return false; }
	if(PracticalDay=='Sunday'){ alert('Choose Practical Date Again'); return false; }
	if(PracticalTime==''){ alert('Choose Practical Time'); document.getElementById('PracticalTime').focus(); return false; }	
	if(PracticalLab==''){ alert('Choose Practical Lab'); document.getElementById('PracticalLab').focus(); return false; }
	if(Class==''){ alert('Choose Class'); document.getElementById('Class').focus(); return false; }
	if(RollNos==''){ alert('Enter RollNos'); document.getElementById('RollNos').focus(); return false; }	
}//check_submit_form()
</script>
<script type="text/JavaScript">
    $(document).ready(function(){
        load_data();
    })
function BindSubjects() {
    var subjects = $.grep(AppData.Subjects, function (e) { return e.IsPractical == 1; })
    if (subjects.length > 0 && subjects.length < 2)
        BindSelect(subjects, "#SubjectCode", false);
    else
        BindSelect(subjects, "#SubjectCode", true);
}
function load_data()
{
	$.ajax
	({
		type: "POST",
		url: "ajax_subjectsdata.php",
		dataType: "json",		
		success: function(data)
		{
			AppData.Subjects=data.Subjects;
			BindSubjects();
		}
	});	
}
function BindSelect(accounts, element, addBlankRow, justBind)
{
	$(element).find('option').remove();
    var $this = this; var html = "";
    if (addBlankRow)
       	  html += "<option value=''>Select</option>";
          for (var i = 0; i < accounts.length; i++) {
             var token = accounts[i];
             html += "<option value='" + token.Code + "'>" + token.Name + "</option>";
          }
          if (justBind)
            html = $(element).html();
            $(element).append(html);
			$(element).trigger("liszt:updated");
}			
</script>