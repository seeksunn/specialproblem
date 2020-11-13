<?php
session_start();
if(isset($_SESSION['Admin'])){
    if($_SESSION['Admin'] == "true") {        
        echo "Admin ID = ".$_SESSION["AdminId"];
    } else {
        header('Location:admin_page.php'); 
    }
 } else {
    header('Location:admin_page.php'); 
}  
include("connection.php");
$id = new MongoDB\BSON\ObjectId($_POST['id']);
$bulk->delete(['_id' => $id]);
$mng->executeBulkWrite($databaseName.'.exercises', $bulk);
header('Location:admin_manage.php'); 
?>