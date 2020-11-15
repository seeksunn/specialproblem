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
?>

<html>
<body>
<form name="form1" method="post" action="add_word.php">
<input type="text" name="words" value="<?php echo $_POST['words'];?>">
<input name="btnSubmit" type="submit" value="Submit">
</form>
<script>
document.form1.submit();
</script>
</body>
</html>