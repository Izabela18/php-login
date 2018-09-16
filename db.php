<?php

session_start();

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

$DB_host = "localhost";
$DB_user = "iza";
$DB_pass = "laboration2";
$DB_name = "iza";

try
{     //creating connection with a database
     $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
     //Sets an attribute on the database handle.Error reporting and Throw exceptions.
     $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
     echo $e->getMessage();
}


include_once 'class.user.php';
//creating a new instance of the class created in in the inluded file
$user = new User($DB_con);


?>
