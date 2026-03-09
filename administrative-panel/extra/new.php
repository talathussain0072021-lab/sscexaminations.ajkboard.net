<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
	
<body>

<?php
/* 
$subject4 = explode('-', 'History of Pakistan (1857-1947)-15'); 
$subject4end = ''; $subject4begin = '';
			
	if(count($subject4) > 0)
	{ $subject4end = array_pop($subject4).' '; if(count($subject4) > 0){ $subject4begin = implode('-', $subject4); } }
			
echo $subject4end; echo ' ';
echo $subject4begin;
*/
?>



<?php /* include('includes/top.php'); ?>
<table width="100%">

<?php 
$sql="SELECT * FROM institute_login, institutes WHERE institute_login.inst_id=institutes.inst_id ORDER BY institutes.inst_id ASC";
$res=mysql_query($sql, $conn1);
while($row=mysql_fetch_array($res))
{ 
$rand_no=rand(1000,9999);
$password=$row['login_code'].substr($row['inst_name'], 0, 1).$rand_no;

$sql_updt="UPDATE institute_login SET login_password2='".$password."' WHERE login_id='".$row['login_id']."'";
$res_updt=mysql_query($sql_updt, $conn1);
?>	
<tr>
	<td width="20%"><?php echo $row['login_code'];?></td>
	<td width="20%"><?php echo $row['inst_name'];?></td>
	<td width="20%"><?php echo $password;?> </td>
</tr> 

<?php } */?>

<!--</table>-->		
</body>
</html>
