<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	$sql="DELETE FROM cities WHERE id='".$_REQUEST['id']."'";
	$res=mysql_query($sql, $conn1);
	$row=mysql_fetch_array($res);
	?><script type="text/javascript">location.replace('cities.php');</script>
</div>
<?php include('includes/footer.php');?>