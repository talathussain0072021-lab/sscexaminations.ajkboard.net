<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	$sql="DELETE FROM sessions WHERE Id=".$_REQUEST['Id']."";
	$res=mysql_query($sql, $conn1);
	?><script type="text/javascript">location.replace('sessions.php');</script>
</div>
<?php include('includes/footer.php');?>