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
	$("#Sub231_Name").val(subjects.Sub4Name); $("#Sub231_Code").val(subjects.Sub4Code);
	$("#Sub4_Name").val(subjects.Sub5Name); $("#Sub4_Code").val(subjects.Sub5Code);
	$("#Sub5_Name").val(subjects.Sub6Name); $("#Sub5_Code").val(subjects.Sub6Code);
	$("#Sub6_Name").val(subjects.Sub7Name); $("#Sub6_Code").val(subjects.Sub7Code);
	$("#Sub7_Name").val(subjects.Sub8Name); $("#Sub7_Code").val(subjects.Sub8Code);
	$("#Sub8_Name").val(subjects.Sub9Name); $("#Sub8_Code").val(subjects.Sub9Code);
	$("#Sub21_Name").val(subjects.Sub21Name); $("#Sub21_Code").val(subjects.Sub21Code);
	$("#Sub22_Name").val(subjects.Sub22Name); $("#Sub22_Code").val(subjects.Sub22Code);
	$("#Sub31_Name").val(subjects.Sub23Name); $("#Sub31_Code").val(subjects.Sub23Code);
	$("#Sub23_Name").val(subjects.Sub24Name); $("#Sub23_Code").val(subjects.Sub24Code);
	$("#Sub24_Name").val(subjects.Sub25Name); $("#Sub24_Code").val(subjects.Sub25Code);
	$("#Sub25_Name").val(subjects.Sub26Name); $("#Sub25_Code").val(subjects.Sub26Code);
	$("#Sub26_Name").val(subjects.Sub27Name); $("#Sub26_Code").val(subjects.Sub27Code);
	$("#Sub27_Name").val(subjects.Sub28Name); $("#Sub27_Code").val(subjects.Sub28Code);
	$("#Sub28_Name").val(subjects.Sub29Name); $("#Sub28_Code").val(subjects.Sub29Code);
	
	if(subjects.Sub26IsPrac == 1){ $("#Sub251_Code").val(subjects.Sub26Code); } else { $("#Sub251_Code").val(''); }
	if(subjects.Sub27IsPrac == 1){ $("#Sub261_Code").val(subjects.Sub27Code); } else { $("#Sub261_Code").val(''); }
	if(subjects.Sub28IsPrac == 1){ $("#Sub271_Code").val(subjects.Sub28Code); } else { $("#Sub271_Code").val(''); }
}
function BindDistricts(){
	var districts = AppData.Districts;
	if(districts.length > 0 && districts.length < 2)
		BindSelect(districts, "#District", false);
	else
		BindSelect(districts, "#District", true);
}
function load_data()
{
	$.ajax
	({
		type: "POST",
		url: "ajax_admdata10.php",
		dataType: "json",
		success: function(data)
		{
			AppData.SubjectGroups=data.SubjectGroups;
			AppData.SubjectCombinations=data.SubjectCombinations;
			AppData.Districts=data.Districts;
			BindGroups(); BindDistricts();
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