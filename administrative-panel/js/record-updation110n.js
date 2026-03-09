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
	$("#Subject9").val(''); $("#Subject21").val('');
	$("#Subject22").val(''); $("#Subject23").val('');
	$("#Subject24").val(''); $("#Subject25").val('');
	$("#Subject26").val(''); $("#Subject27").val('');
	$("#Subject28").val(''); $("#Subject29").val('');
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
	$("#Subject21").val(subjects.Sub21Name); $("#Sub21Checkbox").val(subjects.Sub21Code);
	$("#Subject22").val(subjects.Sub22Name); $("#Sub22Checkbox").val(subjects.Sub22Code);
	$("#Subject23").val(subjects.Sub23Name); $("#Sub23Checkbox").val(subjects.Sub23Code);
	$("#Subject24").val(subjects.Sub24Name); $("#Sub24Checkbox").val(subjects.Sub24Code);
	$("#Subject25").val(subjects.Sub25Name); $("#Sub25Checkbox").val(subjects.Sub25Code);
	$("#Subject26").val(subjects.Sub26Name); $("#Sub26Checkbox").val(subjects.Sub26Code);
	$("#Subject27").val(subjects.Sub27Name); $("#Sub27Checkbox").val(subjects.Sub27Code);
	$("#Subject28").val(subjects.Sub28Name); $("#Sub28Checkbox").val(subjects.Sub28Code);
	$("#Subject29").val(subjects.Sub29Name); $("#Sub29Checkbox").val(subjects.Sub29Code);
	clearSelectedBox();
	SelectAllSubjects();
}
function SelectAllSubjects(){
	CheckIfSubExist($("#Sub1Checkbox").val(),"#Sub1Checkbox"); CheckIfSubExist($("#Sub2Checkbox").val(),"#Sub2Checkbox");
	CheckIfSubExist($("#Sub3Checkbox").val(),"#Sub3Checkbox"); CheckIfSubExist($("#Sub4Checkbox").val(),"#Sub4Checkbox");
	CheckIfSubExist($("#Sub5Checkbox").val(),"#Sub5Checkbox"); CheckIfSubExist($("#Sub6Checkbox").val(),"#Sub6Checkbox");
	CheckIfSubExist($("#Sub7Checkbox").val(),"#Sub7Checkbox"); CheckIfSubExist($("#Sub8Checkbox").val(),"#Sub8Checkbox");
	CheckIfSubExist($("#Sub9Checkbox").val(),"#Sub9Checkbox"); CheckIfSubExist($("#Sub21Checkbox").val(),"#Sub21Checkbox");
	CheckIfSubExist($("#Sub22Checkbox").val(),"#Sub22Checkbox"); CheckIfSubExist($("#Sub23Checkbox").val(),"#Sub23Checkbox");
	CheckIfSubExist($("#Sub24Checkbox").val(),"#Sub24Checkbox"); CheckIfSubExist($("#Sub25Checkbox").val(),"#Sub25Checkbox");
	CheckIfSubExist($("#Sub26Checkbox").val(),"#Sub26Checkbox"); CheckIfSubExist($("#Sub27Checkbox").val(),"#Sub27Checkbox");
	CheckIfSubExist($("#Sub28Checkbox").val(),"#Sub28Checkbox"); CheckIfSubExist($("#Sub29Checkbox").val(),"#Sub29Checkbox");
}
function CheckIfSubExist(subcode,selector){
	
	if((subcode != '') && (subcode==AppData.PrevSubjects.Sub1Code || subcode==AppData.PrevSubjects.Sub2Code ||
		subcode==AppData.PrevSubjects.Sub3Code || subcode==AppData.PrevSubjects.Sub4Code ||
		subcode==AppData.PrevSubjects.Sub5Code || subcode==AppData.PrevSubjects.Sub6Code ||
		subcode==AppData.PrevSubjects.Sub7Code || subcode==AppData.PrevSubjects.Sub8Code ||
		subcode==AppData.PrevSubjects.Sub9Code || subcode==AppData.PrevSubjects.Sub21Code ||
		subcode==AppData.PrevSubjects.Sub22Code || subcode==AppData.PrevSubjects.Sub23Code ||
		subcode==AppData.PrevSubjects.Sub24Code || subcode==AppData.PrevSubjects.Sub25Code ||
		subcode==AppData.PrevSubjects.Sub26Code || subcode==AppData.PrevSubjects.Sub27Code ||
		subcode==AppData.PrevSubjects.Sub28Code || subcode==AppData.PrevSubjects.Sub29Code)){
		
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