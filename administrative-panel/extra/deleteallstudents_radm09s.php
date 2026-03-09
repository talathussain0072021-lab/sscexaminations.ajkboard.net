<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	$sql="DELETE FROM admbatchstudents09s WHERE StudentId=".$_REQUEST['Id']."";
	
	if(mysql_query($sql, $conn1))
	{
		$ins="INSERT INTO tbl_pislog SET
		ActivityType			=		'AdmDeletion-Is',
		StudentId				=		".$_REQUEST['Id'].",
		EmployeeId				=		".$_SESSION['emp_id']."";
		$res=mysql_query($ins, $conn1);
		
		?><script>alert('Information Processed Successfully.');location.replace('allstudents_radm09s.php');</script><?php
	}
	else
	{
		?><script>alert('Error in Query.');location.replace('allstudents_radm09s.php');</script><?php
	}
	?>
</div>
<?php include('includes/footer.php');?>