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
	
	$("#GroupId").change(function (){
	
		var groupId = parseInt($(this).val(), 10);
		if(groupId > 0){
			BindSubjectCombinations(groupId);
		}
	});
	
	$("#CombinationId").change(function (){
	
		var combinationId = parseInt($(this).val(), 10);
		if(combinationId > 0){
			BindSubjects(combinationId);
		}
	});
})
function edit_data(data)
{
	$("#Output").attr("src", "../online-admission/"+data.PicURL+ '?' + Math.random());
	$("#GroupId").val(data.GroupId).trigger("liszt:updated");
	$("#GroupId").trigger("change");
	$("#CombinationId").val(data.CombinationId).trigger("liszt:updated");
 	$("#CombinationId").trigger("change");
	$("#Domicile").trigger("change");
	$("#OtherDomicile").val(data.OtherDomicile);
}
function BindGroups(){
	var groups = AppData.SubjectGroups;
	if(groups.length > 0 && groups.length < 2)
		BindSelect(groups, "#GroupId", false);
	else
		BindSelect(groups, "#GroupId", true);
}
function clear(){
	$("#Subject1").val(''); $("#Subject2").val('');
	$("#Subject3").val('');	$("#Subject4").val('');
	$("#Subject5").val(''); $("#Subject6").val('');
	$("#tbl-subjects tr td input[type='checkbox']").attr('checked', false);
}
function clearSelectedBox(){
	$("#tbl-subjects tr td input[type='checkbox']").attr('checked', false);
}
function BindSubjectCombinations(groupId){
	clear();
	var combinations = $.grep(AppData.LanguageCombinations, function (e) { return e.SubjectGroupId == groupId; });
	if(combinations.length > 0 && combinations.length < 2){
		BindSelect(combinations, "#CombinationId", false);
		$("#CombinationId").trigger("change");
	}
	else
		BindSelect(combinations, "#CombinationId", true);
}
function BindSubjects(combinationId){
	clear();
	var subjects = $.grep(AppData.LanguageCombinations, function (e) { return e.Id == combinationId; })[0];
	$("#Subject1").val(subjects.Sub1Name); $("#Sub1Checkbox").val(subjects.Sub1Code);
	$("#Subject2").val(subjects.Sub2Name); $("#Sub2Checkbox").val(subjects.Sub2Code);
	$("#Subject3").val(subjects.Sub3Name); $("#Sub3Checkbox").val(subjects.Sub3Code);
	$("#Subject4").val(subjects.Sub4Name); $("#Sub4Checkbox").val(subjects.Sub4Code);
	$("#Subject5").val(subjects.Sub5Name); $("#Sub5Checkbox").val(subjects.Sub5Code);
	$("#Subject6").val(subjects.Sub6Name); $("#Sub6Checkbox").val(subjects.Sub6Code);
	clearSelectedBox();
	SelectAllSubjects();
}
function SelectAllSubjects(){
	CheckIfSubExist($("#Sub1Checkbox").val(),"#Sub1Checkbox"); CheckIfSubExist($("#Sub2Checkbox").val(),"#Sub2Checkbox");
	CheckIfSubExist($("#Sub3Checkbox").val(),"#Sub3Checkbox"); CheckIfSubExist($("#Sub4Checkbox").val(),"#Sub4Checkbox");
	CheckIfSubExist($("#Sub5Checkbox").val(),"#Sub5Checkbox"); CheckIfSubExist($("#Sub6Checkbox").val(),"#Sub6Checkbox");
}
function CheckIfSubExist(subcode,selector){
	
	if((subcode != '') && (subcode==AppData.PrevSubjects.Sub1Code || subcode==AppData.PrevSubjects.Sub2Code ||
		subcode==AppData.PrevSubjects.Sub3Code || subcode==AppData.PrevSubjects.Sub4Code ||
		subcode==AppData.PrevSubjects.Sub5Code || subcode==AppData.PrevSubjects.Sub6Code)){
		
		$(selector).attr('checked', true);
		$(selector).val(subcode);		
	}
}
function load_data()
{
	$.ajax
	({
		type: "POST",
		url: "ajax_langadmdata.php",
		data:"Id="+getUrlVars()["Id"],
		dataType: "json",
		success: function(data)
		{
			AppData.SubjectGroups=data.SubjectGroups;
			AppData.LanguageCombinations=data.LanguageCombinations;
			AppData.PrevSubjects=data.LangStudents;
			BindGroups();
			var record=data.LangStudents;
			BindSubjectCombinations(record.GroupId);
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