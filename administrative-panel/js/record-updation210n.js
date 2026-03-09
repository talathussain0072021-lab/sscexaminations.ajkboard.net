$(document).ready(function(){
	load_data();
	$("#Domicile").change(function (){
	
		var domicile = parseInt($(this).val(), 10);
		if(domicile != 8){
			$("#OtherDomicile").attr('readonly', true);
			$("#OtherDomicile").val('');
		}
		else {
			$("#OtherDomicile").attr('readonly', false);
			$("#OtherDomicile").val('');
		}
	});
	
	$("#checkbox1").click(function (){
	
		if($("#checkbox1").is(":checked")){
			$("#PermanentAddress").val($("#PostalAddress").val());
		}
		else {
			$("#PermanentAddress").val('');
		}
	});
	
	$("#Subject5Code,#Subject6Code,#Subject7Code,#Subject8Code,#Subject25Code,#Subject26Code,#Subject27Code,#Subject28Code").change(function (){
		var subjectcode = parseInt($(this).val(), 10);
		var type = parseInt($(this).attr('id').replace ( /[^\d.]/g, '' ), 10);
		if(subjectcode > 0){
			FilterSubjects(subjectcode,type);
		}
	});
})
function edit_data(data)
{
	$("#Subject5Code").val(data.Sub5Code).trigger("liszt:updated");
	$("#Subject6Code").val(data.Sub6Code).trigger("liszt:updated");
	$("#Subject7Code").val(data.Sub7Code).trigger("liszt:updated");
	$("#Subject8Code").val(data.Sub8Code).trigger("liszt:updated");
	$("#Subject25Code").val(data.Sub25Code).trigger("liszt:updated");
	$("#Subject26Code").val(data.Sub26Code).trigger("liszt:updated");
	$("#Subject27Code").val(data.Sub27Code).trigger("liszt:updated");
	$("#Subject28Code").val(data.Sub28Code).trigger("liszt:updated");
}
function BindSubjects(){
	var subjects09 = $.grep(AppData.Subjects, function (e) { return e.Class == 09 && e.IsPractical == 0 && e.IsCompulsory == 0; });
	var subjects10 = $.grep(AppData.Subjects, function (e) { return e.Class == 10 && e.IsPractical == 0 && e.IsCompulsory == 0; });
	BindSelectCode(subjects09, "#Subject5Code", true);
	BindSelectCode(subjects09, "#Subject6Code", true);
	BindSelectCode(subjects09, "#Subject7Code", true);
	BindSelectCode(subjects09, "#Subject8Code", true);
	BindSelectCode(subjects10, "#Subject25Code", true);
	BindSelectCode(subjects10, "#Subject26Code", true);
	BindSelectCode(subjects10, "#Subject27Code", true);
	BindSelectCode(subjects10, "#Subject28Code", true);
}
function FilterSubjects(subjectcode,type){
	var subjects09; var subjects10;
	if(type == 5){
	subjects09= $.grep(AppData.Subjects, function (e) { return e.Code != subjectcode && e.Class == 09 && e.IsPractical == 0 && e.IsCompulsory == 0; });
	BindSelectCode(subjects09, "#Subject6Code", true);
	BindSelectCode(subjects09, "#Subject7Code", true);
	BindSelectCode(subjects09, "#Subject8Code", true);
	}
	if(type == 6){
	subjects09= $.grep(AppData.Subjects, function (e) { return e.Code != subjectcode && e.Code !=$("#Subject5Code").val() && e.Class == 09 && e.IsPractical == 0 && e.IsCompulsory == 0; });
	BindSelectCode(subjects09, "#Subject7Code", true);
	BindSelectCode(subjects09, "#Subject8Code", true);
	}
	if(type == 7){
	subjects09= $.grep(AppData.Subjects, function (e) { return e.Code != subjectcode && e.Code !=$("#Subject5Code").val() && e.Code !=$("#Subject6Code").val() && e.Class == 09 && e.IsPractical == 0 && e.IsCompulsory == 0; });
	BindSelectCode(subjects09, "#Subject8Code", true);
	}
	if(type == 25){
	subjects10= $.grep(AppData.Subjects, function (e) { return e.Code != subjectcode && e.Class == 10 && e.IsPractical == 0 && e.IsCompulsory == 0; });
	BindSelectCode(subjects10, "#Subject26Code", true);
	BindSelectCode(subjects10, "#Subject27Code", true);
	BindSelectCode(subjects10, "#Subject28Code", true);
	}
	if(type == 26){
	subjects10= $.grep(AppData.Subjects, function (e) { return e.Code != subjectcode && e.Code !=$("#Subject25Code").val() && e.Class == 10 && e.IsPractical == 0 && e.IsCompulsory == 0; });
	BindSelectCode(subjects10, "#Subject27Code", true);
	BindSelectCode(subjects10, "#Subject28Code", true);
	}
	if(type == 27){
	subjects10= $.grep(AppData.Subjects, function (e) { return e.Code != subjectcode && e.Code !=$("#Subject25Code").val() && e.Code !=$("#Subject26Code").val() && e.Class == 10 && e.IsPractical == 0 && e.IsCompulsory == 0; });
	BindSelectCode(subjects10, "#Subject28Code", true);
	}
}
function load_data()
{
	$.ajax
	({
		type: "POST",
		url: "ajax_admdata10.php",
		data:"Id="+getUrlVars()["Id"],
		dataType: "json",
		success: function(data)
		{
			AppData.Subjects=data.Subjects;
			BindSubjects();
			var record=data.Students10;
			edit_data(record);
		}
	});
}
function BindSelectCode(accounts, element, addBlankRow, justBind)
{
	$(element).find('option').remove();
	var $this = this; var html = "";
	if(addBlankRow)
		html += "<option value=''>Select</option>";
		for(var i = 0; i < accounts.length; i++){
			var token = accounts[i];
			html += "<option value='" + token.Code + "'>" + token.Name + "</option>";
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