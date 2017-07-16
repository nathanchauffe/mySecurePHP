<html><title>Admin - mySecurePHP</title>
<?php

// Secure this page.
require($_SERVER['DOCUMENT_ROOT'] .'/login/sys/secure_ad.php');
// Get the header
include($_SERVER['DOCUMENT_ROOT'] . '/login/admin/sys/header.php');

?>

 <div class="col-lg-8">
  <?php 
$search =  mysqli_real_escape_string($con, $_POST['search']);
$qry_searchu ="SELECT * FROM user WHERE username LIKE '%$search%'";
    $result_su = mysqli_query($con, $qry_searchu);
        echo "<div class='panel panel-default'><div class='panel-heading'>Username Search</div><div class='list-group'>";
    while ($row = mysqli_fetch_array($result_su, MYSQLI_ASSOC)){

echo "<a class='list-group-item' href='details.php?user={$row['username']}'>{$row['username']}</a>";
  }  
    
	mysqli_free_result($result);
	echo "</div></div>";
 ?>
    
 </div>
	
<?php
// Get the login panel and footer.
require($_SERVER['DOCUMENT_ROOT'] . '/login/admin/sys/loginpanel.php');
require($_SERVER['DOCUMENT_ROOT'] . '/login/admin/sys/footer.php');

?>
