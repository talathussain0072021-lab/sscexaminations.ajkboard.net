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
})
function edit_data(data)
{
	$("#Subject4Code").val(data.Sub6Code).trigger("liszt:updated");
	$("#Subject8Code").val(data.Sub14Code).trigger("liszt:updated");
}
function BindSubjects(){
	var subjects = $.grep(AppData.SubjectCombinations, function (e) { return e.Id == 4; })[0];
	var subjects09 = $.grep(AppData.Subjects, function (e) { return e.Class == 09 && e.IsPractical == 0 && e.IsCompulsory == 0 && e.Code != '37'; });
	var subjects10 = $.grep(AppData.Subjects, function (e) { return e.Class == 10 && e.IsPractical == 0 && e.IsCompulsory == 0 && e.Code != '38'; });
	
	$("#Subject1").val(subjects.Sub1Name); $("#Sub1Checkbox").val(subjects.Sub1Code);
	$("#Subject2").val(subjects.Sub4Name); $("#Sub2Checkbox").val(subjects.Sub4Code);
	$("#Subject3").val(subjects.Sub5Name); $("#Sub3Checkbox").val(subjects.Sub5Code);
	$("#Subject5").val(subjects.Sub9Name); $("#Sub5Checkbox").val(subjects.Sub9Code);
	$("#Subject6").val(subjects.Sub12Name); $("#Sub6Checkbox").val(subjects.Sub12Code);
	$("#Subject7").val(subjects.Sub13Name); $("#Sub7Checkbox").val(subjects.Sub13Code);
	
	BindSelectCode(subjects09, "#Subject4Code", true);
	BindSelectCode(subjects10, "#Subject8Code", true);
	
	SelectCompSubjects();
}
function SelectCompSubjects(){
	CheckIfSubExist($("#Sub1Checkbox").val(),"#Sub1Checkbox"); CheckIfSubExist($("#Sub2Checkbox").val(),"#Sub2Checkbox");
	CheckIfSubExist($("#Sub3Checkbox").val(),"#Sub3Checkbox"); CheckIfSubExist($("#Sub5Checkbox").val(),"#Sub5Checkbox");
	CheckIfSubExist($("#Sub6Checkbox").val(),"#Sub6Checkbox"); CheckIfSubExist($("#Sub7Checkbox").val(),"#Sub7Checkbox");
}
function CheckIfSubExist(subcode,selector){
	
	if((subcode != '') && (subcode==AppData.PrevSubjects.Sub1Code || subcode==AppData.PrevSubjects.Sub4Code ||
		subcode==AppData.PrevSubjects.Sub5Code || subcode==AppData.PrevSubjects.Sub9Code ||
		subcode==AppData.PrevSubjects.Sub12Code || subcode==AppData.PrevSubjects.Sub13Code)){
		
		$(selector).attr('checked', true);
		$(selector).val(subcode);
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
			AppData.SubjectCombinations=data.SubjectCombinations;
			AppData.Subjects=data.Subjects;
			AppData.PrevSubjects=data.Students10;
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