<?php
//Get the header.
require('sys/header.php');

$user_id = $_SESSION['del_id'];
$username  = $_SESSION['del_user'];

$sql = "DELETE FROM prof WHERE id =$user_id";



if ($con->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $con->error;
}




$sql2 = "DELETE  FROM user WHERE username = '$username'";

if ($con->query($sql2) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $con->error;
}

echo "

<div></div>
<div>user deleted</div>
<div><a href='preview.php'>go back</a></div>";

//Get the panel and footer.
require('sys/loginpanel.php');
require('sys/footer.php');
?>