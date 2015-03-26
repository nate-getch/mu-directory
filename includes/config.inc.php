<?php
error_reporting(0);
#error_reporting(E_ALL ^ E_NOTICE);

$db_username = 'root';
$db_password = '';
$db_name = 'mudir';
$db_host = 'localhost';

$connecDB = mysqli_connect($db_host, $db_username, $db_password,$db_name)or die('could not connect to database');

?>