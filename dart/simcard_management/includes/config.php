<?php
session_start();

$host = "localhost:3306";    /* Host name */
$user = "cexvzstk_elmax";         /* User */
$password = "Password@2022";         /* Password */
$dbname = "cexvzstk_elmax";   /* Database name */

// Create connection
$con = mysqli_connect($host, $user, $password,$dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
