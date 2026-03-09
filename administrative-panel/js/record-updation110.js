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
	
	$("#checkbox1").click(function (){
	
		if($("#checkbox1").is(":checked")){
			$("#PermanentAddress").val($("#PostalAddress").val());
		}
		else {
			$("#PermanentAddress").val('');
		}
	});
	
	$("#PostalDistrict").change(function (){
	
		var PostalDistrict = parseInt($(this).val(), 10);
		if(PostalDistrict > 0){
			BindPostalTehsils(PostalDistrict);
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
	$("#PostalDistrict").val(data.PostalDistrict).trigger("liszt:updated");
	$("#PostalDistrict").trigger("change");
	$("#PostalTehsil").val(data.PostalTehsil).trigger("liszt:updated");
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
	$("#Subject1").val(''); $("#Subject2").val('');
	$("#Subject3").val(''); $("#Subject4").val('');
	$("#Subject5").val(''); $("#Subject6").val('');
	$("#Subject7").val(''); $("#Subject8").val('');
	$("#Subject9").val(''); $("#Subject10").val('');
	$("#Subject11").val(''); $("#Subject12").val('');
	$("#Subject13").val(''); $("#Subject14").val('');
	$("#Subject15").val(''); $("#Subject16").val('');
	$("#tbl-subjects li div input[type='checkbox']").attr('checked', false);
}
function clearSelectedBox(){
	$("#tbl-subjects li div input[type='checkbox']").attr('checked', false);
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
	clear();
	var subjects = $.grep(AppData.SubjectCombinations, function (e) { return e.Id == combinationId; })[0];
	$("#Subject1").val(subjects.Sub1Name); $("#Sub1Checkbox").val(subjects.Sub1Code);
	$("#Subject2").val(subjects.Sub2Name); $("#Sub2Checkbox").val(subjects.Sub2Code);
	$("#Subject3").val(subjects.Sub3Name); $("#Sub3Checkbox").val(subjects.Sub3Code);
	$("#Subject4").val(subjects.Sub4Name); $("#Sub4Checkbox").val(subjects.Sub4Code);
	$("#Subject5").val(subjects.Sub5Name); $("#Sub5Checkbox").val(subjects.Sub5Code);
	$("#Subject6").val(subjects.Sub6Name); $("#Sub6Checkbox").val(subjects.Sub6Code);
	$("#Subject7").val(subjects.Sub7Name); $("#Sub7Checkbox").val(subjects.Sub7Code);
	$("#Subject8").val(subjects.Sub8Name); $("#Sub8Checkbox").val(subjects.Sub8Code);
	$("#Subject9").val(subjects.Sub9Name); $("#Sub9Checkbox").val(subjects.Sub9Code);
	$("#Subject10").val(subjects.Sub10Name); $("#Sub10Checkbox").val(subjects.Sub10Code);
	$("#Subject11").val(subjects.Sub11Name); $("#Sub11Checkbox").val(subjects.Sub11Code);
	$("#Subject12").val(subjects.Sub12Name); $("#Sub12Checkbox").val(subjects.Sub12Code);
	$("#Subject13").val(subjects.Sub13Name); $("#Sub13Checkbox").val(subjects.Sub13Code);
	$("#Subject14").val(subjects.Sub14Name); $("#Sub14Checkbox").val(subjects.Sub14Code);
	$("#Subject15").val(subjects.Sub15Name); $("#Sub15Checkbox").val(subjects.Sub15Code);
	$("#Subject16").val(subjects.Sub16Name); $("#Sub16Checkbox").val(subjects.Sub16Code);
	clearSelectedBox();
	SelectAllSubjects();
}
function SelectAllSubjects(){
	CheckIfSubExist($("#Sub1Checkbox").val(),"#Sub1Checkbox"); CheckIfSubExist($("#Sub2Checkbox").val(),"#Sub2Checkbox");
	CheckIfSubExist($("#Sub3Checkbox").val(),"#Sub3Checkbox"); CheckIfSubExist($("#Sub4Checkbox").val(),"#Sub4Checkbox");
	CheckIfSubExist($("#Sub5Checkbox").val(),"#Sub5Checkbox"); CheckIfSubExist($("#Sub6Checkbox").val(),"#Sub6Checkbox");
	CheckIfSubExist($("#Sub7Checkbox").val(),"#Sub7Checkbox"); CheckIfSubExist($("#Sub8Checkbox").val(),"#Sub8Checkbox");
	CheckIfSubExist($("#Sub9Checkbox").val(),"#Sub9Checkbox"); CheckIfSubExist($("#Sub10Checkbox").val(),"#Sub10Checkbox");
	CheckIfSubExist($("#Sub11Checkbox").val(),"#Sub11Checkbox"); CheckIfSubExist($("#Sub12Checkbox").val(),"#Sub12Checkbox");
	CheckIfSubExist($("#Sub13Checkbox").val(),"#Sub13Checkbox"); CheckIfSubExist($("#Sub14Checkbox").val(),"#Sub14Checkbox");
	CheckIfSubExist($("#Sub15Checkbox").val(),"#Sub15Checkbox"); CheckIfSubExist($("#Sub16Checkbox").val(),"#Sub16Checkbox");
}
function CheckIfSubExist(subcode,selector){
	
	if((subcode != '') && (subcode==AppData.PrevSubjects.Sub1Code || subcode==AppData.PrevSubjects.Sub2Code ||
		subcode==AppData.PrevSubjects.Sub3Code || subcode==AppData.PrevSubjects.Sub4Code ||
		subcode==AppData.PrevSubjects.Sub5Code || subcode==AppData.PrevSubjects.Sub6Code ||
		subcode==AppData.PrevSubjects.Sub7Code || subcode==AppData.PrevSubjects.Sub8Code ||
		subcode==AppData.PrevSubjects.Sub9Code || subcode==AppData.PrevSubjects.Sub10Code ||
		subcode==AppData.PrevSubjects.Sub11Code || subcode==AppData.PrevSubjects.Sub12Code ||
		subcode==AppData.PrevSubjects.Sub13Code || subcode==AppData.PrevSubjects.Sub14Code ||
		subcode==AppData.PrevSubjects.Sub15Code || subcode==AppData.PrevSubjects.Sub16Code)){
		
		$(selector).attr('checked', true);
		$(selector).val(subcode);
	}
}
function BindDomiciles(){
	var districts = AppData.Districts;
	if(districts.length > 0 && districts.length < 2)
		BindSelect(districts, "#Domicile", false);
	else
		BindSelect(districts, "#Domicile", true);
}
function BindPostalDistricts(){
	var districts = AppData.Districts;
	if(districts.length > 0 && districts.length < 2)
		BindSelect(districts, "#PostalDistrict", false);
	else
		BindSelect(districts, "#PostalDistrict", true);
}
function BindPostalTehsils(postaldistrict){
	var tehsils = $.grep(AppData.Tehsils, function (e) { return e.DistrictId == postaldistrict; });
	if(tehsils.length > 0 && tehsils.length < 2)
		BindSelect(tehsils, "#PostalTehsil", false);
	else
		BindSelect(tehsils, "#PostalTehsil", true);
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
		url: "ajax_admdata10.php",
		data:"Id="+getUrlVars()["Id"],
		dataType: "json",
		success: function(data)
		{
			AppData.SubjectGroups=data.SubjectGroups;
			AppData.SubjectCombinations=data.SubjectCombinations;
			AppData.Districts=data.Districts;
			AppData.Tehsils=data.Tehsils;
			AppData.PrevSubjects=data.Students10;
			BindGroups(); BindDomiciles(); BindPostalDistricts(); BindExamDistricts();
			var record=data.Students10;
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