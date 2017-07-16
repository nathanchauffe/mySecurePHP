
<?php

// Inialize session.
session_start();

// Include secure common files.
require($_SERVER['DOCUMENT_ROOT'] . '/frame/coms.php');
require($_SERVER['DOCUMENT_ROOT'] . '/login/sys/bl_head.html');
// Grab text fields from html form on previous page.
?>
<body>
<div class='row'>
<div class='col-lg-4'></div>
<div class='col-lg-4'>
<?php
$id = mysqli_real_escape_string($con, $_POST['id']);
$username = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$password1 = mysqli_real_escape_string($con, $_POST['pass1']);


if ($password == $password1) { 
//hash the password
$hashword = password_hash($password, PASSWORD_DEFAULT);

// Verify the hash.
$sql = "SELECT * FROM userlog WHERE username = '$username' AND hash = '$id' AND action = 'REQPW' AND date > DATE_SUB(NOW(), INTERVAL 59 MINUTE)";

if ($result=mysqli_query($con,$sql)){
// Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
  
}

if(mysqli_num_rows($result)==1) {
$sql2 = " UPDATE user SET password = '$hashword' WHERE username ='$username' ";  

if ($con->query($sql2) === TRUE) {
    echo "<br><br>
    <div class='panel panel-primary' >
    
    		<div class='panel-heading'>Password Reset Success</div>
    		<div class='panel-body'><p>
    You can try and <a href=/login/index.php>login with your new password</a> now.</p></div></div>";
} else {
    echo "Error updating record: " . $con->error;
}



}
}
else {
echo "Your passwords didnt match, go back to your email with the password reset link.";
}
?> 

</div><div class='col-lg-4'></div></div></body>
<?php

require('footer.html');

?>

