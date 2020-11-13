<?php
include("connection.php");
$completed = ["0","0"];
$doc = ['_id' => new MongoDB\BSON\ObjectID, 'username' => $_POST['Username'], 'password' => $_POST['Password'], 'completed' => $completed];
$bulk->insert($doc);
$mng->executeBulkWrite($databaseName.'.users', $bulk);
session_start();
$_SESSION["Username"] = $_POST["Username"];             
$_SESSION["Online"] = "true";
session_write_close();
header('Location:exerciseslist.php');
?>