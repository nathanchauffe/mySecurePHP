<?php

 $random_hash = md5(uniqid(rand(), true));

$action = "VEREM";

$qry_verem = "INSERT INTO userlog (username, userip, useragent, action, hash)

	 			           VALUES

	   			         ('$username', '$user_ip', '$user_agent', '$action', '$random_hash')";



		// Put and action between the brackets if you want
		if (mysqli_query($con, $qry_verem)){ 
		echo "<br><br><br><div align='center'> A verification email has been sent to $username . </div>";  
											}
				else
					{
					 echo("<br>Input data failed.");
					  }


			
$to =  strip_tags(htmlspecialchars($username));


$message = "http://www.yourdomain.com/login/verify.php?id=$random_hash";

	
// Create the email and send the message

$email_subject = "Welcome to mySecurePHP";
$email_body = "Your account was successfully created.\n Please click the temporary link below to verify your email adress.\n\n\n"."$message";
$headers = "From: noreply@yourdomain.com\n"; 

mail($to,$email_subject,$email_body,$headers);
return true;			

?>
