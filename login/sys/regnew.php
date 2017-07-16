<?php

// Inialize session
 session_start();


// Include the common secure files.
require($_SERVER['DOCUMENT_ROOT'] . '/frame/coms.php');

// Declare some variables.
$username = $_POST['username'];
$password = $_POST['password'];
$password1 = $_POST['pass1'];

// Get the header with the username.
require('rn_head.php');

if ($password == $password1) { 

 


// Hash the password
$hashword = password_hash($password, PASSWORD_DEFAULT);

// User creation query
$qry_nuser = "INSERT INTO user (username, password)

	            VALUES

	            ('$username', '$hashword')";

// Create new user. 
$result = mysqli_query($con, $qry_nuser);

	// If successful prompt for usersign,
	if($result){
		// Send verification email.
		require('send_em.php');
		
		echo("	

	<div align='center'>
				<br><br>Your account has been created. You can login now.
				</div>
				
				
			");
			

			
		//  If not then display error.
				}
 		else
			{

	    echo("
<div align='center'>
	
	<br><br> Username Unavailable<br><br>There is already an account with that username. <a href='/login/new/index.html'></a><br></div>
			
</div>
			");

	}
}else{
echo "<br><div align='center'>Your passwords did not match. To go back and try again <a href='/login/new/index.html'>click here</a>.";
}

require('footer.html');

?>

    



