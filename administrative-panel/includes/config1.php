<?php
	error_reporting(1);
	session_start();
	define('SITE_URL', 'http://localhost/AJKBISE-MATRIC/administrative-panel/');
	define('SITE_TITLE', 'AJKBISE ADMIN PANEL');
	
	// Database 1 configuration
	define('DB1_SERVER', 'localhost');
	define('DB1_USERNAME', 'root');
	define('DB1_PASSWORD', '');
	define('DB1_DATABASE', '2A_matric_examination');
	
	// Database 2 configuration
	define('DB2_SERVER', 'localhost');
	define('DB2_USERNAME', 'root');
	define('DB2_PASSWORD', '');
	define('DB2_DATABASE', 'challansdb');
	
	// Connect to Database 1
	$conn1 = mysql_connect(DB1_SERVER, DB1_USERNAME, DB1_PASSWORD);
	if (!$conn1) {
		die('Could not connect to Database 1: ' . mysql_error());
	}
	mysql_select_db(DB1_DATABASE, $conn1);
	
	// Connect to Database 2
	$conn2 = mysql_connect(DB2_SERVER, DB2_USERNAME, DB2_PASSWORD, true);
	if (!$conn2) {
		die('Could not connect to Database 2: ' . mysql_error());
	}
	mysql_select_db(DB2_DATABASE, $conn2);
?>