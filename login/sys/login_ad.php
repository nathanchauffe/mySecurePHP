<?php

// Inialize session
session_start();

// Include secure common files.
require($_SERVER['DOCUMENT_ROOT'] . '/frame/coms.php');

// Grab user input from html form on previous page.
$password = mysqli_real_escape_string($con, $_POST['password']);
$username = mysqli_real_escape_string($con, $_POST['username']);


// Check if ip has more than  10 login fails in the last 30 minutes.
$sql = "SELECT userip, COUNT(*) AS cnt 
	FROM signlog 
	WHERE date > DATE_SUB(NOW(), INTERVAL 30 MINUTE) 
	AND userip = '$user_ip' GROUP BY userip HAVING cnt > 10";

// If the query executes, count the number of rows.
if ($result=mysqli_query($con,$sql)){
	$rowcount=mysqli_num_rows($result);
}

// If there is a match, redirect user to ip lockout page.
if(mysqli_num_rows($result)==1) {
	header('Location: /login/lockip.html');
} else {

// Free result set for another query.
mysqli_free_result($result);
}
// Check if username has more than 5 login fails in the last 15 minutes.
$sql="SELECT username, COUNT(*) AS cnt 
      FROM signlog 
      WHERE date > DATE_SUB(NOW(), INTERVAL 15 MINUTE) 
      AND username = '$username' GROUP BY username HAVING cnt > 5";
      
// If the query executes, count the number of rows.
if ($result=mysqli_query($con,$sql)){
	$rowcount=mysqli_num_rows($result);
}

// If there is a match, redirect user to lockout page.
if(mysqli_num_rows($result)==1) {
	header('Location: /login/lockuser.html');
} else {

// Free result set for another query.
mysqli_free_result($result);
}
// Check if ip has more than  10 login fails in the last 30 minutes.
$sql = "SELECT username 
	FROM prof
	WHERE username = '$username'
	AND status = 'ADMIN'
	";

// If the query executes, count the number of rows.
if ($result=mysqli_query($con,$sql)){
	$rowcount=mysqli_num_rows($result);
}

// If there is a match, continue with login.
if(mysqli_num_rows($result)==1) {
	


// Free result set for another query.
mysqli_free_result($result);


// User authenticanion query.
$qry_auser = "SELECT password FROM user WHERE username ='" . $username . "' ";

// Retrieve password from database that matches username.
$query = mysqli_query($con, $qry_auser);

// Fetch the row with the username match.
$row = mysqli_fetch_array($query);

// Let's be real speific...
$dbvalue = $row[0];

// Calculate the hash values and see if they match.
$verify = password_verify($password, $dbvalue);

// If the hash values match, set username session variable and login.
if($verify){
 	$_SESSION['username_ad'] = $_POST['username'];
	$username_ad = $_SESSION['username_ad'];
	$action = "LOGIN_AD";
	

$qry_userlog = "INSERT INTO userlog (username, userip, useragent, action)

	 			           VALUES

	   			         ('$username_ad', '$user_ip', '$user_agent', '$action')";



		// Put and action between the brackets if you want
		if (mysqli_query($con, $qry_userlog)){ 
		
											}
				else
					{
					 echo("<br>Input data failed.");
					  }
	
	
	
	
	
	header('Location: /login/admin/preview.php');
}else {

// Insert user information into failed attempt logs.
$qry_erlog = "INSERT INTO signlog (username, userip, useragent, failed)

	 			           VALUES

	   			         ('$username', '$user_ip', '$user_agent', 'ADMIN')";



		// Log it as an error attempt
		if (mysqli_query($con, $qry_erlog)){
		 // Jump to login page
		header('Location: /login/admin/loginfail.html');
		
							}
				
	
	 	
		 }

}else {
echo "Youre not an admin.";
}



 
?> 
