<?php

// Inialize session
 session_start();

// Load secure common files
require($_SERVER['DOCUMENT_ROOT'] . '/frame/coms.php');

//Get the header.
require('bl_head.html');

if ($_POST['reset']){

$username = mysqli_real_escape_string($con, $_POST['username']);




$sql = "SELECT username FROM user WHERE username = '$username'";

if ($result=mysqli_query($con,$sql)){
// Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);

  }

if(mysqli_num_rows($result)==0) {
echo "
        <title>No Match Found</title>
<div align='center'>
	
		
			<div ><h1>No Match Found</h1></div>   
			
				<br><div>No exististing email match for username $username.<br><br>To go back and try again <a href='/login/forgot.html'>Click Here</a>.</div>
				<br><br>
				
		
";
} else {


$random_hash = md5(uniqid(rand(), true));

$action = "REQPW";

$qry_reset = "INSERT INTO userlog (username, userip, useragent, action, hash)

	 			           VALUES

	   			         ('$username', '$user_ip', '$user_agent', '$action', '$random_hash')";



		// Put and action between the brackets if you want
		if (mysqli_query($con, $qry_reset)){ 
		echo "<title>Password Verification Email Sent</title><div class='container'>

<div align='center'>
	
			<div><h1>Email Sent</h1></div>   
			<br><br>An email to the address matching that username has been sent.<br><br>
				
				
			
		</div>
	
";  
											}
				else
					{
					 echo("<br>Input data failed.");
					  }



$to =  strip_tags(htmlspecialchars($username));


$message = "http://www.yourdomain.com/login/temp.php?id=$random_hash";

	
// Create the email and send the message

$email_subject = "Password Reset Request";
$email_body = "You are recieving this email because someone requested a password reset.\n Please click the temporary link below and reset your password.\n\n\n"."$message";
$headers = "From: noreply@yourdomain.com\n"; 

mail($to,$email_subject,$email_body,$headers);
return true;			




} 
}
 
?>
</div>
<div class='col-xs-1 col-sm-3 col-md-4'></div>
    </div>
</div>
</html>
<?php
require('footer.html');
?>
