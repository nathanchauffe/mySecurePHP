<?php

$hostname = '';       \\ Usually localhost
$dbname   = '';       \\ Instructions - Database Structure I
$dbusername = '';             
$dbpassword = '';               

$con = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);

if(!$con)
{
    echo "cannot connet to the server";
}

?>
