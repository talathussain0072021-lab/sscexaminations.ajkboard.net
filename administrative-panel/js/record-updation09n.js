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
	$("#Output").attr("src", "../institution-panel/"+data.PicURL+ '?' + Math.random());
	$("#GroupId").val(data.GroupId).trigger("liszt:updated");
	$("#GroupId").trigger("change");
	$("#CombinationId").val(data.CombinationId).trigger("liszt:updated");
	$("#CombinationId").trigger("change");
	$("#Domicile").val(data.Domicile).trigger("liszt:updated");
	$("#Domicile").trigger("change");
	$("#OtherDomicile").val(data.OtherDomicile);
	$("#PrvExamDistrict").val(data.PrvExamDistrict).trigger("liszt:updated");
}
function BindGroups(){
	var groups = AppData.SubjectGroups;
	if(groups.length > 0 && groups.length < 2)
		BindSelect(groups, "#GroupId", false);
	else
		BindSelect(groups, "#GroupId", true);
}
function clear(){
	$("#Subject3").val(''); $("#Subject4").val('');
	$("#Subject5").val(''); $("#Subject6").val('');
	$("#Subject7").val(''); $("#Subject8").val('');
}
function BindSubjectCombinations(groupId){
	clear();
	var combinations = $.grep(AppData.SubjectCombinations, function (e) { return e.SubjectGroupId == groupId; });
	if(combinations.length > 0 && combinations.length < 2){
		BindSelect(combinations, "#CombinationId", false);
		$("#CombinationId").trigger("change");
	}
	else
		BindSelect(combinations, "#CombinationId", true);
}
function BindSubjects(combinationId){
	var subjects = $.grep(AppData.SubjectCombinations, function (e) { return e.Id == combinationId; })[0];
	$("#Subject3").val(subjects.Sub3Name); $("#Subject4").val(subjects.Sub4Name);
	$("#Subject5").val(subjects.Sub5Name); $("#Subject6").val(subjects.Sub6Name);
	$("#Subject7").val(subjects.Sub7Name); $("#Subject8").val(subjects.Sub8Name);
}
function BindDomiciles(){
	var districts = AppData.Districts;
	if(districts.length > 0 && districts.length < 2)
		BindSelect(districts, "#Domicile", false);
	else
		BindSelect(districts, "#Domicile", true);
}
function BindExamDistricts(){
	var districts = $.grep(AppData.Districts, function (e) { return e.Id != 8; });
	if(districts.length > 0 && districts.length < 2)
		BindSelect(districts, "#PrvExamDistrict", false);
	else
		BindSelect(districts, "#PrvExamDistrict", true);
}
function load_data()
{
	$.ajax
	({
		type: "POST",
		url: "ajax_admdata09.php",
		data:"Id="+getUrlVars()["Id"],
		dataType: "json",
		success: function(data)
		{
			AppData.SubjectGroups=data.SubjectGroups;
			AppData.SubjectCombinations=data.SubjectCombinations;
			AppData.Districts=data.Districts;
			BindGroups(); BindDomiciles(); BindExamDistricts();
			var record=data.Students;
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