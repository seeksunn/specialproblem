<?php 
session_start(); 
$wordArray=explode(" ",$_POST['words']);
include("connection.php");
$thisId=new MongoDB\BSON\ObjectID;
$doc = ['_id' => $thisId, 
    'topic' => $_POST['topic'], 
    'objective' => $_POST['objective'], 
    'contentTopic' => $_POST['contentTopic'], 
    'content' => $_POST['content'], 
    'words' => $wordArray,  
    'onlyread' => $_POST['onlyread'],
    'voc' => $_POST['voc'],
    'creator' => $_SESSION['AdminId']
];    
$bulk->insert($doc);
$mng->executeBulkWrite($databaseName.'.exercises', $bulk);

$filter = [ '_id' => $_SESSION["AdminId"] ]; 
$query = new MongoDB\Driver\Query($filter);   
$rows = $mng->executeQuery($databaseName.".admin", $query);
foreach ($rows as $row) {
    $newCreatedArrays = $row->created;
}
array_push($newCreatedArrays, $thisId);
$bulk = new MongoDB\Driver\BulkWrite;    
$bulk->update(['_id' => $_SESSION["AdminId"]], ['$set' => ['created' => $newCreatedArrays]]);
$mng->executeBulkWrite($databaseName.'.admin', $bulk);
header('Location:admin_manage.php'); 
?>