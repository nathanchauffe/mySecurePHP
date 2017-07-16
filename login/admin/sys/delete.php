<?php


// Include header
require('header.php');


$user_id = $_POST['id'];


$query = "SELECT * FROM prof WHERE id = '$user_id'";

$result = mysqli_query($con, $query);

		
echo "<div width='100%'><div align='center'><h1>WARNING!<h1></div><div><h4>You are about to delete the following from the profile table:</h4></div>";



while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
		echo "
<div>
	<div><b>ID: </b>{$row['id']} <b>Username: </b>{$row['username']}</div>
	<div><b>First Name:</b> {$row['firstname']} <b>Last Name:</b> {$row['lastname']}</div>  
        <div><b>Join Date:</b> {$row['joindate']} <b>Join IP:</b> {$row['joinip']}</div>
	<div><b>Join Agent:</b> {$row['joinagent']}</div>
</div>
	
			 ";
			 
		$username = "{$row['username']}";	 
}	
mysqli_free_result($result);

echo "</div><div><br><h4>AND the following from the user table:<h4></div>";


$query = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($con, $query);

		
while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
		echo "
			 <div><b>Username: </b> {$row['username']}</div>
			 <div><b>Password: </b> {$row['password']}</div>  

			 ";
			 
		
}	
mysqli_free_result($result);


$_SESSION['del_id'] = $user_id;
$_SESSION['del_user'] = $username;

echo "<br><div align='center'><h3>Are you sure?</h3><br><a href='../conf_del.php'>Yes, permently delete these records.</a></div>
";

require('loginpanel.php');
require('footer.php');
?>