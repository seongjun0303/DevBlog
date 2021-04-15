<?php


define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'seongjun0303');
define('DB_PASSWORD', 'seongjun0303');
define('DB_NAME', 'project4300');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>