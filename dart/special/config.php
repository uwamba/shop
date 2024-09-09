<?php
session_start();

$host = "mysql1003.mochahost.com";    /* Host name */
$user = "reditech_live_readin";         /* User */
$password = "Password@2020";         /* Password */
$dbname = "reditech_readin_live";   /* Database name */

// Create connection
$con = mysqli_connect($host, $user, $password,$dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
