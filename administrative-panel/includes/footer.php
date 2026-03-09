</body>
</html>
<?php mysql_close($conn1); mysql_close($conn2);?>
<script>
$(".myDate").datepicker({
	dateFormat: "dd-mm-yy",
	yearRange: "-1:+0",
	changeMonth: true,
	changeYear: true
});
$(".myDate1").datepicker({
	dateFormat: "dd-mm-yy"
});
$(".myTime").timepicker({
	timeFormat: "hh:mm tt"
});
$(".myDateofbirth").datepicker({
	dateFormat: "dd-mm-yy",
	yearRange: "-50:-12",
	changeMonth: true,
	changeYear: true
});
</script>
<script type="text/JavaScript">
$(window).load(function(){
	$(".abc").focus();
})
</script>
<script>
function isAlphabet(evt)
{
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if(charCode != 45 && charCode > 32 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122)){ return false; }
	return true;
}
function isNumber(evt)
{
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if(charCode > 31 && (charCode < 48 || charCode > 57)){ return false; }
	return true;
}
function isNumberKey(evt)
{
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if(charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){ return false; }
	return true;
}
function isNumberdash(evt)
{
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if(charCode != 45 && charCode > 31 && (charCode < 48 || charCode > 57)){ return false; }
	return true;
}
function isSpecialKey(evt)
{
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if((charCode > 32 && charCode < 40) || (charCode > 57 && charCode < 65) || (charCode > 90 && charCode < 97) || (charCode > 122))
	{ return false; }
	//if(charCode == 35 || charCode == 38 || charCode == 39 || charCode == 92){ return false; }
	return true;
}
</script>
<script>
/*$('#CNIC').keydown(function(){

	//allow  backspace, tab, ctrl+A, escape, carriage return
	if(event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
	(event.keyCode == 65 && event.ctrlKey === true))
	return;
	if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105))
	event.preventDefault();

	var length = $(this).val().length;
	if(length == 5 || length == 13)
	$(this).val($(this).val()+'-');
});*/

var loadFile = function(event){
	Alert_PicURL();
	var reader = new FileReader();
	reader.onload = function(){
		var output = document.getElementById('Output');
		output.src = reader.result;
	};
	reader.readAsDataURL(event.target.files[0]);
};

function Alert_PicURL(){
	var Pic_Size = $('#'+'PicURL')[0].files[0].size;
	var Pic_Name = document.getElementById('PicURL').value;
	var Pic_Ext = Pic_Name.substring(Pic_Name.lastIndexOf('.') + 1).toLowerCase();
	
	if(Pic_Ext != 'jpg' && Pic_Ext != 'jpeg')
	{
		alert("Only .JPG type picture can be uploaded");
		document.getElementById('Output').src="";
		document.getElementById('PicURL').value='';
		return false;
	}
	else if(Pic_Size > 500000 || Pic_Size < 40000)
	{
		alert("Picture size must be in between 40KB to 500KB");
		document.getElementById('Output').src="";
		document.getElementById('PicURL').value='';
		return false;
	}
}
</script>