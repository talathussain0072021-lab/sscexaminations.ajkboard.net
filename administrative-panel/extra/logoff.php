<?php
include('includes/config.php');
unset($_SESSION['emp_id']);
unset($_SESSION['emp_user_name']);
unset($_SESSION['emp_full_name']);
unset($_SESSION['emp_type']);
unset($_SESSION['emp_user_rights']);

?><script type="text/javascript">location.replace('<?php echo SITE_URL;?>');</script>