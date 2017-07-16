<?php
// Inialize session
 session_start();

// Check, if username session is NOT set then this page will jump to login page
 if (!isset($_SESSION['username'])) {
 header('Location: /login/index.php');
 }

// Load secure common files
require($_SERVER['DOCUMENT_ROOT'] . '/frame/coms.php');

// Grab the username.
$user_current =  $_SESSION['username'];
$action = "LOGIN";

$qry_userlog = "INSERT INTO userlog (username, userip, useragent, action)

	 			           VALUES

	   			         ('$user_current', '$user_ip', '$user_agent', '$action')";



		// Put and action between the brackets if you want
		if (mysqli_query($con, $qry_userlog)){ 
		
											}
				else
					{
					 echo("<br>Input data failed.");
					  }
	
?>