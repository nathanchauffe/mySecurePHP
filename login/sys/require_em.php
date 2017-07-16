<?php

$qry_vem = "SELECT * FROM userlog WHERE username = '$user_current' AND action ='VERIFIED'";

if ($results=mysqli_query($con, $qry_vem)){
// Return the number of rows in result set
  $rowcount=mysqli_num_rows($qry_vem);  
}

// Friendly reminder to verify email.
if(mysqli_num_rows($results)==0) {
echo "<br><div class='panel panel-danger'><div class='panel-heading'>Verify Your Email Address</div><div class='panel-body'>";
echo htmlspecialchars("We're are waiting for you to validate the email address $user_current. If you're having trouble locating our email, try checking your spam folder.", ENT_QUOTES);
echo "</div></div>";
//Un-comment the line below if you want to restrict access without email verification.
//header('Location: /login/sys/logout.php');
}

?>