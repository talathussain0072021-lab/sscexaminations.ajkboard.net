<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['submit']))
	{
		$sql1="SELECT * FROM datesheet WHERE SubjectId=".$_REQUEST['SubjectId']."";
		$res1=mysql_query($sql1, $conn1);
		$no_row1=mysql_num_rows($res1);
		if($no_row1 > 0)
		{
			echo "<script>"; echo "alert('Subject Name already exists.')"; echo "</script>";
		}
		else
		{
			$PaperTime1='9:00 AM'; $PaperTime2='';
			if($_REQUEST['IsDoubleShift'] == 0 && $_REQUEST['PaperDay'] == 'Friday')
			{
				if($_REQUEST['PaperShift']==2)
				{ $PaperTime1='2:30 PM'; }
			}
			else if($_REQUEST['IsDoubleShift'] == 0 && $_REQUEST['PaperDay'] != 'Friday')
			{
				if($_REQUEST['PaperShift']==2)
				{ $PaperTime1='1:30 PM'; }
			}
			else if($_REQUEST['IsDoubleShift'] == 1 && $_REQUEST['PaperDay'] == 'Friday')
			{
				$PaperTime2='2:30 PM';
			}
			else if($_REQUEST['IsDoubleShift'] == 1 && $_REQUEST['PaperDay'] != 'Friday')
			{
				$PaperTime2='1:30 PM';
			}
			
			$sql="INSERT INTO datesheet SET
			SubjectId			=		".$_REQUEST['SubjectId'].",
			PaperDate			=		'".date('Y-m-d',strtotime($_REQUEST['PaperDate']))."',
			PaperDay			=		'".$_REQUEST['PaperDay']."',
			PaperTime1			=		'".$PaperTime1."',
			PaperTime2			=		'".$PaperTime2."',
			ExamId				=		".$ExamId."";
			
			if(mysql_query($sql, $conn1))
			{
				//$sql1 = mysql_query("CALL DateSheetTableCreation(12)", $conn1);
				//if($sql1)
				//{
					?><script>alert('Information Inserted Successfully.');location.replace('datesheet_add.php');</script><?php
				//}
			}
			else
			{
				?><script>alert('Error in Query.');location.replace('datesheet_add.php');</script><?php
			}
		}
	}
	?>

	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Add DateSheet</h6>
					</div>
					<div class="widget_content">
						<form id="myform" action="" method="post" class="form_container left_label" onSubmit="return check_submit_form();" enctype="multipart/form-data">
							<ul>
                          		<li>
								<div class="form_grid_12">
									<label class="field_title">Subject Name<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<select name="SubjectId" id="SubjectId" data-placeholder="Select" class="chzn-select custom-select" tabindex="1">
										</select>
										<input name="IsDoubleShift" id="IsDoubleShift" type="hidden"/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Paper Date<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<input name="PaperDate" id="PaperDate" type="date" onblur="return date_info(this.value);" tabindex="2"/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Paper Day<label style="color:#FF0000"> *</label></label>
									<div class="form_input">
										<input name="PaperDay" id="PaperDay" type="text" class="limiter" readonly/>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Paper Time</label>
									<div class="form_input">
										<select name="PaperShift" id="PaperShift" data-placeholder="Select Time" class="chzn-select custom-select" tabindex="3"/>
										<option></option>
										<option value="1">1st Time</option>
										<option value="2">2nd Time</option>
										</select>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" name="submit" value="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
										<button type="reset" class="btn_small btn_blue" tabindex="5"><span>Reset</span></button>
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
function date_info(PaperDate)
{
	var Days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
	var d = new Date(PaperDate);
	var DayName = Days[d.getDay()];
	document.getElementById('PaperDay').value=DayName;
}

function check_submit_form()
{
	var SubjectId=document.getElementById('SubjectId').value;
	var IsDoubleShift=document.getElementById('IsDoubleShift').value;
	var PaperDate=document.getElementById('PaperDate').value;
	var PaperDay=document.getElementById('PaperDay').value;
	var PaperShift=document.getElementById('PaperShift').value;
	
	if(SubjectId==0){ alert('Choose Subject Name'); document.getElementById('SubjectId').focus(); return false; }
	if(PaperDate==''){ alert('Choose Paper Date'); document.getElementById('PaperDate').focus(); return false; }
	if(PaperDay==''){ alert('Enter Paper Day'); document.getElementById('PaperDay').focus(); return false; }
	if(PaperDay=='Sunday'){ alert('Choose Paper Date Again'); return false; }
	if(PaperShift=='' && IsDoubleShift==0){ alert('Choose Shift'); return false; }
}//check_submit_form()
</script>
<script type="text/JavaScript">
    $(document).ready(function(){
        load_data();
		$("#SubjectId").change(function () {
		
                var subjectid = parseInt($(this).val(), 10);
                if (subjectid > 0) {
                    BindSubjects2(subjectid);
                }
            });
    })
function BindSubjects() {
    var subjects = AppData.Subjects;
    if (subjects.length > 0 && subjects.length < 2)
        BindSelect(subjects, "#SubjectId", false);
    else
        BindSelect(subjects, "#SubjectId", true);
}
function BindSubjects2(subjectid) {
    var subjects = $.grep(AppData.Subjects, function (e) { return e.Id == subjectid; })[0];
	$("#IsDoubleShift").val(subjects.IsDoubleShift);
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
       	  html += "<option value='0'>Select</option>";
          for (var i = 0; i < accounts.length; i++) {
             var token = accounts[i];
             html += "<option value='" + token.Id + "'>" + token.Name + "</option>";
          }
          if (justBind)
            html = $(element).html();
            $(element).append(html);
			$(element).trigger("liszt:updated");
}
</script>