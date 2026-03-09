<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	/*
	$sql="SELECT * FROM posts WHERE emp_id='".$_REQUEST['emp_id']."'";
	$res=mysql_query($sql, $conn1);
	$num_rows=mysql_num_rows($res);
	
	if($num_rows==0)
	{
	*/
	$sql="DELETE FROM institutes WHERE inst_id='".$_REQUEST['inst_id']."'";
	$res=mysql_query($sql, $conn1);
	?><script type="text/javascript">location.replace('institutes.php');</script><?php
	/*}
	else
	{
	echo "<script>"; echo "alert('Cannot Delete User as User has posted info');"; echo "</script>";
	?><script type="text/javascript">location.replace('employees.php');</script><?php
	}
	*/
	?>
</div>
<?php include('includes/footer.php');?>