<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	$sql="DELETE FROM admbatchstudents10 WHERE StudentId=".$_REQUEST['Id']."";
	
	if(mysql_query($sql, $conn1))
	{
		$ins="INSERT INTO tbl_piilog SET
		ActivityType			=		'AdmDeletion-II',
		StudentId				=		".$_REQUEST['Id'].",
		EmployeeId				=		".$_SESSION['emp_id']."";
		$res=mysql_query($ins, $conn1);
		
		?><script>alert('Information Processed Successfully.');location.replace('allstudents_padm10.php');</script><?php
	}
	else
	{
		?><script>alert('Error in Query.');location.replace('allstudents_padm10.php');</script><?php
	}
	?>
</div>
<?php include('includes/footer.php');?>