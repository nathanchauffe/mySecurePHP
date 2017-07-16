<?php
// Inialize session
 session_start();

// Check, if username session is NOT set then this page will jump to login page
 if (!isset($_SESSION['username_ad'])) {
 header('Location: 404.html');
 }


// Load secure common files
require($_SERVER['DOCUMENT_ROOT'] . '/frame/comsa.php');

// Grab the username.
$username_ad =  $_SESSION['username_ad'];

$sql = "SELECT Max(date), username FROM userlog WHERE username = '$username_ad' AND action = 'LOGIN_AD' ";

// Retrieve password from database that matches username.
$query = mysqli_query($con, $sql);

// Fetch the row with the username match.
$row = mysqli_fetch_array($query);

// Let's be real speific...
$last_login = $row[0];

// Total Users
$sql ="SELECT * FROM prof";
if ($result=mysqli_query($con,$sql)){
  $total_users=mysqli_num_rows($result);
}

// New users today
$qry_ntoday = "SELECT * FROM prof WHERE DATE(joindate) = CURDATE()";
  if ($resultt=mysqli_query($con,$qry_ntoday)){ 
  $new_users=mysqli_num_rows($resultt);
}


// New Usesr since your last login
$qry_new = "SELECT * FROM prof WHERE joindate > '$last_login'";
if ($result=mysqli_query($con,$qry_new)){
	$new_usersll=mysqli_num_rows($result);
}

// Locked IP adresses
$qry_iplock = "SELECT userip, COUNT(*) AS cnt FROM signlog WHERE date > DATE_SUB(NOW(), INTERVAL 30 MINUTE) HAVING cnt > 10";
if ($resulti=mysqli_query($con,$qry_iplock)){
$locked_ip=mysqli_num_rows($resulti);
}

// Locked usernames
$qry_usrlock = "SELECT username, COUNT(*) AS cnt FROM signlog WHERE date > DATE_SUB(NOW(), INTERVAL 15 MINUTE) HAVING cnt > 5";
if ($resultu=mysqli_query($con,$qry_usrlock))
  {

  $locked_user=mysqli_num_rows($resultu);

  } 
// Logins today
$qry_lstoday = "SELECT * FROM userlog WHERE action = 'LOGIN' AND DATE(date) = CURDATE()";
  if ($resultp=mysqli_query($con,$qry_lstoday))
  {

  $logsuccess=mysqli_num_rows($resultp);
}

// Failed logins today
$qry_lftoday = "SELECT * FROM signlog WHERE DATE(date) = CURDATE()";
  if ($resultq=mysqli_query($con,$qry_lftoday))
  {

  $logfails=mysqli_num_rows($resultq);
}

  

	
?>