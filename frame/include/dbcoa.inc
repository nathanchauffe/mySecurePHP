<?php

$hostname = '';       \\ Usually localhost
$dbname   = '';       \\ You can choose name.
$dbusername = '';             
$dbpassword = '';               

$con = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);

if(!$con)
{
    echo "cannot connet to the server";
}

?>
