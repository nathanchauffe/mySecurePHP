<html><title>User Profile - mySecurePHP</title>
<?php

// Secure this page.
require($_SERVER['DOCUMENT_ROOT'] . '/login/sys/secure_me.php');
require($_SERVER['DOCUMENT_ROOT'] . '/login/sys/s_head.php');

?>
<div class='row'>
<div class='col-lg-4'>
</div>
<div class='col-lg-4'>

	<?php
$qry_prof = "SELECT * FROM prof WHERE username = '$user_current'";
if ($result=mysqli_query($con, $qry_prof)){
// Return the number of rows in result set
  $rowcount=mysqli_num_rows($qry_prof);
  
}

if(mysqli_num_rows($result)==0) {

echo "<br><br><div class='panel panel-warning'><div class='panel-heading'>Create Your Profile</div><div class='panel-body'>";

echo htmlspecialchars("You haven't set up a profile yet.", ENT_QUOTES);

echo " <a style='alert-link' href='/login/user/newprofile.php'> Go Here </a> to create one. </div></div></div>
<div class='col-lg-4'>
</div></div>
";
} else{

	
	
if ($_POST[oldname]){

$id = mysqli_real_escape_string($con, $_POST['id']);
$username = mysqli_real_escape_string($con, $_POST['username']);
$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
$joindate = mysqli_real_escape_string($con, $_POST['joindate']);
$joinagent = mysqli_real_escape_string($con, $_POST['joinagent']);
$joinip = mysqli_real_escape_string($con, $_POST['joinip']);
$oldname = mysqli_real_escape_string($con, $_POST['oldname']);
$user_id = mysqli_real_escape_string($con, $_POST['id']);
$status = mysqli_real_escape_string($con, $_POST['status']);
$sql = " UPDATE prof SET joindate = '$joindate', username ='$username', firstname = '$firstname', lastname = '$lastname', joinip = '$joinip', joinagent ='$joinagent', status ='$status' WHERE  id='$id' ";  



if ($con->query($sql) === TRUE) {
    echo "<div align='center'><br>Profile updated successfully<br></div></div>";
 } else { echo "<div align='center'><br>Profile name already in use<br></div></div>";
 }

}
 else {




$query = "SELECT * FROM prof WHERE username = '$user_current'";

$result = mysqli_query($con, $query);


while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
		echo "
		<br>

                <div class='login-panel panel panel-default'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Update Profile</h3>
                    </div>
 <form action=$_SERVER[PHP_SELF] method=POST>
			 <input type='hidden' name='oldname' value='{$row['username']}'/>
			  <input type='hidden' name='id' value='{$row['id']}'/>
			  
			  
			<div class='panel-body'>
			  <fieldset>
                                <div class='form-group'>
			 <h4 >Username: {$row['username']}</h4> <input class='form-control' type='hidden' name='username' value='{$row['username']}' /></div>
	 <div class='form-group'> <h4>First Name:</h4> <input class='form-control' type='text' name='firstname' value='{$row['firstname']}'/>  </div>
			 <div class='form-group'> <h4 >Last Name: </h4><input  class='form-control'type='text' name='lastname' value='{$row['lastname']}'/> </div>
			<div class='form-group'> <h4 >Join Date:</h4> {$row['joindate']}<input  class='form-control' type='hidden' name='joindate' value='{$row['joindate']}'/> </div>
			
			 <input class='form-control' type='hidden' name='joinagent' value='{$row['joinagent']}'/>
			<input  class='form-control' type='hidden' name='joinip' value='{$row['joinip']}'/>
			
			<input type='hidden' name='status' value='updated'/>
	<input type='submit' name='SUBMIT'  class='btn btn-success btn-block' value='Update Profile Info'/></form></div></div>
	
	
<div class='login-panel panel panel-default'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Delete Account</h3>
			</div>
 			<div class='panel-body'> Are you sure you want to delete your account?<br><br>
			  <fieldset>
                                <form action='/login/sys/del_usr.php' method='POST'>
 <input type='hidden' name='username' value='{$row['username']}'/>
		
	<input type='submit' name='SUBMIT'  class='btn btn-warning btn-block' value='Yes, I am sure.'/></form></div><div></div>
	
	
	
	";

		 
}	
mysqli_free_result($result);
}
echo "</div><div class='col-lg-4'></div>";
// Echo the secure Page Footer.
require($_SERVER['DOCUMENT_ROOT'] . '/login/sys/footer.html');
}
?>
