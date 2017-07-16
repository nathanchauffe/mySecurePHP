<?php


// Find and sanitize user ip address
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$user_ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
 		   $user_ip = $_SERVER['REMOTE_ADDR'];
		}

// Find user browser
$user_agent = $_SERVER['HTTP_USER_AGENT'];


?>
