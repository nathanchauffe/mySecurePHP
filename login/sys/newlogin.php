<?php

// Inialize session
session_start();

// Include secure common files.
require($_SERVER['DOCUMENT_ROOT'] . '/frame/coms.php');

// Grab user input from html form on previous page.
$password = mysqli_real_escape_string($con, $_POST['password']);
$username = mysqli_real_escape_string($con,$_POST['username']);

// Check if there were more than 10 failed login attempts from this IP.
$sql = "SELECT userip, COUNT(*) AS cnt FROM signlog WHERE time > DATE_SUB(NOW(), INTERVAL 30 MINUTE) AND userip = '$user_ip' GROUP BY userip HAVING cnt > 10";

if ($result=mysqli_query($con,$sql))
  {
// Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
  printf("Result set has %d rows.\n",$rowcount);

  }

if(mysqli_num_rows($result)==1) {
header('Location: /login/lockip.html');
} else {
// Free result set
  mysqli_free_result($result);
  
// Check if there were more than 5 failed login attempts for this username.
$sql2="SELECT username, COUNT(*) AS cnt FROM signlog WHERE time > DATE_SUB(NOW(), INTERVAL 15 MINUTE) AND username = '$username' GROUP BY username HAVING cnt > 5";

if ($result2=mysqli_query($con,$sql2))
  {
  // Return the number of rows in result set
  $rowcount2=mysqli_num_rows($result2);
  printf("Result set has %d rows.\n",$rowcount2);

  }

if(mysqli_num_rows($result2)==1) {
header('Location: /login/lockuser.html');;
} else {

// User authenticanion query.
$qry_auser = "SELECT password FROM user WHERE username ='" . $username . "'  ";

// Retrieve password from database that matches username.
$query = mysqli_query($con, $qry_auser);

// Fetch the row with the username match.
$row = mysqli_fetch_array($query);

// Let's be real speific...
$dbvalue = $row[0];

// Calculate the hash values and see if they match.
$verify = password_verify($password, $dbvalue);

// If the hash values match, set username session variable.
if($verify){
 // Set username session variable
 $_SESSION['username'] = $_POST['username'];
 // Jump to create profile page
 header('Location: /login/user/newprofile.php');
 }
 else {
	// Error logging query
$qry_erlog = "INSERT INTO signlog (username, userip, useragent, failed)

	 			           VALUES

	   			         ('$username', '$user_ip', '$user_agent', 'NEW_USER')";



		// Log it as an error attempt
		if (mysqli_query($con, $qry_erlog)){ 
		
											}
				else
					{
					 echo "<br>Input data failed.";
					  }
	
	 	// Jump to loginfail page
		header('Location: /login/loginfail.html');
		 }

}
}

?> 




