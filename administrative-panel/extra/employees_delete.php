<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
		$sql="DELETE FROM employees WHERE emp_id=".$_REQUEST['emp_id']."";
		$res=mysql_query($sql, $conn1);
		?><script type="text/javascript">location.replace('employees.php');</script><?php
	?>
</div>
<?php include('includes/footer.php');?>