<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	$sql="DELETE FROM subjectcombinations WHERE Id=".$_REQUEST['Id']."";
	
	if(mysql_query($sql, $conn1)) {
		$sql = mysql_query("CALL vwsubcombinations09TableCreation()", $conn1);
		$sql = mysql_query("CALL vwsubcombinations10TableCreation()", $conn1);
		?><script>location.replace('subjcombinations.php?message=Data Updated Successfully.');</script><?php
	}
	?>
</div>
<?php include('includes/footer.php');?>