<html><title>User Profile - mySecurePHP</title>
<?php

// Secure this page.
require($_SERVER['DOCUMENT_ROOT'] . '/login/sys/secure_me.php');
require($_SERVER['DOCUMENT_ROOT'] . '/login/sys/s_head.php');



$user_id = $_POST['username'];


$query = "SELECT * FROM prof WHERE username = '$user_id'";

$result = mysqli_query($con, $query);


if ($_POST[action]){

$username = $_POST['username'];

// Insert user information into failed attempt logs.
$qry_urlog = "INSERT INTO userlog (username, userip, useragent, action)

	 			           VALUES

	   			         ('$username', '$user_ip', '$user_agent', 'DELBYUSER')";



		// Log it as an error attempt
		if (mysqli_query($con, $qry_urlog)){ 
		
											}
				else
					{
					 echo "<br>Input data failed.";
					  }
				  
$sql = "DELETE FROM prof WHERE username ='$username'";



if ($con->query($sql) === TRUE) {
    echo "<br><br><div align='center'>Record deleted successfully</div>";
} else {
    echo "Error deleting record: " . $con->error;
}

$sql2 = "DELETE  FROM user WHERE username = '$username'";

if ($con->query($sql2) === TRUE) {
    echo "<br><br><div align='center'>Record deleted successfully</div>";
    header('Location: /login/sys/logout.php');
} else {
    echo "Error deleting record: " . $con->error;
}
				  
	}	else {			  
		
echo "<div width='100%'><div align='center'><h1>WARNING!<h1></div>";



while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
		echo "
<div align='center'><h5>You are about to delete the profile for</h5> <b>{$row['username']}</b></div>
	
	
			 ";
			 
		$username = "{$row['username']}";	 
}	
mysqli_free_result($result);



echo "
	<div class='container' style='padding-top:30px;'>
        <div class='row'>
            <div class='col-md-4 col-md-offset-4'>
                <div class='login-panel panel panel-default'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Confirm Delete</h3>
                    </div>
                    
                      
			<div class='panel-body'>
			  <fieldset>
                                <div class='form-group'>

<div align='center'><h3>Are you sure?</h3><br>
<div>
<form action=$_SERVER[PHP_SELF] method=POST>
<input type='hidden' name='username' value='$username'/>
		<input type='hidden' name='action' value='delete'/>
	<input type='submit' name='SUBMIT'  class='btn btn-danger btn-block' value='Yes, I am sure.'/></form></div></div></div></div></div>


";
}

// Echo the secure Page Footer.
require($_SERVER['DOCUMENT_ROOT'] . '/login/sys/footer.html');
?>