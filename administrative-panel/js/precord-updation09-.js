$(document).ready(function(){
	load_data();
	
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
	$("#GroupId").val(data.GroupId).trigger("liszt:updated");
	$("#GroupId").trigger("change");
	$("#CombinationId").val(data.CombinationId).trigger("liszt:updated");
	$("#CombinationId").trigger("change");
	/*$("#Sub1_Pass").val(data.Sub1Pass).trigger("liszt:updated");
	$("#Sub2_Pass").val(data.Sub2Pass).trigger("liszt:updated");
	$("#Sub3_Pass").val(data.Sub3Pass).trigger("liszt:updated");
	$("#Sub4_Pass").val(data.Sub4Pass).trigger("liszt:updated");
	$("#Sub9_Pass").val(data.Sub9Pass).trigger("liszt:updated");*/
}
function BindGroups(){
	var groups = AppData.SubjectGroups;
	if(groups.length > 0 && groups.length < 2)
		BindSelect(groups, "#GroupId", false);
	else
		BindSelect(groups, "#GroupId", true);
}
function BindSubjectCombinations(groupId){
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
	$("#Sub1_Name").val(subjects.Sub1Name); $("#Sub1_Code").val(subjects.Sub1Code);
	$("#Sub2_Name").val(subjects.Sub2Name); $("#Sub2_Code").val(subjects.Sub2Code);
	$("#Sub3_Name").val(subjects.Sub3Name); $("#Sub3_Code").val(subjects.Sub3Code);
	$("#Sub4_Name").val(subjects.Sub4Name); $("#Sub4_Code").val(subjects.Sub4Code);
	$("#Sub5_Name").val(subjects.Sub5Name); $("#Sub5_Code").val(subjects.Sub5Code);
	$("#Sub6_Name").val(subjects.Sub6Name); $("#Sub6_Code").val(subjects.Sub6Code);
	$("#Sub7_Name").val(subjects.Sub7Name); $("#Sub7_Code").val(subjects.Sub7Code);
	$("#Sub8_Name").val(subjects.Sub8Name); $("#Sub8_Code").val(subjects.Sub8Code);
	$("#Sub9_Name").val(subjects.Sub9Name); $("#Sub9_Code").val(subjects.Sub9Code);
	
	SelectBoxtoUpdate("#Sub5_Code","#Sub5_Pass");
	SelectBoxtoUpdate("#Sub6_Code","#Sub6_Pass");
	SelectBoxtoUpdate("#Sub7_Code","#Sub7_Pass");
	SelectBoxtoUpdate("#Sub8_Code","#Sub8_Pass");
}
function SelectBoxtoUpdate(subcode,p1status){
	if($(subcode).val()==AppData.PrevSubjects.Sub5Code){
		$(p1status).val(AppData.PrevSubjects.Sub5Pass).trigger("liszt:updated");
	}
	else if($(subcode).val()==AppData.PrevSubjects.Sub6Code){
		$(p1status).val(AppData.PrevSubjects.Sub6Pass).trigger("liszt:updated");
	}
	else if($(subcode).val()==AppData.PrevSubjects.Sub7Code){
		$(p1status).val(AppData.PrevSubjects.Sub7Pass).trigger("liszt:updated");
	}
	else if($(subcode).val()==AppData.PrevSubjects.Sub8Code){
		$(p1status).val(AppData.PrevSubjects.Sub8Pass).trigger("liszt:updated");
	}
	else{
		$(p1status).val('').trigger("liszt:updated");
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
			AppData.SubjectGroups=data.SubjectGroups;
			AppData.SubjectCombinations=data.SubjectCombinations;
			AppData.PrevSubjects=data.P1Students;
			BindGroups();
			var record=data.P1Students;
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