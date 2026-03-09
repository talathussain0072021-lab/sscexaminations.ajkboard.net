<?php
	error_reporting();
	session_start();
	define('SITE_URL', 'https://sscexaminatoins.ajkboard.net/administrative-panel/');
	define('SITE_TITLE', 'AJKBISE ADMIN PANEL');
	
	// Database 1 configuration
	define('DB1_SERVER', '192.168.1.2');
	define('DB1_USERNAME', 'SSC_Adm_User');
	define('DB1_PASSWORD', '$6Qjq765h?');
	define('DB1_DATABASE', 'Matric_Admissions');
	
	// Connect to Database 1 (MySQLi)
	$server   = "192.168.1.3\\WEBRESULTS";
	$database = "RESULTTABLES";
	$username = "sa";
	$password = "paki@#1974";

	// Connect to Database 1 (MySQLi)
	$conn1 = mysqli_connect(DB1_SERVER, DB1_USERNAME, DB1_PASSWORD, DB1_DATABASE);
	if (!$conn1) {
		die('Could not connect to Database 1: ' . mysqli_connect_error());
	}
	// else{
	// 	echo "Connected to Database 1 successfully.";
	// }
	// Database 2 configuration
	define('DB2_SERVER', '192.168.1.2');
	define('DB2_USERNAME', 'sscexaminations_Users');
	define('DB2_PASSWORD', '15s8gS8h@');
	define('DB2_DATABASE', 'Matric_Examination');	
	
	// Connect to Database 2 (MySQLi)
	$conn2 = mysqli_connect(DB2_SERVER, DB2_USERNAME, DB2_PASSWORD, DB2_DATABASE);
	if (!$conn2) {
		die('Could not connect to Database 2: ' . mysqli_connect_error());
	}
	// else{
	// 	echo "Connected to Database 2 successfully.";
	// }
	// Set charset to UTF-8 for proper character handling
	mysqli_set_charset($conn1, 'utf8');
	
	
		// Set the default connection for the compatibility layer
		$GLOBALS['mysql_default_connection'] = $conn1;  // Set conn1 as default for mysql_* functions

?>