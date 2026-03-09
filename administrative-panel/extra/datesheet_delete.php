<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	$sql="DELETE FROM datesheet WHERE Id=".$_REQUEST['Id']."";
	
	if(mysql_query($sql, $conn1))
	{
		?><script>alert('Information Deleted Successfully.');location.replace('datesheet.php');</script><?php
	}
	else
	{
		?><script>alert('Error in Query.');location.replace('datesheet.php');</script><?php
	}
	?>
</div>
<?php include('includes/footer.php');?>