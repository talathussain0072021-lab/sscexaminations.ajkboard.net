function Validate(scope)
{
	var $this = this;
	var error = "";
	var isvalidated = true;
	$("[data-required='required']", scope).each(function (){
		if($(this).val() == "" || $(this).val() == null){
			$(this).parent().find("label").remove();
			$(this).parent().append('<label class="error">'+$(this).attr("data-message")+'</label>');
			isvalidated = false;
		}
		else{
			$(this).parent().find("label").remove();
		}
	});
		return isvalidated;
}
function check_submit_form()
{
	if(!Validate($(".form_container"))){ return false; }
}//check_submit_form()

$(document).ready(function(){
	load_data();
	
	$("#Subject5Id,#Subject6Id,#Subject7Id,#Subject25Id,#Subject26Id,#Subject27Id").change(function (){
		var subjectid = parseInt($(this).val(), 10);
		var type = parseInt($(this).attr('id').replace ( /[^\d.]/g, '' ), 10);
		if(subjectid > 0){
			FilterSubjects(subjectid,type);
		}
	});
})
function edit_data(data)
{
	$("#Id").val(data.Id);
	$("#Name").val(data.Name);
	$("#SubjectGroupId").val(data.SubjectGroupId).trigger("liszt:updated");
	$("#RegFee").val(data.RegFee);
	$("#PrvFee").val(data.PrvFee);
	$("#Subject1Id").val(data.Subject1Id).trigger("liszt:updated");
	$("#Subject2Id").val(data.Subject2Id).trigger("liszt:updated");
	$("#Subject3Id").val(data.Subject3Id).trigger("liszt:updated");
	$("#Subject4Id").val(data.Subject4Id).trigger("liszt:updated");
	$("#Subject5Id").val(data.Subject5Id).trigger("liszt:updated");
	$("#Subject6Id").val(data.Subject6Id).trigger("liszt:updated");
	$("#Subject7Id").val(data.Subject7Id).trigger("liszt:updated");
	$("#Subject8Id").val(data.Subject8Id).trigger("liszt:updated");
	$("#Subject9Id").val(data.Subject9Id).trigger("liszt:updated");
	$("#Subject21Id").val(data.Subject21Id).trigger("liszt:updated");
	$("#Subject22Id").val(data.Subject22Id).trigger("liszt:updated");
	$("#Subject23Id").val(data.Subject23Id).trigger("liszt:updated");
	$("#Subject24Id").val(data.Subject24Id).trigger("liszt:updated");
	$("#Subject25Id").val(data.Subject25Id).trigger("liszt:updated");
	$("#Subject26Id").val(data.Subject26Id).trigger("liszt:updated");
	$("#Subject27Id").val(data.Subject27Id).trigger("liszt:updated");
	$("#Subject28Id").val(data.Subject28Id).trigger("liszt:updated");
	$("#Subject29Id").val(data.Subject29Id).trigger("liszt:updated");
	$("#CombType").val(data.CombType).trigger("liszt:updated");
	$("#IsActive").val(data.IsActive).trigger("liszt:updated");
}
function BindGroups(){
	var groups = AppData.SubjectGroups;
	if(groups.length > 0 && groups.length < 2)
		BindSelect(groups, "#SubjectGroupId", false);
	else
		BindSelect(groups, "#SubjectGroupId", true);
}
function BindSubjects(){
	var subjects09 = $.grep(AppData.Subjects, function (e) { return e.Class == 9 && e.IsCompulsory == 0; });
	var subjects10 = $.grep(AppData.Subjects, function (e) { return e.Class == 10 && e.IsCompulsory == 0; });
	var comsubject1 = $.grep(AppData.Subjects, function (e) { return (e.Code == '001' || e.Code == '089'); });
	var comsubject2 = $.grep(AppData.Subjects, function (e) { return (e.Code == '003' || e.Code == '005' || e.Code == '047' || e.Code == '087'); });
	var comsubject3 = $.grep(AppData.Subjects, function (e) { return (e.Code == '007' || e.Code == '009' || e.Code == '013' || e.Code == '091'); });
	var comsubject4 = $.grep(AppData.Subjects, function (e) { return (e.Code == '051' || e.Code == '093'); });
	var comsubject9 = $.grep(AppData.Subjects, function (e) { return (e.Code == '041' || e.Code == '043' || e.Code == '117'); });
	var comsubject21 = $.grep(AppData.Subjects, function (e) { return (e.Code == '002' || e.Code == '090'); });
	var comsubject22 = $.grep(AppData.Subjects, function (e) { return (e.Code == '004' || e.Code == '006' || e.Code == '048' || e.Code == '088'); });
	var comsubject23 = $.grep(AppData.Subjects, function (e) { return (e.Code == '008' || e.Code == '014' || e.Code == '092'); });
	var comsubject24 = $.grep(AppData.Subjects, function (e) { return (e.Code == '052' || e.Code == '094'); });
	var comsubject29 = $.grep(AppData.Subjects, function (e) { return (e.Code == '042' || e.Code == '044' || e.Code == '118'); });
	BindSelect(comsubject1, "#Subject1Id", true);
	BindSelect(comsubject2, "#Subject2Id", true);
	BindSelect(comsubject3, "#Subject3Id", true);
	BindSelect(comsubject4, "#Subject4Id", true);
	BindSelect(comsubject9, "#Subject9Id", true);
	BindSelect(subjects09, "#Subject5Id", true);
	BindSelect(subjects09, "#Subject6Id", true);
	BindSelect(subjects09, "#Subject7Id", true);
	BindSelect(subjects09, "#Subject8Id", true);
	BindSelect(comsubject21, "#Subject21Id", true);
	BindSelect(comsubject22, "#Subject22Id", true);
	BindSelect(comsubject23, "#Subject23Id", true);
	BindSelect(comsubject24, "#Subject24Id", true);
	BindSelect(comsubject29, "#Subject29Id", true);
	BindSelect(subjects10, "#Subject25Id", true);
	BindSelect(subjects10, "#Subject26Id", true);
	BindSelect(subjects10, "#Subject27Id", true);
	BindSelect(subjects10, "#Subject28Id", true);
}
function FilterSubjects(subjectid,type){
	var subjects;
	if(type == 5){
	subjects= $.grep(AppData.Subjects, function (e) { return e.Id != subjectid && e.IsCompulsory == 0 && e.Class == 9; });
	BindSelect(subjects, "#Subject6Id", true);
	BindSelect(subjects, "#Subject7Id", true);
	BindSelect(subjects, "#Subject8Id", true);
	}
	if(type == 6){
	subjects= $.grep(AppData.Subjects, function (e) { return e.Id != subjectid && e.Id !=$("#Subject5Id").val() && e.IsCompulsory == 0 && e.Class == 9; });
	BindSelect(subjects, "#Subject7Id", true);
	BindSelect(subjects, "#Subject8Id", true);
	}
	if(type == 7){
	subjects= $.grep(AppData.Subjects, function (e) { return e.Id != subjectid && e.Id !=$("#Subject6Id").val() && e.Id !=$("#Subject5Id").val() && e.IsCompulsory == 0 && e.Class == 9; });
	BindSelect(subjects, "#Subject8Id", true);
	}
	if(type == 25){
	subjects= $.grep(AppData.Subjects, function (e) { return e.Id != subjectid && e.IsCompulsory == 0 && e.Class == 10; });
	BindSelect(subjects, "#Subject26Id", true);
	BindSelect(subjects, "#Subject27Id", true);
	BindSelect(subjects, "#Subject28Id", true);
	}
	if(type == 26){
	subjects= $.grep(AppData.Subjects, function (e) { return e.Id != subjectid && e.Id !=$("#Subject25Id").val() && e.IsCompulsory == 0 && e.Class == 10; });
	BindSelect(subjects, "#Subject27Id", true);
	BindSelect(subjects, "#Subject28Id", true);
	}
	if(type == 27){
	subjects= $.grep(AppData.Subjects, function (e) { return e.Id != subjectid && e.Id !=$("#Subject26Id").val() && e.Id !=$("#Subject25Id").val() && e.IsCompulsory == 0 && e.Class == 10; });
	BindSelect(subjects, "#Subject28Id", true);
	}
}
function load_data()
{
	$.ajax
	({
		type: "POST",
		url: "ajax_combinationsdata.php",
		data:"Id="+getUrlVars()["Id"],
		dataType: "json",
		success: function(data)
		{
			AppData.SubjectGroups=data.SubjectGroups;
			AppData.Subjects=data.Subjects;
			var record=data.Combinations;
			BindGroups();
			BindSubjects();
			edit_data(record);
		}
	});
}
function BindSelect(accounts, element, addBlankRow, justBind)
{
	$(element).find('option').remove();
	var $this = this; var html = "";
	if(addBlankRow)
		html += "<option value=''>Select</option>";
		for(var i = 0; i < accounts.length; i++){
			var token = accounts[i];
			html += "<option value='" + token.Id + "'>" + token.Name + "</option>";
		}
		if(justBind)
		html = $(element).html();
		$(element).append(html);
		$(element).trigger("liszt:updated");
}
function getUrlVars()
{
	var vars = [], hash;
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	for(var i = 0; i < hashes.length; i++)
	{
		hash = hashes[i].split('=');
		vars.push(hash[0]);
		vars[hash[0]] = hash[1];
	}
	return vars;
}