<?php
// Inialize session
session_start();

// Include secure common files.
include($_SERVER['DOCUMENT_ROOT'] . '/frame/comsa.php');

include($_SERVER['DOCUMENT_ROOT'] . '/frame/include/style.css');

$id = $_POST['id'];
$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$joindate = $_POST['joindate'];
$joinagent = $_POST['joinagent'];
$joinip = $_POST['joinip'];
$oldname = $_POST['oldname'];


$sql = " UPDATE prof SET joindate = '$joindate', username ='$username', firstname = '$firstname', lastname = '$lastname', joinip= '$joinip', joinagent = '$joinagent' WHERE  id='$id' ";  

if ($con->query($sql) === TRUE) {
    echo "<br>Record updated successfully";
} else {
    echo "Error updating record: " . $con->error;
}

$sql2 = " UPDATE user SET username ='$username' WHERE username = '$oldname'";
if ($con->query($sql2) === TRUE) {
   
    header('Location: /preview.php');
} else {
    echo "Error updating record: " . $con->error;
}


?>