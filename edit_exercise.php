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
$id = new MongoDB\BSON\ObjectId($_POST["id"]);
$wordArray=explode(" ",$_POST['words']); 
include("connection.php");
$bulk->update(['_id' => $id], ['$set' =>
                                                 ['topic' => $_POST['topic'], 
                                                 'objective' => $_POST['objective'], 
                                                 'contentTopic' => $_POST['contentTopic'], 
                                                 'content' => $_POST['content'], 
                                                 'words' => $wordArray,  
                                                 'onlyread' => $_POST['onlyread'],
                                                 'voc' => $_POST['voc']]          
     
     ]);
$mng->executeBulkWrite($databaseName.'.exercises', $bulk);
header('Location:admin_manage.php'); 
?>