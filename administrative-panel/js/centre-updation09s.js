$(document).ready(function(){
	load_data();
	$("#ACentreId").change(function (){
	
		var centreId = parseInt($(this).val(), 10);
		if(centreId > 0){
			BindCentres(centreId);
		}
	});
})
function edit_data(data)
{
	$("#ACentreId").val(data.ACentreId).trigger("liszt:updated");
	$("#ACentreName").val(data.ACentreName);
}
function BindExamCentres(){
	var centres = AppData.ExamCentres;
	if(centres.length > 0 && centres.length < 2)
		BindSelect(centres, "#ACentreId", false);
	else
		BindSelect(centres, "#ACentreId", true);
}
function BindCentres(centreId){
	var centres = $.grep(AppData.ExamCentres, function (e) { return e.Id == centreId; })[0];
	$("#ACentreName").val(centres.Name);
}
function load_data()
{
	$.ajax
	({
		type: "POST",
		url: "ajax_admdata09s.php",
		data:"Id="+getUrlVars()["Id"],
		dataType: "json",
		success: function(data)
		{
			AppData.ExamCentres=data.ExamCentres;
			var record=data.StudentsCentres09;
			BindExamCentres();
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
			html += "<option value='" + token.Id + "'>" + token.Code + "</option>";
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