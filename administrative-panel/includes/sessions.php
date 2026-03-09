<?php
	if(!isset($_SESSION['emp_user_rights']))
	{
		?><script type="text/javascript">location.replace('login.php');</script><?php
	}
?>