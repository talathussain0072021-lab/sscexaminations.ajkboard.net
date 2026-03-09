<?php include('includes/config.php');?>
<?php
// echo "<h2>1. Connection Test</h2>";
// echo "conn1: " . (is_object($conn1) ? "Connected ✓" : "NOT Connected ✗") . "<br>";
// echo "conn2: " . (is_object($conn2) ? "Connected ✓" : "NOT Connected ✗") . "<br>";
// echo "Default connection: " . (isset($GLOBALS['mysql_default_connection']) ? "Set ✓" : "NOT Set ✗") . "<br>";

// echo "<h2>2. Table Check</h2>";
// $sql_check = "SHOW TABLES LIKE 'tbladm_10'";
// $res_check = mysqli_query($sql_check, $conn1);
// echo "Query executed: " . ($res_check ? "Success ✓" : "Failed ✗") . "<br>";
// if($res_check) {
//     echo "Rows found: " . mysql_num_rows($res_check) . "<br>";
// } else {
//     echo "MySQL Error: " . mysql_error($conn1) . "<br>";
// }

	if(isset($_REQUEST['submit']))
	{
		$sql="SELECT emp_id, emp_user_name, emp_full_name, emp_user_rights, emp_type FROM employees WHERE EnUserName='".md5($_REQUEST['user_name'])."' AND emp_password='".md5($_REQUEST['user_password'])."'";
		$res=mysqli_query($conn2,$sql);
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_assoc($res);
			$_SESSION['emp_id']=$row['emp_id'];
			$_SESSION['emp_user_name']=$row['emp_user_name'];
			$_SESSION['emp_full_name']=$row['emp_full_name'];
			$_SESSION['emp_type']=$row['emp_type'];
			$_SESSION['emp_user_rights']=explode(',',$row['emp_user_rights']);
			?><script type="text/javascript">location.replace('<?php echo SITE_URL.'index.php';?>');</script><?php	
		}	
		else
		{ ?><script type="text/javascript">alert('<?php echo "Username Or Password is Incorrect";?>');</script><?php }
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width"/>
<title><?php echo SITE_TITLE;?></title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/layout.css" rel="stylesheet" type="text/css">
<link href="css/themes.css" rel="stylesheet" type="text/css">
<link href="css/typography.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/shCore.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/jquery.jqplot.css" rel="stylesheet" type="text/css">
<link href="css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css">
<link href="css/data-table.css" rel="stylesheet" type="text/css">
<link href="css/form.css" rel="stylesheet" type="text/css">
<link href="css/ui-elements.css" rel="stylesheet" type="text/css">
<link href="css/wizard.css" rel="stylesheet" type="text/css">
<link href="css/sprite.css" rel="stylesheet" type="text/css">
<link href="css/gradient.css" rel="stylesheet" type="text/css">
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="css/ie/ie7.css" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="css/ie/ie8.css" />
<![endif]-->
<!--[if IE 9]>
<link rel="stylesheet" type="text/css" href="css/ie/ie9.css" />
<![endif]-->
<!-- Jquery -->
<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/jquery-ui-1.8.18.custom.min.js"></script>
<script src="js/chosen.jquery.js"></script>
<script src="js/uniform.jquery.js"></script>
<script src="js/bootstrap-dropdown.js"></script>
<script src="js/bootstrap-colorpicker.js"></script>
<script src="js/sticky.full.js"></script>
<script src="js/jquery.noty.js"></script>
<script src="js/selectToUISlider.jQuery.js"></script>
<script src="js/fg.menu.js"></script>
<script src="js/jquery.tagsinput.js"></script>
<script src="js/jquery.cleditor.js"></script>
<script src="js/jquery.tipsy.js"></script>
<script src="js/jquery.peity.js"></script>
<script src="js/jquery.simplemodal.js"></script>
<script src="js/jquery.jBreadCrumb.1.1.js"></script>
<script src="js/jquery.colorbox-min.js"></script>
<script src="js/jquery.idTabs.min.js"></script>
<script src="js/jquery.multiFieldExtender.min.js"></script>
<script src="js/jquery.confirm.js"></script>
<script src="js/elfinder.min.js"></script>
<script src="js/accordion.jquery.js"></script>
<script src="js/autogrow.jquery.js"></script>
<script src="js/check-all.jquery.js"></script>
<script src="js/data-table.jquery.js"></script>
<script src="js/ZeroClipboard.js"></script>
<script src="js/TableTools.min.js"></script>
<script src="js/jeditable.jquery.js"></script>
<script src="js/duallist.jquery.js"></script>
<script src="js/easing.jquery.js"></script>
<script src="js/full-calendar.jquery.js"></script>
<script src="js/input-limiter.jquery.js"></script>
<script src="js/inputmask.jquery.js"></script>
<script src="js/iphone-style-checkbox.jquery.js"></script>
<script src="js/meta-data.jquery.js"></script>
<script src="js/quicksand.jquery.js"></script>
<script src="js/raty.jquery.js"></script>
<script src="js/smart-wizard.jquery.js"></script>
<script src="js/stepy.jquery.js"></script>
<script src="js/treeview.jquery.js"></script>
<script src="js/ui-accordion.jquery.js"></script>
<script src="js/vaidation.jquery.js"></script>
<script src="js/mosaic.1.0.1.min.js"></script>
<script src="js/jquery.collapse.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/jquery.autocomplete.min.js"></script>
<script src="js/localdata.js"></script>
<script src="js/excanvas.min.js"></script>
<script src="js/jquery.jqplot.min.js"></script>
<script src="js/chart-plugins/jqplot.dateAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.cursor.min.js"></script>
<script src="js/chart-plugins/jqplot.logAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.canvasTextRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.highlighter.min.js"></script>
<script src="js/chart-plugins/jqplot.pieRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.barRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.pointLabels.min.js"></script>
<script src="js/chart-plugins/jqplot.meterGaugeRenderer.min.js"></script>
<script src="js/custom-scripts.js"></script>
</head>
<body id="theme-default" class="full_block">
<div id="login_page">
	<div class="login_container">
		<div class="login_header blue_lgel">
			<ul class="login_branding">
				<li>
				<div class="logo_small">
					<img src="images/logo.png" width="100" height="40" alt="Multibiz">
				</div>
				
				</li>
				<li class="right go_to"><a href="#" title="Go to Main Site" class="home">Go To Main Site</a></li>
			</ul>
		</div>
		<div class="block_container blue_d">
			<form action="" method="post">
				<div class="block_form">
					<ul>
						<li class="login_user">
						<input name="user_name" value="username" onKeyPress="return isSpecialKey()" maxlength="30" onClick="this.value=''" type="text">
						</li>
						<li class="login_pass">
						<input name="user_password" type="password" value="123456" maxlength="20" onKeyPress="return isSpecialKey()" onClick="this.value=''">
						</li>
					</ul>
					<input class="login_btn blue_lgel" name="submit" value="Login" type="submit">
				</div>
				<ul class="login_opt_link">
					<li><a href="#">Forgot Password?</a></li>
					<li class="remember_me right">
					<input name="" class="rem_me" type="checkbox" value="checked">
					Remember Me</li>
				</ul>
			</form>
		</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
$(function(){
	$(window).resize(function(){
		$('.login_container').css({
			position:'absolute',
			left: ($(window).width() - $('.login_container').outerWidth())/2,
			top: ($(window).height() - $('.login_container').outerHeight())/2
		});
	});
	// To initially run the function:
	$(window).resize();
});

function isSpecialKey(evt)
{
    evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
    if(charCode == 32 || charCode == 39){ return false; }
	//if((charCode > 64 && charCode < 91) || (charCode < 96 || charCode > 123) || (charCode >= 48 && charCode <= 57) || charCode == 8 || charCode == 32) { return false; }
    return true;
}
</script>