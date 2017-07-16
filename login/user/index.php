<html><title>Home - mySecurePHP</title>
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
echo "<br><br><div class='panel panel-primary'><div class='panel-heading'>Create Your Profile</div><div class='panel-body'>";

echo htmlspecialchars("You haven't set up a profile yet.", ENT_QUOTES);

echo " <a style='alert-link' href='/login/user/newprofile.php'> Go Here </a> to create one. </div></div>";
}

// Require email verification.
require($_SERVER['DOCUMENT_ROOT'] .'/login/sys/require_em.php');
?>
</div>
<div class='col-lg-4'>
</div>
</div>
</div>
<?php

// Get the footer.
require($_SERVER['DOCUMENT_ROOT'] .'/login/sys/footer.html');


?>
